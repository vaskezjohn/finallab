<?php
require ("fpdf181/fpdf.php");
require ("clases/AccesoDatos.php");
require ("../slim/php/Pedido.php");
class Pdf extends FPDF
{
	//cabecera
	function Header()
	{
		//logo,
		//$this->Image('TP/fotos/.jpg',10,8,50);
		//Arial Bold 14
		$this->SetFont('Arial','B',14);
		//Espacio a la derecha 
		$this->Cell(80);
		//titulo
		$this->Cell(30,10,'Pizzeria',0,0,'C');
		// Salto de linea
		$this->Ln(20);
	}
	//pie de pagina
	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','I',12);
		$this->Cell(0,10,'Page'.$this->PageNo(),0,0,'C');
	}
}//fin clase pdf
$pdf= new Pdf();
//$pdf->AliasBbPages();
$pdf->AddPage();
$pdf->SetFillColor(100,100,100);
$pdf->SetFont('Times','B','12');
$pdf->SetX(5);
$pdf->Cell(195,6,'PIZZERIA',1,0,'C',1);
$pdf->SetX(35);
$pdf->Ln();

$pdf->SetFillColor(232,232,232);
$pdf->SetX(5);
$pdf->Cell(30,6,'Tipos',1,0,'C',1);
$pdf->SetX(35);
$pdf->Cell(45,6,'Cantidad',1,0,'C',1);
$pdf->SetX(80);
$pdf->Cell(120,6,'Cliente',1,0,'C',1);
$pdf->SetX(200);

$pdf->Ln();

$data=Pedidos::TraerPedidos();

try {
	foreach ($data as $row) 
	{
	$pdf->SetFont('Times','B','12');
	$pdf->SetFillColor(250,250,250);
	$pdf->SetX(5);
	$pdf->Cell(30,6,$row->tipo,1,0,'C',1);
	$pdf->SetX(35);
	$pdf->Cell(45,6,$row->cantidad,1,0,'C',1);
	$pdf->SetX(80);
	$pdf->Cell(120,6,$row->nombre,1,0,'C',1);
	$pdf->SetX(200);
	
	$pdf->Ln();
	}	
} catch (Exception $e) {}	
$pdf->Output();






?>