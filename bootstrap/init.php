<?php

include "constant.php";
include BASE_ROOT . "bootstrap/config.php";
include BASE_ROOT . "libs/lib-helper.php";
include BASE_ROOT . "libs/lib-db.php";

// Connect to db
$conn = connect($dbConfig);

include BASE_ROOT . "libs/lib-folder.php";