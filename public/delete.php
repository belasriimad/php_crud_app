<?php
    require_once('../database/database.php');

    if (!$_GET['id']) {
        header('Location:index.php');
    }

    $task_id = $_GET['id'];

    // construct the delete statement
    $sql = 'DELETE FROM tasks WHERE id = :task_id';

    // prepare the statement for execution
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);

    // execute the statement
    if ($stmt->execute()) {
        header('Location:index.php');
    }

?>