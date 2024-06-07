<?php

include "bootstrap/init.php";

$dbPassword = getRecords("password", "users", "email", "arshiabd1388@gmail.com");
$dbEmail = getRecords("email", "users", "email", "arshiabd1388@gmail.coms");

print_r($dbPassword);
print_r($dbEmail);