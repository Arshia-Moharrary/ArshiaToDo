<?php

include "bootstrap/init.php";

$folders = getFolder(1);

if (isset($_GET["folder"])) {
    $folder = sanitizeInput($_GET["folder"]);
    $undoneTasks = getTask(1, $folder, false);
    $doneTasks = getTask(1, $folder, true);
}

include "tpl/tpl-index.php";