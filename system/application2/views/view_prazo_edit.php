<?php 
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' =>  'calendar'); ?>

<script language="JavaScript">

function validaprazo(){
	dtprazo = document.formprazo.dtprazo.value;
	descprazo = document.formprazo.descprazo.value;
	if ((dtprazo=="")||(descprazo=="")){
		alert("Por favor, preencha todos os campos obrigatórios!");	
		return false;
	}	
}

</script>

<?php 
//print_r($prazodetail);
if(!empty($prazodetail)&&(sizeof($prazodetail)>0)){
foreach ($prazodetail as $prz):
	$IdPrazo = $prz->Id;
	$IdAcao = $prz->AcaoId;
	$Descricao = $prz->Descricao;
	$DataPrazo = $prz->Data;
	$Observacoes = $prz->Observacoes;
	$Concluido = $prz->Concluido;
endforeach; ?>

<div id="caixa7">
<div id="tabs">

<h2>Alteração de aditivo</h2>

<fieldset class='visible' style='width:933px'>
<div id="tabs-1">
<form method="post" action="<?php echo base_url();?>cjuridico/saveprazo" name="formprazo" onsubmit="return validaprazo()">
<input type="hidden" name="idacao" id="idacao" size="16"  value="<?php echo $IdAcao;?>"/>
<input type="hidden" name="idprazo" id="idprazo" size="16"  value="<?php echo $IdPrazo;?>"/>

<div class="row">
	<div class="label">Data<font style="color:red; font-size:7;"> &#10054;</font></div>
	<div class="field">
		<div class="field">
		<input type="text" value="<?php echo date('d/m/Y',strtotime($DataPrazo));?>" name="dtprazo" id="dtprazo" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formprazo.dtprazo,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
			<a onclick="document.getElementById('dtprazo').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url();?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
		</div>				
	</div>
</div>

<div class="row">
	<div class="label">Descrição<font style="color:red; font-size:7;"> &#10054;</font></div>
	<div class="field">
		<input type="text" name="descprazo" id="descprazo" value="<?php echo $Descricao?>" maxlength="50" size="80" style="text-transform: uppercase;"/>
	</div>
</div>

<div class="row">
	<div class="label">Observação<font style="color:white; font-size:7;"> &#10054;</font></div>
	<div class="field">
		<input type="text" name="obsprazo" id="obsprazo" value="<?php echo $Observacoes?>" maxlength="50" size="80" style="text-transform: uppercase;"/>
	</div>
</div>

<div class="row">
	<div class="label"><span></span></div>
	<div class="field">
	<?php if($Concluido==0){?>
		<label> <input type="checkbox" name="prazoconcluido[]" value="1" id="prazoconcluido"/>Concluído</label>
	<?php }else if($Concluido==1){?>
		<label> <input type="checkbox" name="prazoconcluido[]" value="1" id="prazoconcluido" checked/>Concluído</label>
	<?php }?> 
	</div>
</div>
<font style="color:red; font-size:7;">&#10054; Campos obrigatórios</font>
<hr>
<?php if ($acessoNivel == 2) { ?>
<div class="row">
	<input type="submit" name="Gravar" value="Gravar" class="botao"/>	
	<a href="<?php echo base_url()."cjuridico/detailacaotrab/".$IdAcao."#tabs-6";?>"><input type="button" value="Cancelar" onclick="location.href('<?php echo base_url()."cjuridico/detailacao/".$IdAcao."#tabs-6";?>')" class="botao"></a>
<?php } ?>	
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