<?php

include "bootstrap/init.php";

// Delete operation
if (isset($_GET["delete_folder_id"])) {
    
    $id = sanitizeInput($_GET["delete_folder_id"]);
    
    // Execute delete operation
    $result = removeFolder($id);

    if (!($result)) {
        error("Your folder is not exist!");
    }
}

$folders = getFolder(1);

include "tpl/tpl-index.php";
