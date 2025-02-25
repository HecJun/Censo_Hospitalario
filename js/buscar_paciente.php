<?php
    include '../includes/db.php';
        if (!empty($_POST['paciente_id'])) {
            # code...
            $pacienteId = $_POST['paciente_id']; // Obtiene el nombre del paciente escrito
            $paciente = $conn->query("SELECT * FROM paciente WHERE nombre LIKE '$pacienteId%'");

            $json = array();
            while ($row = mysqli_fetch_array($paciente)) {
                # code...
                $json[] = array(
                    'dni' => $row['dni'],
                    'nombre' => $row['nombre'],
                    'edad' => $row['edad']
                );
            }
            $jsonString = json_encode($json);
            echo $jsonString;
        }
?>