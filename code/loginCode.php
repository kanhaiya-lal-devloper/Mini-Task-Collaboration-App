<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars(trim($_POST['userid']));
    $password = trim($_POST['password']);
    
    if (empty($email) || empty($password)) {
        header('Location: ../index.php?msg=1');
        exit();
    } 
    else 
    {
        $stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = ? ");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 1) {
                header("Location: ../admin/dashboard.php");
            } 
            else 
            {
                header("Location: ../task.php");
            }
            exit();

        } 
        else {

            header("Location: ../index.php?msg=2");
            exit();
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
