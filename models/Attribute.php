<?php

class Attribute
{
    // DB stuff 
    private $conn;
    private $table = 'attribute';
    public $attribute_id;
    public $attribute_name;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function read()
    {
        // write the query 
        $query = 'SELECT 
                  attribute_id,
                  attribute_name
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
                  attribute_id,
                  attribute_name
                  FROM ' . $this->table . '
                  WHERE attribute_id = ?
                  LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->attribute_id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->attribute_id = $row['attribute_id'];
        $this->attribute_name = $row['attribute_name'];
    }
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . '
                  SET 
                  attribute_name = :attribute_name';

        $stmt = $this->conn->prepare($query);

        $this->attribute_name = htmlspecialchars(strip_tags($this->attribute_name));

        $stmt->bindParam(':attribute_name', $this->attribute_name);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update()
    {
        $query = 'UPDATE ' . $this->table . '
                   SET 
                   attribute_name = :attribute_name
                   WHERE 
                   attribute_id = :attribute_id';
        $stmt = $this->conn->prepare($query);
        $this->attribute_id = htmlspecialchars(strip_tags($this->attribute_id));
        $this->attribute_name = htmlspecialchars(strip_tags($this->attribute_name));

        $stmt->bindParam(':attribute_name', $this->attribute_name);
        $stmt->bindParam(':attribute_id', $this->attribute_id);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s. \n", $stmt->erro);
        return false;
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE attribute_id = :attribute_id';
        $stmt = $this->conn->prepare($query);

        $this->attribute_id = htmlspecialchars(strip_tags($this->attribute_id));

        $stmt->bindParam(':attribute_id', $this->attribute_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
