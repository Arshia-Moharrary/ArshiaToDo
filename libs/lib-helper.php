<?php

// Return a error message
function error($message) {
    echo "<div class='danger'>" . $message . "<i class='fa fa-times close'></i></div>";
}

// Die and return a error message
function dieError($message) {
    echo "<div class='danger'>" . $message . "</div>";
    die();
}

// Return a success message
function success($message) {
    echo "<div class='success'>" . $message . "<i class='fa fa-times close'></i></div>";
}

// Sanitize input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check request
function getRequestMethod() {
    switch($_SERVER["REQUEST_METHOD"]) {
        case "POST":
            return "post";
            break;
        case "GET":
            return "get";
            break;
        default:
            return "undefined";
    }
}

// Check request is ajax
function isAjax() {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    }

    return false;
}

// Return data of database
/* 
This function receives the information of an element from the database and returns it.
To use this function, pass the column whose information you want to receive as the first parameter,
and the table from which you want to retrieve the information as the second parameter, and the column that you want to retrieve information from.
If you want to search for the element according to it, pass it in the third parameter and its value in the fourth parameter
*/
function getRecords($requestedColumn, $table, $searchedColumn, $value) {
    global $conn;

    try {
        $sql = "SELECT {$requestedColumn} FROM {$table} WHERE {$searchedColumn} = '{$value}'";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);
        $record = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $record;
    } catch (PDOException $e) {
        echo "Couldn't find id: {$e->getMessage()}";
    }
}