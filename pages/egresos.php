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
        <h2 class="text-center mb-4">Gestión de Egresos</h2>

        <!-- Formulario para agregar egresos -->
        <div class="form-container-ingreso-egreso">
            <form method="post" class="row g-3">
                <div class="col-md-6">
                    <label for="fecha_egreso" class="form-label">Fecha de Egreso</label>
                    <input type="date" class="form-control" id="fecha_egreso" name="fecha_egreso" required>
                </div>
                <div class="col-md-6">
                    <label for="paciente_egreso" class="form-label">Paciente</label>
                    <input type="text" class="form-control" list="datalistOptions" id="paciente_egreso" name="paciente_nombre" autocomplete="off" required>
                    <datalist id="datalistOptions"></datalist>
                    <input type="hidden" id="id_paciente" name="id_paciente">
                </div>
                <div class="col-md-6">
                    <label for="servicio_egreso" class="form-label">Servicio</label>
                    <select class="form-select" id="servicio_egreso" required>
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
                    <label for="subservicio_egreso" class="form-label">Subservicio</label>
                    <select class="form-select" id="subservicio_egreso" name="id_subservicio" required>
                        <option value="">Seleccione Subservicio</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="id_cama_egreso" class="form-label">Cama</label>
                    <select class="form-select" id="id_cama_egreso" required>
                        <option value="">Seleccione Cama</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="observacion" class="form-label">Observación</label>
                    <input type="text" class="form-control" id="observacion" name="observacion">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary" id="reg_ingreso">Registrar Egreso</button>
                </div>
            </form>
        </div>

        <!-- Tabla para mostrar egresos -->
        <div class="table-container">
            <?php
            include '../includes/db.php';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $fecha_egreso = $_POST['fecha_egreso'];
                $observacion = !empty($_POST['observacion']) ? $_POST['observacion'] : NULL;
                $id_paciente = $_POST['id_paciente'];
                $id_subservicio = $_POST['id_subservicio'];

                $stmt = $conn->prepare("INSERT INTO egresos (fecha_egreso, observacion, id_paciente, id_subservicio) VALUES (?, ?, ?, ?)");
                $stmt->execute([$fecha_egreso, $observacion, $id_paciente, $id_subservicio]);

                $stmt = $conn->prepare("UPDATE subservicios SET estado = DEFAULT WHERE id = ?");
                $stmt->execute([$id_subservicio]);

                header('Location: ' . $_SERVER['PHP_SELF']);
                exit();
            }

            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perPage = 8;
            $offset = ($page - 1) * $perPage;
            $result = $conn->query("SELECT e.id, e.fecha_egreso, p.nombre AS nombre_paciente, s.nombre AS nombre_subservicio, e.observacion 
                                    FROM egresos e 
                                    JOIN paciente p ON e.id_paciente = p.id
                                    JOIN subservicios s ON e.id_subservicio = s.id
                                    ORDER BY id DESC LIMIT $perPage OFFSET $offset");

            if ($result->rowCount() > 0) {
                echo "<table class='table table-striped table-hover'>
                        <thead class='table-dark'>
                            <tr>
                                <th>ID</th>
                                <th>Fecha Egreso</th>
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
                            <td>" . $row["fecha_egreso"] . "</td>
                            <td>" . $row["nombre_paciente"] . "</td>
                            <td>" . $row["nombre_subservicio"] . "</td>
                            <td>" . $row["observacion"] . "</td>
                            <td>
                                <form action='../js/eliminar_egreso.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id_egreso' value='" . htmlspecialchars($row["id"]) . "'>
                                    <button class='btn btn-danger btn-sm' type='submit' 
                                    onclick='return confirm(\"¿Estás seguro de eliminar este egreso?\");'>Eliminar</button>
                                </form>
                            </td>
                          </tr>";
                }
                echo "</tbody></table>";

                // Paginación
                $totalRows = $conn->query("SELECT COUNT(*) FROM egresos")->fetchColumn();
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
                echo "<div class='alert alert-info'>No hay egresos registrados.</div>";
            }
            ?>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 Censo Hospitalario. Todos los derechos reservado.</p>
    </footer>

</body>
</html>