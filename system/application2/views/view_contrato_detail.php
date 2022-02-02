<?php
$this->load->view('view_cabecalho');
$attributes = array('name' =>  'calendar');?>

<script language="JavaScript">
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

function excluirtermoap(IdContrato,IdTermo){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>ctermoap/delete/"+IdContrato+"/"+IdTermo;
	} else {
		return false;
	}
}

function excluiraditivo(IdContrato,IdAditivo){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>caditivo/delete/"+IdContrato+"/"+IdAditivo;
	} else {
		return false;
	}
}

function validatermo(){
	termotipoid = document.formtermoap.termotipoid.value;
	termoval = document.formtermoap.termoval.value;
	termopercent = document.formtermoap.termopercent.value;
	if (termotipoid==4){ //ADMINISTRATIVO, 4 NO BANCO.
		if((termoval=="0,00")||(termopercent=="0.00")){
			alert("Por favor, informe o valor e percentual!");
			return false;
		}
	}
}

//PARA JANELA POPUP COM FUNDO ESCURO
$(document).ready(function(){
    $("a[rel=modal]").click( function(ev){
        ev.preventDefault();

        var id = $(this).attr("href");

        var alturaTela = $(document).height();
        var larguraTela = $(window).width();

        //colocando o fundo preto
        $('#mascara').css({'width':larguraTela,'height':alturaTela});
        $('#mascara').fadeIn(1000);
        $('#mascara').fadeTo("slow",0.8);

        //var left = ($(window).width()/2)-($(id).width()/2);
        //var top = ($(window).height()/2)-($(id).height()/2);

        var left = '5%';
        var top = '5%';

        $(id).css({'top':top,'left':left});
        $(id).show();
    });

    $("#mascara").click( function(){
        $(this).hide();
        $(".window").hide();
    });

    $('.fechar').click(function(ev){
        ev.preventDefault();
        $("#mascara").hide();
        $(".window").hide();
    });
});
</script>

<!-- ESTILO PARA JANELA POPUP COM FUNDO ESCURO -->
<style>
.window{
    display:none;
    width:860px;
    height:460px;
    position:absolute;
    left:0;
    top:0;
    background:#FFF;
    z-index:9900;
    padding:10px;
    border-radius:10px;
}

#mascara{
	margin-top:0px;
    display:none;
    position:absolute;
    left:0;
    top:0;
    z-index:9000;
    background-color:#000;
}
.fechar{display:block; text-align:right;}
</style>
<?php
foreach ($contratodetail as $its):
	$IdContrato = $its->Id;
	$ContratoNr = $its->ContratoNr; 
	$ContratoNrP1 = substr($ContratoNr,0,3);
	$ContratoNrP2 = substr($ContratoNr,3,4);
	$ContratoNr = $ContratoNrP1.'/'.$ContratoNrP2;
	$ContratoAno = $its->ContratoAno;
	$ContratoNumero = $its->ContratoNumero;
	$LicitacaoModalidadeId = $its->LicitacaoModalidadeId;
	$LicitacaoModalidade = utf8_encode($its->LicitacaoModalidade);
	$ProcessoNr = $its->ProcessoNr;
	$ProcSEI = $its->Sei;
	$ProcessoNrSemMascara = $its->ProcessoNrSemMascara;
	$Empresa = utf8_encode($its->Empresa);
	$LicitacaoNumero = $its->LicitacaoNumero;
	$Diretoria = $its->Diretoria;
	$Objeto = utf8_encode($its->Objeto);
	$Valor = $its->Valor;
	$AditivosValor = $its->AditivosValor;
	$ValorComAditivos = $its->ValorComAditivos;
	$DataAssinatura = $its->DataDeAssinatura;
	$VigenciaInicio = $its->VigenciaInicio;
	$VigenciaFim = $its->VigenciaFim;
	$PrazoVigAditado = $its->PrazoDeVigenciaAditado;
	$PrazoDeVigenciaAtivo = $its->PrazoDeVigenciaAtivo;
	$ExecucaoInicio = $its->ExecucaoInicio;
	$ExecucaoFim = $its->ExecucaoFim;
	$VigenciaPrazo = $its->VigenciaPrazo;
	$ExecucaoPrazo = $its->ExecucaoPrazo;
	$Situacao = utf8_encode($its->Situacao);
	$Executor = utf8_encode($its->Executor);
	$Observacoes = utf8_encode($its->Observacoes);
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
); ?>

<h2>Detalhamento de contrato</h2>
<div id="mascara"></div> <!-- fundo escuro do popup aditivos -->
<div id="caixa7">
<div id="tabs">
<ul>
	<li><a href="#tabs-1">Contrato</a></li>
	<li><a href="#tabs-2">Aditivos</a></li>
	<li><a href="#tabs-3">Termo de apostilamento</a></li>
</ul>
<div id="tabs-1">
<fieldset class='visible' style='width:932px; margin-left:-14px;'>

<div class="row">
	<div class="label">Processo n&ordm;</div>
	<div class="field">
		<input type="text" name="processonr" id="processonr" value="<?php echo $ProcessoNr?>" size="14" maxlength="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)' autofocus disabled/>
	</div>

	Proc. SEI
	<div class="field">
		<input type="text" name="prsei" id="prsei" maxlength="22" size="21" value="<?php echo $ProcSEI?>" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)' disabled/>
	</div>

	Licita&ccedil;&atilde;o n&ordm;
	<div class="field">
		<input type="text" name="licitanr" id="licitanr" value="<?php echo $LicitacaoNumero?>" size="8" maxlength="12" disabled/>
	</div>

	Modalid.
	<div class="field">
		<select name="licitacaomodalidade" disabled style="width:200px;">
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
		<input type="text" name="empresanome" id="empresanome" value="<?php echo $Empresa?>" size="100" style="text-transform: uppercase;" disabled/>
	</div>
</div>

<div class="row">
	<div class="label">Contrato</div>
	<div class="field">
		<input type="text" name="contratonr" id="contratonr" value="<?php echo $ContratoNr?>" size="10" disabled/>
	</div>
	&nbsp;&nbsp;
	Valor do contrato
	<div class="field">
		<input type="text" name="contratovalor" id="contratovalor" value="<?php echo $Valor?>" size="12" onKeyPress="return MascaraMoeda(this,'.',',',event);" size="12" style="text-align:right;" disabled/>
	</div>
	&nbsp;&nbsp;
	Valor aditivos
	<div class="field">
		<input type="text" name="contratovalor" id="contratovalor" value="<?php echo $AditivosValor?>" size="12" onKeyPress="return MascaraMoeda(this,'.',',',event);" size="12" style="text-align:right;" disabled/>
	</div>
	&nbsp;&nbsp;
	Valor total
	<div class="field">
		<input type="text" name="contratovalor" id="contratovalor" value="<?php echo $ValorComAditivos?>" size="12" onKeyPress="return MascaraMoeda(this,'.',',',event);" size="12" style="text-align:right;" disabled/>
	</div>
</div>

<div class="row">
	<div class="label">Diretoria</div>
	<div class="field">
		<select name="diretoria" disabled>
			<option value=""></option>
			<?php foreach ($Diretorias as $dirs):
			if($dirs['Sigla']==$Diretoria){?>
				<option value="<?php echo $dirs['Sigla']?>" selected><?php echo $dirs['Descricao']?></option>
			<?php }else{ ?>
				<option value="<?php echo $dirs['Sigla']?>"><?php echo $dirs['Descricao']?></option>
			<?php } endforeach;?>
		</select>
	</div>
	&nbsp;
	Status
	<div class="field">
		<select name="status" disabled>
			<option value=""></option>
			<?php if($Ativo==1){?>
				<option value="1" selected>Ativo</option>
				<option value="0">Inativo</option>
			<?php }else{?>
				<option value="1">Ativo</option>
				<option value="0" selected>Inativo</option>
			<?php } ?>
		</select>
	</div>	
</div>

<fieldset class='visible' style='width:890px'>
<div class="row">
	<div class="label">Vig&ecirc;ncia in&iacute;cio</div>
	<div class="field">
		<div class="field">
			<input type="text" value="<?php echo $VigenciaInicio?>" name="prazodevigenciainicio" id="prazodevigenciainicio" size="11" maxlength="10" onkeyup="Formatadata(this,event)" disabled/>
		</div>
		&nbsp;
		Prazo
		<div class="field">
			<input type="text" name="prazodevigencia" id="prazodevigencia" value="<?php echo $VigenciaPrazo?>" size="18" onkeypress='return SomenteNumero(event)' disabled/>
		</div>
	</div>
</div>

<div class="row">
	<div class="label">Vig&ecirc;ncia t&eacute;rmino</div>
	<div class="field">
		<div class="field">
			<input type="text" name="prazodevigenciatermino" id="prazodevigenciatermino" value="<?php echo $VigenciaFim?>" size="18" onkeypress='return SomenteNumero(event)' disabled/>
		</div>
	</div>
	&nbsp;&nbsp;
	T&eacute;rmino com aditivos
	<div class="field">
		<div class="field">
			<input type="text" name="prazodevigenciaterminoaditivo" id="prazodevigenciaterminoaditivo" value="<?php echo $PrazoVigAditado?>" size="11" onkeypress='return SomenteNumero(event)' disabled/>
		</div>
	</div>
</div>
</fieldset>

<div class="row">
	<div class="label">Objeto</div>
	<div class="field">
		<textarea name="contratoobjeto" cols="105" rows="3" maxlength="1000" style="text-transform:uppercase;" disabled><?php echo $Objeto?></textarea>
	</div>
</div>

<div class="row">
	<div class="label">Observa&ccedil;&otilde;es</div>
	<div class="field">
		<textarea name="observacoes" cols="105" rows="3" maxlength="200" style="text-transform:uppercase;" disabled><?php echo $Observacoes?></textarea>
	</div>
</div>

<hr>
<div class="row">
<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel3']==1)){ // 3 CONTRATOS E ATAS - ADMINISTRADOR?>
<a href="<?php echo base_url()."cjuridico/editcontrato/".$IdContrato;?>" style="text-decoration:none;">
	<input type="button" value="Alterar" onclick="location.href('<?php echo base_url()."cjuridico/editcontrato/".$IdContrato;?>')" class="botao">
</a>
<?php } if($redirect == 'buscaResult'){?>
	<a href="<?php echo base_url()."cjuridico/buscacontratoresult/";?>" style="text-decoration:none;"><input type="button" value="Voltar" onclick="location.href('<?php echo base_url()."cjuridico/buscacontratoresult/";?>')" class="botao"></a>
<?php } if($redirect=='contratoSituacao'){ ?>
<a href="<?php echo base_url()."cjuridico/contratosituacao/";?>" style="text-decoration:none;"><input type="button" value="Voltar" onclick="location.href('<?php echo base_url()."cjuridico/contratosituacao/";?>')" class="botao"></a>
<?php } ?>
<a href="<?php echo base_url()."caditivo/relatcontrato/".$IdContrato;?>" style="text-decoration:none;" target="_black"><input type="button" value="Relat&oacute;rio individual" onclick="location.href('<?php echo base_url()."caditivo/relatcontrato/".$IdContrato;?>')" class="botao"></a>
</div>
</fieldset>
</div>
<!-- fim tabs-1 -->

<!-- inicio tabs-2 -->
<div id="tabs-2">
<?php
foreach ($contratodetail as $its):
	$IdContrato = $its->Id;
endforeach;?>
<!-- INICIO POPUP FUNDO ESCURO -->
<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel3']==1)){ // 3 CONTRATOS E ATAS - ADMINISTRADOR?>
<a href="#aditivo" rel="modal"><input type="submit" value="Adicionar aditivo" class="botao"/></a>
<?php } ?>
<div class="window" id="aditivo">
</font><a href="#" class="fechar"><font color="blue">Fechar[X]</font></a>
<form method="post" action="<?php echo base_url();?>caditivo/createaditivo" name="formaditivo"> <!-- onsubmit="return validaditivo()"> -->
<input type="hidden" name="contratoid" id="contratoid" size="14"  value="<?php echo $IdContrato;?>"/>

<h3>Adicionar aditivo</h3>
<fieldset class='visible' style='width:835px'>

<div class="row">
	<div class="label">Denominação</div>
	<div class="field">
		<select name="adtdenominacao" style="width:85px;" required autofocus>
			<option value=""></option>
			<?php foreach ($denominacao as $dnm):?>
				<option value="<?php echo $dnm->Id?>"><?php echo utf8_encode($dnm->Descricao)?></option>
			<?php endforeach;?>
		</select>
	</div>

	Tipo
	<div class="field">
		<select name="tipodenomin" style="width:150px;" required>
			<option value=""></option>
			<?php foreach ($tipo as $tp):?>
				<option value="<?php echo $tp->Id?>"><?php echo utf8_encode($tp->Descricao)?></option>
			<?php endforeach;?>
		</select>
	</div>

	Processo
	<div class="field">
		<input type="text" name="praditivo" id="praditivo" size="15" maxlength="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)' required/>
	</div>

	Proc. SEI
	<div class="field">
		<input type="text" name="prsei" id="prsei" maxlength="22" size="21" value="" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)' required/>
	</div>
</div>

<div class="row">
<div class="label">Aditivos de valor</div>
<div class="field">
	<div class="field">
		<input type="text" name="aditivovlr" id="aditivovlr" value="" size="12" onKeyPress="return MascaraMoeda(this,'.',',',event);" size="12" style="text-align:right;" required/>
	</div>
	&nbsp;&nbsp;
	Prorrog. vigência
	<div class="field">
		Prazo <input type="text" name="adtprazovig" id="adtprazovig" value="" size="4" onkeypress='return SomenteNumero(event)' required/>
	</div>
	<div class="field" required>
		<select name="adtprazovigtipo">
			<option value="DIAS">DIAS</option>
			<option value="MESES">MESES</option>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Motivação</div>
	<div class="field">
		<textarea name="adtmotivacao" cols="94" rows="7" maxlength="1000" style="text-transform:uppercase;" required></textarea>
	</div>
</div>

<div class="row">
	<div class="label">Observações</div>
	<div class="field">
		<textarea name="adtobservacoes" cols="94" rows="3" maxlength="200" style="text-transform:uppercase;"></textarea>
	</div>
</div>
<br>
</fieldset>
<input type="submit" value="Gravar" class="botao"/>
</form>
</div>

<fieldset class='visible' style='width:920px'>
<?php
if(!empty($aditivos)&&(sizeof($aditivos)>0)){ ?>
	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>
				<td width=15%><b>Aditivo</b></td>
				<td width=15% class="middle"><b>Tipo</b></td>
				<td width=15% class="middle"><b>Processo</b></td>
				<td width=10% class="middle"><b>Data</b></td>
				<td width=10% class="middle"><b>Prazo</b></td>
				<td width=15% class="middle"><b>Valor</b></td>
				<td width=10% class="middle"><b>Alterar</b></td>
				<td width=10% class="middle"><b>Deletar</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>
		<tbody>
		<?php
		$AditivoDenominacao = '';
		$AditivoTipo = '';
		foreach($aditivos as $adt):
			$IdAditivo = $adt->Id;
			$AditivoDenominacao = utf8_encode($adt->AditivoDenominacao);
			$AditivoTipo = $adt->AditivoTipo;
			$AditivoValor = $adt->AditivoValor;
			$AditivoPrazo = $adt->AditivoPrazo;
			$PrazoDeExecucaoTipo = $adt->PrazoDeExecucaoTipo;
			$AditivoProcessoNr = $adt->AditivoProcessoNr;
			$AditivoData = $adt->AditivoData;
			$AditivoDataSolicitacao = $adt->AditivoDataSolicitacao;
			$AditivoDataPublicacao = $adt->AditivoDataPublicacao;
			$AditivoResultado = $adt->AditivoResultado;
			$AditivoPDF = $adt->AditivoPDF;
			$Observacoes = $adt->Observacoes;
			$PrazoDeVigencia = $adt->PrazoDeVigencia;
			$PrazoDeExecucao = $adt->PrazoDeExecucao;
			$Motivacao = $adt->Motivacao;?>
			<tr style="border:0;">
				<td width=15% class="middle" style="text-align:left;">
					<a href="<?php echo base_url();?>caditivo/detailaditivo/<?php echo $IdContrato;?>/<?php echo $IdAditivo;?>" title="Detalhar registro" style="text-decoration:none;color:blue;">
						<?php echo $AditivoDenominacao;?>
					</a>
				</td>
				<td width=15% class="middle"><?php echo $AditivoTipo;?></td>
				<td width=15% class="middle"><?php echo $AditivoProcessoNr;?></td>
				<td width=10% class="middle"><?php echo $AditivoData;?></td>
				<td width=10% class="middle"><?php echo $PrazoDeVigencia;?></td>
				<td width=15% class="middle"><?php echo $AditivoValor;?></td>
				<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel3']==1)){ // 3 CONTRATOS E ATAS - ADMINISTRADOR?>
				<td class="middle" width=10%>
					<a href="<?php echo base_url(); ?>caditivo/editaditivo/<?php echo $IdContrato;?>/<?php echo $IdAditivo;?>" title="Alterar este registro.">
						<img src="<?php echo base_url();?>img/icons/pencil.png" alt="editar" />
					</a>
				</td>
				<td class="middle" width=10%>
					<a href="#"	onclick='return excluiraditivo(<?php echo $IdContrato;?>,<?php echo $IdAditivo;?>);' title="Deletar este registro.">
						<img src="<?php echo base_url();?>img/icons/delete.png" alt="apagar" />
					</a>
				</td>
				<?php }else{ ?>
					<td class="middle" width=10%>-</td>
					<td class="middle" width=10%>-</td>
				<?php } ?>
			</tr>
	<?php endforeach;?>
		</tbody>
	</table>
<?php
}else{ ?>
<div class="status_box warning">
	<h6>Aviso!</h6>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Nenhum aditivo registro!
</div>
<?php } ?>
</fieldset>
</div>
<!-- fim tabs-2 -->

<!-- inicio tabs-3 -->
<div id="tabs-3" style=" margin-left: -15px;">
<?php	
foreach ($contratodetail as $its):
	$IdContrato = $its->Id;
endforeach;?>
<!-- INICIO POPUP FUNDO ESCURO -->
<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel3']==1)){ // 3 CONTRATOS E ATAS - ADMINISTRADOR?>
<a href="#termoap" rel="modal"><input type="submit" value="Adicionar termo de apostilamento" class="botao"/></a>
<?php } ?>
<div class="window" id="termoap">
</font><a href="#" class="fechar"><font color="blue">Fechar[X]</font></a>
<form method="post" action="<?php echo base_url();?>ctermoap/createtermoap" name="formtermoap" onsubmit="return validatermo()">
<input type="hidden" name="contratoid" id="contratoid" size="14"  value="<?php echo $IdContrato;?>"/>

<h3>Adicionar termo de apostilamento</h3>
<fieldset class='visible' style='width:845px;'>

<div class="row">
	<div class="label">Denominação</div>
	<div class="field">
		<select name="termodenominacaoid" style="width:85px;" required autofocus>
			<option value=""></option>
			<?php foreach ($AuxTADenominacao as $term):?>
				<option value="<?php echo $term->Id?>"><?php echo utf8_encode($term->Descricao)?></option>
			<?php endforeach;?>
		</select>
	</div>

	Tipo
	<div class="field">
		<select name="termotipoid" style="width:150px;" required> <!-- OBRIGATORIEDADE DO VALOR E PERCENTE NA VALIDAÇÃO ACIMA. -->
			<option value=""></option>
			<?php foreach ($AuxTATipo as $tip):?>
				<option value="<?php echo $tip->Id?>"><?php echo utf8_encode($tip->Descricao)?></option>
			<?php endforeach;?>
		</select>
	</div>

	Proc. SEI
	<div class="field">
		<input type="text" name="prsei" id="prsei" maxlength="22" size="21" value="" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)' required/>
	</div>
</div>

<div class="row">
	<div class="label">Valor</div>
	<div class="field">
		<input type="text" name="termoval" id="termoval" value="0,00" size="12" onKeyPress="return MascaraMoeda(this,'.',',',event);" size="12" style="text-align:right;"/>
	</div>&nbsp;&nbsp;
	Percentual(%)
	<div class="field">
		<input type="text" name="termopercent" id="termopercent" maxlength="3" size="3" value="0.00" onkeypress='return SomenteNumero(event)'/>
	</div>
</div>

<div class="row">
	<div class="label">Motivação</div>
	<div class="field">
		<textarea name="motiva" cols="94" rows="3" maxlength="200" style="text-transform:uppercase;" required></textarea>
	</div>
</div>

<div class="row">
	<div class="label">Observação</div>
	<div class="field">
		<textarea name="termobs" cols="94" rows="3" maxlength="200" style="text-transform:uppercase;"></textarea>
	</div>
</div>
<br>
</fieldset>
<input type="submit" value="Gravar" class="botao"/>
</form>
</div>
<!-- <div id="mascara"></div><!-- mascara para cobrir o site -->
<!-- FINAL COD POPUP FUNDO ESCURO -->

<fieldset class='visible' style='width:928px;'>
<?php
if(!empty($TermosDeApos)&&(sizeof($TermosDeApos)>0)){ ?>
	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>
				<td width=20%><b>Termo</b></td>
				<td width=15% class="middle"><b>Tipo</b></td>
				<td width=20% class="middle"><b>SEI</b></td>
				<td width=10% class="middle"><b>Percent</b></td>
				<td width=10% class="middle"><b>Alterar</b></td>
				<td width=10% class="middle"><b>Deletar</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>
		<tbody>
		<?php
		//$AditivoDenominacao = '';
		//$AditivoTipo = '';
		foreach($TermosDeApos as $tap):
			$IdTermo = $tap->Id;
			$IdContrato = $tap->ContratoId;
			$DenominacaoId = $tap->DenominacaoId;
			$Denominacao = utf8_encode($tap->Denominacao);
			$TipoId = $tap->TipoId;
			$Tipo = utf8_encode($tap->Tipo);
			$Sei = $tap->Sei;
			$Percentual = $tap->Percentual;?>
			<tr style="border:0;">
				<td width=25% class="middle" style="text-align:left;">
					<a href="<?php echo base_url();?>ctermoap/detailtermoap/<?php echo $IdContrato;?>/<?php echo $IdTermo;?>" title="Detalhar registro" style="text-decoration:none;color:blue;">
						<?php echo $Denominacao;?>
					</a>
				</td>
				<td width=15% class="middle"><?php echo $Tipo;?></td>
				<td width=20% class="middle"><?php echo $Sei;?></td>
				<td width=10% class="middle"><?php echo $Percentual;?></td>
				<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel3']==1)){ // 3 CONTRATOS E ATAS - ADMINISTRADOR?>
				<td class="middle" width=10%>
					<a href="<?php echo base_url(); ?>ctermoap/termoedit/<?php echo $IdContrato;?>/<?php echo $IdTermo;?>" title="Alterar este registro.">
						<img src="<?php echo base_url();?>img/icons/pencil.png" alt="editar" />
					</a>
				</td>
				<td class="middle" width=10%>
					<a href="#"	onclick='return excluirtermoap(<?php echo $IdContrato;?>,<?php echo $IdTermo;?>);' title="Deletar este registro.">
						<img src="<?php echo base_url();?>img/icons/delete.png" alt="apagar" />
					</a>
				</td>
				<?php }else{ ?>
					<td class="middle" width=10%>-</td>
					<td class="middle" width=10%>-</td>
				<?php } ?>
			</tr>
	<?php endforeach;?>
		</tbody>
	</table>
<?php
}else{ ?>
<div class="status_box warning">
	<h6>Aviso!</h6>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Nenhum termos de apostilamento registrado!
</div>
<?php } ?>
</fieldset>
</div>
<!-- fim tabs-3 -->
</div>
</div>
<?php $this->load->view('view_rodape');?>
