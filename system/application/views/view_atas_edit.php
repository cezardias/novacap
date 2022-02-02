<?php
$this->load->view('view_cabecalho');
$attributes = array('name' =>  'calendar'); ?>

<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/3.3.7/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/jquery/3.2.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/js/3.3.7/bootstrap.min.js"></script>

<script type="text/javascript">
function alteraquitado(){
	var quit = document.getElementById("quitado").value;
	var acaoid = document.getElementById("acaoid").value;
	var confirma = confirm("Deseja realmente alterar o Status do processo?")
	if (confirma){
		window.location = "<?php echo base_url();?>cfinanceiro/alteraquitado/"+quit+"/"+acaoid;
	} else {
		return false;
	}
}
</script>
<?php
//print_r($atadetail);
foreach ($atadetail as $ats):
    $IdAta = $ats->Id;
    $AtaNr = $ats->AtaNr;
    $AtaAno = $ats->AtaAno;
    $AtaNumero = $ats->AtaNumero;
    $Valor = $ats->Valor;if($Valor != ""){$Valor = number_format($Valor, 2, ',', '.');}else{$Valor="0,00";}
    $LicitacaoModalidadeId = $ats->LicitacaoModalidadeId;
    $LicitacaoModalidade = utf8_encode($ats->LicitacaoModalidade);
    $ProcessoNr = $ats->ProcessoNr;
    $ProcessoNrSemMascara = $ats->ProcessoNrSemMascara;
    $EmpresaNome = utf8_encode($ats->EmpresaNome);
    $LicitacaoNumero = $ats->LicitacaoNumero;

    $PrazoDeVigenciaInicio = $ats->PrazoDeVigenciaInicio;
        if($PrazoDeVigenciaInicio==""){$PrazoDeVigenciaInicio='';}else{$PrazoDeVigenciaInicio = date('Y-m-d',strtotime($PrazoDeVigenciaInicio));}
    $PrazoDeVigenciaTipo = $ats->PrazoDeVigenciaTipo;
    $PrazoDeVigencia = $ats->PrazoDeVigencia;
    $AtaAssinaturaData = $ats->AssinaturaData;
        if($AtaAssinaturaData==""){$AtaAssinaturaData='';}else{$AtaAssinaturaData = date('Y-m-d',strtotime($AtaAssinaturaData));}

    $Diretoria = $ats->Diretoria;
    $Objeto = utf8_encode($ats->Objeto);
    $Executor = $ats->Executor;
    $Observacoes = utf8_encode($ats->Observacoes); if($Observacoes=='NULL'){$Observacoes="";}
    $Sei = $ats->Sei;
    if($Sei != ""){ //00112-00005028/2018-31
        $parte1 = substr($Sei, 0, 5);
        $parte2 = substr($Sei, 5, 8);
        $parte3 = substr($Sei, 13, 4);
        $parte4 = substr($Sei, 17, 2);
        $Sei = $parte1.'-'.$parte2.'/'.$parte3.'-'.$parte4;
    }else{$Sei = '';}
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
<br>
<div class="row">
	<div class="well well-sm" style="width:960px;">
		<font size="5">Altera&ccedil;&atilde;o de ATA</font>
	</div>
</div>

<div class="container" style="width:1018px;margin-left:-28px;">
<div class="row">
<form role="form" method="post" action="<?php echo base_url();?>catas/atasave" name="form">
<input type="hidden" class="form-control" name="ataid" id="ataid" value="<?php echo $IdAta?>">

<div class="row">
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">N&uacute;mero ATA</label>
		<input type="text" class="form-control" name="atanr" id="atanr" value="<?php echo $AtaNr?>" style="text-transform:uppercase;" autofocus required/>
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Processo administrativo</label>
		<input type="text" class="form-control" name="pradm" id="pradm" value="<?php echo $ProcessoNr?>" maxlength="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)'/>
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Processo SEI</label>
		<input type="text" class="form-control" name="prsei" id="prsei" value="<?php echo $Sei?>" maxlength="22" size="23" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)'/>
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">N&uacute;mero licitacao</label>
		<input type="text" class="form-control" name="licitanr" id="licitanr" value="<?php echo $LicitacaoNumero?>" style="text-transform:uppercase;"/>
	</div>

	<div class="col-xs-3">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Data assinatura</strong></p>
		<input type="date" class="form-control" name="atadatassinatura" id="atadatassinatura" value="<?php echo $AtaAssinaturaData?>" required>
	</div>
	<div class="col-xs-3">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Data vig&ecirc;ncia</strong></p>
		<input type="date" class="form-control" name="atadatavigenciainicio" id="atadatavigenciainicio" value="<?php echo $PrazoDeVigenciaInicio?>" required>
	</div>
	<div class="col-xs-3">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Prazo vig&ecirc;ncia</strong></p>
		<input type="text" class="form-control" name="ataprazovigencia" id="ataprazovigencia" value="<?php echo $PrazoDeVigencia?>" maxlength="3" onkeypress='return SomenteNumero(event)' required/>
	</div>
	<div class="col-xs-3">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Tipo</strong></p>
		<select class="form-control" name="atatipoprazo" required>
			<option value=""></option>
			<?php if($PrazoDeVigenciaTipo=='DIAS'){?>
    			<option value="DIAS" selected>DIAS</option>
    			<option value="MESES">MESES</option>
			<?php }else if($PrazoDeVigenciaTipo=='MESES'){?>
    			<option value="DIAS">DIAS</option>
    			<option value="MESES" selected>MESES</option>
			<?php }else{?>
    			<option value="DIAS">DIAS</option>
    			<option value="MESES">MESES</option>
			<?php }?>
		</select>
	</div>

	<div class="col-xs-8">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Modalidade</label>
		<select class="form-control" name="licmodalidadeid" required>
			<option value=""></option>
			<?php foreach ($auxmodalide as $mod):
			if($LicitacaoModalidadeId==$mod->Id){?>
				<option value="<?php echo $mod->Id?>" selected><?php echo utf8_encode($mod->Descricao)?></option>
			<?php }else{?>
				<option value="<?php echo $mod->Id?>"><?php echo utf8_encode($mod->Descricao)?></option>
			<?php } endforeach;?>
		</select>
	</div>
	<div class="col-xs-4">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Diretoria</label>
		<select class="form-control" name="diretoria" required>
			<option value=""></option>
			<?php foreach ($Diretorias as $dirs):
			if($dirs['Sigla']==$Diretoria){?>
				<option value="<?php echo $dirs['Sigla']?>" selected><?php echo $dirs['Descricao']?></option>
			<?php }else{ ?>
				<option value="<?php echo $dirs['Sigla']?>"><?php echo $dirs['Descricao']?></option>
			<?php } endforeach;?>
		</select>
	</div>
	<div class="col-xs-12">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Nome empresa</strong></p>
		<input type="text" class="form-control" name="nomempresa" id="nomempresa" value="<?php echo $EmpresaNome?>" style="text-transform:uppercase;" disabled/>
	</div>	
	<div class="col-xs-12">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Objeto</label>
		<textarea class="form-control rounded-0" id="ataobjeto" name="ataobjeto" rows="3" style="text-transform:uppercase;"><?php echo $Objeto?></textarea>
	</div>
	<div class="col-xs-12">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Observa&ccedil;&otilde;es</label>
		<textarea class="form-control rounded-0" name="ataobs" id="ataobs" rows="3" style="text-transform:uppercase;"><?php echo $Observacoes?></textarea>
	</div>
</div>
<hr/>
<input class="btn btn-primary btnpequenomin" type="submit" name="submit" value="Salvar" style="margin-left:15px;">
<a href="<?php echo base_url()."catas/atadetail/".$IdAta?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">
	<button type="button" class="btn btn-danger btnpequenomin">Cancelar</button>
</a>
</form>
</div>
</div>
<hr>
<br><br>
<?php $this->load->view('view_rodape');?>
