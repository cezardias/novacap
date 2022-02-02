<?php
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' =>  'calendar');

//print_r($acaodetail);
foreach ($acaodetail as $acao):
	$IdAcao = $acao->Id;
	$AcaoTipoId = $acao->AcaoTipoId;
	$PrJudicial = $acao->ProcessoJudicialNumero;
	if($PrJudicial != ""){ //0000818-14.2015.5.10.0004
		$p1 = substr($PrJudicial,0,7);
		$p2 = substr($PrJudicial,7,2);
		$p3 = substr($PrJudicial,9,4);
		$p4 = substr($PrJudicial,13,1);
		$p5 = substr($PrJudicial,14,2);
		$p6 = substr($PrJudicial,16,4);
		$ProcessoJud = $p1.'-'.$p2.'.'.$p3.'.'.$p4.'.'.$p5.'.'.$p6;
	}else{$ProcessoJud = "";}
	$VaraId = $acao->VaraId;
	$PrAdmin = $acao->ProcessoAdministrativoNumero;
	if($PrAdmin != ""){ //112.000.222/2016
		$primeiro = substr($PrAdmin, 0, 3);
		$segundo = substr($PrAdmin, 3, 3);
		$terceiro = substr($PrAdmin, 6, 3);
		$quarto = substr($PrAdmin, 9, 4);
		$ProcessoAdmin = $primeiro.".".$segundo.".".$terceiro."/".$quarto;
	}else{$ProcessoAdmin = "";}
  	$CalculoHomologadoValor = $acao->CalculoHomologadoValor; if($CalculoHomologadoValor != ""){$CalculoHomologadoValor = number_format($CalculoHomologadoValor, 2, ',', '.');}else{$CalculoHomologadoValor="0,00";}
  	$CalculoHomologadoValorTipo = $acao->CalculoHomologadoValorTipo;
	$CausaValor = $acao->CausaValor; if($CausaValor != ""){$CausaValor = number_format($CausaValor, 2, ',', '.');}else{$CausaValor="0,00";}
	$SentencaValor = $acao->SentencaValor; if($CausaValor != ""){$SentencaValor = number_format($SentencaValor, 2, ',', '.');}else{$SentencaValor="0,00";}
	$CondenacaoValor = $acao->CondenacaoValor; if($CausaValor != ""){$CondenacaoValor = number_format($CondenacaoValor, 2, ',', '.');}else{$CondenacaoValor="0,00";}
	$ProbaDePerdaId = $acao->ProbabilidadeDePerdaId;
	$FundamentoLegal = utf8_encode($acao->FundamentoLegal);
	$ObsAcaoCivil = utf8_encode($acao->Observacoes);
	$Ativo = $acao->Ativo;
	$Caixa = $acao->Caixa;
	$DtAjuiz = $acao->DataDoAjuizamento; if($DtAjuiz==""){$DtAjuiz='';}else{$DtAjuiz = date('d/m/Y',strtotime($DtAjuiz));}
	$Sisprot = $acao->Sisprot; if(($Sisprot=="")||($Sisprot=='NULL')){$Sisprot='';}
	$PrJudicialAnt = $acao->ProcessoJudicialNumeroAntigo;
	$AcordaoValor = $acao->AcordaoValor; if($AcordaoValor != ""){$AcordaoValor = number_format($AcordaoValor, 2, ',', '.');}else{$AcordaoValor="0,00";}
	$CausaValorTipo = $acao->CausaValorTipo;
	$SentencaValorTipo = $acao->SentencaValorTipo;
	$CondenacaoValorTipo = $acao->CondenacaoValorTipo;
	$AcordaoValorTipo = $acao->AcordaoValorTipo;
	$DataDeExtincao = $acao->DataDeExtincao; if($DataDeExtincao==""){$DataDeExtincao='';}else{$DataDeExtincao = date('d/m/Y',strtotime($DataDeExtincao));}
	$PalavrasChave = $acao->PalavrasChave;
	$ProcessoPai = $acao->ProcessoPai;
	$PosicaoNovacap = $acao->PosicaoNovacap;
	$autorAcao = $acao->Autor;
	$reuAcao = $acao->Reu;
	$ProcSEI = $acao->SEI;
	if($ProcSEI != ""){ //00112-00005028/2018-31
	    $parte1 = substr($ProcSEI, 0, 5);
	    $parte2 = substr($ProcSEI, 5, 8);
	    $parte3 = substr($ProcSEI, 13, 4);
	    $parte4 = substr($ProcSEI, 17, 2);
	    $ProcSEI = $parte1.'-'.$parte2.'/'.$parte3.'-'.$parte4;
	}else{$ProcSEI = '';}
endforeach;

//Label pra aba ações
if(!empty($acoestipo)&&(sizeof($acoestipo)>0)){
	foreach ($acoestipo as $tipo):
		if($AcaoTipoId==$tipo->Id){
			$NomeTipoAcao = $tipo->Descricao;
		}
	endforeach;
	$AcaoAssuntos = utf8_decode('AÇÃO ').$NomeTipoAcao.' - <br><br>Processo Administrativo: '.$ProcessoAdmin.', Processo Judidical: '.$PrJudicial;
}else{
	$AcaoAssuntos = '';
}

$ProbPerda = array( //Manter probabilidade de perdas padrão.
    array(
        'Id' => 1,
        'Descricao' => utf8_decode('PROVÁVEL')
    ),
    array(
        'Id' => 2,
        'Descricao' => utf8_decode('POSSÍVEL')
    ),
        array(
        'Id' => 3,
        'Descricao' => 'REMOTA'
    )
);?>

<script language="JavaScript">
function validacaocivel(){
	prjud = document.formacaocivel.prjud_cnj.value; /* 0001069-77.2016.5.10.0010 - char[25] */
	var prsei = document.formacaocivel.prsei.value;
	if(prjud==""){
		alert("Por favor, preencha todos os campos obrigat\u00f3rios!");
		return false;
	}
	if(prjud.length != 25){
		alert("Processo judicial inv\u00e1lido!");
		return false;
	}

	if(prsei != ""){
		if(prsei.length != 22){ //contagem bruta, considerar para crítica apenas os números.
			alert("Processo SEI deve ter exatamente 19 d\u00edgitos!");
			document.formacaocivel.prsei.focus();
			return false;
		}
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

function validandamento(){
	dtandamento = document.formandamento.dtandamento.value;
	andamentoid = document.formandamento.andamentoid.value;
	if ((dtandamento=="")||(andamentoid=="")){
		alert("Por favor, preencha todos os campos!");
		return false;
	}
}

function validaprazo(){
	dt = document.formprazo.dtprazo.value;
	desc = document.formprazo.descprazo.value;
	obs = document.formprazo.obsprazo.value;
	conc = document.formprazo.prazoconcluido.value;
	if ((dt=="")||(desc=="")){
		alert("Por favor, preencha todos os campos obrigat\u00f3rios!");
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

function excluiandamento(AcaoId,IdRegAnd){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>candamento/delete/"+AcaoId+"/"+IdRegAnd;
	} else {
		return false;
	}
}

function excluiprazo(AcaoId,IdPrazo){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>cprazo/delete/"+AcaoId+"/"+IdPrazo;
	} else {
		return false;
	}
}

function alterastatus(IdPrazo,Concluido,IdAcao){
	var confirma = confirm("Deseja realmente alterar o status deste prazo?")
	if (confirma){
		window.location = "<?php echo base_url();?>cjuridico/status_prazo_acao_detail/"+IdPrazo+"/"+Concluido+"/"+IdAcao;
	} else {
		return false;
	}
}
</script>

<script language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("#capaefectos").hide();
	$("#ocultar").click(function(event){
	  event.preventDefault();
	  $("#capaefectos").hide();
	  //$("#capaefectos").hide("slow"); //efeito devagar
	});

	$("#mostrar1").click(function(event){
	  event.preventDefault();
	  $("#capaefectos").show(30);
	});

	$("#mostrar2").click(function(event){
	  event.preventDefault();
	  $("#capaefectos").show(30);
	});

	$("#mostrar3").click(function(event){
	  event.preventDefault();
	  $("#capaefectos").show(30);
	});

	$("#mostrar4").click(function(event){
	  event.preventDefault();
	  $("#capaefectos").show(30);
	});

	$("#mostrar5").click(function(event){
	  event.preventDefault();
	  $("#capaefectos").show(30);
	});
});
</script>
<?php
//print_r($interessadoEoutros);
if(!empty($interessadoEoutros)&&(sizeof($interessadoEoutros)>0)){
	foreach ($interessadoEoutros as $ints):
		//$IdRegInter = $ints->Id;
		$AcoesInterId = $ints->AcoesId;
		$InteressadoEoutros = $ints->InteressadoNome;
	endforeach;
}else{
	$AcoesInterId = '';
	$InteressadoEoutros = '';
}?>
<fieldset class=visible style='width:938px;margin-left:0px;background-color: #87CEFA;'>
	<font size="5">Alteração de ação cível</font>
</fieldset>

<div id="capaefectos">
<?php include 'view_acao_civel_detail_titulo.php'?>
</div>

<div id="caixa7">
<div id="tabs">
<fieldset class='visible' style='width:938px; margin-left:-3px; margin-top: -3px;'>
<form method="post" action="<?php echo base_url();?>cacaocivel/saveacaocivel" name="formacaocivel" onsubmit="return validacaocivel()">
<input type="hidden" name="idacao" id="idacao" value="<?php echo $IdAcao;?>" size="10"/>

<div class="row">
	<div class="label">Autor</div>
	<div class="field">
		<input type="text" name="fundlegal" id="fundlegal" value="<?php echo $autorAcao?>" size="100" style="text-transform: uppercase;background-color:#F2F2F2;" readonly/>
	</div>
</div>

<div class="row">
	<div class="label">R&eacute;u</div>
	<div class="field">
		<input type="text" name="fundlegal" id="fundlegal" value="<?php echo $reuAcao?>" size="100" style="text-transform: uppercase;background-color:#F2F2F2;" readonly/>
	</div>
</div>

<div class="row">
	<div class="label">Processo judicial</div>
	<div class="field">
		<input type="text" name="prjudantigo" id="prjudantigo" maxlength="25" size="27"  value="<?php echo $PrJudicialAnt?>" style="text-transform: uppercase;" required/>
	</div>
	&nbsp;&nbsp;
	CNJ
	<div class="field">
		<input type="text" name="prjud_cnj" id="prjud_cnj" maxlength="25" size="27"  value="<?php echo $ProcessoJud?>" onkeypress='MaskPrJud(this, event); return SomenteNumero(event)'/>
	</div>
</div>

<div class="row">
	<div class="label">Processo admin.</div>
	<div class="field">
		<input type="text" name="pradm" id="pradm" value="<?php echo $ProcessoAdmin?>" size="15" maxlength="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)'/>
	</div>
	&nbsp;
	Processo SEI
	<div class="field">
		<input type="text" name="prsei" id="prsei" maxlength="22" size="23" value="<?php echo $ProcSEI?>" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)'/>
	</div>
</div>

<div class="row">
	<div class="label">Fundamento Legal</div>
	<div class="field">
		<input type="text" name="fundlegal" id="fundlegal" value="<?php echo $FundamentoLegal?>" maxlength="50" size="80" style="text-transform: uppercase;"/>
	</div>
</div>

<div class="row">
	<div class="label">C&aacute;lculo homologado</div>
	<div class="field">
		<input type="text" name="calchomovalor" id="calchomovalor" size="16" value="<?php echo $CalculoHomologadoValor?>" onKeyPress="return MascaraMoeda(this,'.',',',event);" required/>
	</div>
	&nbsp;&nbsp;
	C&aacute;lculo homologado Tipo
	<div class="field">
		<select name="calchomovalortipo" required>
			<option value=""></option>
			<?php foreach ($auxvalorestipo as $vrltipo):
				if($vrltipo->Id==$CalculoHomologadoValorTipo){ ?>
					<option value="<?php echo $vrltipo->Id;?>" selected><?php echo $vrltipo->Descricao?></option>
        <?php }else{ ?>
  				<option value="<?php echo $vrltipo->Id;?>"><?php echo $vrltipo->Descricao?></option>
  			<?php } endforeach; ?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Valor da causa</div>
	<div class="field">
		<input type="text" name="causavalor" id="causavalor" size="16" value="<?php echo $CausaValor?>" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
	&nbsp;&nbsp;
	Causa valor Tipo
	<div class="field">
		<select name="causavalortipo" required>
			<option value=""></option>
			<?php foreach ($auxvalorestipo as $vrltipo):
				if($vrltipo->Id==$CausaValorTipo){ ?>
					<option value="<?php echo $vrltipo->Id;?>" selected><?php echo $vrltipo->Descricao?></option>
			<?php }else{ ?>
				<option value="<?php echo $vrltipo->Id;?>"><?php echo $vrltipo->Descricao?></option>
			<?php } endforeach; ?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Valor da senten&ccedil;</div>
	<div class="field">
		<input type="text" name="sentencavalor" id="sentencavalor" size="16" value="<?php echo $SentencaValor?>" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
	&nbsp;&nbsp;
	Senten&ccedil;a valor Tipo
	<div class="field">
		<select name="sentensavalortipo" required>
			<option value=""></option>
			<?php foreach ($auxvalorestipo as $vrltipo):
				if($vrltipo->Id==$SentencaValorTipo){ ?>
					<option value="<?php echo $vrltipo->Id;?>" selected><?php echo $vrltipo->Descricao?></option>
			<?php }else{ ?>
				<option value="<?php echo $vrltipo->Id;?>"><?php echo $vrltipo->Descricao?></option>
			<?php } endforeach; ?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Valor do ac&oacute;rd&atilde;o</div>
	<div class="field">
		<input type="text" name="acordamvalor" id="acordamvalor" size="16" value="<?php echo $AcordaoValor?>" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
	&nbsp;&nbsp;
	Acord&atilde;o valor Tipo
	<div class="field">
		<select name="acordamvalortipo" required>
			<option value=""></option>
			<?php foreach ($auxvalorestipo as $vrltipo):
				if($vrltipo->Id==$AcordaoValorTipo){?>
				<option value="<?php echo $vrltipo->Id;?>" selected><?php echo $vrltipo->Descricao?></option>
			<?php }else{ ?>
				<option value="<?php echo $vrltipo->Id;?>"><?php echo $vrltipo->Descricao?></option>
			<?php } endforeach; ?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Valor condena&ccedil;&atilde;o</div>
	<div class="field">
		<input type="text" name="condenavalor" id="condenavalor" size="16" value="<?php echo $CondenacaoValor?>" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
	&nbsp;&nbsp;
	Condena&ccedil;&atilde;o valor Tipo
	<div class="field">
		<select name="condenacaovalortipo" required>
			<option value=""></option>
			<?php foreach ($auxvalorestipo as $vrltipo):
				if($vrltipo->Id==$CondenacaoValorTipo){?>
				<option value="<?php echo $vrltipo->Id;?>" selected><?php echo $vrltipo->Descricao?></option>
			<?php }else{ ?>
				<option value="<?php echo $vrltipo->Id;?>"><?php echo $vrltipo->Descricao?></option>
			<?php } endforeach;?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Vara</div>
	<div class="field">
		<select name="varaid" required>
			<option value=""></option>
			<?php foreach ($varas as $vr):
				if($vr->VaraId==$VaraId){ ?>
					<option value="<?php echo $vr->VaraId;?>" selected><?php echo utf8_encode($vr->Descricao)?></option>
			<?php }else{ ?>
				<option value="<?php echo $vr->VaraId;?>"><?php echo utf8_encode($vr->Descricao)?></option>
			<?php } endforeach;?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Probab. de perda</div>
	<div class="field">
		<select name="probabilidadeid">
			<option value=""></option>
			<?php foreach ($ProbPerda as $prob):
				if($prob['Id']==$ProbaDePerdaId){?>
					<option value="<?php echo $prob['Id'];?>" selected><?php echo utf8_encode($prob['Descricao'])?></option>
			<?php }else{ ?>
				<option value="<?php echo $prob['Id'];?>"><?php echo utf8_encode($prob['Descricao'])?></option>
			<?php } endforeach;?>
		</select>
	</div>
	&nbsp;&nbsp;&nbsp;&nbsp;
	Posi&ccedil;&atilde;o da Novacap no processo
	<div class="field">
		<?php if($PosicaoNovacap==1){?>
			<input type="radio" name="posicaonovacap" value="1" checked/>Autora
			<input type="radio" name="posicaonovacap" value="2"/>R&eacute;
		<?php }else if($PosicaoNovacap==2){?>
			<input type="radio" name="posicaonovacap" value="1"/>Autora
			<input type="radio" name="posicaonovacap" value="2" checked/>R&eacute;
		<?php }else{?>
			<input type="radio" name="posicaonovacap" value="1"/>Autora
			<input type="radio" name="posicaonovacap" value="2"/>R&eacute;
		<?php }?>
	</div>
</div>

<div class="row">
	<div class="label">Observa&ccedil;&otilde;es</div>
	<div class="field">
		<textarea name="observacao" rows="3" cols="100" maxlength="255" style="text-transform:uppercase;"><?php echo $ObsAcaoCivil?></textarea>
	</div>
</div>

<div class="row">
	<div class="label">Status do processo</div>
	<div class="field">
		<select name="statusprocessoid" required>
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
	&nbsp;&nbsp;
	Data ajuizamento
	<div class="field">
		<input type="text" value="<?php echo $DtAjuiz?>" name="dtajuizamento" id="dtajuizamento" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formacaocivel.dtajuizamento,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
		<a onclick="document.getElementById('dtajuizamento').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url();?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
	</div>
	&nbsp;&nbsp;
	Data extin&ccedil;&atilde;o
	<div class="field">
		<input type="text" value="<?php echo $DataDeExtincao?>" name="dtextincao" id="dtextincao" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formacaocivel.dtextincao,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
		<a onclick="document.getElementById('dtextincao').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url();?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
	</div>
	&nbsp;&nbsp;
	Sisprot
	<div class="field">
		<input type="text" name="sisprot" id="sisprot" value="<?php echo $Sisprot?>" size="8" maxlength="8" onkeypress='return SomenteNumero(event)'/>
	</div>
</div>

<div class="row">
	<div class="label">Caixa n&uacute;mero</div>
	<div class="field">
		<input type="text" name="cxnum" id="cxnum" size="3" maxlength="4" value="<?php echo $Caixa?>" onkeypress='return SomenteNumero(event)'/>
	</div>
	&nbsp;&nbsp;
	Palavras chave
	<div class="field">
		<input type="text" name="palavraschave" id="palavraschave" size="60" maxlength="60" value="<?php echo $PalavrasChave?>"/>
	</div>
</div>

<div class="row">
	<div class="label">Processo pai</div>
	<div class="field">
		<input type="text" name="prpai" id="prpai" maxlength="25" size="27" value="<?php echo $ProcessoPai?>" onkeypress='MaskPrJud(this, event); return SomenteNumero(event)'/>
	</div>
</div>

<br><hr>
<div class="row">
<?php
if ($acessoNivel == 2) { ?>
<input type="submit" name="Gravar" value="Gravar" class="botao" style="text-decoration:none;"/>
<?php } ?>
<a href="<?php echo base_url()."cacaocivel/detailacaocivel/".$IdAcao;?>" style="text-decoration:none;"><input type="button" value="Cancelar" onclick="location.href('<?php echo base_url()."cacaocivel/detailacaocivel/".$IdAcao;?>')" class="botao"></a>
</fieldset>
</div>
</div>
</div>
<?php $this->load->view('view_rodape');?>
