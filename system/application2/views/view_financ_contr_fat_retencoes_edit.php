<?php
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' => 'calendar');
?>

<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/3.3.7/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/jquery/3.2.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/js/3.3.7/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings.png"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings-white.png"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"><!-- Carrega os ícones -->
<br>
<?php
	foreach ($contratodetail as $its):
		$IdContrato = $its->Id;
		$ContratoNr = $its->ContratoNr;
		$ContratoAno = $its->ContratoAno;
		$ContratoNumero = $its->ContratoNumero;
		$LicitacaoModalidadeId = $its->LicitacaoModalidadeId;
		$LicitacaoModalidade = $its->LicitacaoModalidade;
		$ProcessoNr = $its->ProcessoNr;
		$ProcSEI = $its->Sei;
		$ProcessoNrSemMascara = $its->ProcessoNrSemMascara;
		$EmpresaNome = $its->EmpresaNome;
		$LicitacaoNumero = $its->LicitacaoNumero;
		$Diretoria = $its->Diretoria;
		$Objeto = $its->Objeto;
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
		$Situacao = $its->Situacao;
		$Executor = $its->Executor;
		$Observacoes = $its->Observacoes;
		$Ativo = $its->Ativo;
		$LicitacaoProcesso = $its->LicitacaoProcesso;
	endforeach;

	foreach ($faturadetail as $fat):
		$IdFat = $fat->Id;
		$ContrFatId = $fat->ContratoId;
		$Numero = $fat->Numero;
		$Valor = $fat->Valor;
		$AtestoData = $fat->AtestoData; if($AtestoData==""){$AtestoData='';}else{$AtestoData = date('d/m/Y',strtotime($AtestoData));}
		$Glosa = $fat->Glosa;
		$Retencoes = $fat->Retencoes;
	endforeach;

	foreach($retencaodetail as $ret):
		$IdRet = $ret->Id;
		$ContrRetId = $ret->ContratoId;
		$FaturaId = $ret->FaturaId;
		$RetencaoId = $ret->RetencaoId; //represente AuxRetencoes
		$PercentualRet = $ret->Percentual;
		$ValorRet = $ret->Valor;
		$OrdemBancariaNumero = $ret->OrdemBancariaNumero;
		$OrdemBancariaEmissaoData = $ret->OrdemBancariaEmissaoData; // 15/03/2019
		$dia = substr($OrdemBancariaEmissaoData, 0, 2);
		$mes = substr($OrdemBancariaEmissaoData, 3, 2);
		$ano = substr($OrdemBancariaEmissaoData, 6, 4);
		$OBEmissaoData = $ano.'-'.$mes.'-'.$dia; // data no modo date html5
		$Contrato = $ret->Contrato;
		$Fatura = $ret->Fatura;
		$Retencao = $ret->Retencao;
	endforeach;?>

<form role="form" method="post" action="<?php echo base_url();?>cretencoes/saveretencao" name="formretencao">
<div class="container" style="width:1018px;margin-left:-30px;">

<div class="row">
	<div class="well well-sm" style="width:960px;margin-left:15px;">
		<font size="5">Fatura - Reten&ccedil;&otilde;es</font><br>
		<font size="3">Contrato n&deg; <?php echo $ContratoNumero.' - '.$Objeto?></font>
	</div>
</div>

<input type="hidden" class="form-control" name="contratoid" id="contratoid" value="<?php echo $IdContrato?>">
<input type="hidden" class="form-control" name="faturaid" id="faturaid" value="<?php echo $IdFat?>">
<input type="hidden" class="form-control" name="retencaoid" id="retencaoid" value="<?php echo $IdRet?>">

<div class="row">
	<div class="col-xs-3 selectContainer">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Reten&ccedil;&otilde;es</label>
		<select class="form-control" name="auxretencaoid" required autofocus>
			<option value=""></option>
			<?php foreach ($auxretencoes as $auxret):
				if($auxret->Id==$RetencaoId){?>
				<option value="<?php echo $auxret->Id;?>" selected><?php echo $auxret->Descricao;?></option>
			<?php }else{?>
				<option value="<?php echo $auxret->Id;?>"><?php echo $auxret->Descricao;?></option>
			<?php } endforeach;?>
		</select>
	</div>
	<div class="col-xs-2">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Percentual</label>
		<input type="text" class="form-control" name="percentual" id="percentual" value="<?php echo $PercentualRet?>" maxlength="14" onkeypress='return SomenteNumero(event)'>
	</div>
	<div class="col-xs-2">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Valor</label>
		<input type="text" class="form-control" name="valor" id="valor" value="<?php echo $ValorRet?>" style="text-align:right;" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required>
	</div>
	<div class="col-xs-2">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Ordem Banc&aacute;ria</label>
		<input type="text" class="form-control" name="obnumero" id="obnumero" value="<?php echo $OrdemBancariaNumero?>" style="text-transform:uppercase;" required>
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Data</label>
		<input type="date" class="form-control" name="dataret" id="dataret" value="<?php echo $OBEmissaoData?>" required>
	</div>
</div>

<br>
<input class="btn btn-primary btnpequenomin" type="submit" name="submit" value="Salvar" style="margin-left:15px;">
<a href="<?php echo base_url()."cretencoes/faturaretencoes/".$IdContrato."/".$IdFat."/".$IdRet?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">
	<button type="button" class="btn btn-warning btnpequenomin">Voltar</button>
</a>
<hr>
</div>
</form>
<?php $this->load->view('view_rodape');?>
