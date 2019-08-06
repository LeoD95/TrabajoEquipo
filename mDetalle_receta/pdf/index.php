<?php
  
  include 'plantilla.php';
  include '../../conexion/conexion.php';

$consulta=mysql_query("SELECT
d.id_detalle, r.id_receta,
  
(SELECT nombre FROM catalogo_medicamento WHERE d.id_medicamento = catalogo_medicamento.id_medicamento) AS Medicamento,
              d.cantidad,
              r.codigo_receta,
              d.id_registro,
              d.fecha_registro,
              d.hora_registro,
              d.activo								
              
            FROM detalle_receta d
            INNER JOIN recetas r ON d.id_receta = r.id_receta",$conexion) or die (mysql_error());

	// $resultado = mysqli_query($conexion, $consulta);
  $i = 1;

  $pdf = new PDF('L');
  $pdf->AliasNbPages();
  $pdf->AddPage();

  $pdf->SetFillColor(177,177,177);
  $pdf->SetFont('Arial', 'B', 12);
   $pdf->Cell(17,6);
  
  $pdf->Cell(80, 6, 'Medicamento', 1, 0, 'L', 1);
  $pdf->Cell(80, 6, 'Cantidad', 1, 0, 'L', 1);
  $pdf->Cell(80, 6, 'Codigo', 1, 1, 'L', 1);
  
  /*$pdf->Cell(85, 6, 'Sede', 1, 1, 'C', 1);*/
  // $pdf->Cell(40, 6, utf8_decode('Categoría'), 1, 0, 'C', 1);
  
  // $pdf->Cell(2,6);


$pdf->SetFont('Arial', '', 12);
  while ($row = mysql_fetch_array($consulta)) {
     $pdf->Cell(17,6);
    
    $pdf->Cell(80,6,utf8_decode($row[2]),1,0,'L');
    $pdf->Cell(80,6,utf8_decode($row[3]),1,0,'L');
    $pdf->Cell(80,6,utf8_decode($row[4]),1,1,'L');
  	/*$pdf->Cell(85,8,utf8_decode($row[4]),1,1,'L');*/
  	// $pdf->Cell(40,6,utf8_decode($row[2]),1,0,'C');
  	

    }


  $pdf->Output();





?>