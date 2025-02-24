<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Egresos</title>
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
            }   
    ?>

    <form method="post">
        Fecha Egreso: <input type="date" name="fecha_egreso" required>
        Observacion: <input type="text" name="observacion">
        Paciente: <input type="int" name="paciente" require>
        Servicio: <select name="id_subservicio" require>
            <?php
            include '../includes/db.php';
                $subservicios = $conn->query("SELECT nombre FROM subservicios GROUP BY nombre");
                foreach ($subservicios as $subservicios) {
                    echo "<option value='{$subservicios['id']}'>{$subservicios['nombre']}</option>";
                }
            ?>

        </select>
        
        <input type="submit" value="Registrar Ingreso">
    </form>
</body>
</html>