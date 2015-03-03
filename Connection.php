<?php
//N00132070
class Connection {
    private static $connection = NULL;
    
    public static function getInstance(){
        if(Connection::$connection===NULL){
            //connect to database
            $host = "daneel";
            $database = "n00130270";
            $username = "N00130270";
            $password = "N00130270";
            
            $dsn = "mysql:host=" . $host . ";dbname=" . $database;
            Connection::$connection = new PDO($dsn, $username, $password);
            if(!Connection::$connection){
                die("could not connect to database");
            }
        }
        return Connection::$connection;
    }
}
