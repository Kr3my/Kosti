<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id_lista = isset($_GET["list"]) ? $_GET["list"] : '';
    $id_carta = isset($_GET["id"]) ? $_GET["id"] : '';
    $nuevo_contenido = isset($_GET["content"]) ? $_GET["content"] : '';

    if (empty($id_lista) || empty($id_carta) || empty($nuevo_contenido)) {
        http_response_code(400);
        die("Error: No se proporcionó el ID del tablero, el ID de la carta o el nuevo contenido.");
    }

    $connection = mysqli_connect("localhost", "user", "password", "osu");

    if (!$connection) {
        http_response_code(500);
        die("Error de conexión: " . mysqli_connect_error());
    }

    $id_lista = mysqli_real_escape_string($connection, $id_lista);
    $id_carta = mysqli_real_escape_string($connection, $id_carta);
    $nuevo_contenido = mysqli_real_escape_string($connection, $nuevo_contenido);

    $update_query = "UPDATE tarjetas SET titulo='$nuevo_contenido' WHERE id_lista='$id_lista' AND id='$id_carta'";

    if (mysqli_query($connection, $update_query)) {
        http_response_code(200);
        echo "Contenido de la carta actualizado correctamente.";
    } else {
        http_response_code(500);
        echo "Error al actualizar el contenido de la carta: " . mysqli_error($connection);
    }

    mysqli_close($connection);
} else {
    http_response_code(405);
    echo "Método no permitido.";
}
?>