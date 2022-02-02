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

function validatermo(){
	termotipoid = document.formtermoap.termotipoid.value;
	termoval = document.formtermoap.termoval.value;
	termopercent = document.formtermoap.termopercent.value;
	if (termotipoid==4){ //ADMINISTRATIVO, 4 NO BANCO.
		if((termoval=="0,00")||(termopercent=="0.00")){
			alert("Por favor, informe o valor e percentual!");
			return false;
		}
	}
}
</script>

<h2>Altera&ccedil;&atilde;o de termo de apostilamento</h2>

<?php 
//print_r($aditivodetail);
foreach ($termodetail as $termo):
	$IdTermo = $termo->Id;
	$IdContrato = $termo->ContratoId;
	$DenominacaoId = $termo->DenominacaoId;
	$Denominacao = utf8_encode($termo->Denominacao);
	$TipoId = $termo->TipoId;
	$Tipo = utf8_encode($termo->Tipo);
	$Sei = preg_replace("/[^0-9]/", "", $termo->Sei);
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
<form method="post" action="<?php echo base_url();?>ctermoap/savetermoap" name="formtermoap" onsubmit="return validatermo()">
	<input type="hidden" name="contratoid" id="contratoid" size="14"  value="<?php echo $IdContrato;?>"/>
	<input type="hidden" name="termoid" id="termoid" size="14"  value="<?php echo $IdTermo;?>"/>
	<div class="row">
		<div class="label">Denomina&ccedil;&atilde;o</div>
		<div class="field">
			<select name="termodenominacaoid" style="width:220px;" required autofocus>
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
			<select name="termotipoid" style="width:150px;" required>
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
			<input type="text" name="prsei" id="prsei" maxlength="19" size="20" value="<?php echo $Sei?>" onkeypress='return SomenteNumero(event)' required/>
		</div>
	</div>

	<div class="row">
	<div class="label">Valor</div>
	<div class="field">
		<div class="field">
			<input type="text" name="termoval" id="termoval" value="<?php echo $Valor?>" size="12" onKeyPress="return MascaraMoeda(this,'.',',',event);" size="12" style="text-align:right;"/>
		</div>
		&nbsp;&nbsp;
		Percentual(%)
		<div class="field">
			<input type="text" name="termopercent" id="termopercent" maxlength="3" size="3" value="<?php echo $Percentual?>" onkeypress='return SomenteNumero(event)'/>
		</div>
	</div>

	<div class="row">
		<div class="label">Motiva&ccedil;&atilde;o</div>
		<div class="field">
			<textarea name="motiva" cols="94" rows="3" maxlength="200" style="text-transform:uppercase;" required><?php echo $Motivacao?></textarea>
		</div>
	</div>

	<div class="row">
		<div class="label">Observa&ccedil;&atilde;o</div>
		<div class="field">
			<textarea name="termobs" cols="94" rows="3" maxlength="200" style="text-transform:uppercase;"><?php echo $Observacoes?></textarea>
		</div>
	</div>

	<hr>
	<div class="row">
		<input type="submit" value="Salvar" class="botao"/>
		<a href="<?php echo base_url()."ctermoap/detailtermoap/".$IdContrato."/".$IdTermo."#tabs-3";?>"><input type="button" value="Cancelar" onclick="location.href('<?php echo base_url()."ctermoap/detailtermoap/".$IdContrato."/".$IdTermo."#tabs-3";?>')" class="botao"></a>	
	</div>
</form>
</div>
</fieldset>
</div>
</div>
<?php $this->load->view('view_rodape');?>