<?php 
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' => 'calendar');
?>

<div id="caixa7">
<div id="tabs">

<h3>Busca relatório de auditoria</h3>

<fieldset class='visible' style='width:933px'>
<form method="post" action="<?php echo base_url();?>cjuridico/relatauditoria" name="formauditoria" onsubmit="return validauditoria()">

<br>
<a href="<?php echo base_url()."cjuridico/relatauditoria/";?>" style="text-decoration:none;" target="_blank">
	<input type="button" value="Relatório de auditoria" onclick="location.href('<?php echo base_url()."cjuridico/relatauditoria/";?>')" class="botao">
</a>
<br>

<br>
</form>
</fieldset>
</div>

<br>
</div>
</div>

<?php $this->load->view('view_rodape');?>