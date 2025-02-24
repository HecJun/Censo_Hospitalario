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
        $result = $conn->query("SELECT * FROM paciente ORDER BY id DESC");   
        if ($result->rowCount() > 0) {
            # code...
            //Mostrar datos en una tabla HTML
            echo "<table class='table table-bordered'>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                </tr>";
            //Recorrer los resultados y mostrarlos en la tabla
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                # code...
                echo "<tr>
                        <th>".$row["dni"]."</th>
                        <th>".$row["nombre"]."</th>
                        <th>".$row["edad"]."</th>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "0 Resultados";
            }
    ?>


</body>
</html>