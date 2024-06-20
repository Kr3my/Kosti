<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id_tablero = isset($_GET["tab"]) ? $_GET["tab"] : '';
    $nombre_lista = "Lista nueva";

    if (empty($id_tablero) || empty($nombre_lista)) {
        die("Por favor, complete todos los campos.");
    }

    $connection = mysqli_connect("localhost", "user", "password", "osu");

    if(!$connection) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $id_tablero = mysqli_real_escape_string($connection, $id_tablero);
    $nombre_lista = mysqli_real_escape_string($connection, $nombre_lista);

    $insert_query = "INSERT INTO listas (id_tablero, nombre) VALUES ('$id_tablero', '$nombre_lista')";

    if (mysqli_query($connection, $insert_query)) {
        echo json_encode("success");
    } else {
        echo json_encode("failed");
    }

    mysqli_close($connection);
}
?>