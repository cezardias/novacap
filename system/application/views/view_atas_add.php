<?php 
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' =>  'calendar'); ?>

<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/3.3.7/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/jquery/3.2.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/js/3.3.7/bootstrap.min.js"></script>

<?php 
$Diretorias = array(
    array(
        'Sigla' => 'DA',
        'Descricao' => 'DIRETORIA ADMINISTRATIVA'
    ),
    array(
        'Sigla' => 'DE',
        'Descricao' => 'DIRETORIA DE EDIFICAÇÕES'
    ),
    array(
        'Sigla' => 'DOE',
        'Descricao' => 'DIRETORIA DE OBRAS ESPECIAIS'
    ),
    array(
        'Sigla' => 'DU',
        'Descricao' => 'DIRETORIA DE URBANIZAÇÃO'
    )
);?>
<br>
<div class="row">
	<div class="well well-sm" style="width:960px;">
		<font size="5">Alteração de ATA</font>
	</div>	
</div>

<div class="container" style="width:1018px;margin-left:-28px;">
<div class="row">
<form role="form" method="post" action="<?php echo base_url();?>catas/atacreate" name="form">
<input type="hidden" class="form-control" name="ataid" id="ataid" value="">

<div class="row">
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Número da ATA</label>
		<input type="text" class="form-control" name="atanr" id="atanr" value="" style="text-transform:uppercase;" autofocus required/>					
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Processo administrativo</label>
		<input type="text" class="form-control" name="pradm" id="pradm" value="" maxlength="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)'/>					
	</div>		
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Processo SEI</label>
		<input type="text" class="form-control" name="prsei" id="prsei" value="" maxlength="22" size="23" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)'/>					
	</div>	
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Número da licitacao</label>
		<input type="text" class="form-control" name="licitanr" id="licitanr" value="" style="text-transform:uppercase;"/>					
	</div>	
	
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Data assinatura</label>
		<input type="date" class="form-control" name="atadatassinatura" id="atadatassinatura" value="" required>
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Data vigência</label>
		<input type="date" class="form-control" name="atadatavigenciainicio" id="atadatavigenciainicio" value="" required>
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Prazo vigência</label>
		<input type="text" class="form-control" name="ataprazovigencia" id="ataprazovigencia" value="" maxlength="3" onkeypress='return SomenteNumero(event)' required/>					
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Tipo</label>		
		<select class="form-control" name="atatipoprazo" required>
			<option value=""></option>
			<option value="DIAS">DIAS</option>
			<option value="MESES">MESES</option>
		</select>					
	</div>	
	
	<div class="col-xs-8">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Modalidade</label>		
		<select class="form-control" name="licmodalidadeid" required>
			<option value=""></option>
			<?php foreach ($auxmodalidade as $mod):?>
				<option value="<?php echo $mod->Id?>"><?php echo utf8_encode($mod->Descricao)?></option>
			<?php endforeach;?>
		</select>					
	</div>		
	<div class="col-xs-4">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Diretoria</label>
		<select class="form-control" name="diretoria" required>
			<option value=""></option>
			<?php foreach ($Diretorias as $dirs):?>
				<option value="<?php echo $dirs['Sigla']?>"><?php echo $dirs['Descricao']?></option>
			<?php endforeach;?>
		</select>							
	</div>			
	<div class="col-xs-12">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Objeto</label>
		<textarea class="form-control" id="ataobjeto" name="ataobjeto" rows="3" style="text-transform:uppercase;"></textarea>							
	</div>
	<div class="col-xs-12">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Observações</label>
		<textarea class="form-control" name="ataobs" id="ataobs" rows="3" style="text-transform:uppercase;"></textarea>							
	</div>					
</div>
<hr/>	
<input class="btn btn-primary btnpequenomin" type="submit" name="submit" value="Salvar" style="margin-left:15px;">	
<a href="<?php echo base_url()."catas/atasindex/"?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">
	<button type="button" class="btn btn-danger btnpequenomin">Cancelar</button>
</a>		
</form>
</div>	
</div>
<hr>	
<br><br>
<?php $this->load->view('view_rodape');?>