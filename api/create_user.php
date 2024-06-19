<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = isset($_POST["user"]) ? $_POST["user"] : '';
    $pwd = isset($_POST["pwd"]) ? $_POST["pwd"] : '';

    if (empty($user) || empty($pwd)) {
        die("No se ha proporcionado un usuario o contraseña.");
    }

    $connection = mysqli_connect("localhost", "user", "password", "osu");

    if (!$connection) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $user_escaped = mysqli_real_escape_string($connection, $user);
    $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
    $insert_user_query = "INSERT INTO `usuarios` (username, pwd) VALUES ('$user_escaped', '$hashed_pwd')";

    if (mysqli_query($connection, $insert_user_query)) {
        $user_id = mysqli_insert_id($connection);
        $insert_board_query = "INSERT INTO `tableros` (id_usuario, nombre) VALUES ('$user_id', 'Tablero principal')";

        setcookie("user_id", $user_id, time() + (86400 * 30), "/");

        if (mysqli_query($connection, $insert_board_query)) {
            $board_id = mysqli_insert_id($connection);
            $insert_list_query = "INSERT INTO `listas` (id_tablero, nombre) VALUES ('$board_id', 'Lista principal')";

            setcookie("board_id", $user_id, time() + (86400 * 30), "/");

            if (mysqli_query($connection, $insert_list_query)) {
                $list_id = mysqli_insert_id($connection);
                $insert_card_query = "INSERT INTO `tarjetas` (id_lista, titulo) VALUES ('$list_id', 'Tarjeta inicial')";

                if (mysqli_query($connection, $insert_card_query)) {
                    echo "Usuario registrado con éxito. Tablero, lista y tarjeta por defecto creados.";
                } else {
                    echo "Error al crear la tarjeta por defecto: " . mysqli_error($connection);
                }
            } else {
                echo "Error al crear la lista por defecto: " . mysqli_error($connection);
            }
        } else {
            echo "Error al crear el tablero: " . mysqli_error($connection);
        }
    } else {
        echo "Error al registrar el usuario: " . mysqli_error($connection);
    }

    mysqli_close($connection);
}

header("Location: ../src/panel.php");
?>