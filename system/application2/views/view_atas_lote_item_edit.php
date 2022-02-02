<?php 
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
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
    $Observacoes = $ats->Observacoes; if($Observacoes=='NULL'){$Observacoes="";}
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
    $LoteDescricao = $lts->Descricao; if($LoteDescricao=='NULL'){$LoteDescricao="";}
    $Empresa = $lts->Empresa;
    $Representante = $lts->Representante;
    $Valor = $lts->Valor; if($Valor != ""){$Valor = number_format($Valor, 2, ',', '.');}else{$Valor="0,00";}
    $QtdItens = $lts->QtdItens;
endforeach;

foreach ($ataloteitemunicodetail as $ltdtail): //Detalhe do Item do Lote
    $IdItem = $ltdtail->Id;
    $IdLoteItem = $ltdtail->LoteId;
    $Item = $ltdtail->Item;
    $DescricaoItem = $ltdtail->Descricao; if($DescricaoItem=='NULL'){$DescricaoItem="";}
    $QuantidadeItem = $ltdtail->Quantidade;
    $UnidadeItem = strtoupper($ltdtail->Unidade);
    $ValorUnitItem = $ltdtail->ValorUnitario; if($ValorUnitItem != ""){$ValorUnitItem = number_format($ValorUnitItem, 2, ',', '.');}else{$ValorUnitItem="0,00";}
    $ValorTotItem = $ltdtail->ValorTotal;
endforeach;?>

<br>
<div class="container" style="width:1018px;">

<div class="tabs" style="margin-left:-35px;" class="border-bottom">
  <div id="tabs">


<div class="row">
	<div class="well well-sm" style="width:960px;">
		<font size="5">Alterar Item: <?php echo $Item?> do Lote: <?php echo $LoteNumero?> da ATA: <?php echo $AtaNr?></font><br>
		<font size="3">Descrição do Lote: <?php echo $LoteDescricao?></font>
	</div>
</div>

<div id="tab02" class="tab-contents" style="width:960px;">
<form method="post" action="<?php echo base_url();?>cataslote/ataloteitemsave" name="formatalote">
<input type="hidden" class="form-control" name="idloteitem" id="idloteitem" value="<?php echo $IdItem?>">
<input type="hidden" class="form-control" name="idlote" id="idlote" value="<?php echo $IdLote?>">
<input type="hidden" class="form-control" name="idata" id="idata" value="<?php echo $IdAta?>">
<div class="row">
	<div class="col-xs-2">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Item</label>
		<input type="text" class="form-control" name="itemlote" id="itemlote" value="<?php echo $Item?>" maxlength="6" onkeypress='return SomenteNumero(event)' autofocus required>
	</div>
	<div class="col-xs-2">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Quantidade</label>
		<input type="text" class="form-control" name="itemloteqtd" id="itemloteqtd" value="<?php echo $QuantidadeItem?>" maxlength="6" onkeypress='return SomenteNumero(event)' required>
	</div>	
	<div class="col-xs-2">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;width:220px;">Unidade</label>
		<select class="form-control" name="itemloteunid" required>
			<option value=""></option>
			<?php if($UnidadeItem=="M3"){?>
				<option value="M3" selected>M³</option>
			<?php } if($UnidadeItem=="UND"){?>
				<option value="UND" selected>UND</option>
			<?php }else{?>
			    <option value="M3">M³</option>
			    <option value="UND">UND</option>
			<?php }?>
		</select>					
	</div>	
	<div class="col-xs-3">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Valor unitário</label>
		<input type="text" class="form-control" name="itemlotevalorunit" id="itemlotevalorunit" value="<?php echo $ValorUnitItem?>" style="width:160px;text-align:right;" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required>					
	</div>		
	<div class="col-xs-12">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Descrição</label>
		<input type="text" class="form-control" name="itemlotedesc" id="itemlotedesc" value="<?php echo $DescricaoItem?>" style="text-transform: uppercase;">					
	</div>
</div>
<hr>
<a href="<?php echo base_url()."catas/atalotedetail/".$IdAta.'/'.$IdLote?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">
	<button type="button" class="btn btn-danger btnpequenomin">Cancelar</button>
</a>	
<input class="btn btn-primary btnpequenomin" type="submit" value="Salvar">
<hr>
</form>

</div>	
</div>	
</div>
<br><br>
<?php $this->load->view('view_rodape');?>