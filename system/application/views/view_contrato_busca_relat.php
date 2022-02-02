<?php
//print_r($contresult);
header('Content-type: application/pdf');
$this->load->library('Fpdf_Horizontal_contratos.php');
$pdf=new Fpdf_Horizontal_contratos('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();

if($contresult != NULL){
    $situacao = $this->session->userdata('situacao'); // 1 - Ativo, 0 - Inativo, NULL - Todos.
    if($situacao=='1'){$status=utf8_decode('SITUAÇÃO: CONTRATOS ATIVOS');}
    else if($situacao=='0'){$status=utf8_decode('SITUAÇÃO: CONTRATOS INATIVOS');}
    else{$status=utf8_decode('SITUAÇÃO: CONTRATOS ATIVOS E INATIVOS');}
    $titulo = array();
    $col = array();
    $col[] = array('text' => $status, 'width' => '276', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
    $titulo[] = $col;
    $pdf->WriteTable($titulo);

	$titulo = array();
	$col = array();
	$col[] = array('text' => utf8_decode('CONTR. N°'), 'width' => '20', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$col[] = array('text' => 'MODALIDADE', 'width' => '25', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$col[] = array('text' => utf8_decode('PROCESSO N°'), 'width' => '25', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$col[] = array('text' => 'NOME DA EMPRESA', 'width' => '50', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$col[] = array('text' => utf8_decode('LICIT. N°'), 'width' => '20', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$col[] = array('text' => 'DIR.', 'width' => '10', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$col[] = array('text' => 'OBJETO', 'width' => '68', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$col[] = array('text' => 'VALOR', 'width' => '25', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$col[] = array('text' => 'DT ASS.', 'width' => '15', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$col[] = array('text' => utf8_decode('VIGÊNCIA'), 'width' => '18', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);

	foreach ($contresult as $ctr):
		$Id = $ctr->Id;
		$ContrNr = $ctr->ContratoNumero;
		$LicitMod = $ctr->LicitacaoModalidade;
		$ProcNr = $ctr->ProcessoNr;
		$Nome = $ctr->Empresa;
		$LicNum = $ctr->LicitacaoNumero;
		$Dir = $ctr->Diretoria;
		$Objeto = $ctr->Objeto;
		$PrazoVigeAtivo = $ctr->PrazoDeVigenciaAtivo;
		$Valor = $ctr->Valor;
		$DataDeAssin = $ctr->DataDeAssinatura; // data j� formatada do banco
		if($DataDeAssin == NULL){
			$DataDeAssin = "-";
		}
		$PrazoVigAditado = $ctr->PrazoDeVigenciaAditado; // data j� formatada do banco
		if($PrazoVigAditado == ""){
			$PrazoVigAditado = "-";
		}

		$titulo = array();
		$col = array();
		$col[] = array('text' => $ContrNr, 'width' => '20', 'height' => '4', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $LicitMod, 'width' => '25', 'height' => '4', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $ProcNr, 'width' => '25', 'height' => '4', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $Nome, 'width' => '50', 'height' => '4', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $LicNum, 'width' => '20', 'height' => '4', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $Dir, 'width' => '10', 'height' => '4', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $Objeto, 'width' => '68', 'height' => '4', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $Valor, 'width' => '25', 'height' => '4', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $DataDeAssin, 'width' => '15', 'height' => '4', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $PrazoVigAditado, 'width' => '18', 'height' => '4', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$titulo[] = $col;
		$pdf->WriteTable($titulo);
	endforeach;
	$pdf->Ln(2);
	//VARIAVEL ZERADA
	//$columns = "";//
	$pdf->Output("relatorio.pdf","I");
	//$pdf->Output("relatorio.pdf","D");
}else{
	$titulo = array();
	$col = array();
	$col[] = array('text' => 'NENHUM REGISTRO ENCONTRADO...', 'width' => '275', 'height' => '15', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);
	$pdf->Output("relatorio.pdf","I");
}
?>
