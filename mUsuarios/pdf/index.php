<?php
  
  include 'plantilla.php';
  include '../../conexion/conexion.php';

$consulta=mysql_query("SELECT 
                      id_farmacia,
                      numero_farmacia,
                      encargado,
                      ubicacion,
                      activo
                      FROM farmacias",$conexion) or die (mysql_error());

	// $resultado = mysqli_query($conexion, $consulta);
  $i = 1;

  $pdf = new PDF('L');
  $pdf->AliasNbPages();
  $pdf->AddPage();

  $pdf->SetFillColor(177,177,177);
  $pdf->SetFont('Arial', 'B', 12);
   $pdf->Cell(40,6);
  $pdf->Cell(50, 6, 'Numero de Farmacia', 1, 0, 'L', 1);
  $pdf->Cell(70, 6, 'Encargado', 1, 0, 'C', 1);
  $pdf->Cell(85, 6, 'Ubicacion', 1, 1, 'C', 1);
  /*$pdf->Cell(85, 6, 'Sede', 1, 1, 'C', 1);*/
  // $pdf->Cell(40, 6, utf8_decode('Categoría'), 1, 0, 'C', 1);
  
  // $pdf->Cell(2,6);


$pdf->SetFont('Arial', '', 12);
  while ($row = mysql_fetch_array($consulta)) {
     $pdf->Cell(40,6);
  	$pdf->Cell(50,8,($row[1]),1,0,'L');
  	$pdf->Cell(70,8,utf8_decode($row[2]),1,0,'L');
  	$pdf->Cell(85,8,utf8_decode($row[3]),1,1,'L');
  	/*$pdf->Cell(85,8,utf8_decode($row[4]),1,1,'L');*/
  	// $pdf->Cell(40,6,utf8_decode($row[2]),1,0,'C');
  	

    }


  $pdf->Output();





?>