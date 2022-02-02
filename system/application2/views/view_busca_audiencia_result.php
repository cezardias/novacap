<?php 
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
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

<fieldset class='visible' style='width:933px'>
<?php 
//print_r($audienciasresult);
//echo sizeof($audienciasresult);
$mostrabtn = 'oculta';
if(!empty($audienciasresult)&&(sizeof($audienciasresult)>0)){
	$mostrabtn = 'exibe';
	if(sizeof($audienciasresult)==1){ ?>
		<div class="status_box success">1 audiência encontrada</div>		
	<?php } 
	if(sizeof($audienciasresult)>1){ ?>
		<div class="status_box warning"><?php echo sizeof($audienciasresult)?> audiências encontradas</div>
	<?php } ?>
	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>	
				<td width=10% class="middle"><b>Data-hora</b></td>			
				<td width=15% class="middle"><b>Tipo de audiência<br>Vara</b></td>				
				<td width=40% class="middle"><b>Proc. Jidicial<br>Autor/Réu</b></td>							
				<td width=25% class="middle"><b>Preposto<br>Advogado</b></td>
				<td width=5% class="middle"><b>Altera</b></td>
				<td width=5% class="middle"><b>Deleta</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>	
		<tbody>	
		<?php
		foreach($audienciasresult as $aud):	
			$IdAudi = $aud->Id;
			$AudienciaDataHora = $aud->AudienciaDataHora;
			$AudienciaPreposto = utf8_encode($aud->AudienciaPreposto); 
			if(strlen($AudienciaPreposto)<2){$AudienciaPreposto="-";}
			$AudienciaTipo = utf8_encode($aud->AudienciaTipo);
			$Autor = utf8_encode($aud->Autor); if($Autor==""){$Autor="-";}
			$Reu = $aud->Reu; if($Reu==""){$Reu="-";}			
			$IdAcao = $aud->AcaoId;
			$IdVara = $aud->VaraId;
			$Vara = utf8_encode($aud->Vara);
			$ProcessoJudicialNumero = $aud->ProcessoJudicialNumero;
			if($ProcessoJudicialNumero != ""){ //0000818-14.2015.5.10.0004
				$p1 = substr($ProcessoJudicialNumero,0,7);
				$p2 = substr($ProcessoJudicialNumero,7,2);
				$p3 = substr($ProcessoJudicialNumero,9,4);
				$p4 = substr($ProcessoJudicialNumero,13,1);
				$p5 = substr($ProcessoJudicialNumero,14,2);
				$p6 = substr($ProcessoJudicialNumero,16,4);
				$ProcessoJud = $p1.'-'.$p2.'.'.$p3.'.'.$p4.'.'.$p5.'.'.$p6; 		
			}else{$ProcessoJud = "";}				
			$PrAdmin = $aud->ProcessoAdministrativoNumero;
			if($PrAdmin != ""){ //112.000.222/2016
				$primeiro = substr($PrAdmin, 0, 3);
				$segundo = substr($PrAdmin, 3, 3);
				$terceiro = substr($PrAdmin, 6, 3);
				$quarto = substr($PrAdmin, 9, 4);
				$ProcessoAdmin = $primeiro.".".$segundo.".".$terceiro."/".$quarto; 		
			}else{$ProcessoAdmin = "";}							
			$AdvogadoId = $aud->AdvogadoId;
			$AcaoTipo = utf8_encode($aud->AcaoTipo);
			$AdvogadoNome = utf8_encode($aud->AdvogadoNome);?>
			<tr style="border:0;">
				<td width=10% class="middle" style="font-size:11px;"><?php echo date('d/m/Y',strtotime($AudienciaDataHora)).'<br>'.date('H:i',strtotime($AudienciaDataHora));?></td>			
				<td width=15% class="middle" style="font-size:11px;"><?php echo $AudienciaTipo.'<br>'.$Vara;?></td>				
				<td width=40% class="middle" style="font-size:11px;">
					<a href="<?php echo base_url();?>cjuridico/detailacaotrab/<?php echo $IdAcao;?>" title="Detalhar solicita��o" style="text-decoration:none;color:blue;"><?php echo $ProcessoJud.'<br>' ?></a>
					<?php echo $Autor.' / '.$Reu?>				
				</td>				
				<td width=25% class="middle" style="font-size:11px;"><?php echo '<b>'.$AudienciaPreposto.'</b><br>'.$AdvogadoNome;?></td>
				<td class="middle" width=5%>
					<a href="<?php echo base_url(); ?>cjuridico/editaudiencia/<?php echo $IdAcao;?>/<?php echo $IdAudi;?>" title="Alterar este registro.">					
						<img src="<?php echo base_url();?>img/icons/pencil.png" alt="editar" />
					</a>
				</td>
				<td class="middle" width=5%>						
					<a href="#"	onclick='return excluiaudiencia(<?php echo $IdAcao;?>,<?php echo $IdAudi;?>,<?php echo $flagAudiFiltro;?>);' title="Deletar este registro.">
						<img src="<?php echo base_url();?>img/icons/delete.png" alt="apagar" />
					</a>																								
				</td>				
			</tr>
	<?php endforeach; ?>		
		</tbody>	
	</table>
<?php
} 
else { ?>
<div class="status_box warning">
	<h6>Aviso!</h6>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Nenhuma audi�ncia encontrada!
</div>
<?php }?>
<hr>
<a href="<?php echo base_url()."cjuridico/buscaudienciaindex";?>"><input type="button" value="Voltar" onclick="location.href('<?php echo base_url()."cjuridico/buscaudienciaindex/";?>')" class="botao"></a>
<a href="<?php echo base_url()."cjuridico/relataudiencia/";?>" target="_blank"><input type="button" value="Gerar PDF" onclick="location.href('<?php echo base_url()."cjuridico/relataudiencia/";?>')" class="botao"></a>
<?php if($mostrabtn == 'exibe'){?>
<a href="<?php echo base_url()."cjuridico/geraexcelaudiencia/";?>" style="text-decoration:none;">
	<input type="button" value="Gerar excel" onclick="location.href('<?php echo base_url()."cjuridico/geraexcelaudiencia/";?>')" class="botao">
</a>
<?php } ?>
</fieldset>
</div>
</div>
</div>

<?php $this->load->view('view_rodape');?>