<?php 
$this->load->view('view_cabecalho');
$attributes = array('name' =>  'calendar'); ?>

<script type="text/javascript" src="<?php echo base_url();?>js/ajax.js"></script>
<script language='JavaScript'>
function validaprazos(){
	prazoini = document.formprazos.prazoini.value;
	prazofim = document.formprazos.prazofim.value;
	// tipoacaoid = document.formprazos.tipoacaoid.value;
	// prazoconcluido = document.formprazos.prazoconcluido.value;
	// advogadoid = document.formprazos.advogadoid.value;
	// varaid = document.formprazos.varaid.value;

	if ((prazoini=="")&&(prazofim=="")){
		alert("Por favor, informe pelo menos a data inicial e final!");	
		return false;
	}	
	if ((prazoini!="")&&(prazofim=="")){
		alert("Por favor, informe a data inicial e final");	
		return false;
	}
	if ((prazoini=="")&&(prazofim!="")){
		alert("Por favor, informe a data inicial e final");	
		return false;
	}		
}
</script>

<div id="caixa7">
<div id="tabs">
<div id="tabs-1">
<fieldset class=visible style='width:938px;margin-left:-3px; background-color: #87CEFA;'>
	<font size="5">Pesquisar prazos</font>
</fieldset>

<fieldset class='visible' style='width:938px;margin-left:-3px;'>
<!-- <form method="post" action="<?php echo base_url();?>cjuridico/buscaprazosresult" name="formprazos" onsubmit="return validaprazos()"> -->
<form method="post" action="<?php echo base_url();?>cjuridico/buscaprazosresult" name="formprazos">
<table style="width:930px;">
      <tr style="width:100px;">
		<td height="30" style="text-align:right;">Período &nbsp;</td>
		<td>
			<div class="row">
			<div class="field">
				<input type="date" value="" name="prazoini" id="prazoini" size="11" required/>
				<!-- <input type="text" value="" name="prazoini" id="prazoini" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly required/>
				<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formprazos.prazoini,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
				<a onclick="document.getElementById('prazoini').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url()?>img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a> -->
			</div>
			</div>		
		</td>
		<td style="text-align:left; width:20px">a</td> 
		<td>
			<div class="row">
			<div class="field">
				<input type="date" value="" name="prazofim" id="prazofim" size="11" required/>
				<!-- <input type="text" value="" name="prazofim" id="prazofim" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly required/>
				<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formprazos.prazofim,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
				<a onclick="document.getElementById('prazofim').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url()?>img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a> -->
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
        <td style="text-align:center;">
			<input type="radio" name="prazoconcluido" value="1"/>Concluído&nbsp;&nbsp; 
			<input type="radio" name="prazoconcluido" value="0" checked/>Não concluído&nbsp;&nbsp;
			<input type="radio" name="prazoconcluido" value=""/>Todos        
		</td>				    
      </tr> 
      <tr>
      	<td height="30" style="text-align:right;">Advogado(a) &nbsp;</td>
      	<td colspan="3"> 
			<?php
			//$advogadonivel = 1;
			if(($advogadonivel == 2)||($advogadonivel == 3)){ ?>
				<select name="advogadoid" id="advogadoid">
					<option value="">TODOS</option>
					<?php foreach ($advogados as $adv):?>
						<option value="<?php echo $adv->Id;?>"><?php echo utf8_encode($adv->Nome)?></option>
					<?php endforeach;?>
				</select>				
			<?php }else{
			foreach ($advogadodetail as $adv):
				if($advogadoid==$adv->Id){ ?>
				<input type="hidden" value="<?php echo $adv->Id;?>" name="advogadoid" id="advogadoid" size="11"/>
				<input type="text" value="<?php echo $adv->Nome;?>" name="advogadonome" id="advogadonome" size="50" disabled/>
			<?php } endforeach;
			} ?>
		</td>      	
		<td style="text-align:right;">Vara &nbsp;</td>
		<td colspan="3"> 
			<select name="varaid" id="varaid">
				<option value="">TODOS</option>
				<?php
				if(($advogadonivel != 2)&&($advogadonivel != 3)){
				 foreach ($varaexclusiva as $vra):?>
					<option value="<?php echo $vra->VaraId;?>"><?php echo utf8_encode($vra->Descricao)?></option>
				<?php endforeach;
				}else{?>
				<?php foreach ($varas as $vrs):?>
					<option value="<?php echo $vrs->VaraId;?>"><?php echo utf8_encode($vrs->Descricao)?></option>
				<?php endforeach;?>				
			<?php }?>
			</select>
      	</td>
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