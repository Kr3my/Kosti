<?php
session_start();

if(isset($_SESSION["user"])) {
    header("Location: src/panel.php");
    exit;
}

header("Location: src/login.html");
?>