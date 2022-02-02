<?php
header('Content-type: application/pdf');
$this->load->library('Fpdf_Table_Horizontal_Prazos.php');
$pdf=new Fpdf_Table_Horizontal_Prazos('L','mm','A4');

//print_r($audienciasresult);
if($prazosresult!=NULL):
	$pdf->AliasNbPages();
	$pdf->AddPage();
	//$pdf->SetFont('Arial','B',10);
	//$pdf->SetLineWidth(0.0);
	//$pdf->Cell(189,7,'LEVANTAMENTO CORPORATIVO','B',0,'C');
	$pdf->Ln(3);

	//CABEÇALHO DO RELETÓRIO
	$titulo = array();
	$col = array();	 
	$col[] = array('text' => utf8_decode('RELATÓRIO DE PRAZOS'), 'width' => '275', 'height' => '10', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '20', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');	
	$titulo[] = $col;
	$pdf->WriteTable($titulo);		
	$pdf->Ln(3);	
	
	//DADOS PEGO DA SESSÃO DE BUSCA		
	$prazoini = $this->session->userdata('prazoini');
		$mes = substr($prazoini,1,2); //Pega da sessão '09-01-2016'
		$dia = substr($prazoini,4,2);
		$ano = substr($prazoini,7,4);
		$dataInicio = $dia.'/'.$mes.'/'.$ano;
	
	$prazofim = $this->session->userdata('prazofim');
		$mes = substr($prazofim,1,2); //Pega da sessão '09-01-2016'
		$dia = substr($prazofim,4,2);
		$ano = substr($prazofim,7,4);
		$dataFinal = $dia.'/'.$mes.'/'.$ano;
	
	$advogadoid = $this->session->userdata('advogadoid');
	if($advogadoid=='NULL'){$advogadoNome = 'TODOS';}
	else{
		foreach ($advogados as $adv):
			if($advogadoid==$adv->Id){
				$advogadoNome = $adv->Nome;
			}
		endforeach;
	}		
	
	$tipoacaoid = $this->session->userdata('tipoacaoid');
	if($tipoacaoid='NULL'){$tipoacaoid='TODAS';}
	else{$tipoacaoid = strtoupper($tipoacaoid);}
	
	$varaid	= $this->session->userdata('varaid');
	if($varaid=='NULL'){$varaNome = 'TODAS';}
	else{
		foreach ($varas as $vrs):
			if($varaid==$vrs->Id){
				$varaNome = $vrs->Descricao;
			}
		endforeach;	
	}
	$soma = $this->session->userdata('prazoconcluido');
	if($soma==0){$concluido=utf8_decode('NÃO');}
	if($soma==1){$concluido='SIM';}
	if($soma=='NULL'){$concluido='TODOS';}

	$titulo = array();
	$col = array();	 
	$col[] = array('text' => utf8_decode('PERÍODO:'), 'width' => '35', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$col[] = array('text' => $dataInicio.' a '.$dataFinal, 'width' => '240', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');	
	$titulo[] = $col;
	$pdf->WriteTable($titulo);		
	
	$titulo = array();
	$col = array();	 
	$col[] = array('text' => 'VARA:', 'width' => '35', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$col[] = array('text' => $varaNome, 'width' => '240', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');	
	$titulo[] = $col;
	$pdf->WriteTable($titulo);		
	
	$titulo = array();
	$col = array();	 
	$col[] = array('text' => utf8_decode('TIPO DE AÇÃO:'), 'width' => '35', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$col[] = array('text' => $tipoacaoid, 'width' => '240', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');	
	$titulo[] = $col;
	$pdf->WriteTable($titulo);		
	
	$titulo = array();
	$col = array();	 
	$col[] = array('text' => 'ADVOGADO(A):', 'width' => '35', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$col[] = array('text' => $advogadoNome, 'width' => '240', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');	
	$titulo[] = $col;
	$pdf->WriteTable($titulo);		
	
	$titulo = array();
	$col = array();	 
	$col[] = array('text' => utf8_decode('CONCLUÍDO:'), 'width' => '35', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$col[] = array('text' => $concluido, 'width' => '240', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');	
	$titulo[] = $col;
	$pdf->WriteTable($titulo);	
	$pdf->Ln(2);	
	
	$titulo = array(); //TÍTULO DO CABEÇALHO DOS DADOS.
	$col = array();	 
	$col[] = array('text' => 'DATA', 'width' => '20', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$col[] = array('text' => 'PARTES', 'width' => '70', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');	
	$col[] = array('text' => 'PROCESSO JUDICIAL', 'width' => '40', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$col[] = array('text' => utf8_decode('DESCRIÇÃO'), 'width' => '65', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$col[] = array('text' => utf8_decode('OBSERVAÇÃO'), 'width' => '65', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$col[] = array('text' => 'CONCL.', 'width' => '15', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);

	//DADOS DO MEMORANDO DETALHADOS.
	foreach($prazosresult as $prz):
		$PrazoId = $prz->PrazoId;
		$Data = $prz->Data;
		$Partes = $prz->Partes;
		$PrJudicial = $prz->ProcessoJudicial;
		$p1 = substr($PrJudicial,0,7);
		$p2 = substr($PrJudicial,7,2);
		$p3 = substr($PrJudicial,9,4);
		$p4 = substr($PrJudicial,13,1);
		$p5 = substr($PrJudicial,14,2);
		$p6 = substr($PrJudicial,16,4);
		$ProcessoJudicial = $p1.'-'.$p2.'.'.$p3.'.'.$p4.'.'.$p5.'.'.$p6;		
		$PrazoDescricao = $prz->PrazoDescricao;
		$Observacoes = $prz->Observacoes;
		$Concluido = $prz->Concluido;
		if($Concluido==0){$Concluido=utf8_decode('NÃO');}
		if($Concluido==1){$Concluido='SIM';}
		$AcaoId = $prz->AcaoId;	
		
		$titulo = array(); //TÍTULO DO CABEÇALHO DOS DADOS.
		$col = array();	 
		$col[] = array('text' => date('d/m/Y',strtotime($Data)), 'width' => '20', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $Partes, 'width' => '70', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');	
		$col[] = array('text' => $ProcessoJudicial, 'width' => '40', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $PrazoDescricao, 'width' => '65', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $Observacoes, 'width' => '65', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => $Concluido, 'width' => '15', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$titulo[] = $col;
		$pdf->WriteTable($titulo);	
	endforeach;
	
	//VARIÁVEL ZERADA
	//$columns = "";//
	$pdf->Output("relatorio.pdf","I");	
	//$pdf->Output("relatorio.pdf","D");
else:?>
<?php $this->load->view('view_cabecalho');?>
	<h2>Relatório - Horas Extras</h2>
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