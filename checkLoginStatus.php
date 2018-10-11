<?php
    session_start();

    if (isset($_SESSION['userinfo'])) {
        $userinfo = $_SESSION['userinfo'];
    } else {
        header('Location: homepage.php');
    }
?>