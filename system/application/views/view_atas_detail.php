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
    var confirma = confirm("Aten\u00e7\u00e3o!\n\nA exclus\u00e3o deste lote resultar\u00e1 na exclus\u00e3o de todos os \u00edtens a ele vinculados!\n\nDeseja realmente excluir este registro?")
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
//print_r($atadetail);
foreach ($atadetail as $ats):
    $IdAta = $ats->Id;
    $AtaNr = $ats->AtaNr;
    $AtaAno = $ats->AtaAno;
    $AtaNumero = $ats->AtaNumero;
    $Valor = $ats->Valor;if($Valor != ""){$Valor = number_format($Valor, 2, ',', '.');}else{$Valor="0,00";}
    $LicitacaoModalidadeId = $ats->LicitacaoModalidadeId;
    $LicitacaoModalidade = utf8_encode($ats->LicitacaoModalidade);
    $ProcessoNr = $ats->ProcessoNr;
    $ProcessoNrSemMascara = $ats->ProcessoNrSemMascara;
    $EmpresaNome = utf8_encode($ats->EmpresaNome);
    $LicitacaoNumero = $ats->LicitacaoNumero;

    $PrazoDeVigenciaInicio = $ats->PrazoDeVigenciaInicio;
        if($PrazoDeVigenciaInicio==""){$PrazoDeVigenciaInicio='';}else{$PrazoDeVigenciaInicio = date('d/m/Y',strtotime($PrazoDeVigenciaInicio));}
    $PrazoDeVigenciaTipo = $ats->PrazoDeVigenciaTipo;
    $PrazoDeVigencia = $ats->PrazoDeVigencia;
    $AtaAssinaturaData = $ats->AssinaturaData;
        if($AtaAssinaturaData==""){$AtaAssinaturaData='';}else{$AtaAssinaturaData = date('d/m/Y',strtotime($AtaAssinaturaData));}
    $PrazoDeVigenciaFim = $ats->PrazoDeVigenciaFim;
        if($PrazoDeVigenciaFim==""){$PrazoDeVigenciaFim='';}else{$PrazoDeVigenciaFim = date('d/m/Y',strtotime($PrazoDeVigenciaFim));}

    $Diretoria = $ats->Diretoria;
    $Objeto = utf8_encode($ats->Objeto);
    $Executor = $ats->Executor;
    $Observacoes = utf8_encode($ats->Observacoes); if($Observacoes=='NULL'){$Observacoes="";}
    $Sei = $ats->Sei;
    if($Sei != ""){ //00112-00005028/2018-31
        $parte1 = substr($Sei, 0, 5);
        $parte2 = substr($Sei, 5, 8);
        $parte3 = substr($Sei, 13, 4);
        $parte4 = substr($Sei, 17, 2);
        $Sei = $parte1.'-'.$parte2.'/'.$parte3.'-'.$parte4;
    }else{$Sei = '';}
    $QtdLotes = $ats->QtdLotes;
endforeach;?>

<br>
<div class="container" style="width:993px;">
<ul class="nav nav-tabs" id="myTab" style="margin-left:-16px;">
	<li class="active"><a data-target="#01ata" data-toggle="tab">ATA</a></li>
    <li><a data-target="#02lotes" data-toggle="tab">LOTES</a></li>
</ul>

<div class="tab-content" style="margin-left:-30px;">
<div id="01ata" class="tab-pane active" style="width:990px;"><!-- INICIO ABA 01 -->
<div class="row">
<input type="hidden" class="form-control" name="ataid" id="ataid" value="<?php echo $IdAta?>">
<div class="row">
	<div class="col-xs-3">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>N&uacute;mero da ATA</strong></p>
		<input type="text" class="form-control" name="atanr" id="atanr" value="<?php echo $AtaNr?>" style="text-transform:uppercase;" disabled/>
	</div>
	<div class="col-xs-3">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Processo administrativo</strong></p>
		<input type="text" class="form-control" name="pradm" id="pradm" value="<?php echo $ProcessoNr?>" maxlength="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)' disabled/>
	</div>
	<div class="col-xs-3">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Processo SEI</strong></p>
		<input type="text" class="form-control" name="prsei" id="prsei" value="<?php echo $Sei?>" maxlength="22" size="23" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)' disabled/>
	</div>
	<div class="col-xs-3">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>N&uacute;mero da licitacao</strong></p>
		<input type="text" class="form-control" name="licitanr" id="licitanr" value="<?php echo $LicitacaoNumero?>" style="text-transform:uppercase;" disabled/>
	</div>

	<div class="col-xs-3">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Data assinatura</strong></p>
		<input type="text" class="form-control" name="atadatassinatura" id="atadatassinatura" value="<?php echo $AtaAssinaturaData?>" required disabled>
	</div>
	<div class="col-xs-3">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Data vig&ecirc;ncia in&iacute;cio</strong></p>
		<input type="text" class="form-control" name="atadatavigencia" id="atadatavigencia" value="<?php echo $PrazoDeVigenciaInicio?>" required disabled>
	</div>
	<div class="col-xs-2">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Prazo vig&ecirc;ncia</strong></p>
		<input type="text" class="form-control" name="ataprazovigencia" id="ataprazovigencia" value="<?php echo $PrazoDeVigencia?>" style="text-transform:uppercase;" autofocus required disabled/>
	</div>
	<div class="col-xs-1">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Tipo</strong></p>
		<input type="text" class="form-control" name="atatipoprazo" id="atatipoprazo" value="<?php echo $PrazoDeVigenciaTipo?>" style="width:75px;" required disabled>
	</div>
	<div class="col-xs-3">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Data vig&ecirc;ncia fim</strong></p>
		<input type="text" class="form-control" name="atadatavigencia" id="atadatavigencia" value="<?php echo $PrazoDeVigenciaFim?>" required disabled>
	</div>
	<div class="col-xs-8">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Modalidade</strong></p>
		<input type="text" class="form-control" name="licmodalidadeid" id="licmodalidadeid" value="<?php echo $LicitacaoModalidade?>" style="text-transform:uppercase;" disabled/>
	</div>
	<div class="col-xs-2">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Valor</strong></p>
		<input type="text" class="form-control" name="atanr" id="atanr" value="<?php echo $Valor?>" style="text-transform:uppercase;text-align:right;" disabled/>
	</div>
	<div class="col-xs-2">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Diretoria</strong></p>
		<input type="text" class="form-control" name="licitanr" id="licitanr" value="<?php echo $Diretoria?>" style="text-transform:uppercase;" disabled/>
	</div>
	<div class="col-xs-12">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Nome empresa</strong></p>
		<input type="text" class="form-control" name="nomempresa" id="nomempresa" value="<?php echo $EmpresaNome?>" style="text-transform:uppercase;" disabled/>
	</div>
	<div class="col-xs-12">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Objeto</strong></p>
		<textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" style="text-transform:uppercase;" disabled><?php echo $Objeto?></textarea>
	</div>
	<div class="col-xs-12">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Observa&ccedil;&otilde;es</strong></p>
		<textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" style="text-transform:uppercase;" disabled><?php echo $Observacoes?></textarea>
	</div>
</div>
</div>

<div class="text-left" style="margin-left:16px;"><hr>
<a href="<?php echo base_url()."catas/atabuscaresult/"?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">
	<button type="button" class="btn btn-primary btnpequenomin">Voltar</button>
</a>
<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel3']==1)){ // 3 CONTRATOS E ATAS - ADMINISTRADOR?>
<a href="<?php echo base_url()."catas/ataedit/".$IdAta?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">
	<button type="button" class="btn btn-primary btnpequenomin">Alterar</button>
</a>
<?php if($QtdLotes==0){ ?>
<button type="button" class="btn btn-danger btnpequenomin" onclick='return excluiata(<?php echo $IdAta?>);'>Excluir</button>
<?php } }?>
</div>
</div><!-- FIM ABA 01 -->

<div id="02lotes" class="tab-pane" style="width:995px;"><!-- INICIO ABA 02 -->
<div class="row"><br>
	<div class="well well-sm" style="width:965px;margin-left:13px;">
		<font size="4">Detalhamento da ATA <?php echo $AtaNr?></font>
	</div>
</div>
<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel3']==1)){ // 3 CONTRATOS E ATAS - ADMINISTRADOR?>
<form method="post" action="<?php echo base_url();?>cataslote/atalotecreate" name="formatalote">
<input type="hidden" class="form-control" name="ataid" id="ataid" value="<?php echo $IdAta?>">
<div class="row">
	<div class="col-xs-2">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;width:220px;"><strong>Lote nº</strong></p>
		<select class="form-control" name="atalotenr" required>
			<?php for($i=1;$i<41;$i++){?>
				<option value="<?php echo $i?>"><?php echo $i?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-xs-10">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Descrição</strong></p>
		<input type="text" class="form-control" name="atalotedesc" id="atalotedesc" value="" style="text-transform: uppercase;">
	</div>
	<div class="col-xs-7" style="margin-left:-5px;">
    <p class="text-justify" style="margin-top:8px;margin-bottom:-2px;margin-left:5px;"><strong>Empresa</strong></p>
      <input type="hidden" name="empresaid" value="" size="16" id="empresaid"/>
      <div class="btn-group" role="group" aria-label="...">
        <input type="text" class="form-control" name="empresa" id="empresa" value="" style="text-transform:uppercase; width:500px;" disabled/>
      </div>
      <div class="btn-group" role="group" aria-label="...">
        <a onclick="javascript:window.open('<?php echo base_url()?>buscaempresa', 'popup_id', 'scrollbars,resizable,width=750,height=550');" style="cursor:pointer; cursor:hand; margin-top:-15px;"><img src="<?php echo base_url()?>img/famfamfam/icons/application_form_magnify.png" border="0" title="Procurar empresa"></a>&nbsp;
        <a onclick="document.getElementById('empresa').value='';document.getElementById('empresaid').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url()?>img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo empresa"></a>
      </div>
    </div>
	<div class="col-xs-5">
		<p class="text-justify" style="margin-top:8px;margin-bottom:-2px;"><strong>Representante</strong></p>
    <input type="text" class="form-control" name="ataloterepresentante" id="ataloterepresentante" value="" style="text-transform: uppercase;">
	</div>
</div>
<div class="text-left" style="margin-left:16px;width:965px;"><hr>
<input class="btn btn-primary btnpequenomin" type="submit" value="Adicionar">
<hr>
</div>
</form>
<?php }
$nivel = $this->session->userdata('usuarionivel');
if(!empty($atalotes)&&(sizeof($atalotes)>0)){?>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr style="background-color:#D3D3D3">
					<th style="width:80px;">Lote N&deg;</th>
					<th style="width:100px;text-align:center;">Valor</th>
					<th style="width:250px;text-align:left;">Descrição</th>
					<th style="width:250px;text-align:left;">Empresa</th>
					<th style="width:250px;text-align:left;">Representante</th>
					<th style="width:10px;text-align:center;">Alterar</th>
					<th style="width:10px;text-align:center;">Apagar</th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($atalotes as $lts):
    			$IdLote = $lts->Id;
    			$IdAta = $lts->AtaId;
    			$LoteNumero = $lts->LoteNumero;
    			$Descricao = utf8_encode($lts->Descricao); if($Descricao=='NULL'){$Descricao="";}
    			$Empresa = utf8_encode($lts->Empresa);
    			$Representante = utf8_encode($lts->Representante); if($Representante=='NULL'){$Representante='';}
    			$Valor = $lts->Valor; if($Valor != ""){$Valor = number_format($Valor, 2, ',', '.');}else{$Valor="0,00";}
    			$QtdItens = $lts->QtdItens; //Nao é mais utilizado, pois o lote deleta em cascata.?>
				<tr>
					<td style="width:80px;">
    					<a href="<?php echo base_url();?>catas/atalotedetail/<?php echo $IdAta;?>/<?php echo $IdLote;?>" title="Detalhar registro" style="color:blue;">
    						<?php echo $LoteNumero?>
    					</a>
					</td>
					<td style="width:100px;text-align:right;"><?php echo $Valor?></td>
					<td style="width:250px;text-align:left;text-transform:uppercase;"><?php echo strtoupper($Descricao)?></td>
					<td style="width:250px;text-align:left;"><?php echo $Empresa?></td>
					<td style="width:250px;text-align:left;"><?php echo $Representante?></td>
					<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel3']==1)){ // 3 CONTRATOS E ATAS - ADMINISTRADOR?>
						<td style="width:10px;text-align:center;">
							<a href="<?php echo base_url()."cataslote/atalotedit/".$IdAta.'/'.$IdLote;?>" style="text-decoration:none;">
								<img src="<?php echo base_url();?>img/icons/pencil.png" alt="alterar" />
							</a>
						</td>
						<td style="width:10px;text-align:center;">
						<a href="#"	onclick='return excluilote(<?php echo $IdAta?>,<?php echo $IdLote?>);' title="Deletar este registro.">
							<img src="<?php echo base_url();?>img/icons/delete.png" alt="apagar" />
						</a>
					<?php }else{
						echo '<td style="width:10px;text-align:center;">-</td>';
						echo '<td style="width:10px;text-align:center;">-</td>';
					}?>
          			</td>
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
  <br>Nenhum lote registro para a ATA n&deg; <?php echo $AtaNr?>.
</div>
<?php }?>
</div><!-- FIM ABA 02 -->
</div>
</div>

<script>
    var tab_on = location.hash; // aqui onde vamos agarrar o valor da hash do url (ex: #listaReservas)
    $('#myTab a[data-target="' +tab_on+ '"]').tab('show');
    $('#myTab a').on('click', function() {
        var this_target = $(this).data('target');
        var window_href = window.location.href.split('#')[0];
        history.pushState('', '', window_href+this_target); // mudar o url dinamicamente
    });
</script>

<?php //$this->load->view('view_rodape');?>
