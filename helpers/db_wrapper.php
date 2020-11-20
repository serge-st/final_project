<?php

class DB {
    private static $connection;
    
    private static function openConnection(){
        $hostname = 'localhost:3306';
        $user = 'root';
        $password = '';
        $database = 'doit_app_db';
        
        self::$connection = new mysqli($hostname, $user, $password, $database);

        if (self::$connection->connect_errno){
            $error = "Connection Error: " . self::$connection->connect_errno . ": " . self::$connection->connect_error;
            self::closeConnection();
            exit($error);
        }
    }

    private static function closeConnection(){
        self::$connection->close();
        self::$connection = null;
    }

    public static function run($sql){
        if (self::$connection === null){
            self::openConnection();
        }

        $response = self::$connection->query($sql);

        if (self::$connection->error){
            $error = self::$connection->error;
            self::closeConnection();
            exit("SQL Error: " . $error);
        }

        self::closeConnection();
        return $response;
    }    
}