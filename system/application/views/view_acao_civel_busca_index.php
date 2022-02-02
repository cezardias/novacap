<?php 
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' => 'calendar');
?>

<div id="caixa7">
<div id="tabs">
<fieldset class=visible style='width:938px;margin-left:-3px;background-color: #87CEFA;'>
	<font size="5">Pesquisar ações cíveis</font>
</fieldset>

<fieldset class='visible' style='width:938px;margin-left:-3px;'>
<form method="post" action="<?php echo base_url();?>cacaocivel/buscacaocivelresult" name="formbuscacaocivel" onsubmit="return validabuscacaocivel()">

<input type="hidden" name="pradm" id="pradm" value="1" size="5"/> <!-- 1, trabalhista -->
<div class="row">
	<div class="label">Interessado</div>
		<div class="field">
			<input type="text" name="Interesadonome" id="Interesadonome" maxlength="80" size="70"  value="" style="text-transform: uppercase;" autofocus/>
		</div
	</div>
	&nbsp;
	CPF/CNPJ:
	<div class="field">
		<input type="text" name="cpfcnpj" id="cpfcnpj" maxlength="14" size="14"  value="" onkeypress='return SomenteNumero(event)'/> 
	</div>	
</div>

<div class="row">
	<div class="label">Processo judicial</div> <!-- PROCESSO JUDICIAL ANTIGO -->
	<div class="field">
		<input type="text" name="prjudnum" id="prjudnum" maxlength="25" size="24"  value=""/>
	</div>
	&nbsp;
	CNJ
	<div class="field"> <!-- PROCESSO JUDICIAL, NAO ANTIGO -->
		<input type="text" name="prcnj" id="prcnj" maxlength="25" size="24"  value="" onkeypress='MaskPrJud(this, event); return SomenteNumero(event)'/> 
	</div>			
</div>

<div class="row">
	<div class="label">Processo administ.</div> <!-- PROCESSO JUDICIAL ANTIGO -->
	<div class="field">
		<input type="text" name="pradm" id="pradm" size="15" maxlength="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)'/> 
	</div>	
	&nbsp;
	Processo SEI
	<div class="field">
		<input type="text" name="prsei" id="prsei" maxlength="22" size="23" value="" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)'/>	 
	</div>		
</div>

<div class="row">
	<div class="label">Assunto</div>
	<div class="field">
		<select name="assuntoid">
			<option value=""></option>
			<?php foreach ($assuntos as $ass):?>
			<option value="<?php echo $ass->Id;?>"><?php echo utf8_encode($ass->Descricao)?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>

<?php 
//SE FOR LOGIN DE UM ADVOGADO, O CAMPO ADVOGADO NAO PODERÁ SER ALTERADO.
//$usuarioAut = $this->session->userdata('usuario');
//if(sizeof($advlogado)<1){ ?>
<div class="row">
	<div class="label">Advogado</div>
	<div class="field">
		<select name="advogadoid">
			<option value=""></option>
			<?php foreach ($advogados as $adv):?>
			<option value="<?php echo $adv->Id;?>"><?php echo utf8_encode($adv->Nome)?></option>
			<?php endforeach;?>
		</select>
	</div>
	&nbsp;&nbsp;
	Vara
	<div class="field">
		<select name="varaid">
			<option value=""></option>
			<?php foreach ($varas as $vrs):?>
			<option value="<?php echo $vrs->VaraId;?>"><?php echo utf8_encode($vrs->Descricao)?></option>
			<?php endforeach;?>
		</select>
	</div>	
</div>

<div class="row">
	<div class="label">Data de ajuizamento</div>
	<div class="field">
		<input type="text" value="" name="dtajuizamentoini" id="dtajuizamentoini" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formbuscacaocivel.dtajuizamentoini,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
		<a onclick="document.getElementById('dtajuizamentoini').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url()?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
	</div>	
	&nbsp;a&nbsp; 
	<div class="field">
		<input type="text" value="" name="dtajuizamentofim" id="dtajuizamentofim" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formbuscacaocivel.dtajuizamentofim,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
		<a onclick="document.getElementById('dtajuizamentofim').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url()?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
	</div>	
	&nbsp;&nbsp;&nbsp;&nbsp;
	Data de extinção
	<div class="field">
		<input type="text" value="" name="dtextincaoini" id="dtextincaoini" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formbuscacaocivel.dtextincaoini,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
		<a onclick="document.getElementById('dtextincaoini').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url()?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
	</div>	
	&nbsp;a&nbsp; 
	<div class="field">
		<input type="text" value="" name="dtextincaofim" id="dtextincaofim" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formbuscacaocivel.dtextincaofim,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
		<a onclick="document.getElementById('dtextincaofim').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url()?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
	</div>		
</div>

<div class="row">
	<div class="label">Observações</div>
	<div class="field">
		<input type="text" name="obsbusca" id="obsbusca" size="80" maxlength="70" value="" style="text-transform: uppercase;"/>
	</div>
</div>

<div class="row">
	<div class="label">Status do processo</div>
	<div class="field">
		<select name="statusprocessoid">
			<option value=""></option>
			<option value="1">Ativo</option>
			<option value="0">Inativo</option>
		</select>
	</div>
	&nbsp;&nbsp;
	Andamento
	<div class="field">
		<select name="andamentoid">
			<option value=""></option>
			<?php foreach ($auxandamentos as $ands):?>
			<option value="<?php echo $ands->Id;?>"><?php echo utf8_encode($ands->Descricao)?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Data de inclusão</div>
	<div class="field">
		<input type="text" value="" name="dtinclusaoini" id="dtinclusaoini" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formbuscacaocivel.dtinclusaoini,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
		<a onclick="document.getElementById('dtinclusaoini').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url()?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
	</div>	
	&nbsp;a&nbsp; 
	<div class="field">
		<input type="text" value="" name="dtinclusaofim" id="dtinclusaofim" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formbuscacaocivel.dtinclusaofim,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
		<a onclick="document.getElementById('dtinclusaofim').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url()?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
	</div>		
	&nbsp;&nbsp;
	<div class="field">
	Posição da Novacap no processo
		<input type="radio" name="posicaonovacap" value="1"/>Autora 
		<input type="radio" name="posicaonovacap" value="2"/>RÉ
	</div>	
</div>
<br>
<hr>
<?php if ($acessoNivel == 2) { ?>
<div class="row">
	<input type="submit" name="submit" value="Pesquisar &#128270;" class="botao"/>&nbsp;<?php } ?>
</div>
</form>
</fieldset>
</div>
</div>
</div>
<?php $this->load->view('view_rodape');?>