<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Egresos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
        crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</head>
<body>
    <h1>Gestión de Egresos</h1>
    <!-- Formulario y tabla para gestionar Ingresos -->
    <?php
    include '../includes/db.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fecha_egreso = $_POST['fecha_egreso'];
            $observacion = !empty($_POST['observacion']) ? $_POST['observacion']: NULL;
            $id_paciente = $_POST['id_paciente'];
            $id_subservicio = $_POST['id_subservicio'];

            $stmt = $conn->prepare("INSERT INTO ingresos (fecha_egreso, observacion, id_paciente, id_subservicio) VALUES (?, ?, ?, ?)");
            $stmt->execute([$fecha_egreso, $observacion, $id_paciente, $id_subservicio]);

            $stmt = $conn->prepare("UPDATE subservicios SET estado = DEFAULT WHERE id = ?");
            $stmt->execute([$id_subservicio]); 
            }      
    ?>

    <form method="post">
    Fecha Engreso: <input type="date" id="fecha_egreso" name="fecha_egreso" required>
        
        Paciente: <input type="text" list="datalistOptions" id="paciente_egreso" name="paciente_nombre" autocomplete="off" require>
                    <datalist id="datalistOptions"></datalist>
                    <input type="hidden" id="id_paciente" name="id_paciente">
                         
        Servicio: 
            <select id="servicio_egreso" require>
                <option value="">Seleccione Servicio</option>
                <?php
                include '../includes/db.php';
                    $servicios = $conn->query("SELECT * FROM servicios");
                    foreach ($servicios as $servicios) {
                        echo "<option value='{$servicios['id']}'>{$servicios['nombre']}</option>";
                    }
                ?>
            </select>
        Sub Servicio: 
            <select id="subservicio_egreso" name="id_subservicio" require>
                <option value="">Seleccione Subservicio</option>    
            </select>
        Cama: 
            <select id="id_cama_egreso" require>
                <option value="">Seleccione Cama</option>
            </select>
        Observacion: <input type="text" name="observacion">

        <input class="btn btn-primary" type="submit" id='reg_ingreso' value="Registrar Egreso">
    </form>

</body>
</html>