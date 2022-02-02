<?php
if($audienciasresult!=NULL):
$this->load->library('phpexcel/Classes/PHPExcel.php');
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', utf8_encode('DATA-HORA'));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', utf8_encode('TIPO AUDIÊNCIA'));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', utf8_encode('VARA'));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', utf8_encode('PROCESSO JUDICIAL'));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', utf8_encode('AUTOR'));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', utf8_encode('RÉU'));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', utf8_encode('PREPOSTO'));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', utf8_encode('ADVOGADO'));

// larguras paras as colunas como padrão
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(23);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);

$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);

$linha=2;
//print_r($audienciasresult);
foreach($audienciasresult as $aud):	
	$IdAudi = $aud->Id;
	$AudienciaDataHora = $aud->AudienciaDataHora;
	if($AudienciaDataHora != ""){
		$AudienciaDataHora = date('d/m/Y H:i',strtotime($AudienciaDataHora));
	}else{$AudienciaDataHora='';}	
	$AudienciaPreposto = $aud->AudienciaPreposto; 
	if(strlen($AudienciaPreposto)<2){$AudienciaPreposto="";}
	$AudienciaTipo = $aud->AudienciaTipo;
	$Autor = $aud->Autor; if($Autor==""){$Autor="";}
	$Reu = $aud->Reu; if($Reu==""){$Reu="";}			
	$IdAcao = $aud->AcaoId;
	$IdVara = $aud->VaraId;
	$Vara = $aud->Vara;
	$ProcessoJudicialNumero = $aud->ProcessoJudicialNumero;
	if($ProcessoJudicialNumero != ""){ //0000818-14.2015.5.10.0004
		$p1 = substr($ProcessoJudicialNumero,0,7);
		$p2 = substr($ProcessoJudicialNumero,7,2);
		$p3 = substr($ProcessoJudicialNumero,9,4);
		$p4 = substr($ProcessoJudicialNumero,13,1);
		$p5 = substr($ProcessoJudicialNumero,14,2);
		$p6 = substr($ProcessoJudicialNumero,16,4);
		$ProcessoJud = $p1.'-'.$p2.'.'.$p3.'.'.$p4.'.'.$p5.'.'.$p6; 		
	}else{$ProcessoJud = "";}				
	$PrAdmin = $aud->ProcessoAdministrativoNumero;
	if($PrAdmin != ""){ //112.000.222/2016
		$primeiro = substr($PrAdmin, 0, 3);
		$segundo = substr($PrAdmin, 3, 3);
		$terceiro = substr($PrAdmin, 6, 3);
		$quarto = substr($PrAdmin, 9, 4);
		$ProcessoAdmin = $primeiro.".".$segundo.".".$terceiro."/".$quarto; 		
	}else{$ProcessoAdmin = "";}							
	$AdvogadoId = $aud->AdvogadoId;
	$AcaoTipo = $aud->AcaoTipo;
	$AdvogadoNome = $aud->AdvogadoNome;
	
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$linha, utf8_encode($AudienciaDataHora));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$linha, utf8_encode($AudienciaTipo));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$linha, utf8_encode($Vara));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$linha, utf8_encode($ProcessoJud));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$linha, utf8_encode($Autor));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$linha, utf8_encode($Reu));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$linha, utf8_encode($AudienciaPreposto));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$linha, utf8_encode($AdvogadoNome));
    $linha++;
endforeach;

date_default_timezone_set('America/Sao_Paulo');
$data = date('d-m-Y');
$hora = date('H');
$min = date('i');
$nome = 'AUDIÊNCIAS_'.$data.'-'.$hora.$min;

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