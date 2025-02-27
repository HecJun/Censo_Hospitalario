<?php
    include '../includes/db.php';
        if (!empty($_POST['paciente_id'])) {
            # code...
            $pacienteId = $_POST['paciente_id']; // Obtiene el nombre del paciente escrito
            $paciente = $conn->query("SELECT * FROM paciente WHERE nombre LIKE '$pacienteId%'");

            $opciones = array();
            while ($row = $paciente->fetch(PDO::FETCH_ASSOC)) {
                # code...
                $opciones[] = array(
                    'id' => $row['id'],
                    //'dni' => $row['dni'],
                    'nombre' => $row['nombre']
                    //'edad' => $row['edad']
                );
            }
            $jsonString = json_encode($opciones);
            echo $jsonString;
        } else {
            echo json_encode([]); // Devuelve un array vacío si no hay resultados
        }
?>