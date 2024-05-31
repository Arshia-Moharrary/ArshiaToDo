<?php

include "bootstrap/init.php";

// Delete operation
if (isset($_GET["delete_folder_id"])) {
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $id = sanitize_input($_GET["delete_folder_id"]);
    
    // Execute delete operation
    $result = removeFolder($id);

    if (!($result)) {
        error("Your folder is not exist!");
    }
}

$folders = getFolder("current");

include "tpl/tpl-index.php";
