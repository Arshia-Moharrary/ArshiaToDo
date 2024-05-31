<?php

include "constant.php";
include "config.php";
include "libs/lib-front.php";
include "libs/lib-helper.php";
include "libs/lib-db.php";

// Connect to db
$conn = connect($dbConfig);

include "libs/lib-folder.php";
