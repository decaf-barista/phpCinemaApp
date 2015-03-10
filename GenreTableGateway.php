<?php
//N00130270
class GenreTableGateway {
      
    private $connection;
    
    public function __construct($c) {
        $this->connection = $c;
    }
    
    public function getGenres() {
        //executes a query to get all of the screens
        $sqlQuery = "SELECT * FROM genre";
        
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();
        
        if(!$status) {
            die("Could not retrieve genres");
        }
        
        return $statement;
                
    }
    
    public function getGenreById($genreID) {
        //execue a query to get the screen with the specific screen number
        $sqlQuery = "SELECT * FROM genre WHERE genreName = :genreName";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "genreName" => $genreName
        );
       $status = $statement->execute($params); 
       
       if(!$status) {
           die("Could not retrieve genre");
       }
       
       return $statement;
    }
    public function insertGenre($genreName, $description) {
        //execue a query to get the screen with the specific screen number
        $sqlInsert = "INSERT genre(genreName,description ) "
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
       return $statement;
    }
    
    public function deleteGenre($genreName){
        
        $sqlDelete = "DELETE FROM screen WHERE genreName = :genreName";
        
        $statement = $this->connection->prepare($sqlDelete);
        $params = array (
            "genreName" => $genreName         
        );
        
        $status = $statement->execute($params);
       
        if(!$status) {
            die("Could not delete genre");
        }
        
       return ($statement->rowCount() ==1);
    }
    public function updateGenre($genreName, $description){
        $sqlQuery=
                "UPDATE screen SET " .
                "genreName = :genreName, " .
                "description = :description " .
                "WHERE genreName = :genreName";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            
            "genreName" => $genreName,
            "description" => $description
            
        );
        
        $status = $statement->execute($params);
        
        return($statement->rowCount() ==1);
    }
}
