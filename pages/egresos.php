<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Egresos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
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

        Paciente: <input type="serach" id="paciente_egreso" require>

        Sub Servicio: <input type="text" id="servicio" readonly require>

        Sub Servicio: <input type="text" id="subservicio" readonly require>

        Observacion: <input type="text" name="observacion">
        
        <input type="submit" value="Registrar Egreso">
    </form>
</body>
</html>