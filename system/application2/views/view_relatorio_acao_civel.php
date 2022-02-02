<?php
header('Content-type: application/pdf');
$this->load->library('Fpdf_Table_acao_civel_vertical.php');
$pdf=new Fpdf_Table_acao_civel_vertical('P','mm','A4');

$pdf->AliasNbPages();
$pdf->AddPage();
if($acaodetail!=NULL):
	foreach ($acaodetail as $itens):
		$IdAcaoTrab = $itens->Id;
		$AcaoTipoId = $itens->AcaoTipoId;
		$PrJudicial = $itens->ProcessoJudicialNumero;
		if($PrJudicial != ""){ //0000818-14.2015.5.10.0004
			$p1 = substr($PrJudicial,0,7);
			$p2 = substr($PrJudicial,7,2);
			$p3 = substr($PrJudicial,9,4);
			$p4 = substr($PrJudicial,13,1);
			$p5 = substr($PrJudicial,14,2);
			$p6 = substr($PrJudicial,16,4);
			$ProcessoJud = $p1.'-'.$p2.'.'.$p3.'.'.$p4.'.'.$p5.'.'.$p6; 		
		}else{$ProcessoJud = "";}				
		$VaraId = $itens->VaraId;
		$PrAdmin = $itens->ProcessoAdministrativoNumero;
		if($PrAdmin != ""){ //112.000.222/2016
			$primeiro = substr($PrAdmin, 0, 3);
			$segundo = substr($PrAdmin, 3, 3);
			$terceiro = substr($PrAdmin, 6, 3);
			$quarto = substr($PrAdmin, 9, 4);
			$ProcessoAdmin = $primeiro.".".$segundo.".".$terceiro."/".$quarto; 		
		}else{$ProcessoAdmin = "";}				
		$CausaValor = $itens->CausaValor;
		if($CausaValor != ""){$CausaValor = number_format($CausaValor, 2, ',', '.');}else{$CausaValor="0,00";}
		$SentencaValor = $itens->SentencaValor;
		if($SentencaValor != ""){$SentencaValor = number_format($SentencaValor, 2, ',', '.');}else{$SentencaValor="0,00";}
		$CondenacaoValor = $itens->CondenacaoValor;
		if($CondenacaoValor != ""){$CondenacaoValor = number_format($CondenacaoValor, 2, ',', '.');}else{$CondenacaoValor="0,00";}
		$ProbabilidadeDePerda = $itens->ProbabilidadeDePerdaId;
		if(($ProbabilidadeDePerda=="")||($ProbabilidadeDePerda=='NULL')){$ProbabilidadeDePerda='-';}
		$FundamentoLegal = $itens->FundamentoLegal;
		$Observacoes = $itens->Observacoes;
		$Ativo = $itens->Ativo;
		if($Ativo==0){$Ativo='INATIVO';}
		if($Ativo==1){$Ativo='ATIVO';}
		$Caixa = $itens->Caixa;
		$DataDoAjuizamento = $itens->DataDoAjuizamento;
		if($DataDoAjuizamento != ""){$DataDoAjuizamento = date('d/m/Y H:i',strtotime($DataDoAjuizamento));}else{$DataDoAjuizamento="-";}
		$Sisprot = $itens->Sisprot;
		$ProcessoJudicialNumeroAntigo = $itens->ProcessoJudicialNumeroAntigo;
		$AcordaoValor = $itens->AcordaoValor; 
		if($AcordaoValor != ""){$AcordaoValor = number_format($AcordaoValor, 2, ',', '.');}else{$AcordaoValor="0,00";}
		$CausaValorTipo = $itens->CausaValorTipo;
			foreach ($valorestipo as $tipoval):
				if($CausaValorTipo == $tipoval->Id){
					$CausaValorTipo = $tipoval->Descricao;
				}else{
					$CausaValorTipo = '-';
				}
			endforeach; 	
		$SentencaValorTipo = $itens->SentencaValorTipo;
			foreach ($valorestipo as $tipoval):
				if($SentencaValorTipo == $tipoval->Id){
					$SentencaValorTipo = $tipoval->Descricao;
				}else{
					$SentencaValorTipo = '-';
				}
			endforeach;			
		$CondenacaoValorTipo = $itens->CondenacaoValorTipo;
			foreach ($valorestipo as $tipoval):
				if($CondenacaoValorTipo == $tipoval->Id){
					$CondenacaoValorTipo = $tipoval->Descricao;
				}else{
					$CondenacaoValorTipo = '-';
				}
			endforeach;			
		$AcordaoValorTipo = $itens->AcordaoValorTipo;
			foreach ($valorestipo as $tipoval):
				if($AcordaoValorTipo == $tipoval->Id){
					$AcordaoValorTipo = $tipoval->Descricao;
				}else{
					$AcordaoValorTipo = '-';
				}
			endforeach;			
		$DataDeExtincao = $itens->DataDeExtincao;
		$PalavrasChave = $itens->PalavrasChave;
		$ProcessoPai = $itens->ProcessoPai;
		$autorAcao = $itens->Autor;
		$reuAcao = $itens->Reu;
	endforeach;

	$vara_adv = '';
	if(!empty($interessadoEoutros)&&(sizeof($interessadoEoutros)>0)){
		foreach ($interessadoEoutros as $ints):
			//$IdRegInter = $ints->Id;
			$AcoesInterId = $ints->AcoesId;
			$InteressadoEoutros = $ints->InteressadoNome;
		endforeach;
	}else{
		$AcoesInterId = '';
		$InteressadoEoutros = '';
	}	
	
	foreach ($varas as $vr): 
		if($VaraId==$vr->VaraId){
			$vara_adv = $vr->Descricao.' - '.$vr->Nome;
		}	
	endforeach;
	
	$titulo = array();
	$col = array();
	$col[] = array('text' => 'AUTOR:', 'width' => '20', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
	$col[] = array('text' => $autorAcao, 'width' => '170', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);
	
	$titulo = array();
	$col = array();
	$col[] = array('text' => 'RÉU:', 'width' => '20', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');
	$col[] = array('text' => $reuAcao, 'width' => '170', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);
	
	$titulo = array();
	$col = array();	 
	$col[] = array('text' => 'PROC. ADMIN.:', 'width' => '25', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	$col[] = array('text' => $ProcessoAdmin, 'width' => '30', 'height' => '6', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	$col[] = array('text' => 'PROC. JUDICIAL:', 'width' => '30', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	$col[] = array('text' => $ProcessoJud, 'width' => '45', 'height' => '6', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	$col[] = array('text' => 'PROC. PAI:', 'width' => '20', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	$col[] = array('text' => $ProcessoPai, 'width' => '40', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);			
			
	$titulo = array();
	$col = array();	 
	$col[] = array('text' => 'VALOR DA CAUSA:', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
	$col[] = array('text' => $CausaValor, 'width' => '35', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
	$col[] = array('text' => 'CAUSA VALOR TIPO:', 'width' => '55', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LT');
	$col[] = array('text' => $CausaValorTipo, 'width' => '55', 'height' => '6', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);
	
	$titulo = array();
	$col = array();	 
	$col[] = array('text' => 'VALOR DA SENTENÇA:', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$col[] = array('text' => $SentencaValor, 'width' => '35', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'R');
	$col[] = array('text' => 'SENTENÇA VALOR TIPO:', 'width' => '55', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'L');
	$col[] = array('text' => $SentencaValorTipo, 'width' => '55', 'height' => '6', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);	
	
	$titulo = array();
	$col = array();
	$col[] = array('text' => 'VALOR DO ACÓRDÃO:', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$col[] = array('text' => $AcordaoValor, 'width' => '35', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'R');
	$col[] = array('text' => 'VALOR ACÓRDÃO TIPO:', 'width' => '55', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'L');
	$col[] = array('text' => $AcordaoValorTipo, 'width' => '55', 'height' => '6', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);	
	
	$titulo = array();
	$col = array();	 
	$col[] = array('text' => 'VALOR DA CONDENAÇÃO:', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');
	$col[] = array('text' => $CondenacaoValor, 'width' => '35', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'RB');
	$col[] = array('text' => 'CONDENAÇÃO VALOR TIPO:', 'width' => '55', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LB');
	$col[] = array('text' => $CondenacaoValorTipo, 'width' => '55', 'height' => '6', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);		
	
	$titulo = array();
	$col = array();
	$col[] = array('text' => 'VARA / ADVOGADO:', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
	$col[] = array('text' => $vara_adv, 'width' => '145', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);	
	
	$titulo = array();
	$col = array();
	$col[] = array('text' => 'FUNDAMENTO LEGAL:', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$col[] = array('text' => $FundamentoLegal, 'width' => '145', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);	
	
	$titulo = array();
	$col = array();
	$col[] = array('text' => 'DATA DE AJUIZAMENTO:', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');
	$col[] = array('text' => $DataDoAjuizamento, 'width' => '30', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');
	$col[] = array('text' => 'SISPROT:', 'width' => '20', 'height' => '6', 'align' => 'C', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');
	$col[] = array('text' => $Sisprot, 'width' => '25', 'height' => '6', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');
	$col[] = array('text' => 'CAIXA:', 'width' => '15', 'height' => '6', 'align' => 'C', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');
	$col[] = array('text' => $Caixa, 'width' => '15', 'height' => '6', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');
	$col[] = array('text' => 'STATUS:', 'width' => '20', 'height' => '6', 'align' => 'C', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');
	$col[] = array('text' => $Ativo, 'width' => '20', 'height' => '6', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);

	$titulo = array();
	$col = array();
	$col[] = array('text' => 'OBSERVAÇÕES:', 'width' => '190', 'height' => '6', 'align' => 'L', 'alignv' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);
	
	$titulo = array();
	$col = array();	 
	$col[] = array('text' => $Observacoes, 'width' => '190', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);	
	$titulo = array();
	$col = array();
	$col[] = array('text' => 'PALAVRAS CHAVE:', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	$col[] = array('text' => $PalavrasChave, 'width' => '145', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);
	$pdf->Ln(10);

	
	$titulo = array();
	$col = array();	 
	$col[] = array('text' => 'ASSUNTOS', 'width' => '190', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);

	$titulo = array();
	$col = array();
	$col[] = array('text' => 'ASSUNTO', 'width' => '95', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	$col[] = array('text' => 'PARADIGMA', 'width' => '95', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);	
	$pdf->Ln(1);
	if($acao_assuntos!=NULL): //Se existe assuntos
		foreach($acao_assuntos as $ass):
			$IdRegAssunto = $ass->Id; //não confundir com IdAssunto.
			$AcoesId = $ass->AcoesId;
			$AssuntoId = $ass->AssuntoId;
			$AssDescricao = $ass->Descricao;
			$Paradigma = $ass->Paradigma; if($Paradigma==""){$Paradigma="-";}
				
			$titulo = array();
			$col = array();	 
			$col[] = array('text' => $AssDescricao, 'width' => '95', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
			$col[] = array('text' => $Paradigma, 'width' => '90', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
			$titulo[] = $col;
			$pdf->WriteTable($titulo);	 
		endforeach;
	else:
		$titulo = array();
		$col = array();	 
		$col[] = array('text' => 'NENHUM ASSUNTO CADASTRADO', 'width' => '190', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LRTB');
		$titulo[] = $col;
		$pdf->WriteTable($titulo);	 
	endif;	
	
	$pdf->Ln(5);
	$titulo = array();
	$col = array();	 
	$col[] = array('text' => 'AUDIÊNCIAS', 'width' => '190', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);		

	if($audiencias!=NULL): //Se existe assuntos
		$titulo = array();
		$col = array();	 
		$col[] = array('text' => 'DATA-HORA', 'width' => '30', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
		$col[] = array('text' => 'TIPO', 'width' => '35', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
		$col[] = array('text' => 'PREPOSTO', 'width' => '65', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
		$col[] = array('text' => 'OBSERVAÇÕES', 'width' => '60', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');	
		$titulo[] = $col;
		$pdf->WriteTable($titulo);	
		$pdf->Ln(1);
		foreach($audiencias as $aud):
			$IdRegAud = $aud->Id;
			$AcaoId = $aud->AcaoId;
			$AudienciaDataHora = $aud->AudienciaDataHora;
			if($AudienciaDataHora==""){$AudienciaDataHora="-";}else{$AudienciaDataHora=date('d/m/Y H:i',strtotime($AudienciaDataHora));}
			$AudienciaTipo = $aud->AudienciaTipoId;
			foreach ($tipoaudiencia as $tpaud):
				if($AudienciaTipo == $tpaud->Id){
					$audtiponome = $tpaud->Descricao;
				}
			endforeach;		
			$AudienciaPreposto = $aud->AudienciaPreposto;
			$AudObservacao = $aud->Observacao;	
			
			$titulo = array();
			$col = array();	 
			$col[] = array('text' => $AudienciaDataHora, 'width' => '30', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
			$col[] = array('text' => $audtiponome, 'width' => '35', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
			$col[] = array('text' => $AudienciaPreposto, 'width' => '65', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
			$col[] = array('text' => $AudObservacao, 'width' => '60', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');	
			$titulo[] = $col;
			$pdf->WriteTable($titulo);		
		endforeach;
	else:
		$pdf->Ln(1);
		$titulo = array();
		$col = array();	 
		$col[] = array('text' => 'NENHUMA AUDIÊNCIA CADASTRADA', 'width' => '190', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
		$titulo[] = $col;
		$pdf->WriteTable($titulo);	
	endif;	
		
	$pdf->Ln(5);
	$titulo = array();
	$col = array();
	$col[] = array('text' => 'PRAZOS', 'width' => '190', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);
	
	if($prazos!=NULL): //Se existe assuntos
	$titulo = array();
	$col = array();
	$col[] = array('text' => 'DATA', 'width' => '25', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	$col[] = array('text' => 'DESCRIÇÃO', 'width' => '75', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	$col[] = array('text' => 'OBSERVAÇÕES', 'width' => '75', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	$col[] = array('text' => 'STATUS', 'width' => '15', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);
	$pdf->Ln(1);
	foreach($prazos as $prz):
	$IdPrazo = $prz->Id;
	$AcaoId = $prz->AcaoId;
	$DescricaoPrazo = $prz->Descricao;
	$DataPrazo = $prz->Data;
	if($DataPrazo==""){$DataPrazo="-";}else{$DataPrazo=date('d/m/Y',strtotime($DataPrazo));}
	$ObsPrazo = $prz->Observacoes;
	$Concluido = $prz->Concluido;
	if($Concluido==0){$Concluido = 'NÃO';}
	if($Concluido==1){$Concluido = 'SIM';}
	
	$titulo = array();
	$col = array();
	$col[] = array('text' => $DataPrazo, 'width' => '25', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$col[] = array('text' => $DescricaoPrazo, 'width' => '75', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$col[] = array('text' => $ObsPrazo, 'width' => '75', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$col[] = array('text' => $Concluido, 'width' => '15', 'height' => '6', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);
	endforeach;
	else:
	$pdf->Ln(1);
	$titulo = array();
	$col = array();
	$col[] = array('text' => 'NENHUM PRAZO CADASTARDO', 'width' => '190', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);
	endif;	

	$pdf->Ln(5);
	$titulo = array();
	$col = array();	 
	$col[] = array('text' => 'ANDAMENTOS', 'width' => '190', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'B');
	$titulo[] = $col;
	$pdf->WriteTable($titulo);
	
	if($andamentos!=NULL):
		$titulo = array();
		$col = array();	 
		$col[] = array('text' => 'DATA', 'width' => '30', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
		$col[] = array('text' => 'ANDAMENTO', 'width' => '80', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
		$col[] = array('text' => 'OBSERVAÇÕES', 'width' => '80', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');	
		$titulo[] = $col;
		$pdf->WriteTable($titulo);	
		$pdf->Ln(1);
		$andamentodesc = '';
		foreach($andamentos as $and):
			$IdRegAnd = $and->Id;
			$DataAndamento = $and->Data;
			if($DataAndamento==""){$DataAndamento="-";}else{$DataAndamento=date('d/m/Y',strtotime($DataAndamento));}
			$AuxAndamentoId = $and->AuxAndamentoId;
			foreach ($auxandamentos as $andid):
				if($AuxAndamentoId == $andid->Id){
					$andamentodesc = $andid->Descricao;
				}		
			endforeach;
			$AcaoId = $and->AcoesId;
			$ObsAndamento = $and->Observacao;
				
			$titulo = array();
			$col = array();	 
			$col[] = array('text' => $DataAndamento, 'width' => '30', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
			$col[] = array('text' => $andamentodesc, 'width' => '80', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
			$col[] = array('text' => $ObsAndamento, 'width' => '80', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');	
			$titulo[] = $col;
			$pdf->WriteTable($titulo);	
		endforeach;
	else:
		$pdf->Ln(1);
		$titulo = array();
		$col = array();	 
		$col[] = array('text' => 'NENHUM ANDAMENTO CADASTRADO', 'width' => '190', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');	
		$titulo[] = $col;
		$pdf->WriteTable($titulo);		
	endif;
			
//VARIÁVEL ZERADA
//$columns = "";//
$pdf->Output("relatorio.pdf","I");
//$pdf->Output("relatorio.pdf","D");
else:?>
<?php $this->load->view('view_cabecalho');?>
	<h2>Relatório - Ação trabalhista</h2>
	<div class="status_box warning">
	<h6>Atenção:</h6>
		<ul>
			<li>Nenhum resultado foi retornado para os parâmetros informados!</li>
		</ul>
	</div>
	<br>
<?php 
	$this->load->view('view_rodape');
endif;
?>