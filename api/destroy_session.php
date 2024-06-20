<?php
if($_SERVER["REQUEST_METHOD"] == "GET") {
    session_start();
    session_destroy();

    setcookie("user_id", "", time() - 3600, "/");
    setcookie("board_id", "", time() - 3600, "/");

    header("Location: ../index.php");
}
?>