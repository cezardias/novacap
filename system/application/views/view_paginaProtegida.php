<?php $this->load->view('view_cabecalho');?>

<style>
/* Grey box */
div.grey{ border:1px solid #e0e0e0; background:#fbfbfb; margin:0 0 20px 0; padding:20px;
border-radius: 7px;
-moz-border-radius: 7x;
}
/* Give the contents div or table a margin; because padding on .grey screws up widths. */
div.grey>div{ margin:6px; }
</style>

<?php
	if($this->session->userdata('msg')==''){
?>
	<div class="status_box info">
		<h6>Informa&ccedil;&atilde;o</h6>
		<ul>
			<li>Para acesso aos sistemas corporativos da Novacap, &eacute; necess&aacute;rio ter um <i>login</i> e uma senha cadastrados na rede.</li>
			<li>O perfil de acesso a cada sistema &eacute; definido pelos respectivos administradores.</li>
		</ul>
	</div>
<?php
	}
?>

<?php
	if($this->session->userdata('msg')=='erro'){
	$this->session->set_userdata('msg', '');
?>
	<div class="status_box error">
		<h6>Erro!</h6>
		<ul>
			<li>Login ou senha inv&aacute;lidos!</li>
		</ul>
	</div>
<?php
	}
	if($this->session->userdata('msg')=='vazio'){
	$this->session->set_userdata('msg', '');
?>
	<div class="status_box error">
		<h6>Erro!</h6>
		<ul>
			<li>Login ou senha n&atilde;o podem estar vazios!</li>
		</ul>
	</div>
<?php
	}
	if($this->session->userdata('msg')=='acessonot'){
	$this->session->set_userdata('msg', '');
?>
	<div class="status_box error">
		<h6>Erro!</h6>
		<ul>
			<li>Acesso n&atilde;o autorizado ou usu&aacute;rio/senha inv&aacute;lidos!</li>
		</ul>
	</div>
<?php
	}
?>

<h2>Autentica&ccedil;&atilde;o</h2>

<div class="grey" style="width:270px;margin:20px auto 0 auto;">
	<div>
		<form method="post" action="<?php echo base_url();?>usuario/login">
			<div class="row">
				<div class="_label" style="width:250px;margin-bottom:5px;background:#fbfbfb;">Login:</div>
				<div class="field">
					<input style="width:250px;border-color:#e0e0e0;margin-bottom:10px;" name="login" id="login" size="50" maxlength="50" required autofocus/>
					<br>
				</div>
			</div>

			<div class="row">
				<div class="_label" style="width:250px;margin-bottom:5px;background:#fbfbfb;">Senha:</div>
				<div class="field">
					<input style="width:250px;border-color:#e0e0e0;" type="password" name="senha" id="senha" size="50" maxlength="20" required>
					<br>
				</div>
			</div>
			<br>
			<input type='hidden' name='paginaatual' value='<?php echo current_url();?>'>
			<input type='submit' name='submit' value="Autenticar" class="botao"><br>
		</form>
	</div>
</div>

<br>
<?php $this->load->view('view_rodape');?>
