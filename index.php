<?php

include "bootstrap/init.php";


// Check user is logged in
if (!(isLogged())) {
    $user = false;
} else {
    $user = getRecords("*", "users", "id", $_SESSION["user"])[0];
}

if ($user) {
    $folders = getFolder($_SESSION["user"]);

    if (isset($_GET["folder"])) {
        $folder = sanitizeInput($_GET["folder"]);
        $undoneTasks = getTask($_SESSION["user"], $folder, false);
        $doneTasks = getTask($_SESSION["user"], $folder, true);
    }
}


include "tpl/tpl-index.php";
