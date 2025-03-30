<?php
    require('fpdf/fpdf.php'); 

    // Conexión a la base de datos
    include '../includes/db.php';

    // Obtener fechas del formulario
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    // Número total de camas (246 según tu consulta anterior)
    $numero_camas = 246;

    // Consulta para calcular días cama totales
    $sql_dias_cama = "SELECT $numero_camas * DATEDIFF('$fecha_fin', '$fecha_inicio') + 1 AS total_dias_cama";

    // Consulta para calcular días paciente totales
    $sql_dias_paciente = "SELECT SUM(DATEDIFF(e.fecha_egreso, i.fecha_ingreso) + 1) AS total_dias_paciente
                            FROM ingresos i
                            JOIN egresos e ON i.id_paciente = e.id_paciente
                            WHERE i.fecha_ingreso BETWEEN '$fecha_inicio' AND '$fecha_fin'";

    // Consulta para total de egresos
    $sql_egresos = "SELECT COUNT(*) AS total_egresos 
                    FROM egresos 
                    WHERE fecha_egreso BETWEEN '$fecha_inicio' AND '$fecha_fin'";
    
    // Consulta para promedio de permanencia
    $sql_promedio_permanencia = "SELECT AVG(DATEDIFF(e.fecha_egreso, i.fecha_ingreso) + 1) AS promedio_permanencia
                                FROM ingresos i
                                JOIN egresos e ON i.id_paciente = e.id_paciente
                                WHERE i.fecha_ingreso BETWEEN '$fecha_inicio' AND '$fecha_fin'";

    $result_dias_cama = $conn->query($sql_dias_cama);
    $result_dias_paciente = $conn->query($sql_dias_paciente);
    $result_egresos = $conn->query($sql_egresos);
    $result_promedio_permanencia = $conn->query($sql_promedio_permanencia);

    // Obtener valores para los cálculos
    $dias_cama = $result_dias_cama->fetch(PDO::FETCH_ASSOC)['total_dias_cama'];
    $dias_paciente = $result_dias_paciente->fetch(PDO::FETCH_ASSOC)['total_dias_paciente'];
    $total_egresos = $result_egresos->fetch(PDO::FETCH_ASSOC)['total_egresos'];
    $promedio_permanencia = $result_promedio_permanencia->fetch(PDO::FETCH_ASSOC)['promedio_permanencia'];

    // Calcular intervalo de sustitución
    $intervalo_sustitucion = 0;
    if ($total_egresos > 0) {
        $intervalo_sustitucion = ($dias_cama - $dias_paciente) / $total_egresos;
    }

    // Calcular porcentaje de ocupación
    $porcentaje_ocupacion = 0;
    if ($dias_cama > 0) {
        $porcentaje_ocupacion = ($dias_paciente / $dias_cama) * 100;
    }

    // Calcular RENDIMIENTO DE CAMA (Tasa de Rotación)
    $rendimiento_cama = 0;
    if ($numero_camas > 0) {
        $rendimiento_cama = $total_egresos / $numero_camas;
    }

    // Crear PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetMargins(15, 15, 15);

    // Encabezado
    $pdf->Image('../img/logo_hospital.png', 15, 10, 30);
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0, 10, 'Hospital Regional Docente Las Mercedes', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "Reporte de Indicadores Hospitalarios - $fecha_inicio a $fecha_fin", 0, 1, 'C');
    $pdf->Ln(10);

    // Mostrar resultados
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,10,'Indicadores de Hospitalarios:',0,1);
    $pdf->SetFont('Arial','',12);
    
    $pdf->Cell(0,10,utf8_decode(sprintf('Intervalo de sustitución de camas: %.2f días', $intervalo_sustitucion)),0,1);
    $pdf->Cell(0,10,utf8_decode('(Calculado como: (Días cama totales - Días paciente totales) / Total egresos)'),0,1);
    $pdf->Ln(5);
    
    $pdf->Cell(0,10,utf8_decode(sprintf('Porcentaje de ocupación de camas: %.2f%%', $porcentaje_ocupacion)),0,1);
    $pdf->Cell(0,10,utf8_decode('(Calculado como: (Días paciente totales / Días cama totales) * 100)'),0,1);
    $pdf->Ln(5);
    
    $pdf->Cell(0,10,utf8_decode(sprintf('Promedio de permanencia: %.2f días', $promedio_permanencia)),0,1);
    $pdf->Cell(0,10,utf8_decode('(Calculado como: Suma de días de todos los pacientes / Total de egresos)'),0,1);
    $pdf->Ln(5);
    
    $pdf->Cell(0,10,utf8_decode(sprintf('Rendimiento de camas: %.2f', $rendimiento_cama)),0,1);
    $pdf->Cell(0,10,utf8_decode("(Calculado como: Total de egresos / Número de camas ($numero_camas))"),0,1);

    // Pie de página
    $pdf->SetY(-30.1);
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(0, 10,utf8_decode('Página ') . $pdf->PageNo() , 0, 0, 'C');
    $pdf->Cell(0, 10, 'Hospital Regional Docente Las Mercedes', 0, 0, 'R');

    $pdf->Output('D', 'reporte_indicadores_' . $fecha_inicio . '_' . $fecha_fin . '.pdf');
?>