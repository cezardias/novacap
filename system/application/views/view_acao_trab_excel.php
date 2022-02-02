<?php
if($docresult!=NULL):
$this->load->library('phpexcel/Classes/PHPExcel.php');
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'PROCESSO JUDICIAL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'PROCESSO ADM.');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'AUTOR');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'ASSUNTO');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'ADVOGADO');

// larguras paras as colunas como padrão
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);

$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);

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
	$PrJud = $item->ProcessoJudicialNumero;
	if($PrJud != ""){ //0000818-14.2015.5.10.0004
		$p1 = substr($PrJud,0,7);
		$p2 = substr($PrJud,7,2);
		$p3 = substr($PrJud,9,4);
		$p4 = substr($PrJud,13,1);
		$p5 = substr($PrJud,14,2);
		$p6 = substr($PrJud,16,4);
		$PrJud = $p1.'-'.$p2.'.'.$p3.'.'.$p4.'.'.$p5.'.'.$p6; 		
	}else{$PrJud = "";}		
	$Advog = utf8_encode($item->AcaoAdvogado);
	$AcaoTipo = $item->AcaoTipo;
	$Autor = utf8_encode($item->Autor);
	$Assunto = utf8_encode($item->Assunto);
		
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$linha, $PrJud);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$linha, $PrAdm);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$linha, $Autor);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$linha, $Assunto);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$linha, $Advog);
    $linha++;
}

date_default_timezone_set('America/Sao_Paulo');
$data = date('d-m-Y');
$hora = date('H');
$min = date('i');
$nome = 'ACOES_TRABALHISTAS_'.$data.'-'.$hora.$min;

//formata o cabeçalho
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$nome.'.xls');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

else:?>
<?php $this->load->view('view_cabecalho');?>
	<h2>Ações trabalhistas</h2>
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