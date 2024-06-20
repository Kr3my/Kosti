<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id_lista = isset($_GET["id"]) ? $_GET["id"] : '';
    $nuevo_titulo = isset($_GET["content"]) ? $_GET["content"] : '';

    if (empty($id_lista) || empty($nuevo_titulo)) {
        http_response_code(400);
        die("Error: No se proporcionó el ID de la lista o el nuevo título.");
    }

    $connection = mysqli_connect("localhost", "user", "password", "osu");

    if (!$connection) {
        http_response_code(500);
        die("Error de conexión: " . mysqli_connect_error());
    }

    $id_lista = mysqli_real_escape_string($connection, $id_lista);
    $nuevo_titulo = mysqli_real_escape_string($connection, $nuevo_titulo);

    $update_query = "UPDATE listas SET nombre='$nuevo_titulo' WHERE id='$id_lista'";

    if (mysqli_query($connection, $update_query)) {
        http_response_code(200);
        echo "Título de la lista actualizado correctamente.";
    } else {
        http_response_code(500);
        echo "Error al actualizar el título de la lista: " . mysqli_error($connection);
    }

    mysqli_close($connection);
} else {
    http_response_code(405);
    echo "Método no permitido.";
}
?>