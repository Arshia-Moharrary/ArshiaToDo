<?php

// Give root folder name
$rootName = explode("\\", dirname(__FILE__));

define("PROJECT_NAME", $rootName[count($rootName) - 2]); /* The value of this constant must be equal to the name of the root directory */

define("WEB_TITLE", "ArshiaToDo Task manager | Manage your tasks");
define("BASE_URL", "http://" . $_SERVER['SERVER_NAME'] . "/" . PROJECT_NAME . "/");
define("BASE_ROOT", $_SERVER["DOCUMENT_ROOT"] . "/" . PROJECT_NAME . "/");

$access = true;
