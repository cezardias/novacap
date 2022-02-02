<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta charset="utf-8"/>

<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/3.3.7/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/jquery/3.2.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/js/3.3.7/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings.png"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings-white.png"></script>

<script language="JavaScript">
function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;
    	if((tecla > 47 && tecla < 58)||(tecla==13)) return true;
    else{
    	if (tecla != 8){
    		return false;
        }else{
        	return true;
        }
    }
}

function ValidarCNPJ(cpfcnpj){
	var cnpj = cpfcnpj.value;
	var valida = new Array(6,5,4,3,2,9,8,7,6,5,4,3,2);
	var dig1= new Number;
	var dig2= new Number;
	
	exp = /\.|\-|\//g
	cnpj = cnpj.toString().replace( exp, "" );
	var digito = new Number(eval(cnpj.charAt(12)+cnpj.charAt(13)));
			
	for(i = 0; i<valida.length; i++){
			dig1 += (i>0? (cnpj.charAt(i-1)*valida[i]):0); 
			dig2 += cnpj.charAt(i)*valida[i];      
	}
	dig1 = (((dig1%11)<2)? 0:(11-(dig1%11)));
	dig2 = (((dig2%11)<2)? 0:(11-(dig2%11)));
	
	if(((dig1*10)+dig2) != digito){
		alert('CNPJ Invalido!');
		return false;
	}
}

function validaempresa(){
	alert("Valida chamada....");
	cpfcnpj = document.formempresa.cpfcnpj.value;
	if(cpfcnpj != ""){
		if(!ValidarCNPJ(cpfcnpj)){
			return false;
		} 
	}
}
</script>
<?php $cpfcnpj = $cpfcnpjencontrado; //aproveitar cpfcnpj ja digitado posteriormente. ?>
<form role="form" method="post" action="<?php echo base_url();?>ccontrato/empresacreate" name="formempresa" onsubmit="return ValidarCNPJ(cpfcnpj)">
<!-- <form role="form" method="post" action="<?php echo base_url();?>ccontrato/empresacreate" name="formempresa"> -->
<div class="row" style="width:700px;margin-left:0px;height:50px;">
	<div class="well well-sm" style="width:730px;height:50px;">
		<h3 style="margin-top:5px;">Cadastrar empresa</h3>
	</div>
</div>

<div class="row" style="width:730px;">
	<div class="col-xs-4">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:5px;">CPF/CNPJ</label>
		<input type="text" class="form-control" name="cpfcnpj" id="cpfcnpj" value="<?php echo $cpfcnpj?>" maxlength="14" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Somente números..." style="margin-left:5px;" required autofocus>
	</div>
	<div class="col-xs-8">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Nome</label>
		<input type="text" class="form-control" name="nome" id="nome" value="" style="margin-left:5px;text-transform:uppercase;" required>
	</div>
	<!--
	<div class="col-xs-3 selectContainer">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:5px;">Tipo</label>
		<select class="form-control" name="Tipo" style="margin-left:5px;" required>
			<option value=""></option>
			<option value="1">PESSOA F&Iacute;SICA</option>
			<option value="2">PESSOA JUR&Iacute;DICA</option>
		</select>
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Matricula Novacap.......</label>
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
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:5px;">Munic�pio</label>
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
	</div> -->
</div>
<hr>
<input class="btn btn-primary" type="submit" value="Gravar" style="margin-left:10px;width:100px;">
<input class="btn btn-primary" value="Cancelar" style="margin-left:10px;width:100px;" onClick="javascript:window.close();">
<hr>
</form>
