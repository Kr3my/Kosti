<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id_tablero = isset($_GET["tab"]) ? $_GET["tab"] : '';
    $id_tabla = isset($_GET["list"]) ? $_GET["list"] : '';

    if (empty($id_tablero) || empty($id_tabla)) {
        http_response_code(400);
        die("Error: No se proporcionó el ID del tablero o el ID de la tabla.");
    }

    $connection = mysqli_connect("localhost", "user", "password", "osu");

    if (!$connection) {
        http_response_code(500);
        die("Error de conexión: " . mysqli_connect_error());
    }

    $id_tablero = mysqli_real_escape_string($connection, $id_tablero);
    $id_tabla = mysqli_real_escape_string($connection, $id_tabla);

    $delete_query = "DELETE FROM listas WHERE id_tablero='$id_tablero' AND id='$id_tabla'";

    if (mysqli_query($connection, $delete_query)) {
        http_response_code(200);
        echo "Tabla eliminada correctamente.";
    } else {
        http_response_code(500);
        echo "Error al eliminar la tabla: " . mysqli_error($connection);
    }

    mysqli_close($connection);
} else {
    http_response_code(405);
    echo "Método no permitido.";
}
?>