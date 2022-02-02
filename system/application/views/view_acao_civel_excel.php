<?php
if($docresult!=NULL):
$this->load->library('phpexcel/Classes/PHPExcel.php');
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'CNJ');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'PROCESSO ADM.');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'PROCESSO JUDICIAL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'AUTOR');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'REU');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'ADVOGADO');

// larguras paras as colunas como padrão
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);

$linha=2;
foreach ($docresult as $item){
	$Id = $item->Id;
	$PrAdm = $item->ProcessoAdministrativoNumero;
	if($PrAdm != ""){ //112.000.222/2016
		$primeiro = substr($PrAdm, 0, 3);
		$segundo = substr($PrAdm, 3, 3);
		$terceiro = substr($PrAdm, 6, 3);
		$quarto = substr($PrAdm, 9, 4);
		$PrAdm = $primeiro.".".$segundo.".".$terceiro."/".$quarto; 		
	}else{$PrAdm = "";}	
	$Cnj = $item->ProcessoJudicialNumero;
	if($Cnj != ""){ //0000818-14.2015.5.10.0004
		$p1 = substr($Cnj,0,7);
		$p2 = substr($Cnj,7,2);
		$p3 = substr($Cnj,9,4);
		$p4 = substr($Cnj,13,1);
		$p5 = substr($Cnj,14,2);
		$p6 = substr($Cnj,16,4);
		$Cnj = $p1.'-'.$p2.'.'.$p3.'.'.$p4.'.'.$p5.'.'.$p6; 		
	}else{$Cnj = "";}		
	$PrJudAnt = $item->ProcessoJudicialNumeroAntigo;
	if($PrJudAnt != ""){ //0000818-14.2015.5.10.0004
		$p1 = substr($PrJudAnt,0,7);
		$p2 = substr($PrJudAnt,7,2);
		$p3 = substr($PrJudAnt,9,4);
		$p4 = substr($PrJudAnt,13,1);
		$p5 = substr($PrJudAnt,14,2);
		$p6 = substr($PrJudAnt,16,4);
		$PrJud = $p1.'-'.$p2.'.'.$p3.'.'.$p4.'.'.$p5.'.'.$p6; 		
	}else{$PrJudAnt = "";}	
	$Advog = utf8_encode($item->AcaoAdvogado);
	$AcaoTipo = $item->AcaoTipo;
	$Autor = utf8_encode($item->Autor);
	$Reu = utf8_encode($item->Reu);
		
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$linha, $Cnj);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$linha, $PrAdm);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$linha, $PrJudAnt);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$linha, $Autor);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$linha, $Reu);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$linha, $Advog);
    $linha++;
}

date_default_timezone_set('America/Sao_Paulo');
$data = date('d-m-Y');
$hora = date('H');
$min = date('i');
$nome = 'ACOES_CIVEIS_'.$data.'-'.$hora.$min;

//formata o cabeçalho
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$nome.'.xls');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

else:?>
<?php $this->load->view('view_cabecalho');?>
	<h2>Acções cíveis</h2>
	<div class="status_box warning">
	<h6>INFORMAÇÃO:</h6>
		<ul>
			<li>Nenhum resultado foi retornado para os parâmetros informados!</li>
		</ul>
	</div>
	<br>
<?php 
	$this->load->view('view_rodape');
endif;
?>