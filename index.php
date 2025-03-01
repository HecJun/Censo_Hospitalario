<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Censo Hospitalario</title>
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
            <a class="navbar-brand" href="index.php">Censo Hospitalario</a>
            <button class="navbar-toggler" tyoe="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" 
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="pages/paciente.php">Paciente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/ingresos.php">Ingresos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/egresos.php">Egresos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        <section>
            <h2 class="text-center mb-4">Bienvenido al Sistema de Censo Hospitalario</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow">
                        <img src="../img/paciente.png" class="card-img-top" alt="Pacientes">
                        <div class="card-body text-center">
                            <h5 class="card-title">Pacientes</h5>
                            <p class="card-text">Gestiona la información de los pacientes</p>
                            <a href="pages/paciente.php" class="btn btn-primary">Ir a Pacientes</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow">
                        <img src="../img/ingresos.png" class="card-img-top" alt="Ingresos">
                        <div class="card-body text-center">
                            <h5 class="card-title">Ingresos</h5>
                            <p class="card-text">Administra los ingresos hospitalarios.</p>
                            <a href="pages/ingresos.php" class="btn btn-primary">Ir a Ingresos</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow">
                        <img src="../img/egresos.png" class="card-img-top" alt="Egresos">
                        <div class="card-body text-center">
                            <h5 class="card-title">Egresos</h5>
                            <p class="card-text">Administra los egresos de pacientes.</p>
                            <a href="pages/egresos.php" class="btn btn-primary">Ir a Egresos</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 Censo Hospitalario. Todos los derechos reservado.</p>
    </footer>

    <script src="pages/script.js"></script>


</body>
</html>