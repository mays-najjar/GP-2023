<?php 

class Tag{
    // DB stuff 
    private $conn;
    private $table = 'tag';
    public $tag_id;
    public $tag_name;

    public function __construct($db){
        $this->conn = $db;
    }
    public function read(){
        // write the query 
        $query = 'SELECT 
                  tag_id,
                  tag_name
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
                  tag_name
                  FROM ' .$this->table. '
                  WHERE tag_id = ?
                  LIMIT 0,1';
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->tag_id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->tag_id = $row['tag_id'];
        $this->tag_name = $row['tag_name'];
    }
    public function create(){
        $query = 'INSERT INTO '.$this->table.'
                  SET 
                  tag_name = :tag_name';
                     
     $stmt = $this->conn->prepare($query);

        $this->tag_name = htmlspecialchars(strip_tags($this->tag_name));
        
        $stmt->bindParam(':tag_name', $this->tag_name);

        if($stmt->execute()){
            return true;
        }
       
        return false; 
        
    
    }

    public function update(){
        $query = 'UPDATE ' .$this->table. '
                   SET 
                   tag_name = :tag_name
                   WHERE 
                   tag_id = :tag_id';
        $stmt=$this->conn->prepare($query);
        $this->tag_id = htmlspecialchars(strip_tags($this->tag_id));
        $this->tag_name =htmlspecialchars(strip_tags($this->tag_name));

        $stmt->bindParam(':tag_name', $this->tag_name);
        $stmt->bindParam(':tag_id', $this->tag_id);
        
        if($stmt->execute()){
           return true;
        } 
        printf("Error: %s. \n", $stmt->erro);
        return false;

    }

    public function delete(){
        $query = 'DELETE FROM '. $this->table . ' WHERE tag_id = :tag_id';
        $stmt = $this->conn->prepare($query);

        $this->tag_id = htmlspecialchars(strip_tags($this->tag_id));

         $stmt->bindParam(':tag_id', $this->tag_id);

         if($stmt->execute()){
            return true;
        }
       
        return false; 
    }

}