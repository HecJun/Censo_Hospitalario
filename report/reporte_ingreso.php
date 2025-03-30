<?php
    require('fpdf/fpdf.php');  

    include '../includes/db.php';
    $fecha_ingreso = $_GET['fecha_ingreso'];

    // Consulta SQL (igual que antes)
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

    // Consulta para el total de ingresos
    $stmt_total = $conn->prepare("SELECT COUNT(*) AS total_ingresos FROM ingresos WHERE fecha_ingreso = ?");
    $stmt_total->execute([$fecha_ingreso]);
    $total_ingresos = $stmt_total->fetch(PDO::FETCH_ASSOC)['total_ingresos'];

    // Crear PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Encabezado
    $pdf->Image('../img/logo_hospital.png', 10, 10, 30);
    $pdf->Cell(0, 10, utf8_decode('Hospital Regional Docente Las Mercedes'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, utf8_decode('Reporte de Ingresos de Pacientes'), 0, 1, 'C');
    $pdf->Cell(0, 10, utf8_decode('Fecha de Ingreso: ') . $fecha_ingreso, 0, 1, 'C');
    $pdf->Ln(5);

    // Total de ingresos
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, utf8_decode('Total de Ingresos: ') . $total_ingresos, 0, 1, 'C');
    $pdf->Ln(5);

    // Recorrer ingresos por subservicio
    foreach ($ingresos_por_subservicio as $subservicio) {
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(200, 220, 255);
        $pdf->Cell(0, 10, utf8_decode('Subservicio: ') . utf8_decode($subservicio['nombre_subservicio']), 0, 1, 'L', true);
        $pdf->Cell(0, 10, utf8_decode('Total de Pacientes: ') . $subservicio['total_pacientes'], 0, 1, 'L');
        $pdf->Ln(5);

        // Detalles de pacientes (convertir cada nombre)
        $pdf->SetFont('Arial', '', 12);
        $detalles_pacientes = explode(',', $subservicio['detalles_pacientes']);
        foreach ($detalles_pacientes as $detalle) {
            $pdf->Cell(0, 10, utf8_decode('- ' . $detalle), 0, 1);
        }
        $pdf->Ln(5);
    }

    // Pie de página
    $pdf->SetY(-30.1);
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(0, 10, utf8_decode('Página ') . $pdf->PageNo(), 0, 0, 'C');
    $pdf->Cell(0, 10, utf8_decode('Hospital Regional Docente Las Mercedes'), 0, 0, 'R');

    // Salida del PDF
    $pdf->Output('D', 'reporte_ingresos_' . $fecha_ingreso . '.pdf');
?>