<?php 
$this->load->view('view_cabecalho');
$attributes = array('name' =>  'calendar');

foreach ($detailfinanceiro as $finan):
	$AcaoId = $finan->AcaoId;
	$Autor = $finan->Autor;
	$PrJudicial = $finan->ProcessoJudicialNumero;
	$PrAdmin = $finan->ProcessoAdministrativoNumero;
	$Advogado = $finan->Advogado;
	$ProbabilidadeDePerda = $finan->ProbabilidadeDePerda;
	$Assunto = $finan->Assunto;
	$Causa = $finan->Causa;
	$Sentenca = $finan->Sentenca;
	$Condenacao = $finan->Condenacao;
	$Acordao = $finan->Acordao;
	$PagamentoDeAcao = $finan->PagamentoDeAcao;
	$EstornoDePagamentoDeAcao = $finan->EstornoDePagamentoDeAcao;
	$DevolucaoDePagamentoDeAcao = $finan->DevolucaoDePagamentoDeAcao;
	$DepositoJudicial = $finan->DepositoJudicial;
	$DepositoJudicialConvolado = $finan->DepositoJudicialConvolado;
	$DevolucaoDeDepositoJudicial = $finan->DevolucaoDeDepositoJudicial;
	$EstornoDeDepositoJudicial = $finan->EstornoDeDepositoJudicial;
	$SaldoDeDepositoJudicial = $finan->SaldoDeDepositoJudicial;
	$BloqueioJudicial = $finan->BloqueioJudicial;
	$BloqueioJudicialConvolado = $finan->BloqueioJudicialConvolado;
	$DevolucaoDeBloqueioJudicial = $finan->DevolucaoDeBloqueioJudicial;
	$EstornoDeBloqueioJudicial = $finan->EstornoDeBloqueioJudicial;
	$SaldoDeBloqueioJudicial = $finan->SaldoDeBloqueioJudicial;
	$PagamentoDeCustasJudiciais = $finan->PagamentoDeCustasJudiciais;
endforeach;?>

<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/3.3.7/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/jquery/3.2.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/js/3.3.7/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings.png"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings-white.png"></script>

<script language="javascript">
function excluir(IdPgtoAcao,AcaoId){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>cfinanceiro/delete/"+IdPgtoAcao+"/"+AcaoId+"/13"; 
	} else {
		return false;
	}
}		
</script>
<br>
<div class="row" style="width:960px;">
	<div class="well well-sm" style="width:960px;">
		<h2>Financeiro - Depósitos judiciais - ATUALIZAÇÃO MONETÁRIA</h2>
		<font size="3">
			<?php echo 'Processo judicial: '.$PrJudicial.' - '.$Autor?>
		</font>
	</div>
</div>
<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel5']==1)){ // 5 FINANCEIRO - ADMINISTRADOR?>
<form role="form" method="post" action="<?php echo base_url();?>cfinanceiro/createdepositojudcmonet" name="formdepjud">
<input type="hidden" name="acaoid" id="acaoid" value="<?php echo $AcaoId?>">

<div class="row col-xs-12" style="width:960px;margin-left:-30px;">
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Data</label>
		<input type="date" class="form-control" name="datapgtoacao" id="datapgtoacao" value="" style="width:160px;" required>
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Valor</label>
		<input type="text" class="form-control" name="valorpgtoacao" id="valorpgtoacao" value="" style="width:160px;text-align:right;" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required>					
	</div>
	<div class="col-xs-6">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Observações</label>
		<input type="text" class="form-control" name="obspgtoacao" id="obspgtoacao" value="" style="text-transform: uppercase;">
	</div>	
</div>
<hr>
<input class="btn btn-primary btnpequenomin" type="submit" value="Adicionar">
<hr>
</form>

<?php }
if(!empty($depjudcorremonet)&&(sizeof($depjudcorremonet)>0)){?>
<div class="row">
	<div class="col-md-6">
		<table class="table" style="width:960px;margin-left:-15px;">
			<thead>
				<tr style="background-color:#D3D3D3">
					<th style="width:100px;">DATA</th>
					<th style="width:130px;text-align:center;">VALOR</th>
					<th style="width:670px;text-align:left;">OBSERVAÇÕES</th>
					<th style="width:30px;text-align:left;"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($depjudcorremonet as $pgtoac):
				$IdPgtoAcao = $pgtoac->Id;
				$Data = $pgtoac->Data; if($Data==""){$Data='';}else{$Data = date('d/m/Y',strtotime($Data));}
				$Valor = $pgtoac->Valor; if($Valor != ""){$Valor = number_format($Valor, 2, ',', '.');}else{$Valor="0,00";}
				$Observacao = $pgtoac->Observacao;
				$Conta = $pgtoac->Conta;?>
				<tr>
					<td style="width:100px;"><?php echo $Data?></td>
					<td style="width:130px;text-align:right;"><?php echo $Valor?></td>
					<td style="width:670px;text-align:left;text-transform:uppercase;"><?php echo utf8_encode($Observacao)?></td>
					<td style="Widht:30">
					<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel5']==1)){ // 5 FINANCEIRO - ADMINISTRADOR?>
						<a href="#"	onclick='return excluir(<?php echo $IdPgtoAcao?>,<?php echo $AcaoId?>);' title="Deletar este registro.">
							<img src="<?php echo base_url();?>img/icons/delete.png" alt="apagar" />
						</a>			
					<?php }else{echo '-';}?>			
          			</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>
<?php } 
else { ?>
<div class="alert alert-warning">
  <strong>Atenção!</strong>
  <br>Nenhum registro encontrado.
</div>
<?php }?>

<button type="button" class="btn btn-primary btnpequenomin">
	<a href="<?php echo base_url()."cfinanceiro/detailfinanceiro/".$AcaoId?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">Voltar</a>	
</button>	
<br><br>
<?php $this->load->view('view_rodape');?>