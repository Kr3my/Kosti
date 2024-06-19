<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost", "user", "password", "osu");

if ($conn->connect_error) {
    die(json_encode(array("error" => "Conexión fallida: " . $conn->connect_error)));
}

$id_tablero = isset($_GET['id_tablero']) ? intval($_GET['id_tablero']) : 0;

if ($id_tablero > 0) {
    $query = "
        SELECT 
            l.id as lista_id, l.nombre as lista_nombre, l.fecha_creacion as lista_fecha_creacion,
            t.id as tarjeta_id, t.titulo as tarjeta_titulo, t.fecha_creacion as tarjeta_fecha_creacion
        FROM 
            listas l
        LEFT JOIN 
            tarjetas t ON l.id = t.id_lista
        WHERE 
            l.id_tablero = ?
        ORDER BY 
            l.id, t.id
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_tablero);
    $stmt->execute();
    $result = $stmt->get_result();

    $listas = array();
    $current_lista_id = null;
    $current_lista = null;

    while ($row = $result->fetch_assoc()) {
        if ($current_lista_id !== $row['lista_id']) {
            if ($current_lista !== null) {
                $listas[] = $current_lista;
            }
            $current_lista_id = $row['lista_id'];
            $current_lista = array(
                "id" => $row['lista_id'],
                "nombre" => $row['lista_nombre'],
                "fecha_creacion" => $row['lista_fecha_creacion'],
                "tarjetas" => array()
            );
        }
        if ($row['tarjeta_id'] !== null) {
            $current_lista['tarjetas'][] = array(
                "id" => $row['tarjeta_id'],
                "titulo" => $row['tarjeta_titulo'],
                "fecha_creacion" => $row['tarjeta_fecha_creacion']
            );
        }
    }

    if ($current_lista !== null) {
        $listas[] = $current_lista;
    }

    echo json_encode($listas);

    $stmt->close();
} else {
    echo json_encode(array("error" => "ID de tablero inválido."));
}

$conn->close();
?>