<?php
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' =>  'calendar'); ?>

<link href="<?php echo base_url();?>assests/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
<link href="<?php echo base_url();?>assests/datatables/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> <!-- função habilita/desabilita campos -->

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
// print_r($contratodetail);
foreach ($contratodetail as $its):
  $IdContrato = $its->Id;
  $ContratoNr = $its->ContratoNr;
  $ContratoAno = $its->ContratoAno;
  $ContratoNumero = $its->ContratoNumero;
  $LicitacaoModalidadeId = $its->LicitacaoModalidadeId;
  $LicitacaoModalidade = $its->LicitacaoModalidade;
  $ProcessoNr = $its->ProcessoNr;
  $ProcessoNrSemMascara = $its->ProcessoNrSemMascara;
  $EmpresaNome = $its->EmpresaNome;
  $LicitacaoNumero = $its->LicitacaoNumero;
  $Diretoria = $its->Diretoria;
  $Objeto = $its->Objeto;
  $Valor = $its->Valor;
  $AditivosValor = $its->AditivosValor;
  $ValorComAditivos = $its->ValorComAditivos;
  $DataDeAssinatura = $its->DataDeAssinatura;
  $VigenciaInicio = $its->VigenciaInicio;
  $VigenciaPrazo = $its->VigenciaPrazo;
  $VigenciaFim = $its->VigenciaFim;
  $PrazoDeVigenciaAditado = $its->PrazoDeVigenciaAditado;
  $PrazoDeVigenciaAtivo = $its->PrazoDeVigenciaAtivo;
  $ExecucaoInicio = $its->ExecucaoInicio;
  $ExecucaoPrazo = $its->ExecucaoPrazo;
  $ExecucaoFim = $its->ExecucaoFim;
  $ExecucaoAditado = $its->ExecucaoAditado;
  $Situacao = $its->Situacao;
  $Executor = $its->Executor;
  $Observacoes = $its->Observacoes;
  $Ativo = $its->Ativo;
  $Sei = $its->Sei;
  $LicitacaoProcesso = $its->LicitacaoProcesso;
  $NaturezaDeDespesa = $its->NaturezaDeDespesa; if($NaturezaDeDespesa==""){$NaturezaDeDespesa=NULL;}
  $FonteDeRecursos = $its->FonteDeRecursos; if($FonteDeRecursos==""){$FonteDeRecursos=NULL;}
  $SIGGO = $its->SIGGO; if($SIGGO==""){$SIGGO=NULL;}
  $Programa = $its->Programa; if($Programa==""){$Programa=NULL;}
  $ContaBancariaBanco = $its->ContaBancariaBanco; if($ContaBancariaBanco==""){$ContaBancariaBanco=NULL;}
  $ContaBancaria = $its->ContaBancaria; if($ContaBancaria==""){$ContaBancaria=NULL;}
  $Convenio = $its->Convenio; if($Convenio==""){$Convenio=NULL;}
  $OrdemDeServico = $its->OrdemDeServico; if($OrdemDeServico==""){$OrdemDeServico=NULL;}
  $OrdemDeServicoData = $its->OrdemDeServicoData; if($OrdemDeServicoData==""){$OrdemDeServicoData='';}else{$OrdemDeServicoData = date('Y-m-d',strtotime($OrdemDeServicoData));}
endforeach;

foreach($lancamentodetail as $lanc):
   $LancamentoId = $lanc->LancamentoId;
   $ContratoId = $lanc->ContratoId;
   $ContratoNr = $lanc->ContratoNr;
   $ProcessoNr = $lanc->ProcessoNr;
   $Valor = $lanc->Valor;
   $ValorAditivos = $lanc->ValorAditivos;
   $ValorTotal = $lanc->ValorTotal;
   $EmpresaNome = $lanc->EmpresaNome;
   $EmpresaCNPJ = $lanc->EmpresaCNPJ;
   $LicitacaoModalidadeId = $lanc->LicitacaoModalidadeId;
   $LicitacaoNumero = $lanc->LicitacaoNumero;
   $LicitacaoProcesso = $lanc->LicitacaoProcesso;
   $ContratoObjeto = $lanc->ContratoObjeto;
   $VigenciaInicio = $lanc->VigenciaInicio;
   $VigenciaTipo = $lanc->VigenciaTipo;
   $VigenciaPrazo = $lanc->VigenciaPrazo;
   $VigenciaFim = $lanc->VigenciaFim;
   $VigenciaAditado = $lanc->VigenciaAditado;
   $ExecucaoInicio = $lanc->ExecucaoInicio;
   $ExecucaoTipo = $lanc->ExecucaoTipo;
   $ExecucaoPrazo = $lanc->ExecucaoPrazo;
   $ExecucaoFim = $lanc->ExecucaoFim;
   $ExecucaoAditado = $lanc->ExecucaoAditado;
   $ExecucaoFimOld = $lanc->ExecucaoFimOld;
   $ContratoAssinaturaData = $lanc->ContratoAssinaturaData;
   $Diretoria = $lanc->Diretoria;
   $SituacaoDoContratoId = $lanc->SituacaoDoContratoId;
   $ContratoExecutor = $lanc->ContratoExecutor;
   $ContratoObservacoes = $lanc->ContratoObservacoes;
   $ContratoAtivo = $lanc->ContratoAtivo;
   $ContratoSEI = $lanc->ContratoSEI;
   $NaturezaDeDespesa = $lanc->NaturezaDeDespesa;
   $FonteDeRecursos = $lanc->FonteDeRecursos;
   $SIGGO = $lanc->SIGGO;
   $Programa = $lanc->Programa;
   $ContaBancariaBanco = $lanc->ContaBancariaBanco;
   $ContaBancaria = $lanc->ContaBancaria;
   $Convenio = $lanc->Convenio;
   $OrdemDeServico = $lanc->OrdemDeServico;
   $OrdemDeServicoData = $lanc->OrdemDeServicoData;
   $MedicaoId = $lanc->MedicaoId;
   $MedicaoNumero = $lanc->MedicaoNumero;
   $MedicaoProcessoPagamento = $lanc->MedicaoProcessoPagamento;
   $MedicaoDataLiquidacao = $lanc->MedicaoDataLiquidacao;
   $NEId = $lanc->NEId;
   $NENumero = $lanc->NENumero;
   $NEEmissaoData = $lanc->NEEmissaoData;
   $NEValor = $lanc->NEValor;
   $NEValorAnulado = $lanc->NEValorAnulado;
   $FaturaNumero = $lanc->FaturaNumero;
   $FaturaValor = $lanc->FaturaValor;
   $FaturaAtestoData = $lanc->FaturaAtestoData;
   $FaturaGlosa = $lanc->FaturaGlosa;
   $FaturaRetencoes = $lanc->FaturaRetencoes;
   $OBNumero = $lanc->OBNumero;
   $OBEmissaoData = $lanc->OBEmissaoData;
   $OBValor = $lanc->OBValor;
   $FaturaId = $lanc->FaturaId;
   $OBId = $lanc->OBId;
endforeach;

$Diretorias = array(
    array(
        'Sigla' => 'DA',
        'Descricao' => 'DIRETORIA ADMINISTRATIVA'
    ),
    array(
        'Sigla' => 'DE',
        'Descricao' => 'DIRETORIA DE EDIFICA&Ccedil;&Otilde;ES'
    ),
    array(
        'Sigla' => 'DOE',
        'Descricao' => 'DIRETORIA DE OBRAS ESPECIAIS'
    ),
    array(
        'Sigla' => 'DU',
        'Descricao' => 'DIRETORIA DE URBANIZA&Ccedil;&Atilde;O'
    )
); ?>

<br>
<div class="container" style="width:993px;">
<div class="tab-content" style="margin-left:-30px;">
<div class="panel panel-info" style="margin-left:15px; margin-top:10px; width:962px;">
   <div class="panel-heading">
      <p class="panel-title">Contrato n&deg; <b><?php echo $ContratoNr?></b></p>
   </div>
   <div class="panel-body">
        <table class="table table-borderless" style="border:none; border-bootom:none;">
          <tbody>
            <tr>
              <td style="border: 1px solid #fff; width:10%;">Empresa:</td>
              <td style="border: 1px solid #fff;">
                <input type="text" id="processonr" name="processonr" value="<?php echo $EmpresaNome?>" style="width:840px;" disabled>
              </td>
            </tr>
            <tr>
              <td style="border: 1px solid #fff; width:10%;">Objeto:</td>
              <td style="border: 1px solid #fff;">
                <textarea id="form7" class="md-textarea form-control" rows="3" style="width:840px;" disabled><?php echo $Objeto?></textarea>
              </td>
            </tr>
            <tr>
              <td style="border: 1px solid #fff; width:10%;">Executor:</td>
              <td style="border: 1px solid #fff;">
                <input type="text" id="processonr" name="processonr" value="<?php echo $Executor?>" style="width:840px;" disabled>
              </td>
            </tr>
          </tbody>
        </table>
   </div>
</div>

<div style="width:990px;"><!-- INICIO abaLanc de Lancamentos -->
  <form role="form" method="post" action="<?php echo base_url();?>cretencoes/savelancamentos" name="formlancamentos">
    <div class="panel panel-info" style="margin-left:15px; margin-top:10px; width:962px;">
       <div class="panel-heading">
          <p class="panel-title text-left">Alterar Lan&ccedil;amento</b></p>
       </div>
       <div class="panel-body">
         <input type="hidden" class="form-control" name="contratoid" id="contratoid" value="<?php echo $ContratoId?>">
         <input type="hidden" class="form-control" name="lancamentoid" id="lancamentoid" value="<?php echo $LancamentoId?>">
         <div class="col-md-2">
           <label class="control-label" style="margin-bottom:-2px;">Medi&ccedil;&atilde;o</label>
           <select class="form-control" name="medicaoid" id="medicaoid" required autofocus>
             <option value=""></option>
             <?php foreach ($medicoes as $med):
               if($MedicaoId==$med->Id){?>
                 <option value="<?php echo $med->Id?>" selected><?php echo $med->Numero?></option>
             <?php }else{?>
                <option value="<?php echo $med->Id?>"><?php echo $med->Numero?></option>
             <?php } endforeach;?>
             <!-- <option value="<?php echo base_url();?>ccontrato/detailcontrato/".$IdContrato."#aba02">NOVO</option> -->
           </select>
         </div>
         <div class="col-md-2">
           <label class="control-label" style="margin-bottom:-2px;">Notas empenho</label>
           <select class="form-control" name="notaempid" required autofocus>
             <option value=""></option>
             <?php foreach ($notasemp as $ne):
               if($ne->Id==$NEId){?>
                 <option value="<?php echo $ne->Id?>" selected><?php echo $ne->Numero?></option>
             <?php }else{?>
                <option value="<?php echo $ne->Id?>"><?php echo $ne->Numero?></option>
             <?php } endforeach;?>
           </select>
         </div>
         <div class="col-md-3">
           <label class="control-label" style="margin-bottom:-2px;">Faturas</label>
           <select class="form-control" name="faturaid" required autofocus>
             <option value=""></option>
             <?php foreach ($faturas as $fat):
               if($fat->Id==$FaturaId){?>
                 <option value="<?php echo $fat->Id?>" selected><?php echo $fat->Numero?></option>
             <?php }else{?>
                <option value="<?php echo $fat->Id?>"><?php echo $fat->Numero?></option>
             <?php } endforeach;?>
           </select>
         </div>
         <div class="col-md-3">
           <label class="control-label" style="margin-bottom:-2px;">Ordem banc&aacute;ria</label>
           <select class="form-control" name="ordembancid" required autofocus>
             <option value=""></option>
             <?php foreach ($ordensbanc as $ob):
               if($ob->Id==$OBId){?>
                 <option value="<?php echo $ob->Id?>" selected><?php echo $ob->Numero?></option>
             <?php }else{?>
                <option value="<?php echo $ob->Id?>"><?php echo $ob->Numero?></option>
             <?php } endforeach;?>
           </select>
         </div>
         <div class="col-md-2">
           <button type="submit" class="btn btn-outline-info" style="margin-top:10px;">+</button>
         </div>
       </div>
    </div>
    <div class="rows">
      <button type="submit" class="btn btn-success btnpequenomin" style="margin-left:15px;">Salvar</button>
    	<a href="<?php echo base_url()."ccontrato/detailcontrato/".$ContratoId."#abaLanc"?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">
        <button type="button" class="btn btn-danger btnpequenomin">Cancelar</button>
      </a>
      <hr style="margin-left:13px;width:967px;">
    </div>
  </form>
</div><!-- FIM abaLanc de Lancamentos -->
</div>
</div>
<script src="<?php echo base_url();?>assests/jquery/jquery-3.1.0.min.js"></script>
<script src="<?php echo base_url();?>assests/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assests/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assests/datatables/js/dataTables.bootstrap.js"></script>
<script>
    var tab_on = location.hash; // valor da hash do url (ex: #listaReservas)
    $('#myTab a[data-target="' +tab_on+ '"]').tab('show');
    $('#myTab a').on('click', function() {
        var this_target = $(this).data('target');
        var window_href = window.location.href.split('#')[0];
        history.pushState('', '', window_href+this_target); // mudar o url dinamicamente
    });
</script>
<?php //$this->load->view('view_rodape');?>
