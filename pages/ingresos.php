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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
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

            $stmt = $conn->prepare("UPDATE subservicios SET estado = 'Ocupada' WHERE id = ?");
            $stmt->execute([$id_subservicio]);

            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
            }
    ?>

    <form method="post">
        Fecha Ingreso: <input type="date" id="fecha_ingreso" name="fecha_ingreso" required>
        
        Paciente: <input type="text" list="datalistOptions" id="paciente_ingreso" name="" autocomplete="off" require>
                    <datalist id="datalistOptions"></datalist>
                    <input type="hidden" id="id_paciente" name="id_paciente"> 
                         
        Servicio: 
            <select id="servicio" require>
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
            <select id="subservicio" name="id_subservicio" require>
                <option value="">Seleccione Subservicio</option>    
            </select>
        Cama: 
            <select id="id_cama" require>
                <option value="">Seleccione Cama</option>
            </select>
        Observacion: <input type="text" name="observacion">

        <input class="btn btn-primary" type="submit" id='reg_ingreso' value="Registrar Ingreso">
    </form>

    <?php
    include '../includes/db.php';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1 ;
        $perPage = 8;
        $oFfset = ($page - 1) *$perPage;
        $result = $conn->query("SELECT i.id, i.fecha_ingreso, p.nombre AS nombre_paciente, s.nombre AS nombre_subservicio, i.observacion 
                                FROM ingresos i 
                                JOIN paciente p ON i.id_paciente = p.id
                                JOIN subservicios s ON i.id_subservicio = s.id
                                ORDER BY id DESC LIMIT $perPage OFFSET $oFfset");
        if ($result->rowCount() > 0) {
            # code...
            //Mostrar datos en una tabla HTML
            echo "<table class='table table-bordered'>
                <tr>
                    <th>ID</th>
                    <th>Fecha Ingreso</th>
                    <th>Paciente</th>
                    <th>Subservicio</th>
                    <th>Observacion</th>
                    <th>Acciones</th>
                </tr>";
            //Recorrer los resultados y mostrarlos en la tabla
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                # code...
                echo "<tr>
                        <td>".$row["id"]."</td>
                        <td>".$row["fecha_ingreso"]."</td>
                        <td>".$row["nombre_paciente"]."</td>
                        <td>".$row["nombre_subservicio"]."</td>
                        <td>".$row["observacion"]."</td>
                        <td>
                            <form action='../js/eliminar_ingreso.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='id_ingreso' value='".htmlspecialchars($row["id"])."'>
                                <button class='btn btn-danger' type='submit' 
                                onclick='return confirm(\"¿Estás seguro de eliminar este ingreso?\");'>Eliminar</button>
                            </form>
                        </td>
                    </tr>";
            }
                echo "</table>";

            //Enlaces de paginacion
            $totalRows = $conn->query("SELECT COUNT(*) FROM ingresos")->fetchColumn();
            $totalPages = ceil($totalRows/$perPage);
            echo "<div class='paginacion'>";
            for ($i=1; $i<=$totalPages  ; $i++) { 
                # code...
                echo "<a href='?page=$i'>$i</a>";
            }
            echo"</div>";
        } else {
            echo "0 Resultados";
            }
    ?>

</body>
</html>