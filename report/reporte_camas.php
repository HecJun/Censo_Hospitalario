<?php
    require('fpdf/fpdf.php'); 

    // Conexión a la base de datos
    include '../includes/db.php';

    // Obtener fechas del formulario
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    // Consulta SQL con fechas dinámicas
    $sql = "SELECT ss.nombre AS subservicio, 
            COUNT(CASE WHEN ss.estado = 'Ocupada' THEN 1 END) AS camas_ocupadas, 
            COUNT(CASE WHEN ss.estado = 'Desocupada' THEN 1 END) AS camas_desocupadas 
            FROM subservicios ss 
            LEFT JOIN ingresos i ON ss.id = i.id_subservicio 
            LEFT JOIN egresos e ON ss.id = e.id_subservicio 
            WHERE (i.fecha_ingreso BETWEEN '$fecha_inicio' AND '$fecha_fin' 
                    OR e.fecha_egreso BETWEEN '$fecha_inicio' AND '$fecha_fin') 
            GROUP BY ss.nombre";
    $result = $conn->query($sql);

    // Crear PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetMargins(15, 15, 15); // Establecer márgenes

    // Encabezado
    $pdf->Image('../img/logo_hospital.png', 15, 10, 30); // Asegúrate de tener un logo en la ruta correcta
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0, 10, 'Hospital Regional Docente Las Mercedes', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "Reporte de Camas por Subservicio - $fecha_inicio a $fecha_fin", 0, 1, 'C');
    $pdf->Ln(10); // Espacio después del encabezado

    // Encabezado de la tabla
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(90,10,'Subservicio',1, 0, 'C');
    $pdf->Cell(45,10,'Camas Ocupadas',1, 0, 'C');
    $pdf->Cell(45,10,'Camas Desocupadas',1, 0, 'C');
    $pdf->Ln();

    // Contenido de la tabla
    $pdf->SetFont('Arial','',12);
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Cell(90,10,$row['subservicio'],1, 0, 'L');
        $pdf->Cell(45,10,$row['camas_ocupadas'],1, 0, 'C');
        $pdf->Cell(45,10,$row['camas_desocupadas'],1, 0, 'C');
        $pdf->Ln();
    }

    // Pie de página
    $pdf->SetY(-15);
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(0, 10, 'Pagina ' . $pdf->PageNo(), 0, 0, 'C');
    $pdf->Cell(0, 10, 'Hospital Regional Docente Las Mercedes', 0, 0, 'R');

    $pdf->Output();
?>