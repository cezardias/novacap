<?php
$this->load->library('Fpdf_Table_Atas_Busca_Result.php');
$pdf = new Fpdf_Table_Atas_Busca_Result('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();

//$datainiciosol = $this->session->userdata('datainiciosol');
//$datafinalsol = $this->session->userdata('datafinalsol');
//if(($datainiciosol!="")&&($datafinalsol!="")){$data = 'Data: '.$datainiciosol.' a '.$datafinalsol;}

if($atasresult != NULL){
	foreach ($atasresult as $itens):
		$Id = $itens->Id;
		$AtaNr = $itens->AtaNr;
		$AtaAno = $itens->AtaAno;
		$AtaNumero = $itens->AtaNumero;
		$LicitacaoModalidade = $itens->LicitacaoModalidade;
		$ProcessoNr = $itens->ProcessoNr;
		$EmpresaNome = $itens->EmpresaNome;
		$LicitacaoNumero = $itens->LicitacaoNumero;
		$Diretoria = $itens->Diretoria;
		$Objeto = $itens->Objeto;
		$Valor = $itens->Valor; if($Valor != ""){$Valor = number_format($Valor, 2, ',', '.');}else{$Valor="0,00";}

		$titulo = array();
		$col = array();
		$col[] = array('text' => $AtaNr, 'width' => '20', 'height' => '6', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');
		$col[] = array('text' => $Diretoria, 'width' => '20', 'height' => '6', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');
		$col[] = array('text' => $LicitacaoNumero, 'width' => '20', 'height' => '6', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');
		$col[] = array('text' => $LicitacaoModalidade, 'width' => '60', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');		
		$col[] = array('text' => mb_strtoupper($EmpresaNome), 'width' => '120', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');
		$col[] = array('text' => $Valor, 'width' => '37', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');
		$titulo[] = $col;
		$pdf->WriteTable($titulo);
	endforeach;
	$columns = "";
	$pdf->Output("relatorio.pdf","I"); //VISUALIZAR RELATORIO
	//$pdf->Output("relatorio.pdf","D"); //SALVAR RELATORIO
}else{?>
<?php $this->load->view('view_cabecalho');?>
 	<h2>Relat&oacute;rio - Solicita&ccedil;&otilde;es</h2>
 	<div class="status_box warning">
 	<h6>Aten&ccedil;&atilde;o</h6>
 		<ul>
 			<li>Nenhum registo encontrado!</li>
 		</ul>
 	</div>
  	<br>
  <?php
	$this->load->view('view_rodape');
}
?>
