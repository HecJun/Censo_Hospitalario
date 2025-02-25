<?php
    include '../includes/db.php';
        if (isset($_POST['subservicio_id'])) {
            # code...
            $subservicioID = $_POST['subservicio_id'];
            $cama = $conn->query("SELECT * FROM subservicios WHERE id = $subservicioID AND estado = 'Desocupada'");
            $options = '<option value="">Seleccione Cama</option>';
            foreach ($cama as $cama) {
                $num_cama = preg_replace("/[^0-9]/", "", $cama['num_cama']);
                $options .= "<option value='{$cama['id']}'>$num_cama</option>";
                }
                echo $options;
        }
?>