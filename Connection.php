<?php
//N00132070
class Connection {
    private static $connection = NULL;
    
    public static function getInstance(){
        if(Connection::$connection===NULL){
            //connect to database
            $host = "localhost";
            $database = "amy";
            $username = "root";
            $password = "";
            
            $dsn = "mysql:host=" . $host . ";dbname=" . $database;
            Connection::$connection = new PDO($dsn, $username, $password);
            if(!Connection::$connection){
                die("could not connect to database");
            }
        }
        return Connection::$connection;
    }
}
