<?php 

class TagAttribute {
    // DB stuff 
    private $conn;
    private $table = 'tag_attribute';
    public $tag_id;
    public $attribute_id;
    public $tag_attribute;


    public function __construct($db){
        $this->conn = $db;
    }
    public function read(){
        // write the query 
        $query = 'SELECT 
                  tag_id,
                  attribute_id,
                  tag_attribute
                  FROM ' . $this->table ;
        // prepare it 
       $stmt = $this->conn->prepare($query);
        // execute it
        $stmt->execute();

        return $stmt;
    }

    public function read_single(){
        $query = 'SELECT 
                  tag_id,
                  attribute_id,
                  tag_attribute
                  FROM ' .$this->table. '
                  WHERE tag_attribute = ?
                  LIMIT 0,1';
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->tag_attribute);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->tag_id = $row['tag_id'];
        $this->attribute_id = $row['attribute_id'];
        $this->tag_attribute = $row['tag_attribute'];

    }
    public function create(){
        $query = 'INSERT INTO '.$this->table.'
                  SET 
                  attribute_id = :attribute_id, 
                  tag_id = :tag_id';
                     
     $stmt = $this->conn->prepare($query);

        $this->attribute_id = htmlspecialchars(strip_tags($this->attribute_id));
        $this->tag_id = htmlspecialchars(strip_tags($this->tag_id));

        
        $stmt->bindParam(':attribute_id', $this->attribute_id);
        $stmt->bindParam(':tag_id', $this->tag_id);
      
        if($stmt->execute()){
            return true;
        }
       
        return false; 
        
    
    }

    public function update(){
        $query = 'UPDATE ' .$this->table. '
                   SET 
                   attribute_id = :attribute_id,
                   tag_id  = :tag_id
                   WHERE 
                   tag_attribute = :tag_attribute';
        $stmt=$this->conn->prepare($query);
        $this->tag_id = htmlspecialchars(strip_tags($this->tag_id));
        $this->attribute_id =htmlspecialchars(strip_tags($this->attribute_id));
        $this->tag_attribute =htmlspecialchars(strip_tags($this->tag_attribute));


        $stmt->bindParam(':attribute_id', $this->attribute_id);
        $stmt->bindParam(':tag_id', $this->tag_id);
        $stmt->bindParam(':tag_attribute', $this->tag_attribute);

        
        if($stmt->execute()){
           return true;
        } 
        printf("Error: %s. \n", $stmt->erro);
        return false;

    }

    public function delete(){
        $query = 'DELETE FROM '. $this->table . ' WHERE tag_attribute = :tag_attribute';
        $stmt = $this->conn->prepare($query);

        $this->tag_attribute = htmlspecialchars(strip_tags($this->tag_attribute));

         $stmt->bindParam(':tag_attribute', $this->tag_attribute);

         if($stmt->execute()){
            return true;
        }
       
        return false; 
    }

}