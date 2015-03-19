<?php
//N00130270
class ScreenTableGateway {
      
    private $connection;
    
    public function __construct($c) {
        $this->connection = $c;
    }
    public function countScreens() {
        $sqlQuery = "SELECT COUNT(*) FROM screen;";
                
        $statementScreen = $this->connection->prepare($sqlQuery);
        $status = $statementScreen->execute();
        
        if(!$status) {
            die("Could not retrieve screens");
        }
        
        return $statementScreen;       
    }
    public function getScreens() {
        //executes a query to get all of the screens
        $sqlQuery = "SELECT * FROM screen";
        
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();
        
        if(!$status) {
            die("Could not retrieve screens");
        }
        
        return $statement;
                
    }
    
    public function getScreenById($screenID) {
        //execue a query to get the screen with the specific screen number
        $sqlQuery = "SELECT * FROM screen WHERE screenID = :screenID";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "screenID" => $screenID
        );
       $status = $statement->execute($params); 
       
       if(!$status) {
           die("Could not retrieve screen");
       }
       
       return $statement;
    }
    public function insertScreen($seatNumber, $fireExits) {
        //execue a query to get the screen with the specific screen number
        $sqlInsert = "INSERT screen(seatNumber,fireExits ) "
            . "VALUES (:seatNumber, :fireExits)";
        
        $statement = $this->connection->prepare($sqlInsert);
        $params = array(
            "seatNumber" => $seatNumber,
            "fireExits" => $fireExits
        );
       $status = $statement->execute($params); 
       
       if(!$status) {
           die("Could not insert new screen");
       }
       $id = $this->connection->lastInsertId();
       
       return $id;
    }
    
    public function deleteScreen($screenID){
        
        $sqlDelete = "DELETE FROM screen WHERE screenID = :screenID";
        
        $statement = $this->connection->prepare($sqlDelete);
        $params = array (
            "screenID" => $screenID         
        );
        
        $status = $statement->execute($params);
       
        if(!$status) {
            die("Could not delete screen");
        }
        
       return ($statement->rowCount() ==1);
    }
    public function updateScreen($id, $sn, $f){
        $sqlQuery=
                "UPDATE screen SET " .
                "seatNumber = :seatNumber, " .
                "fireExits = :fireExits " .
                "WHERE screenID = :screenID";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            
            "screenID" => $id,
            "seatNumber" => $sn,
            "fireExits" => $f
            
        );
        
        $status = $statement->execute($params);
        
        return($statement->rowCount() ==1);
    }
}
