<?php
//N00130270
class ScreenTableGateway {
      
    private $connection;
    
    public function __construct($c) {
        $this->connection = $c;
    }
    public function countScreens() {
        //this function counts the rows in my table
        $sqlQuery = "SELECT COUNT(*) FROM screen;";
                
        $screenStatement = $this->connection->prepare($sqlQuery);
        $status = $screenStatement->execute();
        
        if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
            die("Could not retrieve screens");
        }
        
        return $screenStatement;       
    }
    public function getScreens($sortOrder) {
        //executes a query to get all of the screens
        $sqlQuery = "SELECT * FROM screen "
                . "ORDER BY " . $sortOrder;//also has sortOrder that has a value of screenID
        
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();
        
        if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
            die("Could not retrieve screens");
        }
        
        return $statement;
                
    }
    
    public function getScreenById($screenID) {
        //execue a query to get the screen with the specific screen number
        $sqlQuery = "SELECT * FROM screen WHERE screenID = :screenID";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(//defining the place holders
            "screenID" => $screenID
        );
       $status = $statement->execute($params); 
       
       if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
           die("Could not retrieve screen");
       }
       
       return $statement;
    }
    public function insertScreen($seatNumber, $fireExits) {
        //execue a query to get the screen with the specific screen number
        $sqlInsert = "INSERT screen(seatNumber,fireExits ) "
            . "VALUES (:seatNumber, :fireExits)";
        
        $statement = $this->connection->prepare($sqlInsert);
        $params = array(//defining the place holders
            "seatNumber" => $seatNumber,
            "fireExits" => $fireExits
        );
       $status = $statement->execute($params); 
       
       if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
           die("Could not insert new screen");
       }
       $id = $this->connection->lastInsertId();
       
       return $id;
    }
    
    public function deleteScreen($screenID){
        
        $sqlDelete = "DELETE FROM screen WHERE screenID = :screenID";
        
        $statement = $this->connection->prepare($sqlDelete);
        $params = array (//defining the place holders
            "screenID" => $screenID         
        );
        
        $status = $statement->execute($params);
       
        if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
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
        $params = array(//defining the place holders
            
            "screenID" => $id,
            "seatNumber" => $sn,
            "fireExits" => $f
            
        );
        
        $status = $statement->execute($params);
        
        if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
           die("Could not update screen");
       }
        
        return($statement->rowCount() == 1);
    }
}
