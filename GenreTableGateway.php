<?php
//N00130270
class GenreTableGateway {
      
    private $connection;
    
    public function __construct($c) {
        $this->connection = $c;
    }
    
    public function countGenres() {
        //this function counts the rows in my table
        $sqlQuery = "SELECT COUNT(*) FROM genre;";
                
        $genreStatement = $this->connection->prepare($sqlQuery);
        $status = $genreStatement->execute();
        
        if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
            die("Could not retrieve genres");
        }
        
        return $genreStatement;       
    }
    
    public function getGenres($sortOrder) {
        //
        //executes a query to get all of the genres
        $sqlQuery = "SELECT * FROM genre "
                . "ORDER BY " . $sortOrder;//also has sortOrder that has a value of genreID
        
        $statement = $this->connection->prepare($sqlQuery);
                
        $status = $statement->execute();
        
        if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
            die("Could not retrieve genres");
        }
        
        return $statement;
                
    }
    
    public function getGenreByID($genreID) {
        //execue a query to get the genre with the specific genre number
        $sqlQuery = "SELECT * FROM genre WHERE genreID = :genreID";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(//defining the place holders
            "genreID" => $genreID
        );
       $status = $statement->execute($params); 
       
       if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
           die("Could not retrieve genre");
       }
       
       return $statement;
    }
    public function insertGenre($genreName, $description) {
        //execue a query to get the genre with the specific genre name
        $sqlInsert = "INSERT genre(genreName,description) "
            . "VALUES (:genreName, :description)";
        
        $statement = $this->connection->prepare($sqlInsert);
        $params = array(//defining the place holders
            "genreName" => $genreName,
            "description" => $description
        );
       $status = $statement->execute($params); 
       
       if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
           die("Could not insert new genre");
       }
       $genreID = $this->connection->lastInsertId();
       
       return $genreID;
    }
    
    public function deleteGenre($genreID){
        
        $sqlDelete = "DELETE FROM genre WHERE genreID = :genreID";
        
        $statement = $this->connection->prepare($sqlDelete);
        $params = array (//defining the place holders
            "genreID" => $genreID         
        );
        
        $status = $statement->execute($params);
       
        if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
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
        $params = array(//defining the place holders
            
            "genreName" => $genreName,
            "description" => $description,
            "genreID" => $genreID
            
        );
        
        $status = $statement->execute($params);
        
        if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
           die("Could not update genre");
       }
        
        return($statement->rowCount() == 1);
    }
}
