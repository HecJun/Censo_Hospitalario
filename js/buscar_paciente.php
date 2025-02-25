<?php
    include '../includes/db.php';
        if (!empty($_POST['paciente_id'])) {
            # code...
            $pacienteId = $_POST['paciente_id']; // Obtiene el nombre del paciente escrito
            $paciente = $conn->query("SELECT * FROM paciente WHERE nombre LIKE '$pacienteId%'");
    
            foreach ($paciente as $paciente) {
                echo "<option value='{$paciente['id']}'>{$paciente['nombre']}</option>";
                }
        }
?>