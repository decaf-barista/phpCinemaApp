<?php
//N00130270
class GenreTableGateway {
      
    private $connection;
    
    public function __construct($c) {
        $this->connection = $c;
    }
    
     public function countGenres() {
        $sqlQuery = "SELECT COUNT(*) FROM genre;";
                
        $genreStatement = $this->connection->prepare($sqlQuery);
        $status = $genreStatement->execute();
        
        if(!$status) {
            die("Could not retrieve screens");
        }
        
        return $genreStatement;       
    }
    
    public function getGenres() {
        //executes a query to get all of the genres
        $sqlQuery = "SELECT * FROM genre";
        
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();
        
        if(!$status) {
            die("Could not retrieve genres");
        }
        
        return $statement;
                
    }
    
    public function getGenreByID($genreID) {
        //execue a query to get the genre with the specific genre number
        $sqlQuery = "SELECT * FROM genre WHERE genreID = :genreID";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "genreID" => $genreID
        );
       $status = $statement->execute($params); 
       
       if(!$status) {
           die("Could not retrieve genre");
       }
       
       return $statement;
    }
    public function insertGenre($genreName, $description) {
        //execue a query to get the genre with the specific genre name
        $sqlInsert = "INSERT genre(genreName,description) "
            . "VALUES (:genreName, :description)";
        
        $statement = $this->connection->prepare($sqlInsert);
        $params = array(
            "genreName" => $genreName,
            "description" => $description
        );
       $status = $statement->execute($params); 
       
       if(!$status) {
           die("Could not insert new genre");
       }
       $genreID = $this->connection->lastInsertId();
       
       return $genreID;
    }
    
    public function deleteGenre($genreID){
        
        $sqlDelete = "DELETE FROM genre WHERE genreID = :genreID";
        
        $statement = $this->connection->prepare($sqlDelete);
        $params = array (
            "genreID" => $genreID         
        );
        
        $status = $statement->execute($params);
       
        if(!$status) {
            die("Could not delete genre");
        }
        
       return ($statement->rowCount() ==1);
    }
    public function updateGenre($genreID, $genreName, $description){
        $sqlQuery=
                "UPDATE genre SET " .
                "genreName = :genreName, " .
                "description = :description " .
                "WHERE genreID = :genreID";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            
            "genreName" => $genreName,
            "description" => $description,
            "genreID" => $genreID
            
        );
        
        $status = $statement->execute($params);
        
        return($statement->rowCount() ==1);
    }
}
