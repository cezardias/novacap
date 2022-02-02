<?php
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');

//NESSE CASO NÃO FUNCIONOU PELO LAÇO foreach, FOI INSTANCIADO DIRETO NO OBJETO.
// echo $empresadtl->Cnpj;
// echo $empresadtl->RazaoSocial;

$emprId = $empresadtl->Id;
$emprCnpj = $empresadtl->Cnpj;
$emprNome = $empresadtl->RazaoSocial;?>

<script type="text/javascript" src="<?php echo base_url();?>js/ajax.js"></script>
<script language="JavaScript">
function validarCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g,'');
    if(cnpj == '') return false;
    if (cnpj.length != 14)
        return false;

    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" ||
        cnpj == "11111111111111" ||
        cnpj == "22222222222222" ||
        cnpj == "33333333333333" ||
        cnpj == "44444444444444" ||
        cnpj == "55555555555555" ||
        cnpj == "66666666666666" ||
        cnpj == "77777777777777" ||
        cnpj == "88888888888888" ||
        cnpj == "99999999999999")
        return false;

    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
    return true;
}

function validaempresa(){
	cnpj = document.formempresa.empresacnpj.value;
	nome = document.formempresa.empresanome.value;

	if(!validarCNPJ(cnpj)){
		 	alert("CNPJ inv\u00e1lido!");
		 	return false;
	}
}
</script>

<div id="caixa7">
<div id="tabs">
<div id="tabs-1">

<h3>Detalhamento de empresa</h3>
<fieldset class='visible' style='width:935px'>
<!-- <form method="post" action="<?php echo base_url();?>buscaempresa/saveempresa" name="formempresa" onsubmit="return validaempresa()"> -->

<div class="row">
	<div class="label">CNPJ</div>
	<div class="field">
		<input type="text" name="empresacnpj" id="empresacnpj" size="14" maxlength="14" value="<?php echo $emprCnpj?>" onblur="validaempresa(this)" autofocus required disabled/>
	</div>
</div>

<div class="row">
	<div class="label">Nome</div>
	<div class="field">
		<input type="text" name="empresanome" id="empresanome" size="85" maxlength="85" value="<?php echo $emprNome?>" required disabled/>
	</div>
</div>

<br><hr>
<a href="<?php echo base_url()."buscaempresa/empresaedit/".$emprId?>">
  <input type="button" value="Alterar" onclick="location.href('<?php echo base_url()."buscaempresa/empresaedit/".$emprId?>')" class="botao">
</a>
<a href="<?php echo base_url()."cjuridico/addcontrato"?>">
  <input type="button" value="Adicionar contrato" onclick="location.href('<?php echo base_url()."cjuridico/addcontrato"?>')" class="botao">
</a>
<!-- </form> -->
</fieldset>
</div>
</div>
</div>

<?php $this->load->view('view_rodape');?>
