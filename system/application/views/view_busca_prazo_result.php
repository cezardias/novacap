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

<fieldset class=visible style='width:940px;'><legend></legend>
<?php
//print_r($total_linhas);
//echo '<br>';
//echo sizeof($docresult);
$mostrabtn = 'oculta';
if(!empty($docresult)&&(sizeof($docresult)>0)){
	$mostrabtn = 'exibe';
	if($total_linhas == 1){
		echo '<h2>Resultado: 1 a&ccedil;&atilde;o c&iacute;vel encontrada.</h2>';
	}
	if($total_linhas > 1){
		echo '<h2>Resultado: '.$total_linhas.' a&ccedil;&otilde;es c&iacute;veis encontradas.</h2>';
	}?>
	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>
				<td width=20% class="middle"><b>CNJ</b></td>
				<td width=10% class="middle"><b>Pr. administrativo</b></td>
				<td width=20% class="middle"><b>Processo judicial</b></td><!-- PR. JUD. ANTIGO -->
				<td width=20% class="middle" style="text-align:center;"><b>Autor</b></td>
				<td width=20% class="middle" style="text-align:center;"><b>R&eacute;u</b></td>
				<td width=10% class="middle" style="text-align:left;"><b>Advogado</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>
		<tbody>
		<?php
		//print_r($docresult);
		$Autor = "";
		$Reu = "";
		foreach($docresult as $its):
			$IdAcao = $its->Id;
			$AcaoTipo = $its->AcaoTipo;
			$Autor = $its->Autor;
			if($Autor != ""){
				$tam_max = 23;
				if (strlen($Autor) > $tam_max){
					$Autor = substr($Autor, 0, $tam_max);
					$Autor = substr($Autor, 0, strrpos($Autor, " "))."...";
				} else {
					$Autor = $Autor;
				}
			}else{
				$Autor = "-";
			}

			$Reu = $its->Reu;
			if($Reu != ""){
				$tam_max = 23;
				if (strlen($Reu) > $tam_max){
					$Reu = substr($Reu, 0, $tam_max);
					$Reu = substr($Reu, 0, strrpos($Reu, " "))."...";
				} else {
					$Reu = $Reu;
				}
			}else{
				$Reu = "-";
			}
			$PrJudicial = $its->ProcessoJudicialNumero;
			if($PrJudicial != ""){ //0000818-14.2015.5.10.0004
				$p1 = substr($PrJudicial,0,7);
				$p2 = substr($PrJudicial,7,2);
				$p3 = substr($PrJudicial,9,4);
				$p4 = substr($PrJudicial,13,1);
				$p5 = substr($PrJudicial,14,2);
				$p6 = substr($PrJudicial,16,4);
				$ProcessoJud = $p1.'-'.$p2.'.'.$p3.'.'.$p4.'.'.$p5.'.'.$p6;
			}else{$ProcessoJud = "-";}
			$PrJudNumAntigo = $its->ProcessoJudicialNumeroAntigo;
			if($PrJudNumAntigo == ""){ $PrJudNumAntigo="-";}
			$PrAdmin = $its->ProcessoAdministrativoNumero;
			if(($PrAdmin != "")&&($PrAdmin != NULL)){
				$primeiro = substr($PrAdmin, 0, 3);
				$segundo = substr($PrAdmin, 3, 3);
				$terceiro = substr($PrAdmin, 6, 3);
				$quarto = substr($PrAdmin, 9, 4);
				$ProcessoAdmin = $primeiro.".".$segundo.".".$terceiro."/".$quarto;
			}else{$ProcessoAdmin = '...';}
			$AcaoAdvogado = $its->AcaoAdvogado; ?>
			<tr style="border:0;">
				<td width=20% class="middle" style="text-align:left;">
					<a href="<?php echo base_url();?>cacaocivel/detailacaocivel/<?php echo $IdAcao;?>" title="Detalhar solicita��o" style="color:blue;font-size:11px;">
						<?php echo $ProcessoJud?>
					</a>
				</td>
				<td width=10% class="middle" style="text-align:center;text-transform:uppercase;font-size:11px;"><?php echo $ProcessoAdmin?></td>
				<td width=20% class="middle" style="text-align:center;text-transform:uppercase;font-size:11px;"><?php echo $PrJudNumAntigo?></td>

				<?php if($Autor != "-"){ // facilitar o - centralizado quando for vazio?>
					<td width=20% class="middle" style="text-align:left;text-transform:uppercase;font-size:11px;"><?php echo $Autor?></td>
				<?php }else{?>
					<td width=20% class="middle" style="text-align:center;text-transform:uppercase;font-size:11px;"><?php echo $Autor?></td>
				<?php }?>

				<?php if($Reu != "-"){ // facilitar o - centralizado ?>
					<td width=20% class="middle" style="text-align:left;text-transform:uppercase;font-size:11px;"><?php echo $Reu?></td>
				<?php }else{?>
					<td width=20% class="middle" style="text-align:center;text-transform:uppercase;font-size:11px;"><?php echo $Reu?></td>
				<?php }?>

				<td width=10% class="middle" style="text-align:left;font-size:11px;"><?php echo $AcaoAdvogado?></td>
			</tr>
	<?php endforeach;?>
		</tbody>
	</table>
<?php
}
else { ?>
<div class="status_box warning">
	<h6>Aviso!</h6>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Nenhum registro encontrado!
</div>
<?php }?>
<div class="paginationBlock">
	<?php echo $this->pagination->create_links()?>
</div>
<hr>
<a href="<?php echo base_url()."cacaocivel/buscacaocivelindex/";?>" style="text-decoration:none;">
	<input type="button" value="Voltar" onclick="location.href('<?php echo base_url()."cacaocivel/buscacaocivelindex/";?>')" class="botao">
</a>
<?php if($mostrabtn == 'exibe'){?>
<a href="<?php echo base_url()."cacaocivel/geraexcel/";?>" style="text-decoration:none;">
	<input type="button" value="Gerar excel" onclick="location.href('<?php echo base_url()."cacaocivel/geraexcel/";?>')" class="botao">
</a>
<?php } ?>
</fieldset>
</div>
</div>
</div>
<?php $this->load->view('view_rodape');?>
