<?php
//print_r($situacaoctrs);
header('Content-type: application/pdf');
$this->load->library('Fpdf_Table_situacao_contrato.php');
$pdf=new Fpdf_Table_situacao_contrato('L','mm','A4');

$pdf->AliasNbPages();
$pdf->AddPage();
if($situacaoctrs!=NULL){
	foreach($situacaoctrs as $sit):
		$IdContrato = $sit->Id;
		$Diretoria = $sit->Diretoria;
		$Contrato = $sit->Contrato;
		$ProcessoNr = $sit->ProcessoNr;
		$Empresa = $sit->Empresa;
		$Vigencia = $sit->Vigencia; if($Vigencia==""){$Vigencia='';}else{$Vigencia = date('d/m/Y',strtotime($Vigencia));}
		$Mensagem = $sit->Mensagem;
		$DiasRestanteCor = $sit->DiasRestanteCor;

		$titulo = array();
		$col = array();
		$col[] = array('text' => $Diretoria, 'width' => '10', 'height' => '6', 'align' => 'C', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
		$col[] = array('text' => $Contrato, 'width' => '25', 'height' => '6', 'align' => 'C', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
		$col[] = array('text' => $ProcessoNr, 'width' => '30', 'height' => '6', 'align' => 'C', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
		$col[] = array('text' => $Empresa, 'width' => '140', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
		$col[] = array('text' => $Vigencia, 'width' => '18', 'height' => '6', 'align' => 'C', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
		$col[] = array('text' => $Mensagem, 'width' => '52', 'height' => '6', 'align' => 'C', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
		$titulo[] = $col;
		$pdf->WriteTable($titulo);
	endforeach;

	$columns = "";
	$pdf->Output("relatorio.pdf","I");
	//$pdf->Output("relatorio.pdf","D");
}else{?>
<?php $this->load->view('view_cabecalho');?>
	<h2>Relat&oacute;rio - Situa&atilde;o de contratos</h2>
	<div class="status_box warning">
	<h6>Aten&atilde;o:</h6>
		<ul>
			<li>Nenhum registro encontrato!</li>
		</ul>
	</div>
	<br>
<?php
	$this->load->view('view_rodape');
}?>
