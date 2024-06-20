<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id_tablero = isset($_GET["list"]) ? $_GET["list"] : '';
    $id_carta = isset($_GET["id"]) ? $_GET["id"] : '';
    echo $id_tablero;
    echo $id_carta;

    if (empty($id_tablero) || empty($id_carta)) {
        http_response_code(400);
        die("Error: No se proporcionó el ID del tablero, el ID de la tabla o el ID de la carta.");
    }

    $connection = mysqli_connect("localhost", "user", "password", "osu");

    if (!$connection) {
        http_response_code(500);
        die("Error de conexión: " . mysqli_connect_error());
    }

    $id_tablero = mysqli_real_escape_string($connection, $id_tablero);
    $id_carta = mysqli_real_escape_string($connection, $id_carta);

    $delete_query = "DELETE FROM tarjetas WHERE id_lista='$id_tablero' AND id='$id_carta'";

    if (mysqli_query($connection, $delete_query)) {
        http_response_code(200);
        echo "Carta eliminada correctamente.";
    } else {
        http_response_code(500);
        echo "Error al eliminar la carta: " . mysqli_error($connection);
    }

    mysqli_close($connection);
} else {
    http_response_code(405);
    echo "Método no permitido.";
}
?>