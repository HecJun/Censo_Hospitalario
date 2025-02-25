<?php
    include '../includes/db.php';
        if (isset($_POST['servicio_id'])) {
        # code...
            $servicioId = $_POST['servicio_id']; // Obtiene el ID del servicio seleccionado
            $subservicios = $conn->query("SELECT * FROM subservicios WHERE id_servicio = $servicioId 
                                        AND estado = 'Desocupada' GROUP BY nombre");               
            $options = '<option value="">Seleccione Subservicio</option>';
            foreach ($subservicios as $subservicios) {
                $options .= "<option value='{$subservicios['id']}'>{$subservicios['nombre']}</option>";
            }
                echo $options;
        }
?>