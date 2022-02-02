<?php
$this->load->library('Fpdf_Table_Horizontal_atual.php');
$pdf=new Fpdf_Table_Horizontal_atual('L','mm','A4');
//print_r($auditoriaresult);
if($auditoriaresult!=NULL):
	$pdf->AliasNbPages();
	$pdf->AddPage();
	foreach ($auditoriaresult as $audt):
		$Tipo = $audt->Tipo;
		if(($Tipo=="")||($Tipo=='NULL')){$Tipo='-';}
		$InteressadoNome = $audt->InteressadoNome;
		if(($InteressadoNome=="")||($InteressadoNome=='NULL')){$InteressadoNome='-';}
		$ProcessoJud = $audt->ProcessoJudicialNumero; //J� mascarado.
		$PrAdmin = $audt->ProcessoAdministrativoNumero; //J� mascarado.
		$Assunto = $audt->Assunto;
		$DataDoAjuizamento  = $audt->DataDoAjuizamento ;
		if(($Assunto=="")||($Assunto=='NULL')){$Assunto='-';}
		$ProbabilidadeDePerda = $audt->ProbabilidadeDePerda;
		if(($ProbabilidadeDePerda=="")||($ProbabilidadeDePerda=='NULL')){$ProbabilidadeDePerda='-';}
		$CausaValor = $audt->CausaValor;
		if($CausaValor != ""){$CausaValor = number_format($CausaValor, 2, ',', '.');}else{$CausaValor="0,00";}
		$SetencaValor = $audt->SentencaValor;
		if($SetencaValor != ""){$SetencaValor = number_format($SetencaValor, 2, ',', '.');}else{$SetencaValor="0,00";}
		$CondenacaoValor = $audt->CondenacaoValor;
		if($CondenacaoValor != ""){$CondenacaoValor = number_format($CondenacaoValor, 2, ',', '.');}else{$CondenacaoValor="0,00";}
		$AcordaoValor = $audt->AcordaoValor;
		if($AcordaoValor != ""){$AcordaoValor = number_format($AcordaoValor, 2, ',', '.');}else{$AcordaoValor="0,00";}
		$Situacao = $audt->Situacao;
		if(($Situacao=="")||($Situacao=='NULL')){$Situacao='-';}

		$titulo = array();
		$col = array();
		$col[] = array('text' => $InteressadoNome, 'width' => '93', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '6', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $ProcessoJud, 'width' => '35', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '6', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $PrAdmin, 'width' => '23', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '6', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $Assunto, 'width' => '55', 'height' => '3', 'align' => 'L', 'font_name' => 'Courier', 'font_size' => '6', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $ProbabilidadeDePerda, 'width' => '17', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '6', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $CausaValor, 'width' => '23', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '6', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $DataDoAjuizamento , 'width' => '19', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '6', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $Situacao, 'width' => '11', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '6', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');//
		//$col[] = array('text' => $CondenacaoValor, 'width' => '24', 'height' => '3', 'align' => 'R', 'font_name' => 'Courier', 'font_size' => '6', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');//
		//$col[] = array('text' => $Situacao, 'width' => '11', 'height' => '3', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '6', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');//
		$titulo[] = $col;
		$pdf->WriteTable($titulo);
	endforeach;
	$pdf->Ln(2);

	//$columns = "";//
	$pdf->Output("relatorio.pdf","I");
	//$pdf->Output("relatorio.pdf","D");
else:?>
<?php $this->load->view('view_cabecalho');?>
	<h2>Relat�rio - Horas Extras</h2>
	<div class="status_box warning">
	<h6>INFORMA��O:</h6>
		<ul>
			<li>Nenhum resultado foi retornado para os par�metros informados!</li>
		</ul>
	</div>
	<br>
<?php
	$this->load->view('view_rodape');
endif;
?>
