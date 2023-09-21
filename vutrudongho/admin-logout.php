<?php
    session_start();
    unset($_SESSION['AdminID']);
    unset($_SESSION['FullName']);
    unset($_SESSION['Email']);
    unset($_SESSION['Password']);
    session_destroy();
    header("Location: admin-login.php");
?>