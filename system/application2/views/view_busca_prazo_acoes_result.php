<?php 
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
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

<fieldset class='visible' style='width:933px'>
<?php 
if(!empty($prazosacoesdetail)&&(sizeof($prazosacoesdetail)>0)){
	if(sizeof($prazosacoesdetail)==1){ ?>
		<div class="status_box success">1 ação encontrada</div>		
	<?php } 
	if(sizeof($prazosacoesdetail)>1){ ?>
		<div class="status_box warning"><?php echo sizeof($prazosacoesdetail)?> ações encontradas</div>
	<?php } ?>
	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>			
				<td width=18% class="middle"><b>ProcessoJudicial</b></td>			
				<td width=42% class="middle"><b>PrazoDescricao</b></td>				
				<td width=15% class="middle"><b>Data</b></td>							
				<td width=25% class="middle"><b>Mensagem</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>	
		<tbody>	
		<?php
		foreach($prazosacoesdetail as $prz):
			$IdAcao = $prz->AcaoId;
			$ProcessoJudicial = $prz->ProcessoJudicial;			
			$PrazoDescricao = $prz->PrazoDescricao;
			$Data = $prz->Data;
			$Dias = $prz->Dias;
			$Mensagem = $prz->Mensagem;			
			$IdAcaoTipo = $prz->AcaoTipoId; //1 - Trab, 2 - Cível
			if($IdAcaoTipo==1){$acaocontroletipo = 'cjuridico/detailacaotrab/';}
			if($IdAcaoTipo==2){$acaocontroletipo = 'cacaocivel/detailacaocivel/';}?>
			<tr style="border:0;">
				<td width=18% class="middle" style="font-size:10px;">
					<a href="<?php echo base_url().$acaocontroletipo.$IdAcao.'/EditVoltaBuscaPrazo#tabs-6';?>">					
						<font color="blue"><?php echo $ProcessoJudicial?></font>
					</a>				
				</td>			
				<td width=42% class="middle" style="font-size:11px;"><?php echo $PrazoDescricao?></td>				
				<td width=15% class="middle" style="font-size:11px;"><?php echo date('d/m/Y',strtotime($Data))?></td>								
				<td width=25% class="middle" style="font-size:11px;">
					<?php if($Dias<0){?>
						<font color="red"><?php echo $Mensagem;?></font>
					<?php }else if(($Dias>=0)&&($Dias<8)){ ?>
						<font color="#FF8C00"><?php echo $Mensagem;?></font>
					<?php }else if($Dias>7){ ?>
						<font color="green"><?php echo $Mensagem;?></font>
					<?php } ?>				
				</td>
			</tr>
	<?php endforeach; ?>		
		</tbody>	
	</table>
<?php }?>
<hr>
<a href="<?php echo base_url()."cjuridico/index/";?>"><input type="button" value="Imprimir" onclick="location.href('<?php echo base_url()."cjuridico/index/";?>')" class="botao"></a>
</fieldset>
</div>
</div>
</div>

<?php $this->load->view('view_rodape');?>