<?php
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' =>  'calendar'); ?>

<script language="JavaScript">
function validaditivo(){
	adtdenominacao = document.formaditivo.adtdenominacao.value;
	tipodenomin = document.formaditivo.tipodenomin.value;
	if ((adtdenominacao=="")||(tipodenomin=="")){
		alert("Por favor, preencha todos os campos obrigat�rios!");
		return false;
	}
}
</script>

<?php
//print_r($aditivodetail);
if(!empty($aditivodetail)&&(sizeof($aditivodetail)>0)){
foreach ($aditivodetail as $adt):
	$IdAditivo = $adt->Id;
	$AditivoDenominacaoId = $adt->AditivoDenominacaoId;
	$ContratoId = $adt->ContratoId;
	$AditivoTipoId = $adt->AditivoTipoId;
	$AditivoValor = $adt->AditivoValor;
	if($AditivoValor != ""){$AditivoValor = number_format($AditivoValor, 2, ',', '.');}else{$AditivoValor="0,00";}
	$AditivoPrazo = $adt->AditivoPrazo;
	$AditivoProcessoNr = $adt->AditivoProcessoNr;
	if(($AditivoProcessoNr != "")&&($AditivoProcessoNr != 'NULL')){
		$primeiro = substr($AditivoProcessoNr, 0, 3);
		$segundo = substr($AditivoProcessoNr, 3, 3);
		$terceiro = substr($AditivoProcessoNr, 6, 3);
		$quarto = substr($AditivoProcessoNr, 9, 4);
		$AditivoProcessoNr = $primeiro.".".$segundo.".".$terceiro."/".$quarto;
	}else{$AditivoProcessoNr = "";}
	$AditivoData = $adt->AditivoData;
	if($AditivoData==""){$AditivoData='';}else{$AditivoData = date('d/m/Y',strtotime($AditivoData));}
	$AditivoDataSolicitacao = $adt->AditivoDataSolicitacao;
	if($AditivoDataSolicitacao==""){$AditivoDataSolicitacao='';}else{$AditivoDataSolicitacao = date('d/m/Y',strtotime($AditivoDataSolicitacao));}
	$AditivoDataPublicacao = $adt->AditivoDataPublicacao;
	if($AditivoDataPublicacao==""){$AditivoDataPublicacao='';}else{$AditivoDataPublicacao = date('d/m/Y',strtotime($AditivoDataPublicacao));}
	$AditivoResultado = $adt->AditivoResultado;
	//$Motivacao = $adt->Motivacao; //CAMPO LONGO, BUSCO SEPARADAMENTE
	$Observacoes = $adt->Observacoes;
	$PrazoDeVigenciaTipo = $adt->PrazoDeVigenciaTipo;
	$PrazoDeVigencia = $adt->PrazoDeVigencia;
	$PrazoDeExecucaoTipo = $adt->PrazoDeExecucaoTipo;
	$PrazoDeExecucao = $adt->PrazoDeExecucao;
	$PrazoDeExecucaoInicio = $adt->PrazoDeExecucaoInicio;
	if($PrazoDeExecucaoInicio==""){$PrazoDeExecucaoInicio='';}else{$PrazoDeExecucaoInicio = date('d/m/Y',strtotime($PrazoDeExecucaoInicio));}
	$PrazoDeExecucaoFim = $adt->PrazoDeExecucaoFim;
	if($PrazoDeExecucaoFim==""){$PrazoDeExecucaoFim='';}else{$PrazoDeExecucaoFim = date('d/m/Y',strtotime($PrazoDeExecucaoFim));}
	$ProcSEI = $adt->SEI;
	if($ProcSEI != ""){ //00112-00005028/2018-31
	    $parte1 = substr($ProcSEI, 0, 5);
	    $parte2 = substr($ProcSEI, 5, 8);
	    $parte3 = substr($ProcSEI, 13, 4);
	    $parte4 = substr($ProcSEI, 17, 2);
	    $ProcSEI = $parte1.'-'.$parte2.'/'.$parte3.'-'.$parte4;
	}else{$ProcSEI = '';}
endforeach;

foreach ($aditivodetailongo as $adtlongo):
	$Motivacao = $adtlongo->Motivacao; //CAMPO LONGO, BUSCO SEPARADAMENTE
endforeach;?>

<div id="caixa7">
<div id="tabs">

<h2>Altera&ccedil;&otilde;o de aditivo</h2>

<fieldset class='visible' style='width:933px'>
<div id="tabs-1">
<form method="post" action="<?php echo base_url();?>caditivo/saveaditivo" name="formaditivo" onsubmit="return validaditivo()">
<input type="hidden" name="aditivoid" id="aditivoid" size="14"  value="<?php echo $IdAditivo;?>"/>
<input type="hidden" name="contratoid" id="contratoid" size="14"  value="<?php echo $ContratoId;?>"/>

<div class="row">
	<div class="label">Denominação</div>
	<div class="field">
		<select name="adtdenominacao" style="width:150px;" required autofocus>
			<option value=""></option>
			<?php foreach ($denominacao as $dnm):
			if($AditivoDenominacaoId==$dnm->Id){?>
				<option value="<?php echo $dnm->Id;?>" selected><?php echo utf8_encode($dnm->Descricao)?></option>
			<?php }else{ ?>
				<option value="<?php echo $dnm->Id;?>"><?php echo utf8_encode($dnm->Descricao)?></option>
			<?php } endforeach;?>
		</select>
	</div>
	&nbsp;&nbsp;
	Tipo
	<div class="field">
		<select name="tipodenomin" style="width:130px;" required>
			<option value=""></option>
			<?php foreach ($tipo as $tp):
			if($AditivoTipoId==$tp->Id){?>
				<option value="<?php echo $tp->Id;?>" selected><?php echo $tp->Descricao;?></option>
			<?php }else{ ?>
				<option value="<?php echo $tp->Id;?>"><?php echo $tp->Descricao;?></option>
			<?php } endforeach;?>
		</select>
	</div>
	&nbsp;&nbsp;
	Processo
	<div class="field">
		<input type="text" name="praditivo" id="praditivo" value="<?php echo $AditivoProcessoNr?>" size="15" maxlength="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)' required/>
	</div>
	&nbsp;&nbsp;
	Proc. SEI
	<div class="field">
		<input type="text" name="prsei" id="prsei" maxlength="22" size="21" value="<?php echo $ProcSEI?>" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)' required/>
	</div>
</div>

<div class="row">
<div class="label">Aditivos de valor</div>
<div class="field">
	<div class="field">
		<input type="text" name="aditivovlr" id="aditivovlr" value="<?php echo $AditivoValor?>" size="12" onKeyPress="return MascaraMoeda(this,'.',',',event);" size="12" style="text-align:right;" required/>
	</div>
	&nbsp;&nbsp;&nbsp;
	Prorrog. vig&ecirc;ncia
	<div class="field">
		Prazo <input type="text" name="adtprazovig" id="adtprazovig" value="<?php echo $PrazoDeVigencia?>" size="4" onkeypress='return SomenteNumero(event)' required/>
	</div>
	<div class="field" required>
		<select name="adtprazovigtipo">
			<?php if($PrazoDeVigenciaTipo=='DIAS'){?>
				<option value="DIAS" selected>DIAS</option>
				<option value="MESES">MESES</option>
			<?php }else if($PrazoDeVigenciaTipo=='MESES'){?>
				<option value="DIAS">DIAS</option>
				<option value="MESES" selected>MESES</option>
			<?php }else{ ?>
				<option value="DIAS">DIAS</option>
				<option value="MESES">MESES</option>
			<?php } ?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Motivação</div>
	<div class="field">
		<textarea name="adtmotivacao" cols="105" rows="9" maxlength="1000" style="text-transform:uppercase;" required><?php echo $Motivacao?></textarea>
	</div>
</div>

<div class="row">
	<div class="label">Observações</div>
	<div class="field">
		<textarea name="adtobservacoes" cols="105" rows="3" maxlength="200" style="text-transform:uppercase;"><?php echo $Observacoes?></textarea>
	</div>
</div>
<hr>
<?php if ($acessoNivel == 2) { ?>
<div class="row">
	<input type="submit" name="Gravar" value="Gravar" class="botao"/>
	<a href="<?php echo base_url()."caditivo/detailaditivo/".$ContratoId."/".$IdAditivo."#tabs-2";?>"><input type="button" value="Cancelar" onclick="location.href('<?php echo base_url()."caditivo/detailaditivo/".$ContratoId."/".$IdAditivo."#tabs-2";?>')" class="botao"></a> &nbsp;<?php } ?>
</div>
<?php
}
else { ?>
<div class="status_box warning">
	<h6>Aviso!</h6>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Nenhuma registro encontrato!
</div>
<?php } ?>
</form>
</fieldset>
</div>
</div>
</div>

<?php $this->load->view('view_rodape');?>
