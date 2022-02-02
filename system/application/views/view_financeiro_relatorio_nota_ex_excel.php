<?php
if($resultnotaexplic!=NULL):
$this->load->library('phpexcel/Classes/PHPExcel.php');
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'ASSUNTO');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'SETENÇA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'CONDENAÇÃO');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'ACÓRDÃO');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'QUANTIDADE');

// larguras paras as colunas como padrão
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);

$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);

$linha=2;
foreach ($resultnotaexplic as $nota):
	$Assunto = $nota->Assunto;
	$Sentenca = $nota->Sentenca;
		if($Sentenca != ""){$Sentenca = number_format($Sentenca, 2, ',', '.');}else{$Sentenca="0,00";}
	$Condenacao = $nota->Condenacao;
		if($Condenacao != ""){$Condenacao = number_format($Condenacao, 2, ',', '.');}else{$Condenacao="0,00";}
	$Acordao = $nota->Acordao;
		if($Acordao != ""){$Acordao = number_format($Acordao, 2, ',', '.');}else{$Acordao="0,00";}
	$Quantidade = $nota->Quantidade;if($Quantidade==""){$Quantidade="-";}
	if($Assunto != 'TOTAL'){
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$linha, utf8_encode($Assunto));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$linha, $Sentenca);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$linha, $Condenacao);
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$linha, $Acordao);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$linha, $Quantidade);
	}else if($Assunto == 'TOTAL'){
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$linha, 'TOTAL');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$linha, $Sentenca);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$linha, $Condenacao);
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$linha, $Acordao);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$linha, $Quantidade);
	}
	$linha++;
endforeach;

date_default_timezone_set('America/Sao_Paulo');
$data = date('d-m-Y');
$hora = date('H');
$min = date('i');
$nome = 'NOTA_EXPLICATIVA_'.$data.'-'.$hora.$min;

//formata o cabeçalho
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
