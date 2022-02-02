<?php
//print_r($detailautuacao);
header('Content-type: application/pdf');
$this->load->library('Fpdf_Table_vertical_aut_processo.php');
$pdf=new Fpdf_Table_Vertical_aut_processo('P','mm','A4');

$pdf->AddPage();
$pdf->SetFont('arial','B',14);
$pdf->Cell(190,8,'ASSESSORIA JURÍDICA - ASJUR/PRES',0,0,"C");
$pdf->Ln(14);

$pdf->SetFont('arial','B',13);
$pdf->Cell(190,7,'SOLICITAÇÃO DE AUTUAÇÃO DE PROCESSO',1,0,"C");
$pdf->Ln(13);
/*
Id
Sisprot
Autor
Reu
Assunto
ProcessoJudicialNumero
ProcessoJudicialNumeroAntigo
Vara
AudienciaDataHora
AudienciaTipo
Data
*/

foreach ($detailautuacao as $item):
	$Sisprot = $item->Sisprot;
	if((empty($Sisprot)||($Sisprot=="NULL"))){$Sisprot="-";}	
	$Autor = $item->Autor;
	if((empty($Autor)||($Autor=="NULL"))){$Autor="-";}
	$Reu = $item->Reu;
	if((empty($Reu)||($Reu=="NULL"))){$Reu="-";}
	$Assunto = $item->Assunto;
	if((empty($Assunto)||($Assunto=="NULL"))){$Assunto="-";}else{$Assunto=substr($Assunto,0,46);}
	$ProcessoJudicialNumero = $item->ProcessoJudicialNumero;
	if((empty($ProcessoJudicialNumero)||($ProcessoJudicialNumero=="NULL"))){$ProcessoJudicialNumero="-";}
	$Vara = $item->Vara;
	if((empty($Vara)||($Vara=="NULL"))){$Vara="-";}
	$AudienciaDataHora = $item->AudienciaDataHora;
	if($AudienciaDataHora==""){$AudienciaDataHora='';}else{$AudienciaDataHora = date('d/m/Y H:i',strtotime($AudienciaDataHora));}
	$AudienciaTipo = $item->AudienciaTipo;
	if((empty($AudienciaTipo)||($AudienciaTipo=="NULL"))){$AudienciaTipo="";}
	$Data = $item->Data;
	if((empty($Data)||($Data=="NULL"))){$Data="";}
endforeach;

$titulo = array();
$col = array();	 
$col[] = array('text' => '', 'width' => '95', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '14', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTR');	
$col[] = array('text' => '', 'width' => '95', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '14', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTR');
$titulo[] = $col;
$pdf->WriteTable($titulo);

$titulo = array();
$col = array();	 
$col[] = array('text' => 'À', 'width' => '95', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '14', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LR');	
$col[] = array('text' => '', 'width' => '95', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '14', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LR');
$titulo[] = $col;
$pdf->WriteTable($titulo);

$titulo = array();
$col = array();	 
$col[] = array('text' => 'SEAD/DIPAD/DA', 'width' => '95', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '14', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LR');
$col[] = array('text' => 'MEMO/SISPROT Nº '.$Sisprot, 'width' => '95', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '14', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LR');	
$titulo[] = $col;
$pdf->WriteTable($titulo);

$titulo = array();
$col = array();	 
$col[] = array('text' => '', 'width' => '95', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '14', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LBR');	
$col[] = array('text' => '', 'width' => '95', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '14', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LBR');
$titulo[] = $col;
$pdf->WriteTable($titulo);
$pdf->Ln(6);

$titulo = array();
$col = array();	 
$col[] = array('text' => '', 'width' => '190', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '14', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTR');	
$titulo[] = $col;
$pdf->WriteTable($titulo);

$titulo = array();
$col = array();	 
$col[] = array('text' => 'Pelo presente estamos encaminhando o documento anexo para que seja autuado e devolvido à ASJUR/PRES.', 'width' => '190', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '15', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LR');	
$titulo[] = $col;
$pdf->WriteTable($titulo);

$titulo = array();
$col = array();	 
$col[] = array('text' => '', 'width' => '190', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '14', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LBR');	
$titulo[] = $col;
$pdf->WriteTable($titulo);
$pdf->Ln(6);

$titulo = array();
$col = array();	 
$col[] = array('text' => '', 'width' => '190', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTR');	
$titulo[] = $col;
$pdf->WriteTable($titulo);
$titulo = array();

$titulo = array();
$col = array();	 
$col[] = array('text' => 'AUTOR', 'width' => '30', 'height' => '8', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '13', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'L');
$col[] = array('text' => ': '.$Autor, 'width' => '160', 'height' => '8', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'R');	
$titulo[] = $col;
$pdf->WriteTable($titulo);

$titulo = array();
$col = array();	 
$col[] = array('text' => 'RÉU', 'width' => '30', 'height' => '8', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '13', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'L');
$col[] = array('text' => ': '.$Reu, 'width' => '160', 'height' => '8', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'R');	
$titulo[] = $col;
$pdf->WriteTable($titulo);

$titulo = array();
$col = array();	 
$col[] = array('text' => 'ASSUNTO', 'width' => '30', 'height' => '8', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '13', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'L');
$col[] = array('text' => ': '.$Assunto, 'width' => '160', 'height' => '8', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'R');	
$titulo[] = $col;
$pdf->WriteTable($titulo);

$titulo = array();
$col = array();	 
$col[] = array('text' => 'PROCESSO', 'width' => '30', 'height' => '8', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '13', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'L');
$col[] = array('text' => ': '.$ProcessoJudicialNumero, 'width' => '160', 'height' => '8', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'R');	
$titulo[] = $col;
$pdf->WriteTable($titulo);

$titulo = array();
$col = array();	 
$col[] = array('text' => 'AUDIÊNCIA', 'width' => '30', 'height' => '8', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '13', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'L');
$col[] = array('text' => ': '.$AudienciaDataHora.' - '.$AudienciaTipo, 'width' => '160', 'height' => '8', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'R');	
$titulo[] = $col;
$pdf->WriteTable($titulo);

$titulo = array();
$col = array();	 
$col[] = array('text' => '', 'width' => '190', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '12', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LBR');	
$titulo[] = $col;
$pdf->WriteTable($titulo);
$titulo = array();
$pdf->Ln(17);

// leitura das datas
$dia = date('d');
$mes = date('m');
$ano = date('Y');
switch ($mes){
	case 1: $mes = "janeiro"; break;
	case 2: $mes = "fevereiro"; break;
	case 3: $mes = "março"; break;
	case 4: $mes = "abril"; break;
	case 5: $mes = "maio"; break;
	case 6: $mes = "junho"; break;
	case 7: $mes = "julho"; break;
	case 8: $mes = "agosto"; break;
	case 9: $mes = "setembro"; break;
	case 10: $mes = "outubro"; break;
	case 11: $mes = "novembro"; break;
	case 12: $mes = "dezembro"; break;
}
$titulo = array();
$col = array();	 
$col[] = array('text' => 'Brasília, '.$dia.' de '.$mes.' de '.$ano, 'width' => '190', 'height' => '13', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '13', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');	
$titulo[] = $col;
$pdf->WriteTable($titulo);
$titulo = array();
$pdf->Ln(48);

$titulo = array();
$col = array();	 
$col[] = array('text' => 'COMPANHIA URBANIZADORA DA NOVA CAPITAL DO BRASIL - NOVACAP', 'width' => '190', 'height' => '4', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');	
$titulo[] = $col;
$pdf->WriteTable($titulo);

$titulo = array();
$col = array();	 
$col[] = array('text' => 'SETOR DE ÁREAS PÚBLICAS - SUL - LOTE B - BRASÍLIA - DF', 'width' => '190', 'height' => '4', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');	
$titulo[] = $col;
$pdf->WriteTable($titulo);

$pdf->Output("arquivo.pdf","I"); //D - Força salvar, I - Abre no browser. 
$this->load->view('view_rodape');