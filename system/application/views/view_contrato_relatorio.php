<?php
//print_r($contratodetail);
header('Content-type: application/pdf');
$this->load->library('Fpdf_contrato_vertical.php');
$pdf=new Fpdf_contrato_vertical('P','mm','A4');

$pdf->AliasNbPages();
$pdf->AddPage();
if($contratodetail!=NULL):
	foreach ($contratodetail as $its):
		$IdContrato = $its->Id;
		$ContratoNr = $its->ContratoNr;
		$ContratoAno = $its->ContratoAno;
		$ContratoNumero = $its->ContratoNumero;
		$LicitacaoModalidadeId = $its->LicitacaoModalidadeId;
		$LicitacaoModalidade = $its->LicitacaoModalidade;
		$ProcessoNr = $its->ProcessoNr;
		/* if(($ProcessoNr != "")&&($ProcessoNr != NULL)){
			$primeiro = substr($ProcessoNr, 0, 3);
			$segundo = substr($ProcessoNr, 3, 3);
			$terceiro = substr($ProcessoNr, 6, 3);
			$quarto = substr($ProcessoNr, 9, 4);
			$ProcessoNr = $primeiro.".".$segundo.".".$terceiro."/".$quarto;
		}else{$ProcessoNr = '';} */
		$ProcSEI = $its->Sei;
		if($ProcSEI != ""){ //00112-00005028/2018-31
		    $parte1 = substr($ProcSEI, 0, 5);
		    $parte2 = substr($ProcSEI, 5, 8);
		    $parte3 = substr($ProcSEI, 13, 4);
		    $parte4 = substr($ProcSEI, 17, 2);
		    $ProcSEI = $parte1.'-'.$parte2.'/'.$parte3.'-'.$parte4;
		}else{$ProcSEI = '';}
		$ProcessoNrSemMascara = $its->ProcessoNrSemMascara;
		$EmpresaNome = $its->EmpresaNome;
		$EmpresaCNPJ = $its->EmpresaCnpj;
		$LicitacaoNumero = $its->LicitacaoNumero;
		$Diretoria = $its->Diretoria;
		$Objeto = $its->Objeto;
		$Valor = $its->Valor;// if($Valor != ""){$Valor = number_format($Valor, 2, ',', '.');}else{$Valor="0,00";}
		$AditivosValor = $its->AditivosValor; //if($AditivosValor != ""){$AditivosValor = number_format($AditivosValor, 2, ',', '.');}else{$AditivosValor="0,00";}
		$ValorComAditivos = $its->ValorComAditivos; //if($ValorComAditivos != ""){$ValorComAditivos = number_format($ValorComAditivos, 2, ',', '.');}else{$ValorComAditivos="0,00";}
		$DataAssinatura = $its->DataDeAssinatura; if($DataAssinatura==""){$DataAssinatura='';}else{$DataAssinatura = date('d/m/Y',strtotime($DataAssinatura));}
		$VigenciaInicio = $its->VigenciaInicio; if($VigenciaInicio==""){$VigenciaInicio='';}else{$VigenciaInicio = date('d/m/Y',strtotime($VigenciaInicio));}
		$VigenciaFim = $its->VigenciaFim; if($VigenciaFim==""){$VigenciaFim='';}else{$VigenciaFim = date('d/m/Y',strtotime($VigenciaFim));}
		$PrazoVigAditado = $its->PrazoDeVigenciaAditado; if($PrazoVigAditado==""){$PrazoVigAditado='';}else{$PrazoVigAditado = date('d/m/Y',strtotime($PrazoVigAditado));}
		$PrazoDeVigenciaAtivo = $its->PrazoDeVigenciaAtivo;
		$ExecucaoInicio = $its->ExecucaoInicio; if($ExecucaoInicio==""){$ExecucaoInicio='';}else{$ExecucaoInicio = date('d/m/Y',strtotime($ExecucaoInicio));}
		$ExecucaoFim = $its->ExecucaoFim; if($ExecucaoFim==""){$ExecucaoFim='';}else{$ExecucaoFim = date('d/m/Y',strtotime($ExecucaoFim));}
		$VigenciaPrazo = $its->VigenciaPrazo;
		$VigenciaTipo = $its->VigenciaTipo;
		$ExecucaoPrazo = $its->ExecucaoPrazo;
		$ExecucaoTipo = $its->ExecucaoTipo;
		$Situacao = $its->Situacao;
		$Executor = $its->Executor;
		$Observacoes = $its->Observacoes;
		$Ativo = $its->Ativo; if($Ativo==1){$Ativo='ATIVO';}else{$Ativo='INATIVO';}
		$LicitacaoProcesso = $its->LicitacaoProcesso;
	endforeach;

	$Diretorias = array(
		array(
				'Sigla' => 'DA',
				'Descricao' => 'DIRETORIA ADMINISTRATIVA'
		),
		array(
				'Sigla' => 'DE',
				'Descricao' => 'DIRETORIA DE EDIFICA&Ccedil;&Otilde;ES'
		),
				array(
				'Sigla' => 'DOE',
				'Descricao' => 'DIRETORIA DE OBRAS ESPECIAIS'
		),
				array(
				'Sigla' => 'DU',
				'Descricao' => 'DIRETORIA DE URBANIZA&Ccedil;&Atilde;O'
		)
	);

	 $titulo = array();
	 $col = array();
	 $col[] = array('text' => 'CONTRATO', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 $col[] = array('text' => $ContratoNr, 'width' => '50', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTR');
	 $col[] = array('text' => 'VALOR', 'width' => '50', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTL');
	 $col[] = array('text' => $Valor, 'width' => '45', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 $titulo[] = $col;
	 $pdf->WriteTable($titulo);

	 $titulo = array();
	 $col = array();
	 $col[] = array('text' => 'PROCESSO', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 $col[] = array('text' => $ProcessoNr, 'width' => '50', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTR');
	 $col[] = array('text' => 'DIRETORIA', 'width' => '50', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTL');
	 $col[] = array('text' => $Diretoria, 'width' => '45', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 $titulo[] = $col;
	 $pdf->WriteTable($titulo);

	 $titulo = array();
	 $col = array();
	 $col[] = array('text' => 'DATA ASSINATURA', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 $col[] = array('text' => $DataAssinatura, 'width' => '50', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTR');
	 $col[] = array('text' => utf8_decode('SITUAÇÃO'), 'width' => '50', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTL');
	 $col[] = array('text' => $Situacao, 'width' => '45', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 $titulo[] = $col;
	 $pdf->WriteTable($titulo);

	 $titulo = array();
	 $col = array();
	 $col[] = array('text' => utf8_decode('LICITAÇÃO Nº'), 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 $col[] = array('text' => $LicitacaoNumero, 'width' => '50', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTR');
	 $col[] = array('text' => 'MODALIDADE', 'width' => '50', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTL');
	 $col[] = array('text' => $LicitacaoModalidade, 'width' => '45', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 $titulo[] = $col;
	 $pdf->WriteTable($titulo);

	 $titulo = array();
	 $col = array();
	 $col[] = array('text' => 'EMPRESA', 'width' => '25', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	 $col[] = array('text' => $EmpresaNome, 'width' => '115', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	 $col[] = array('text' => 'CNPJ', 'width' => '15', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	 $col[] = array('text' => $EmpresaCNPJ, 'width' => '35', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	 $titulo[] = $col;
	 $pdf->WriteTable($titulo);

	 $titulo = array();
	 $col = array();
	 $col[] = array('text' => 'OBJETO', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	 $col[] = array('text' => strtoupper($Objeto), 'width' => '145', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	 $titulo[] = $col;
	 $pdf->WriteTable($titulo);

	 $titulo = array();
	 $col = array();
	 $col[] = array('text' => 'EXECUTOR', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	 $col[] = array('text' => $Executor, 'width' => '145', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	 $titulo[] = $col;
	 $pdf->WriteTable($titulo);

	 $titulo = array();
	 $col = array();
	 $col[] = array('text' => 'STATUS', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	 $col[] = array('text' => $Ativo, 'width' => '145', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	 $titulo[] = $col;
	 $pdf->WriteTable($titulo);

	 $titulo = array();
	 $col = array();
	 $col[] = array('text' => utf8_decode('OBSERVAÇÕES'), 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	 $col[] = array('text' => $Observacoes, 'width' => '145', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	 $titulo[] = $col;
	 $pdf->WriteTable($titulo);

	 $titulo = array();
	 $col = array();
	 $col[] = array('text' => utf8_decode('VIGÊNCIA'), 'width' => '95', 'height' => '6', 'align' => 'C', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TBR');
	 $col[] = array('text' => utf8_decode('EXECUÇÃO'), 'width' => '95', 'height' => '6', 'align' => 'C', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TBL');
	 $titulo[] = $col;
	 $pdf->WriteTable($titulo);

	 $titulo = array();
	 $col = array();
	 $col[] = array('text' => utf8_decode('INÍCIO'), 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 $col[] = array('text' => $VigenciaInicio, 'width' => '50', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTR');
	 $col[] = array('text' => utf8_decode('INÍCIO'), 'width' => '50', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTL');
	 $col[] = array('text' => $ExecucaoInicio, 'width' => '45', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 $titulo[] = $col;
	 $pdf->WriteTable($titulo);

	 $titulo = array();
	 $col = array();
	 $col[] = array('text' => 'PRAZO', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 $col[] = array('text' => $VigenciaPrazo.' '.$VigenciaTipo, 'width' => '50', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTR');
	 $col[] = array('text' => 'PRAZO', 'width' => '50', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTL');
	 $col[] = array('text' => $ExecucaoPrazo.' '.$ExecucaoTipo, 'width' => '45', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 $titulo[] = $col;
	 $pdf->WriteTable($titulo);

	 $titulo = array();
	 $col = array();
	 $col[] = array('text' => 'FIM', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 $col[] = array('text' => $VigenciaFim, 'width' => '50', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTR');
	 $col[] = array('text' => 'FIM', 'width' => '50', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTL');
	 $col[] = array('text' => $ExecucaoFim, 'width' => '45', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 $titulo[] = $col;
	 $pdf->WriteTable($titulo);

	 $titulo = array();
	 $col = array();
	 $col[] = array('text' => 'FIM (ADITIVOS)', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 $col[] = array('text' => $PrazoVigAditado, 'width' => '50', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTR');
	 $col[] = array('text' => 'FIM (ADITIVOS)', 'width' => '50', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTL');
	 $col[] = array('text' => '...', 'width' => '45', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 $titulo[] = $col;
	 $pdf->WriteTable($titulo);
	 $pdf->Ln(5);

	 if($aditivos!=NULL):
	 	$AditivoDenominacao = '';
	 	$AditivoTipo = '';
	 	foreach($aditivos as $adt):
     	$IdAdit = $adt->Id;
     	$AditivoDenominacao = $adt->AditivoDenominacao;
     	$AditivoTipo = $adt->AditivoTipo; if($AditivoTipo==""){$AditivoTipo="-";}
     	$AditivoValor = $adt->AditivoValor; if($AditivoValor==""){$AditivoValor="-";}
     	$AditivoPrazo = $adt->AditivoPrazo; if($AditivoPrazo==""){$AditivoPrazo="-";}
     	//$PrazoDeExecucaoTipo = $adt->PrazoDeExecucaoTipo; if($PrazoDeExecucaoTipo==""){$PrazoDeExecucaoTipo="-";}
     	$AditivoProcessoNr = $adt->AditivoProcessoNr; if($AditivoProcessoNr==""){$AditivoProcessoNr="-";}
     	$AditivoData = $adt->AditivoData; if($AditivoData==""){$AditivoData="-";}
     	$AditivoDataSolicitacao = $adt->AditivoDataSolicitacao; if($AditivoDataSolicitacao==""){$AditivoDataSolicitacao="-";}
     	$AditivoDataPublicacao = $adt->AditivoDataPublicacao; if($AditivoDataPublicacao==""){$AditivoDataPublicacao="-";}
     	$AditivoResultado = $adt->AditivoResultado; if($AditivoResultado==""){$AditivoResultado="-";}
     	$AditivoPDF = $adt->AditivoPDF; if($AditivoPDF==""){$AditivoPDF="-";}
     	$ObsAdt = $adt->Observacoes; if($ObsAdt==""){$ObsAdt="-";}
     	$PrazoDeVigencia = $adt->PrazoDeVigencia; if($PrazoDeVigencia==""){$PrazoDeVigencia="-";}
     	$PrazoDeExecucao = $adt->PrazoDeExecucao; if($PrazoDeExecucao==""){$PrazoDeExecucao="-";}
			$PrazoDeExecucaoInicio = $adt->PrazoDeExecucaoInicio; if($PrazoDeExecucaoInicio==""){$PrazoDeExecucaoInicio="-";}
			$PrazoDeExecucaoFim = $adt->PrazoDeExecucaoFim; if($PrazoDeExecucaoFim==""){$PrazoDeExecucaoFim="-";}
     	$MotivacaoAdt = $adt->Motivacao; if($MotivacaoAdt==""){$MotivacaoAdt="-";}
     	$AditivoDenominacao = $adt->AditivoDenominacao; if($AditivoDenominacao==""){$AditivoDenominacao="-";}

	 		$titulo = array();
	 		$col = array();
	 		$col[] = array('text' => strtoupper($AditivoDenominacao), 'width' => '190', 'height' => '5', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '235,235,235', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');
	 		$titulo[] = $col;
	 		$pdf->WriteTable($titulo);

	 		$titulo = array();
	 		$col = array();
	 		$col[] = array('text' => 'TIPO', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 		$col[] = array('text' => $AditivoTipo, 'width' => '50', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTR');
	 		$col[] = array('text' => 'PROCESSO', 'width' => '50', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTL');
	 		$col[] = array('text' => $AditivoProcessoNr, 'width' => '45', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 		$titulo[] = $col;
	 		$pdf->WriteTable($titulo);

	 		$titulo = array();
	 		$col = array();
	 		$col[] = array('text' => 'DATA DO ADITIVO', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 		$col[] = array('text' => $AditivoData, 'width' => '50', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTR');
	 		$col[] = array('text' => utf8_decode('DATA DE PUBLICAÇÃO'), 'width' => '50', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTL');
	 		$col[] = array('text' => $AditivoDataPublicacao, 'width' => '45', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 		$titulo[] = $col;
	 		$pdf->WriteTable($titulo);

	 		$titulo = array();
	 		$col = array();
	 		$col[] = array('text' =>  utf8_decode('DATA DA SOLICITAÇÃO'), 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 		$col[] = array('text' => $AditivoDataSolicitacao, 'width' => '50', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTR');
	 		$col[] = array('text' => 'RESULTADO', 'width' => '50', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTL');
	 		$col[] = array('text' => $AditivoResultado, 'width' => '45', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 		$titulo[] = $col;
	 		$pdf->WriteTable($titulo);

	 		$titulo = array();
	 		$col = array();
	 		$col[] = array('text' => utf8_decode('VIGÊNCIA'), 'width' => '95', 'height' => '6', 'align' => 'C', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TBR');
	 		$col[] = array('text' => utf8_decode('EXECUÇÃO'), 'width' => '95', 'height' => '6', 'align' => 'C', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TBL');
	 		$titulo[] = $col;
	 		$pdf->WriteTable($titulo);

	 		$titulo = array();
	 		$col = array();
	 		$col[] = array('text' => 'PRAZO ADITADO', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 		$col[] = array('text' => $PrazoDeVigencia, 'width' => '50', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTR');
	 		$col[] = array('text' => utf8_decode('INÍCIO'), 'width' => '50', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTL');
	 		$col[] = array('text' => $PrazoDeExecucaoInicio, 'width' => '45', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 		$titulo[] = $col;
	 		$pdf->WriteTable($titulo);

	 		$titulo = array();
	 		$col = array();
	 		$col[] = array('text' => '', 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 		$col[] = array('text' => '', 'width' => '50', 'height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTR');
	 		$col[] = array('text' => 'FIM', 'width' => '50', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BTL');
	 		$col[] = array('text' => $PrazoDeExecucaoFim, 'width' => '45', 'height' => '6', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
	 		$titulo[] = $col;
	 		$pdf->WriteTable($titulo);

	 		$titulo = array();
	 		$col = array();
	 		$col[] = array('text' => utf8_decode('MOTIVAÇÃO'), 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	 		$col[] = array('text' => $MotivacaoAdt, 'width' => '145', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	 		$titulo[] = $col;
	 		$pdf->WriteTable($titulo);

			$titulo = array();
	 		$col = array();
	 		$col[] = array('text' => utf8_decode('OBSERVAÇÕES'), 'width' => '45', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	 		$col[] = array('text' => $ObsAdt, 'width' => '145', 'height' => '6', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'TB');
	 		$titulo[] = $col;
	 		$pdf->WriteTable($titulo);

	 	endforeach;
	 else:
	 	$pdf->Ln(1);
	 	$titulo = array();
	 	$col = array();
	 	$col[] = array('text' => 'NENHUM ADITIVO CADASTRADO', 'width' => '190', 'height' => '6', 'align' => 'L', 'alignv' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => '');
	 	$titulo[] = $col;
	 	$pdf->WriteTable($titulo);
	 endif;

//VARI�VEL ZERADA
//$columns = "";//
$pdf->Output("relatorio.pdf","I");
//$pdf->Output("relatorio.pdf","D");
else:?>
<?php $this->load->view('view_cabecalho');?>
	<h2>Relat�rio - A��o trabalhista</h2>
	<div class="status_box warning">
	<h6>Aten��o:</h6>
		<ul>
			<li>Nenhum resultado foi retornado para os par�metros informados!</li>
		</ul>
	</div>
	<br>
<?php
	$this->load->view('view_rodape');
endif;
?>
