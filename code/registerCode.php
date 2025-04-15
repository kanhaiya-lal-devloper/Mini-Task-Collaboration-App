<?php
require_once '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    // $role     = $_POST['type']; 

    if (empty($name) || empty($email) || empty($password)) 
    {
        echo "All fields are required.";
    } 
    else 
    {
       
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $success = $stmt->execute([$name, $email, $hashed_password]);

        if ($success) {
            header('Location:../index.php');
        } else {
            echo "Error registering user.";
        }
    }
}
?>
