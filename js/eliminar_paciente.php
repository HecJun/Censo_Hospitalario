<?php
include '../includes/db.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];

        // Preparar la consulta SQL para eliminar el paciente
        $stmt = $conn->prepare("DELETE FROM paciente WHERE nombre = :nombre");
        $stmt->bindParam(':nombre', $nombre);

        if ($stmt->execute()) {
            echo "Paciente eliminado correctamente.";
        } else {
            echo "Error al eliminar el paciente.";
        }

        // Redirigir de vuelta a la página principal
        header("Location: ../pages/paciente.php");
        exit();
    }
?>