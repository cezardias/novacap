<?php
//print_r($audienciasresult);
//print_r($varas);
header('Content-type: application/pdf');
$this->load->library('Fpdf_Table_Horizontal_Audiencia.php');
$pdf=new Fpdf_Table_Horizontal_Audiencia('L','mm','A4');

if($audienciasresult!=NULL):
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->Ln(3);
	
	$titulo = array();
	$col = array();	 
	$col[] = array('text' => utf8_decode('AGENDA DE AUDIÊNCIAS'), 'width' => '275', 'height' => '10', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '20', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');	
	$titulo[] = $col;
	$pdf->WriteTable($titulo);		
	$pdf->Ln(3);	
		
	//DADOS PEGO DA SESSÃO DE BUSCA
	$AudienciaDataIni = $this->session->userdata('AudienciaDataIni');
		$mes = substr($AudienciaDataIni,1,2); //Pega da sessão '09-01-2016'
		$dia = substr($AudienciaDataIni,4,2);
		$ano = substr($AudienciaDataIni,7,4);
		$dataInicio = $dia.'/'.$mes.'/'.$ano;
	
	$AudienciaDataFim = $this->session->userdata('AudienciaDataFim');
		$mes = substr($AudienciaDataFim,1,2); //Pega da sessão '09-01-2016'
		$dia = substr($AudienciaDataFim,4,2);
		$ano = substr($AudienciaDataFim,7,4);
		$dataFinal = $dia.'/'.$mes.'/'.$ano;

	$tipoacaoid = $this->session->userdata('tipoacaoid');
	$advogadoid = $this->session->userdata('advogadoid');
	if($advogadoid=='NULL'){$advogadoNome = 'TODOS';}
	else{
		foreach ($advogados as $adv):
			if($advogadoid==$adv->Id){
				$advogadoNome = $adv->Nome;
			}
		endforeach;
	}		
	
	$tipoaudienciaid = $this->session->userdata('tipoaudienciaid');
	if($tipoaudienciaid='NULL'){$audiencianome='TODAS';}
	else{$audiencianome = strtoupper($tipoaudienciaid);}
	
	if($tipoaudienciaid=='NULL'){$tipoaudienciaid='TODOS';}
	
	$varaid = $this->session->userdata('varaid');
	$varaNome = '';
	if($varaid=='NULL'){$varaNome = 'TODAS';}
	else{
		foreach ($varas as $vrs):
			if($varaid==$vrs->VaraId){
				$varaNome = $vrs->Descricao;
			}
		endforeach;	
	}

	$preposto = $this->session->userdata('preposto');
	if($preposto=='NULL'){$preposto='TODOS';}	

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
	$col[] = array('text' => utf8_decode('TIPO DE AUDIÊNCIA:'), 'width' => '35', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$col[] = array('text' => $audiencianome, 'width' => '240', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');	
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
	$col[] = array('text' => 'PREPOSTO:', 'width' => '35', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$col[] = array('text' => $preposto, 'width' => '240', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');	
	$titulo[] = $col;
	$pdf->WriteTable($titulo);	
	$pdf->Ln(2);	
	
	$titulo = array(); //TÍTULO DO CABEÇALHO DOS DADOS.
	$col = array();	 
	$col[] = array('text' => 'DATA'."\n".'HORA', 'width' => '37', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$col[] = array('text' => utf8_decode('TIPO DE AUDIÊNCIA'."\n".'VARA'), 'width' => '60', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');	
	$col[] = array('text' => utf8_decode('PROCESSO JUDICIAL'."\n".'AUTOR / RÉU'), 'width' => '120', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$col[] = array('text' => 'PREPOSTO'."\n".'ADVOGADO(A)', 'width' => '60', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);

	//DADOS DO MEMORANDO DETALHADOS.
	foreach($audienciasresult as $aud):	
		$IdAudi = $aud->Id;
		$AudienciaDataHora = $aud->AudienciaDataHora;
		$AudienciaPreposto = $aud->AudienciaPreposto; 
		if(strlen($AudienciaPreposto)<2){$AudienciaPreposto="-";}
		$AudienciaTipo = $aud->AudienciaTipo;		
		$Autor = $aud->Autor; if($Autor==""){$Autor="-";}
		$Reu = $aud->Reu; if($Reu==""){$Reu="-";}
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
		
		$titulo = array(); //TÍTULO DO CABEÇALHO DOS DADOS.
		$col = array();	 
		$col[] = array('text' => date('d/m/Y',strtotime($AudienciaDataHora))."\n".date('H:i',strtotime($AudienciaDataHora)), 'width' => '37', 'height' => '6', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => strtoupper($AudienciaTipo)."\n".strtoupper($Vara), 'width' => '60', 'height' => '6', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');	
		$col[] = array('text' => $ProcessoJud."\n".strtoupper($Autor.' / '.$Reu), 'width' => '120', 'height' => '6', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$col[] = array('text' => strtoupper($AudienciaPreposto."\n".$AdvogadoNome), 'width' => '60', 'height' => '6', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$titulo[] = $col;
		$pdf->WriteTable($titulo);			
	endforeach;
		
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