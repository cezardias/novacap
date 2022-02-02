<?php
$this->load->view('view_cabecalho');
$attributes = array('name' =>  'calendar');?>

<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/3.3.7/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/jquery/3.2.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/js/3.3.7/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings.png"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings-white.png"></script>

<?php
//print_r($contresult);
$mostrabtn = 'oculta';
$res = '';
if(!empty($contresult)&&(sizeof($contresult)>0)){
	$mostrabtn = 'exibe';
	if($total_linhas == 1){
		$res = ' 1 contrato encontrado.';
	}
	if($total_linhas > 1){
		$res = ' '.number_format($total_linhas, 0, ',', '.').' contratos encontrados.';
	}?>
	<fieldset class=visible style='width:960px;background-color:#87CEFA;'>
		<font size="5"><?php echo $res?></font>
	</fieldset>

	<fieldset class=visible style='width:960px;'>
	<table class="table table-hover" style="width:100%;">
		<thead class="thead-inverse">
			<tr>
				<td width=10%><b>Contrato n&deg;</b></td>
				<td width=10% class="middle"><b>Diretoria</b></td>
				<td width=10% class="middle"><b>Licitacao n&deg;</b></td>
				<td width=25% class="middle"><b>Modalidade</b></td>
				<td width=15% class="middle"><b>Processo</b></td>
				<td width=30% class="text-left"><b>Empresa</b></td>
			</tr>
		</thead>
		<tbody>
		<?php
		$texto = '';
		//print_r($contresult);
		foreach($contresult as $ctr):
      	$IdContrato = $ctr->Id;
		$Contrato = $ctr->ContratoNr;
			$p1 = substr($Contrato, 0, 3);
			$p2 = substr($Contrato, 3, 4);
		$ContratoNr = $p1.'/'.$p2;		

    	$ContratoNumero = $ctr->ContratoNumero;
    	$ContratoAno = $ctr->ContratoAno;
    	$LicitacaoModalidade = utf8_encode($ctr->LicitacaoModalidade); if($LicitacaoModalidade==""){$LicitacaoModalidade="-";}
    	$ProcessoNr = $ctr->ProcessoNr;
    	$EmpresaNome = utf8_encode($ctr->Empresa);
    	$LicitacaoNumero = $ctr->LicitacaoNumero;
    	$Diretoria = $ctr->Diretoria;
    	$Objeto = utf8_encode($ctr->Objeto);
    	$PrazoDeVigenciaAtivo = $ctr->PrazoDeVigenciaAtivo;
    	$Valor = $ctr->Valor;
    	$DataDeAssinatura = $ctr->DataDeAssinatura;
    	$PrazoDeVigenciaAditado = $ctr->PrazoDeVigenciaAditado;
    	$RowNumber = $ctr->RowNumber;?>
			<tr style="border:0;">
				<td width=10% class="middle" style="text-align:left;">
					<a href="<?php echo base_url();?>ccontrato/detailcontrato/<?php echo $IdContrato;?>" title="Detalhar registro" style="color:blue;">
						<?php echo $ContratoNr?>
					</a>
				</td>
				<td width=10% class="middle"><?php echo $Diretoria?></td>
				<td width=10% class="middle"><?php echo $LicitacaoNumero?></td>
				<td width=25% class="middle"><?php echo $LicitacaoModalidade?></td>
				<td width=15% class="middle"><?php echo $ProcessoNr?></td>
				<td width=30% class="middle" style="text-align:left;text-transform:uppercase;"><?php echo $EmpresaNome?></td>
			</tr>
			<?php endforeach;?>
	  </tbody>
	</table>
	<div class="paginationBlock">
		<?php echo $this->pagination->create_links();?>
	</div>
	</fieldset>
<?php
}
else { ?>
<div class="status_box warning">
	<h6>Aviso!</h6>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Nenhum registro encontrado!
</div>
<?php }?>
<a href="<?php echo base_url()."ccontrato/contratoindex/";?>" style="text-decoration:none;">
	<button type="button" class="btn btn-primary btn-md btnpequenomin" onclick="location.href('<?php echo base_url()."ccontrato/contratoindex/";?>')">Voltar</button>
</a>
<br><br>
<?php $this->load->view('view_rodape');?>
