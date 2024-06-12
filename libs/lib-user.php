<?php

// Check user is logged in or not
function isLogged() {
    if (isset($_SESSION["user"])) {
        return true; /* User is logged in */
    } else {
        return false; /* User not logged in */
    }
}

// Register user
function register($firstName, $lastName, $email, $password) {
    global $conn;

    $hashPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        $sql = "INSERT INTO users (first_name, last_name, password, email) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$firstName, $lastName, $hashPassword, $email]);
        $id = $conn->lastInsertId();

        // If the value of count is greater than one, it means that the task has been undoned, true is returned, otherwise false is returned
        if ($id) {
            $_SESSION["user"] = $conn->lastInsertId();
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        dieError("Failed to register user: {$e->getMessage()}");
    }
}

// Login user
function login($email) {
    global $conn;

    // Give user id
    $user = getRecords("id", "users", "email", $email)[0];

    // Set session
    if ($_SESSION["user"] = $user->id) {
        return true;
    } else {
        return false;
    }
}

// Validate user data (register)
function validateRegister($firstName, $lastName, $email, $password) {
    // Error container
    $errorMessage = [];

    /* Empty validation */

    // Continue to validation if input not empty
    $continue = true;

    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        $errorMessage[] = "Please enter all inputs (inputs can't be empty)";
        $continue = false;
    }

    if ($continue) {
        /* Content validation */

        // First name
        if (!(preg_match("/^[a-zA-Z]+(?:[\s'-][a-zA-Z]+)*$/", $firstName))) {
            $errorMessage[] = "Your first name is invalid";
        }

        // Last name
        if (!(preg_match("/^[a-zA-Z]+(?:[\s'-][a-zA-Z]+)*$/", $lastName))) {
            $errorMessage[] = "Your last name is invalid";
        }

        // Email
        if (!(preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email))) {
            $errorMessage[] = "Your email is invalid";
        }

        // Password don't require

        /* Length validation */

        /* Large */

        // First name
        if (strlen($firstName) > 36) {
            $errorMessage[] = "Your first name is too large";
        }

        // Last name
        if (strlen($lastName) > 36) {
            $errorMessage[] = "Your last name is too large";
        }

        // Email
        if (strlen($email) > 256) {
            $errorMessage[] = "Your email is too large";
        }

        // Password
        if (strlen($password) > 256) {
            $errorMessage[] = "Your password is too large";
        }

        /* Small */

        // First name
        if (strlen($firstName) < 3) {
            $errorMessage[] = "Your first name is too small";
        }

        // Last name
        if (strlen($lastName) < 3) {
            $errorMessage[] = "Your last name is too small";
        }

        // Email
        if (strlen($email) < 8) {
            $errorMessage[] = "Your email is too small";
        }

        // Password
        if (strlen($password) < 8) {
            $errorMessage[] = "Your password is too small";
        }

        /* Check email is exist */

        $dbEmail = getRecords("email", "users", "email", $email);
        if ($dbEmail) {
            $errorMessage[] = "Your email is exist (Please login)";
        }
    }

    return $errorMessage;
}

function validateLogin($email, $password) {
    // Error container
    $errorMessage = [];

    /* Empty validation */

    // Continue to validation if input not empty
    $continue = true;

    if (empty($email) || empty($password)) {
        $errorMessage[] = "Please enter all inputs (inputs can't be empty)";
        $continue = false;
    }

    if ($continue) {
        /* Content validation */

        // Email
        if (!(preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email))) {
            $errorMessage[] = "Your email is invalid";
        }

        // Password don't require

        /* Length validation */

        /* Large */

        // Email
        if (strlen($email) > 256) {
            $errorMessage[] = "Your email is too large";
        }

        // Password
        if (strlen($password) > 256) {
            $errorMessage[] = "Your password is too large";
        }

        /* Small */
        
        // Email
        if (strlen($email) < 8) {
            $errorMessage[] = "Your email is too small";
        }

        // Password
        if (strlen($password) < 8) {
            $errorMessage[] = "Your password is too small";
        }

        /* Check password is correct and email is exist */

        $dbEmail = getRecords("email", "users", "email", $email);
        $dbPassword = getRecords("password", "users", "email", $email);

        if (!($dbEmail)) {
            $errorMessage[] = "Your password or email is incorrect";
        } else {
            if (!(password_verify($password, $dbPassword[0]->password))) {
                $errorMessage[] = "Your password or email is incorrect";
            }
        }
    }

    return $errorMessage;
}