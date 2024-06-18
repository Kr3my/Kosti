<?php
if($_SERVER["REQUEST_METHOD"] == "GET") {
    session_start();
    session_destroy();

    header("Location: ../index.php");
}
?>