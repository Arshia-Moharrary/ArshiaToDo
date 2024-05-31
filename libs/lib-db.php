<?php

// Connect to database with pdo
function connect($config) {
    try {
        $conn = new PDO("{$config->rdbms}:host={$config->host}:{$config->port};dbname={$config->databaseName}", $config->username, $config->password);

        # success("Connection is successfully\n");
        return $conn;
    } catch (PDOException $e) {
        dieError("Connection failed: {$e->getMessage()}");
    }
}