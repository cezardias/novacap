<?php
//print_r($resultvlc);

if(!empty($resultvlc)):
	header('Content-type: application/pdf');
$this->load->library('Fpdf_Horiz_valor_liq_contabil.php');
$pdf = new Fpdf_Horiz_valor_liq_contabil('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$auditoriaresult = '00';
	$pdf->SetFont('Arial','',7);
	$pdf->SetFont('Courier','',6);
	$y = 38;
	$linha = 0;
	foreach ($resultvlc as $it):
		//$Interessado = $it->Interessado;
		$Interessado = $it->InteressadoAbreviado; //INTERESASDO E OUTROS
		$CpfCnpj = $it->CpfCnpj;
			if(strlen($CpfCnpj)<3){$CpfCnpj="-";}
		$ProcessoJudicial = $it->ProcessoJudicial;
		


		if($ProcessoJudicial == NULL){$ProcessoJudicial = '--------------';};
		$ProcessoAdministrativo = $it->ProcessoAdministrativo;
			if(strlen($ProcessoAdministrativo)<3){$ProcessoAdministrativo="------------------";};
		$ProbabilidadeDePerda = $it->ProbabilidadeDePerda;
		$Assunto = $it->Assunto;
		$Assunto = substr($Assunto,0,30);
		$Acordao = $it->Acordao;
			if($Acordao != ""){$Acordao = number_format($Acordao, 2, ',', '.');}else{$Acordao="0,00";}
		$CalculoHomologado = $it->CalculoHomologado;
			if($CalculoHomologado != ""){$CalculoHomologado = number_format($CalculoHomologado, 2, ',', '.');}else{$CalculoHomologado="0,00";}
		$Condenacao = $it->Condenacao;
			if($Condenacao != ""){$Condenacao = number_format($Condenacao, 2, ',', '.');}else{$Condenacao="0,00";}
		$Sentenca = $it->Sentenca;
			if($Sentenca != ""){$Sentenca = number_format($Sentenca, 2, ',', '.');}else{$Sentenca="0,00";}
		$DepositoJudicial = $it->DepositoJudicial;
			if($DepositoJudicial != ""){$DepositoJudicial = number_format($DepositoJudicial, 2, ',', '.');}else{$DepositoJudicial="0,00";}
		$PagamentoDeAcao = $it->PagamentoDeAcao;
			if($PagamentoDeAcao != ""){$PagamentoDeAcao = number_format($PagamentoDeAcao, 2, ',', '.');}else{$PagamentoDeAcao="0,00";}
		$BloqueioJudicial = $it->BloqueioJudicial;
			if($BloqueioJudicial != ""){$BloqueioJudicial = number_format($BloqueioJudicial, 2, ',', '.');}else{$BloqueioJudicial="0,00";}
		$ValorLiquidoContabil = $it->ValorLiquidoContabil;
			if($ValorLiquidoContabil != ""){$ValorLiquidoContabil = number_format($ValorLiquidoContabil, 2, ',', '.');}else{$ValorLiquidoContabil="0,00";}
		$Situacao = $it->Situacao;
		$pago = $it->Pago;
		$xxx ="00000000000";
		//$Ordem = $it->Ordem;

		$valordecontingenciamento = $it->ValorDeContingenciamento;
		if($valordecontingenciamento != ""){$valordecontingenciamento = number_format($valordecontingenciamento, 2, ',', '.');}else{$valordecontingenciamento="0,00";}

		$convolado = $it->Convolado;
		if($convolado != ""){$convolado = number_format($convolado, 2, ',', '.');}else{$convolado="0,00";}

		$pagamento = $it->PagamentoDeAcao;
		if($pagamento != ""){$pagamento = number_format($pagamento, 2, ',', '.');}else{$pagamento="0,00";}

		$depjudicial = $it->DepositoJudicial;
		if($depjudicial != ""){$depjudicial = number_format($depjudicial, 2, ',', '.');}else{$depjudicial="0,00";}

		$bloqjudicial = $it->BloqueioJudicial;
		if($bloqjudicial != ""){$bloqjudicial = number_format($bloqjudicial, 2, ',', '.');}else{$bloqjudicial="0,00";}

		if($pago != 'TOTAL'){
		$pdf->SetXY(10,$y);
		$pdf->MultiCell(45,4,substr($Interessado,0,35)."\n".$CpfCnpj,0,'L',0,0);
		$pdf->SetXY(55,$y);
		$pdf->MultiCell(40,4,$ProcessoJudicial."\n".$ProcessoAdministrativo,0,'L',0,0);
		$pdf->SetXY(95,$y);
		$pdf->MultiCell(42,4,$Assunto."\n".$ProbabilidadeDePerda,0,'L',0,0);
		$pdf->SetXY(142,$y);
		$pdf->MultiCell(20,8,$valordecontingenciamento,0,'R',0,0);
		$pdf->SetXY(165,$y);
		$pdf->MultiCell(20,8,$pagamento,0,'R',0,0);
		$pdf->SetXY(187,$y);
		$pdf->MultiCell(20,8,$convolado,0,'R',0,0);
		$pdf->SetXY(208,$y);
		$pdf->MultiCell(20,8,$DepositoJudicial,0,'R',0,0);
		$pdf->SetXY(230,$y);
		$pdf->MultiCell(20,8,$BloqueioJudicial,0,'R',0,0);
		$pdf->SetXY(258,$y);
		$pdf->MultiCell(20,8,$ValorLiquidoContabil,0,'R',0,0);
		
		} else {
			$pdf->SetFont('Courier','B',6);
			$pdf->SetFillColor(211,211,211);
			$pdf->SetXY(10,$y+0.2);
			$pdf->MultiCell(117,8,'TOTAL',0,'L',1,0);
			$pdf->SetXY(127,$y+0.2);
			$pdf->MultiCell(20,8,$valordecontingenciamento,0,'R',1,0);
			$pdf->SetXY(147,$y+0.2);
			$pdf->MultiCell(20,8,$pagamento,0,'R',1,0);
			$pdf->SetXY(167,$y+0.2);
			$pdf->MultiCell(20,8,$convolado,0,'R',1,0);
			$pdf->SetXY(187,$y+0.2);
			$pdf->MultiCell(20,8,$DepositoJudicial,0,'R',1,0);
			$pdf->SetXY(207,$y+0.2);
			$pdf->MultiCell(20,8,$BloqueioJudicial,0,'R',1,0);
			$pdf->SetXY(227,$y+0.2);
			$pdf->MultiCell(20,8,$ValorLiquidoContabil,0,'R',1,0);
			
		}
		$y = $y+8;
		$linha++;
		$titulo = array();
		$col = array();
		$col[] = array('text' => '', 'width' => '277', 'height' => '0', 'align' => 'C', 'font_name' => 'Courier', 'font_size' => '6', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');
		$titulo[] = $col;
		$pdf->WriteTable($titulo);
		$pdf->Ln();
		if($linha==18){ //Function que controle quebra de linha e de paginas.
			$pdf->AddPage();
			$y = 38;
			$linha = 0;
		}
	endforeach;
	$dategmt = gmdate('d-m-Y_H-i');
	$nomefile = 'relatorio_financ_vlc_'.$dategmt.'.pdf';
	$pdf->Output($nomefile,"I"); // D = SALVAR, I = VISUALISAR.
else:?>
<?php $this->load->view('view_cabecalho');?>
	<h2>Relat&oacute;rio - Horas Extras</h2>
	<div class="status_box warning">
	<h6>Aten&ccedil;&atilde;o</h6>
		<ul>
			<li>Nenhum registro encontrado!</li>
		</ul>
	</div>
	<br>
<?php
	$this->load->view('view_rodape');
endif;
?>
