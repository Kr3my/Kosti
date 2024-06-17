<?php
if($_SERVER["REQUEST_METHOD"] == "GET") {
    session_start();

    $_SESSION["user"] = $_GET["user"];

    header("Location: ../src/panel.html");
}
?>