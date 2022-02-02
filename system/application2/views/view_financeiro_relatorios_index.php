<?php
$this->load->view('view_cabecalho');
$attributes = array('name' => 'calendar');

$ProbPerda = array( //Manter probabilidade de perdas padrão.
    array(
        'Id' => 1,
        'Descricao' => utf8_decode('PROVÁVEL')
    ),
    array(
        'Id' => 2,
        'Descricao' => utf8_decode('POSSÍVEL')
    ),
        array(
        'Id' => 3,
        'Descricao' => 'REMOTA'
    )
);
//print_r($ProbPerda);

$AcaoId = $this->uri->segment(3);?>

<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/3.3.7/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/jquery/3.2.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/js/3.3.7/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings.png"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings-white.png"></script>

<br>
<form role="form" method="post" action="<?php echo base_url();?>cfinanceiro/financeiroRelatorios" name="form">
<div class="container" style="width:1018px;margin-left:-30px;">

<div class="row">
	<div class="well well-sm" style="width:960px;margin-left:15px;">
		<font size="5">Financeiro - Pesquisa Relatórios</font>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Interessado</label>
		<input type="text" class="form-control" name="interessado" id="interessado" value="" style="text-transform:uppercase;" autofocus>
	</div>
	<div class="col-xs-4">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">CPF/CNPJ</label>
		<input type="text" class="form-control" name="cpfcnpj" id="cpfcnpj" value="" maxlength="14" onkeypress='return SomenteNumero(event)'>
	</div>
	<div class="col-xs-4 selectContainer">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Probabilidade de perda</label>
		<select class="form-control" name="probperdaid">
			<option value=""></option>
			<?php foreach ($ProbPerda as $prob):?>
				<option value="<?php echo $prob['Id'];?>"><?php echo utf8_encode($prob['Descricao'])?></option>
			<?php endforeach;?>
		</select>
	</div>
	<div class="col-xs-4 selectContainer">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Tipo de a&ccedil;&atilde;o</label>
		<select class="form-control" name="acaotipoid" required>
			<?php foreach ($acoestipo as $act):
				if($act->Id==1){?>
				<option value="<?php echo $act->Id?>" select><?php echo utf8_encode($act->Descricao)?></option>
			<?php }else{?>
				<option value="<?php echo $act->Id?>"><?php echo utf8_encode($act->Descricao)?></option>
			<?php } endforeach;?>
		</select>
	</div>
	<div class="col-xs-2">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Valor in&iacute;cio</label>
		<input type="text" class="form-control" name="valorini" id="valorini" value="" maxlength="25" onKeyPress="return MascaraMoeda(this,'.',',',event);">
	</div>
	<div class="col-xs-2">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Valor final</label>
		<input type="text" class="form-control" name="valorfim" id="valorfim" value="" maxlength="25" onKeyPress="return MascaraMoeda(this,'.',',',event);">
	</div>
	<div class="col-xs-8 selectContainer">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Assunto</label>
		<select class="form-control" name="assuntoid">
			<option value=""></option>
			<?php foreach ($assuntos as $ass):?>
				<option value="<?php echo $ass->Id;?>"><?php echo utf8_encode($ass->Descricao)?></option>
			<?php endforeach;?>
		</select>
	</div>
	<div class="col-sm-4">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Situação</label>
		<select class="form-control" name="situacao">
			<option value="1">Ativa</option>
			<option value="0">Inativa</option>
			<option value="null">Ambos</option>			
		</select>
	</div>
	<div class="col-sm-4">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Conta</label>
		<select class="form-control" name="conta">
			<option value="">Selecione uma conta</option>
			<?php foreach($contas as $cts){?>
				<option value="<?php echo $cts->ContaId?>"><?php echo utf8_encode($cts->Combobox)?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Data de Corte</label>
		<input type="date" class="form-control" name="datacorte" id="datacorte" value="<?php echo date("Y-m-d"); ?>">
	</div>
	<div class="col-sm-4">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Valores Bloqueados</label>
		<select class="form-control" name="chequevalbloq">
			<option value="0">Possui valores bloqueados</option>
			<option value="1">Não possui valores bloqueados</option>
			<option value="null" selected="selected">Ambos</option>
		</select>
	</div>
	<div class="col-sm-4">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Valores Depositados</label>
		<select class="form-control" name="chequevaldepositado">
			<option value="0">Possui valores depositados</option>
			<option value="1">Não possui valores depositados</option>
			<option value="null" selected="selected">Ambos</option>
		</select>
	</div>	
  
</div>
<br>


<style type="text/css">
#tiporelat{
	width:960px;
	height:80px;
	border:solid 1px;
	border-radius:8px;
}
</style>

<div id="tiporelat" style="width:960px;margin-left:15px;">
	<div class="col-sm-4">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Nome do relatório</label>
		<select class="form-control" name="nomerelat" required>
			<option value="">Selecione um nome...</option>
			<option value="BJ">Bloqueio Judicial</option>			
			<option value="DP">Depósito Judicial</option>			
			<option value="NE">Nota Explicativa</option>
			<option value="VLC">VLC</option>			
		</select>
	</div>

	<div class="col-sm-2">
		<label class="control-label" style="margin-top:40px;"></label>
		<input type="radio" id="pdf" name="tiporelat" value="PDF" required> <label for="male"> PDF </label>
		<input type="radio" id="excel" name="tiporelat" value="EXCEL" required> <label for="female"> EXCEL </label>
	</div>
	<input class="btn btn-primary btnpequenomed" type="submit" name="submit" value="Imprimir" style="margin-left:0px; margin-top: 22px;" formtarget="_blank" >
</div>



<!-- <input class="btn btn-primary btnpequenomin" type="submit" name="submit1" value="Nota Ex .PDF" style="margin-left:14px;" formtarget="_blank">
<input class="btn btn-primary btnpequenomin" type="submit" name="submit2" value="Nota Ex .EXCEL" style="margin-left:0px;" formtarget="_blank">
<input class="btn btn-primary btnpequenomin" type="submit" name="submit3" value="VLC - PDF" style="margin-left:0px;" formtarget="_blank">
<input class="btn btn-primary btnpequenomin" type="submit" name="submit4" value="VLC - EXCEL" style="margin-left:0px;" formtarget="_blank">
<input class="btn btn-primary btnpequenomed" type="submit" name="submit5" value="Dep Jud - PDF" style="margin-left:0px;" formtarget="_blank">
<input class="btn btn-primary btnpequenomed" type="submit" name="submit6" value="Dep Jud - EXCEL" style="margin-left:0px;" formtarget="_blank">
<button type="button" class="btn btn-primary btnpequenomin">
	<a href="<?php echo base_url()?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">Tela inicial</a>
</button> -->
<hr>
</div>
</form>
<?php $this->load->view('view_rodape');?>
