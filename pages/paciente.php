<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
</head>
<body>
    <h1>Gestión de Paciente</h1>
    <!-- Formulario y tabla para gestionar Paciente -->
    <?php
    include '../includes/db.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dni = !empty($_POST['dni']) ? $_POST['dni']: NULL;
            $nombre = $_POST['nombre'];
            $edad = !empty($_POST['edad']) ? $_POST['edad']: NULL;

            $stmt = $conn->prepare("INSERT INTO paciente (dni, nombre, edad) VALUES (?, ?, ?)");
            $stmt->execute([$dni, $nombre, $edad]);
            }   
    ?>

    <form method="post">
        DNI: <input type="int" name="DNI">
        Nombre: <input type="text" name="nombre" required>
        Edad: <input type="int" name="edad">
        
        <input class="btn btn-primary" type="submit" value="Registrar Paciente">
    </form>

    <?php
    include '../includes/db.php';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1 ;
        $perPage = 10;
        $oFfset = ($page - 1) *$perPage;
        $result = $conn->query("SELECT * FROM paciente ORDER BY id DESC LIMIT $perPage OFFSET $oFfset");   
        if ($result->rowCount() > 0) {
            # code...
            //Mostrar datos en una tabla HTML
            echo "<table class='table table-bordered'>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Acciones</th>
                </tr>";
            //Recorrer los resultados y mostrarlos en la tabla
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                # code...
                echo "<tr>
                        <td>".$row["dni"]."</td>
                        <td>".$row["nombre"]."</td>
                        <td>".$row["edad"]."</td>
                        <td>
                            <form action='../js/eliminar_paciente.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='nombre' value='".htmlspecialchars($row["nombre"])."'>
                                <button class='btn btn-danger' type='submit' 
                                onclick='return confirm(\"¿Estás seguro de eliminar este paciente?\");'>Eliminar</button>
                            </form>
                        </td>
                    </tr>";
            }
            echo "</table>";

            //Enlaces de paginacion
            $totalRows = $conn->query("SELECT COUNT(*) FROM paciente")->fetchColumn();
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