<?php 
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' =>  'calendar'); ?>

<div id="caixa7">
<div id="tabs">
<div id="tabs-1">

<fieldset class='visible' style='width:933px'>
<?php
$idprexiste;
$tipoprexiste;
if($tipoprexiste==2){ //C�VEL ?>
	<div class="status_box warning">
		<h6>Aviso!</h6>
		&nbsp;&nbsp;&nbsp;
		Processo c�vel j� cadastrado. Deseja visualiz�-lo?
		&nbsp;&nbsp;&nbsp;
		<a href="<?php echo base_url()?>cacaocivel/detailacaocivel/<?php echo $idprexiste?>"><font color="blue">Sim</font></a>
		&nbsp;&nbsp;&nbsp;
		<a href="<?php echo base_url()?>cacaocivel/addacaocivel/"><font color="blue">N�o</font></a>
	</div>
<?php }else{ //TRABALHISTA ?>
	<div class="status_box warning">
		<h6>Aviso!</h6>
		&nbsp;&nbsp;&nbsp;
		Processo trabalhista j� cadastrado. Deseja visualiz�-lo?
		&nbsp;&nbsp;&nbsp;
		<a href="<?php echo base_url()?>cjuridico/detailacaotrab/<?php echo $idprexiste?>"><font color="blue">Sim</font></a>
		&nbsp;&nbsp;&nbsp;
		<a href="<?php echo base_url()?>cjuridico/addacaotrab/"><font color="blue">N�o</font></a>
	</div>
<?php } ?>
</fieldset>
</div>
</div>
</div>

<?php $this->load->view('view_rodape');?>