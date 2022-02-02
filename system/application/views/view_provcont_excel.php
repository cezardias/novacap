<?php
if($auditoriaresult!=NULL):
$this->load->library('phpexcel/Classes/PHPExcel.php');
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', utf8_encode('TIPO'));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', utf8_encode('INTERESSADO '));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', utf8_encode('PROCESSO JUDICIAL'));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', utf8_encode('PROCESSO ADM.'));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', utf8_encode('ASSUNTO'));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', utf8_encode('PROB. PERDA'));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', utf8_encode('VALOR DA CAUSA'));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', utf8_encode('VALOR DA SENTENSA'));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', utf8_encode('VALOR CONDENAÇÃO'));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', utf8_encode('STATUS'));

// larguras paras as colunas como padrão
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);

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

$linha=2;
foreach($auditoriaresult as $aud):	
	$Tipo = $aud->Tipo;
	$InteressadoNome = $aud->InteressadoNome;
	$ProcessoJud = $aud->ProcessoJudicialNumero;		
	$PrAdmin = $aud->ProcessoAdministrativoNumero;
	$Assunto = $aud->Assunto;
	$ProbabilidadeDePerda = $aud->ProbabilidadeDePerda;
	$CausaValor = $aud->CausaValor;
	if($CausaValor != ""){$CausaValor = number_format($CausaValor, 2, ',', '.');}else{$CausaValor="0,00";}
	$SetencaValor = $aud->SentencaValor;
	if($SetencaValor != ""){$SetencaValor = number_format($SetencaValor, 2, ',', '.');}else{$SetencaValor="0,00";}
	$CondenacaoValor = $aud->CondenacaoValor;
	if($CondenacaoValor != ""){$CondenacaoValor = number_format($CondenacaoValor, 2, ',', '.');}else{$CondenacaoValor="0,00";}
	$Situacao = $aud->Situacao;
	if($Tipo!='zTOTAL'){
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$linha, utf8_encode($Tipo));
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$linha, utf8_encode($InteressadoNome));
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$linha, utf8_encode($ProcessoJud));
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$linha, utf8_encode($PrAdmin));
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$linha, utf8_encode($Assunto));
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$linha, utf8_encode($ProbabilidadeDePerda));
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$linha, utf8_encode($CausaValor));
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$linha, utf8_encode($SetencaValor));
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$linha, utf8_encode($CondenacaoValor));
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$linha, utf8_encode($Situacao));
	}else{
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$linha, utf8_encode('TOTAIS'));
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$linha, utf8_encode($CausaValor));
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$linha, utf8_encode($SetencaValor));
	    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$linha, utf8_encode($CondenacaoValor));		
	}
    $linha++;
endforeach;

date_default_timezone_set('America/Sao_Paulo');
$data = date('d-m-Y');
$hora = date('H');
$min = date('i');
$nome = 'AUDITORIAS_'.$data.'-'.$hora.$min;

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