<?php
header('Content-type: application/pdf');
//CARREGA BIBLIOTECA PDF
$this->load->library('Fpdf_Table_horizontal_teste.php');
$pdf=new Fpdf_Table_Horizontal_teste('L','mm','A4');

$pdf->AddPage();
/* TOTAL DA LARGURA NO MODO P - 190 */
//TÍTULOS
$pdf->SetFont('arial','B',12);
$pdf->Cell(50,5,'Nome',1,0,"L");
$pdf->Cell(50,5,'Endereço',1,0,"L");
$pdf->Cell(60,5,'E-mail',1,0,"L");
$pdf->Cell(30,5,'Telefone',1,1,"L");
$pdf->Ln(0);

//ARRAY DE DADOS
$pdf->SetFont('arial','',12);
for($i= 1; $i <100;$i++){
    $pdf->Cell(50,5,'José Antonio',1,0,"L");
    $pdf->Cell(50,5,'SGCV 10/11',1,0,"L");
    $pdf->Cell(60,5,'joseantoniobsi@gmail.com',1,0,"L");
    $pdf->Cell(30,5,'6199800-4444',1,1,"L");
}
$pdf->Output("arquivo.pdf","I"); //D - Força salvar, I - Abre no browser.
	 
$this->load->view('view_rodape');