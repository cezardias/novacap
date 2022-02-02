<?php
$this->load->view('view_cabecalho');
$usuarionivel = $this->session->userdata('usuarionivel'); //5 geral, 8 - somente conulta.
//echo $usuarionivel = 5;
$attributes = array('name' => 'calendar');?>

<div id="caixa7">
<div id="tabs">

<h3>Pesquisar contratos</h3>

<?php if(!empty($situacaoctrs)&&(sizeof($situacaoctrs)>0)){ ?>
<div class="status_box warning">
	Existem <b><?php echo sizeof($situacaoctrs);?></b> contrato(s) com prazo de vig&ecirc;ncia vencido ou a menos de 40 dias do vencimento.
	<a href="<?php echo base_url();?>cjuridico/contratosituacao"><font color="blue">Visualizar</font></a>
</div>
<?php } else{?>
<div class="status_box warning">
	<h6>Aviso!</h6>
	&nbsp;&nbsp;
	Nenhum contrato pendente!
</div>
<?php }
if(($_SESSION['Admin']==1)||($_SESSION['Nivel3']==1)){ // CONTRATOS E ATAS - ADMINISTRADOR?>
<a href="<?php echo base_url();?>cjuridico/addcontrato">
	<img src="<?php echo base_url();?>img/icons/add.png" alt="editar"/> Adicionar contrato
</a>
<?php } ?>

<fieldset class='visible' style='width:933px'>
<form method="post" action="<?php echo base_url();?>cjuridico/buscacontratoresult" name="formbuscacontrato" onsubmit="return validacontrato()">

<div class="row">
	<div class="label">Contrato</div>
	<div class="field">
		<input type="text" name="contratonr" id="contratonr" size="15" value="" autofocus/>
	</div>
	&nbsp;
	Processo
	<div class="field">
		<input type="text" name="prnum" id="prnum" size="15" maxlength="16" value="" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)'/>
	</div>

	Proc. SEI
	<div class="field">
		<input type="text" name="prsei" id="prsei" maxlength="22" size="21" value="" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)'/>
	</div>

	&nbsp;
	Situa&ccedil;&atilde;o
	<div class="field">
		<select name="prazovigstatus" style="width:150px;">
			<option value="">TODOS</option>
			<option value="1">ATIVO</option>
			<option value="0">INATIVO</option>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Empresa nome</div>
	<div class="field">
		<input type="text" name="empresanome" id="empresanome" maxlength="100" size="80"  value="" style="text-transform: uppercase;"/>
	</div>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Ano
	<div class="field">
		<input type="text" name="anocontr" id="anocontr" maxlength="4" size="3" value=""/>
	</div>
</div>

<div class="row">
	<div class="label">Licita&ccedil;&atilde;o n&deg;</div>
	<div class="field">
		<input type="text" name="licitanum" id="licitanum" value="" size="14"/>
	</div>
	&nbsp;&nbsp;&nbsp;
	Modalidade
	<div class="field">
		<select name="modalidade" style="width:200px;">
			<option value=""></option>
			<?php foreach($auxlicitamod as $modal):?>
				<option value="<?php echo $modal->Id?>"><?php echo utf8_encode($modal->Descricao)?></option>
			<?php endforeach;?>
		</select>
	</div>
	&nbsp;&nbsp;&nbsp;
	Diretoria
	<div class="field">
		<select name="diretoria" style="width:293px;">
			<option value=""></option>
			<option value="DA">DIRETORIA ADMINISTRATIVA</option>
			<option value="DE">DIRETORIA DE EDIFICAÇÕES</option>
			<option value="DOE">DIRETORIA DE OBRAS ESPECIAIS</option>
			<option value="DU">DIRETORIA DE URBANIZAÇÃO</option>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Objeto</div>
	<div class="field">
		<textarea name="objeto" cols="107" rows="3" style="text-transform: uppercase;"></textarea>
	</div>
</div>
<hr>
<div class="row">
	<input type="submit" name="submit1" value="Pesquisar &#128270;" class="botao"/>
</div>
</form>
</fieldset>
</div>

<br>
</div>
</div>

<?php $this->load->view('view_rodape');?>
