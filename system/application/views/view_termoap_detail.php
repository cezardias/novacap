<?php 
$this->load->view('view_cabecalho');
$attributes = array('name' =>  'calendar'); ?>

<script language="JavaScript">
function validaditivo(){
	denom = document.formaditivo.denominacao.value;
	tipo = document.formaditivo.tipo.value;
	adtvlr = document.formaditivo.adtvalor.value;
	proc = document.formaditivo.processo.value;
	dtadit = document.formaditivo.dtaditivo.value;
	adtprazo = document.formaditivo.aditivoprazo.value;
	dtsol = document.formaditivo.dtsol.value;
	dtpub = document.formaditivo.dtpublica.value;
	dtres = document.formaditivo.dtresultado.value;
	adtres = document.formaditivo.aditivoresultado.value;

	if ((denom=="")||(tipo=="")||(adtvlr=="")||(proc=="")||(dtadit=="")||(adtprazo=="")||
		(dtsol=="")||(dtpub=="")||(dtres=="")||(adtres=="")){
		alert("Por favor, preencha todos os campos!");	
		return false;
	}	
}
</script>

<h2>Detalhe de termo de apostilamento</h2>

<?php 
//print_r($aditivodetail);
foreach ($termodetail as $termo):
	$IdTermo = $termo->Id;
	$ContratoId = $termo->ContratoId;
	$DenominacaoId = $termo->DenominacaoId;
	$Denominacao = utf8_encode($termo->Denominacao);
	$TipoId = $termo->TipoId;
	$Tipo = utf8_encode($termo->Tipo);
	$Sei = $termo->Sei;
	$Valor = number_format($termo->Valor, 2, ',', '.');
	$Percentual = $termo->Percentual;
	$Motivacao = $termo->Motivacao;
	$Observacoes = $termo->Observacoes;
endforeach;
?>

<div id="caixa7">
<div id="tabs">

<fieldset class='visible' style='width:933px'>
<div id="tabs-1">

<div class="row">
	<div class="label">Denomina&ccedil;&atilde;o</div>
	<div class="field">
		<select name="termodenominacaoid" style="width:220px;" required autofocus disabled>
			<option value=""></option>
			<?php foreach ($AuxTADenominacao as $term):
				if($DenominacaoId==$term->Id){?>
				<option value="<?php echo $term->Id?>" selected><?php echo utf8_encode($term->Descricao)?></option>
			<?php }else{?>
				<option value="<?php echo $term->Id?>"><?php echo utf8_encode($term->Descricao)?></option>
			<?php } endforeach;?>
		</select>
	</div>

	Tipo
	<div class="field">
		<select name="termotipoid" style="width:150px;" required disabled>
			<option value=""></option>
			<?php foreach ($AuxTATipo as $tip):
				if($TipoId==$tip->Id){?>
				<option value="<?php echo $tip->Id?>" selected><?php echo utf8_encode($tip->Descricao)?></option>
			<?php }else{?>
				<option value="<?php echo $tip->Id?>"><?php echo utf8_encode($tip->Descricao)?></option>
			<?php } endforeach;?>
		</select>
	</div>

	Proc. SEI
	<div class="field">
		<input type="text" name="prsei" id="prsei" maxlength="22" size="21" value="<?php echo $Sei?>" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)' required disabled/>
	</div>
</div>

<div class="row">
<div class="label">Valor</div>
<div class="field">
	<div class="field">
		<input type="text" name="termoval" id="termoval" value="<?php echo $Valor?>" size="12" onKeyPress="return MascaraMoeda(this,'.',',',event);" size="12" style="text-align:right;" required disabled/>
	</div>
	&nbsp;&nbsp;
	Percentual(%)
	<div class="field">
		<input type="text" name="termopercent" id="termopercent" maxlength="3" size="3" value="<?php echo $Percentual?>" onkeypress='return SomenteNumero(event)' required disabled/>
	</div>
</div>

<div class="row">
	<div class="label">Motiva&ccedil;&atilde;o</div>
	<div class="field">
		<textarea name="motiva" cols="94" rows="3" maxlength="200" style="text-transform:uppercase;" required disabled><?php echo $Motivacao?></textarea>
	</div>
</div>

<div class="row">
	<div class="label">Observa&ccedil;&atilde;o</div>
	<div class="field">
		<textarea name="termobs" cols="94" rows="3" maxlength="200" style="text-transform:uppercase;" required disabled><?php echo $Observacoes?></textarea>
	</div>
</div>

<hr>
<div class="row">
	<a href="<?php echo base_url()."caditivo/detailcontrato/".$ContratoId."#tabs-3";?>"><input type="button" value="Voltar" onclick="location.href('<?php echo base_url()."cjuridico/detailcontrato/".$ContratoId."#tabs-2";?>')" class="botao"></a>
	<a href="<?php echo base_url()."ctermoap/termoedit/".$ContratoId."/".$IdTermo."#tabs-3";?>"><input type="button" value="Alterar" onclick="location.href('<?php echo base_url()."ctermoap/termoedit/".$ContratoId."/".$IdTermo."#tabs-3";?>')" class="botao"></a>	
</div>
</div>
</fieldset>
</div>
</div>

<?php $this->load->view('view_rodape');?>