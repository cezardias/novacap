<?php
$this->load->view('view_cabecalho');
$attributes = array('name' =>  'calendar');?>

<script language="JavaScript">
function validassunto(){
	assunto = document.formassunto.assuntoid.value;
	if (assunto==""){
		alert("Por favor, escolha um assunto!");
		return false;
	}
}

function validainteressado(){
	IdParte = document.forminteressado.IdParte.value;
	tipo = document.forminteressado.interessadotipo.value;

	if((IdParte=="")||(tipo=="")){
		alert("Por favor, informe o interesasdo e o tipo!");
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

function assuntoprincipal(AcoesId,AssuntoId,AcaoTipoId){
	var confirma = confirm("Deseja realmente tornar esse assunto como o principal da Ação?")
	if (confirma){
		window.location = "<?php echo base_url();?>cjuridico/updateprincipal/"+AcoesId+"/"+AssuntoId+"/"+AcaoTipoId;
	} else {
		return false;
	}
}

function excluinteressado(AcoesInterId,IdRegInter,AcaoTipoId){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>cinteressado/delete/"+AcoesInterId+"/"+IdRegInter+"/"+AcaoTipoId;
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

function solicitaprocesso(AdvogadoProcLocal){
	var advprocloc = String(AdvogadoProcLocal);
	//alert(AcoesId);
	//alert(Codigo);
	alert(advprocloc);
	//var confirma = confirm("Deseja realmente excluir este registro?")
	//if (confirma){
		//window.location = "<?php echo base_url();?>cprazo/delete/"+AcaoId+"/"+IdPrazo;
	//} else {
		//return false;
	//}
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
	$("#mostrar6").click(function(event){
	  event.preventDefault();
	  $("#capaefectos").show(30);
	});
});
</script>

<?php
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

	$PrPai = $acao->ProcessoPai;
	if($PrPai != ""){ //0000818-14.2015.5.10.0004
		$p1 = substr($PrPai,0,7);
		$p2 = substr($PrPai,7,2);
		$p3 = substr($PrPai,9,4);
		$p4 = substr($PrPai,13,1);
		$p5 = substr($PrPai,14,2);
		$p6 = substr($PrPai,16,4);
		$ProcessoPai = $p1.'-'.$p2.'.'.$p3.'.'.$p4.'.'.$p5.'.'.$p6;
	}else{$ProcessoPai = "";}

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
	$CausaValor = $acao->CausaValor; if($CausaValor != ""){$CausaValor = number_format($CausaValor, 2, ',', '.');}else{$CausaValor="0,00";}
	$ValorEconomicoDoRisco = $acao->ValorEconomicoDoRisco; 
	$SentencaValor = $acao->SentencaValor; if($CausaValor != ""){$SentencaValor = number_format($SentencaValor, 2, ',', '.');}else{$SentencaValor="0,00";}
	$CondenacaoValor = $acao->CondenacaoValor; if($CausaValor != ""){$CondenacaoValor = number_format($CondenacaoValor, 2, ',', '.');}else{$CondenacaoValor="0,00";}
	$AcordaoValor = $acao->AcordaoValor; if($AcordaoValor != ""){$AcordaoValor = number_format($AcordaoValor, 2, ',', '.');}else{$AcordaoValor="0,00";}
	$ProbaDePerdaId = $acao->ProbabilidadeDePerdaId;
	$FundamentoLegal = utf8_encode($acao->FundamentoLegal);
	$Observacoes = utf8_encode($acao->Observacoes);
	$Ativo = $acao->Ativo;
	$Caixa = $acao->Caixa; if($Caixa==""){$Caixa='';}
	$DtAjuiz =  $acao->DataDoAjuizamento;
	if($DtAjuiz==""){$DtAjuiz='';}else{$DtAjuiz = date('d/m/Y',strtotime($DtAjuiz));}
	$DataDeExtincao = $acao->DataDeExtincao; if($DataDeExtincao==""){$DataDeExtincao='';}else{$DataDeExtincao = date('d/m/Y',strtotime($DataDeExtincao));}
	$CausaData = $acao->CausaData; if($CausaData==""){$CausaData='';}else{$CausaData = date('d/m/Y',strtotime($CausaData));}
	$SentencaData = $acao->SentencaData; if($SentencaData==""){$SentencaData='';}else{$SentencaData = date('d/m/Y',strtotime($SentencaData));}
	$AcordaoData = $acao->AcordaoData; if($AcordaoData==""){$AcordaoData='';}else{$AcordaoData = date('d/m/Y',strtotime($AcordaoData));}
	$CalculoHomologadoData = $acao->CalculoHomologadoData; if($CalculoHomologadoData==""){$CalculoHomologadoData='';}else{$CalculoHomologadoData = date('d/m/Y',strtotime($CalculoHomologadoData));}
	$CondenacaoData = $acao->CondenacaoData; if($CondenacaoData==""){$CondenacaoData='';}else{$CondenacaoData = date('d/m/Y',strtotime($CondenacaoData));}
	$Sisprot = $acao->Sisprot;
	if(($Sisprot=="")||($Sisprot=='NULL')){$Sisprot='';}
	$PosicaoNovacap = $acao->PosicaoNovacap;
	if(($PosicaoNovacap=="")||($PosicaoNovacap=='NULL')){$PosicaoNovacap='';}
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
	$InsercaoData = $acao->InsercaoData;
endforeach;

foreach ($localizaproc as $locproc):
	$Codigo = $locproc->Codigo;
	///echo $AdvogadoProcLocal = $locproc->Advogado;
	$AdvogadoProcLocal = 'AAAAAAA';
endforeach;

//Label pra aba acoes
if(!empty($acoestipo)&&(sizeof($acoestipo)>0)){
	foreach ($acoestipo as $tipo):
		if($AcaoTipoId==$tipo->Id){
			$NomeTipoAcao = $tipo->Descricao;
		}
	endforeach;
	$AcaoAssuntos = 'A&Ccedil;&Atilde;O '.$NomeTipoAcao.' - <br><br>Processo Administrativo: '.$ProcessoAdmin.', Processo Judidical: '.$PrJudicial;
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
);

function mask($val, $mask) {
    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; $i++) {
        if ($mask[$i] == '#') {
            if (isset ($val[$k]))
                $maskared .= $val[$k++];
        } else {
            if (isset ($mask[$i]))
                $maskared .= $mask[$i];
        }
    }
    return $maskared;
}
/* MASCARS PARA A FUNC ACIMA
echo mask($cnpj, '##.###.###/####-##');
echo mask($cpf, '###.###.###-##');
echo mask($cep, '#####-###');
echo mask($data, '##/##/####'); */?>

<fieldset class=visible style='width:938px;margin-left:0;background-color: #87CEFA;'>
	<font size="5">Detalhamento de ação trabalhista</font>
</fieldset>

<div id="capaefectos">
<?php include 'view_acao_detail_titulo.php'?>
</div>

<div id="caixa7">
<div id="tabs">
<ul>
	<li><a href="#tabs-1" id="ocultar">A&ccedil;&atilde;o</a></li>
	<li><a href="#tabs-2" id="mostrar1">Interessados</a></li>
	<li><a href="#tabs-3" id="mostrar2">Assuntos</a></li>
	<li><a href="#tabs-4" id="mostrar3">Audi&ecirc;ncias</a></li>
	<li><a href="#tabs-5" id="mostrar4">Andamentos</a></li>
	<li><a href="#tabs-6" id="mostrar5" onLoad="window.open(this.href,'_self')">Prazos</a></li>
	<li><a href="#tabs-7" id="mostrar6">Extrato de Contigênciamento</a></li>
</ul>
<fieldset class='visible' style='width:933px'>
<div id="tabs-1">
<fieldset class='visible' style='width:875px'>
<input type="hidden" name="idacao" id="idacao" value="<?php echo $IdAcao;?>" maxlength="10" size="10"/>

<div class="row">
	<div class="label">Autor<font style="color:white; font-size:7;"> &#10054;</font></div>
	<div class="field">
		<input type="text" name="fundlegal" id="fundlegal" value="<?php echo $autorAcao?>" size="100" style="text-transform: uppercase;background-color:#F2F2F2;" readonly/>
	</div>
</div>

<div class="row">
	<div class="label">R&eacute;u<font style="color:white; font-size:7;"> &#10054;</font></div>
	<div class="field">
		<input type="text" name="fundlegal" id="fundlegal" value="<?php echo $reuAcao?>" size="100" style="text-transform: uppercase;background-color:#F2F2F2;" readonly/>
	</div>
</div>

<div class="row">
	<!-- <div class="label">Tipo</div>
	<div class="field">
		<?php foreach ($acoestipo as $tipo):
		if($AcaoTipoId==$tipo->Id){?>
			<input type="text" name="tipoacaoid" id="tipoacaoid" size="12"  value="<?php echo $tipo->Descricao;?>" readonly style="background-color:#F2F2F2;"/>
		<?php } endforeach;?>
	</div> -->
	<div class="label">Processo judicial</div>
	<div class="field">
		<input type="text" name="prjud" id="prjud" maxlength="25" size="25"  value="<?php echo $ProcessoJud;?>" readonly style="background-color:#F2F2F2;"/>
	</div>
	&nbsp;
	Processo admin.
	<div class="field">
		<input type="text" name="pradm" id="pradm" size="18" value="<?php echo $ProcessoAdmin;?>" readonly style="background-color:#F2F2F2;"/>
	</div>
	&nbsp;
	Proc. SEI
	<div class="field">
		<input type="text" name="prsei" id="prsei" maxlength="22" size="23" value="<?php echo $ProcSEI?>" readonly style="background-color:#F2F2F2;text-transform: uppercase;"/>
	</div>
</div>

<div class="row">
	<div class="label">Fundamento Legal</div>
	<div class="field">
		<input type="text" name="fundlegal" id="fundlegal" value="<?php echo $FundamentoLegal;?>" maxlength="50" size="80" readonly style="background-color:#F2F2F2;text-transform: uppercase;"/>
	</div>
</div>

<!--<div class="row">
	<div class="label">C&aacute;lculo homologado</div>
	<div class="field">
		<input type="text" name="calchomovalor" id="calchomovalor" size="10"  value="<?php echo $CalculoHomologadoValor;?>" onKeyPress="return MascaraMoeda(this,'.',',',event);" readonly style="background-color:#F2F2F2;text-align:right;"/>
	</div>
	&nbsp;
	Valor da causa
	<div class="field">
		<input type="text" name="causavalor" id="causavalor" size="10"  value="<?php echo $CausaValor;?>" onKeyPress="return MascaraMoeda(this,'.',',',event);" readonly style="background-color:#F2F2F2;text-align:right;"/>
	</div>
	&nbsp;
	Valor senten&ccedil;a
	<div class="field">
		<input type="text" name="sentencavalor" id="sentencavalor" size="10" value="<?php echo $SentencaValor;?>" onKeyPress="return MascaraMoeda(this,'.',',',event);" readonly style="background-color:#F2F2F2;text-align:right;"/>
	</div>
</div>

<div class="row">
	<div class="label">Valor ac&oacute;rd&atilde;o</div>
	<div class="field">
		<input type="text" name="acordaovalor" id="acordaovalor" size="10"  value="<?php echo $AcordaoValor?>" onKeyPress="return MascaraMoeda(this,'.',',',event);" readonly style="background-color:#F2F2F2;text-align:right;"/>
	</div>
	&nbsp;
	Valor condena&ccedil;&atilde;o
	<div class="field">
		<input type="text" name="condenavalor" id="condenavalor" size="10"  value="<?php echo $CondenacaoValor;?>" onKeyPress="return MascaraMoeda(this,'.',',',event);" readonly style="background-color:#F2F2F2;text-align:right;"/>
	</div>
</div>-->

<div class="row">
	<div class="label">Vara - advogado(a)</div>
	<div class="field">
		<?php foreach ($varas as $vr):
		if($VaraId==$vr->VaraId){?>
			<input type="text" name="vara" id="varaid" size="65"  value="<?php echo utf8_encode($vr->Descricao)?>" readonly style="background-color:#F2F2F2;"/> -
			<input type="text" name="advogado" id="advogado" size="25"  value="<?php echo utf8_encode($vr->Nome)?>" readonly style="background-color:#F2F2F2;"/>
		<?php }
		endforeach; ?>
	</div>
</div>

<div class="row">
	<div class="label">Probab. de perda</div>
	<div class="field">
		<?php foreach ($ProbPerda as $prob):
		if($ProbaDePerdaId == $prob['Id']){?>
			<input type="text" name="probabilidadeid" id="probabilidadeid" size="15"  value="<?php echo utf8_encode($prob['Descricao'])?>" readonly style="background-color:#F2F2F2;"/>
		<?php }
		endforeach;?>
	</div>
	&nbsp;&nbsp;&nbsp;&nbsp;
	Posi&ccedil;&atilde;o da Novacap no processo
	<div class="field">
		<?php if($PosicaoNovacap==1){?>
			<input type="radio" name="posicaonovacap" value="1" checked disabled/>Autora
			<input type="radio" name="posicaonovacap" value="2" disabled/>R&eacute;
		<?php }else if($PosicaoNovacap==2){?>
			<input type="radio" name="posicaonovacap" value="1" disabled/>Autora
			<input type="radio" name="posicaonovacap" value="2" checked disabled/>R&eacute;
		<?php }else{?>
			<input type="radio" name="posicaonovacap" value="1" disabled/>Autora
			<input type="radio" name="posicaonovacap" value="2" disabled/>R&eacute;
		<?php }?>
	</div>
</div>

<div class="row">
	<div class="label">Observa&ccedil;&otilde;es</div>
	<div class="field">
		<textarea name="observacao" rows="3" cols="95" readonly style="background-color:#F2F2F2;text-transform: uppercase;"><?php echo $Observacoes;?></textarea>
	</div>
</div>

<div class="row">
	<div class="label">Status do processo</div>
	<div class="field">
		<?php if($Ativo==1){?>
			<input type="text" name="probabilidadeid" id="probabilidadeid" size="15"  value="ATIVO" readonly style="background-color:#F2F2F2;"/>
		<?php } else{?>
			<input type="text" name="probabilidadeid" id="probabilidadeid" size="15"  value="INATIVO" readonly style="background-color:#F2F2F2;"/>
		<?php } ?>
	</div>
	&nbsp;
	Data de ajuizamento
	<div class="field">
		<input type="text" value="<?php echo $DtAjuiz;?>" name="dtajuizamento" id="dtajuizamento" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly style="background-color:#F2F2F2;"/>
	</div>
	Data extin&ccedil;&atilde;o
	<div class="field">
		<input type="text" value="<?php echo $DataDeExtincao?>" name="dtextincao" id="dtextincao" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly style="background-color:#F2F2F2;"/>
	</div>
	&nbsp;
	Sisprot
	<div class="field">
		<input type="text" name="sisprot" id="sisprot" value="<?php echo $Sisprot;?>" size="8" maxlength="8" onkeypress='return SomenteNumero(event)' readonly style="background-color:#F2F2F2;"/>
	</div>
</div>

<div class="row">
	<div class="label">Caixa n&uacute;mero</div>
	<div class="field">
		<input type="text" name="cxnum" id="cxnum" value="<?php echo $Caixa;?>" size="3" maxlength="4" onkeypress='return SomenteNumero(event)' readonly style="background-color:#F2F2F2;"/>
	</div>
	&nbsp;&nbsp;
	Processo pai
	<div class="field">
		<input type="text" name="prpai" id="prpai" maxlength="25" size="24"  value="<?php echo $ProcessoPai;?>" readonly style="background-color:#F2F2F2;"/>
	</div>
	&nbsp;&nbsp;
	Valor Econômico do Risco
	<div class="field">
		<input type="text" name="prpai" id="prpai" maxlength="25" size="24"  value="<?php echo $ValorEconomicoDoRisco;?>" readonly style="background-color:#F2F2F2;"/>
	</div>
</div>
<br>
<?php if($InsercaoData!=""){ ?>
  <div style="text-align:right; width:870px;">
    <?php echo '<b><em>Registrado no SISJUR em: '.$InsercaoData = date('d/m/Y',strtotime($InsercaoData)).'</em></b>'?>
  </div>
<?php } ?>
<hr>
<div class="row">
<?php
if(($_SESSION['Admin']==1)||($_SESSION['Nivel1']==1)){ //1 JURÍDICO - ADMINISTRADOR
$btnvoltar = $this->session->userdata('btnvoltar');
if($btnvoltar=='buscaudienciaresult'){ //VOLTAR PARA BUSCA POR AUDIÊNCIAS. ?>
<a href="<?php echo base_url()."cjuridico/buscaudienciaresult/";?>" style="text-decoration:none;">
	<input type="button" value="Voltar" onclick="location.href('<?php echo base_url()."cjuridico/buscacaotrabresult/";?>')" class="botao">
</a>
<a href="<?php echo base_url()."cjuridico/editacaotrab/".$IdAcao;?>" style="text-decoration:none;">
	<input type="button" value="Alterar" onclick="location.href('<?php echo base_url()."cjuridico/editacaotrab/".$IdAcao;?>')" class="botao">
</a>
<?php }
if($btnvoltar=='buscacaotrabresult'){ //VOLTAR PARA BUSCA POR AUDIÊNCIAS. ?>
<a href="<?php echo base_url()."cjuridico/buscacaotrabresult/";?>" style="text-decoration:none;">
	<input type="button" value="Voltar" onclick="location.href('<?php echo base_url()."cjuridico/buscacaotrabresult/";?>')" class="botao">
</a>
<a href="<?php echo base_url()."cjuridico/editacaotrab/".$IdAcao;?>" style="text-decoration:none;">
	<input type="button" value="Alterar" onclick="location.href('<?php echo base_url()."cjuridico/editacaotrab/".$IdAcao;?>')" class="botao">
</a>
<?php }
if($btnvoltar=='buscaprazosresult'){ //VOLTAR PARA BUSCA DE PRAZOS. ?>
<a href="<?php echo base_url()."cjuridico/buscaprazosresult/";?>" style="text-decoration:none;">
	<input type="button" value="Voltar" onclick="location.href('<?php echo base_url()."cjuridico/buscacaotrabresult/";?>')" class="botao">
</a>
<?php }
if($btnvoltar=='createacaotrab'){ //MOSTRAR ALTERAR APÓS CRIAR AÇÃO. ?>
<a href="<?php echo base_url()."cjuridico/editacaotrab/".$IdAcao;?>" style="text-decoration:none;">
	<input type="button" value="Alterar" onclick="location.href('<?php echo base_url()."cjuridico/editacaotrab/".$IdAcao;?>')" class="botao">
</a>
<?php }
} ?>
<a href="<?php echo base_url()."cjuridico/relatacaotrab/".$IdAcao;?>" style="text-decoration:none;" target="_blank">
	<input type="button" value="Imprimir" onclick="location.href('<?php echo base_url()."cjuridico/relatacaotrab/".$IdAcao;?>')" class="botao">
</a>
<a href="<?php echo base_url()."cjuridico/solautprocessoresult/".$IdAcao;?>" style="text-decoration:none;" target="_blank">
	<input type="button" value="Autuar processo" onclick="location.href('<?php echo base_url()."cjuridico/solautprocessoresult/".$IdAcao;?>')" class="botao">
</a>
<a href="<?php echo base_url()."cjuridico/buscacaotrabindex/";?>" style="text-decoration:none;">
	<input type="button" value="Pesquisar" onclick="location.href('<?php echo base_url()."cjuridico/buscacaotrabindex/";?>')" class="botao">
</a>
</div>
</fieldset>
</div>

<!-- segunda aba -->
<div id="tabs-2">
<fieldset class='visible' style='width:875px'>

<?php
if(($_SESSION['Admin']==1)||($_SESSION['Nivel1']==1)){ //1 JURÍDICO - ADMINISTRADOR
if($Ativo==1){ //Somente adicionar se ativo ?>
<fieldset class='visible' style='width:865px'>
<!-- ocultar e exibir div -->
<div class="divspoiler">
	<input type="button" value="Cadastrar interessado" class="tamanhobotao" onclick="if(this.parentNode.nextSibling.childNodes[0].style.display != '') { this.parentNode.nextSibling.childNodes[0].style.display = ''; this.value = 'Cancelar cadastro'; } else { this.parentNode.nextSibling.childNodes[0].style.display = 'none'; this.value = 'Cadastrar interessado'; }"/>
</div><div><div class="spoiler" style="display: none;"> <!-- Não pode mudar essa identação -->

<form method="post" action="<?php echo base_url();?>cjuridico/createinteressado" name="forminteressado" onsubmit="return validainteressado()">
<input type="hidden" name="idacao" id="idacao" size="16"  value="<?php echo $IdAcao;?>"/>
<input type="hidden" name="tipoacao" id="tipoacao" size="16"  value="<?php echo $AcaoTipoId;?>"/>

<h3>Cadastrar interessado</h3>

<div class="row">
	<div class="label">Interessado</div>
	<div class="field">
		<input type="text" name="NomeParte" id="NomeParte" value="" size="50" readonly onclick="javascript:window.open('<?php echo base_url()?>cpartes','popup_id','scrollbars,resizable,width=730,height=470');" style="cursor:pointer;cursor:hand"/>
		<input type="hidden" name="IdParte" id="IdParte"value="" size="16"/>&nbsp;
		<a onclick="javascript:window.open('<?php echo base_url()?>cpartes','popup_id','scrollbars,resizable,width=730,height=470');"><img src="<?php echo base_url()?>img/famfamfam/icons/application_form_magnify.png" border="0" style="cursor:pointer; cursor:hand"></a>&nbsp;
		<a onclick="document.getElementById('NomeParte').value='';document.getElementById('IdParte').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url()?>img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo fiscal"></a>
	</div>
</div>

<div class="row">
	<div class="label">Tipo</div>
	<div class="field">
      	<select name="interessadotipo" id="interessadotipo">
			<option value=""></option>
			<option value="1">AUTOR</option>
			<option value="2">R&Eacute;U</option>
		</select>
	</div>
</div>
<hr>
<input type="submit" value="Gravar interessado" class="botao"/>
</form>
</fieldset>
<?php } }?>

<fieldset class='visible' style='width:865px'>
<?php
if(!empty($interessadoacao)&&(sizeof($interessadoacao)>0)){?>
<h3>Interessados</h3>
	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>
				<td width=60%><b>Nome</b></td>
				<td width=20%><b>CPF/CNPJ</b></td>
				<td width=20% class="middle"><b>Tipo</b></td>
				<td width=10% class="middle"><b>Deletar</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>
		<tbody>
		<?php
		foreach($interessadoacao as $ass):
			$IdRegInter = $ass->Id;
			$AcoesInterId = $ass->AcoesId;
			$InteressadoNome = $ass->InteressadoNome;
			$InteressadoTipo = $ass->InteressadoTipo;
			$CpfCnpj = $ass->CpfCnpj;
			if(strlen($CpfCnpj)==11){
			    $CpfCnpjMask = mask($CpfCnpj,'###.###.###-##');
			}else if(strlen($CpfCnpj)==14){
			    $CpfCnpjMask = mask($CpfCnpj,'##.###.###/####-##');;
			}else{
			    $CpfCnpjMask = '-';
			}?>
			<tr style="border:0;">
				<td width=60% style="text-transform: uppercase;"><?php echo utf8_encode($InteressadoNome)?></td>
				<td width=20% style="text-transform: uppercase;"><?php echo $CpfCnpjMask;?></td>
				<?php if($InteressadoTipo==1){?>
					<td width=10% class="middle">AUTOR</td>
				<?php
				}else if($InteressadoTipo==2){ ?>
					<td width=10% class="middle">R&Eacute;U</td>
				<?php }
				if(($Ativo==1)&&(($_SESSION['Admin']==1)||($_SESSION['Nivel1']==1))){ //1 JURÍDICO - ADMINISTRADOR?>
				<td width=10% class="middle">
					<a href="#"	onclick='return excluinteressado(<?php echo $AcoesInterId;?>,<?php echo $IdRegInter;?>,<?php echo $AcaoTipoId;?>);' title="Deletar este registro."><img src="<?php echo base_url();?>img/icons/delete.png" alt="apagar" /></a>
				</td>
				<?php }else{?>
					<td width=10% class="middle">-</td>
				<?php } ?>
			</tr>
	<?php endforeach; ?>
		</tbody>
	</table>
<?php
}
else { ?>
<div class="status_box warning">
	<h6>Aviso!</h6>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Nenhum interessado cadastrado!
</div>
<?php }?>
</fieldset>
</div>

<!-- terceria coluna aba -->
<div id="tabs-3">
<fieldset class='visible' style='width:875px'>
<!-- <h3><?php echo $AcaoAssuntos;?></h3> -->
<?php
if(($_SESSION['Admin']==1)||($_SESSION['Nivel1']==1)){ //1 JURÍDICO - ADMINISTRADORif($Ativo==1){ //Somente adicionar se ativo 
if($Ativo==1){ //Somente adicionar se ativo?>
<fieldset class='visible' style='width:865px'>
<!-- ocultar e exibir div -->
<div class="divspoiler">
	<input type="button" value="Cadastrar assunto" class="tamanhobotao" onclick="if(this.parentNode.nextSibling.childNodes[0].style.display != '') { this.parentNode.nextSibling.childNodes[0].style.display = ''; this.value = 'Cancelar cadastro'; } else { this.parentNode.nextSibling.childNodes[0].style.display = 'none'; this.value = 'Cadastrar assunto'; }" />
</div><div><div class="spoiler" style="display: none;"> <!-- Não pode mudar essa identação -->

<form method="post" action="<?php echo base_url();?>cjuridico/createassunto" name="formassunto" onsubmit="return validassunto()">
<input type="hidden" name="idacao" id="idacao" size="16"  value="<?php echo $IdAcao;?>"/>
<input type="hidden" name="tipoacao" id="tipoacao" size="16"  value="<?php echo $AcaoTipoId;?>"/>

<h3>Cadastrar assunto</h3>
<div class="row">
	<div class="label">Escolha um assunto</div>
	<div class="field">
		<select class="inputbox" id="assuntoid" name="assuntoid" size="1" onchange="executaEventoonclick('elemento')">
			<option value=""></option>
			<?php foreach ($assuntos as $ass): ?>
				<option value="<?php echo $ass->Id;?>"><?php echo utf8_encode($ass->Descricao)?></option>
			<?php endforeach;?>
		</select>&nbsp;
	</div>
</div>

<!-- DIV fica escondida enquanto algum clique no SELECT -->
<div class="row" id="elemento">
	<div class="label">Paradigma</div>
	<div class="field">
		<input type="text" name="paradigma" id="paradigma" value="" size="70" maxlength="100" style="text-transform: uppercase;" autofocus/>
	</div>
</div>
<br>
<input type="submit" value="Gravar assunto" class="botao"/>
</form>
</fieldset>
<?php } }?>
<fieldset class='visible' style='width:865px'>
<?php
if(!empty($acao_assuntos)&&(sizeof($acao_assuntos)>0)){?>
<h3>Assuntos</h3>
	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>
				<td width=45%><b>Assunto</b></td>
				<td width=45%><b>Paradigma</b></td>
				<td width=10% class="middle"><b></b></td>
				<td width=10% class="middle"><b>Deletar</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>
		<tbody>
		<?php
		foreach($acao_assuntos as $ass):
			$IdRegAssunto = $ass->Id; //não confundir com IdAssunto.
			$AcoesId = $ass->AcoesId;
			$AssuntoId = $ass->AssuntoId;
			$AssDescricao = $ass->Descricao;
			$Paradigma = $ass->Paradigma; if($Paradigma==""){$Paradigma="-";}
			$Principal = $ass->Principal;			
			$negrito = '';
			$destaca = '';
			if($Principal==1){
				$negrito = 'background-color:#FFFACD;';
				$destaca = '<font size="1"><b>(PRINCIPAL)</b></font>';
			}?>
			<tr style="border:0;<?php echo $negrito;?>">
				<td width=45% class="middle" style="text-align:left;"><?php echo utf8_encode($AssDescricao)?></td>
				<td width=45% class="middle" style="text-align:left;"><?php echo $Paradigma;?></td>
				<?php if(($Ativo==1)&&(($_SESSION['Admin']==1)||($_SESSION['Nivel1']==1))){ //1 JURÍDICO - ADMINISTRADOR?>
				<td width=5% class="middle">
				<?php if($Principal == 0){?>
					<a href="#"	onclick='return assuntoprincipal(<?php echo $AcoesId;?>,<?php echo $AssuntoId;?>,<?php echo $AcaoTipoId;?>);' title="Tornar como assunto principal."><img src="<?php echo base_url();?>img/icons/arrow_refresh.png" alt="Tornar como assunto principal" /></a>					
				<?php }?>
				</td>
				<td width=5% class="middle">
					<a href="#"	onclick='return excluiassunto(<?php echo $AcoesId;?>,<?php echo $IdRegAssunto;?>);' title="Deletar este registro."><img src="<?php echo base_url();?>img/icons/delete.png" alt="apagar" /></a>
				</td>
				<?php }else{ ?>
					<td width=5% class="middle"></td>
					<td width=5% class="middle">-</td>
				<?php } ?>
			</tr>
	<?php endforeach; ?>
		</tbody>
	</table>
<?php
}
else { ?>
<div class="status_box warning">
	<h6>Aviso!</h6>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Nenhum assunto cadastrado!
</div>
<?php }?>
</fieldset>
</fieldset>
</div>

<!-- quarta aba -->
<div id="tabs-4">
<fieldset class='visible' style='width:875px'>
<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel1']==1)){ //1 JURÍDICO - ADMINISTRADOR ?>
<!-- ocultar e exibir div -->
<fieldset class='visible' style='width:865px'>
<div class="divspoiler">
	<input type="button" value="Cadastrar audi&ecirc;ncia" class="tamanhobotao" onclick="if(this.parentNode.nextSibling.childNodes[0].style.display != '') { this.parentNode.nextSibling.childNodes[0].style.display = ''; this.value = 'Cancelar cadastro'; } else { this.parentNode.nextSibling.childNodes[0].style.display = 'none'; this.value = 'Cadastrar audi&ecirc;ncia'; }" />
</div><div><div class="spoiler" style="display: none;"> <!-- Não pode mudar essa identação -->

<h3>Cadastrar audi&ecirc;ncia</h3>
<form method="post" action="<?php echo base_url();?>cjuridico/createaudiencia" name="formaudiencia" onsubmit="return validaudiencia()">
<input type="hidden" name="idacao" id="idacao" size="16"  value="<?php echo $IdAcao;?>"/>
<input type="hidden" name="tipoacao" id="tipoacao" size="16"  value="<?php echo $AcaoTipoId;?>"/>

<div class="row">
<div class="label">Audi&ecirc;ncia data</div>
<div class="field">
<input type="text" value="" name="AudienciaData" id="AudienciaData" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formaudiencia.AudienciaData,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
	<a onclick="document.getElementById('AudienciaData').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url();?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
</div>
</div>

<div class="row">
	<div class="label">Audiencia hora</div>
	<div class="field">
		<select name="AudienciaHora">
			<option value=""></option>
			<option value="06">06</option>
			<option value="07">07</option>
			<option value="08">08</option>
			<option value="09">09</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
		</select>:
		<select name="AudienciaMin">
			<option value=""></option>
			<?php for($i=0;$i<60;$i++){?>
				<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
			<?php } ?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Audiência tipo</div>
	<div class="field">
      	<select name="audienciatipo" id="audienciatipo">
			<option value=""></option>
			<?php foreach ($tipoaudiencia as $aud):?>
				<option value="<?php echo $aud->Id?>"><?php echo utf8_encode($aud->Descricao)?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Preposto</div>
	<div class="field">
		<input type="text" name="preposto" id="preposto" value="" maxlength="30" size="30"/>
	</div>
</div>

<div class="row">
	<div class="label">Observa&ccedil;&otilde;es</div>
	<div class="field">
		<textarea name="audobs" id="audobs" rows="2" cols="80" maxlength="100" style="text-transform: uppercase;"></textarea>
	</div>
</div>
<hr>
<input type="submit" value="Gravar audiência" class="botao"/>
</form>
</fieldset>
<?php } if(!empty($alteraudiencia)){?>
<fieldset class='visible' style='width:865px'>
</fieldset>
<?php }else{ ?>

<fieldset class='visible' style='width:865px'>
<?php if(!empty($audiencias)&&(sizeof($audiencias)>0)){?>
<h3>Audi&ecirc;ncias</h3>
	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>
				<td width=15%><b>Data-hora</b></td>
				<td width=20%><b>Tipo</b></td>
				<td width=30%><b>Preposto</b></td>
				<td width=25%><b>Observa&ccedil;&atilde;o</b></td>
				<td width=5% class="middle"><b>Altera</b></td>
				<td width=5% class="middle"><b>Deleta</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>
		<tbody>
		<?php
		//print_r($audiencias);
		foreach($audiencias as $aud):
			$IdRegAud = $aud->Id;
			$AcaoId = $aud->AcaoId;
			$AudienciaDataHora = $aud->AudienciaDataHora;
			$AudienciaTipo = $aud->AudienciaTipoId;
			$AudienciaPreposto = $aud->AudienciaPreposto;
			$Observacao = $aud->Observacao; ?>
			<tr style="border:0;">
				<td width=15% class="middle" style="text-align:left;"><?php echo date('d/m/Y H:i',strtotime($AudienciaDataHora));?></td>
				<td width=20% class="middle" style="text-align:left; text-transform:uppercase;">
					<?php foreach ($tipoaudiencia as $tpaud):
						if($AudienciaTipo == $tpaud->Id){
							echo utf8_encode($tpaud->Descricao);
						}
						endforeach;
					?>
				</td>
				<td width=30% class="middle" style="text-align:left; text-transform:uppercase;"><?php echo utf8_encode($AudienciaPreposto)?></td>
				<td width=25% class="middle" style="text-align:left; text-transform:uppercase;"><?php echo utf8_encode($Observacao)?></td>
				<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel1']==1)){ //1 JURÍDICO - ADMINISTRADOR ?>
				<td class="middle" width=5%>
					<a href="<?php echo base_url(); ?>cjuridico/editaudiencia/<?php echo $AcaoId;?>/<?php echo $IdRegAud;?>" title="Alterar este registro.">
						<img src="<?php echo base_url();?>img/icons/pencil.png" alt="editar" />
					</a>
				</td>
				<td class="middle" width=5%>
					<a href="#"	onclick='return excluiaudiencia(<?php echo $AcaoId;?>,<?php echo $IdRegAud;?>);' title="Deletar este registro.">
						<img src="<?php echo base_url();?>img/icons/delete.png" alt="apagar" />
					</a>
				</td>
				<?php } else{?>
					<td class="middle" width=5%>-</td>
					<td class="middle" width=5%>-</td>
				<?php }?>
			</tr>
	<?php endforeach; ?>
		</tbody>
	</table>
<?php
} else { ?>
<div class="status_box warning">
	<h6>Aviso!</h6>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Nenhuma audi&ecirc;ncia cadastrada!
</div>
<?php }
} //caso não seja modo edição de audiência. ?>
</fieldset>
</fieldset>
</div>

<!-- quinta aba -->
<div id="tabs-5">
<fieldset class='visible' style='width:875px'>
<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel1']==1)){ //1 JURÍDICO - ADMINISTRADOR ?>
<!-- ocultar e exibir div -->
<fieldset class='visible' style='width:865px'>
<div class="divspoiler">
	<input type="button" value="Cadastrar andamento" class="tamanhobotao" onclick="if(this.parentNode.nextSibling.childNodes[0].style.display != '') { this.parentNode.nextSibling.childNodes[0].style.display = ''; this.value = 'Cancelar cadastro'; } else { this.parentNode.nextSibling.childNodes[0].style.display = 'none'; this.value = 'Cadastrar andamento'; }" />
</div><div><div class="spoiler" style="display: none;"> <!-- Não pode mudar essa identação -->

<h3>Cadastrar andamentos</h3>
<form method="post" action="<?php echo base_url();?>cjuridico/createandamento" name="formandamento" onsubmit="return validandamento()">
<input type="hidden" name="idacao" id="idacao" size="16"  value="<?php echo $IdAcao;?>"/>
<input type="hidden" name="tipoacao" id="tipoacao" size="16"  value="<?php echo $AcaoTipoId;?>"/>

<div class="row">
<div class="label">Data</div>
<div class="field">
<input type="text" value="" name="dtandamento" id="dtandamento" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formandamento.dtandamento,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
	<a onclick="document.getElementById('dtandamento').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url();?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
</div>
</div>

<div class="row">
	<div class="label">Hora / minuto</div>
	<div class="field">
		<select name="andamentohora">
			<option value=""></option>
			<option value="06">06</option>
			<option value="07">07</option>
			<option value="08">08</option>
			<option value="09">09</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
		</select>:
		<select name="andamentomin">
			<option value=""></option>
			<?php for($i=0;$i<60;$i++){?>
				<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
			<?php } ?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Andamento</div>
	<div class="field">
		<select name="andamentoid">
			<option value=""></option>
			<?php foreach ($auxandamentos as $and):?>
			<option value="<?php echo $and->Id?>"><?php echo utf8_encode($and->Descricao)?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Observa&ccedil;&otilde;es</div>
	<div class="field">
		<textarea name="obsandamento" rows="4" cols="100" maxlength="300" style="text-transform: uppercase;"></textarea>
	</div>
</div>
<hr>
<input type="submit" value="Gravar andamento" class="botao"/>
</form>
</div>
</div>
</fieldset>
<?php } ?>
<fieldset class='visible' style='width:865px'>
<?php
if(!empty($andamentos)&&(sizeof($andamentos)>0)){?>
<h3>Andamentos</h3>
	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>
				<td width=15%><b>Data-hora</b></td>
				<td width=40%><b>Andamento</b></td>
				<td width=35%><b>Observa&ccedil;&atilde;o</b></td>
				<td width=5%><b>Alterar</b></td>
				<td width=5%><b>Excluir</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>
		<tbody>
		<?php
		//print_r($andamentos);
		foreach($andamentos as $and):
			$IdRegAnd = $and->Id;
			$DataAndamento = $and->Data;
			$AuxAndamentoId = $and->AuxAndamentoId;
			$AcaoId = $and->AcoesId;
			$ObsAndamento = utf8_encode($and->Observacao)?>
			<tr style="border:0;">
				<td width=15% class="middle" style="text-align:left;"><?php echo date('d/m/Y H:i',strtotime($DataAndamento));?></td>
				<?php foreach ($auxandamentotodos as $andid):
				if($AuxAndamentoId == $andid->Id){ ?>
				<td width=40% class="middle" style="text-align:left; text-transform:uppercase;"><?php echo utf8_encode($andid->Descricao)?></td>
				<?php } endforeach;?>
				<td width=35% class="middle" style="text-align:left; text-transform:uppercase;"><?php echo $ObsAndamento?></td>
				<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel1']==1)){ //1 JURÍDICO - ADMINISTRADOR ?>
				<td class="middle" width=5%>
					<a href="<?php echo base_url(); ?>cjuridico/editandamento/<?php echo $AcaoId;?>/<?php echo $IdRegAnd;?>" title="Alterar este registro.">
						<img src="<?php echo base_url();?>img/icons/pencil.png" alt="editar" />
					</a>
				</td>
				<td class="middle" width=5%>
					<a href="#"	onclick='return excluiandamento(<?php echo $AcaoId;?>,<?php echo $IdRegAnd;?>);' title="Deletar este registro.">
						<img src="<?php echo base_url();?>img/icons/delete.png" alt="apagar" />
					</a>
				</td>
				<?php }else{?>
					<td class="middle" width=5%>-</td>
					<td class="middle" width=5%>-</td>
				<?php }?>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php
} else { ?>
<div class="status_box warning">
	<h6>Aviso!</h6>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Nenhum andamento cadastrado!
</div>
<?php } ?>
</fieldset>
</fieldset>
</div>

<!-- sexta aba -->
<div id="tabs-6">
<fieldset class='visible' style='width:875px'>
<?php 
foreach($advogadoalteraprazo as $acssPrzo):
	$AcaoId = $acssPrzo->AcaoId;
	$LoginAcao = $acssPrzo->UsuarioLogin;
endforeach;
$LoginSessao = $this->session->userdata('usuario');
//if($LoginAcao==$LoginSessao){ //SOMENTE O ADVOGADO RESPONSÁVEL PODE INCLUIR/ALTERAR PRAZOS
if(($_SESSION['Admin']==1)||($_SESSION['Nivel1']==1)){ //1 JURÍDICO - ADMINISTRADOR ?>
<!-- ocultar e exibir div -->
<fieldset class='visible' style='width:865px'>
<div class="divspoiler">
	<input type="button" value="Cadastrar prazo" class="tamanhobotao" onclick="if(this.parentNode.nextSibling.childNodes[0].style.display != '') { this.parentNode.nextSibling.childNodes[0].style.display = ''; this.value = 'Cancelar cadastro'; } else { this.parentNode.nextSibling.childNodes[0].style.display = 'none'; this.value = 'Cadastrar prazo'; }" />
</div><div><div class="spoiler" style="display: none;"> <!-- Não pode mudar essa identação -->

<h3>Cadastrar prazo</h3>
<form method="post" action="<?php echo base_url();?>cjuridico/createprazo" name="formprazo" onsubmit="return validaprazo()">
<input type="hidden" name="idacao" id="idacao" size="16"  value="<?php echo $IdAcao;?>"/>
<input type="hidden" name="tipoacao" id="tipoacao" size="16"  value="<?php echo $AcaoTipoId;?>"/>

<div class="row">
	<div class="label">Data<font style="color:red; font-size:7;"> &#10054;</font></div>
	<div class="field">
		<div class="field">
		<input type="text" value="" name="dtprazo" id="dtprazo" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formprazo.dtprazo,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
			<a onclick="document.getElementById('dtprazo').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url();?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
		</div>
	</div>
</div>

<div class="row">
	<div class="label">Descri&ccedil;&atilde;o<font style="color:red; font-size:7;"> &#10054;</font></div>
	<div class="field">
		<input type="text" name="descprazo" id="descprazo" value="" maxlength="50" size="80" style="text-transform: uppercase;"/>
	</div>
</div>

<div class="row">
	<div class="label">Observa&ccedil;&atilde;o<font style="color:white; font-size:7;"> &#10054;</font></div>
	<div class="field">
		<input type="text" name="obsprazo" id="obsprazo" value="" maxlength="50" size="80" style="text-transform: uppercase;"/>
	</div>
</div>

<div class="row">
	<div class="label"><span></span></div>
	<div class="field">
		<label> <input type="checkbox" name="prazoconcluido[]" value="1" id="prazoconcluido" />Concluído</label>
	</div>
</div>

<hr>
<input type="submit" value="Gravar prazo" class="botao"/>
</form>
</div>
</div>
</fieldset>
<?php } //}?>
<fieldset class='visible' style='width:865px'>
<?php
if(!empty($prazos)&&(sizeof($prazos)>0)){?>
<h3>Prazos</h3>
	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>
				<td width=10% class="middle" style="text-align:left;"><b>Data</b></td>
				<td width=35%><b>Descri&ccedil;&atilde;o</b></td>
				<td width=35%><b>Observa&ccedil;&atilde;o</b></td>
				<td width=10% class="middle"><b>Conclu&iacute;do</b></td>
				<td width=5% class="middle"><b>Alterar</b></td>
				<td width=5% class="middle"><b>Excluir</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>
		<tbody>
		<?php
		//print_r($andamentos);
		foreach($prazos as $prz):
			$IdPrazo = $prz->Id;
			$AcaoId = $prz->AcaoId;
			$DescricaoPrazo = utf8_encode($prz->Descricao);
			$DataPrazo = $prz->Data;
			$ObsPrazo = utf8_encode($prz->Observacoes);
			$Concluido = utf8_encode($prz->Concluido);?>
			<tr style="border:0;">
				<td width=10% class="middle" style="text-align:left;"><?php echo date('d/m/Y',strtotime($DataPrazo));?></td>
				<td width=35% class="middle" style="text-align:left; text-transform:uppercase;"><?php echo $DescricaoPrazo;?></td>
				<td width=35% class="middle" style="text-align:left;"><?php echo $ObsPrazo;?></td>
				<?php
				if($Concluido==0){ $status = 'unchecked_checkbox.png'; };
				if($Concluido==1){ $status = 'checked_checkbox.png'; };
				if($LoginAcao==$LoginSessao){ //SOMENTE O ADVOGADO RESPONSÁVEL PODE INCLUIR/ALTERAR PRAZOS
					if(($_SESSION['Admin']==1)||($_SESSION['Nivel1']==1)){ //1 JURÍDICO - ADMINISTRADOR ?>
						<td width=10% class="middle" style="font-size:11px;">
							<a href="#"	onclick='return alterastatus(<?php echo $IdPrazo?>,<?php echo $Concluido?>,<?php echo $IdAcao?>);' style="text-decoration:none;">
								<img src="<?php echo base_url();?>img/icons/<?php echo $status?>" width="18px"/>
							</a>
						</td>
						<td class="middle" width=5%>
							<a href="<?php echo base_url(); ?>cjuridico/editprazo/<?php echo $AcaoId;?>/<?php echo $IdPrazo;?>" title="Alterar este registro.">
								<img src="<?php echo base_url();?>img/icons/pencil.png" alt="editar" />
							</a>
						</td>
						<td class="middle" width=5%>
							<a href="#"	onclick='return excluiprazo(<?php echo $AcaoId;?>,<?php echo $IdPrazo;?>);' title="Deletar este registro.">
								<img src="<?php echo base_url();?>img/icons/delete.png" alt="apagar" />
							</a>
						</td>
						<?php }
					}else{ ?>
					<td class="middle" width=10%>-</td>
					<td class="middle" width=5%>-</td>
					<td class="middle" width=5%>-</td>
				<?php }?>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php
} else { ?>
<div class="status_box warning">
	<h6>Aviso!</h6>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Nenhum prazo cadastrado!
</div>
<?php } ?>
</fieldset>
</fieldset>
</div>

<!-- setima aba -->

<fieldset class='visible' style='width:933px'>
<div id="tabs-7">
<fieldset class='visible' style='width:875px'>
<input type="hidden" name="idacao" id="idacao" value="<?php echo $IdAcao;?>" maxlength="10" size="10"/>

<div class="row">
		<div class="field justify-center">
		<input type="text" name="datatitulo" id="datatitulo" value="DATA" size="20" style="text-transform: uppercase;background-color:#F2F2F2;" readonly/>
	</div>
	<div class="field">
		<input type="text" name="fundlegal" id="fundlegal" value="MOMENTO PROCESSUAL" size="70" style="text-transform: uppercase;background-color:#696969;" readonly/>
	</div>
	<div class="field">
		<input type="text" name="fundlegal" id="fundlegal" value="VALOR" size="20" style="text-transform: uppercase;background-color:#F2F2F2;" readonly/>
	</div>
</div>
<div class="row">
		<div class="field">
		<input type="text" name="causadata" id="causadata" value="<?php echo $CausaData?>" size="20" style="text-transform: uppercase;background-color:#FFFFFF;" readonly/>
	</div>
	<div class="field">
		<input type="text" name="causa" id="causa" value="CAUSA" size="70" style="text-transform: uppercase;background-color:#F2F2F2;" readonly/>
	</div>
	<div class="field">
		<input type="text" name="causavalor" id="causavalor" value="<?php echo $CausaValor?>" size="20" style="text-transform: uppercase;background-color:#FFFFFF;" readonly/>
	</div>
</div>
<div class="row">
		<div class="field">
		<input type="text" name="sentencadata" id="sentencadata" value="<?php echo $SentencaData?>" size="20" style="text-transform: uppercase;background-color:#FFFFFF;" readonly/>
	</div>
	<div class="field">
		<input type="text" name="sentenca" id="sentenca" value="SENTENÇA" size="70" style="text-transform: uppercase;background-color:#F2F2F2;" readonly/>
	</div>
	<div class="field">
		<input type="text" name="sentencavalor" id="sentencavalor" value="<?php echo $SentencaValor?>" size="20" style="text-transform: uppercase;background-color:#FFFFFF;" readonly/>
	</div>
</div>
<div class="row">
		<div class="field">
		<input type="text" name="acordaodata" id="acordaodata" value="<?php echo $AcordaoData?>" size="20" style="text-transform: uppercase;background-color:#FFFFFF;" readonly/>
	</div>
	<div class="field">
		<input type="text" name="acordao" id="acordao" value="ACÓRDÃO" size="70" style="text-transform: uppercase;background-color:#F2F2F2;" readonly/>
	</div>
	<div class="field">
		<input type="text" name="acordaovalor" id="acordaovalor" value="<?php echo $AcordaoValor?>" size="20" style="text-transform: uppercase;background-color:#FFFFFF;" readonly/>
	</div>
</div>
<div class="row">
		<div class="field">
		<input type="text" name="calculohomologadodata" id="calculohomologadodata" value="<?php echo $CalculoHomologadoData?>" size="20" style="text-transform: uppercase;background-color:#FFFFFF;" readonly/>
	</div>
	<div class="field">
		<input type="text" name="calculohomologado" id="calculohomologado" value="CÁLCULO HOMOLOGADO" size="70" style="text-transform: uppercase;background-color:#F2F2F2;" readonly/>
	</div>
	<div class="field">
		<input type="text" name="calculohomologadovalor" id="calculohomologadovalor" value="<?php echo $CalculoHomologadoValor?>" size="20" style="text-transform: uppercase;background-color:#FFFFFF;" readonly/>
	</div>
</div>
<div class="row">
		<div class="field">
		<input type="text" name="condenacaodata" id="condenacaodata" value="<?php echo $CondenacaoData?>" size="20" style="text-transform: uppercase;background-color:#FFFFFF;" readonly/>
	</div>
	<div class="field">
		<input type="text" name="condencao" id="condenacao" value="VALOR FINAL PAGO" size="70" style="text-transform: uppercase;background-color:#F2F2F2;" />
	</div>
	<div class="field">
		<input type="text" name="condenavalor" id="condenavalor" value="<?php echo $CondenacaoValor?>" size="20" style="text-transform: uppercase;background-color:#FFFFFF;"/>
	</div>
</div>
</a>
<a href="<?php echo base_url()."cjuridico/editacaotrabcont/".$IdAcao;?>" style="text-decoration:none;">
	<input type="button" value="EDITAR" onclick="location.href('<?php echo base_url()."cjuridico/editacaotrabcont/".$IdAcao;?>')" class="botao">
</a>
&nbsp;
	<a href="<?php echo base_url()."cjuridico/relatacaotrab/";?>" style="text-decoration:none;">
		<!--<input type="button" value="Cancelar" onclick="location.href('<?php echo base_url()."cjuridico/relatacaotrabcont/";?>')" class="botao" ;>-->
	</a>
</a>
</div>
</fieldset>
</div>

</div>
</div>
<?php $this->load->view('view_rodape');?>
