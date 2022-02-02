<?php
$this->load->view('view_cabecalho');
$attributes = array('name' =>  'calendar');?>

<script language="JavaScript">
function validacaotrab(){
	prjud = document.formacaotrab.prjud.value; /* 0001069-77.2016.5.10.0010 - char[25] */
	vara = document.formacaotrab.varaid.value;
	psnvap = document.formacaotrab.posicaonovacap.value;
	var prsei = document.formacaotrab.prsei.value;
	if((prjud=="")||(vara=="")||(psnvap=="")){
		alert("Por favor, preencha todos os campos obrigat\u00f3rios!");
		return false;
	}
	if(prjud.length != 25){
		alert("Processo judicial inv\u00e1lido!");
		return false;
	}

	if(prsei != ""){
		if(prsei.length != 22){ //contagem bruta, considerar para cr�tica apenas os n�meros.
			alert("Processo SEI deve ter exatamente 19 d\u00edgitos!");
			document.formacaotrab.prsei.focus();
			return false;
		}
	}
}
</script>

<?php
//print_r($acaodetail);
foreach ($acaodetail as $acao):
	$IdAcao = $acao->Id;
	$AcaoTipoId = $acao->AcaoTipoId;
	$PrJudicial = $acao->ProcessoJudicialNumero;
	if($PrJudicial != ""){ //0000818-14.2015.5.10.0004
		$p1 = substr($PrJudicial,0,7);
		$p2 = substr($PrJudicial,7,2);
		$p3 = substr($PrJudicial,9,4);
		$p4 = substr($PrJudicial,13,1);
		$p5 = substr($PrJudicial,14,2);
		$p6 = substr($PrJudicial,16,4);
		$ProcessoJud = $p1.'-'.$p2.'.'.$p3.'.'.$p4.'.'.$p5.'.'.$p6;
	}else{$ProcessoJud = "";}

	$PrPai = $acao->ProcessoPai;
	if($PrPai != ""){ //0000818-14.2015.5.10.0004
		$p1 = substr($PrPai,0,7);
		$p2 = substr($PrPai,7,2);
		$p3 = substr($PrPai,9,4);
		$p4 = substr($PrPai,13,1);
		$p5 = substr($PrPai,14,2);
		$p6 = substr($PrPai,16,4);
		$ProcessoPai = $p1.'-'.$p2.'.'.$p3.'.'.$p4.'.'.$p5.'.'.$p6;
	}else{$ProcessoPai = "";}

	$VaraId = $acao->VaraId;
	$PrAdmin = $acao->ProcessoAdministrativoNumero;
	if($PrAdmin != ""){
		$primeiro = substr($PrAdmin, 0, 3);
		$segundo = substr($PrAdmin, 3, 3);
		$terceiro = substr($PrAdmin, 6, 3);
		$quarto = substr($PrAdmin, 9, 4);
		$ProcessoAdmin = $primeiro.".".$segundo.".".$terceiro."/".$quarto;
	}else{$ProcessoAdmin = "";}
	$CalculoHomologadoValor = $acao->CalculoHomologadoValor; if($CalculoHomologadoValor != ""){$CalculoHomologadoValor = number_format($CalculoHomologadoValor, 2, ',', '.');}else{$CalculoHomologadoValor="0,00";}
	$CausaValor = $acao->CausaValor; if($CausaValor != ""){$CausaValor = number_format($CausaValor, 2, ',', '.');}else{$CausaValor="0,00";}
	$SentencaValor = $acao->SentencaValor; if($CausaValor != ""){$SentencaValor = number_format($SentencaValor, 2, ',', '.');}else{$SentencaValor="0,00";}
	$CondenacaoValor = $acao->CondenacaoValor; if($CausaValor != ""){$CondenacaoValor = number_format($CondenacaoValor, 2, ',', '.');}else{$CondenacaoValor="0,00";}
	$AcordaoValor = $acao->AcordaoValor; if($AcordaoValor != ""){$AcordaoValor = number_format($AcordaoValor, 2, ',', '.');}else{$AcordaoValor="0,00";}
	$ProbaDePerdaId = $acao->ProbabilidadeDePerdaId;
	$FundamentoLegal = utf8_encode($acao->FundamentoLegal);
	$Observacoes = $acao->Observacoes;
	$Ativo = $acao->Ativo;
	$Caixa = $acao->Caixa;
	$DtAjuiz =  $acao->DataDoAjuizamento;
	if($DtAjuiz==""){$DtAjuiz='';}else{$DtAjuiz = date('d/m/Y',strtotime($DtAjuiz));}
	$DataDeExtincao = $acao->DataDeExtincao; if($DataDeExtincao==""){$DataDeExtincao='';}else{$DataDeExtincao = date('d/m/Y',strtotime($DataDeExtincao));}
	$Sisprot = $acao->Sisprot;
	if(($Sisprot=="")||($Sisprot=='NULL')){$Sisprot='';}
	$PosicaoNovacap = $acao->PosicaoNovacap;
	if(($PosicaoNovacap=="")||($PosicaoNovacap=='NULL')){$PosicaoNovacap='';}
	$autorAcao = $acao->Autor;
	$reuAcao  = $acao->Reu;
	$ProcSEI = $acao->SEI;
	if($ProcSEI != ""){ //00112-00005028/2018-31
	    $parte1 = substr($ProcSEI, 0, 5);
	    $parte2 = substr($ProcSEI, 5, 8);
	    $parte3 = substr($ProcSEI, 13, 4);
	    $parte4 = substr($ProcSEI, 17, 2);
	    $ProcSEI = $parte1.'-'.$parte2.'/'.$parte3.'-'.$parte4;
	}else{$ProcSEI = '';}
endforeach;

$ProbPerda = array( //Manter probabilidade de perdas padrão.
    array(
        'Id' => 1,
        'Descricao' => utf8_decode('PROVÁVEL')
    ),
    array(
        'Id' => 2,
        'Descricao' => utf8_decode('POSSÍVEL')
    ),
        array(
        'Id' => 3,
        'Descricao' => 'REMOTA'
    )
);

$NivelAcs = "";
// INCLUIR ANTES NA TABELA USUÁRIOS -> pegar nível em Mjuridico->getNivelAcesso($usuariolog);
//print_r($nivelacesso);
foreach ($nivelacesso as $nvl):
	$IdNivelAcs = $nvl->Id;
	$NomeNivelAcs = $nvl->Nome;
	$MatNivelAcs = $nvl->Matricula;
	$LoginNivelAcs = $nvl->Login;
	$NivelAcs = $nvl->Nivel; /* acesso aos níveis 1, 2 e 3 */
	//$NivelAcs = 4;
	$DescricaoNivelAcs = $nvl->Descricao;
endforeach;?>

<fieldset class=visible style='width:938px;margin-left:0;background-color: #87CEFA;'>
	<font size="5">Alteração de ação trabalhista</font>
</fieldset>

<div id="caixa7">
<div id="tabs">

<fieldset class='visible' style='width:938px;margin-left: -3px; margin-top: -3px;'>
<form method="post" action="<?php echo base_url();?>cjuridico/saveacaotrab" name="formacaotrab" onsubmit="return validacaotrab()">
<input type="hidden" name="idacao" id="idacao" value="<?php echo $IdAcao;?>" size="10"/>
<input type="hidden" name="nivelacs" id="nivelacs" value="<?php echo $NivelAcs;?>" size="10"/>

<div class="row">
	<div class="label">Autor</div>
	<div class="field">
		<input type="text" name="fundlegal" id="fundlegal" value="<?php echo $autorAcao?>" size="100" style="text-transform: uppercase;background-color:#F2F2F2;" readonly/>
	</div>
</div>

<div class="row">
	<div class="label">R&eacute;u</div>
	<div class="field">
		<input type="text" name="fundlegal" id="fundlegal" value="<?php echo $reuAcao?>" size="100" style="text-transform: uppercase;background-color:#F2F2F2;" readonly/>
	</div>
</div>

<div class="row">
<div class="label">Processo judicial</div>
	<div class="field">
		<input type="text" name="prjud" id="prjud" maxlength="25" size="26"  value="<?php echo $ProcessoJud;?>" onkeypress='MaskPrJud(this, event); return SomenteNumero(event)' disabled/>
	</div>
	&nbsp;&nbsp;
	Processo admin.
	<div class="field">
		<input type="text" name="pradm" id="pradm" size="18" maxlength="17" value="<?php echo $ProcessoAdmin;?>" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)'/>
	</div>
	&nbsp;
	Processo SEI
	<div class="field">
		<input type="text" name="prsei" id="prsei" maxlength="22" size="23" value="<?php echo $ProcSEI?>" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)'/>
	</div>
</div>

<div class="row">
	<div class="label">Fundamento Legal</div>
	<div class="field">
		<input type="text" name="fundlegal" id="fundlegal" value="<?php echo $FundamentoLegal;?>" maxlength="50" size="80"/>
	</div>
</div>

<div class="row">
	<div class="label">C&aacute;lculo homologado</div>
	<div class="field">
		<input type="text" name="calchomovalor" id="calchomovalor" size="10"  value="<?php echo $CalculoHomologadoValor;?>" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
	&nbsp;
	Valor da causa
	<div class="field">
		<input type="text" name="causavalor" id="causavalor" size="10"  value="<?php echo $CausaValor;?>" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
	&nbsp;
	Valor senten&ccedil;a
	<div class="field">
		<input type="text" name="sentencavalor" id="sentencavalor" size="10"  value="<?php echo $SentencaValor;?>" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
</div>

<div class="row">
	<div class="label">Valor ac&oacute;rd&atilde;o</div>
	<div class="field">
		<input type="text" name="acordaovalor" id="acordaovalor" size="10"  value="<?php echo $AcordaoValor?>" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
	&nbsp;
	Valor condena&ccedil;&atilde;o
	<div class="field">
		<input type="text" name="condenavalor" id="condenavalor" size="10"  value="<?php echo $CondenacaoValor;?>" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
</div>

<div class="row">
	<div class="label">Vara</div>
	<div class="field">
		<select name="varaid" style="width:300px;" required>
			<option value=""></option>
			<?php foreach ($varas as $vr):
			if($VaraId==$vr->VaraId){?>
				<option value="<?php echo $vr->VaraId;?>" selected><?php echo utf8_encode($vr->Descricao)?></option>
			<?php }else{ ?>
				<option value="<?php echo $vr->VaraId;?>"><?php echo utf8_encode($vr->Descricao)?></option>
			<?php }endforeach; ?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Probab. de perda</div>
	<div class="field">
		<select name="probabilidadeid">
			<option value=""></option>
			<?php foreach ($ProbPerda as $prob):
			if($ProbaDePerdaId==$prob['Id']){?>
				<option value="<?php echo $prob['Id'];?>" selected><?php echo utf8_encode($prob['Descricao'])?></option>
			<?php }else { ?>
				<option value="<?php echo $prob['Id'];?>"><?php echo utf8_encode($prob['Descricao'])?></option>
			<?php } endforeach;?>
		</select>
	</div>
	&nbsp;&nbsp;&nbsp;&nbsp;
	Posi&ccedil;&atilde;o da Novacap no processo
	<div class="field">
		<?php if($PosicaoNovacap==1){?>
			<input type="radio" name="posicaonovacap" value="1" checked/>Autora
			<input type="radio" name="posicaonovacap" value="2"/>R&eacute;
		<?php }else if($PosicaoNovacap==2){?>
			<input type="radio" name="posicaonovacap" value="1"/>Autora
			<input type="radio" name="posicaonovacap" value="2" checked/>R&eacute;
		<?php }else{?>
			<input type="radio" name="posicaonovacap" value="1"/>Autora
			<input type="radio" name="posicaonovacap" value="2"/>R&eacute;
		<?php }?>
	</div>
</div>

<div class="row">
	<div class="label">Observa&ccedil;&otilde;es</div>
	<div class="field">
		<textarea name="observacao" rows="3" cols="95" maxlength="500"><?php echo utf8_encode($Observacoes)?></textarea>
	</div>
</div>


<div class="row">
	<div class="label">Status do processo</div>
	<div class="field">
		<select name="statusprocessoid" required>
			<option value=""></option>
			<?php if($Ativo==1){?>
				<option value="1" selected>ATIVO</option>
				<option value="0">INATIVO</option>
			<?php } else{?>
				<option value="1">ATIVO</option>
				<option value="0" selected>INATIVO</option>
			<?php } ?>
		</select>
	</div>
	&nbsp;
	Data de ajuizamento
	<div class="field">
		<input type="text" value="<?php echo $DtAjuiz;?>" name="dtajuizamento" id="dtajuizamento" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formacaotrab.dtajuizamento,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
		<a onclick="document.getElementById('dtajuizamento').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url();?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
	</div>
	&nbsp;
	Data extin&ccedil;&atilde;o
	<div class="field">
		<input type="text" value="<?php echo $DataDeExtincao?>" name="dtextincao" id="dtextincao" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formacaotrab.dtextincao,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
		<a onclick="document.getElementById('dtextincao').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url();?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
	</div>
	&nbsp;
	Sisprot
	<div class="field">
		<input type="text" name="sisprot" id="sisprot" value="<?php echo $Sisprot;?>" size="8" maxlength="8" onkeypress='return SomenteNumero(event)'/>
	</div>
</div>

<div class="row">
	<div class="label">Caixa n&uacute;mero</div>
	<div class="field">
		<input type="text" name="cxnum" id="cxnum" value="<?php echo $Caixa;?>" size="3" maxlength="4" onkeypress='return SomenteNumero(event)'/>
	</div>
	&nbsp;&nbsp;
	Processo pai
	<div class="field">
		<input type="text" name="prpai" id="prpai" maxlength="25" size="26"  value="<?php echo $ProcessoPai;?>" onkeypress='MaskPrJud(this, event); return SomenteNumero(event)'/>
	</div>
</div>
<hr>
<div class="row">
<input type="submit" name="Salvar" value="Salvar" class="botao" style="text-decoration:none;color: green;"/>
<a href="<?php echo base_url()."cjuridico/detailacaotrab/".$IdAcao;?>" style="text-decoration:none;"><input type="button" value="Cancelar" onclick="location.href('<?php echo base_url()."cjuridico/detailacao/".$IdAcao;?>')" class="botao" style="color: red;"></a>
</form>
</fieldset>
</div>
</div>
</div>
<?php $this->load->view('view_rodape');?>
