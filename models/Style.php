<?php 

class Style{
    // DB stuff 
    private $conn;
    private $table = 'style';
    public $style_id;
    public $style_name;

    public function __construct($db){
        $this->conn = $db;
    }
    public function read(){
        // write the query 
        $query = 'SELECT 
                  style_id,
                  style_name
                  FROM ' . $this->table ;
        // prepare it 
       $stmt = $this->conn->prepare($query);
        // execute it
        $stmt->execute();

        return $stmt;
    }

    public function read_single(){
        $query = 'SELECT 
                  style_id,
                  style_name
                  FROM ' .$this->table. '
                  WHERE style_id = ?
                  LIMIT 0,1';
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->style_id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->style_id = $row['style_id'];
        $this->style_name = $row['style_name'];
    }
    public function create(){
        $query = 'INSERT INTO '.$this->table.'
                  SET 
                  style_name = :style_name';
                     
     $stmt = $this->conn->prepare($query);

        $this->style_name = htmlspecialchars(strip_tags($this->style_name));
        
        $stmt->bindParam(':style_name', $this->style_name);

        if($stmt->execute()){
            return true;
        }
       
        return false; 
        
    
    }

    public function update(){
        $query = 'UPDATE ' .$this->table. '
                   SET 
                   style_name = :style_name
                   WHERE 
                   style_id = :style_id';
        $stmt=$this->conn->prepare($query);
        $this->style_id = htmlspecialchars(strip_tags($this->style_id));
        $this->style_name =htmlspecialchars(strip_tags($this->style_name));

        $stmt->bindParam(':style_name', $this->style_name);
        $stmt->bindParam(':style_id', $this->style_id);
        
        if($stmt->execute()){
           return true;
        } 
        printf("Error: %s. \n", $stmt->erro);
        return false;

    }

    public function delete(){
        $query = 'DELETE FROM '. $this->table . ' WHERE style_id = :style_id';
        $stmt = $this->conn->prepare($query);

        $this->style_id = htmlspecialchars(strip_tags($this->style_id));

         $stmt->bindParam(':style_id', $this->style_id);

         if($stmt->execute()){
            return true;
        }
       
        return false; 
    }

}