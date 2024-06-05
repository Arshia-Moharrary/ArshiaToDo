<?php

include "bootstrap/init.php";

$folders = getFolder(1);
$undoneTasks = getTask(1, false);
$doneTasks = getTask(1, true);

include "tpl/tpl-index.php";