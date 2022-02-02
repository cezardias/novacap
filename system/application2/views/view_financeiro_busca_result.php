<?php 
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' =>  'calendar');?>

<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/3.3.7/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/jquery/3.2.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/js/3.3.7/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings.png"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings-white.png"></script>

<?php
//print_r($docresult);
$mostrabtn = 'oculta';
$res = '';
if(!empty($docresult)&&(sizeof($docresult)>0)){
	$mostrabtn = 'exibe';
	if($total_linhas == 1){
		$res = ' 1 processo encontrado.';
	} 
	if($total_linhas > 1){
		$res = ' '.number_format($total_linhas, 0, ',', '.').' processos encontrados.';
	}?>
	<fieldset class=visible style='width:960px;background-color:#87CEFA;'>
		<font size="5"><?php echo $res?></font>
	</fieldset>

	<fieldset class=visible style='width:960px;'>
	<table class="table table-hover" style="width:100%;">
		<thead class="thead-inverse">
			<tr>
				<th style="width:170px;">Processo judicial</th>
				<th class="text-center" style="width:120px;">Processo admin.</th>
				<th style="width:330px;">Interessado</th>
				<th style="width:310px;">Assunto</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($docresult as $fin):
			$IdAcao = $fin->Id;
			$ProcessoJud = $fin->ProcessoJudicial;
			$ProcessoAdmin = $fin->ProcessoAdministrativo;
			$Autor = utf8_encode($fin->Autor);
			$Assunto = $fin->Assunto;?>	  
		    <tr>
				<td style="width:170px;">
					<a href="<?php echo base_url();?>cfinanceiro/detailfinanceiro/<?php echo $IdAcao;?>" title="Detalhamento" style="color:blue;">
						<?php echo $ProcessoJud?>
					</a>
				</td>
				<td class="text-center" style="width:120px;"><?php echo $ProcessoAdmin?></td>
				<td style="width:330px;"><?php echo $Autor?></td>
				<td style="width:310px;"><?php echo utf8_encode($Assunto)?></td>
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
<a href="<?php echo base_url()."cfinanceiro/financeiroindex/";?>" style="text-decoration:none;">
	<button type="button" class="btn btn-primary btn-md btnpequenomin" onclick="location.href('<?php echo base_url()."cfinanceiro/financeiroindex/";?>')">Voltar</button>
</a>
<br><br>
<?php $this->load->view('view_rodape');?>