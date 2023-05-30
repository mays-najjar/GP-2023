<?php
class StyleElement
{

    private $conn;
    private $table = 'style_element';

    public $element_id;
    public $style_id;
    public $style_value;
    public $attributesArray = array();

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = ('SELECT * FROM ' . $this->table);
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function read_single()
    {
        $query = ('SELECT * FROM ' . $this->table . ' WHERE element_id = ? 
        LIMIT 0,1');
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->element_id);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->element_id = $result['element_id'];
        $this->style_id = $result['style_id'];
        $this->style_value = $result['style_value'];
    }
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' (element_id, style_id, style_value) VALUES (?, ?, ?)';
        $stmt = $this->conn->prepare($query);
        $this->element_id = htmlspecialchars(strip_tags($this->element_id));
        $this->style_id = htmlspecialchars(strip_tags($this->style_id));
        $this->style_value = htmlspecialchars(strip_tags($this->style_value));

        $stmt->bindParam(1, $this->element_id);
        $stmt->bindParam(2, $this->style_id);
        $stmt->bindParam(3, $this->style_value);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update()
    {
        $query = ('UPDATE ' . $this->table . ' SET style_value = ? WHERE element_id =? AND style_id =?');
        $stmt = $this->conn->prepare($query);
        $this->element_id = htmlspecialchars(strip_tags($this->element_id));
        $this->style_id = htmlspecialchars(strip_tags($this->style_id));
        $this->style_value = htmlspecialchars(strip_tags($this->style_value));
        $stmt->bindParam(1, $this->style_value);
        $stmt->bindParam(2, $this->element_id);
        $stmt->bindParam(3, $this->style_id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete(){
        $query = 'DELETE FROM ' . $this->table . ' WHERE element_id = ? AND style_id = ? ' ;
        $stmt = $this->conn->prepare($query);
        $this->element_id = htmlspecialchars(strip_tags($this->element_id));
        $this->style_id = htmlspecialchars(strip_tags($this->style_id));
        $stmt->bindParam(1, $this->element_id);
        $stmt->bindParam(2, $this->style_id);
        if($stmt->execute()){
            return true;
        }
        return false;


}

}