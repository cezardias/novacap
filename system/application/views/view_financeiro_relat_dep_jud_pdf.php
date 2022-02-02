<?php
//print_r($resultvlc);
//print_r($resultvlctotal);
if($resultvlc!=NULL):
header('Content-type: application/pdf');
$this->load->library('Fpdf_Horiz_dep_judicial.php');
$pdf = new Fpdf_Horiz_dep_judicial('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$auditoriaresult = '00';

//$pdf->SetFont('Arial','',7);
$pdf->SetFont('Courier','',6);
$y = 38;
$linha = 0;
foreach ($resultvlc as $it):
  	$Autor = $it->Autor;
  	$CpfCnpj = $it->CpfCnpj;
  	$ProcessoJudicial = $it->ProcessoJudicial;
  	$ProcessoAdministrativo = $it->ProcessoAdministrativo;
  	$Situacao = $it->Situacao;
  	$ProbabilidadeDePerda = $it->ProbabilidadeDePerda;
  	$DepositoJudicial = $it->DepositoJudicial;
  	$AtualizacaoMonetaria = $it->AtualizacaoMonetaria;
  	$Convolado = $it->Convolado;
  	$Devolucao = $it->Devolucao;
  	$Estorno = $it->Estorno;
  	$Saldo = $it->Saldo;

		$pdf->SetXY(10,$y);
		$pdf->MultiCell(40,4,substr($Autor,0,35),0,'L',0,0);
		$pdf->SetXY(50,$y);
		$pdf->MultiCell(26,8,$CpfCnpj,0,'C',0,0);
		$pdf->SetXY(76,$y);
		$pdf->MultiCell(36,8,$ProcessoJudicial,0,'C',0,0);
		$pdf->SetXY(112,$y);
		$pdf->MultiCell(36,8,$ProcessoAdministrativo,0,'C',0,0);
		$pdf->SetXY(148,$y);
		$pdf->MultiCell(15,8,$Situacao,0,'C',0,0);
		$pdf->SetXY(163,$y);
		$pdf->MultiCell(15,8,$ProbabilidadeDePerda,0,'C',0,0);
		$pdf->SetXY(178,$y);
		$pdf->MultiCell(18,8,$DepositoJudicial,0,'R',0,0);
		$pdf->SetXY(196,$y);
		$pdf->MultiCell(18,8,$AtualizacaoMonetaria,0,'R',0,0);
		$pdf->SetXY(214,$y);
		$pdf->MultiCell(18,8,$Convolado,0,'R',0,0);
		$pdf->SetXY(232,$y);
		$pdf->MultiCell(18,8,$Devolucao,0,'R',0,0);
		$pdf->SetXY(250,$y);
		$pdf->MultiCell(18,8,$Estorno,0,'R',0,0);
    	$pdf->SetXY(268,$y);
		$pdf->MultiCell(18,8,$Saldo,0,'R',0,0);

		$y = $y+8;
		$linha++;
		$titulo = array();
		$col = array();
		if($Situacao == 'TOTAL'){
			
		}
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
