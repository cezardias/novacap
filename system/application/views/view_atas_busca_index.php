<?php 
$this->load->view('view_cabecalho');
$attributes = array('name' => 'calendar');?>

<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/3.3.7/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/jquery/3.2.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/js/3.3.7/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings.png"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings-white.png"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<br>
<div class="container" style="width:1018px;margin-left:-30px;">

<div class="row">
	<div class="well well-sm" style="width:960px;margin-left:15px;">
		<font size="5">ATAS - Pesquisa</font>
	</div>
</div>

<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel3']==1)){ // CONTRATOS E ATAS - ADMINISTRADOR?>
<div class="row">
    <a href="<?php echo base_url()."catas/ataadd/"?>" class="btn btn-success" style="margin-left:15px;">	
    	<span class="glyphicon glyphicon-plus-sign">
    		<i class="icon-print icon-white">Incluir ATA</i>
    	</span>
    </a>  
</div>
<?php } ?>

<form role="form" method="post" action="<?php echo base_url();?>catas/atabuscaresult" name="form">
<div class="row">
	<div class="col-xs-4">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Número da ATA</label>
		<input type="text" class="form-control" name="atanr" id="atanr" value="" style="text-transform:uppercase;" autofocus>					
	</div>
	<div class="col-xs-4">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Processo administrativo</label>
		<input type="text" class="form-control" name="pradm" id="pradm" value="" maxlength="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)'>					
	</div>		
	<div class="col-xs-4">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Processo SEI</label>
		<input type="text" class="form-control" name="prsei" id="prsei" value="" maxlength="22" size="23" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)'/>					
	</div>	
	<div class="col-xs-12">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Nome da empresa</label>
		<input type="text" class="form-control" name="nomempresa" id="nomempresa" value="" style="text-transform:uppercase;">					
	</div>	
	<div class="col-xs-4 selectContainer">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Modalidade</label>
		<select class="form-control" name="modalidadeid">
			<option value=""></option>
			<?php foreach ($auxlicitamod as $mod):?>
				<option value="<?php echo $mod->Id;?>"><?php echo utf8_encode($mod->Descricao)?></option>
			<?php endforeach;?>
		</select>
	</div>		
	<div class="col-xs-4">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Número da licitacao</label>
		<input type="text" class="form-control" name="licitanr" id="licitanr" value="" style="text-transform:uppercase;">					
	</div>		
	<div class="col-xs-4">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Diretoria</label>
		<select class="form-control" name="diretoriaid">
			<option value=""></option>
			<option value="DA">DIRETORIA ADMINISTRATIVA</option>
			<option value="DE">DIRETORIA DE EDIFICAÇÕES</option>
			<option value="DOE">DIRETORIA DE OBRAS ESPECIAIS</option>
			<option value="DU">DIRETORIA DE URBANIZAÇÃO</option>
		</select>
	</div>		
	<div class="col-xs-12">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Objeto</label>
		<input type="text" class="form-control" name="ataobjeto" id="ataobjeto" value="" style="text-transform:uppercase;">					
	</div>		
	
	<div class="col-md-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Assinatura início</label>
		<input type="date" class="form-control" name="assdataini" id="assdataini" value="" style="text-transform:uppercase;width:180px;">					
	</div>			
	<div class="col-md-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:-30px;">Assinatura fim</label>
		<input type="date" class="form-control" name="assdatafim" id="assdatafim" value="" style="text-transform:uppercase;width:180px;margin-left:-30px;">					
	</div>	
	<div class="col-md-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:20px;margin-left:70px;">Vigência início</label>
		<input type="date" class="form-control" name="vigdataini" id="vigdataini" value="" style="text-transform:uppercase;width:180px;margin-left:70px;">					
	</div>			
	<div class="col-md-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:38px;">Vigência fim</label>
		<input type="date" class="form-control" name="vigdatafim" id="vigdatafim" value="" style="text-transform:uppercase;width:180px;margin-left:38px;">
	</div>	
</div>
<br>
<input class="btn btn-primary btnpequenomin" type="submit" name="submit" value="Pesquisar &#128270;" style="margin-left:15px;">
<br><br>
</div>
</form>
<?php $this->load->view('view_rodape');?>