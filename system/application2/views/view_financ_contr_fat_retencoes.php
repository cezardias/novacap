<?php
$this->load->view('view_cabecalho');
$attributes = array('name' => 'calendar');?>

<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/3.3.7/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/jquery/3.2.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/js/3.3.7/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings.png"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings-white.png"></script>

<script language="JavaScript">
function excluiret(ContratoId,IdFat,IdRet){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>cretencoes/delete/"+ContratoId+"/"+IdFat+"/"+IdRet;
	} else {
		return false;
	}
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
$(function(){

$(document).on('click', '#botao1', function() {
  $("#status").html("mudando o nome do botão para botao2");
  $(this).attr("id","botao2").html("BOTÃO 2");
});

$(document).on('click', '#botao2', function() {
  $("#status").html("retornando o nome do botão para botao1");
  $(this).attr("id","botao1").html("BOTÃO 1");
});

});

function calcpercent(){ //calcular resultado no formado REAL.
    var valor1  = parseFloat(document.getElementById('faturaval').value, 10);
    var valor2 = parseInt(document.getElementById('percentual').value, 10);
		var valor3 = ((valor1 * valor2)/100).toFixed(2);
		var valor = valor3;
		valor = valor.toString().replace(/\D/g,"");
    valor = valor.toString().replace(/(\d)(\d{8})$/,"$1.$2");
    valor = valor.toString().replace(/(\d)(\d{5})$/,"$1.$2");
    valor = valor.toString().replace(/(\d)(\d{2})$/,"$1,$2");
		var valor4 = valor;
    document.getElementById('valor').value = valor4;
}
</script>
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
		$valorFat = $fat->Valor;
		$valorFat = str_replace(".", "", $valorFat);
		$valorFat = str_replace(",", ".", $valorFat);
		$AtestoData = $fat->AtestoData; if($AtestoData==""){$AtestoData='';}else{$AtestoData = date('d/m/Y',strtotime($AtestoData));}
		$Glosa = $fat->Glosa;
		$Retencoes = $fat->Retencoes;
	endforeach;?>

<div class="row">
	<div class="well well-sm">
		<font size="3"><b>Retenções da fatura nº <?php echo $Numero.', valor: '.$Valor.' do contrato º '.$ContratoNumero.'/'.$ContratoAno.'</b>'?></font><br>
		<font size="2"><?php echo $Objeto?></font>
	</div>
</div>

<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel5']==1)){ // 5 FINANCEIRO - ADMINISTRADOR, 6 FINANCEIRO - LEITURA?>
<button id="novaret" class="btn btn-primary" data-toggle="collapse" data-target="#inclueret">Criar nova retenção</button>
<div id="inclueret" class="collapse"> <!-- INICIO DIV COLLAPSE -->
	<div class="panel panel-info" style="margin-top:10px; width:955px;">
	   <div class="panel-heading">
	      <p class="panel-title"><b>Nova retenção</b></p>
	   </div>
	   <div class="panel-body">
			 <form role="form" method="post" action="<?php echo base_url();?>cretencoes/createretencao" name="formretencao">
			 <div class="container" style="width:1018px;margin-left:-30px;">
			 <input type="hidden" class="form-control" name="contratoid" id="contratoid" value="<?php echo $IdContrato?>">
			 <input type="hidden" class="form-control" name="faturaid" id="faturaid" value="<?php echo $IdFat?>">
			 <input type="hidden" class="form-control" name="faturaval" id="faturaval" value="<?php echo $valorFat?>">
			 <div class="row">
			 	<div class="col-xs-3 selectContainer">
			 		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Reten&ccedil;&otilde;es</label>
			 		<select class="form-control" name="auxretencaoid" required autofocus>
			 			<option value=""></option>
			 			<?php foreach ($auxretencoes as $ret):?>
			 				<option value="<?php echo $ret->Id;?>"><?php echo $ret->Descricao;?></option>
			 			<?php endforeach;?>
			 		</select>
			 	</div>
			 	<div class="col-xs-2">
			 		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Percentual</label>
			 		<input type="text" class="form-control" name="percentual" id="percentual" value="" maxlength="3" onkeypress='return SomenteNumero(event)' onblur="calcpercent()" required>
			 	</div>
			 	<div class="col-xs-2">
			 		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Valor</label>
			 		<input type="text" class="form-control" name="valor" id="valor" value="" style="text-align:right;" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required>
			 	</div>
			 	<div class="col-xs-2">
			 		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Ordem Banc&aacute;ria</label>
			 		<input type="text" class="form-control" name="obnumero" id="obnumero" value="" style="text-transform:uppercase;" required>
			 	</div>
			 	<div class="col-xs-3">
			 		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Data</label>
			 		<input type="date" class="form-control" name="dataret" id="dataret" value="" style="width:170px;" required>
			 	</div>
			 </div>
			 <br><hr>
			 <input class="btn btn-primary btnpequenomin" type="submit" name="submit" value="Incluir" style="margin-left:15px;">
			 </div>
			 </form>
	   </div>
	</div>
</div> <!-- FIM DIV COLLAPSE -->
<?php } ?>

<?php //print_r($retencoes);
if(!empty($retencoes)&&(sizeof($retencoes)>0)){?>
	<!-- <table class="table table-hover" style="width:960px;"> -->
	<table id="table_lancamentos" class="table table-striped table-bordered" cellspacing="0"  style="width:960px;margin-top:15px;">
		<thead class="thead-inverse">
			<tr>
				<th style="width:90px;">Contrato</th>
				<th style="width:80px;">Reten&ccedil;&atilde;o</th>
				<th style="width:50px;">Percentual</th>
				<th class="text-right" style="width:90px;">Valor</th>
				<th style="width:90px;">OB</th>
				<th style="width:80px;">Data emiss&atilde;o</th>
				<th class="text-center" style="width:5px;">Editar</th>
				<th class="text-center" style="width:5px;">Excluir</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($retencoes as $ret):
			$IdRet = $ret->Id;
			$ContratoId = $ret->ContratoId;
			$FaturaId = $ret->FaturaId;
			$RetencaoId = $ret->RetencaoId;
			$Percentual = $ret->Percentual;
			$Valor = $ret->Valor;
			$OrdemBancariaNumero = $ret->OrdemBancariaNumero;
			$OrdemBancariaEmissaoData = $ret->OrdemBancariaEmissaoData;
			$Contrato = $ret->Contrato;
			$Fatura = $ret->Fatura;
			$Retencao = $ret->Retencao;?>
		  <tr>
				<td><?php echo $Contrato?></td>
				<td><?php echo $Retencao?></td>
				<td><?php echo $Percentual?></td>
				<td style="width:90px;"><?php echo $Valor?></td>
				<td style="width:90px;"><?php echo $OrdemBancariaNumero?></td>
				<td style="width:80px;"><?php echo $OrdemBancariaEmissaoData?></td>
				<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel5']==1)){ // 5 FINANCEIRO - ADMINISTRADOR, 6 FINANCEIRO - LEITURA?>
				<td class="middle">
					<a href="<?php echo base_url(); ?>cretencoes/faturaretencoesedit/<?php echo $ContratoId;?>/<?php echo $FaturaId;?>/<?php echo $IdRet;?>">
						<span class="glyphicon glyphicon-pencil"></span>
					</a>
				</td>
				<td class="middle">
					<a href="#" onclick='return excluiret(<?php echo $ContratoId?>,<?php echo $IdFat?>,<?php echo $IdRet?>);' title="Deletar registro.">
						<span class="glyphicon glyphicon-trash"></span>
					</a>
				</td>
				<?php }else{ ?>
					<td class="middle">-</td>
					<td class="middle">-</td>
				<?php } ?>
			</tr>
			<?php endforeach;?>
	  </tbody>
	</table>
<?php
} else { ?>
<br>
<div class="status_box warning">
	<h6>Aviso!</h6>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Nenhum registro encontrado!
</div>
<?php }?>
<a href="<?php echo base_url()."ccontrato/detailcontrato/".$IdContrato."#aba03"?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">
	<button type="button" class="btn btn-success btnpequenomin">Voltar</button>
</a><br><br>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"><!-- Carrega os ícones -->
<?php $this->load->view('view_rodape');?>
