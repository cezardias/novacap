<?php 
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' =>  'calendar');
?>

<script language="JavaScript">
function validasolproc(){
	assunto = document.formsolproc.proc.value;
	if (assunto==""){
		alert("Por favor, digite o número do processo e clique em Continuar!");
		document.formsolproc.proc.focus();
		return false;
	}	
}

function excluiprazo(AcaoId,IdPrazo,AcaoTipoId){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>cprazocivel/delete/"+AcaoId+"/"+IdPrazo+"/"+AcaoTipoId;
	} else {
		return false;
	}
}
</script>

<h2>Solicitação de processos</h2>

<div id="caixa7">
<div id="tabs">
<ul>
	<li><a href="#tabs-1">Enviar processo</a></li>
</ul>

<fieldset class='visible' style='width:933px'>
<div id="tabs-1">
<fieldset class='visible' style='width:875px'>

<?php if($prexiste=='Nao'){?>
<div class="status_box warning">
	<h6>Aviso!</h6>
	Processo não encontrado ou número inválido!
</div>
<?php }?>

<!-- BUSCAR O PROCESSO EM QUSTÃO E TRAZER SEUS ANDAMENTOS -->
<form method="post" action="<?php echo base_url();?>Csolicitaproc/buscaproc" name="formsolproc" onsubmit="return validasolproc()">
<div class="row">
	<div class="label">Processo judicial<font style="color:white;font-size:7;"> &#10054;</font></div>
	<div class="field">
		<input type="text" name="proc" id="proc" maxlength="25" size="27" value="" style="background-color:#F2F2F2;text-transform: uppercase;" autofocus/>
	</div>&nbsp;
	<input type="submit" value="Avançar" class="botao" style="text-decoration:none;"/>	
</div>
</form>

</fieldset>
</div>

</div>
</div>

<?php $this->load->view('view_rodape');?>