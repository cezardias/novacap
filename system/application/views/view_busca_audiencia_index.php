<?php 
$this->load->view('view_cabecalho');
$attributes = array('name' =>  'calendar'); ?>

<script type="text/javascript" src="<?php echo base_url();?>js/ajax.js"></script>
<script language='JavaScript'>
function validaudiencias(){
	DataIni = document.formaudiencias.AudienciaDataIni.value;
	DataFim = document.formaudiencias.AudienciaDataFim.value;
	if ((DataIni=="")&&(DataFim=="")){
		alert("Por favor, informe pelo menos a data inicial e final!");	
		return false;
	}	
	if ((DataIni!="")&&(DataFim=="")){
		alert("Por favor, informe a data inicial e final");	
		return false;
	}
	if ((DataIni=="")&&(DataFim!="")){
		alert("Por favor, informe a data inicial e final");	
		return false;
	}		
}

function excluiaudiencia(IdAcao,IdAudi,flagAudiFiltro){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>caudiencia/delete/"+IdAcao+"/"+IdAudi+"/"+flagAudiFiltro;
	} else {
		return false;
	}
}
</script>

<div id="caixa7">
<div id="tabs">
<div id="tabs-1">
<fieldset class=visible style='width:938px;margin-left:-3px; background-color: #87CEFA;'>
	<font size="5">Pesquisar audiências</font>
</fieldset>

<fieldset class='visible' style='width:938px;margin-left:-3px;'>
<form method="post" action="<?php echo base_url();?>cjuridico/buscaudienciaresult" name="formaudiencias" onsubmit="return validaudiencias()">

<table style="width:930px;">
      <tr style="width:100px;">
		<td height="30" style="text-align:right;">Período &nbsp;</td>
		<td> 
			<div class="row">
			<div class="field">
			<input type="text" value="" name="AudienciaDataIni" id="AudienciaDataIni" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
			<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formaudiencias.AudienciaDataIni,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
				<a onclick="document.getElementById('AudienciaDataIni').value='';" style="cursor:pointer; cursor:hand"><img src="../img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
			</div>
			</div>		
		</td>
		<td>a&nbsp;&nbsp;</td> 
		<td>
			<div class="row">
			<div class="field">
			<input type="text" value="" name="AudienciaDataFim" id="AudienciaDataFim" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
			<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formaudiencias.AudienciaDataFim,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
				<a onclick="document.getElementById('AudienciaDataFim').value='';" style="cursor:pointer; cursor:hand"><img src="../img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
			</div>
			</div>				
		</td>  
		<td style="width:100px;text-align:right;">Tipo de ação &nbsp;</td> 
     	<td>
     	<select name="tipoacaoid" id="tipoacaoid">
        <option value="">TODOS</option>
		<?php foreach ($acoestipo as $tipo): ?>
			<option value="<?php echo $tipo->Id;?>"><?php echo utf8_encode($tipo->Descricao)?></option>
		<?php endforeach;?>        
        </select>
        </td>
        <td style="text-align:right;">Tipo de audiência &nbsp;</td>		
      <td>
      <select name="tipoaudienciaid" id="tipoaudienciaid">
			<option value=""></option>
			<?php foreach ($tipoaudiencia as $aud):?>			
				<option value="<?php echo $aud->Id?>"><?php echo utf8_encode($aud->Descricao)?></option>
			<?php endforeach;?>
		</select>
       </td>		    
      </tr> 
      <tr>
      	<td height="30" style="text-align:right;">Advogado(a) &nbsp;</td>
      	<td colspan="3"> 
		<select name="advogadoid" id="advogadoid">
			<option value="">TODOS</option>
			<?php foreach ($advogados as $adv):?>
				<option value="<?php echo $adv->Id;?>"><?php echo utf8_encode($adv->Nome)?></option>
			<?php endforeach;?>
		</select>
		</td>      	
		<td style="text-align:right;">Vara &nbsp;</td>
		<td colspan="3"> 
		<select name="varaid" id="varaid">
			<option value="">TODOS</option>
			<?php foreach ($varas as $vra):?>
				<option value="<?php echo $vra->VaraId;?>"><?php echo utf8_encode($vra->Descricao)?></option>
			<?php endforeach;?>
		</select>      	
      	</td>
      </tr>
      <tr>
      	<td height="30" style="text-align:right;">Preposto &nbsp;</td>
      	<td colspan="7"><input type="text" name="preposto" id="preposto" value="" maxlength="30" size="35"/></td>
      </tr>
</table>
<div class="row">
	<input type="submit" name="submit" value="Pesquisar &#128270;" class="botao"/>	
</div>
</form>
</fieldset>
</div>
</div>
</div>
<?php $this->load->view('view_rodape');?>