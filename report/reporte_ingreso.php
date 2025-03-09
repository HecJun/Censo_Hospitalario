<?php
    require('fpdf/fpdf.php'); // Asegúrate de que la ruta sea correcta

    // Conexión a la base de datos
    include '../includes/db.php';

    // Obtener la fecha desde el formulario
    $fecha_ingreso = $_GET['fecha_ingreso'];

    // Consulta para obtener los ingresos agrupados por subservicio
    $stmt = $conn->prepare("SELECT s.nombre AS nombre_subservicio, 
                                COUNT(i.id) AS total_pacientes, 
                                GROUP_CONCAT(CONCAT(p.nombre)) AS detalles_pacientes
                            FROM ingresos i
                            JOIN paciente p ON i.id_paciente = p.id
                            JOIN subservicios s ON i.id_subservicio = s.id
                            WHERE i.fecha_ingreso = ?
                            GROUP BY s.nombre
                            ORDER BY s.nombre");
    $stmt->execute([$fecha_ingreso]);
    $ingresos_por_subservicio = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para obtener el total de ingresos por fecha
    $stmt_total = $conn->prepare("SELECT COUNT(*) AS total_ingresos 
                                FROM ingresos 
                                WHERE fecha_ingreso = ?");
    $stmt_total->execute([$fecha_ingreso]);
    $total_ingresos = $stmt_total->fetch(PDO::FETCH_ASSOC)['total_ingresos'];

    // Crear el PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Encabezado
    $pdf->Image('../img/logo_hospital.png', 10, 10, 30); // Asegúrate de tener un logo en la ruta correcta
    $pdf->Cell(0, 10, 'Hospital Regional Docente Las Mercedes', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Reporte de Ingresos de Pacientes', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Fecha de Ingreso: ' . $fecha_ingreso, 0, 1, 'C');
    $pdf->Ln(15);

    // Total de ingresos
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Total de Ingresos: ' . $total_ingresos, 0, 1, 'C');
    $pdf->Ln(10);

    // Recorrer los ingresos agrupados por subservicio
    foreach ($ingresos_por_subservicio as $subservicio) {
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(200, 220, 255); // Color de fondo para el subservicio
        $pdf->Cell(0, 10, 'Subservicio: ' . $subservicio['nombre_subservicio'], 0, 1, 'L', true);
        $pdf->Cell(0, 10, 'Total de Pacientes: ' . $subservicio['total_pacientes'], 0, 1, 'L');
        $pdf->Ln(5);

        // Detalles de los pacientes
        $pdf->SetFont('Arial', '', 12);
        $detalles_pacientes = explode(',', $subservicio['detalles_pacientes']);
        foreach ($detalles_pacientes as $detalle) {
            $pdf->Cell(0, 10, '- ' . $detalle, 0, 1);
        }
        $pdf->Ln(10); // Espacio entre subservicios
    }

    // Pie de página
    $pdf->SetY(-10);
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(0, 10, 'Pagina ' . $pdf->PageNo(), 0, 0, 'C');
    $pdf->Cell(0, 10, 'Hospital Regional Docente Las Mercedes', 0, 0, 'R');

    // Salida del PDF
    $pdf->Output('D', 'reporte_ingresos_' . $fecha_ingreso . '.pdf');
?>