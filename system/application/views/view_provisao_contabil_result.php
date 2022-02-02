<?php
$this->load->view('view_cabecalho');
$attributes = array('name' =>  'calendar'); ?>

<script type="text/javascript" src="<?php echo base_url();?>js/ajax.js"></script>
<script language='JavaScript'>
function validaudiencias(){
	DataHoraIni = document.formaudiencias.AudienciaDataHoraIni.value;
	DataHoraFim = document.formaudiencias.AudienciaDataHoraFim.value;
	if ((DataHoraIni!="")&&(DataHoraFim=="")){
		alert("Por favor, informe a data inicial e final");
		return false;
	}
	if ((DataHoraIni=="")&&(DataHoraFim!="")){
		alert("Por favor, informe a data inicial e final");
		return false;
	}
}

function excluiaudiencia(IdAcao,IdAudi,flagAudiFiltro){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>caudiencia/delete/"+IdAcao+"/"+IdAudi+"/"+flagAudiFiltro;
	} else {
		return false;
	}
}
</script>

<div id="caixa7">
<div id="tabs">
<div id="tabs-1">
<fieldset class='visible' style='width:938px; margin-left: -3px;'>
<?php
//print_r($auditoriaresult);
//echo sizeof($auditoriaresult);
$mostrabtn = 'oculta';
if(!empty($auditoriaresult)&&(sizeof($auditoriaresult)>1)){
	$mostrabtn = 'exibe';
	if(sizeof($auditoriaresult)==1){ ?>
		<div class="status_box success" style="font-size: 16px;"><b>1</b> processo encontrado</div>
	<?php }
	if(sizeof($auditoriaresult)>1){ ?>
		<div class="status_box success" style="font-size: 16px;"><b><?php echo sizeof($auditoriaresult)-1?></b> processos encontrados</div>
	<?php } ?>
	<table class="data_grid" cellspacing="0">
		<thead>
		<!--
			<tr>
				<td width=5% class="middle"><b>Tipo</b></td>
				<td width=25% class="middle"><b>Interessado</b></td>
				<td width=15% class="middle"><b>Processo judicial</b></td>
				<td width=25% class="middle"><b>Assunto</b></td>
				<td width=10% class="middle" style="text-align:right;"><b>Vlr causa</b></td>
				<td width=10% class="middle" style="text-align:right;"><b>Vlr sent.</b></td>
				<td width=10% class="middle" style="text-align:right;"><b>Vlr cond.</b></td>
			</tr> -->
		</thead>
		<tfoot>
		</tfoot>
		<tbody>
		<?php
		foreach($auditoriaresult as $aud):
			$Tipo = $aud->Tipo;
			$InteressadoNome = $aud->InteressadoNome;
			$ProcessoJud = $aud->ProcessoJudicialNumero;
			$PrAdmin = $aud->ProcessoAdministrativoNumero;
			$Assunto = $aud->Assunto;
			$ProbabilidadeDePerda = $aud->ProbabilidadeDePerda;
			$CausaValor = $aud->CausaValor;
			if($CausaValor != ""){$CausaValor = number_format($CausaValor, 2, ',', '.');}else{$CausaValor="0,00";}
			$SetencaValor = $aud->SentencaValor;
			if($SetencaValor != ""){$SetencaValor = number_format($SetencaValor, 2, ',', '.');}else{$SetencaValor="0,00";}
			$CondenacaoValor = $aud->CondenacaoValor;
			if($CondenacaoValor != ""){$CondenacaoValor = number_format($CondenacaoValor, 2, ',', '.');}else{$CondenacaoValor="0,00";}
			$AcordaoValor = $aud->AcordaoValor;
			if($AcordaoValor != ""){$AcordaoValor = number_format($AcordaoValor, 2, ',', '.');}else{$AcordaoValor="0,00";}
			$Situacao = $aud->Situacao;
			if($Tipo!='zTOTAL'){?>
			<!--  <tr style="border:0;">
				<td width=10% class="middle" style="font-size:11px;"><?php echo $Tipo?></td>
				<td width=15% style="font-size:11px;"><?php echo $InteressadoNome?></td>
				<td width=40% class="middle" style="font-size:11px;"><?php echo $ProcessoJud?></td>
				<td width=25% style="font-size:11px;"><?php echo $Assunto?></td>
				<td width=5% class="middle" style="font-size:11px;text-align:right;"><?php echo $CausaValor?></td>
				<td width=5% class="middle" style="font-size:11px;text-align:right;"><?php echo $SetencaValor?></td>
				<td width=5% class="middle" style="font-size:11px;text-align:right;"><?php echo $CondenacaoValor?></td>
			</tr> -->
	<?php } endforeach; ?>
		</tbody>
	</table>
<?php
}
else { ?>
<div class="status_box warning">
	<h6>Aviso!</h6>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Nenhum processo encontrado!
</div>
<?php }?>
<fieldset class=visible style='width:915px;background-color: #87CEFA; margin-top: -13px;'>
	<font size="5">Visualizar resultado em:</font>
</fieldset>
<?php if($mostrabtn == 'exibe'){?>
<a href="<?php echo base_url()."cjuridico/relatodeprovcont/";?>" target="_blank"><input type="button" value=".PDF" onclick="location.href('<?php echo base_url()."cjuridico/relataudiencia/";?>')" class="botao" style="width: 150px;"></a>
<a href="<?php echo base_url()."cjuridico/relatodeprovcont/";?>" style="text-decoration:none;">
	<input type="button" value=".EXCEL" onclick="location.href('<?php echo base_url()."cjuridico/relatodeprovcont/";?>')" class="botao" style="width: 150px;">
</a>
<a href="<?php echo base_url()."cjuridico/buscauditoriaindex";?>"><input type="button" value="Nova Pesequisa &#128270;" onclick="location.href('<?php echo base_url()."cjuridico/buscauditoriaindex/";?>')" class="botao" style="width: 150px;"></a>
<?php } ?>
</fieldset>
</div>
</div>
</div>

<?php $this->load->view('view_rodape');?>
