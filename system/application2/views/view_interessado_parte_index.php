<?php 
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' =>  'calendar');?>

<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/3.3.7/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/jquery/3.2.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/js/3.3.7/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings.png"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings-white.png"></script>

<script language="JavaScript">
//Funcao validar CPF
function valida_cpf(cpfcnpj){
	var cpf,numeros, digitos, soma, i, resultado, digitos_iguais;
	cpf = cpfcnpj;
	digitos_iguais = 1;
	if (cpf.length < 11)
		return false;
	for (i = 0; i < cpf.length - 1; i++)
	if (cpf.charAt(i) != cpf.charAt(i + 1)){
		digitos_iguais = 0;
		break;
	}
	if (!digitos_iguais){
		numeros = cpf.substring(0,9);
		digitos = cpf.substring(9);
		soma = 0;
		for (i = 10; i > 1; i--)
			soma += numeros.charAt(10 - i) * i;
			resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
		if (resultado != digitos.charAt(0))
			return false;
			numeros = cpf.substring(0,10);
			soma = 0;
		for (i = 11; i > 1; i--)
			soma += numeros.charAt(11 - i) * i;
			resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
		if (resultado != digitos.charAt(1))
			return false;
		return true;
	}
	else
	return false;
}

//Funcao validar CNPJ
function valida_cnpj(cpfcnpj){
	c = cpfcnpj;
    var b = [6,5,4,3,2,9,8,7,6,5,4,3,2];
    if((c = c.replace(/[^\d]/g,"")).length != 14)
        return false;
    if(/0{14}/.test(c))
        return false;
    for (var i = 0, n = 0; i < 12; n += c[i] * b[++i]);
    if(c[12] != (((n %= 11) < 2) ? 0 : 11 - n))
        return false;
    for (var i = 0, n = 0; i <= 12; n += c[i] * b[i++]);
    if(c[13] != (((n %= 11) < 2) ? 0 : 11 - n))
        return false;
    return true;
};

//Funcao principal.
function validaformpartes() {
	var cpfcnpj = document.formparteinteressado.cpfcnpj.value;
	if(cpfcnpj.length==11){
		if(valida_cpf(cpfcnpj)){
			return true;
		}
		else{
			alert('CPF informado inválido!');
			document.formparteinteressado.cpfcnpj.focus();
			return false;
		}
	}else if(cpfcnpj.length==14){
		if(valida_cnpj(cpfcnpj)){
			return true;
		}
		else{
			alert('CNPJ informado inválido!');
			document.formparteinteressado.cpfcnpj.focus();
			return false;
		}
	}else{
		document.formparteinteressado.cpfcnpj.focus();
		alert('Campo CPF/CNPJ digitato é inválido!');
		return false;
	}
}
</script>
<?php $cpfcnpj = $cpfcnpjencontrado;//aproveitar cpfcnpj ja digitado posteriormente. ?>
<form role="form" method="post" action="<?php echo base_url();?>cacaocivel/createparteinteressado" name="formparteinteressado" onsubmit="return validaformpartes()">

<div class="row" style="width:700px;margin-left:0px;height:50px;">
	<div class="well well-sm" style="width:730px;height:50px;">
		<h3 style="margin-top:5px;">Cadastro de interessado</h3>
	</div>
</div>

<div class="row" style="width:730px;">
	<div class="col-xs-4">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:5px;">CPF/CNPJ</label>
		<input type="text" class="form-control" name="cpfcnpj" id="cpfcnpj" value="<?php echo $cpfcnpj?>" maxlength="14" placeholder="Somente números..." style="margin-left:5px;" required>					
	</div>
	<div class="col-xs-8">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Nome</label>
		<input type="text" class="form-control" name="nome" id="nome" value="" style="margin-left:5px;text-transform:uppercase;" required autofocus>
	</div>
	<div class="col-xs-3 selectContainer">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:5px;">Tipo</label>
		<select class="form-control" name="Tipo" style="margin-left:5px;" required>
			<option value=""></option>
			<option value="1">PESSOA F&Iacute;SICA</option>
			<option value="2">PESSOA JUR&Iacute;DICA</option>
		</select>
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Matricula Novacap</label>
		<input type="text" class="form-control" name="MatriculaNovacap" id="MatriculaNovacap" value="" style="width:160px;">					
	</div>
	<div class="col-xs-6">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Endereco</label>
		<input type="text" class="form-control" name="Endereco" id="Endereco" value="" style="text-transform:uppercase;">
	</div>
	<div class="col-xs-7">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:5px;">Complemento</label>
		<input type="text" class="form-control" name="Complemento" id="Complemento" value="" style="text-transform:uppercase;margin-left:5px;">
	</div>	
	<div class="col-xs-5">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Bairro</label>
		<input type="text" class="form-control" name="Bairro" id="Bairro" value="" style="text-transform:uppercase;">
	</div>		
	<div class="col-xs-4">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:5px;">Munic&iacute;pio</label>
		<input type="text" class="form-control" name="Municipio" id="Municipio" value="" style="text-transform:uppercase;margin-left:5px;">
	</div>	
	<div class="col-xs-2">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">UF</label>
		<input type="text" class="form-control" name="UF" id="UF" value="" style="text-transform: uppercase;">
	</div>	
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">CEP</label>
		<input type="text" class="form-control" name="CEP" id="CEP" value="" style="text-transform:uppercase;">
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Telefone</label>
		<input type="text" class="form-control" name="Telefone" id="Telefone" value="">
	</div>		
</div>
<hr>
<input class="btn btn-primary" type="submit" value="Gravar" style="margin-left:10px;width:100px;">
<input class="btn btn-primary" value="Cancelar" style="margin-left:10px;width:100px;" onClick="javascript:window.close();">
<hr>
</form>