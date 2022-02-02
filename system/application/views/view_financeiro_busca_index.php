<?php 
$this->load->view('view_cabecalho');
$attributes = array('name' => 'calendar');?>

<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/3.3.7/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/jquery/3.2.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/js/3.3.7/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings.png"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings-white.png"></script>

<br>
<form role="form" method="post" action="<?php echo base_url();?>cfinanceiro/buscafinanceiroresult" name="formpgtoacao">
<div class="container" style="width:1018px;margin-left:-30px;">

<div class="row">
	<div class="well well-sm" style="width:960px;margin-left:15px;">
		<font size="5">Financeiro - Pesquisa</font>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Nome</label>
		<input type="text" class="form-control" name="nome" id="nome" value="" style="text-transform:uppercase;" autofocus>					
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">CPF/CNPJ</label>
		<input type="text" class="form-control" name="cpfcnpj" id="cpfcnpj" value="" maxlength="14" onkeypress='return SomenteNumero(event)'>					
	</div>
	
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Processo judicial</label>
		<input type="text" class="form-control" name="prjud" id="prjud" value="" maxlength="25" onkeypress='MaskPrJud(this, event); return SomenteNumero(event)'>					
	</div>	
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Processo administrativo</label>
		<input type="text" class="form-control" name="pradm" id="pradm" value="" maxlength="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)'>					
	</div>	
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Processo SEI</label>
		<input type="text" class="form-control" name="prsei" id="prsei" value="" maxlength="22" size="23" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)'/>					
	</div>		
	
	<div class="col-xs-3 selectContainer">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Advogado</label>
		<select class="form-control" name="advogadoid">
			<option value=""></option>
			<?php foreach ($advogados as $adv):?>
				<option value="<?php echo $adv->Id;?>"><?php echo utf8_encode($adv->Nome)?></option>
			<?php endforeach;?>
		</select>
	</div>		
	<div class="col-xs-9 selectContainer">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Assunto</label>
		<select class="form-control" name="assuntoid">
			<option value=""></option>
			<?php foreach ($assuntos as $ass):?>
				<option value="<?php echo $ass->Id;?>"><?php echo utf8_encode($ass->Descricao)?></option>
			<?php endforeach;?>
		</select>
	</div>			
</div>
<br>
<input class="btn btn-primary btnpequenomin" type="submit" name="submit" value="Pesquisar &#128270;" style="margin-left:15px;">
<button type="button" class="btn btn-primary btnpequenomin">
	<a href="<?php echo base_url()."cfinanceiro/relatoriosindex/"?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">Relatórios &#128424;</a>	
</button>
<hr>
</div>
</form>
<?php $this->load->view('view_rodape');?>