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
        <h2 class="text-center mb-4">Gestión de Ingresos</h2>

        <!-- Formulario para agregar ingresos -->
        <div class="form-container-ingreso-egreso">

            <?php
            include '../includes/db.php';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $fecha_ingreso = $_POST['fecha_ingreso'];
                $observacion = !empty($_POST['observacion']) ? $_POST['observacion'] : NULL;
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

            <form method="post" class="row g-3">
                <div class="col-md-6">
                    <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
                </div>
                <div class="col-md-6">
                    <label for="paciente_ingreso" class="form-label">Paciente</label>
                    <input type="text" class="form-control" list="datalistOptions" id="paciente_ingreso" autocomplete="off" required>
                    <datalist id="datalistOptions"></datalist>
                    <input type="hidden" id="id_paciente" name="id_paciente">
                </div>
                <div class="col-md-6">
                    <label for="servicio" class="form-label">Servicio</label>
                    <select class="form-select" id="servicio" required>
                        <option value="">Seleccione Servicio</option>
                        <?php
                        include '../includes/db.php';
                        $servicios = $conn->query("SELECT * FROM servicios");
                        foreach ($servicios as $servicio) {
                            echo "<option value='{$servicio['id']}'>{$servicio['nombre']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="subservicio" class="form-label">Subservicio</label>
                    <select class="form-select" id="subservicio" name="id_subservicio" required>
                        <option value="">Seleccione Subservicio</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="id_cama" class="form-label">Cama</label>
                    <select class="form-select" id="id_cama" required>
                        <option value="">Seleccione Cama</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="observacion" class="form-label">Observación</label>
                    <input type="text" class="form-control" id="observacion" name="observacion">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary" id="reg_ingreso">Registrar Ingreso</button>
                </div>
            </form>
        </div>

        <!-- Tabla para mostrar ingresos -->
        <div class="table-container">
            <?php
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perPage = 8;
            $offset = ($page - 1) * $perPage;
            $result = $conn->query("SELECT i.id, i.fecha_ingreso, p.nombre AS nombre_paciente, s.nombre AS nombre_subservicio, i.observacion 
                                    FROM ingresos i 
                                    JOIN paciente p ON i.id_paciente = p.id
                                    JOIN subservicios s ON i.id_subservicio = s.id
                                    ORDER BY id DESC LIMIT $perPage OFFSET $offset");

            if ($result->rowCount() > 0) {
                echo "<table class='table table-striped table-hover'>
                        <thead class='table-dark'>
                            <tr>
                                <th>ID</th>
                                <th>Fecha Ingreso</th>
                                <th>Paciente</th>
                                <th>Subservicio</th>
                                <th>Observación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["fecha_ingreso"] . "</td>
                            <td>" . $row["nombre_paciente"] . "</td>
                            <td>" . $row["nombre_subservicio"] . "</td>
                            <td>" . $row["observacion"] . "</td>
                            <td>
                                <form action='../js/eliminar_ingreso.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id_ingreso' value='" . htmlspecialchars($row["id"]) . "'>
                                    <button class='btn btn-danger btn-sm' type='submit' 
                                    onclick='return confirm(\"¿Estás seguro de eliminar este ingreso?\");'>Eliminar</button>
                                </form>
                            </td>
                          </tr>";
                }
                echo "</tbody></table>";

                // Paginación
                    $totalRows = $conn->query("SELECT COUNT(*) FROM ingresos")->fetchColumn();
                    $totalPages = ceil($totalRows / $perPage);

                    // Número de páginas a mostrar alrededor de la página actual
                    $pagesToShow = 10;

                    echo "<nav aria-label='Page navigation'>
                            <ul class='pagination justify-content-center'>";

                    // Botón "Anterior"
                    if ($page > 1) {
                        echo "<li class='page-item'><a class='page-link' href='?page=" . ($page - 1) . "'>Anterior</a></li>";
                    }

                    // Mostrar la primera página
                    if ($page > $pagesToShow) {
                        echo "<li class='page-item'><a class='page-link' href='?page=1'>1</a></li>";
                        if ($page > $pagesToShow + 1) {
                            echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
                        }
                    }

                    // Mostrar las páginas alrededor de la página actual
                    $startPage = max(1, $page - $pagesToShow);
                    $endPage = min($totalPages, $page + $pagesToShow);

                    for ($i = $startPage; $i <= $endPage; $i++) {
                        $active = ($page == $i) ? 'active' : '';
                        echo "<li class='page-item $active'><a class='page-link' href='?page=$i'>$i</a></li>";
                    }

                    // Mostrar la última página
                    if ($page < $totalPages - $pagesToShow) {
                        if ($page < $totalPages - $pagesToShow - 1) {
                            echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
                        }
                        echo "<li class='page-item'><a class='page-link' href='?page=$totalPages'>$totalPages</a></li>";
                    }

                    // Botón "Siguiente"
                    if ($page < $totalPages) {
                        echo "<li class='page-item'><a class='page-link' href='?page=" . ($page + 1) . "'>Siguiente</a></li>";
                    }

                    echo "</ul></nav>";
            } else {
                echo "<div class='alert alert-info'>No hay ingresos registrados.</div>";
            }
            ?>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Primer Reporte: Ingresos por Fecha -->
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white">
                        <h2 class="card-title text-center mb-0">Reporte de Ingresos por Fecha</h2>
                    </div>
                    <div class="card-body">
                        <form action="../report/reporte_ingreso.php" method="get" class="row g-3">
                            <div class="col-md-12">
                                <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                                <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-success btn-lg">Generar Reporte</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Segundo Reporte: Reporte de camas por Rango de Fechas -->
                <div class="card shadow">
                    <div class="card-header bg-secondary text-white">
                        <h2 class="card-title text-center mb-0">Reporte de Indicadores Hospitalarios</h2>
                    </div>
                    <div class="card-body">
                        <form action="../report/reporte_indicadores.php" method="post" class="row g-3">
                            <div class="col-md-6">
                                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-warning btn-lg">Generar Reporte</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 Censo Hospitalario. Todos los derechos reservado.</p>
    </footer>

</body>
</html>