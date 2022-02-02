<?php
//print_r($resultvlc);
if($atasresult!=NULL):
$this->load->library('phpexcel/Classes/PHPExcel.php');
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'ATA Nº');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'DIRETORIA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'LICITAÇÃO Nº');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'PROC. ADM.');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'MODALIDADE');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'EMPRESA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'VAlOR');

// larguras paras as colunas como padrao
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(45);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(85);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);

$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);

$linha=2;
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

	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$linha, utf8_encode($AtaNr));
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$linha, utf8_encode($Diretoria));
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$linha, utf8_encode($LicitacaoNumero));
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$linha, utf8_encode($ProcessoNr));
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$linha, utf8_encode($LicitacaoModalidade));
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$linha, utf8_encode($EmpresaNome));
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$linha, $Valor);
	$linha++;
endforeach;

date_default_timezone_set('America/Sao_Paulo');
$data = date('d-m-Y');
$hora = date('H');
$min = date('i');
$nome = 'RELAT_ATAS_'.$data.'-'.$hora.$min;

//formata o cabeçalho
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$nome.'.xls');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

else:?>
<?php $this->load->view('view_cabecalho');?>
	<h2>Atas</h2>
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
