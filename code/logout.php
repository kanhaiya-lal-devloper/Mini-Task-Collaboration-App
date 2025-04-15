<?php
session_start();


$_SESSION = [];


session_destroy();


header("Location: ../index.php?msg=3");
exit();
