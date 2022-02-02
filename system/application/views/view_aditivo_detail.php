<?php 
$this->load->view('view_cabecalho');
$attributes = array('name' =>  'calendar'); ?>

<script language="JavaScript">
function validaditivo(){
	denom = document.formaditivo.denominacao.value;
	tipo = document.formaditivo.tipo.value;
	adtvlr = document.formaditivo.adtvalor.value;
	proc = document.formaditivo.processo.value;
	dtadit = document.formaditivo.dtaditivo.value;
	adtprazo = document.formaditivo.aditivoprazo.value;
	dtsol = document.formaditivo.dtsol.value;
	dtpub = document.formaditivo.dtpublica.value;
	dtres = document.formaditivo.dtresultado.value;
	adtres = document.formaditivo.aditivoresultado.value;

	if ((denom=="")||(tipo=="")||(adtvlr=="")||(proc=="")||(dtadit=="")||(adtprazo=="")||
		(dtsol=="")||(dtpub=="")||(dtres=="")||(adtres=="")){
		alert("Por favor, preencha todos os campos!");	
		return false;
	}	
}
</script>

<h2>Detalhe de aditivo</h2>

<?php 
//print_r($aditivodetail);
foreach ($aditivodetail as $adt):
	$IdAditivo = $adt->Id;
	$AditivoDenominacaoId = $adt->AditivoDenominacaoId;
	foreach ($denominacao as $dnm):
		if($AditivoDenominacaoId==$dnm->Id){
			$AditivoDenominacao = utf8_encode($dnm->Descricao);
		}
	endforeach;			
	$ContratoId = $adt->ContratoId;
	$AditivoTipoId = $adt->AditivoTipoId;
	foreach ($tipo as $tp):
		if($AditivoTipoId==$tp->Id){
			$AditivoTipo = $tp->Descricao;
		}
	endforeach;				
	$AditivoValor = $adt->AditivoValor;
	if($AditivoValor != ""){$AditivoValor = number_format($AditivoValor, 2, ',', '.');}else{$AditivoValor="0,00";}			
	$AditivoPrazo = $adt->AditivoPrazo;
	$AditivoProcessoNr = $adt->AditivoProcessoNr;
	if(($AditivoProcessoNr != "")&&($AditivoProcessoNr != 'NULL')){
		$primeiro = substr($AditivoProcessoNr, 0, 3);
		$segundo = substr($AditivoProcessoNr, 3, 3);
		$terceiro = substr($AditivoProcessoNr, 6, 3);
		$quarto = substr($AditivoProcessoNr, 9, 4);
		$AditivoProcessoNr = $primeiro.".".$segundo.".".$terceiro."/".$quarto; 		
	}else{$AditivoProcessoNr = '-';}			
	$AditivoData = $adt->AditivoData;
	if($AditivoData==""){$AditivoData='';}else{$AditivoData = date('d/m/Y',strtotime($AditivoData));}			
	$AditivoDataSolicitacao = $adt->AditivoDataSolicitacao;
	if($AditivoDataSolicitacao==""){$AditivoDataSolicitacao='';}else{$AditivoDataSolicitacao = date('d/m/Y',strtotime($AditivoDataSolicitacao));}			
	$AditivoDataPublicacao = $adt->AditivoDataPublicacao;
	if($AditivoDataPublicacao==""){$AditivoDataPublicacao='';}else{$AditivoDataPublicacao = date('d/m/Y',strtotime($AditivoDataPublicacao));}			
	$AditivoResultado = $adt->AditivoResultado;
	//$Motivacao = $adt->Motivacao; //CAMPO LONGO, BUSCO SEPARADAMENTE
	$Observacoes = $adt->Observacoes;
	$PrazoDeVigenciaTipo = $adt->PrazoDeVigenciaTipo;
	$PrazoDeVigencia = $adt->PrazoDeVigencia;
	//$PrazoDeExecucaoTipo = $adt->PrazoDeExecucaoTipo;
	//$PrazoDeExecucao = $adt->PrazoDeExecucao;
	$PrazoDeExecucaoInicio = $adt->PrazoDeExecucaoInicio;
	if($PrazoDeExecucaoInicio==""){$PrazoDeExecucaoInicio='';}else{$PrazoDeExecucaoInicio = date('d/m/Y',strtotime($PrazoDeExecucaoInicio));}
	$PrazoDeExecucaoFim = $adt->PrazoDeExecucaoFim;
	if($PrazoDeExecucaoFim==""){$PrazoDeExecucaoFim='';}else{$PrazoDeExecucaoFim = date('d/m/Y',strtotime($PrazoDeExecucaoFim));}
	$ProcSEI = $adt->SEI;
	if($ProcSEI != ""){ //00112-00005028/2018-31
	    $parte1 = substr($ProcSEI, 0, 5);
	    $parte2 = substr($ProcSEI, 5, 8);
	    $parte3 = substr($ProcSEI, 13, 4);
	    $parte4 = substr($ProcSEI, 17, 2);
	    $ProcSEI = $parte1.'-'.$parte2.'/'.$parte3.'-'.$parte4;
	}else{$ProcSEI = '';}
endforeach;

foreach ($aditivodetailongo as $adtlongo):
	$Motivacao = utf8_encode($adtlongo->Motivacao); //CAMPO LONGO, BUSCO SEPARADAMENTE
endforeach;
?>

<div id="caixa7">
<div id="tabs">

<fieldset class='visible' style='width:933px'>
<div id="tabs-1">

<div class="row">
	<div class="label">Denomina&ccedil;&atilde;o<font style="color:red; font-size:7;"> &#10054;</font></div>
	<div class="field">
		<input type="text" name="praditivo" id="praditivo" value="<?php echo $AditivoDenominacao?>" size="15" maxlength="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)' disabled/>
	</div>	
	&nbsp;&nbsp;
	Tipo
	<div class="field">
		<input type="text" name="praditivo" id="praditivo" value="<?php echo $AditivoTipo?>" size="15" maxlength="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)' disabled/>
	</div>	
	&nbsp;&nbsp;
	Processo
	<div class="field"> 
		<input type="text" name="praditivo" id="praditivo" value="<?php echo $AditivoProcessoNr?>" size="15" maxlength="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)' disabled/> 
	</div>
	&nbsp;&nbsp;
	Proc. SEI
	<div class="field">
		<input type="text" name="prsei" id="prsei" maxlength="22" size="21" value="<?php echo $ProcSEI?>" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)' disabled/>	 
	</div>		
</div>

<div class="row">
<div class="label">Aditivos de valor</div>
<div class="field">
	<div class="field">
		<input type="text" name="aditivovlr" id="aditivovlr" value="<?php echo $AditivoValor?>" size="12" onKeyPress="return MascaraMoeda(this,'.',',',event);" size="12" style="text-align:right;" disabled/> 
	</div>
</div>
		
<div class="row">
<div class="label">Prorrog. vig&ecirc;ncia</div>
	<div class="field">
		Prazo <input type="text" name="adtprazovig" id="adtprazovig" value="<?php echo $PrazoDeVigencia?>" size="4" onkeypress='return SomenteNumero(event)' disabled/> 
	</div>		
	<div class="field">
		<select name="adtprazovigtipo" disabled>
			<option value=""></option>
			<?php if($PrazoDeVigenciaTipo=='DIAS'){?>
				<option value="DIAS" selected>DIAS</option>
				<option value="MESES">MESES</option>
			<?php }else if($PrazoDeVigenciaTipo=='MESES'){?>
				<option value="DIAS">DIAS</option>
				<option value="MESES" selected>MESES</option>				
			<?php }else{ ?>
				<option value="DIAS">DIAS</option>
				<option value="MESES">MESES</option>									
			<?php } ?>
		</select>
	</div>	
</div>

<div class="row">
	<div class="label">Motiva&ccedil;&atilde;o</div>
	<div class="field">
		<textarea name="adtmotivacao" cols="110" rows="10" maxlength="1000" style="text-transform:uppercase;" disabled><?php echo $Motivacao?></textarea>
	</div>
</div>

<div class="row">
	<div class="label">Observa&ccedil;&otilde;es</div>
	<div class="field">
		<textarea name="adtobservacoes" cols="110" rows="3" maxlength="200" style="text-transform:uppercase;" disabled><?php echo $Observacoes?></textarea>
	</div>
</div>

<hr>
<div class="row">
	<a href="<?php echo base_url()."caditivo/detailcontrato/".$ContratoId."#tabs-2";?>">
		<input type="button" value="Voltar" onclick="location.href('<?php echo base_url()."cjuridico/detailcontrato/".$ContratoId."#tabs-2";?>')" class="botao">
	</a>
	<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel3']==1)){ // 3 ATAS E CONTRATOS - ADMINISTRADOR?>
	<a href="<?php echo base_url()."caditivo/editaditivo/".$ContratoId."/".$IdAditivo."#tabs-2";?>">
		<input type="button" value="Alterar" onclick="location.href('<?php echo base_url()."caditivo/editaditivo/".$ContratoId."/".$IdAditivo."#tabs-2";?>')" class="botao">
	</a>	
	<?php } ?>
</div>
</div>
</fieldset>
</div>
</div>

<?php $this->load->view('view_rodape');?>