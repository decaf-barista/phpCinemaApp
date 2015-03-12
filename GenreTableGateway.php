<?php
//N00130270
class GenreTableGateway {
      
    private $connection;
    
    public function __construct($c) {
        $this->connection = $c;
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
    
    public function getGenreByName($genreName) {
        //execue a query to get the genre with the specific genre number
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
        //execue a query to get the genre with the specific genre name
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
        
        $sqlDelete = "DELETE FROM genre WHERE genreName = :genreName";
        
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
                "UPDATE genre SET " .
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
