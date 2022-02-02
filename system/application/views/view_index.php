<?php 
$this->load->view('view_cabecalho');
$usuario = $this->session->userdata('usuario');
$acessoNivel = $this->session->userdata('acessoNivel');
?>
<div id="divindex">
	<img src="<?php echo base_url();?>img/juridico.jpg" width="960" height="400"/>
</div>
<?php $this->load->view('view_rodape');?>