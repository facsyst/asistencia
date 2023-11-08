<?php

define('FPDF_FONTPATH','font/'); 
require_once('../fpdf/fpdf.php');
require_once('../modelo/UsoEquipo.php');
//AddPage(orientacion[PORTRAIT,LANDSCAPE], tamaño[A3,A4,LETTER,LEGAL])
//SetFont(tipo[COURIER, HELVETICA,ARIAL,TIMES,SYMBOL,ZAPDINGBATS],estilo[normal, B,I,U,tamaño],)
//Cell(ancho, alto, texto,bordes , ? , alineacion, rellenar, link),
//OutPut(destino[I,D,F,S] , nombre_archivo, utf8)


$objUsoEq = new UsoEquipo();

//CONSULTAMOS LOS DATOS NECESARIOS PARA MOSTRAR EN EL PDF
$listado = $objUsoEq->listar($_POST['desde'],$_POST['hasta'],$_POST['nombre'], $_POST['estado']);

$entidad = array(
				
				"nombre"=>"UNIVERSIDAD NACIONAL DE JAÉN",
                "area"=>"DEPARTAMENTO ACADÉMICO DE INGENIERIA MECÁNICA Y ELÉCTRICA"
				
			);

//INICIAMOS LA CREACIÓN DEL PDF
$pdf = new FPDF();
$pdf->AddPage();
//$pdf->AddPage('P',array(80,200)); FORMATO PARA TICKETS
$pdf->SetFont('Arial','B',8);

$pdf->Image("../fpdf/logo_isi.png",140,2,30,30);

$pdf->Ln(18);

$pdf->Cell(0, 10, 'REPORTE ACADEMICO DE ENTRADA Y SALIDA DE USUARIOS AL LABORATORIO DE CÓMPUTO - IME', 0, 1, 'C');
$pdf->Cell(0, 10, $entidad['nombre'], 0, 1, 'C');
$pdf->Cell(0, 10, $entidad['area'], 0, 1, 'C');

$pdf->Ln(3);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(10,6,"ITEM",1,0,'C',0);
$pdf->Cell(20,6,"CANTIDAD",1,0,'C',0);
$pdf->Cell(80,6,"PRODUCTO",1,0,'C',0);
$pdf->Cell(20,6,"PRECIO",1,0,'C',0);
$pdf->Cell(25,6,"SUBTOTAL",1,1,'C',0);

$pdf->SetFont('Arial','',8);




$pdf->Output();


?>