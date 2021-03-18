<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
class Connection{
    private $conn;
    public function __construct(){
        $this->conn = new mysqli("localhost", "root", "", "nommina");
    }
    
    public function getConnection(){
        return $this->conn;
    }
}
?>