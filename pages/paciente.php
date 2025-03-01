<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

    <header class="bg-primary text-white text-center py-4 d-flex align-items-center justify-content-center">
        <img src="../img/logo_hospital.png" alt="Logo Hospital Regional Docente Las Mercedes" class="logo me-3">
        <div>
            <h1 class="display-4">Hospital Regional Docente "Las Mercedes"</h1>
            <p class="lead">Tradición que protege tu salud</p>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Censo Hospitalario</a>
            <button class="navbar-toggler" tyoe="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" 
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="paciente.php">Paciente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ingresos.php">Ingresos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="egresos.php">Egresos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center mb-4">Gestión de Pacientes</h2>

        <!-- Formulario para agregar pacientes -->
        <div class="form-container">
            <form method="post" class="row g-3">
                <div class="col-md-6">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="number" class="form-control" id="dni" name="dni">
                </div>
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="col-md-6">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="number" class="form-control" id="edad" name="edad">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Registrar Paciente</button>
                </div>
            </form>
        </div>

        <!-- Tabla para mostrar pacientes -->
        <div class="table-container">
            <?php
            include '../includes/db.php';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $dni = !empty($_POST['dni']) ? $_POST['dni'] : NULL;
                $nombre = $_POST['nombre'];
                $edad = !empty($_POST['edad']) ? $_POST['edad'] : NULL;

                $stmt = $conn->prepare("INSERT INTO paciente (dni, nombre, edad) VALUES (?, ?, ?)");
                $stmt->execute([$dni, $nombre, $edad]);

                header('Location: ' . $_SERVER['PHP_SELF']);
                exit();
            }

            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perPage = 10;
            $offset = ($page - 1) * $perPage;
            $result = $conn->query("SELECT * FROM paciente ORDER BY id DESC LIMIT $perPage OFFSET $offset");

            if ($result->rowCount() > 0) {
                echo "<table class='table table-striped table-hover'>
                        <thead class='table-dark'>
                            <tr>
                                <th>DNI</th>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>" . $row["dni"] . "</td>
                            <td>" . $row["nombre"] . "</td>
                            <td>" . $row["edad"] . "</td>
                            <td>
                                <form action='../js/eliminar_paciente.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='nombre' value='" . htmlspecialchars($row["nombre"]) . "'>
                                    <button class='btn btn-danger btn-sm' type='submit' 
                                    onclick='return confirm(\"¿Estás seguro de eliminar este paciente?\");'>Eliminar</button>
                                </form>
                            </td>
                          </tr>";
                }
                echo "</tbody></table>";

                // Paginación
                $totalRows = $conn->query("SELECT COUNT(*) FROM paciente")->fetchColumn();
                $totalPages = ceil($totalRows / $perPage);

                echo "<nav aria-label='Page navigation'>
                        <ul class='pagination justify-content-center'>";
                if ($page > 1) {
                    echo "<li class='page-item'><a class='page-link' href='?page=" . ($page - 1) . "'>Anterior</a></li>";
                }
                for ($i = 1; $i <= $totalPages; $i++) {
                    $active = ($page == $i) ? 'active' : '';
                    echo "<li class='page-item $active'><a class='page-link' href='?page=$i'>$i</a></li>";
                }
                if ($page < $totalPages) {
                    echo "<li class='page-item'><a class='page-link' href='?page=" . ($page + 1) . "'>Siguiente</a></li>";
                }
                echo "</ul></nav>";
            } else {
                echo "<div class='alert alert-info'>No hay pacientes registrados.</div>";
            }
            ?>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 Censo Hospitalario. Todos los derechos reservado.</p>
    </footer>

</body>
</html>