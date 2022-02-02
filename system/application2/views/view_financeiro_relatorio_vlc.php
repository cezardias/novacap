<?php
//print_r($resultvlc);
header('Content-type: application/pdf');
$this->load->library('Fpdf_Horiz_valor_liq_contabil.php');
$pdf = new Fpdf_Horiz_valor_liq_contabil('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();	
$auditoriaresult = '00';
if($resultvlc!=NULL):
	$pdf->SetFont('Arial','',7);
	$y = 38;
	$linha = 0;
	foreach ($resultvlc as $it):
		//$Interessado = $it->Interessado;
		$Interessado = $it->InteressadoAbreviado; //INTERESASDO E OUTROS
		$CpfCnpj = $it->CpfCnpj; 
			if(strlen($CpfCnpj)<3){$CpfCnpj="-";}
		$ProcessoJudicial = $it->ProcessoJudicial;
		$ProcessoAdministrativo = $it->ProcessoAdministrativo;
			if(strlen($ProcessoAdministrativo)<3){$ProcessoAdministrativo="-";}
		$ProbabilidadeDePerda = $it->ProbabilidadeDePerda;
		$Assunto = $it->Assunto;
		$Assunto = substr($Assunto,0,30);
		$Condenacao = $it->Condenacao;
			if($Condenacao != ""){$Condenacao = number_format($Condenacao, 2, ',', '.');}else{$Condenacao="0,00";}
		$Sentenca = $it->Sentenca;
			if($Sentenca != ""){$Sentenca = number_format($Sentenca, 2, ',', '.');}else{$Sentenca="0,00";}
		$DepositoJudicial = $it->DepositoJudicial;
			if($DepositoJudicial != ""){$DepositoJudicial = number_format($DepositoJudicial, 2, ',', '.');}else{$DepositoJudicial="0,00";}
		$BloqueioJudicial = $it->BloqueioJudicial;
			if($BloqueioJudicial != ""){$BloqueioJudicial = number_format($BloqueioJudicial, 2, ',', '.');}else{$BloqueioJudicial="0,00";}
		$ValorLiquidoContabil = $it->ValorLiquidoContabil;
			if($ValorLiquidoContabil != ""){$ValorLiquidoContabil = number_format($ValorLiquidoContabil, 2, ',', '.');}else{$ValorLiquidoContabil="0,00";}
		$Situacao = $it->Situacao;		
	
		if($Interessado != 'ZZZZZZZ'){
			$pdf->SetXY(10,$y);
			$pdf->MultiCell(55,4,substr($Interessado,0,35)."\n".$CpfCnpj,0,'L',0,0);
			$pdf->SetXY(65,$y);
			$pdf->MultiCell(40,4,$ProcessoJudicial."\n".$ProcessoAdministrativo,0,'L',0,0);
			$pdf->SetXY(105,$y);
			$pdf->MultiCell(50,4,$Assunto."\n".$ProbabilidadeDePerda,0,'L',0,0);
			$pdf->SetXY(155,$y);
			$pdf->MultiCell(23,8,$Condenacao,0,'R',0,0);
			$pdf->SetXY(178,$y);
			$pdf->MultiCell(23,8,$Sentenca,0,'R',0,0);
			$pdf->SetXY(200,$y);
			$pdf->MultiCell(23,8,$DepositoJudicial,0,'R',0,0);
			$pdf->SetXY(223,$y);
			$pdf->MultiCell(23,8,$BloqueioJudicial,0,'R',0,0);
			$pdf->SetXY(246,$y);
			$pdf->MultiCell(23,8,$ValorLiquidoContabil,0,'R',0,0);
			$pdf->SetXY(269,$y);
			$pdf->MultiCell(18,8,$Situacao,0,'C',0,0);
		}else{
			$pdf->SetFont('Arial','B',7.5);
			$pdf->SetFillColor(211,211,211);
			$pdf->SetXY(10,$y+0.2);
			$pdf->MultiCell(147,8,'TOTAL',0,'L',1,0);
			$pdf->SetXY(155,$y+0.2);
			$pdf->MultiCell(23,8,$Condenacao,0,'R',1,0);
			$pdf->SetXY(178,$y+0.2);
			$pdf->MultiCell(23,8,$Sentenca,0,'R',1,0);
			$pdf->SetXY(200,$y+0.2);
			$pdf->MultiCell(23,8,$DepositoJudicial,0,'R',1,0);
			$pdf->SetXY(223,$y+0.2);
			$pdf->MultiCell(23,8,$BloqueioJudicial,0,'R',1,0);
			$pdf->SetXY(246,$y+0.2);
			$pdf->MultiCell(23,8,$ValorLiquidoContabil,0,'R',1,0);
			$pdf->SetXY(269,$y+0.2);
			$pdf->MultiCell(18,8,'-',0,'C',1,0);
		}
		$y = $y+8;
		$linha++;		
		$titulo = array();
		$col = array();	 
		$col[] = array('text' => '', 'width' => '277', 'height' => '0', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');	
		$titulo[] = $col;
		$pdf->WriteTable($titulo);
		$pdf->Ln();
		if($linha==18){ //Fun��o que controle quebra de linha e de p�ginas.
			$pdf->AddPage();
			$y = 38;
			$linha = 0;
		}
	endforeach;	
	$pdf->Output("relatorio.pdf","I");
	//$pdf->Output("relatorio.pdf","D");
else:?>
<?php $this->load->view('view_cabecalho');?>
	<h2>Relat�rio - Horas Extras</h2>
	<div class="status_box warning">
	<h6>Aten��o</h6>
		<ul>
			<li>Nenhum registro encontrado!</li>
		</ul>
	</div>
	<br>
<?php 
	$this->load->view('view_rodape');
endif;
?>