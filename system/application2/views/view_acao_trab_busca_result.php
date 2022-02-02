<?php
$this->load->view('view_cabecalho');
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
$mostrabtn = 'oculta';
if(!empty($docresult)&&(sizeof($docresult)>0)){
	$mostrabtn = 'exibe';
	if($total_linhas == 1){
		$total_linhas_mensagem = ' 1 a&ccedil;&atilde;o trabalhista encontrada.';
	}
	if($total_linhas > 1){
		$total_linhas_mensagem = ' '.number_format($total_linhas, 0, ',', '.').' a&ccedil;&otilde;es trabalhistas encontradas.';
	}?>

	<fieldset class=visible style='width:940px;margin-left:-3px;background-color: #87CEFA;'>
		<font size="5"><?php echo $total_linhas_mensagem;?></font>
	</fieldset>

	<fieldset class=visible style='width:940px;margin-left: -3px;'><legend></legend>
	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>
				<td width=18%><b>Processo judicial</b></td>
				<td width=15% class="middle"><b>Pr. administrativo</b></td>
				<td width=27% class="middle" style="text-align:center;"><b>Autor</b></td>
				<td width=26% class="middle" style="text-align:center;"><b>Assunto</b></td>
				<td width=14% class="middle" style="text-align:left;"><b>Advogado</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>
		<tbody>
		<?php
		$Reu='';
		//print_r($docresult);
		foreach($docresult as $its):
			$IdAcao = $its->Id;
			$AcaoTipo = $its->AcaoTipo;
			$Autor = $its->Autor;
			if($Autor != ""){
				$tam_max = 33;
				if (strlen($Autor) > $tam_max){
					$Autor = substr($Autor, 0, $tam_max);
					$Autor = substr($Autor, 0, strrpos($Autor, " "))."...";
				} else {
					$Autor = $Autor;
				}
			}else{
				$Autor = "-";
			}

			$Assunto = $its->Assunto;
			if(($Assunto != "")&&($Assunto != 'null')){
				$tam_max = 32;
				if (strlen($Assunto) > $tam_max){
					$Reu = substr($Assunto, 0, $tam_max);
					$Reu = substr($Assunto, 0, strrpos($Assunto, " "))."...";
				} else {
					$Assunto = $Assunto;
				}
			}else{
				$Assunto = "-";
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
			}else{$ProcessoJud = "";}

			$PrAdmin = $its->ProcessoAdministrativoNumero;
			if(($PrAdmin != "")&&($PrAdmin != NULL)){
				$primeiro = substr($PrAdmin, 0, 3);
				$segundo = substr($PrAdmin, 3, 3);
				$terceiro = substr($PrAdmin, 6, 3);
				$quarto = substr($PrAdmin, 9, 4);
				$ProcessoAdmin = $primeiro.".".$segundo.".".$terceiro."/".$quarto;
			}else{$ProcessoAdmin = '-';}
			$AcaoAdvogado = $its->AcaoAdvogado;
			// $textoAdvNome = $AcaoAdvogado;
			// $tam_max = 30;
			// if (strlen($textoAdvNome) > $tam_max){
			// 	$advogado = substr($textoAdvNome, 0, $tam_max);
			// 	$advogado = substr($advogado, 0, strrpos($advogado, " "))."...";
			// } else {
			// 	$advogado = $textoAdvNome;
			// }?>
			<tr style="border:0;">
				<td>
					<a href="<?php echo base_url();?>cjuridico/detailacaotrab/<?php echo $IdAcao;?>/<?php echo 'VoltaBuscaAcao';?>" title="Detalhar solicita&ccedil;&atilde;o" style="color:blue;font-size:11px;"><?php echo $ProcessoJud?></a>
				</td>
				<td class="middle" style="text-align:center;font-size:11px;"><?php echo $ProcessoAdmin?></td>
				<td class="middle" style="text-align:left;text-transform:uppercase;font-size:11px;"><?php echo utf8_encode($Autor)?></td>
				<td class="middle" style="text-align:left;text-transform:uppercase;font-size:11px;"><?php echo utf8_encode($Assunto)?></td>
				<td class="middle" style="text-align:left;font-size:11px;"><?php echo utf8_encode($AcaoAdvogado)?></td>
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
	<?php echo $this->pagination->create_links();?>
</div>
<hr>
<a href="<?php echo base_url()."cjuridico/buscacaotrabindex/";?>" style="text-decoration:none;">
	<input type="button" value="Voltar" onclick="location.href('<?php echo base_url()."cjuridico/buscacaotrabindex/";?>')" class="botao">
</a>
<?php if($mostrabtn == 'exibe'){?>
<a href="<?php echo base_url()."cjuridico/geraexcel/";?>" style="text-decoration:none;">
	<input type="button" value="Gerar excel" onclick="location.href('<?php echo base_url()."cjuridico/geraexcel/";?>')" class="botao">
</a>
<?php } ?>
</fieldset>
</div>
</div>
</div>

<?php $this->load->view('view_rodape');?>
