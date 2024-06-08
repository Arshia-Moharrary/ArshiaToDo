<?php

// Prevent direct access
isset($access) OR die("Access denied 403");

// Give folder
function getFolder($userID) {
    global $conn; 

    // Insert operation
    try {
        $sql = "SELECT * FROM folders WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userID]);
        $folders = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $folders;
    } catch (PDOException $e) {
        dieError("Failed to get folders: {$e->getMessage()}");
    }
}

// Delete folder
function removeFolder($folderID) {
    global $conn;
    $result = false;

    // Delete folder operation
    try {
        $sql = "DELETE FROM folders WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$folderID]);
        $count = $stmt->rowCount();

        // If the value of count is greater than one, it means that the folder has been deleted, true is returned, otherwise false is returned
        if ($count) {
            $result = true;
        } else {
            $result = false;
        }
    } catch (PDOException $e) {
        dieError("Failed to delete folder: {$e->getMessage()}");
    }

    // Delete related tasks operation
    try {
        $sql = "DELETE FROM tasks WHERE folder_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$folderID]);
        $count = $stmt->rowCount();

    } catch (PDOException $e) {
        dieError("Failed to delete related tasks: {$e->getMessage()}");
    }

    return $result;
}

// Create folder
function addFolder($title, $userID) {
    global $conn;

    // Create operation
    try {
        $sql = "INSERT INTO folders (title, user_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$title, $userID]);
        $id = $conn->lastInsertId();

        return $id;
    } catch (PDOException $e) {
        dieError("Failed to create folder: {$e->getMessage()}");
    }
}