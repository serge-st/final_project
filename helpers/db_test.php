<?php

class DB {
    private static $connection;
    
    private static function openConnection(){
        $hostname = 'localhost:3306';
        $user = 'roots';
        $password = '';
        $database = 'doit_app_db';
        
        self::$connection = new mysqli($hostname, $user, $password, $database);

        if (self::$connection->connect_errno){
            $error = "Connection error: " . self::$connection->connect_errno . ": " . self::$connection->connect_error;
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
        var_dump(self::$connection);
        var_dump(self::$connection->query($sql));
    }
    // $sql = 'select * from users where user_name="test"';

    // // Handle result:
    // $result = $connection->query($sql);
    // if ($result->num_rows === 0){
    //     echo "No matches found";
    //     exit();
    // }

    // var_dump($result->fetch_all());


    
}

// DB::openConnection();

DB::run('select * from users where user_name="tests"');




// // Querry:
// $sql = 'select * from users where user_name="test"';

// // Handle result:
// $result = $connection->query($sql);
// if ($result->num_rows === 0){
//     echo "No matches found";
//     exit();
// }

// var_dump($result->fetch_all());



