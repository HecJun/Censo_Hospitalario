<?php
    include '../includes/db.php';
        if (!empty($_POST['nombre'])) {
            # code...
            $pacienteNom = $conn->prepare($_POST['nombre']);

            $pacienteEli = $conn->query("DELETE FROM paciente WHERE nombre LIKE '$pacienteNom%'");
    
            if ($pacienteEli == TRUE) {
                # code...
                echo "Paciente eliminado correctamente";
            } else {
                echo "Error al eliminar el paciente";
            }
        }
        
    header("Location: ../pages/paciente.php");
    exit();
?>