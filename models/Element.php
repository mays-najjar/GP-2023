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
              element_id = :element_id,
              tag_id = :tag_id,
              children_order = :children_order,
              parent_id = :parent_id,
              content = :content';

        $stmt = $this->conn->prepare($query);

        $this->element_id = htmlspecialchars(strip_tags($this->element_id));

        $this->tag_id = htmlspecialchars(strip_tags($this->tag_id));
        $this->children_order = htmlspecialchars(strip_tags($this->children_order));
        $this->parent_id = htmlspecialchars(strip_tags($this->parent_id));
        $this->content = htmlspecialchars(strip_tags($this->content));

        $stmt->bindParam(':element_id', $this->element_id);
        $stmt->bindParam(':tag_id', $this->tag_id);
        $stmt->bindParam(':children_order', $this->children_order);
        $stmt->bindParam(':parent_id', $this->parent_id);
        $stmt->bindParam(':content', $this->content);


        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function update()
    {
        $query = 'UPDATE ' . $this->table . '
              SET
              tag_id = :tag_id, 
              content = :content,
              parent_id = :parent_id,
              children_order = :children_order
              WHERE 
              element_id = :element_id';

        $stmt = $this->conn->prepare($query);
        $this->tag_id = htmlspecialchars(strip_tags($this->tag_id));
        $this->children_order = htmlspecialchars(strip_tags($this->children_order));
        $this->parent_id = htmlspecialchars(strip_tags($this->parent_id));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->element_id = htmlspecialchars(strip_tags($this->element_id));


        $stmt->bindParam(':tag_id', $this->tag_id);
        $stmt->bindParam(':children_order', $this->children_order);
        $stmt->bindParam(':parent_id', $this->parent_id);
        $stmt->bindParam(':content', $this->content);
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

    public function deleteAll()
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE parent_id NOT IN (1, 3)';
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }



    public function codeMode()
    {
        echo $code_mode = $this->generate_html_from_database1();
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

    public function generate_html_from_database1()
    {
        // Retrieve the top-level element with parent_id = NULL (should be only one)
        $stmt = $this->conn->prepare("SELECT * FROM element WHERE parent_id IS NULL");
        $stmt->execute();
        $top_element = $stmt->fetch(PDO::FETCH_ASSOC);

        // Recursively build the HTML tree starting from the top-level element
        $html = $this->build_html_tree1($top_element);
        $html = htmlspecialchars($html);

        return $html;
    }

    public function build_html_tree1($element, $indent_level = 0)
    {
        $tag_name = $this->get_tag_name($element['tag_id']);
        $attributes = $this->get_attributes($element['element_id']);

        $style = $this->get_style_attributes($element['element_id']);

        $content = $element['content'];
        $self_closing_tags = ['img', 'br'];

        $indent = str_repeat(' ', $indent_level * 4);
        $html = "$indent<$tag_name";
        foreach ($attributes as $attr_name => $attr_value) {
            $html .= " $attr_name=\"$attr_value\"";
        }
        if (!empty($style)) {
            $html .= ' style="' . $style . '"';
        }
        if (!in_array($tag_name, $self_closing_tags)) {
            $html .= ">";
        }
        // Recursively build child elements
        $stmt = $this->conn->prepare("SELECT * FROM element WHERE parent_id = :parent_id ORDER BY children_order");
        $stmt->bindParam(":parent_id", $element['element_id'], PDO::PARAM_INT);
        $stmt->execute();
        $child_elements = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($child_elements)) {
            $html .= "\n";
            foreach ($child_elements as $child_element) {
                $html .= $this->build_html_tree1($child_element, $indent_level + 1);
            }
            $html .= "$indent";
        }

        if (in_array($tag_name, $self_closing_tags)) {
            $html .= " />";
        } else {
            $html .= "$content</$tag_name>";
        }

        $html .= "\n";

        return $html;
    }

    /*  function generate_html_from_database()
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

   */

    public function get_attribute_name($attribute_id)
    {
        $stmt = $this->conn->prepare("SELECT attribute_name FROM attribute WHERE attribute_id = :attribute_id");
        $stmt->bindParam(":attribute_id", $attribute_id, PDO::PARAM_INT);
        $stmt->execute();
        $attribute = $stmt->fetch(PDO::FETCH_ASSOC);
        return $attribute['attribute_name'];
    }

    public function get_style_attributes($element_id)
    {
        $stmt = $this->conn->prepare("SELECT s.style_name, se.style_value
                                 FROM style_element se
                                 INNER JOIN style s ON se.style_id = s.style_id
                                 WHERE se.element_id = :element_id");
        $stmt->bindParam(":element_id", $element_id, PDO::PARAM_INT);
        $stmt->execute();
        $style_attributes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($style_attributes)) {
            return ""; // No style attributes found
        }

        $style = "";
        foreach ($style_attributes as $attribute) {
            $style .= $attribute['style_name'] . ': ' . $attribute['style_value'] . '; ';
        }

        return trim($style);
    }


    function generate_html_from_database3()
    {
        // Retrieve the top-level element with parent_id = NULL (should be only one)
        $stmt = $this->conn->prepare("SELECT * FROM element WHERE parent_id IS NULL");
        $stmt->execute();
        $top_element = $stmt->fetch(PDO::FETCH_ASSOC);

        // Recursively build the HTML tree starting from the top-level element
        $html = $this->build_html_tree3($top_element);

        return $html;
    }

    public function build_html_tree3($element)
    {
        $tag_name = $this->get_tag_name($element['tag_id']);
        $attributes = $this->get_attributes($element['element_id']);
        $style = $this->get_style_attributes($element['element_id']);   // $this->get_style_attributes($element['element_id']); // Retrieve style attributes
        $content = $element['content'];
        $self_closing_tags = ['img', 'br'];

        $html = "<$tag_name";

        // Check if style attribute exists and retrieve style attributes from the style_element table

        foreach ($attributes as $attr_name => $attr_value) {
            $html .= " $attr_name=\"$attr_value\"";
        }
        if (!empty($style)) {
            $html .= ' style="' . $style . '"';
        }

        if (!in_array($tag_name, $self_closing_tags)) {
            $html .= ">";
        }
        // Recursively build child elements
        $stmt = $this->conn->prepare("SELECT * FROM element WHERE parent_id = :parent_id ORDER BY children_order");
        $stmt->bindParam(":parent_id", $element['element_id'], PDO::PARAM_INT);
        $stmt->execute();
        $child_elements = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($child_elements as $child_element) {
            $html .= "\n";
            $html .= $this->build_html_tree3($child_element);
        }

        if (in_array($tag_name, $self_closing_tags)) {
            $html .= " />";
        } else {
            $html .= "$content</$tag_name>";
        }

        $html .= "\n";

        return $html;
    }


    public function updateOrder()
{
    $query = 'UPDATE ' . $this->table . '
        SET children_order = :children_order
        WHERE element_id = :element_id';

    $stmt = $this->conn->prepare($query);
    $this->children_order = htmlspecialchars(strip_tags($this->children_order));
    $this->element_id = htmlspecialchars(strip_tags($this->element_id));

    $stmt->bindParam(':children_order', $this->children_order);
    $stmt->bindParam(':element_id', $this->element_id);

    if ($stmt->execute()) {
        return true;
    }
    printf("Error: %s. \n", $stmt->error);
    return false;
}


    public function updateParent()
    {

        $query = 'UPDATE ' . $this->table . '
        SET parent_id = :parent_id
        WHERE element_id = :element_id';

        $stmt = $this->conn->prepare($query);
        $this->parent_id = htmlspecialchars(strip_tags($this->parent_id));
        $this->element_id = htmlspecialchars(strip_tags($this->element_id));


        $stmt->bindParam(':parent_id', $this->parent_id);
        $stmt->bindParam(':element_id', $this->element_id);


        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s. \n", $stmt->erro);
        return false;
    }

    
    public function updateContent()
    {

        $query = 'UPDATE ' . $this->table . '
        SET content = :content
        WHERE element_id = :element_id';

        $stmt = $this->conn->prepare($query);
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->element_id = htmlspecialchars(strip_tags($this->element_id));


        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':element_id', $this->element_id);


        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s. \n", $stmt->erro);
        return false;
    }
}
