<?php
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' => 'calendar');
?>

<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/3.3.7/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/jquery/3.2.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/js/3.3.7/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings.png"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings-white.png"></script>

<br>
<form role="form" method="post" action="<?php echo base_url();?>ccontrato/contratobuscaresult" name="form">
<div class="container" style="width:1018px;margin-left:-30px;">

<div class="row">
	<div class="well well-sm" style="width:960px;margin-left:15px;">
		<font size="5">Contratos - Pesquisa</font>
	</div>
</div>

<div class="row">
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Contrato n&deg;</label>
		<input type="text" class="form-control" name="contratonr" id="contratonr" value="" style="text-transform:uppercase;" autofocus>
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Processo n&deg;</label>
		<input type="text" class="form-control" name="pradm" id="pradm" value="" style="text-transform:uppercase;">
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Processo SEI</label>
		<input type="text" class="form-control" name="prsei" id="prsei" value="" style="text-transform:uppercase;">
	</div>
	<div class="col-xs-3 selectContainer">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Situa&ccedil;&atilde;o</label>
		<select class="form-control" name="prazovigstatus">
			<option value="">TODOS</option>
			<option value="ATIVO">ATIVO</option>
			<option value="INATIVO">INATIVO</option>
		</select>
	</div>

	<div class="col-xs-12">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Empresa nome</label>
		<input type="text" class="form-control" name="empresanome" id="empresanome" value="" style="text-transform:uppercase;">
	</div>

	<div class="col-xs-2">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Licita&ccedil;&atilde;o n&deg;</label>
		<input type="text" class="form-control" name="licitanum" id="licitanum" value="" style="text-transform:uppercase;" autofocus>
	</div>
	<div class="col-xs-5 selectContainer">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Modalidade</label>
		<select class="form-control" name="modalidade">
			<option value=""></option>
			<?php foreach($auxlicitamod as $modal):?>
				<option value="<?php echo $modal->Id?>"><?php echo utf8_encode($modal->Descricao)?></option>
			<?php endforeach;?>
		</select>
	</div>
	<div class="col-xs-5 selectContainer">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Diretoria</label>
		<select class="form-control" name="diretoria">
			<option value=""></option>
			<option value="DA">DIRETORIA ADMINISTRATIVA</option>
			<option value="DE">DIRETORIA DE EDIFICAÇÕES</option>
			<option value="DOE">DIRETORIA DE OBRAS ESPECIAIS</option>
			<option value="DU">DIRETORIA DE URBANIZAÇÃO</option>
		</select>
	</div>

	<div class="col-xs-12">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Objeto</label>
		<textarea class="form-control" rows="3" name="objeto" id="objeto" value="" style="text-transform:uppercase;"></textarea>
	</div>
</div>
<br>
<input class="btn btn-primary btnpequenomin" type="submit" name="submit" value="Pesquisar&#128270;" style="margin-left:15px;">
<hr>
</div>
</form>
<?php $this->load->view('view_rodape');?>
