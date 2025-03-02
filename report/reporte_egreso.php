<?php
    require('fpdf/fpdf.php'); // Asegúrate de que la ruta sea correcta

    // Conexión a la base de datos
    include '../includes/db.php';

    // Obtener la fecha desde el formulario
    $fecha_egreso = $_GET['fecha_egreso'];

    // Consulta para obtener los egresos agrupados por subservicio
    $stmt = $conn->prepare("SELECT s.nombre AS nombre_subservicio, 
                                COUNT(e.id) AS total_pacientes, 
                                GROUP_CONCAT(CONCAT(p.nombre, ' - ', e.observacion)) AS detalles_pacientes
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

    // Título del reporte
    $pdf->Cell(0, 10, 'Reporte de Egresos de Pacientes', 0, 1, 'C');
    $pdf->Ln(10);

    // Fecha del reporte
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Fecha de Egreso: ' . $fecha_egreso, 0, 1);
    $pdf->Ln(5);

    // Total de egresos
    $pdf->Cell(0, 10, 'Total de Egresos: ' . $total_egresos, 0, 1);
    $pdf->Ln(10);

    // Recorrer los egresos agrupados por subservicio
    foreach ($egresos_por_subservicio as $subservicio) {
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Subservicio: ' . $subservicio['nombre_subservicio'], 0, 1);
        $pdf->Cell(0, 10, 'Total de Pacientes: ' . $subservicio['total_pacientes'], 0, 1);
        $pdf->Ln(5);

        // Detalles de los pacientes
        $pdf->SetFont('Arial', '', 12);
        $detalles_pacientes = explode(',', $subservicio['detalles_pacientes']);
        foreach ($detalles_pacientes as $detalle) {
            $pdf->Cell(0, 10, '- ' . $detalle, 0, 1);
        }
        $pdf->Ln(10); // Espacio entre subservicios
    }

    // Salida del PDF
    $pdf->Output('D', 'reporte_egresos_' . $fecha_egreso . '.pdf');
?>