<?php
//print_r($resultvlc);
if($resultvlc!=NULL):
$this->load->library('phpexcel/Classes/PHPExcel.php');
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Autor');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'CpfCnpj');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'ProcessoJudicial');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'ProcessoAdministrativo');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'Situacao');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'ProbabilidadeDePerda');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'BloqueioJudicial');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'Atualizacao Monetaria');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'Comnvolado');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', 'Devolucao');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', 'Estorno');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', 'Saldo');

// larguras paras as colunas como padrão
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);

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

$linha=2;
foreach ($resultvlc as $it):
	$Autor = $it->Autor;
	$CpfCnpj = $it->CpfCnpj;
	$ProcessoJudicial = $it->ProcessoJudicial;
	$ProcessoAdministrativo = $it->ProcessoAdministrativo;
	$Situacao = $it->Situacao;
	$ProbabilidadeDePerda = $it->ProbabilidadeDePerda;
	$BloqueioJudicial = $it->BloqueioJudicial;
	$AtualizacaoMonetaria = $it->AtualizacaoMonetaria;
	$Convolado = $it->Convolado;
	$Devolucao = $it->Devolucao;
	$Estorno = $it->Estorno;
	$Saldo = $it->Saldo;

	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$linha, utf8_encode($Autor));
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$linha, $CpfCnpj);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$linha, $ProcessoJudicial);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$linha, $ProcessoAdministrativo);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$linha, utf8_encode($Situacao));
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$linha, $ProbabilidadeDePerda);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$linha, $BloqueioJudicial);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$linha, $AtualizacaoMonetaria);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$linha, $Convolado);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$linha, $Devolucao);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$linha, $Estorno);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$linha, $Saldo);
	$linha++;
endforeach;

date_default_timezone_set('America/Sao_Paulo');
$data = date('d-m-Y');
$hora = date('H');
$min = date('i');
$nome = 'Bloqueios_Jud_'.$data.'-'.$hora.$min;

header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$nome.'.xls');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

else:?>
<?php $this->load->view('view_cabecalho');?>
	<h2>Financeiro Bloqueio Judicial</h2>
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
