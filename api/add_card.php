<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id_lista = isset($_GET["list"]) ? $_GET["list"] : '';
    $nombre_carta = "";

    if (empty($id_lista)) {
        http_response_code(400);
        die("Error: No se proporcionó el ID del tablero, el ID de la tabla o el nombre de la carta.");
    }

    $connection = mysqli_connect("localhost", "user", "password", "osu");

    if (!$connection) {
        http_response_code(500);
        die("Error de conexión: " . mysqli_connect_error());
    }

    $id_lista = mysqli_real_escape_string($connection, $id_lista);
    $nombre_carta = mysqli_real_escape_string($connection, $nombre_carta);

    $insert_query = "INSERT INTO tarjetas (id_lista, titulo) VALUES ('$id_lista', '$nombre_carta')";

    if (mysqli_query($connection, $insert_query)) {
        $carta_id = mysqli_insert_id($connection);
        http_response_code(201);
        echo json_encode(array("message" => "Nueva carta creada correctamente.", "carta_id" => $carta_id));
    } else {
        http_response_code(500);
        echo "Error al crear la carta: " . mysqli_error($connection);
    }

    mysqli_close($connection);
} else {
    http_response_code(405);
    echo "Método no permitido.";
}
?>