<?php
//N00130270
class ReviewTableGateway {
      
    private $connection;
    
    public function __construct($c) {
        $this->connection = $c;
    }
    
     public function countReviews() {
         //this function counts the rows in my table
        $sqlQuery = "SELECT COUNT(*) FROM review;";
                
        $reviewStatement = $this->connection->prepare($sqlQuery);
        $status = $reviewStatement->execute();
        
        if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
            die("Could not retrieve reviews");
        }
        
        return $reviewStatement;       
    }
    
    public function getReviews($sortOrder) {
        //executes a query to get all of the reviews
        $sqlQuery = "SELECT r.*,m.title FROM review r LEFT JOIN movie m ON m.movieID = r.movieID "
                . "ORDER BY " . $sortOrder;//also has sortOrder that has a value of reviewID, if sortOrder doe not have a value then an error occurs
        //left join to movie table and displays movie title
        
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();
        
        if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
            die("Could not retrieve reviews");
        }
        
        return $statement;
                
    }
    
    public function getReviewById($reviewID) {
        //execue a query to get the review with the specific review number
        $sqlQuery = "SELECT r.*,m.title FROM review r LEFT JOIN movie m ON m.movieID = r.movieID"
                . " WHERE reviewID = :reviewID";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(//defining the place holders
            "reviewID" => $reviewID
        );
       $status = $statement->execute($params); 
       
       if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
           die("Could not retrieve review");
       }
       
       return $statement;
    }
    
    public function insertReview($movieID, $rating, $reviewContent) {
        $sqlInsert = "INSERT review(movieID, rating, reviewContent) "
            . "VALUES (:movieID, :rating, :reviewContent)";
        
        $statement = $this->connection->prepare($sqlInsert);
        $params = array(//defining the place holders
            "movieID" => $movieID,
            "rating" => $rating,
            "reviewContent"=>$reviewContent
        );
       $status = $statement->execute($params); 
       
       if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
           die("Could not insert new review");
       }
       $reviewID = $this->connection->lastInsertId();
       
       return $reviewID;
    }
    
    public function deleteReview($reviewID){
        
        $sqlDelete = "DELETE FROM review WHERE reviewID = :reviewID";
        
        $statement = $this->connection->prepare($sqlDelete);
        $params = array (//defining the place holders
            "reviewID" => $reviewID         
        );
        
        $status = $statement->execute($params);
       
        if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
            die("Could not delete review");
        }
        
       return ($statement->rowCount() ==1);
    }
    public function updateReview($id, $mID, $r, $rc){
        $sqlQuery=
                "UPDATE review SET " . 
                "movieID = :movieID, " . 
                "rating = :rating, " .
                "reviewContent = :reviewContent " . 
                "WHERE reviewID = :reviewID";
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(//defining the place holders
            "reviewID"=> $id,
            "movieID" => $mID,
            "rating" => $r,
            "reviewContent"=> $rc
        );
        
        $status = $statement->execute($params);
        
        if(!$status) {//error message. if there is something wrong with the values going into table then shows specific error. if only this error message then something wrong with SQL
           die("Could not update review");
       }
        
        return($statement->rowCount() == 1);
    }
}