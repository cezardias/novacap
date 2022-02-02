<?php
//print_r($resultvlc);
if($resultvlc!=NULL):
$this->load->library('phpexcel/Classes/PHPExcel.php');
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'INTERESSADO');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'CPF/CNPJ');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'PROC. JUDICIAL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'PROC. ADM.');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'ASSUNTO');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'PROBAB. PERDA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'CALC. HOMOLOGADO');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'ACORDAO');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'CONDENACAO');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', 'SETENCA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', 'DEPOSITO JUDICIAL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', 'PAG. DE ACAO');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1', 'BLOQUEIO JUD');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1', 'VALOR LIQUIDO');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', 'SITUACAO');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P1', 'ADVOGADO');

// larguras paras as colunas como padr�o
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(18);

$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('p')->setWidth(30);

$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);

$linha=2;
$objPHPExcel->getActiveSheet()->getStyle('G')->getNumberFormat()->setFormatCode('#,##0.00');
$objPHPExcel->getActiveSheet()->getStyle('H')->getNumberFormat()->setFormatCode('#,##0.00');
$objPHPExcel->getActiveSheet()->getStyle('I')->getNumberFormat()->setFormatCode('#,##0.00');
$objPHPExcel->getActiveSheet()->getStyle('J')->getNumberFormat()->setFormatCode('#,##0.00');
$objPHPExcel->getActiveSheet()->getStyle('K')->getNumberFormat()->setFormatCode('#,##0.00');
$objPHPExcel->getActiveSheet()->getStyle('L')->getNumberFormat()->setFormatCode('#,##0.00');
$objPHPExcel->getActiveSheet()->getStyle('M')->getNumberFormat()->setFormatCode('#,##0.00');
$objPHPExcel->getActiveSheet()->getStyle('N')->getNumberFormat()->setFormatCode('#,##0.00');
foreach ($resultvlc as $it):
	// $Interessado = $it->InteressadoAbreviado; //INTERESASDO E OUTROS, existe a coluna somente interessado. N�O COFUNDIR AS DUAS
	// $CpfCnpj = $it->CpfCnpj;
	// 	if(strlen($CpfCnpj)<3){$CpfCnpj="-";}
	// $ProcessoJudicial = $it->ProcessoJudicial;
	// $ProcessoAdministrativo = $it->ProcessoAdministrativo;
	// 	if(strlen($ProcessoAdministrativo)<3){$ProcessoAdministrativo="-";}
	// $ProbabilidadeDePerda = $it->ProbabilidadeDePerda;
	// $Assunto = $it->Assunto;
	// $Assunto = substr($Assunto,0,30);
	// $Condenacao = $it->Condenacao;
	// 	//if($Condenacao != ""){$Condenacao = number_format($Condenacao, 2, ',', '.');}else{$Condenacao="0,00";}
	// $Sentenca = $it->Sentenca;
	// 	//if($Sentenca != ""){$Sentenca = number_format($Sentenca, 2, ',', '.');}else{$Sentenca="0,00";}
	// $DepositoJudicial = $it->DepositoJudicial;
	// 	//if($DepositoJudicial != ""){$DepositoJudicial = number_format($DepositoJudicial, 2, ',', '.');}else{$DepositoJudicial="0,00";}
	// $BloqueioJudicial = $it->BloqueioJudicial;
	// 	//if($BloqueioJudicial != ""){$BloqueioJudicial = number_format($BloqueioJudicial, 2, ',', '.');}else{$BloqueioJudicial="0,00";}
	// $ValorLiquidoContabil = $it->ValorLiquidoContabil;
	// 	//if($ValorLiquidoContabil != ""){$ValorLiquidoContabil = number_format($ValorLiquidoContabil, 2, ',', '.');}else{$ValorLiquidoContabil="0,00";}
	// $Situacao = $it->Situacao;

	//$Interessado = $it->Interessado;
	$Interessado = $it->InteressadoAbreviado; //INTERESASDO E OUTROS
	$CpfCnpj = $it->CpfCnpj;
	$ProcessoJudicial = $it->ProcessoJudicial;
	$ProcessoAdministrativo = $it->ProcessoAdministrativo;
	$ProbabilidadeDePerda = $it->ProbabilidadeDePerda;
	$Assunto = $it->Assunto;
	//$Assunto = substr($Assunto,0,30);
	$Acordao = $it->Acordao;
		//if($Acordao != ""){$Acordao = number_format($Acordao, 2, ',', '.');}else{$Acordao="0,00";}
	$CalculoHomologado = $it->CalculoHomologado;
		//if($CalculoHomologado != ""){$CalculoHomologado = number_format($CalculoHomologado, 2, ',', '.');}else{$CalculoHomologado="0,00";}
	$Condenacao = $it->Condenacao;
		//if($Condenacao != ""){$Condenacao = number_format($Condenacao, 2, ',', '.');}else{$Condenacao="0,00";}
	$Sentenca = $it->Sentenca;
		//if($Sentenca != ""){$Sentenca = number_format($Sentenca, 2, ',', '.');}else{$Sentenca="0,00";}
	$DepositoJudicial = $it->DepositoJudicial;
		//if($DepositoJudicial != ""){$DepositoJudicial = number_format($DepositoJudicial, 2, ',', '.');}else{$DepositoJudicial="0,00";}
	$PagamentoDeAcao = $it->PagamentoDeAcao;
		//if($PagamentoDeAcao != ""){$PagamentoDeAcao = number_format($PagamentoDeAcao, 2, ',', '.');}else{$PagamentoDeAcao="0,00";}
	$BloqueioJudicial = $it->BloqueioJudicial;
		//if($BloqueioJudicial != ""){$BloqueioJudicial = number_format($BloqueioJudicial, 2, ',', '.');}else{$BloqueioJudicial="0,00";}
	$ValorLiquidoContabil = $it->ValorLiquidoContabil;
		//if($ValorLiquidoContabil != ""){$ValorLiquidoContabil = number_format($ValorLiquidoContabil, 2, ',', '.');}else{$ValorLiquidoContabil="0,00";}
	$Situacao = $it->Situacao;
	$pago = $it->Pago;
    $Advogado = $it->Advogado;
	//$Ordem = $it->Ordem;

	//if($Interessado != "ZZZZZZZ"){

	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$linha, utf8_encode($Interessado));
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$linha, utf8_encode($CpfCnpj));
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$linha, utf8_encode($ProcessoJudicial));
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$linha, utf8_encode($ProcessoAdministrativo));
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$linha, utf8_encode($Assunto));
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$linha, utf8_encode($ProbabilidadeDePerda));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$linha, $CalculoHomologado);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$linha, $Acordao);
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$linha, $Condenacao);
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$linha, $Sentenca);
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$linha, $DepositoJudicial);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$linha, $PagamentoDeAcao);
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$linha, $BloqueioJudicial);
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$linha, $ValorLiquidoContabil);
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$linha, utf8_encode($Situacao));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$linha, utf8_encode($Advogado));

        if($ProcessoJudicial == 'TOTAL'){
            $objPHPExcel->getActiveSheet()->getStyle('C'.$linha)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$linha)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$linha)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('I'.$linha)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('J'.$linha)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('K'.$linha)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('L'.$linha)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('M'.$linha)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('N'.$linha)->getFont()->setBold(true);
        }

	    $linha++;
	//}
endforeach;

date_default_timezone_set('America/Sao_Paulo');
$data = date('d-m-Y');
$hora = date('H');
$min = date('i');
$nome = 'RELAT_VLC_'.$data.'-'.$hora.$min;

//formata o cabe�alho
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$nome.'.xls');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

else:?>
<?php $this->load->view('view_cabecalho');?>
	<h2>Financeiro VLC</h2>
	<div class="status_box warning">
	<h6>INFORMA&Ccedil;&Atilde;O:</h6>
		<ul>
			<li>Nenhum resultado foi retornado para os par&acirc;metros informados!</li>
		</ul>
	</div>
	<br>
<?php
	$this->load->view('view_rodape');
endif;
?>
