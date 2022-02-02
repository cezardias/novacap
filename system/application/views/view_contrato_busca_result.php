<?php
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' =>  'calendar');?>

<script type="text/javascript" src="<?php echo base_url();?>js/ajax.js"></script>
<script language='JavaScript'>
function excluir(id){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>cdoc/delete/"+id;
	} else {
		return false;
	}
}
</script>

<div id="caixa7">
<div id="tabs">
<div id="tabs-1">
<?php
if(!empty($contratosresult)&&(sizeof($contratosresult)>0)){
	if($total_linhas == 1){
		$res = ' 1 contrato encontrado.';
	}
	if($total_linhas > 1){
		$res = ' '.$total_linhas.' contratos encontrados.';
	} ?>
	<fieldset class=visible style='width:940px;background-color:#87CEFA;margin-left:-4px;'>
		<font size="5"><?php echo $res?></font>
	</fieldset>

	<fieldset class=visible style='width:940px;margin-left:-4px;'>
	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>
				<td width=10%><b>Contrato n&deg;</b></td>
				<td width=10% class="middle"><b>Diretoria</b></td>
				<td width=10% class="middle"><b>Licitacao n&deg;</b></td>
				<td width=20% class="middle"><b>Modalidade</b></td>
				<td width=15% class="middle"><b>Processo</b></td>
				<td width=30% class="middle"><b>Empresa</b></td>
				<td width=5% class="middle"><b>Aditivos</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>
		<tbody>
		<?php
		//print_r($contratosresult);
		foreach($contratosresult as $its):
			$IdContrato = $its->Id;
			$Diretoria = $its->Diretoria;
			$LicitacaoNumero = $its->LicitacaoNumero;
			if($LicitacaoNumero==""){$LicitacaoNumero="-";}
			$Contrato = $its->ContratoNr;
				$p1 = substr($Contrato, 0, 3);
				$p2 = substr($Contrato, 3, 4);
			$ContratoNr = $p1.'/'.$p2;
			
			$LicitacaoModalidade = $its->LicitacaoModalidade;
			if($LicitacaoModalidade==""){$LicitacaoModalidade="-";}
			$ProcessoNr = $its->ProcessoNr;
			$EmpresaNome = utf8_encode($its->Empresa);
			$texto = $EmpresaNome;
			$tam_max = 38;
			if (strlen($texto) > $tam_max){
				$titulo = substr($texto, 0, $tam_max);
				$titulo = substr($titulo, 0, strrpos($titulo, " "))."...";
			} else {
				$titulo = $texto;
			}?>
			<tr style="border:0;">
				<td width=10% class="middle" style="text-align:left;">
					<a href="<?php echo base_url();?>caditivo/detailcontrato/<?php echo $IdContrato.'/11';?>" title="Detalhar registro" style="color:blue;">
						<?php echo $ContratoNr?>
					</a>
				</td>
				<td width=10% class="middle"><?php echo $Diretoria?></td>
				<td width=10% class="middle"><?php echo $LicitacaoNumero?></td>
				<td width=20% class="middle"><?php echo utf8_encode($LicitacaoModalidade)?></td>
				<td width=15% class="middle"><?php echo $ProcessoNr?></td>
				<td width=30% class="middle" style="text-align:left;text-transform:uppercase;"><?php echo $titulo?></td>
				<td width=5% class="middle">
					<a href="<?php echo base_url();?>caditivo/detailcontrato/<?php echo $IdContrato."/11#tabs-2";?>" title="Detalhar registro" style="text-decoration:none;color:blue;">
						<img src="<?php echo base_url();?>img/icons/application_cascade.png"/>
					</a>
				</td>
			</tr>
	<?php endforeach;?>
		</tbody>
	</table>
	<div class="paginationBlock">
		<?php echo $this->pagination->create_links();?>
	</div>
<?php
}
else { ?>
<div class="status_box warning">
	<h6>Aviso!</h6>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Nenhum registro encontrado!
</div>
<?php }?>
<hr>
<a href="<?php echo base_url()."cjuridico/buscacontratoindex/";?>" style="text-decoration:none;">
	<input type="button" value="Voltar" onclick="location.href('<?php echo base_url()."cjuridico/buscacaoindex/";?>')" class="botao">
</a>
<a href="<?php echo base_url()."cjuridico/buscacontratorelat/";?>" style="text-decoration:none;" target="_blank"><input type="button" value="Imprimir" onclick="location.href('<?php echo base_url()."cjuridico/buscacontratorelat/";?>')" class="botao"></a>
</fieldset>
</div>
</div>
</div>

<?php $this->load->view('view_rodape');?>
