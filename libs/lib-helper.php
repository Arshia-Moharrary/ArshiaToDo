<?php

// Return a error message
function error($message) {
    echo "<div class='danger'>" . $message . "</div>";
}

// Die and return a error message
function dieError($message) {
    echo "<div class='danger'>" . $message . "</div>";
    die();
}

// Return a success message
function success($message) {
    echo "<div class='success'>" . $message . "</div>";
}