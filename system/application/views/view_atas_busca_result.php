<?php
$this->load->view('view_cabecalho');
$attributes = array('name' =>  'calendar');?>

<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/3.3.7/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/jquery/3.2.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/js/3.3.7/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings.png"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings-white.png"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script language='JavaScript'>
function excluiata(IdAta){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>catas/delete/"+IdAta;
	} else {
		return false;
	}
}
</script>

<?php
$mostrabtn = 'oculta';
$res = '';
if(!empty($atasresult)&&(sizeof($atasresult)>0)){
	$mostrabtn = 'exibe';
	if($total_linhas == 1){
		$res = ' 1 ATA encontrad.';
	}
	if($total_linhas > 1){
		$res = ' '.$total_linhas.' ATAs encontradas.';
	}?>
	<fieldset class=visible style='width:960px;background-color: #87CEFA;'>
		<font size="5"><?php echo $res?></font>
	</fieldset>

	<fieldset class=visible style='width:960px;'>
	<table class="table table-hover" style="width:100%;">
		<thead class="thead-inverse">
			<tr>
				<th style="width:80px;">ATA Nr</th>
				<th class="text-center" style="width:50px;">Dir.</th>
				<th style="width:100px;">Licita&ccedil;&atilde;o Nr</th>
				<th style="width:300px;">Modalidade</th>
				<th style="width:340px;">Empresa</th>
				<th style="width:80px;">Valor</th>
				<th style="width:5px;">Edita</th>
				<th style="width:5px;">Exclui</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($atasresult as $ats):
    		$IdAta = $ats->Id;
    		$AtaNr = $ats->AtaNr;
    		$AtaAno = $ats->AtaAno;
    		$AtaNumero = $ats->AtaNumero;
    		$LicitacaoModalidade = utf8_encode($ats->LicitacaoModalidade);
    		$ProcessoNr = $ats->ProcessoNr;
    		$EmpresaNome = utf8_encode($ats->EmpresaNome);
    		$LicitacaoNumero = $ats->LicitacaoNumero;
    		$Diretoria = utf8_encode($ats->Diretoria);
    		$Objeto = utf8_encode($ats->Objeto);
    		$Valor = $ats->Valor;
    		if($Valor != ""){$Valor = number_format($Valor, 2, ',', '.');}else{$Valor="0,00";}?>
		    <tr>
				<td style="width:80px;">
					<a href="<?php echo base_url();?>catas/atadetail/<?php echo $IdAta;?>" title="Detalhar registro" style="color:blue;text-decoration: underline;">
						<?php echo $AtaNr?>
					</a>
				</td>
				<td class="text-center" style="width:50px;"><?php echo $Diretoria?></td>
				<td style="width:100px;"><?php echo $LicitacaoNumero?></td>
				<td style="width:300px;"><?php echo $LicitacaoModalidade?></td>
				<td style="width:340px;"><?php echo strtoupper($EmpresaNome)?></td>
				<td class="text-right" style="width:80px;"><?php echo $Valor?></td>
				<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel3']==1)){ // 3 ATAS E CONTRATOS - ADMINISTRADOR?>
					<td class="middle" style="width:5px;">
						<a href="<?php echo base_url(); ?>catas/ataedit/<?php echo $IdAta;?>" title="Deletar registro.">
							<span class="glyphicon glyphicon-pencil"></span>
						</a>
					</td>
					<td class="middle" style="width:5px;">
						<a href="#" onclick='return excluiata(<?php echo $IdAta;?>);' title="Deletar registro.">
							<span class="glyphicon glyphicon-trash"></span>
						</a>
					</td>
				<?php }else{ ?>
					<td class="middle" style="width:5px;">-</td>
					<td class="middle" style="width:5px;">-</td>
				<?php } ?>
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
<br>
<div class="status_box warning">
	<h6>Aviso!</h6>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Nenhum registro encontrado!
</div>
<?php }?>
<a href="<?php echo base_url()."catas/atasindex/";?>" style="text-decoration:none;">
	<button type="button" class="btn btn-primary btn-md btnpequenomin" onclick="location.href('<?php echo base_url()."cfinanceiro/financeiroindex/";?>')">Voltar</button>
</a>
<a href="<?php echo base_url()."catas/atabuscaresultpdf"?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;" target="_blank">
	<button type="button" class="btn btn-primary btnpequenomin">PDF</button>
</a>
<a href="<?php echo base_url()."catas/atabuscaresultexcel"?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;" target="_blank">
	<button type="button" class="btn btn-primary btnpequenomin">EXCEL</button>
</a><br><br>
<?php $this->load->view('view_rodape');?>
