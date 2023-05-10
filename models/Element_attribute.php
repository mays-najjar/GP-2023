<?php
class ElementAttribute
{

    private $conn;
    private $table = 'element_attribute';

    public $element_id;
    public $attribute_id;
    public $attribute_value;

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
        $this->attribute_id = $result['attribute_id'];
        $this->attribute_value = $result['attribute_value'];
    }
    public function create()
    {
        $query = ('INSERT INTO ' . $this->table . ' (element_id, attribute_id, attribute_value) ');
        $stmt = $this->conn->prepare($query);
        $this->element_id = htmlspecialchars(strip_tags($this->element_id));
        $this->attribute_id = htmlspecialchars(strip_tags($this->attribute_id));
        $this->attribute_value = htmlspecialchars(strip_tags($this->attribute_value));

        $stmt->bindParam(1, $this->element_id);
        $stmt->bindParam(2, $this->attribute_id);
        $stmt->bindParam(3, $this->attribute_value);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update()
    {
        $query = ('UPDATE ' . $this->table . ' SET attribute_value = ? WHERE element_id =? AND attribute_id =?');
        $stmt = $this->conn->prepare($query);
        $this->element_id = htmlspecialchars(strip_tags($this->element_id));
        $this->attribute_id = htmlspecialchars(strip_tags($this->attribute_id));
        $this->attribute_value = htmlspecialchars(strip_tags($this->attribute_value));
        $stmt->bindParam(1, $this->attribute_value);
        $stmt->bindParam(2, $this->element_id);
        $stmt->bindParam(3, $this->attribute_id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete(){
        $query = 'DELETE FROM ' . $this->table . ' WHERE element_id = ? AND attribute_id = ? ' ;
        $stmt = $this->conn->prepare($query);
        $this->element_id = htmlspecialchars(strip_tags($this->element_id));
        $this->attribute_id = htmlspecialchars(strip_tags($this->attribute_id));
        $stmt->bindParam(1, $this->element_id);
        $stmt->bindParam(2, $this->attribute_id);
        if($stmt->execute()){
            return true;
        }
        return false;


}}
