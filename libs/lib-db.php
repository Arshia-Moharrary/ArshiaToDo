<?php

// Connect to database with pdo
function connect($config) {
    try {
        $conn = new PDO("{$config->rdbms}:host={$config->host}:{$config->port};dbname={$config->databaseName}", $config->username, $config->password);

        # success("Connection is successfully\n");
        return $conn;
    } catch (PDOException $e) {
        echo '<link rel="stylesheet" href="' . BASE_URL . 'assets/css/style.css">';
        dieError("Connection to the database failed: {$e->getMessage()}");
    }
}