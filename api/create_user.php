<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = isset($_POST["user"]) ? $_POST["user"] : '';
    $pwd = isset($_POST["pwd"]) ? $_POST["pwd"] : '';

    if (empty($user) || empty($pwd)) {
        die("No se a proporcionado un usuario o contraseña.");
    }

    $connection = mysqli_connect("localhost", "user", "password", "osu");

    if (!$connection) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $user_escaped = mysqli_real_escape_string($connection, $user);
    $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

    $query = "INSERT INTO `usuarios` (username, pwd) VALUES ('$user_escaped', '$hashed_pwd')";

    if (mysqli_query($connection, $query)) {
        echo "Success";
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    mysqli_close($connection);
}

header("Location: ../src/panel.php");
?>
