<?php 
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' =>  'calendar'); ?>

<script language="JavaScript">
function validaudiencia(){
	AudienciaData = document.formaudiencia.AudienciaData.value;
	AudienciaHora = document.formaudiencia.AudienciaHora.value;
	AudienciaMin = document.formaudiencia.AudienciaMin.value;		
	audienciatipo = document.formaudiencia.audienciatipo.value;
	audobs = document.formaudiencia.audobs.value;
	if ((AudienciaData=="")||(AudienciaHora=="")||(AudienciaMin=="")||(audienciatipo=="")){
		alert("Por favor, preencha todos os campos!");	
		return false;
	}	
}
</script>
<?php 
foreach ($audienciadetail as $aud):
	$IdRegAud = $aud->Id;
	$IdAcao = $aud->AcaoId;
	$AudienciaDataHora = $aud->AudienciaDataHora;
	$AudienciaTipo = $aud->AudienciaTipoId;
	$AudienciaPreposto = $aud->AudienciaPreposto;
	$Observacao = $aud->Observacao;
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

<h3>Alterar audiência</h3>
<form method="post" action="<?php echo base_url();?>cjuridico/saveaudiencia" name="formaudiencia" onsubmit="return validaudiencia()">
<input type="hidden" name="idacao" id="idacao" size="16"  value="<?php echo $IdAcao;?>"/>
<input type="hidden" name="idregaud" id="idregaud" size="16"  value="<?php echo $IdRegAud;?>"/>

<div class="row">
<div class="label">Audiencia data</div>
<div class="field">
<input type="text" value="<?php echo date('d/m/Y',strtotime($AudienciaDataHora));?>" name="AudienciaData" id="AudienciaData" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formaudiencia.AudienciaData,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
	<a onclick="document.getElementById('AudienciaData').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url()?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
</div>
</div>

<div class="row">
	<div class="label">Audiencia hora</div>
	<div class="field">
		<select name="AudienciaHora">
			<option value="<?php echo date('H',strtotime($AudienciaDataHora));?>"><?php echo date('H',strtotime($AudienciaDataHora));?></option>
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
		<select name="AudienciaMin">
			<option value="<?php echo date('i',strtotime($AudienciaDataHora));?>"><?php echo date('i',strtotime($AudienciaDataHora));?></option>
			<?php for($i=0;$i<60;$i++){?>
				<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
			<?php } ?>	
		</select>	
	</div>
</div>

<div class="row">
	<div class="label">Audiencia tipo</div>
	<div class="field">
		<select name="audienciatipo">
			<option value=""></option>
			<?php foreach ($tipoaudiencia as $tpaud):
				if($AudienciaTipo == $tpaud->Id){ ?>
					<option value="<?php echo $tpaud->Id?>" selected><?php echo $tpaud->Descricao?></option>
			<?php }else{ ?>
				<option value="<?php echo $tpaud->Id?>"><?php echo $tpaud->Descricao?></option>
			<?php } endforeach;?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Preposto</div>
	<div class="field">
		<input type="text" name="preposto" id="preposto" value="<?php echo $AudienciaPreposto;?>" maxlength="30" size="30" style="text-transform:uppercase;"/>
	</div>
</div>

<div class="row">
	<div class="label">Observações</div>
	<div class="field">
		<textarea name="audobs" id="audobs" rows="2" cols="80" maxlength="100" style="text-transform: uppercase;"><?php echo $Observacao;?></textarea>
	</div>
</div>
<hr>

<input type="submit" value="Salvar" class="botao"/>
<a href="<?php echo base_url()."cjuridico/detailacaotrap/".$IdAcao;?>"><input type="button" value="Cancelar" onclick="location.href('<?php echo base_url()."cjuridico/detailacao/".$IdAcao;?>')" class="botao"></a>

</form>
</fieldset>

</fieldset>
</div>
</div>
</div>

<?php $this->load->view('view_rodape');?>