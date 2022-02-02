<?php
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' =>  'calendar');
$contrato = '123/'.date('Y');?>

<script language="JavaScript">
function validacontrato(){
	contr = document.formcontrato.contratonr.value;
	if (contr.length < 8){
		alert("Preencha o contrato no seguinte formado 123/2020.");
		return false;
	}
}

function mascara(t, mask){
	var i = t.value.length;
	var saida = mask.substring(1,0);
	var texto = mask.substring(i)
	if (texto.substring(0,1) != saida){
		t.value += texto.substring(0,1);
	}
 }
</script>

<h2>Inclus&atilde;o de contrato</h2>

<div id="caixa7">
<div id="tabs">

<fieldset class='visible' style='width:933px'>
<div id="tabs-1">
<form method="post" action="<?php echo base_url();?>cjuridico/createcontrato" name="formcontrato" onsubmit="return validacontrato()">

<div class="row">
	<div class="label">Processo n&deg;</div>
	<div class="field">
		<input type="text" name="processonr" id="processonr" value="" size="15" maxlength="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)' autofocus required/>
	</div>

	Proc. SEI
	<div class="field">
		<input type="text" name="prsei" id="prsei" maxlength="22" size="20" value="" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)' required/>
	</div>

	Licita&ccedil;&atilde;o n&deg;
	<div class="field">
		<input type="text" name="licitanr" id="licitanr" value="" size="8" maxlength="10" required/>
	</div>

	Modalid.
	<div class="field">
		<select name="licitacaomodalidade" style="width:200px;" required>
			<option value=""></option>
			<?php foreach ($contratomodalide as $mod):?>
				<option value="<?php echo $mod->Id?>"><?php echo utf8_encode($mod->Descricao)?></option>
			<?php endforeach; ?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Empresa</div>
	<div class="field">
		<textarea name="empresa" id="empresa" cols="70" rows="1" required onkeypress="return false;"></textarea>
		<input type="hidden" name="empresaid" value="" size="16" id="empresaid" required/>
		<a onclick="javascript:window.open('<?php echo base_url()?>buscaempresa', 'popup_id', 'scrollbars,resizable,width=750,height=550');"
		style="cursor:pointer; cursor:hand"><img src="<?php echo base_url()?>img/famfamfam/icons/application_form_magnify.png" border="0" 
		title="Procurar empresa" width="22"></a>
		<a onclick="document.getElementById('empresa').value='';document.getElementById('empresaid').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url()?>img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo empresa" width="22"></a>
	</div>
</div>

<div class="row">
	<div class="label">Contrato</div>
	<div class="field">
		<input type="text" name="contratonr" id="contratonr" maxlength="8" value="" onkeypress="mascara(this, '###/####'); return SomenteNumero(event);" size="10" placeholder="<?php echo $contrato?>" required/>
	</div><font style="color:red; font-size:7;"> &#10054;</font>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Valor
	<div class="field">
		<input type="text" name="contratovalor" id="contratovalor" value="" size="12" onKeyPress="return MascaraMoeda(this,'.',',',event);" size="12" style="text-align:right;" required/>
	</div><font style="color:red; font-size:7;"> &#10054;</font>
	&nbsp;&nbsp;&nbsp;
	Status
	<div class="field">
		<select name="status" required>
			<option value=""></option>
			<option value="1" selected>ATIVO</option>
			<option value="0">INATIVO</option>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Diretoria</div>
	<div class="field">
		<select name="diretoria" required>
			<option value=""></option>
			<option value="DA">DIRETORIA ADMINISTRATIVA</option>
			<option value="DE">DIRETORIA DE EDIFICAÇÕES</option>
			<option value="DOE">DIRETORIA DE OBRAS ESPECIAIS</option>
			<option value="DU">DIRETORIA DE URBANIZAÇÃO</option>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Vigência</div>
	<fieldset class='visible' style='width:750px'>
	In&iacute;cio
	<div class="field">
		<div class="field">
		<input type="text" value="" name="prazodevigenciainicio" id="prazodevigenciainicio" size="11" maxlength="10" onkeyup="Formatadata(this,event)" onkeypress="return false;" required/>
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formcontrato.prazodevigenciainicio,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
			<a onclick="document.getElementById('prazodevigenciainicio').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url();?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
		</div><font style="color:red; font-size:7;"> &#10054;</font>
		&nbsp;
		Prazo
		<div class="field">
			<input type="text" name="prazodevigencia" id="prazodevigencia" value="" size="4" onkeypress='return SomenteNumero(event)' required/>
		</div>
		<div class="field">
			<select name="prazodevigenciatipo" required>
				<option value="DIAS" selected>DIAS</option>
				<option value="MESES">MESES</option>
			</select><font style="color:red; font-size:7;"> &#10054;</font>
		</div>
	</div>
	</fieldset>
</div>

<div class="row">
	<div class="label">Objeto</div>
	<div class="field">
		<textarea name="contratoobjeto" cols="105" rows="3" maxlength="1000" style="text-transform:uppercase;" required></textarea>
	</div>
</div>

<div class="row">
	<div class="label">Observações</div>
	<div class="field">
		<textarea name="observacoes" cols="105" rows="8" maxlength="200" style="text-transform:uppercase;"></textarea>
	</div>
</div>
<hr>
<?php if ($acessoNivel == 2) { ?>
<div class="row">
	<input type="submit" value="Gravar" class="botao"/><?php } ?>
	<a href="<?php echo base_url()."cjuridico/buscacontratoindex/";?>" style="text-decoration:none;">
		<input type="button" value="Cancelar" onclick="location.href('<?php echo base_url()."cjuridico/buscacontratoindex/";?>')" class="botao">
	</a>
</div>
</form>
</fieldset>
</div>
</div>
</div>
<?php $this->load->view('view_rodape');?>
