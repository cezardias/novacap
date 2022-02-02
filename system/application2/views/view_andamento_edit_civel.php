<?php 
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' =>  'calendar'); ?>

<script language="JavaScript">
function validandamento(){
	dtandamento = document.formandamento.dtandamento.value;
	andamentoid = document.formandamento.andamentoid.value;
	if ((dtandamento=="")||(andamentoid=="")){
		alert("Por favor, preencha todos os campos!");	
		return false;
	}	
}
</script>

<?php 
//print_r($andamentodetail);
foreach ($andamentodetail as $and):
	$IdRegAnd = $and->Id;
	$DataAndamento = $and->Data;
	$AuxAndamentoId = $and->AuxAndamentoId;
	$IdAcao = $and->AcoesId;
	$ObsAndamento = $and->Observacao;
endforeach; ?>

<div id="caixa7">
<div id="tabs">
<ul>
	<li><a href="#tabs-4">Audiência</a></li>
</ul>
<fieldset class='visible' style='width:933px'>

<!-- quarta aba -->
<div id="tabs-4">
<fieldset class='visible' style='width:875px'>

<h3>Alterar andamento</h3>
<form method="post" action="<?php echo base_url();?>cacaocivel/saveandamentocivel" name="formandamento" onsubmit="return validandamento()">
<input type="hidden" name="idacao" id="idacao" size="16"  value="<?php echo $IdAcao?>"/>
<input type="hidden" name="idregand" id="idregand" size="16"  value="<?php echo $IdRegAnd?>"/>
<input type="hidden" name="tipoacao" id="tipoacao" size="16"  value="1"/>

<!-- 
<div class="row">
<div class="label">Audiencia data</div>
<div class="field">
<input type="text" value="<?php echo date('d/m/Y',strtotime($DataAndamento));?>" name="dtandamento" id="dtandamento" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formandamento.dtandamento,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
	<a onclick="document.getElementById('dtandamento').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url()?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
</div>
</div>
-->

<div class="row">
<div class="label">Data-hora</div>
<div class="field">
<input type="text" value="<?php echo date('d/m/Y',strtotime($DataAndamento));?>" name="dtandamento" id="dtandamento" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formandamento.dtandamento,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
	<a onclick="document.getElementById('dtandamento').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url()?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
</div>
</div>

<div class="row">
	<div class="label">Audiencia hora</div>
	<div class="field">
		<select name="andamentohora">
			<option value="<?php echo date('H',strtotime($DataAndamento));?>"><?php echo date('H',strtotime($DataAndamento));?></option>
			<option value="06">06</option>
			<option value="07">07</option>
			<option value="08">08</option>
			<option value="09">09</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
		</select>:
		<select name="andamentomin">
			<option value="<?php echo date('i',strtotime($DataAndamento));?>"><?php echo date('i',strtotime($DataAndamento));?></option>
			<?php for($i=0;$i<60;$i++){?>
				<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
			<?php } ?>	
		</select>	
	</div>
</div>

<div class="row">
	<div class="label">Audiencia tipo</div>
	<div class="field">
		<select name="andamentoid">
			<option value=""></option>
			<?php foreach ($auxandamentos as $andid):
				if($AuxAndamentoId == $andid->Id){ ?>
					<option value="<?php echo $andid->Id?>" selected><?php echo $andid->Descricao?></option>
			<?php }else{ ?>
				<option value="<?php echo $andid->Id?>"><?php echo $andid->Descricao?></option>
			<?php } endforeach;?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Observações</div>
	<div class="field">
		<textarea name="obsandamento" rows="4" cols="100" maxlength="300" style="text-transform: uppercase;"><?php echo $ObsAndamento?></textarea>
	</div>
</div>
<hr>
<?php
//btnvoltar => buscacaocivelresult
//btnvoltar => acaocivilcreate
$btnvoltar = $this->session->userdata('btnvoltar');
if ($acessoNivel == 2) { 
if($btnvoltar=='buscaudienciaresult'){ ?>
	<input type="hidden" name="flag" id="flag" value="EditVoltaBuscaAudi" size="5"/> <!-- flag NÃO preenchido -->
	<input type="submit" value="Salvar alteração" class="botao"/>
	<a href="<?php echo base_url()."cjuridico/buscaudienciaresult";?>"><input type="button" value="Cancelar" onclick="location.href('<?php echo base_url()."cjuridico/buscaudienciaresult/";?>')" class="botao"></a>
<?php } else{ ?>
	<input type="hidden" name="flag" id="flag" value="VoltaAcaoDetail" size="5"/> <!-- flag NÃO preenchido -->
	<input type="submit" value="Salvar alteração" class="botao"/>
	<a href="<?php echo base_url()."cjuridico/detailacaotrab/".$IdAcao;?>"><input type="button" value="Cancelar" onclick="location.href('<?php echo base_url()."cjuridico/detailacao/".$IdAcao;?>')" class="botao"></a>
<?php } } ?>
</form>
</fieldset>

</fieldset>
</div>
</div>
</div>

<?php $this->load->view('view_rodape');?>