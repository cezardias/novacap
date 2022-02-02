<?php
$this->load->view('view_cabecalho');
$attributes = array('name' =>  'calendar'); ?>

<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/3.3.7/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/jquery/3.2.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/js/3.3.7/bootstrap.min.js"></script>

<style type="text/css" media="screen">
body { /* CONTROLE DE TABS */
  font-family: 'Open Sans', sans-serif;
  font-weight: 300;
}
.tabs {
  max-width: 1020px;
  margin: 0 auto;
  padding: 0 20px;
}
#tab-button {
  display: table;
  table-layout: fixed;
  width: 20%; /* larguda da aba */
  margin: 0;
  padding: 0;
  list-style: none;
}
#tab-button li {
  display: table-cell;
  width: 20%;
}
#tab-button li a {
  display: block;
  padding: .5em;
  background: #eee;
  border: 1px solid #ddd;
  text-align: center;
  color: #000;
  text-decoration: none;
}
#tab-button li:not(:first-child) a {
  border-left: none;
}
#tab-button li a:hover,
#tab-button .is-active a {
  border-bottom-color: transparent;
  background: #fff;
}
.tab-contents {
  padding: .5em 2em 1em;
  border: 1px solid #ddd;
}

.tab-button-outer {
  display: none;
}
.tab-contents {
  margin-top: 20px;
}
@media screen and (min-width: 768px) {
  .tab-button-outer {
    position: relative;
    z-index: 2;
    display: block;
  }
  .tab-select-outer {
    display: none;
  }
  .tab-contents {
    position: relative;
    top: -1px;
    margin-top: 0;
  }
}
</style>

<script type="text/javascript">
function alteraquitado(){
	var quit = document.getElementById("quitado").value;
	var acaoid = document.getElementById("acaoid").value;
	var confirma = confirm("Deseja realmente alterar o Status do processo?")
	if (confirma){
		window.location = "<?php echo base_url();?>cfinanceiro/alteraquitado/"+quit+"/"+acaoid;
	} else {
		return false;
	}
}

function excluiata(IdAta){
    var confirma = confirm("Deseja realmente excluir este registro?")
    if (confirma){
        window.location = "<?php echo base_url();?>catas/delete/"+IdAta;
    } else {
        return false;
    }
}

function excluilote(IdAta,IdLote){
    var confirma = confirm("Deseja realmente excluir este registro?")
    if (confirma){
        window.location = "<?php echo base_url();?>cataslote/delete/"+IdAta+"/"+IdLote;
    } else {
        return false;
    }
}

function excluiloteitem(IdAta,IdLote,IdItem){
    var confirma = confirm("Deseja realmente excluir este registro?")
    if (confirma){
        window.location = "<?php echo base_url();?>catasloteitem/delete/"+IdAta+"/"+IdLote+"/"+IdItem;
    } else {
        return false;
    }
}

$(function() { //CONTROLE DE TABS
	  var $tabButtonItem = $('#tab-button li'),
	      $tabSelect = $('#tab-select'),
	      $tabContents = $('.tab-contents'),
	      activeClass = 'is-active';

	  $tabButtonItem.first().addClass(activeClass);
	  $tabContents.not(':first').hide();

	  $tabButtonItem.find('a').on('click', function(e) {
	    var target = $(this).attr('href');

	    $tabButtonItem.removeClass(activeClass);
	    $(this).parent().addClass(activeClass);
	    $tabSelect.val(target);
	    $tabContents.hide();
	    $(target).show();
	    e.preventDefault();
	  });

	  $tabSelect.on('change', function() {
	    var target = $(this).val(),
	        targetSelectNum = $(this).prop('selectedIndex');

	    $tabButtonItem.removeClass(activeClass);
	    $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
	    $tabContents.hide();
	    $(target).show();
	  });
	});
</script>
<?php
foreach ($atadetail as $ats):
    $IdAta = $ats->Id;
    $AtaNr = $ats->AtaNr;
    $AtaAno = $ats->AtaAno;
    $AtaNumero = $ats->AtaNumero;
    $Valor = $ats->Valor;if($Valor != ""){$Valor = number_format($Valor, 2, ',', '.');}else{$Valor="0,00";}
    $LicitacaoModalidadeId = $ats->LicitacaoModalidadeId;
    $LicitacaoModalidade = $ats->LicitacaoModalidade;
    $ProcessoNr = $ats->ProcessoNr;
    $ProcessoNrSemMascara = $ats->ProcessoNrSemMascara;
    $EmpresaNome = $ats->EmpresaNome;
    $LicitacaoNumero = $ats->LicitacaoNumero;
    $Diretoria = $ats->Diretoria;
    $Objeto = $ats->Objeto;
    $Executor = $ats->Executor;
    $Observacoes = $ats->Observacoes;
    $Sei = $ats->Sei;
    if($Sei != ""){ //00112-00005028/2018-31
        $parte1 = substr($Sei, 0, 5);
        $parte2 = substr($Sei, 5, 8);
        $parte3 = substr($Sei, 13, 4);
        $parte4 = substr($Sei, 17, 2);
        $Sei = $parte1.'-'.$parte2.'/'.$parte3.'-'.$parte4;
    }else{$Sei = '';}
endforeach;

foreach ($atalotedetail as $lts): //Detalhe do Lote
    $IdLote = $lts->Id;
    //$IdAta = $lts->AtaId; evitar redeclaração.
    $LoteNumero = $lts->LoteNumero;
    $Descricao = $lts->Descricao; if($Descricao=='NULL'){$Descricao="";}
    $Empresa = $lts->Empresa;
    $Representante = $lts->Representante;
    $Valor = $lts->Valor; if($Valor != ""){$Valor = number_format($Valor, 2, ',', '.');}else{$Valor="0,00";}
    $QtdItens = $lts->QtdItens;
endforeach;

foreach ($ataloteitemdetail as $ltdtail): //Detalhe do Item do Lote
    $IdItem = $ltdtail->Id;
    $IdLote = $ltdtail->LoteId;
    $Item = $ltdtail->Item;
    $Descricao = $ltdtail->Descricao;
    $Quantidade = $ltdtail->Quantidade;
    $Unidade = $ltdtail->Unidade;
    $ValorUnitario = $ltdtail->ValorUnitario;
    $ValorTotal = $ltdtail->ValorTotal;
endforeach;
?>
<br>
<div class="container" style="width:1018px;">
<div class="tabs" style="margin-left:-35px;" class="border-bottom">

<div class="row">
	<div class="well well-sm" style="width:960px;">
		<font size="5"><?php echo 'ATA: '.$AtaNr.', Lote: '.$LoteNumero?><br></font>
		<font size="3"><?php echo $Descricao?></font><br>
		<font size="3"><b>Empresa: </b><?php echo $Empresa?>, <b>Representante: </b><?php echo $Representante?></font>
	</div>
</div>
<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel3']==1)){ // 3 ATAS E CONTRATOS - ADMINISTRADOR?>
<form method="post" action="<?php echo base_url();?>cataslote/ataloteitemcreate" name="formatalote">
<div class="row" style="width:960px;" class="border-bottom">
	<input type="hidden" class="form-control" name="idata" id="idata" value="<?php echo $IdAta?>">
	<input type="hidden" class="form-control" name="idlote" id="idlote" value="<?php echo $IdLote?>">
	<div class="col-xs-2">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Item</label>
		<input type="text" class="form-control" name="itemlote" id="itemlote" value="" maxlength="6" onkeypress='return SomenteNumero(event)' autofocus required>
	</div>
	<div class="col-xs-2">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Quantidade</label>
		<input type="text" class="form-control" name="itemloteqtd" id="itemloteqtd" value="" maxlength="6" onkeypress='return SomenteNumero(event)' required>
	</div>
	<div class="col-xs-2">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;width:220px;">Unidade</label>
		<select class="form-control" name="itemloteunid" required>
			<option value=""></option>
      <option value="apl">apl</option>
			<option value="cm">cm</option>
      <option value="cm&sup2;">cm&sup2;</option>
			<option value="cm&sup3;">cm&sup3;</option>
			<option value="g">g</option>
			<option value="ha">ha</option>
			<option value="kg">kg</option>
      <option value="km">km</option>
			<option value="km&sup2;">km&sup2;</option>      
      <option value="L">L</option>
			<option value="m">m</option>
			<option value="m&sup2;">m&sup2;</option>
			<option value="m&sup3;">m&sup3;</option>
			<option value="milha">milha</option>
			<option value="mm">mm</option>
      <option value="rm">rm</option>
			<option value="t">t</option>
			<option value="und">und</option>
		</select>
	</div>
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Valor unit&aacute;rio</label>
		<input type="text" class="form-control" name="itemlotevalorunit" id="itemlotevalorunit" value="" style="width:160px;text-align:right;" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required>
	</div>
	<div class="col-xs-12">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px">Descri&ccedil;&atilde;o</label>
		<input type="text" class="form-control" name="itemlotedesc" id="itemlotedesc" value="" style="text-transform: uppercase;width:935px;">
	</div>
</div>
<div class="text-left" style="margin-left:0px;width:950px;"><hr>
<input class="btn btn-primary btnpequenomin" type="submit" value="Adicionar">
<hr>
</div>
</form>
<?php }
//print_r($atalotedetail);
$nivel = $this->session->userdata('usuarionivel');
if(!empty($ataloteitemdetail)&&(sizeof($ataloteitemdetail)>0)){?>
<div class="row">
	<div class="col-md-12">
		<table class="table" style="width:960px;margin-left:-15px;">
			<thead>
				<tr style="background-color:#D3D3D3">
					<th style="width:30px;">Item</th>
					<th style="width:370px;text-align:center;">Descrição</th>
					<th style="width:50px;text-align:center;">Qtd</th>
					<th style="width:30px;text-align:center;">Unidade</th>
					<th style="width:70px;text-align:center;">Valor Unit</th>
					<th style="width:70px;text-align:center;">Valor Total</th>
					<th style="width:10px;text-align:center;">Alterar</th>
					<th style="width:10px;text-align:center;">Apagar</th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($ataloteitemdetail as $itens):
    			$IdItem = $itens->Id;
    			$IdLoteItem = $itens->LoteId;
    			$Item = $itens->Item;
    			$Descricao = $itens->Descricao; if($Descricao=='NULL'){$Descricao="-";}
    			$Quantidade = $itens->Quantidade;
    			$Unidade = $itens->Unidade;
    			$ValorUnitario = $itens->ValorUnitario; if($ValorUnitario != ""){$ValorUnitario = number_format($ValorUnitario, 2, ',', '.');}else{$ValorUnitario="0,00";}
    			$ValorTotal = $itens->ValorTotal; if($ValorTotal != ""){$ValorTotal = number_format($ValorTotal, 2, ',', '.');}else{$ValorTotal="0,00";}?>
				<tr>
					<td style="width:30px;"><?php echo $Item?></td>
					<td style="width:370px;text-align:justify;"><?php echo strtoupper($Descricao)?></td>
					<td style="width:30px;text-align:center;"><?php echo $Quantidade?></td>
					<td style="width:50px;text-align:center;"><?php echo $Unidade?></td>
					<td style="width:70px;text-align:right;"><?php echo $ValorUnitario?></td>
					<td style="width:70px;text-align:right;"><?php echo $ValorTotal?></td>
					<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel3']==1)){ // 3 ATAS E CONTRATOS - ADMINISTRADOR?>
					<td style="width:10px;text-align:center;">
						<a href="<?php echo base_url()."cataslote/ataloteitemedit/".$IdAta.'/'.$IdLoteItem.'/'.$IdItem;?>" style="text-decoration:none;">
							<img src="<?php echo base_url();?>img/icons/pencil.png" alt="alterar" />
						</a>
					</td>
					<td style="width:10px;text-align:center;">
						<a href="#"	onclick='return excluiloteitem(<?php echo $IdAta?>,<?php echo $IdLoteItem?>,<?php echo $IdItem?>);' title="Deletar este registro.">
							<img src="<?php echo base_url();?>img/icons/delete.png" alt="apagar" />
						</a>
					</td>
					<?php }else{ ?>  
						<td style="width:10px;text-align:center;">-</td>
						<td style="width:10px;text-align:center;">-</td>
					<?php } ?>  
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>
<?php }
else { ?>
<div class="alert alert-warning">
  <strong>Aten&ccedil;&atilde;o!</strong>
  <br>Nenhum Item registrado para o Lote: <?php echo $LoteNumero?>.
</div>
<?php }?>
</div>
<a href="<?php echo base_url()."catas/atadetail/".$IdAta.'#02lotes'?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">
	<button type="button" class="btn btn-primary btnpequenomin" style="margin-left:-15px;">Voltar</button>
</a>
</div>
<br><br>
<?php $this->load->view('view_rodape');?>
