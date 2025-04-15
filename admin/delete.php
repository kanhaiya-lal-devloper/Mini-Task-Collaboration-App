<?php
session_start();
require_once '../includes/db.php';


if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header("Location: ../index.php");
    exit;
}


if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];

    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->execute([$task_id]);

    header("Location: alltask.php?msg=TaskDeleted");
    exit;
} 
else 
{
    header("Location: alltask.php?msg=InvalidTaskID");
    exit;
}
