<?php 
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
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
//print_r($detailfinanceiro);
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
	$DepositoJudicialCorrecaoMonet = $finan->DepositoJudicialAMonetaria;
	$EstornoDeDepositoJudicial = $finan->EstornoDeDepositoJudicial;
	$SaldoDeDepositoJudicial = $finan->SaldoDeDepositoJudicial;
	$BloqueioJudicial = $finan->BloqueioJudicial;
	$BloqueioJudicialConvolado = $finan->BloqueioJudicialConvolado;
	$BloqueioJudicialCorrecaoMonet = $finan->BloqueioJudicialAMonetaria;
	$DevolucaoDeBloqueioJudicial = $finan->DevolucaoDeBloqueioJudicial;
	$EstornoDeBloqueioJudicial = $finan->EstornoDeBloqueioJudicial;
	$SaldoDeBloqueioJudicial = $finan->SaldoDeBloqueioJudicial;
	$PagamentoDeCustasJudiciais = $finan->PagamentoDeCustasJudiciais;
	$Quitado = $finan->Quitado;
endforeach;?>
<br>
<div class="row">
	<div class="well well-sm" style="width:960px;">
		<font size="5">Financeiro detalhamento</font>
	</div>
</div>

<div class="container" style="width:1018px;margin-left:-28px;">
<div class="row">
<form role="form">
	<input type="hidden" class="form-control" name="acaoid" id="acaoid" value="<?php echo $AcaoId?>">
	<div class="col-xs-10">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Interessado</label>
		<a href="<?php echo base_url()."cfinanceiro/interessados/".$AcaoId;?>">
			<input type="text" class="form-control" name="interessado" id="interessado" value="<?php echo $Autor?>" style="color:#4682B4" readonly>
		</a>
	</div>
	<div class="col-xs-2">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Status</label>
		<div class="checkbox">
			<?php if($Quitado==0){?>
		  		<label><input type="checkbox" id="quitado" name="quitado" value="<?php echo $Quitado?>" onclick='return alteraquitado()'>Não quitado</label>
		  	<?php }else if($Quitado==1){?>
		  		<label><input type="checkbox" id="quitado" name="quitado" value="<?php echo $Quitado?>" onclick='return alteraquitado()' checked>Quitado</label>
		  	<?php } ?> 		  	
		</div>
	</div>	
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Processo judicial</label>
		<input type="text" class="form-control" name="prjud" id="prjud" value="<?php echo $PrJudicial?>" readonly>
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Processo administrativo</label>
		<input type="text" class="form-control" name="pradm" id="pradm" value="<?php echo $PrAdmin?>" readonly>					
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Advogado</label>
		<input type="text" class="form-control" name="advogado" id="advogado" value="<?php echo $Advogado?>" readonly>
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Probabilidade de perda</label>
		<input type="text" class="form-control" name="probperda" id="probperda" value="<?php echo $ProbabilidadeDePerda?>" readonly>					
	</div>
	<div class="col-xs-12">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Assunto</label>
		<a href="<?php echo base_url()."cfinanceiro/assuntos/".$AcaoId;?>">
			<input type="text" class="form-control" name="assunto" id="assunto" value="<?php echo $Assunto?>" style="color:#4682B4" readonly>
		</a>
	</div>
</form>
</div>

<br>
<div class="row">
	<div class="col-md-6">
		<table class="table">
			<thead>
				<tr style="background-color:#D3D3D3">
					<th colspan="2">AÇÕES</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="width:380px;">CAUSA</td>
					<td style="width:90px;text-align:right;"><?php echo number_format($Causa,2,',','.')?></td>
				</tr>
				<tr>
					<td style="width:380px;">SETENÇA</td>
					<td style="width:90px;text-align:right;"><?php echo number_format($Sentenca,2,',','.')?></td>
				</tr>
				<tr>
					<td style="width:350px;">CONDENAÇÃO</td>
					<td style="width:70px;text-align:right;"><?php echo number_format($Condenacao,2,',','.')?></td>
				</tr>
				<tr>
					<td style="width:350px;">ACÓRDÃO</td>
					<td style="width:70px;text-align:right;"><?php echo number_format($Acordao,2,',','.')?></td>
				</tr>			    			    			    
				<tr>
					<td style="width:350px;">
						<a href="<?php echo base_url()."cfinanceiro/pagamentoacoes/".$AcaoId;?>">PAGAMENTOS</a>
					</td>
					<td style="width:70px;text-align:right;"><?php echo number_format($PagamentoDeAcao,2,',','.')?></td>
				</tr>			    			    			    
				<tr>
					<td style="width:350px;">
						<a href="<?php echo base_url()."cfinanceiro/devpagamentoacoes/".$AcaoId;?>">DEVOLUÇÕES</a>
					</td>
					<td style="width:70px;text-align:right;"><?php echo number_format($DevolucaoDePagamentoDeAcao,2,',','.')?></td>
				</tr>			    			    			    
				<tr>
					<td style="width:350px;">
						<a href="<?php echo base_url()."cfinanceiro/estornopgtoacoes/".$AcaoId;?>">ESTORNOS</a>
					</td>
					<td style="width:70px;text-align:right;"><?php echo number_format($EstornoDePagamentoDeAcao,2,',','.')?></td>
				</tr>			    			    			    
			</tbody>
		</table>
	</div>
			
	<div class="col-md-6">
		<table class="table"> <!-- TABELA DEPÓSITOS JUDICIAIS -->
			<thead>
				<tr style="background-color:#D3D3D3">
					<th colspan="2">DEPÓSITOS JUDICIAIS</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="width:380px;">
						<a href="<?php echo base_url()."cfinanceiro/depositosjudiciais/".$AcaoId;?>">DEPÓSITOS</a>
					</td>
					<td style="width:90px;text-align:right;"><?php echo number_format($DepositoJudicial,2,',','.')?></td>
				</tr>
				<tr>
					<td style="width:380px;">
						<a href="<?php echo base_url()."cfinanceiro/depositosjudcorrecaomonet/".$AcaoId;?>">ATUALIZAÇÃO MONETÁRIA</a>
					</td>
					<td style="width:90px;text-align:right;"><?php echo number_format($DepositoJudicialCorrecaoMonet,2,',','.')?></td>
				</tr>								
				<tr>
					<td style="width:380px;">
						<a href="<?php echo base_url()."cfinanceiro/depositosjudconvolados/".$AcaoId;?>">CONVOLADOS</a>
					</td>
					<td style="width:90px;text-align:right;"><?php echo number_format($DepositoJudicialConvolado,2,',','.')?></td>
				</tr>
				<tr>
					<td style="width:380px;">
						<a href="<?php echo base_url()."cfinanceiro/depositosjuddevolucoes/".$AcaoId;?>">DEVOLUÇÕES</a>
					</td>
					<td style="width:90px;text-align:right;"><?php echo number_format($DevolucaoDeDepositoJudicial,2,',','.')?></td>
				</tr>
				<tr>
					<td style="width:380px;">
						<a href="<?php echo base_url()."cfinanceiro/depositosjudestornos/".$AcaoId;?>">ESTORNOS</a>
					</td>
					<td style="width:90px;text-align:right;"><?php echo number_format($EstornoDeDepositoJudicial,2,',','.')?></td>
				</tr>
				<tr>
					<td style="width:380px;">SALDO</td>
					<td style="width:90px;text-align:right;"><?php echo number_format($SaldoDeDepositoJudicial,2,',','.')?></td>
				</tr>
			</tbody>
		</table>
	</div>		
</div>
  		  
<div class="row">
	<div class="col-md-6">
		<table class="table"> <!-- TABELA CUSTAS JUDICIAIS -->
			<thead>
				<tr style="background-color:#D3D3D3">
					<th colspan="2">CUSTAS JUDICIAIS</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="width:380px;">
						<a href="<?php echo base_url()."cfinanceiro/pagamentocustas/".$AcaoId;?>">PAGAMENTOS</a>
					</td>
					<td style="width:90px;text-align:right;"><?php echo number_format($PagamentoDeCustasJudiciais,2,',','.')?></td>
				</tr>
			</tbody>
		</table>
	</div>
		
	<div class="col-md-6">
		<table class="table"> <!-- TABELA BLOQUEIOS JUDICIAIS -->
			<thead>
				<tr style="background-color:#D3D3D3">
					<th colspan="2">BLOQUEIOS JUDICIAIS</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="width:380px;">
						<a href="<?php echo base_url()."cfinanceiro/bloqueiosjud/".$AcaoId;?>">BLOQUEIOS</a>
					</td>
					<td style="width:90px;text-align:right;"><?php echo number_format($BloqueioJudicial,2,',','.')?></td>
				</tr>
				<tr>
					<td style="width:380px;">
						<a href="<?php echo base_url()."cfinanceiro/bloqueiosjudcorrecaomonet/".$AcaoId;?>">ATUALIZAÇÃO MONETÁRIA</a>
					</td>
					<td style="width:90px;text-align:right;"><?php echo number_format($BloqueioJudicialCorrecaoMonet,2,',','.')?></td>
				</tr>				
				<tr>
					<td style="width:380px;">
						<a href="<?php echo base_url()."cfinanceiro/bloqueiosjudconvolados/".$AcaoId;?>">CONVOLADOS</a>
					</td>
					<td style="width:90px;text-align:right;"><?php echo number_format($BloqueioJudicialConvolado,2,',','.')?></td>
				</tr>
				<tr>
					<td style="width:380px;">
						<a href="<?php echo base_url()."cfinanceiro/bloqueiosjuddevolucoes/".$AcaoId;?>">DEVOLUÇÕES</a>
					</td>
					<td style="width:90px;text-align:right;"><?php echo number_format($DevolucaoDeBloqueioJudicial,2,',','.')?></td>
				</tr>
				<tr>
					<td style="width:380px;">
						<a href="<?php echo base_url()."cfinanceiro/bloqueiosjudestornos/".$AcaoId;?>">ESTORNOS</a>
					</td>
					<td style="width:90px;text-align:right;"><?php echo number_format($EstornoDeBloqueioJudicial,2,',','.')?></td>
				</tr>
				<tr>
					<td style="width:380px;">SALDO</td>
					<td style="width:90px;text-align:right;"><?php echo number_format($SaldoDeBloqueioJudicial,2,',','.')?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>	
</div>
<hr>	
<button type="button" class="btn btn-primary btnpequenomin">
	<a href="<?php echo base_url()."cfinanceiro/buscafinanceiroresult/"?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">Voltar</a>	
</button>
<!-- 
<button type="button" class="btn btn-primary btnpequenomin">
	<a href="<?php echo base_url()."cfinanceiro/buscafinanceirovlcindex/".$AcaoId?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">Relatório VLC</a>	
</button>
<button type="button" class="btn btn-primary btnpequenomin">
	<a href="<?php echo base_url()."cfinanceiro/relatoriosindex/".$AcaoId?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">Relatórios</a>	
</button>
-->
<br><br>
<?php $this->load->view('view_rodape');?>