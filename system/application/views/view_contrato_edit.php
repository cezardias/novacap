<?php
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' =>  'calendar');
$contrato = '123/'.date('Y');?>

<script language="JavaScript">

function validacontrato(){
	contr = document.formcontrato.contratonr.value;
	if (contr.length < 8){
		alert("Preencha o contrato no seguinte formado 123/2020.");
		return false;
	}
}

function validassunto(){
	assunto = document.formassunto.assuntoid.value;
	if (assunto==""){
		alert("Por favor, escolha um assunto!");
		return false;
	}
}

function validainteressado(){
	interessadonome = document.forminteressasdo.interessadonome.value;
	if (interessadonome==""){
		alert("Por favor, digite o nome do interessado!");
		return false;
	}
}

function validaudiencia(){
	AudienciaData = document.formaudiencia.AudienciaData.value;
	AudienciaHora = document.formaudiencia.AudienciaHora.value;
	AudienciaMin = document.formaudiencia.AudienciaMin.value;
	audienciatipo = document.formaudiencia.audienciatipo.value;
	audobs = document.formaudiencia.audobs.value;
	if ((AudienciaData=="")||(AudienciaHora=="")||(AudienciaMin=="")||(audienciatipo=="")){
		alert("Por favor, preencha todos os campos!");
		return false;
	}
}

function excluiassunto(AcoesId,IdRegAssunto){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>cassunto/delete/"+AcoesId+"/"+IdRegAssunto;
	} else {
		return false;
	}
}

function excluinteressado(AcoesInterId,IdRegInter){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>cinteressado/delete/"+AcoesInterId+"/"+IdRegInter;
	} else {
		return false;
	}
}

function excluiaudiencia(AcaoId,IdRegAud){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>caudiencia/delete/"+AcaoId+"/"+IdRegAud;
	} else {
		return false;
	}
}

function mascara(t, mask){
	var i = t.value.length;
	var saida = mask.substring(1,0);
	var texto = mask.substring(i)
	if (texto.substring(0,1) != saida){
		t.value += texto.substring(0,1);
	}
 }
</script>

<h2>Altera&ccedil;&atilde;o de contrato</h2>

<?php
//print_r($contratodetail);
if(!empty($contratodetail)&&(sizeof($contratodetail)>0)){
	foreach ($contratodetail as $its):
		$IdContrato = $its->Id;
		$ContratoNr = $its->ContratoNr;
		$ContratoNrP1 = substr($ContratoNr,0,3);
		$ContratoNrP2 = substr($ContratoNr,3,4);
		$ContratoNr = $ContratoNrP1.'/'.$ContratoNrP2;

		$ContratoAno = $its->ContratoAno;
		$ContratoNumero = $its->ContratoNumero;
		$LicitacaoModalidadeId = $its->LicitacaoModalidadeId;
		$LicitacaoModalidade = $its->LicitacaoModalidade;
		$ProcessoNr = $its->ProcessoNr;
		// if(($ProcessoNr != "")&&($ProcessoNr != NULL)){
		// 	$primeiro = substr($ProcessoNr, 0, 3);
		// 	$segundo = substr($ProcessoNr, 3, 3);
		// 	$terceiro = substr($ProcessoNr, 6, 3);
		// 	$quarto = substr($ProcessoNr, 9, 4);
		// 	$ProcessoNr = $primeiro.".".$segundo.".".$terceiro."/".$quarto;
		// }else{$ProcessoNr = '';}
		$ProcSEI = $its->Sei;
		// if($ProcSEI != ""){ //00112-00005028/2018-31
		//     $parte1 = substr($ProcSEI, 0, 5);
		//     $parte2 = substr($ProcSEI, 5, 8);
		//     $parte3 = substr($ProcSEI, 13, 4);
		//     $parte4 = substr($ProcSEI, 17, 2);
		//     $ProcSEI = $parte1.'-'.$parte2.'/'.$parte3.'-'.$parte4;
		// }else{$ProcSEI = '';}
		$ProcessoNrSemMascara = $its->ProcessoNrSemMascara;
		$Empresa = $its->Empresa;
		$LicitacaoNumero = $its->LicitacaoNumero;
		$Diretoria = $its->Diretoria;
		$Objeto = $its->Objeto;
		$Valor = $its->Valor; //if($Valor != ""){$Valor = number_format($Valor, 2, ',', '.');}else{$Valor="0,00";}
		$AditivosValor = $its->AditivosValor; //if($AditivosValor != ""){$AditivosValor = number_format($AditivosValor, 2, ',', '.');}else{$AditivosValor="0,00";}
		$ValorComAditivos = $its->ValorComAditivos; //if($ValorComAditivos != ""){$ValorComAditivos = number_format($ValorComAditivos, 2, ',', '.');}else{$ValorComAditivos="0,00";}
		$DataAssinatura = $its->DataDeAssinatura;// if($DataAssinatura==""){$DataAssinatura='';}else{$DataAssinatura = date('d/m/Y',strtotime($DataAssinatura));}
		$VigenciaInicio = $its->VigenciaInicio; //if($VigenciaInicio==""){$VigenciaInicio='';}else{$VigenciaInicio = date('d/m/Y',strtotime($VigenciaInicio));}
		$VigenciaFim = $its->VigenciaFim; //if($VigenciaFim==""){$VigenciaFim='';}else{$VigenciaFim = date('d/m/Y',strtotime($VigenciaFim));}
		$PrazoVigAditado = $its->PrazoDeVigenciaAditado; //if($PrazoVigAditado==""){$PrazoVigAditado='';}else{$PrazoVigAditado = date('d/m/Y',strtotime($PrazoVigAditado));}
		$PrazoDeVigenciaAtivo = $its->PrazoDeVigenciaAtivo;
		$ExecucaoInicio = $its->ExecucaoInicio; //if($ExecucaoInicio==""){$ExecucaoInicio='';}else{$ExecucaoInicio = date('d/m/Y',strtotime($ExecucaoInicio));}
		$ExecucaoFim = $its->ExecucaoFim; //if($ExecucaoFim==""){$ExecucaoFim='';}else{$ExecucaoFim = date('d/m/Y',strtotime($ExecucaoFim));}
		$VigenciaPrazo = $its->VigenciaPrazo;
		$VigenciaPrazoNum = $its->VigenciaPrazoNum;
		$VigenciaTipo = $its->VigenciaTipo;
		$ExecucaoPrazo = $its->ExecucaoPrazo;
		$ExecucaoPrazoNum = $its->ExecucaoPrazoNum;
		$ExecucaoTipo = $its->ExecucaoTipo;
		$Situacao = $its->Situacao;
		$Executor = $its->Executor;
		$Observacoes = $its->Observacoes;
		$Ativo = $its->Ativo;
		$LicitacaoProcesso = $its->LicitacaoProcesso;
	endforeach;

	$Diretorias = array(
	    array(
	        'Sigla' => 'DA',
	        'Descricao' => 'DIRETORIA ADMINISTRATIVA'
	    ),
	    array(
	        'Sigla' => 'DE',
	        'Descricao' => 'DIRETORIA DE EDIFICAÇÕES'
	    ),
	        array(
	        'Sigla' => 'DOE',
	        'Descricao' => 'DIRETORIA DE OBRAS ESPECIAIS'
	    ),
	        array(
	        'Sigla' => 'DU',
	        'Descricao' => 'DIRETORIA DE URBANIZAÇÃO'
	    )
	);?>

<div id="caixa7">
<div id="tabs">

<fieldset class='visible' style='width:933px'>
<div id="tabs-1">
<!-- <form method="post" action="<?php echo base_url();?>cjuridico/savecontrato" name="formcontrato" onsubmit="return validacontrato()"> -->
<form method="post" action="<?php echo base_url();?>cjuridico/savecontrato" name="formcontrato" onsubmit="return validacontrato()">
<input type="hidden" name="idcontrato" id="idcontrato" value="<?php echo $IdContrato;?>" maxlength="10" size="10"/>

<div class="row">
	<div class="label">Processo n&ordm;</div>
	<div class="field">
		<input type="text" name="processonr" id="processonr" value="<?php echo $ProcessoNr?>" size="15" maxlength="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)' autofocus required/>
	</div>

	Proc. SEI
	<div class="field">
		<input type="text" name="prsei" id="prsei" maxlength="22" size="20" value="<?php echo $ProcSEI?>" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)' required/>
	</div>

	Licita&ccedil;&atilde;o n&ordm;
	<div class="field">
		<input type="text" name="licitanr" id="licitanr" value="<?php echo $LicitacaoNumero?>" size="10" maxlength="12" required/>
	</div>

	Modalid.
	<div class="field">
		<select name="licitacaomodalidade" style="width:200px;" required>
			<option value=""></option>
			<?php foreach ($contratomodalide as $mod):
			if($LicitacaoModalidadeId==$mod->Id){?>
				<option value="<?php echo $mod->Id?>" selected><?php echo utf8_encode($mod->Descricao)?></option>
			<?php }else{?>
				<option value="<?php echo $mod->Id?>"><?php echo utf8_encode($mod->Descricao)?></option>
			<?php } endforeach;?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Empresa</div>
	<div class="field">
		<textarea name="empresa" id="empresa" cols="90" rows="1" onkeypress="return false;"><?php echo utf8_encode($Empresa)?></textarea>
		<input type="hidden" name="empresaid" value="" size="16" id="empresaid" required/>&nbsp;
		<a onclick="javascript:window.open('<?php echo base_url()?>buscaempresa', 'popup_id', 'scrollbars,resizable,width=750,height=550');" style="cursor:pointer; cursor:hand">
			<img src="<?php echo base_url()?>img/famfamfam/icons/application_form_magnify.png" border="0" title="Procurar empresa">
		</a>
		<a onclick="document.getElementById('empresa').value='';document.getElementById('empresaid').value='';" style="cursor:pointer; cursor:hand">
			<img src="<?php echo base_url()?>img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo empresa">
		</a>
	</div>
</div>

<div class="row">
	<div class="label">Contrato</div>
	<div class="field">
		<input type="text" name="contratonr" id="contratonr" maxlength="8" onkeypress="mascara(this, '###/####'); return SomenteNumero(event);" value="<?php echo $ContratoNr?>" size="10" placeholder="<?php echo $contrato?>" required/>
	</div><font style="color:red; font-size:7;"> &#10054;</font>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Valor
	<div class="field">
		<input type="text" name="contratovalor" id="contratovalor" value="<?php echo $Valor?>" size="12" onKeyPress="return MascaraMoeda(this,'.',',',event);" size="12" style="text-align:right;" required/>
	</div><font style="color:red; font-size:7;"> &#10054;</font>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Situa&ccedil;&atilde;o
	<div class="field">
		<select name="situacaocontratoid" required>
			<option value=""></option>
			<?php foreach ($contratosituacao as $crtsit):
			if($crtsit->Id == $Situacao){?>
				<option value="<?php echo $crtsit->Id?>" selected><?php echo utf8_encode($crtsit->Descricao)?></option>
			<?php }else{ ?>
				<option value="<?php echo $crtsit->Id?>"><?php echo utf8_encode($crtsit->Descricao)?></option>
			<?php } endforeach;?>
		</select>
	</div>
	&nbsp;
	Status
	<div class="field">
		<select name="status" required>
			<option value=""></option>
			<?php if($Ativo==1){?>
				<option value="1" selected>ATIVO</option>
				<option value="0">INATIVO</option>
			<?php }else{?>
				<option value="1">ATIVO</option>
				<option value="0" selected>INATIVO</option>
			<?php } ?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Diretoria</div>
	<div class="field">
		<select name="diretoria" required>
			<option value=""></option>
			<?php foreach ($Diretorias as $dirs):
			if($dirs['Sigla']==$Diretoria){?>
				<option value="<?php echo $dirs['Sigla']?>" selected><?php echo $dirs['Descricao']?></option>
			<?php }else{ ?>
				<option value="<?php echo $dirs['Sigla']?>"><?php echo $dirs['Descricao']?></option>
			<?php } endforeach;?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Vigência</div>
	<fieldset class='visible' style='width:750px'>
	In&iacute;cio
	<div class="field">
		<div class="field">
		<input type="text" value="<?php echo $VigenciaInicio?>" name="prazodevigenciainicio" id="prazodevigenciainicio" size="11" maxlength="10" onkeyup="Formatadata(this,event)" onkeypress="return false;" required/>
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formcontrato.prazodevigenciainicio,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
			<a onclick="document.getElementById('prazodevigenciainicio').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url();?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
		</div><font style="color:red; font-size:7;"> &#10054;</font>
		&nbsp;
		Prazo
		<div class="field">
			<input type="text" name="prazodevigencia" id="prazodevigencia" value="<?php echo $VigenciaPrazoNum?>" size="4" onkeypress='return SomenteNumero(event)' required/>
		</div>
		<div class="field">
			<select name="prazodevigenciatipo" required>
				<option value=""></option>
				<?php if($VigenciaTipo=='DIAS'){?>
					<option value="DIAS" selected>DIAS</option>
					<option value="MESES">MESES</option>
				<?php }else if($VigenciaTipo=='MESES'){?>
					<option value="DIAS">DIAS</option>
					<option value="MESES" selected>MESES</option>
				<?php }else{ ?>
					<option value="DIAS">DIAS</option>
					<option value="MESES">MESES</option>
				<?php } ?>
			</select><font style="color:red; font-size:7;"> &#10054;</font>
		</div>
	</div>
	</fieldset>
</div>

<div class="row">
	<div class="label">Objeto</div>
	<div class="field">
		<textarea name="contratoobjeto" cols="105" rows="3" maxlength="1000" style="text-transform:uppercase;" required><?php echo utf8_encode($Objeto)?></textarea>
	</div>
</div>

<div class="row">
	<div class="label">Observa&ccedil;&otilde;es</div>
	<div class="field">
		<textarea name="observacoes" cols="105" rows="3" maxlength="200" style="text-transform:uppercase;"><?php echo $Observacoes?></textarea>
	</div>
</div>

<font style="color:red; font-size:7;">Campos obrigatórios &#10054;</font>

<hr>
<?php if ($acessoNivel == 2) { ?>
<div class="row">
	<input type="submit" name="Gravar" value="Gravar" class="botao"/>
	<a href="<?php echo base_url()."caditivo/detailcontrato/".$IdContrato."/11";?>" style="text-decoration:none;">
		<input type="button" value="Cancelar" onclick="location.href('<?php echo base_url()."caditivo/detailcontrato/".$IdContrato;?>')" class="botao">
	</a> &nbsp;<?php } ?>
</div>
<?php
}
else { ?>
<div class="status_box warning">
	<h6>Aviso!</h6>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Nenhuma registro encontrato!
</div>
<?php } ?>
</form>
</fieldset>
</div>
</div>
</div>
<?php $this->load->view('view_rodape');?>
