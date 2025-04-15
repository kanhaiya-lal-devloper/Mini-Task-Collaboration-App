<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = $_POST['id'];
    $title = htmlspecialchars(trim($_POST['title']));
    $deadline = $_POST['deadline'];
    $priority = $_POST['priority'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("UPDATE tasks SET title = ?, deadline = ?, priority = ? WHERE id = ? AND user_id = ?");
    if ($stmt->execute([$title, $deadline, $priority, $task_id, $user_id])) {
        echo 'success';
    } else {
        echo 'error';
    }
}
