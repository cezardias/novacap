<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta charset="utf-8"/>
<script language="Javascript" type="text/javascript">
function putData(Id,Nome) {
   var empresaid = Id;
   var empresa = Nome;
   if (empresaid != ""){
     window.opener.document.getElementById('empresaid').value = empresaid;
     window.opener.document.getElementById('empresa').value = empresa;
   	 window.close();
   }else{
     alert('N\u00e3o \u00e9 permitido campos em Brancos');
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
		<h3 style="margin-left:10px;">Pesquisar empresa</h3>
	</div>
</div>
<form onsubmit="document.location.href='<?php echo base_url();?>buscaempresa/searchCPFCNPJ/'+document.getElementById('cpfcnpj').value;return false;">
	<div class="row" style="width:690px;">
		<div class="col-xs-2">
			<label class="control-label" style="margin-left:5px;margin-top:4px;margin-bottom:-2px;">CPF/CNPJ</label>
		</div>
		<div class="col-xs-4">
			<input type="text" class="form-control" name="cpfcnpj" id="cpfcnpj" value="" maxlength="14"
			onkeypress="return SomenteNumero(event);" placeholder="Somente número..." autofocus>
		</div>
		<div class="col-xs-3">
			<input class="btn btn-primary btnpequeno" type="submit" value="Pesquisar">
		</div>
	</div>
</form>

<form onsubmit="document.location.href='<?php echo base_url();?>buscaempresa/search/'+document.getElementById('q').value;return false;">
	<div class="row" style="width:690px;">
		<div class="col-xs-2">
			<label class="control-label" style="margin-left:5px;margin-top:4px;margin-bottom:-2px;">Nome</label>
		</div>
		<div class="col-xs-4">
			<input type="text" class="form-control" name="q" id="q" value="">
		</div>
		<div class="col-xs-3">
			<input class="btn btn-primary btnpequeno" type="submit" value="Pesquisar">
		</div>
	</div>
</form>
<hr>
<?php
//print_r($records);
$cpfcnpj = '';
if(!empty($cpfcnpjencontrado)){
	$cpfcnpj = $cpfcnpjencontrado;
}
//mensagem exibida para tentativa de cadastro já existente.
if($mensagem==0){?>
<div class="alert alert-warning">
  <strong>Aten&ccedil;&atilde;o!</strong>
  <br>Empresa j&aacute; cadastrada, selecione a abaixo:
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
					$cpfcnpj = $item->CNPJ;
					if(strlen($cpfcnpj)==11){
						$cpfcnpjmask = mask($cpfcnpj,'###.###.###-##');
					}else if(strlen($cpfcnpj)==14){
						$cpfcnpjmask = mask($cpfcnpj,'##.###.###/####-##');
					}
					$Nome = $item->RazaoSocial;?>
					<tr>
						<td style="width:130px;font-size:14px;">
							<a href="" id="campoFilho" onclick="putData('<?php echo $item->Id?>','<?php echo utf8_encode($Nome)?>')" text-decoration="overline"><?php echo $cpfcnpjmask?></a>
						</td>
						<td style="width:460px;font-size:14px;"><?php echo utf8_encode($Nome)?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>
<?php }
else { ?>
<div class="alert alert-warning">
  <strong>Aten&ccedil;&atilde;o!</strong>
  <br>Empresa n&atilde;o encontrada. Deseja cadastr&aacute;-la agora?&nbsp;
  <a href="<?php echo base_url()."ccontrato/empresaindex/".$cpfcnpj;?>" style="text-decoration:none;">Sim</a>&nbsp;
  <a href="javascript:close_window();"><font color="red">N&atilde;o</font></a>
</div>
<?php } }?>
</body>
</html>
