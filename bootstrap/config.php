<?php

// Prevent direct access
isset($access) OR die("Access denied 403");

// Database info
$dbConfig = (object) [
    "rdbms" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "username" => "root",
    "password" => "",
    "databaseName" => "arshiatodo"
];