<?php
//N00130270
class AdminTableGateway {
    
    
    private $connection;
    
    public function __construct($c) {
        $this->connection = $c;
    }

    public function getAdminByUsername($username) {
        //execue a query to get the admin with the specific admin username
        $sqlQuery = "SELECT * FROM admins WHERE username = :username";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "username" => $username,
           
        );
       $status = $statement->execute($params); 
       
       if(!$status) {
           die("Could not retieve admins");
       }
       
       return $statement;
    }
    public function insertAdmin($username, $password) {
        //inserts new admin into Admins table
        $sqlInsert = "INSERT admins(username, password) "
            . "VALUES (:username, :password)";
        
        $statement = $this->connection->prepare($sqlInsert);
        $params = array(
            "username" => $username,
            "password" => $password
        );
        
       $status = $statement->execute($params); 
       
       if(!$status) {
           die("Could not insert new admin");
       } 
       return $statement;
    }
}