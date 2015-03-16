<?php
//N00130270
class movieTableGateway {
      
    private $connection;
    
    public function __construct($c) {
        $this->connection = $c;
    }
    
    public function getMovies() {
        //executes a query to get all of the movies
        $sqlQuery = "SELECT m.*,g.genreName FROM movie m
        LEFT JOIN genre g ON g.genreID = m.genre";
        
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();
        
        if(!$status) {
            die("Could not retrieve movies");
        }
        
        return $statement;
                
    }
    
    public function getMovieById($movieID) {
        //execue a query to get the movie with the specific movie number
        $sqlQuery = "SELECT m.*,g.genreName FROM movie m
        LEFT JOIN genre g ON g.genreID = m.genre WHERE movieID = :movieID";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "movieID" => $movieID
        );
       $status = $statement->execute($params); 
       
       if(!$status) {
           die("Could not retrieve movie");
       }
       
       return $statement;
    }
    public function insertMovie($title, $movieYear, $runTime, $classification, $directorFName, $directorLName, $genre) {
        $sqlInsert = "INSERT movie(title, movieYear, runTime, classification, directorFName, directorLName, genre) "
            . "VALUES (:title, :movieYear, :runTime, :classification, :directorFName, :directorLName, :genre)";
        
        $statement = $this->connection->prepare($sqlInsert);
        $params = array(
            "title" => $title,
            "movieYear" => $movieYear,
            "runTime"=>$runTime,
            "classification"=>$classification,
            "directorFName"=>$directorFName,
            "directorLName"=>$directorLName,
            "genre"=>$genre
        );
       $status = $statement->execute($params); 
       
       if(!$status) {
           die("Could not insert new movie");
       }
       $movieID = $this->connection->lastInsertId();
       
       return $movieID;
    }
    
    public function deleteMovie($movieID){
        
        $sqlDelete = "DELETE FROM movie WHERE movieID = :movieID";
        
        $statement = $this->connection->prepare($sqlDelete);
        $params = array (
            "movieID" => $movieID         
        );
        
        $status = $statement->execute($params);
       
        if(!$status) {
            die("Could not delete movie");
        }
        
       return ($statement->rowCount() ==1);
    }
    public function updateMovie($id, $t, $my, $rt, $c, $dfn, $dln, $g){
        $sqlQuery=
                "UPDATE movie SET " . 
                "title = :title, " . 
                "movieYear = :movieYear, " .
                "runTime = :runTime, " . 
                "classification = :classification, " . 
                "directorFName = :directorFName, " .
                "directorLName = :directorLName, " .
                "genre = :genre " .
                "WHERE movieID = :movieID";
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "movieID"=> $id,
            "title" => $t,
            "movieYear" => $my,
            "runTime"=> $rt,
            "classification"=> $c,
            "directorFName"=> $dfn,
            "directorLName"=> $dln,
            "genre"=> $g  
        );
        
        $status = $statement->execute($params);
        
        if(!$status) {
           die("Could not insert new movie");
       }
        
        return($statement->rowCount() == 1);
    }
}
