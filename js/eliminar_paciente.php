<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el nombre del paciente a eliminar
    $nombre = $_POST['nombre'];

    // Preparar y ejecutar la consulta para eliminar el paciente
    $stmt = $conn->prepare("DELETE FROM paciente WHERE nombre = ?");
    $stmt->execute([$nombre]);

    // Redirigir de vuelta a la página principal después de eliminar
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>