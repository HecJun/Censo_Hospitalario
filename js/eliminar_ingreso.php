<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el ID del ingreso a eliminar
    $id_ingreso = $_POST['id_ingreso'];

    // Obtener el id_subservicio asociado al ingreso
    $stmt = $conn->prepare("SELECT id_subservicio FROM ingresos WHERE id = ?");
    $stmt->execute([$id_ingreso]);
    $id_subservicio = $stmt->fetchColumn();

    if ($id_subservicio) {
        // Eliminar el ingreso
        $stmt = $conn->prepare("DELETE FROM ingresos WHERE id = ?");
        $stmt->execute([$id_ingreso]);

        // Cambiar el estado del subservicio a DEFAULT="Desocupada"
        $stmt = $conn->prepare("UPDATE subservicios SET estado = DEFAULT WHERE id = ?");
        $stmt->execute([$id_subservicio]);

        // Redirigir de vuelta a la página principal
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "No se encontró el ingreso o el subservicio asociado.";
    }
} else {
    echo "Método no permitido.";
}
?>