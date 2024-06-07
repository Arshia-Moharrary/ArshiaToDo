<?php

// Check user is logged in or not
function isLogged() {
    if (isset($_SESSION["user"])) {
        return true; /* User is logged in */
    } else {
        return false; /* User not logged in */
    }
}