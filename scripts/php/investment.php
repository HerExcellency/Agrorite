<?php
class Investment{
  
    // database connection and table name
    private $conn;
    private $table_name = "investment";
  
    // object properties
    // public $id;
    // public $agroriter_id;
    // public $farm_title;
    // public $units;
    // public $percentage;
    // public $total;
    // public $date_end;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    // read products
    function getInvoice(){
      
        // select all query
        $query = "SELECT * FROM invoices WHERE agroriter_id = ? AND status = 0 ORDER BY id DESC";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // bind id of agroriter to be read
        $stmt->bindParam(1, $this->agroriter_id);
      
        // execute query
        $stmt->execute();
      
        return $stmt;
    }

    function getFarm($farm_id){
      
        // select all query
        $query = "SELECT title, app_image FROM farms WHERE id = $farm_id";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // bind id of agroriter to be read
        // $stmt->bindParam(1, $this->farm_id);
      
        // execute query
        $stmt->execute();
      
        return $stmt;
    }
    function read(){
      
        // select all query
        $query = "SELECT * FROM " . $this->table_name . " WHERE agroriter_id = ? AND status = 0 ORDER BY id DESC";
        // $query = "SELECT * FROM investment LEFT JOIN invoices ON investment.agroriter_id = invoices.agroriter_id WHERE investment.agroriter_id = ? AND investment.status = 0";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // bind id of agroriter to be read
        $stmt->bindParam(1, $this->agroriter_id);
      
        // execute query
        $stmt->execute();
      
        return $stmt;
    }
    
    // read products
    function allInvest(){
      
        // select all query
        $query = "SELECT * FROM " . $this->table_name . " WHERE agroriter_id = ? ORDER BY id DESC";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // bind id of agroriter to be read
        $stmt->bindParam(1, $this->agroriter_id);
      
        // execute query
        $stmt->execute();
      
        return $stmt;
    }
    
}
?>