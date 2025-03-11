<?php
    require('fpdf/fpdf.php'); // Asegúrate de que la ruta sea correcta

    // Conexión a la base de datos
    include '../includes/db.php';

    // Obtener la fecha desde el formulario
    $fecha_egreso = $_GET['fecha_egreso'];

    // Consulta para obtener los egresos agrupados por subservicio
    $stmt = $conn->prepare("SELECT s.nombre AS nombre_subservicio, 
                                COUNT(e.id) AS total_pacientes, 
                                GROUP_CONCAT(CONCAT(p.nombre)) AS detalles_pacientes
                            FROM egresos e
                            JOIN paciente p ON e.id_paciente = p.id
                            JOIN subservicios s ON e.id_subservicio = s.id
                            WHERE e.fecha_egreso = ?
                            GROUP BY s.nombre
                            ORDER BY s.nombre");
    $stmt->execute([$fecha_egreso]);
    $egresos_por_subservicio = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para obtener el total de egresos por fecha
    $stmt_total = $conn->prepare("SELECT COUNT(*) AS total_egresos 
                                FROM egresos 
                                WHERE fecha_egreso = ?");
    $stmt_total->execute([$fecha_egreso]);
    $total_egresos = $stmt_total->fetch(PDO::FETCH_ASSOC)['total_egresos'];

    // Crear el PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Encabezado
    $pdf->Image('../img/logo_hospital.png', 10, 10, 30); // Asegúrate de tener un logo en la ruta correcta
    $pdf->Cell(0, 10, 'Hospital Regional Docente Las Mercedes', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Reporte de Ingresos de Pacientes', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Fecha de Ingreso: ' . $fecha_egreso, 0, 1, 'C');
    $pdf->Ln(15);

    // Total de ingresos
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Total de Ingresos: ' . $total_egresos, 0, 1, 'C');
    $pdf->Ln(10);

    // Recorrer los ingresos agrupados por subservicio
    foreach ($egresos_por_subservicio as $subservicio) {
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
    $pdf->SetY(-15);
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(0, 10, 'Pagina ' . $pdf->PageNo(), 0, 0, 'C');
    $pdf->Cell(0, 10, 'Hospital Regional Docente Las Mercedes', 0, 0, 'R');

    // Salida del PDF
    $pdf->Output('D', 'reporte_egresos_' . $fecha_egreso . '.pdf');
?>