<?php
    require('fpdf/fpdf.php');

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

    // Consulta para el total de egresos
    $stmt_total = $conn->prepare("SELECT COUNT(*) AS total_egresos FROM egresos WHERE fecha_egreso = ?");
    $stmt_total->execute([$fecha_egreso]);
    $total_egresos = $stmt_total->fetch(PDO::FETCH_ASSOC)['total_egresos'];

    // Crear PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Encabezado
    $pdf->Image('../img/logo_hospital.png', 10, 10, 30);
    $pdf->Cell(0, 10, utf8_decode('Hospital Regional Docente Las Mercedes'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, utf8_decode('Reporte de Egresos de Pacientes'), 0, 1, 'C'); // Cambiado a "Egresos"
    $pdf->Cell(0, 10, utf8_decode('Fecha de Egreso: ') . $fecha_egreso, 0, 1, 'C'); // Cambiado a "Egreso"
    $pdf->Ln(5);

    // Total de egresos
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, utf8_decode('Total de Egresos: ') . $total_egresos, 0, 1, 'C'); // Cambiado a "Egresos"
    $pdf->Ln(5);

    // Recorrer egresos por subservicio
    foreach ($egresos_por_subservicio as $subservicio) {
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
    $pdf->Output('D', 'reporte_egresos_' . $fecha_egreso . '.pdf');
?>