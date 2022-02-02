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

<br>
<div class="row">
	<div class="well well-sm">
		<h2>Financeiro - interessados</h2>
		<font size="3">
			<?php echo 'Processo judicial: '.$PrJudicial.' - '.$Autor?>
		</font>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<table class="table" style="width:930px;">
			<thead>
				<tr style="background-color:#D3D3D3">
					<th style="width:150px;">CPF/CNPJ</th>
					<th style="width:730px;">NOME</th>
					<th style="width:50px;">SITUAÇÃO</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($interessados as $int):
				$cpfcnpj = $int->cpfcnpj;
				$nome = utf8_encode($int->nome);
				$SITUACAO = utf8_encode($int->SITUACAO);?>
				<tr>
					<td style="width:150px;"><?php echo $cpfcnpj?></td>
					<td style="width:730px;text-align:left;"><?php echo $nome?></td>
					<td style="width:50px;text-align:center;"><?php echo $SITUACAO?></td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>

<div class="well well-sm">
	<button type="button" class="btn btn-primary active">
	<a href="<?php echo base_url()."cfinanceiro/detailfinanceiro/".$AcaoId?>"><font color="white">Voltar</font></a>	
	</button>	
</div>

<?php $this->load->view('view_rodape');?>