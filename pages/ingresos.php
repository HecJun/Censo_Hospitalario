<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Ingresos</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
        crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</head>
<body>
    <h1>Gestión de Ingresos</h1>
    <!-- Formulario y tabla para gestionar Ingresos -->
    <?php
    include '../includes/db.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fecha_ingreso = $_POST['fecha_ingreso'];
            $observacion = !empty($_POST['observacion']) ? $_POST['observacion']: NULL;
            $id_paciente = $_POST['id_paciente'];
            $id_subservicio = $_POST['id_subservicio'];

            $stmt = $conn->prepare("INSERT INTO ingresos (fecha_ingreso, observacion, id_paciente, id_subservicio) VALUES (?, ?, ?, ?)");
            $stmt->execute([$fecha_ingreso, $observacion, $id_paciente, $id_subservicio]);
            }   
    ?>

    <form method="post">
        Fecha Ingreso: <input type="date" id="fecha_ingreso" required>
        Paciente: <input type="serach" id="paciente" require>
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
        Servicio: 
            <select id="servicio" require>
                <option value="">Selecionar Servicio</option>
                <?php
                include '../includes/db.php';
                    $servicios = $conn->query("SELECT * FROM servicios");
                    foreach ($servicios as $servicios) {
                        echo "<option value='{$servicios['id']}'>{$servicios['nombre']}</option>";
                    }
                ?>
            </select>
        Sub Servicio: 
            <select id="subservicio" require>
                <option value="">Seleccione Subservicio</option>
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
            </select>
        Cama: 
            <select id="id_cama" require>
                <?php
                include '../includes/db.php';
                    $cama = $conn->query("SELECT * FROM subservicios WHERE id_servicio = 1 AND id = 1 
                                        AND estado = 'Desocupada'");
                    foreach ($cama as $cama) {
                        echo "<option value='{$cama['id']}'>{$cama['num_cama']}</option>";
                    }
                ?>
            </select>
        Observacion: <input type="text" name="observacion">
        <input class="btn btn-primary" type="submit" value="Registrar Ingreso">
    </form>

</body>
</html>