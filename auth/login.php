<?php

include "../bootstrap/init.php";

// Check user is logged
if (isLogged()) {
    redirect(BASE_URL);
    die();
}

// Include template
include "../tpl/tpl-login.php";