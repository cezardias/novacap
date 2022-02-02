<?php 
$this->load->view('view_cabecalho');
$attributes = array('name' =>  'calendar'); ?>

<script type="text/javascript" src="<?php echo base_url();?>js/ajax.js"></script>
<script language='JavaScript'>
function alterastatus(IdPrazo,Concluido){
	var confirma = confirm("Deseja realmente alterar o status deste prazo?")
	if (confirma){
		window.location = "<?php echo base_url();?>cjuridico/status_prazo/"+IdPrazo+"/"+Concluido;
	} else {
		return false;
	}
}

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
<?php 
if(!empty($prazosresult)&&(sizeof($prazosresult)>0)){
	if(sizeof($prazosresult)==1){
		$res = '1 prazo encontrad';
	}
	if(sizeof($prazosresult)>1){
		$res = sizeof($prazosresult).' prazos encontrados';
	} ?>

	<fieldset class=visible style='width:940px;margin-left:-3px;background-color: #87CEFA;'>
		<font size="5"><?php echo $res?></font>
	</fieldset>	
	
	<fieldset class='visible' style='width:940px;margin-left:-3px;'>
	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>			
				<td width=10% class="middle"><b>Data</b></td>			
				<td width=25% class="middle"><b>Partes</b></td>				
				<td width=20% class="middle"><b>Processo Judicial</b></td>							
				<td width=20% class="middle"><b>Descrição</b></td>
				<td width=20% class="middle"><b>Observaçãoo</b></td>
				<td width=5% class="middle"><b>Concl.</b></td>
				<td width=5% class="middle"><b>Altera</b></td>
				<td width=5% class="middle"><b>Deleta</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>	
		<tbody>	
		<?php
		foreach($prazosresult as $prz):
			$IdPrazo = $prz->PrazoId;
			$Data = $prz->Data;
			$Partes = utf8_encode($prz->Partes);
			$PrJudicial = $prz->ProcessoJudicial;
			$p1 = substr($PrJudicial,0,7);
			$p2 = substr($PrJudicial,7,2);
			$p3 = substr($PrJudicial,9,4);
			$p4 = substr($PrJudicial,13,1);
			$p5 = substr($PrJudicial,14,2);
			$p6 = substr($PrJudicial,16,4);
			$ProcessoJudicial = $p1.'-'.$p2.'.'.$p3.'.'.$p4.'.'.$p5.'.'.$p6;			
			
			$PrazoDescricao = utf8_encode($prz->PrazoDescricao);
			$Observacoes = utf8_encode($prz->Observacoes);
			$Concluido = $prz->Concluido;
			if($Concluido==0){$status=utf8_decode('NÃO');}
			if($Concluido==1){$status='SIM';}
			$IdAcao = $prz->AcaoId;		
			$IdAcaoTipo = $prz->AcaoTipoId; //1 - Trab, 2 - Cível
			if($IdAcaoTipo==1){$acaocontroletipo = 'cjuridico/detailacaotrab/';}
			if($IdAcaoTipo==2){$acaocontroletipo = 'cacaocivel/detailacaocivel/';}?>
			<tr style="border:0;">
				<td class="middle" style="font-size:10px;">
					<a href="<?php echo base_url().$acaocontroletipo.$IdAcao.'/EditVoltaBuscaPrazo#tabs-6';?>">					
						<font color="blue"><?php echo date('d/m/Y',strtotime($Data))?></font>
					</a>				
				</td>			
				<td class="middle" style="font-size:10px;text-transform:uppercase;"><?php echo $Partes?></td>				
				<td class="middle" style="font-size:10px;text-transform:uppercase;"><?php echo $ProcessoJudicial?></td>				
				<td class="middle" style="font-size:10px;text-transform:uppercase;"><?php echo $PrazoDescricao?></td>
				<td class="middle" style="font-size:10px;text-transform:uppercase;"><?php echo $Observacoes?></td>
				<td class="middle" style="font-size:10px;">
					<?php 
					if($Concluido==0){ $status = 'unchecked_checkbox.png'; };
					if($Concluido==1){ $status = 'checked_checkbox.png'; };
				 	?>
					<a href="#"	onclick='return alterastatus(<?php echo $IdPrazo?>,<?php echo $Concluido?>);' style="text-decoration:none;">
						<img src="<?php echo base_url();?>img/icons/<?php echo $status?>" width="18px"/>
					</a>					
				</td>				
				<td class="middle">
					<a href="<?php echo base_url(); ?>cjuridico/editaudiencia/<?php echo $IdAcao;?>/<?php echo $IdPrazo;?>/<?php echo 'EditVoltaBuscaPrazo';?>" title="Alterar este registro.">					
						<img src="<?php echo base_url();?>img/icons/pencil.png" alt="editar" />
					</a>
				</td>
				<td class="middle">						
					<a href="#"	onclick='return excluiaudiencia(<?php echo $IdAcao;?>,<?php echo $IdPrazo;?>,<?php echo $flagAudiFiltro;?>);' title="Deletar este registro.">
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
	Nenhum registro encontrado!
</div>
<?php }?>
<hr>
<a href="<?php echo base_url()."cjuridico/buscaprazoindex";?>"><input type="button" value="Voltar" onclick="location.href('<?php echo base_url()."cjuridico/buscaudienciaindex/";?>')" class="botao"></a>
<a href="<?php echo base_url()."cjuridico/relatprazos/";?>" target="_blank"><input type="button" value="Imprimir" onclick="location.href('<?php echo base_url()."cjuridico/relataudiencia/";?>')" class="botao"></a>
</fieldset>
</div>
</div>
</div>

<?php $this->load->view('view_rodape');?>