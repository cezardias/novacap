<?php 
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' =>  'calendar');
?>

<script language="JavaScript">
function validasolproc(){
	assunto = document.formsolproc.proc.value;
	if (assunto==""){
		alert("Por favor, digite o número do processo e clique em Continuar!");	
		return false;
	}	
}

function excluiprazo(AcaoId,IdPrazo,AcaoTipoId){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>cprazocivel/delete/"+AcaoId+"/"+IdPrazo+"/"+AcaoTipoId;
	} else {
		return false;
	}
}
</script>

<h2>Solicitação de processos</h2>

<div id="caixa7">
<div id="tabs">
<ul>
	<li><a href="#tabs-1">Enviar processo</a></li>
	<li><a href="#tabs-2">A receber</a></li>	
	<li><a href="#tabs-3">Enviados</a></li>
	<li><a href="#tabs-4">Histórico</a></li>
</ul>

<fieldset class='visible' style='width:933px'>
<div id="tabs-1">

<?php 
//print_r($prdetail); 
foreach ($prdetail as $acao):
	$IdAcao = $acao->Id;
	$AcaoTipoId = $acao->AcaoTipoId;
	$PrJudicial = $acao->ProcessoJudicialNumero;
	$PrJudicial = str_replace("\'", "",$PrJudicial);
	if($PrJudicial != ""){ //0000818-14.2015.5.10.0004
		$p1 = substr($PrJudicial,0,7);
		$p2 = substr($PrJudicial,7,2);
		$p3 = substr($PrJudicial,9,4);
		$p4 = substr($PrJudicial,13,1);
		$p5 = substr($PrJudicial,14,2);
		$p6 = substr($PrJudicial,16,4);
		$ProcessoJud = $p1.'-'.$p2.'.'.$p3.'.'.$p4.'.'.$p5.'.'.$p6; 		
	}else{$ProcessoJud = "";}
	$PrJudicialAnt = $acao->ProcessoJudicialNumeroAntigo;
	$PrJudicialAnt = str_replace("\'", "",$PrJudicialAnt);
	/* if($PrJudicialAnt != ""){ //0000818-14.2015.5.10.0004
		$p1 = substr($PrJudicialAnt,0,7);
		$p2 = substr($PrJudicialAnt,7,2);
		$p3 = substr($PrJudicialAnt,9,4);
		$p4 = substr($PrJudicialAnt,13,1);
		$p5 = substr($PrJudicialAnt,14,2);
		$p6 = substr($PrJudicialAnt,16,4);
		$PrJudicialAnt = $p1.'-'.$p2.'.'.$p3.'.'.$p4.'.'.$p5.'.'.$p6; 		
	}else{$PrJudicialAnt = "";} */
	$VaraId = $acao->VaraId;
	$PrAdmin = $acao->ProcessoAdministrativoNumero;
	if($PrAdmin != ""){ //112.000.222/2016
		$primeiro = substr($PrAdmin, 0, 3);
		$segundo = substr($PrAdmin, 3, 3);
		$terceiro = substr($PrAdmin, 6, 3);
		$quarto = substr($PrAdmin, 9, 4);
		$ProcessoAdmin = $primeiro.".".$segundo.".".$terceiro."/".$quarto; 		
	}else{$ProcessoAdmin = "";}	
	$CausaValor = $acao->CausaValor; if($CausaValor != ""){$CausaValor = number_format($CausaValor, 2, ',', '.');}else{$CausaValor="0,00";}
	$SentencaValor = $acao->SentencaValor; if($CausaValor != ""){$SentencaValor = number_format($SentencaValor, 2, ',', '.');}else{$SentencaValor="0,00";}
	$CondenacaoValor = $acao->CondenacaoValor; if($CausaValor != ""){$CondenacaoValor = number_format($CondenacaoValor, 2, ',', '.');}else{$CondenacaoValor="0,00";}
	$ProbaDePerdaId = $acao->ProbabilidadeDePerda;
	$FundamentoLegal = $acao->FundamentoLegal;
	$ObsAcaoCivil = $acao->Observacoes;
	$Ativo = $acao->Ativo;
	$Caixa = $acao->Caixa;
	$DtAjuiz = $acao->DataDoAjuizamento; if($DtAjuiz==""){$DtAjuiz='';}else{$DtAjuiz = date('d/m/Y',strtotime($DtAjuiz));}
	$Sisprot = $acao->Sisprot; if(($Sisprot=="")||($Sisprot=='NULL')){$Sisprot='';}
	$AcordaoValor = $acao->AcordaoValor; if($AcordaoValor != ""){$AcordaoValor = number_format($AcordaoValor, 2, ',', '.');}else{$AcordaoValor="0,00";}
	$CausaValorTipo = $acao->CausaValorTipo;
	$SentencaValorTipo = $acao->SentencaValorTipo;
	$CondenacaoValorTipo = $acao->CondenacaoValorTipo;
	$AcordaoValorTipo = $acao->AcordaoValorTipo;
	$DataDeExtincao = $acao->DataDeExtincao; if($DataDeExtincao==""){$DataDeExtincao='';}else{$DataDeExtincao = date('d/m/Y',strtotime($DataDeExtincao));}
	$PalavrasChave = $acao->PalavrasChave;
	$ProcessoPai = $acao->ProcessoPai;
endforeach; ?>

<h3>Detalhe processo</h3>
<form method="post" action="<?php echo base_url();?>Csolicitaproc/createandamento" name="formandamentoproc" onsubmit="return validasolproc()"> 

<fieldset class='visible' style='width:880px'>
<input type="hidden" name="idacao" id="idacao" value="<?php //echo $IdAcao;?>" maxlength="10" size="10"/>
ProcessoId<br>
RemetenteId<br>
DataHoraEnvio<br>
DestinatarioId<br>
DataHoraRecebimento
</form>
</fieldset>
</div>

<!-- segunda aba -->
<div id="tabs-2">
<fieldset class='visible' style='width:875px'>

<?php if(!empty($interessadoacao)&&(sizeof($interessadoacao)>0)){?>
<h3>Interessados</h3>
	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>				
				<td width=90%><b>Nome</b></td>
				<td width=20% class="middle"><b>Tipo</b></td>
				<td width=10% class="middle"><b>Deletar</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>	
		<tbody>	
		<?php
		foreach($interessadoacao as $ass):
			$IdRegInter = $ass->Id;
			$AcoesInterId = $ass->AcoesId;
			$InteressadoNome = $ass->InteressadoNome;
			$InteressadoTipo = $ass->InteressadoTipo;?>
			<tr style="border:0;">	
				<td width=70% style="text-transform: uppercase;"><?php echo $InteressadoNome;?></td>
				<?php if($InteressadoTipo==1){?>
					<td width=20% class="middle">AUTOR</td>
				<?php 
				}else if($InteressadoTipo==2){ ?>
					<td width=20% class="middle">RÉU</td>
				<?php }	
				if($Ativo==1){?>
				<td width=10% class="middle">
					<a href="#"	onclick='return excluinteressado(<?php echo $AcoesInterId;?>,<?php echo $IdRegInter;?>,<?php echo $AcaoTipoId;?>);' title="Deletar este registro."><img src="<?php echo base_url();?>img/icons/delete.png" alt="apagar" /></a>				
				</td>	
				<?php }else{?>
					<td width=10% class="middle">-</td>
				<?php } ?>
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
</fieldset>
</div>

<!-- terceria coluna aba -->
<div id="tabs-3">
<fieldset class='visible' style='width:880px'>

<?php if(!empty($interessadoacao)&&(sizeof($interessadoacao)>0)){?>
<h3>Interessados</h3>
	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>				
				<td width=90%><b>Nome</b></td>
				<td width=20% class="middle"><b>Tipo</b></td>
				<td width=10% class="middle"><b>Deletar</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>	
		<tbody>	
		<?php
		foreach($interessadoacao as $ass):
			$IdRegInter = $ass->Id;
			$AcoesInterId = $ass->AcoesId;
			$InteressadoNome = $ass->InteressadoNome;
			$InteressadoTipo = $ass->InteressadoTipo;?>
			<tr style="border:0;">	
				<td width=70% style="text-transform: uppercase;"><?php echo $InteressadoNome;?></td>
				<?php if($InteressadoTipo==1){?>
					<td width=20% class="middle">AUTOR</td>
				<?php 
				}else if($InteressadoTipo==2){ ?>
					<td width=20% class="middle">RÉU</td>
				<?php }	
				if($Ativo==1){?>
				<td width=10% class="middle">
					<a href="#"	onclick='return excluinteressado(<?php echo $AcoesInterId;?>,<?php echo $IdRegInter;?>,<?php echo $AcaoTipoId;?>);' title="Deletar este registro."><img src="<?php echo base_url();?>img/icons/delete.png" alt="apagar" /></a>				
				</td>	
				<?php }else{?>
					<td width=10% class="middle">-</td>
				<?php } ?>
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
</fieldset>
</div>

<!-- quarta aba -->
<div id="tabs-4">
<fieldset class='visible' style='width:880px'>

<?php if(!empty($interessadoacao)&&(sizeof($interessadoacao)>0)){?>
<h3>Interessados</h3>
	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>				
				<td width=90%><b>Nome</b></td>
				<td width=20% class="middle"><b>Tipo</b></td>
				<td width=10% class="middle"><b>Deletar</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>	
		<tbody>	
		<?php
		foreach($interessadoacao as $ass):
			$IdRegInter = $ass->Id;
			$AcoesInterId = $ass->AcoesId;
			$InteressadoNome = $ass->InteressadoNome;
			$InteressadoTipo = $ass->InteressadoTipo;?>
			<tr style="border:0;">	
				<td width=70% style="text-transform: uppercase;"><?php echo $InteressadoNome;?></td>
				<?php if($InteressadoTipo==1){?>
					<td width=20% class="middle">AUTOR</td>
				<?php 
				}else if($InteressadoTipo==2){ ?>
					<td width=20% class="middle">RÉU</td>
				<?php }	
				if($Ativo==1){?>
				<td width=10% class="middle">
					<a href="#"	onclick='return excluinteressado(<?php echo $AcoesInterId;?>,<?php echo $IdRegInter;?>,<?php echo $AcaoTipoId;?>);' title="Deletar este registro."><img src="<?php echo base_url();?>img/icons/delete.png" alt="apagar" /></a>				
				</td>	
				<?php }else{?>
					<td width=10% class="middle">-</td>
				<?php } ?>
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
</fieldset>
</div>

</div>
</div>

<?php $this->load->view('view_rodape');?>