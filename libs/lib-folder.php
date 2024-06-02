<?php

// Give folder
function getFolder($user_id) {
    global $conn;

    // Specify user id
    switch ($user_id) {
        case "current":
            $user_id = 1;
            break;
        default:
            $user_id = $user_id;
    }

    // Insert operation
    try {
        $sql = "SELECT * FROM folders WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id]);
        $folders = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $folders;
    } catch (PDOException $e) {
        dieError("Failed to get folders: {$e->getMessage()}");
    }
}

// Delete folder
function removeFolder($folder_id) {
    global $conn;

    // Delete operation
    try {
        $sql = "DELETE FROM folders WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$folder_id]);
        $count = $stmt->rowCount();

        // If the value of count is greater than one, it means that the folder has been deleted, true is returned, otherwise false is returned
        if ($count) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        dieError("Failed to delete folder: {$e->getMessage()}");
    }
}

// Create folder
function addFolder($title) {
    global $conn;

    // Create operation
    try {
        $sql = "INSERT INTO folders (title, user_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$title, 1]);
        $count = $stmt->rowCount();

        // If the value of count is greater than one, it means that the folder has been created, true is returned, otherwise false is returned
        if ($count) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        dieError("Failed to create folder: {$e->getMessage()}");
    }
}