<?php
header('Content-Type: application/json');

if (!isset($_GET['user']) || !isset($_GET['pwd'])) {
    echo json_encode(array('success' => false, 'message' => 'Usuario y/o contraseña no proporcionados.'));
    exit;
}

$user = $_GET['user'];
$pwd = $_GET['pwd'];

$connection = mysqli_connect("localhost", "user", "password", "osu");

if (!$connection) {
    echo json_encode(array('success' => false, 'message' => 'Error de conexión a la base de datos.'));
    exit;
}

$user_escaped = mysqli_real_escape_string($connection, $user);
$pwd_escaped = mysqli_real_escape_string($connection, $pwd);

$query = "SELECT username, pwd FROM `usuarios` WHERE username = '$user_escaped'";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $db_pwd = $row['pwd'];

    if (password_verify($pwd_escaped, $db_pwd)) {
        echo json_encode(array('success' => true, 'message' => 'Usuario y contraseña válidos.'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Contraseña incorrecta.'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Usuario no encontrado.'));
}

mysqli_close($connection);
?>
