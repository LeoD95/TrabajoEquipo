<?php
  
  include 'plantilla.php';
  include '../../conexion/conexion.php';

$consulta=mysql_query("SELECT
              recetas.id_receta,
              (SELECT CONCAT(p.nombre,' ',p.ap_paterno,' ',p.ap_materno) AS 'Nombre' FROM pacientes INNER JOIN personas p ON p.id_persona = pacientes.id_persona WHERE pacientes.id_paciente = recetas.id_paciente) AS Paciente,
              (SELECT CONCAT(p.nombre,' ',p.ap_paterno,' ',p.ap_materno) AS 'Nombre' FROM doctores INNER JOIN personas p ON p.id_persona = doctores.id_persona WHERE doctores.id_doctor = recetas.id_doctor) AS Doctor,
                descripcion,
              (SELECT nombre FROM catalogo_medicamento WHERE recetas.id_medicamento = catalogo_medicamento.id_medicamento) AS Medicamento,
                cantidad,
                codigo_receta,
                id_registro,
                fecha_registro,
                hora_registro, 
                activo								
              FROM recetas
              ORDER BY id_paciente DESC",$conexion) or die (mysql_error());

	// $resultado = mysqli_query($conexion, $consulta);
  $i = 1;

  $pdf = new PDF('L');
  $pdf->AliasNbPages();
  $pdf->AddPage();

  $pdf->SetFillColor(177,177,177);
  $pdf->SetFont('Arial', 'B', 12);
   $pdf->Cell(6,6);
  $pdf->Cell(65, 6, 'Paciente', 1, 0, 'L', 1);
  $pdf->Cell(65, 6, 'Doctor', 1, 0, 'L', 1);
  $pdf->Cell(45, 6, 'Descripcion', 1, 0, 'L', 1);
  $pdf->Cell(45, 6, 'Medicamento', 1, 0, 'L', 1);
  $pdf->Cell(20, 6, 'Cantidad', 1, 0, 'C', 1);
  $pdf->Cell(25, 6, 'Folio', 1, 1, 'C', 1);
  
  /*$pdf->Cell(85, 6, 'Sede', 1, 1, 'C', 1);*/
  // $pdf->Cell(40, 6, utf8_decode('Categoría'), 1, 0, 'C', 1);
  
  // $pdf->Cell(2,6);


$pdf->SetFont('Arial', '', 12);
  while ($row = mysql_fetch_array($consulta)) {
     $pdf->Cell(6,6);
     $pdf->Cell(65,6,utf8_decode($row[1]),1,0,'L');
    $pdf->Cell(65,6,utf8_decode($row[2]),1,0,'L');
    $pdf->Cell(45,6,utf8_decode($row[3]),1,0,'L');
    $pdf->Cell(45,6,utf8_decode($row[4]),1,0,'L');
    $pdf->Cell(20,6,utf8_decode($row[5]),1,0,'L');
    $pdf->Cell(25,6,utf8_decode($row[6]),1,0,'L');
    
  	/*$pdf->Cell(85,8,utf8_decode($row[4]),1,1,'L');*/
  	// $pdf->Cell(40,6,utf8_decode($row[2]),1,0,'C');
  	

    }


  $pdf->Output();





?>