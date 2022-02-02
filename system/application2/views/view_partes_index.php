<?php 
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' =>  'calendar'); ?>

<script type="text/javascript" src="<?php echo base_url();?>js/ajax.js"></script>
<script language='JavaScript'>
function validapartes(){
	tipo = document.formpartes.tipoparte.value;
	nome = document.formpartes.nomeparte.value;
	cpfcnpj = document.formpartes.cpfcnpjparte.value;
	mat = document.formpartes.matparte.value;
	end = document.formpartes.enderecoparte.value;
	endcompl = document.formpartes.endcompletoparte.value;
	bairro = document.formpartes.endbairroparte.value;
	munic = document.formpartes.municipioparte.value;
	uf = document.formpartes.ufparte.value;
	cep = document.formpartes.cepparte.value;
	fone = document.formpartes.foneparte.value;
	if ((tipo=="")&&(nome=="")&&(cpfcnpj=="")&&(mat=="")&&(end=="")&&(endcompl=="")&&
		(bairro=="")&&(munic=="")&&(uf=="")&&(cep=="")&&(fone=="")){
		alert("Por favor, informe algum campo para a busca!");	
		return false;
	}	
	
/*	if ((DataIni!="")&&(DataFim=="")){
		alert("Por favor, informe a data inicial e final");	
		return false;
	}
	if ((DataIni=="")&&(DataFim!="")){
		alert("Por favor, informe a data inicial e final");	
		return false;
	} */		
}

function excluiaudiencia(IdAcao,IdAudi,flagAudiFiltro){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>caudiencia/delete/"+IdAcao+"/"+IdAudi+"/"+flagAudiFiltro;
	} else {
		return false;
	}
}
</script>

<div id="caixa7">
<div id="tabs">
<div id="tabs-1">

<h3>Partes</h3>
<fieldset class='visible' style='width:935px'>
<form method="post" action="<?php echo base_url();?>cpartes/buscapartesresult" name="formpartes" onsubmit="return validapartes()">

<div class="row">
	<div class="label">Tipo</div>
	<div class="field">
      	<select name="tipoparte" id="tipoparte">
			<option value=""></option>
			<option value="1">AUTOR</option>
			<option value="2">RÉU</option>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Nome</div>
	<div class="field"> 
		<input type="text" name="nomeparte" id="nomeparte" size="50" maxlength="100" value=""/> 
	</div>
	CPFCNPJ
	<div class="field"> 
		<input type="text" name="cpfcnpjparte" id="cpfcnpjparte" size="16" maxlength="18" value=""/> 
	</div>		
	Matricula
	<div class="field"> 
		<input type="text" name="matparte" id="matparte" size="10" maxlength="8" value=""/> 
	</div>	
</div>

<div class="row">
	<div class="label">Endereço</div>
	<div class="field"> 
		<input type="text" name="enderecoparte" id="enderecoparte" size="100" maxlength="100" value=""/> 
	</div>	
</div>

<div class="row">
	<div class="label">Endereço completo</div>
	<div class="field"> 
		<input type="text" name="endcompletoparte" id="endcompletoparte" size="60" maxlength="40" value=""/> 
	</div>
	Bairro
	<div class="field"> 
		<input type="text" name="endbairroparte" id="endbairroparte" size="30" maxlength="30" value=""/> 
	</div>
</div>

<div class="row">
	<div class="label">Município</div>
	<div class="field"> 
		<input type="text" name="municipioparte" id="municipioparte" size="34" maxlength="50" value=""/> 
	</div>
	UF
	<select name="ufparte"> 
		<option value="">Selecione o Estado</option> 
		<option value="ac">Acre</option> 
		<option value="al">Alagoas</option> 
		<option value="am">Amazonas</option> 
		<option value="ap">Amapá</option> 
		<option value="ba">Bahia</option> 
		<option value="ce">Ceará</option> 
		<option value="df">Distrito Federal</option> 
		<option value="es">Espírito Santo</option> 
		<option value="go">Goiás</option> 
		<option value="ma">Maranhão</option> 
		<option value="mt">Mato Grosso</option> 
		<option value="ms">Mato Grosso do Sul</option> 
		<option value="mg">Minas Gerais</option> 
		<option value="pa">Pará</option> 
		<option value="pb">Paraíba</option> 
		<option value="pr">Paraná</option> 
		<option value="pe">Pernambuco</option> 
		<option value="pi">Piauí</option> 
		<option value="rj">Rio de Janeiro</option> 
		<option value="rn">Rio Grande do Norte</option> 
		<option value="ro">Rondônia</option> 
		<option value="rs">Rio Grande do Sul</option> 
		<option value="rr">Roraima</option> 
		<option value="sc">Santa Catarina</option> 
		<option value="se">Sergipe</option> 
		<option value="sp">São Paulo</option> 
		<option value="to">Tocantins</option> 
	</select>	
	CEP
	<div class="field"> 
		<input type="text" name="cepparte" id="cepparte" size="12" maxlength="10" value=""/> 
	</div>	
	Fone
	<div class="field"> 
		<input type="text" name="foneparte" id="foneparte" size="13" maxlength="14" value=""/> 
	</div>	
</div>

<br><hr>
<input type="submit" name="submit" value="Pesquisar" class="botao"/>
<a href="<?php echo base_url()."cpartes/addpartes/"?>" style="text-decoration:none;">
	<input type="button" value="Adicionar" onclick="location.href('<?php echo base_url()."cpartes/addpartes/"?>')" class="botao">
</a>	
</form>
</fieldset>
</div>
</div>
</div>

<?php $this->load->view('view_rodape');?>