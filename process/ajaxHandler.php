<?php

include "../bootstrap/init.php";

// Check request method and is ajax
if (!(getRequestMethod() == "post" && isAjax())) {
    echo dieError("Your request is invalid");
}

// Check action is set
if (isset($_POST["action"]) && !empty($_POST["action"])) {
    $action = sanitizeInput($_POST["action"]);
} else {
    echo "Action isn't set or empty";
}

/* Folder operations */

// Add folder operation
if ($action == "addFolder") {
    $title = sanitizeInput($_POST["title"]);
    $id = addFolder($title, $_SESSION["user"]);

    // Return response to the client

    // Give folder info and build html tag
    echo "<li> <a href='?folder={$id}' class='folder'> <i class='fa fa-folder'></i>" . ucfirst($title) . " </a> <i class='fa fa-trash-o remove delete-folder' data-id='{$id}' onclick='deleteFolder(this)'></i> </li>";
}

// Delete folder operation
if ($action == "deleteFolder") {
    $id = sanitizeInput($_POST["id"]);
    if (removeFolder($id)) {
        echo 1; /* 1 means true */
    } else {
        echo 0; /* 0 means false */
    }
}

/* Task operations */

// Delete task operation
if ($action == "deleteTask") {
    $id = sanitizeInput($_POST["id"]);
    if (removeTask($id)) {
        echo 1; /* 1 means true */
    } else {
        echo 0; /* 0 means false */
    }
}

// Add task operation
if ($action == "addTask") {
    $title = sanitizeInput($_POST["title"]);
    $folder = sanitizeInput($_POST["folder"]);
    addTask($title, $_SESSION["user"], $folder);

    // Return response to the client

    // Give folder info and build html tag
    $result = getRecords("id, title, created_at", "tasks", "title", $title);
    $task = $result[0];

    echo "<li class='task' data-id='{$task->id}' onclick='selectTask(this)'><i class='fa fa-square-o done' onclick='done(this)'></i><span>{$task->title}</span><div class='info'><span>Created by {$task->created_at}</span></div></li>";
}

// Done task operation
if ($action == "doneTask") {
    $id = sanitizeInput($_POST["id"]);

    // Return response to the client
    if (doneTask($id)) {
        echo 1; /* 1 means true */
    } else {
        echo 0; /* 0 means false */
    }
}

// Done task operation
if ($action == "undoneTask") {
    $id = sanitizeInput($_POST["id"]);

    // Return response to the client
    if (undoneTask($id)) {
        echo 1; /* 1 means true */
    } else {
        echo 0; /* 0 means false */
    }
}

/* User operations */

// Register user
if ($action == "registerUser") {
    // Check user is logged
    if (isLogged()) {
        echo "User is logged";
        die();
    }

    $firstName = sanitizeInput($_POST["firstName"]);
    $lastName = sanitizeInput($_POST["lastName"]);
    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["password"]);

    // Validation
    $errors = validateRegister($firstName, $lastName, $email, $password);

    if (count($errors)) {
        foreach ($errors as $error) {
            error($error);
            echo "<br>";
        }
    } else {
        $result = register($firstName, $lastName, $email, $password);

        // Return response to the client
        if ($result) {
            echo 1; /* 1 means true */
        } else {
            echo 0; /* 0 means false */
        }
    }
}

// Login user
if ($action == "loginUser") {
    // Check user is logged
    if (isLogged()) {
        echo "User is logged";
        die();
    }

    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["password"]);

    // Validation
    $errors = validateLogin($email, $password);

    if (count($errors)) {
        foreach ($errors as $error) {
            error($error);
            echo "<br>";
        }
    } else {
        $result = login($email, $password);

        // Return response to the client
        if ($result) {
            echo 1; /* 1 means true */
        } else {
            echo 0; /* 0 means false */
        }
    }
}

// Logout user
if ($action == "logoutUser") {
    session_destroy();
}
