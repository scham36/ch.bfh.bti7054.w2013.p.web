<?php
	// Pdf erstellen über den Warenkorb

	include("Cart.inc.php");

	session_start();

	$cartArray = $_SESSION["cart"]->getArray();
	$firstName = $_GET["firstName"];
	$lastName = $_GET["lastName"];

	define('FPDF_FONTPATH','font/');
	require('fpdf.php');

	//Create new pdf file
	$pdf=new FPDF();

	//Open file
	$pdf->Open();

	//Disable automatic page break
	$pdf->SetAutoPageBreak(false);

	// Add first page
	$pdf->AddPage();

	// Set initial values
	$y_axis_initial = 50;
	$row_height = 6;
	$max = 25;
	$i = 0;

	//print column titles for the actual page
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(200, 0, 'scham36 - Kleider und mehr', 0, 0, 'C');
	$pdf->Ln(1);
	$pdf->SetFont('Arial', 'B', 32);
	$pdf->Ln(10);
	$pdf->Image('images/scham36.png', 20, 20, 20);
	$pdf->Cell(190 , 20, 'Bestellung', 0, 0, 'C');
	$pdf->Image('images/scham36.png', 170, 20, 20);
	$pdf->Ln(10);
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(190 , 20, $firstName." ".$lastName, 0, 0, 'C');
	$pdf->Ln(40);
	$pdf->SetFillColor(232, 232, 232);
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetY($y_axis_initial);
	$pdf->SetX(25);
	$pdf->Cell(30, 6, 'Bezeichnung', 1, 0, 'L', 1);
	$pdf->Cell(100, 6, 'Beschreibung', 1, 0, 'L', 1);
	$pdf->Cell(30, 6, 'Preis', 1, 0, 'R', 1);

	$y_axis = $y_axis_initial + $row_height;

	foreach ($cartArray as $art=>$qty)
	{
	//If the current row is the last one, create new page and print column title
	if ($i == $max)
	{
	$pdf->AddPage();

	//print column titles for the current page
	$pdf->SetY($y_axis_initial);
	$pdf->SetX(25);
	$pdf->Cell(30, 6, 'Bezeichnung', 1, 0, 'L', 1);
	$pdf->Cell(100, 6, 'Beschreibung',1,0,'L', 1);
	$pdf->Cell(30, 6 , 'Preis', 1, 0, 'R', 1);

	//Go to next row
	$y_axis = $y_axis + $row_height;

	//Set $i variable to 0 (first row)
	$i = 0;
	}
	$pdf->SetFont('Arial', '', 10);
	$pdf->SetY($y_axis);
	$pdf->SetX(25);
	$pdf->Cell(30, 6, $art, 1, 0, 'L', 1);
	$pdf->Cell(100, 6, "Hallo Welt", 1, 0, 'L', 1);
	$pdf->Cell(30, 6, $qty, 1, 0, 'R' ,1);

	//Go to next product
	$y_axis = $y_axis + $row_height;
	$i = $i + 1;
	}

	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetY($y_axis+10);
	$pdf->SetX(25);
	$pdf->Cell(150, 6, 'Bestellen Sie alle Artikel in unserem Webshop', 0, 0, 'C', 1);
	$pdf->Output('bestellung.pdf', 'I');
?>
