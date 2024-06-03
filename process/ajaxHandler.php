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

// Add folder operation
if ($action == "addFolder") {
    $title = sanitizeInput($_POST["title"]);
    addFolder($title);

    // Return response to the client

    // Give folder info and build html tag
    $result = getRecords("id, title", "folders", "title", $title);
    $folder = $result[0];

    echo "<li><i class='fa fa-folder'></i>" . ucfirst($folder->title) . "<i class='fa fa-trash-o remove delete-folder' data-id='{$folder->id}' onclick='deleteFolder(this)'></i></li>";
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