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

<h3>Situa&ccedil;&atilde;o de contratos</h3>
<?php
if(!empty($situacaoctrs)&&(sizeof($situacaoctrs)>0)){
foreach ($totalcontr as $cont):
	$TotalContratos = $cont->TotalContratos; 
endforeach;
?>

<h4><b><?php echo $TotalContratos?></b> contrato(s) com prazo de vig&ecirc;ncia vencido ou a menos de 40 dias do vencimento.</h4>

<fieldset class=visible style='width:940px;'><legend></legend>

	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>	
				<td width=5%><b>Diretoria</b></td>			
				<td width=20% class="middle"><b>Contrato</b></td>
				<td width=15% class="middle"><b>Processo</b></td>
				<td width=30% class="middle"><b>Empresa</b></td>
				<td width=5% class="middle"><b>Vig&ecirc;ncia</b></td>
				<td width=20% class="middle"><b>Mensagem</b></td>
				<td width=5% class="middle"><b>Aditar</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>	
		<tbody>	
		<?php
		foreach($situacaoctrs as $sit):
			$IdContrato = $sit->Id;
			$Diretoria = $sit->Diretoria;
			$Contrato = $sit->Contrato;
			$ProcessoNr = $sit->ProcessoNr;			
			$Empresa = utf8_encode($sit->Empresa);
			$texto = $Empresa;
			$tam_max = 30;
			if (strlen($texto) > $tam_max){
				$titulo = substr($texto, 0, $tam_max);
				$titulo = substr($titulo, 0, strrpos($titulo, " "))."...";
			} else {
				$titulo = $texto;
			}					
			$Vigencia = $sit->Vigencia;
			if($Vigencia==""){$Vigencia='';}else{$Vigencia = date('d/m/Y',strtotime($Vigencia));}
			$Mensagem = utf8_encode($sit->Mensagem);
			$DiasRestanteCor = $sit->DiasRestanteCor;?>
			<tr style="border:0;">
				<td width=5% class="middle"><?php echo $Diretoria;?></td>			
				<td width=20% class="middle">
					<a href="<?php echo base_url();?>caditivo/detailcontrato/<?php echo $IdContrato."/22";?>" title="Detalhar registro" style="color:blue;">
						<?php echo $Contrato;?>
					</a>
				</td>
				<td width=15% class="middle"><?php echo $ProcessoNr;?></td>
				<td width=30% class="middle" style="text-align:left; text-transform:uppercase;"><?php echo $titulo;?></td>
				<td width=5% class="middle"><?php echo $Vigencia;?></td>
				<td width=20% class="middle" style="text-transform:uppercase;">
					<?php if($DiasRestanteCor<0){?>
						<font color="red"><?php echo $Mensagem;?></font>
					<?php }else if(($DiasRestanteCor>=0)&&($DiasRestanteCor<41)){ ?>
						<font color="#FF8C00"><?php echo $Mensagem;?></font>
					<?php }else if($DiasRestanteCor>40){ ?>
						<font color="green"><?php echo $Mensagem;?></font>
					<?php } ?>
				</td>
				<td width=5% class="middle">
					<a href="<?php echo base_url()."caditivo/detailcontrato/".$IdContrato."/22#tabs-2";?>"><font color="blue">Aditar</font></a>
				</td>
			</tr>
	<?php endforeach;?>		
		</tbody>	
	</table>
<?php
} ?>
<hr>
<a href="<?php echo base_url()."cjuridico/buscacontratoindex/";?>" style="text-decoration:none;">
	<input type="button" value="Voltar" onclick="location.href('<?php echo base_url()."cjuridico/buscacaoindex/";?>')" class="botao">
</a>
<a href="<?php echo base_url()."cjuridico/contratosituacaorelat/";?>" style="text-decoration:none;" target="_blank">
	<input type="button" value="Imprimir" onclick="location.href('<?php echo base_url()."cjuridico/contratosituacaorelat/";?>')" class="botao">
</a>
</fieldset>
</div>
</div>
</div>

<?php $this->load->view('view_rodape');?>