<?php
session_start();
require_once '../includes/db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = htmlspecialchars(trim($_POST['title']));
    $deadline = $_POST['deadline'];
    $priority = $_POST['priority'];
    $user_id = $_SESSION['user_id'];  

    
    if (empty($title) || empty($deadline) || empty($priority)) 
    {
        echo 'Please fill in all fields.';
        exit();
    }


    $stmt = $conn->prepare("INSERT INTO tasks (user_id, title, deadline, priority, status) VALUES (?, ?, ?, ?, ?)");
    $status = 'pending'; // Default status
    $stmt->execute([$user_id, $title, $deadline, $priority, $status]);

  
    if ($stmt) {
        echo 'Task added successfully!';
    } else {
        echo 'Error adding task. Please try again.';
    }
}
?>
