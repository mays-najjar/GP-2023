<?php 
class Database {
    private $host = 'localhost';
    private $dbname = 'html_tag';
    private $username = 'root';
    private $userpass = '';
    private $conn = null; 

    public function connect() {
        if ($this->conn == null){
  
        try {
          $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username, $this->userpass);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
          echo 'Connection Error: ' . $e->getMessage();
        }
      }
        return $this->conn;
      }
    }


?>