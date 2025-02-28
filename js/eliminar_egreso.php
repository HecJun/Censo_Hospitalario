<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el ID del egreso a eliminar
    $id_egreso = $_POST['id_egreso'];

    // Obtener el id_subservicio asociado al egreso
    $stmt = $conn->prepare("SELECT id_subservicio FROM egresos WHERE id = ?");
    $stmt->execute([$id_egreso]);
    $id_subservicio = $stmt->fetchColumn();

    if ($id_subservicio) {
        // Eliminar el egreso
        $stmt = $conn->prepare("DELETE FROM egresos WHERE id = ?");
        $stmt->execute([$id_egreso]);

        // Cambiar el estado del subservicio a "Ocupada"
        $stmt = $conn->prepare("UPDATE subservicios SET estado = 'Ocupada' WHERE id = ?");
        $stmt->execute([$id_subservicio]);

        // Redirigir de vuelta a la página principal
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "No se encontró el egreso o el subservicio asociado.";
    }
} else {
    echo "Método no permitido.";
}
?>