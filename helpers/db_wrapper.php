<?php

class DB {
    private static $hostname;
    private static $user;
    private static $password;
    private static $database;

    private static $mysqli = new mysqli($hostname, $user, $password, $database);
    
    
}