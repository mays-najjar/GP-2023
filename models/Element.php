<?php

class Element
{
    // DB stuff 
    private $conn;
    private $table = 'element';
    public $tag_id;
    public $element_id;
    public $children_order;
    public $parent_id;
    public $content;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        // write the query 
        $query = 'SELECT 
              *
              FROM ' . $this->table;
        // prepare it 
        $stmt = $this->conn->prepare($query);
        // execute it
        $stmt->execute();

        return $stmt;
    }
    public function read_single()
    {
        $query = 'SELECT 
              element_id,
              tag_id,
              children_order,
              parent_id,
              content
              FROM ' . $this->table . '
              WHERE element_id = ?
              LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->element_id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->element_id = $row['element_id'];
        $this->tag_id = $row['tag_id'];
        $this->children_order = $row['children_order'];
        $this->parent_id = $row['parent_id'];
        $this->content = $row['content'];
    }
   public function create()
    {
        $query = 'INSERT INTO ' . $this->table . '
              SET 
              tag_id = :tag_id,
              children_order = :children_order,
              parent_id = :parent_id,
              content = :content';

        $stmt = $this->conn->prepare($query);

        $this->tag_id = htmlspecialchars(strip_tags($this->tag_id));
        $this->children_order = htmlspecialchars(strip_tags($this->children_order));
        $this->parent_id = htmlspecialchars(strip_tags($this->parent_id));
        $this->content = htmlspecialchars(strip_tags($this->content));



        $stmt->bindParam(':tag_id', $this->tag_id);
        $stmt->bindParam(':children_order', $this->children_order);
        $stmt->bindParam(':parent_id', $this->parent_id);
        $stmt->bindParam(':content', $this->content);
   

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }}
    public function update()
    {
        $query = 'UPDATE ' . $this->table . '
              SET
              tag_id = :tag_id,
              attribute_id = :attribute_id,
              children_order = :children_order,
              parent_id = :parent_id,
              content = :content,
              attribute_value = : attribute_value
              WHERE 
              element_id = :element_id';

        $stmt = $this->conn->prepare($query);
        $this->tag_id = htmlspecialchars(strip_tags($this->tag_id));
        $this->attribute_id = htmlspecialchars(strip_tags($this->attribute_id));
        $this->children_order = htmlspecialchars(strip_tags($this->children_order));
        $this->parent_id = htmlspecialchars(strip_tags($this->parent_id));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->attribute_value = htmlspecialchars(strip_tags($this->attribute_value));
        $this->element_id = htmlspecialchars(strip_tags($this->element_id));


        $stmt->bindParam(':tag_id', $this->tag_id);
        $stmt->bindParam(':attribute_id', $this->attribute_id);
        $stmt->bindParam(':children_order', $this->children_order);
        $stmt->bindParam(':parent_id', $this->parent_id);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':attribute_value', $this->attribute_value);
        $stmt->bindParam(':element_id', $this->element_id);


        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s. \n", $stmt->erro);
        return false;
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE element_id = :element_id';
        $stmt = $this->conn->prepare($query);

        $this->element_id = htmlspecialchars(strip_tags($this->element_id));

        $stmt->bindParam(':element_id', $this->element_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    public function get_tag_name($tag_id)
    {
        $stmt = $this->conn->prepare("SELECT tag_name FROM tag WHERE tag_id = :tag_id");
        $stmt->bindParam(":tag_id", $tag_id, PDO::PARAM_INT);
        $stmt->execute();
        $tag = $stmt->fetch(PDO::FETCH_ASSOC);
        return $tag['tag_name'];
    }

    public function get_attributes($element_id)
    {
        $stmt = $this->conn->prepare("SELECT a.attribute_name, e.attribute_value FROM attribute a INNER JOIN element_attribute e ON a.attribute_id = e.attribute_id WHERE e.element_id = :element_id");
        $stmt->bindParam(":element_id", $element_id, PDO::PARAM_INT);
        $stmt->execute();
        $attributes = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $attributes[$row['attribute_name']] = $row['attribute_value'];
        }
        return $attributes;
    }

    function generate_html_from_database()
    {
        // Retrieve the top-level element with parent_id = NULL (should be only one)
        $stmt = $this->conn->prepare("SELECT * FROM element WHERE parent_id IS NULL");
        $stmt->execute();
        $top_element = $stmt->fetch(PDO::FETCH_ASSOC);

        // Recursively build the HTML tree starting from the top-level element
        $html = $this->build_html_tree($top_element);

        return $html;
    }

    public function build_html_tree($element)
    {
        $tag_name = $this->get_tag_name($element['tag_id']);
        $attributes = $this->get_attributes($element['element_id']);
        $content = $element['content'];
        $self_closing_tags = ['img', 'br'];

        $html = "<$tag_name";
        foreach ($attributes as $attr_name => $attr_value) {
            $html .= " $attr_name=\"$attr_value\"";
        }
        $html .= ">";

        // Recursively build child elements
        $stmt = $this->conn->prepare("SELECT * FROM element WHERE parent_id = :parent_id ORDER BY children_order");
        $stmt->bindParam(":parent_id", $element['element_id'], PDO::PARAM_INT);
        $stmt->execute();
        $child_elements = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($child_elements as $child_element) {
            $html .= $this->build_html_tree($child_element);
        }

        if (!in_array($tag_name, $self_closing_tags)) {
            $html .= "$content</$tag_name>";
        }
        return $html;
    }
}
