<?php

// Prevent direct access
isset($access) OR die("Access denied 403");

// Give task
function getTask($userID, $folderID, bool $is_done) {
    global $conn;

    // Select operation
    try {
        $sql = "SELECT * FROM tasks WHERE user_id = ? AND is_done = ? AND folder_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userID, $is_done, $folderID]);
        $tasks = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $tasks;
    } catch (PDOException $e) {
        dieError("Failed to get tasks: {$e->getMessage()}");
    }
}

// Delete task
function removeTask($taskID) {
    global $conn;

    // Delete operation
    try {
        $sql = "DELETE FROM tasks WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$taskID]);
        $count = $stmt->rowCount();

        // If the value of count is greater than one, it means that the task has been deleted, true is returned, otherwise false is returned
        if ($count) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        dieError("Failed to delete task: {$e->getMessage()}");
    }
}

// Create task
function addTask($title, $userID, $folderID) {
    global $conn;

    // Create operation
    try {
        $sql = "INSERT INTO tasks (title, user_id, folder_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$title, $userID, $folderID]);
        $count = $stmt->rowCount();

        // If the value of count is greater than one, it means that the task has been created, true is returned, otherwise false is returned
        if ($count) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        dieError("Failed to create task: {$e->getMessage()}");
    }
}

// Done task
function doneTask($taskID) {
    global $conn;

    try {
        $sql = "UPDATE tasks SET is_done = 1, doned_at = NOW() WHERE id = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$taskID]);
        $count = $stmt->rowCount();

        // If the value of count is greater than one, it means that the task has been doned, true is returned, otherwise false is returned
        if ($count) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        dieError("Failed to done task: {$e->getMessage()}");
    }
}

// Undone task
function undoneTask($taskID) {
    global $conn;

    try {
        $sql = "UPDATE tasks SET is_done = 0, doned_at = NULL WHERE id = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$taskID]);
        $count = $stmt->rowCount();

        // If the value of count is greater than one, it means that the task has been undoned, true is returned, otherwise false is returned
        if ($count) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        dieError("Failed to undone task: {$e->getMessage()}");
    }
}