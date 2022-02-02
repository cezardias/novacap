<html>
<head>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> -->
<?php 
//ini_set('default_charset', 'isso-8859-1');
ini_set('default_charset', 'UTF-8');?>
<script language="Javascript" type="text/javascript">
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

function putData(id,valor) {
   var codigo = valor;
   var IdParte = id;

   if (codigo!= ""){
     window.opener.document.getElementById('NomeParte').value = codigo;
     window.opener.document.getElementById('IdParte').value = IdParte;
   	 window.close();
   }else{
    alert('Não é permitido campos em Brancos');
    }
}
</script>
<script type="text/javascript">
function focusIt(){
  var mytext = document.getElementById("mat");
  mytext.focus();
}
onload = focusIt;

function close_window() {
    close();
}
</script>

<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/3.3.7/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/jquery/3.2.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/js/3.3.7/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings.png"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings-white.png"></script>

</head>
<body>

<div class="row">
	<div class="well well-sm">
		<h3 style="margin-left:10px;">Pesquisar partes</h3>
	</div>
</div>

<form onsubmit="document.location.href='<?php echo base_url();?>cpartes/searchCPFCNPJ/'+document.getElementById('cpfcnpj').value;return false;">
	<div class="row" style="width:690px;">
		<div class="col-xs-2">
			<label class="control-label" style="margin-left:5px;margin-top:4px;margin-bottom:-2px;">CPF/CNPJ</label>
		</div>
		<div class="col-xs-4">
			<input type="text" class="form-control" name="cpfcnpj" id="cpfcnpj" value="" 
			onblur="return verificarCPF(this.value)" onkeypress='return SomenteNumero(event)' placeholder="Somente número..." autofocus>
		</div>
		<div class="col-xs-3">
			<input class="btn btn-primary btnpequeno" type="submit" value="Pesquisar">
		</div>
		</div>
</form>

<form onsubmit="document.location.href='<?php echo base_url();?>cpartes/searchNOME/'+document.getElementById('nome').value;return false;">
	<div class="row" style="width:690px;">
		<div class="col-xs-2">
			<label class="control-label" style="margin-left:5px;margin-top:4px;margin-bottom:-2px;">Nome</label>
		</div>
		<div class="col-xs-6">
			<input type="text" class="form-control" name="nome" id="nome" value="">
		</div>
		<div class="col-xs-3">
			<input class="btn btn-primary btnpequeno" type="submit" value="Pesquisar">
		</div>
	</div>
</form>

<hr>
<?php
$cpfcnpj = '';
if(!empty($cpfcnpjencontrado)){
	$cpfcnpj = $cpfcnpjencontrado;
}
//mensagem exibida para tentativa de cadastro ja existente.
if($mensagem==0){?>
<div class="alert alert-warning">
  <strong>Atenção!</strong>
  <br>Interesado já cadastrado, selecione o abaixo:
</div>
<?php }

function mask($val, $mask){
	$maskared = '';
	$k = 0;
	for($i = 0; $i<=strlen($mask)-1; $i++){
		if($mask[$i] == '#'){
			if(isset($val[$k]))
			$maskared .= $val[$k++];
		}
		else{
			if(isset($mask[$i]))
			$maskared .= $mask[$i];
		}
	}
	return $maskared;
}
//print_r($records);
if($inicio==0){
if(!empty($records)&&(sizeof($records)>0)){?>
<div class="row">
	<div class="col-md-6">
		<table class="table" style="width:690px;margin-left:0px;">
			<thead>
				<tr style="background-color:#D3D3D3">
					<th style="width:130px;">CPF/CNPJ</th>
					<th style="width:460px;text-align:left;">Nome</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($records as $item):
					$Id = $item->Id;
					$cpfcnpj = $item->CpfCnpj;
					// if(strlen($cpfcnpj)==11){
					// 	$cpfcnpjmask = mask($cpfcnpj,'###.###.###-##');
					// }else if(strlen($cpfcnpj)==14){
					// 	$cpfcnpjmask = mask($cpfcnpj,'##.###.###/####-##');
					// }
					$Nome = utf8_encode($item->Nome);?>
					<tr>
						<td style="width:130px;font-size:14px;">
							<a href="" id="campoFilho" onclick="putData('<?php echo $Id?>','<?php echo $Nome?>')" text-decoration="overline"><?php echo $cpfcnpj?></a>
						</td>
						<td style="width:460px;font-size:14px;"><?php echo $Nome?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>
<?php }
else { ?>
<div class="alert alert-warning">
<strong>Atenção!</strong>
  <br>Parte não encontrada. Cadastrá-la agora?&nbsp; 
  <a href="<?php echo base_url()."cacaocivel/parteinteressadoindex/".$cpfcnpj;?>" style="text-decoration:none;">Sim</a>&nbsp;
  <a href="javascript:close_window();"><font color="red">Não</font></a>
</div>
<?php } }?>
</body>
</html>
