<?php
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' => 'calendar');?>

<script language='JavaScript'>
	function Formatadata(Campo, teclapres){
		var tecla = teclapres.keyCode;
		var vr = new String(Campo.value);
		vr = vr.replace("/", "");
		vr = vr.replace("/", "");
		vr = vr.replace("/", "");
		tam = vr.length + 1;
		if (tecla != 8 && tecla != 8){
			if (tam > 0 && tam < 2)
				Campo.value = vr.substr(0, 2) ;
			if (tam > 2 && tam < 4)
				Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2);
			if (tam > 4 && tam < 7)
				Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2) + '/' + vr.substr(4, 7);
		}
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

</script>
<div id="caixa7">
<div id="tabs">
<ul>
	<li><a href="#tabs-1">Perfil</a></li>
</ul>

<!--  primeira aba -->
<div id="tabs-1">
<fieldset class='visible' style='width:927px;margin-left:-14px;'>
<form method="post" action="<?php echo base_url();?>cadmin/update" name="formsol" onsubmit="return validapodas()">
<?php 
foreach($funcdetalhe as $fc){
	$Id = $fc->Id;
	$Matricula = $fc->Matricula;
	$Nome = utf8_encode($fc->Nome);
	$Login = $fc->Login;
	$Admin = $fc->Admin;
	$Nivel1 = $fc->Nivel1;
	$Nivel2 = $fc->Nivel2;
	$Nivel3 = $fc->Nivel3;
	$Nivel4 = $fc->Nivel4;
	$Nivel5 = $fc->Nivel5;
	$Nivel6 = $fc->Nivel6;
	$Ativo = $fc->Ativo;
}
?>
<fieldset class=visible style='width:915px;margin-left:-0px;'>
<font size="5">Alteração de acesso aos módulos do sistema</font><br>
</fieldset>
<fieldset class='visible' style='width:915px'>
<form method="post" action="<?php echo base_url();?>cadmin/update" name="formfunc">
<input type="hidden" name="idFunc" id="idFunc" value="<?php echo $Id;?>" size="5"/>

<div class="row">
	<div class="label">Matrícula</div>
	<div class="field">
		<input type="text" name="mat" id="mat" value="<?php echo $Matricula?>" size="10" disabled/>
		&nbsp;&nbsp;
		Nome <input type="text" name="nome" id="nome" value="<?php echo $Nome?>" size="55" style="text-transform:uppercase;" disabled/>
		&nbsp;&nbsp;
		login <input type="text" name="login" id="login" value="<?php echo $Login?>" size="20" disabled/>
	</div>
</div>
 
<?php if($_SESSION['Admin']==1){ ?>
<hr>
<div class="row">
	<div class="label">Jurídico Admin</div>
	<div class="field">
		<select name="Nivel1" required>
			<?php if($Nivel1==0){?>
				<option value="0" selected>NÃO</option>
				<option value="1">SIM</option>
			<?php } if($Nivel1==1){?>
				<option value="0">NÃO</option>
				<option value="1" selected>SIM</option>
			<?php } ?>			
		</select>
	</div>
</div><br>

<div class="row">
	<div class="label">Jurídico Leitura</div>
	<div class="field">
		<select name="Nivel2" required>
			<?php if($Nivel2==0){?>
				<option value="0" selected>NÃO</option>
				<option value="1">SIM</option>
			<?php } if($Nivel2==1){?>
				<option value="0">NÃO</option>
				<option value="1" selected>SIM</option>
			<?php } ?>			
		</select>
	</div>
</div><br>

<div class="row">
	<div class="label">Contr. Atas Amin</div>
	<div class="field">
		<select name="Nivel3" required>
			<?php if($Nivel3==0){?>
				<option value="0" selected>NÃO</option>
				<option value="1">SIM</option>
			<?php } if($Nivel3==1){?>
				<option value="0">NÃO</option>
				<option value="1" selected>SIM</option>
			<?php } ?>			
		</select>
	</div>
</div><br>

<div class="row">
	<div class="label">Contr. Atas Leitura</div>
	<div class="field">
		<select name="Nivel4" required>
			<?php if($Nivel4==0){?>
				<option value="0" selected>NÃO</option>
				<option value="1">SIM</option>
			<?php } if($Nivel4==1){?>
				<option value="0">NÃO</option>
				<option value="1" selected>SIM</option>
			<?php } ?>			
		</select>
	</div>
</div><br>

<div class="row">
	<div class="label">Financeiro Admin</div>
	<div class="field">
		<select name="Nivel5" required>
			<?php if($Nivel5==0){?>
				<option value="0" selected>NÃO</option>
				<option value="1">SIM</option>
			<?php } if($Nivel5==1){?>
				<option value="0">NÃO</option>
				<option value="1" selected>SIM</option>
			<?php } ?>			
		</select>
	</div>
</div><br>

<div class="row">
	<div class="label">Financiero Leituras</div>
	<div class="field">
		<select name="Nivel6" required>
			<?php if($Nivel6==0){?>
				<option value="0" selected>NÃO</option>
				<option value="1">SIM</option>
			<?php } if($Nivel6==1){?>
				<option value="0">NÃO</option>
				<option value="1" selected>SIM</option>
			<?php } ?>			
		</select>
	</div>
</div><br>

<div class="row">
	<div class="label">Status</div>
	<div class="field">
		<select name="Ativo" required>
			<?php if($Ativo==0){?>
				<option value="0" selected>INATIVO</option>
				<option value="1">ATIVO</option>
			<?php } if($Ativo==1){?>
				<option value="0">INATIVO</option>
				<option value="1" selected>ATIVO</option>
			<?php } ?>			
		</select>
	</div>
</div><br>

<hr>
<div class="row">
	<input type="submit" name="Salvar" value="Salvar" class="botao"/>
	<a href="<?php echo base_url()."cadmin/index/";?>" style="text-decoration:none;"><input type="button" value="Voltar" onclick="location.href('<?php echo base_url()."cadmin/index";?>')" class="botao"></a>
</div>
<?php } ?>
</form>
</fieldset>
</div>
</div>
</div>
<?php $this->load->view('view_rodape');?>
