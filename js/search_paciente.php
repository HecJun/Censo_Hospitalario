<?php
    include '../includes/db.php';
        if (!empty($_POST['id_paciente'])) {
            # code...
            $pacienteId = $_POST['id_paciente']; // Obtiene el ID del paciente escrito
            $paciente = $conn->query("SELECT * FROM paciente WHERE nombre LIKE '$pacienteId%'");
    
            foreach ($paciente as $paciente) {
                echo "<option value='{$paciente['id']}'>{$paciente['nombre']}</option>";
                }
        }
?>