<?php
session_start();
require_once '../includes/db.php';


if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header("Location: ../index.php");
    exit;
}


if (isset($_GET['task_id']) && isset($_GET['user_id'])) {
    $task_id = $_GET['task_id'];
    $user_id = $_GET['user_id'];

    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->execute([$task_id]);

    header("Location: idTask.php?user_id=$user_id");
    exit;
} 
else 
{
    header("Location: idTask.php?msg=InvalidTaskID");
    exit;
}
