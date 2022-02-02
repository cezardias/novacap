<?php
$this->load->view('view_cabecalho');
$attributes = array('name' =>  'calendar');?>

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

function excluemedicao(IdMedic,ContratoId){
  var confirma = confirm("Deseja realmente excluir este registro?")
  if (confirma){
    window.location = "<?php echo base_url();?>cmedicao/delete/"+IdMedic+"/"+ContratoId; //registrar pagamento
  } else {
    return false;
  }
}

function excluefat(IdFat,ContratoId){
  var confirma = confirm("Deseja realmente excluir este registro?")
  if (confirma){
    window.location = "<?php echo base_url();?>cfatura/delete/"+IdFat+"/"+ContratoId; //registrar pagamento
  } else {
    return false;
  }
}

function excluene(IdNotaEmp,ContratoId){
  var confirma = confirm("Deseja realmente excluir este registro?")
  if (confirma){
    window.location = "<?php echo base_url();?>cnotaempenho/delete/"+IdNotaEmp+"/"+ContratoId; //registrar pagamento
  } else {
    return false;
  }
}

function exclueob(IdOrdemB,ContratoId){
  var confirma = confirm("Deseja realmente excluir este registro?")
  if (confirma){
    window.location = "<?php echo base_url();?>cordembancaria/delete/"+IdOrdemB+"/"+ContratoId; //registrar pagamento
  } else {
    return false;
  }
}

function excluilancamento(ContratoId,LancamentoId){
  var confirma = confirm("Deseja realmente excluir este registro?")
  if (confirma){
    window.location = "<?php echo base_url();?>clancamentos/delete/"+ContratoId+"/"+LancamentoId; //registrar pagamento
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
//print_r($contratodetail);
foreach ($contratodetail as $its):
  $IdContrato = $its->Id;
  $ContratoNr = $its->ContratoNr;
  $ContratoAno = $its->ContratoAno;
  $ContratoNumero = $its->ContratoNumero;
  $LicitacaoModalidadeId = $its->LicitacaoModalidadeId;
  $LicitacaoModalidade = utf8_encode($its->LicitacaoModalidade);
  $ProcessoNr = $its->ProcessoNr;
  $ProcessoNrSemMascara = $its->ProcessoNrSemMascara;
  $EmpresaNome = utf8_encode($its->EmpresaNome);
  $EmpresaCnpj = $its->EmpresaCnpj;
  $LicitacaoNumero = $its->LicitacaoNumero;
  $Diretoria = $its->Diretoria;
  $Objeto = utf8_encode($its->Objeto);
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
  $Situacao = utf8_encode($its->Situacao);
  $Executor = utf8_encode($its->Executor);
  $Observacoes = utf8_encode($its->Observacoes);
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

$Diretorias = array(
    array(
        'Sigla' => 'DA',
        'Descricao' => 'DIRETORIA ADMINISTRATIVA'
    ),
    array(
        'Sigla' => 'DE',
        'Descricao' => 'DIRETORIA DE EDIFICAÇÕES'
    ),
    array(
        'Sigla' => 'DOE',
        'Descricao' => 'DIRETORIA DE OBRAS ESPECIAIS'
    ),
    array(
        'Sigla' => 'DU',
        'Descricao' => 'DIRETORIA DE URBANIZAÇÃO'
    )
); ?>
<br>
<div class="container" style="width:993px;">
  <ul class="nav nav-tabs" id="myTab" style="margin-left:-16px;">
  	<li class="active"><a data-target="#aba01" data-toggle="tab">Contrato</a></li>
    <li><a data-target="#abaLanc" data-toggle="tab">Lançamentos</a></li>
    <li><a data-target="#aba04" data-toggle="tab">Notas de Empenho</a></li>
    <li><a data-target="#aba02" data-toggle="tab">Medições</a></li>
    <li><a data-target="#aba03" data-toggle="tab">Faturas</a></li>
    <li><a data-target="#aba05" data-toggle="tab">Ordens Bancárias</a></li>
  </ul>

  <div id="modal-dialog" class="modal"><!-- INICIO POPUP CONFORMA EXCLUSÃO -->
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <a href="#" data-dismiss="modal" aria-hidden="true" class="close"><span class="glyphicon glyphicon-remove"></span></a>
            <a style="font-size:25px;">Exclus&atilde;o de registro</a>
        </div>
        <div class="modal-body">
            <p>Deseja realmente apagar o registro?</p>
        </div>
        <div class="modal-footer">
          <a href="#" id="btnYes" class="btn confirm">Sim</a>
          <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Cancelar</a>
        </div>
      </div>
    </div>
  </div><!-- FIM POPUP CONFORMA EXCLUSÃO -->

  <div class="tab-content" style="margin-left:-30px;">
    <div class="panel panel-info" style="margin-left:15px; margin-top:10px; width:962px;">
      <div class="panel-heading">
          <p class="panel-title">Contrato n&deg; <b><?php echo $ContratoNr?></b></p>
      </div>
      <div class="panel-body">
        <table class="table table-borderless" style="border:none; border-bootom:none; width:100%;">
          <tbody>
            <tr style="width:100%;">
              <td style="border: 1px solid #fff; width:10%;">Empresa:</td>
              <td style="border: 1px solid #fff; width:65%;">
                <input type="text" id="processonr" name="processonr" value="<?php echo $EmpresaNome?>" style="width:550px;" disabled>
              </td>
              <td style="border: 1px solid #fff; width:5%;">CNPJ:</td>
              <td style="border: 1px solid #fff; width:20%;">
                <input type="text" id="processonr" name="processonr" value="<?php echo $EmpresaCnpj?>" style="width:170px;" disabled>
              </td>
            </tr>
            <tr>
              <td style="border: 1px solid #fff; width:10%;">Objeto:</td>
              <td style="border: 1px solid #fff;" colspan="3">
                <textarea id="form7" class="md-textarea form-control" rows="5" style="width:840px;text-align:justify;" disabled><?php echo $Objeto?></textarea>
              </td>
            </tr>
            <tr>
              <td style="border: 1px solid #fff; width:10%;">Executor:</td>
              <td style="border: 1px solid #fff;" colspan="3">
                <input type="text" id="processonr" name="processonr" value="<?php echo $Executor?>" style="width:840px;" disabled>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div id="aba01" class="tab-pane active" style="width:990px;margin-left:-15px;"><!-- INICIO aba01 -->
      <div class="row"><!-- INICIO linha01 aba01 -->
        <div class="col-sm-4"><!-- INICIO coluna01 esquerda aba01 -->
          <div class="news">
            <div class="panel panel-info" style="margin-left:15px; margin-top:10px; width:310px;">
              <div class="panel-heading">
                  <p class="panel-title text-left">Dados gerais</b></p>
              </div>
              <div class="panel-body text-left">
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <td style="width:40%; border: 1px solid #fff;">Processo:</td>
                      <td style="border: 1px solid #fff;">
                        <input type="text" id="processonr" name="processonr" value="<?php echo $ProcessoNr?>" style="width:140px;" disabled>
                      </td>
                    </tr>
                    <tr>
                      <td style="width:40%; border: 1px solid #fff;">SEI:</td>
                      <td style="border: 1px solid #fff;">
                        <input type="text" id="prsei" name="prsei" value="<?php echo $Sei?>" style="width:140px;" disabled>
                      </td>
                    </tr>
                    <tr>
                      <td style="width:40%; border: 1px solid #fff;">Data assinatura:</td>
                      <td style="border: 1px solid #fff;">
                        <input type="text" id="datassinatura" name="datassinatura" value="<?php echo $DataDeAssinatura?>" style="width:140px;"'' disabled>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="news">
            <div class="panel panel-info" style="margin-left:15px; margin-top:10px; width:310px;">
              <div class="panel-heading">
                  <p class="panel-title text-left">Licitação</b></p>
              </div>
              <div class="panel-body text-left">
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <td style="width:40%; border: 1px solid #fff;">Número:</td>
                      <td style="border: 1px solid #fff;">
                        <input type="text" id="licitanumero" name="licitanumero" value="<?php echo $LicitacaoNumero?>" style="width:140px;" disabled>
                      </td>
                    </tr>
                    <tr>
                      <td style="width:40%; border: 1px solid #fff;">Modalidade:</td>
                      <td style="border: 1px solid #fff;">
                        <input type="text" id="licitamodalidade" name="licitamodalidade" value="<?php echo $LicitacaoModalidade?>" style="width:140px;" disabled>
                      </td>
                    </tr>
                    <tr>
                      <td style="width:40%; border: 1px solid #fff;">Processo:</td>
                      <td style="border: 1px solid #fff;">
                        <input type="text" id="licitamodalidade" name="licitamodalidade" value="<?php echo $ProcessoNr?>" style="width:140px;" disabled>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="news">
            <div class="panel panel-info" style="margin-left:15px; margin-top:10px; width:310px;">
              <div class="panel-heading">
                  <p class="panel-title text-left">Valores</b></p>
              </div>
              <div class="panel-body text-left">
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <td style="width:40%; border: 1px solid #fff;">Valor contrato:</td>
                      <td style="border: 1px solid #fff;">
                        <input type="text" id="valor" name="valor" value="<?php echo $Valor?>" style="width:140px;text-align:right;" disabled>
                      </td>
                    </tr>
                    <tr>
                      <td style="width:40%; border: 1px solid #fff;">Soma aditivos:</td>
                      <td style="border: 1px solid #fff;">
                        <input type="text" id="aditivosvalor" name="aditivosvalor" value="<?php echo $AditivosValor?>" style="width:140px;text-align:right;" disabled>
                      </td>
                    </tr>
                    <tr>
                      <td style="width:40%; border: 1px solid #fff;">Total:</td>
                      <td style="border: 1px solid #fff;">
                        <input type="text" id="valorcomaditivos" name="valorcomaditivos" value="<?php echo $ValorComAditivos?>" style="width:140px;text-align:right;" disabled>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div><!-- FINAL coluna01 esquerda aba01 -->

        <div class="col-sm-4"><!-- INICIO coluna02 central aba01 -->
          <div class="news">
            <div class="panel panel-info" style="margin-left:15px; margin-top:10px; width:310px;">
              <div class="panel-heading">
                  <p class="panel-title text-left">Vig&ecirc;ncia</b></p>
              </div>
              <div class="panel-body text-left">
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <td style="width:40%; border: 1px solid #fff;">In&iacute;cio:</td>
                      <td style="border: 1px solid #fff;">
                        <input type="text" id="vigenciainicio" name="vigenciainicio" value="<?php echo $VigenciaInicio?>" style="width:140px;" disabled>
                      </td>
                    </tr>
                    <tr>
                      <td style="width:40%; border: 1px solid #fff;">Prazo:</td>
                      <td style="border: 1px solid #fff;">
                        <input type="text" id="vigenciaprazo" name="vigenciaprazo" value="<?php echo $VigenciaPrazo?>" style="width:140px;" disabled>
                      </td>
                    </tr>
                    <tr>
                      <td style="width:40%; border: 1px solid #fff;">Fim:</td>
                      <td style="border: 1px solid #fff;">
                        <input type="text" id="vigenciafim" name="vigenciafim" value="<?php echo $VigenciaFim?>" style="width:140px;" disabled>
                      </td>
                    </tr>
                    <tr>
                      <td style="width:40%; border: 1px solid #fff;">Fim(com aditivos):</td>
                      <td style="border: 1px solid #fff;">
                        <input type="text" id="prazovigenciaaditado" name="prazovigenciaaditado" value="<?php echo $PrazoDeVigenciaAditado?>" style="width:140px;" disabled>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="news">
            <div class="panel panel-info" style="margin-left:15px; margin-top:10px; width:310px;">
              <div class="panel-heading">
                  <p class="panel-title text-left">Execu&ccedil;&atilde;o</b></p>
              </div>
              <div class="panel-body text-left">
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <td style="width:40%; border: 1px solid #fff;">In&iacute;cio:</td>
                      <td style="border: 1px solid #fff;">
                        <input type="text" id="execucaoinicio" name="execucaoinicio" value="<?php echo $ExecucaoInicio?>" style="width:140px;" disabled>
                      </td>
                    </tr>
                    <tr>
                      <td style="width:40%; border: 1px solid #fff;">Prazo:</td>
                      <td style="border: 1px solid #fff;">
                        <input type="text" id="execucaoprazo" name="execucaoprazo" value="<?php echo $ExecucaoPrazo?>" style="width:140px;" disabled>
                      </td>
                    </tr>
                    <tr>
                      <td style="width:40%; border: 1px solid #fff;">Fim:</td>
                      <td style="border: 1px solid #fff;">
                        <input type="text" id="execucaofim" name="execucaofim" value="<?php echo $ExecucaoFim?>" style="width:140px;" disabled>
                      </td>
                    </tr>
                    <tr>
                      <td style="width:40%; border: 1px solid #fff;">Fim(com aditivos):</td>
                      <td style="border: 1px solid #fff;">
                        <input type="text" id="execucaoaditado" name="execucaoaditado" value="<?php echo $ExecucaoAditado?>" style="width:140px;" disabled>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div><!-- FIM coluna02 central aba01 -->

      <div class="col-sm-4"><!-- INICIO coluna03 direita aba01 -->
        <!-- *********** INÍCIO HABILITA/DESABILITA ****************************************************** -->
        <script>
        $(document).ready(function() {
        $('#siggo').attr("disabled", true); // campo desabilitado
          $('#programa').attr("disabled", true); // campo desabilitado
          $('#fonterecursos').attr("disabled", true); // campo desabilitado
          $('#naturezadespesa').attr("disabled", true); // campo desabilitado
          $('#banco').attr("disabled", true); // campo desabilitado
          $('#contabancaria').attr("disabled", true); // campo desabilitado
          $('#numconvenio').attr("disabled", true); // campo desabilitado
          $('#ordemservico').attr("disabled", true); // campo desabilitado
          $('#ordemservicodata').attr("disabled", true); // campo desabilitado

          $('#btnsalva').hide(); //inicia botão desabilitado
          $('#btncancela').hide(); //inicia botão desabilitado

        $("#btnaltera").click(function (){ // habilitando o campo
            $('#siggo').attr("disabled", false);
            $('#programa').attr("disabled", false); // campo desabilitado
            $('#fonterecursos').attr("disabled", false); // campo desabilitado
            $('#naturezadespesa').attr("disabled", false); // campo desabilitado
            $('#banco').attr("disabled", false); // campo desabilitado
            $('#contabancaria').attr("disabled", false); // campo desabilitado
            $('#numconvenio').attr("disabled", false); // campo desabilitado
            $('#ordemservico').attr("disabled", false); // campo desabilitado
            $('#ordemservicodata').attr("disabled", false); // campo desabilitado

            $('#btnaltera').hide();
            $('#btnsalva').show();
            $('#btncancela').show();
            $('#siggo').focus();
          });

          $("#btnsalva").click(function (){ // não desative os campos ou apagará o conteúdo.
              $('#btnaltera').show();
              $('#btnsalva').hide();
              $('#btncancela').hide();
          });
          $("#btncancela").click(function (){ // habilitando o campo
              $('#btnaltera').show();
              $('#btnsalva').hide();
              $('#btncancela').hide();

              $('#siggo').attr("disabled", true); // campo desabilitado
              $('#programa').attr("disabled", true); // campo desabilitado
              $('#fonterecursos').attr("disabled", true); // campo desabilitado
              $('#naturezadespesa').attr("disabled", true); // campo desabilitado
              $('#banco').attr("disabled", true); // campo desabilitado
              $('#contabancaria').attr("disabled", true); // campo desabilitado
              $('#numconvenio').attr("disabled", true); // campo desabilitado
              $('#ordemservico').attr("disabled", true); // campo desabilitado
              $('#ordemservicodata').attr("disabled", true); // campo desabilitado
          });
        });
        </script>
        <!-- *********** FIM HABILITA/DESABILITA ****************************************************** -->
        <form role="form" method="post" action="<?php echo base_url();?>ccontrato/updatedadosfin" name="formdadosfin" >
            <div class="news">
                <div class="panel panel-info" style="margin-left:15px; margin-top:10px; width:305px;">                
                  <div class="panel-heading">
                      <p class="panel-title text-left">
                        Dados financeiros
                        <?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel5']==1)){ // 5 FINANCEIRO - ADMINISTRADOR, 6 FINANCEIRO - LEITURA?>
                          <button type="button" id="btnaltera" name="btnaltera" class="btn btn-primary"><span class="glyphicon">&#x270f;</span></span></button>
                          <button type="button" id="btncancela" name="btncancela" class="btn btn-danger"><span class="glyphicon">&#xe074;</span></span></button>
                          <button type="submit" id="btnsalva" name="btnsalva" class="btn btn-success"><span class="glyphicon glyphicon-floppy-saved"></span></button>
                        <?php } ?>
                      </p>
                  </div>                  
                  <div class="panel-body text-left">
                      <input type="hidden" id="contratoid" name="contratoid" value="<?php echo $IdContrato?>" style="width:140px;" required>
                      <table class="table table-borderless">
                          <tbody>
                            <tr>
                              <td style="width:60%; border: 1px solid #fff;">SIGGO:</td>
                              <td style="border: 1px solid #fff;">
                                <input type="text" id="siggo" name="siggo" value="<?php echo $SIGGO?>" style="width:140px;background-color:#E6E6FA;" required>
                              </td>
                            </tr>
                            <tr>
                              <td style="width:60%; border: 1px solid #fff;">Programa:</td>
                              <td style="border: 1px solid #fff;">
                                <input type="text" id="programa" name="programa" value="<?php echo $Programa?>" style="width:140px;background-color:#E6E6FA;" required>
                              </td>
                            </tr>
                            <tr>
                              <td style="width:60%; border: 1px solid #fff;">Fonte recursos:</td>
                              <td style="border: 1px solid #fff;">
                                <input type="text" id="fonterecursos" name="fonterecursos" value="<?php echo $FonteDeRecursos?>" style="width:140px;background-color:#E6E6FA;" required>
                              </td>
                            </tr>
                            <tr>
                              <td style="width:60%; border: 1px solid #fff;">Natureza despesa:</td>
                              <td style="border: 1px solid #fff;">
                                <input type="text" id="naturezadespesa" name="naturezadespesa" value="<?php echo $NaturezaDeDespesa?>" style="width:140px;background-color:#E6E6FA;" required>
                              </td>
                            </tr>
                            <tr>
                              <td style="width:60%; border: 1px solid #fff;">Banco:</td>
                              <td style="border: 1px solid #fff;">
                                <select name="banco" id="banco" style="width:140px;background-color:#E6E6FA;" required>
                                  <option value=""></option>
                                  <?php foreach ($bancos as $bcn):
                                    $IdBanco = $bcn->Id;
                                    $CodigoBanco = $bcn->Codigo;
                                    $DescricaoBanco = $bcn->Descricao;
                                    if($ContaBancariaBanco==$CodigoBanco){?>
                                      <option value="<?php echo $CodigoBanco?>" selected><?php echo $CodigoBanco.'-'.utf8_encode($DescricaoBanco)?></option>
                                  <?php }else{?>
                                      <option value="<?php echo $CodigoBanco?>"><?php echo $CodigoBanco.' - '.utf8_encode($DescricaoBanco)?></option>
                                  <?php } endforeach?>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td style="width:60%; border: 1px solid #fff;">Conta banc&aacute;ria:</td>
                              <td style="border: 1px solid #fff;">
                                <input type="text" id="contabancaria" name="contabancaria" value="<?php echo $ContaBancaria?>" style="width:140px;background-color:#E6E6FA;" required>
                              </td>
                            </tr>
                            <tr>
                              <td style="width:60%; border: 1px solid #fff;">Numero conv&ecirc;nio:</td>
                              <td style="border: 1px solid #fff;">
                                <input type="text" id="numconvenio" name="numconvenio" value="<?php echo $Convenio?>" style="width:140px;background-color:#E6E6FA;" required>
                              </td>
                            </tr>
                            <tr>
                              <td style="width:60%; border: 1px solid #fff;">Ordem servi&ccedil;o:</td>
                              <td style="border: 1px solid #fff;">
                                <input type="text" id="ordemservico" name="ordemservico" value="<?php echo $OrdemDeServico?>" style="width:140px;background-color:#E6E6FA;" required>
                              </td>
                            </tr>
                            <tr>
                              <td style="width:60%; border: 1px solid #fff;">Data emiss&atilde;o O.S:</td>
                              <td style="border: 1px solid #fff;">
                                <input type="date" id="ordemservicodata" name="ordemservicodata" value="<?php echo $OrdemDeServicoData?>" style="width:140px;background-color:#E6E6FA;" required>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                  </div>
                </div>
            </div>
          </form>
        </div><!-- FINAL coluna03 direita aba01 -->
      </div><!-- FIM linha1 aba01 -->
      <div class="text-left" style="margin-left:30px;">
        <hr>
        <a href="<?php echo base_url()."ccontrato/contratobuscaresult/";?>" style="text-decoration:none;">
          <button type="button" class="btn btn-primary btn-md btnpequenomin" onclick="location.href('<?php echo base_url()."ccontrato/contratobuscaresult/";?>')">Voltar</button>
        </a>
        <hr>
      </div>
    </div><!-- FIM aba01 -->

    <div id="abaLanc" class="tab-pane" style="width:990px;"><!-- INICIO abaLanc de Lancamentos -->
      <form role="form" method="post" action="<?php echo base_url();?>cretencoes/creactelancamentos" name="formlancamentos">
        <div class="panel panel-info" style="margin-left:15px; margin-top:10px; width:962px;">
          <div class="panel-heading">
              <p class="panel-title text-left">Lançamentos</b></p>
          </div>
          <div class="panel-body">
          <?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel5']==1)){ // 5 FINANCEIRO - ADMINISTRADOR, 6 FINANCEIRO - LEITURA?>
            <input type="hidden" class="form-control" name="contratoid" id="contratoid" value="<?php echo $IdContrato?>">
            <div class="col-md-2">
              <label class="control-label" style="margin-left:-73px;margin-bottom:-2px;">Medição</label>
              <select class="form-control" name="medicaoid" id="medicaoid" required autofocus>
                <option value=""></option>
                <?php foreach ($medicoes as $med):?>
                  <option value="<?php echo $med->Id?>"><?php echo $med->Numero?></option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="col-md-3">
              <label class="control-label" style="margin-left:-110px;margin-bottom:-2px;">Notas empenho</label>
              <select class="form-control" name="notaempid" required autofocus>
                <option value=""></option>
                <?php foreach ($notasemp as $ne):?>
                  <option value="<?php echo $ne->Id?>"><?php echo $ne->Numero?></option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="col-md-2">
              <label class="control-label" style="margin-left:-80px;margin-bottom:-2px;">Faturas</label>
              <select class="form-control" name="faturaid" required autofocus>
                <option value=""></option>
                <?php foreach ($faturas as $fat):?>
                  <option value="<?php echo $fat->Id?>"><?php echo $fat->Numero?></option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="col-md-3">
              <label class="control-label" style="margin-left:-113px;margin-bottom:-2px;">Ordem bancária</label>
              <select class="form-control" name="ordembancid" required autofocus>
                <option value=""></option>
                <?php foreach ($ordensbanc as $ob):?>
                  <option value="<?php echo $ob->Id?>"><?php echo $ob->Numero?></option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-success" style="margin-top:10px;">+</button>
            </div>
          <?php } ?>
          </div>
          <?php if(!empty($lancamentos)&&(sizeof($lancamentos)>0)){?>
            <br><br><hr>
            <table id="table_lancamentos" class="table table-striped table-bordered" cellspacing="0"  style="width:900px;">
              <thead class="thead-inverse">
                <tr>
                  <th class="middle" style="width:10%;">N&deg; da<br>Medi&ccedil;&atilde;o</th>
                  <th class="middle" style="width:10%;">N&deg; da<br>NE</th>
                  <th class="middle" style="width:15%;">Valor da<br>NE</th>
                  <th class="middle" style="width:10%;">N&deg; da<br>Fatura</th>
                  <th class="middle" style="width:15%;">Valor da<br>Fatura</th>
                  <th class="middle" style="width:15%;">N&deg; da<br>O.B.</th>
                  <th class="middle" style="width:15%;">Valor da<br>O.B.</th>
                  <th class="middle" style="width:5%;">Editar</th>
                  <th class="middle" style="width:5%;">Excluir</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($lancamentos as $lanc):
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
                $OBValor = $lanc->OBValor;?>
                <tr>
                  <td class="middle"><?php echo $MedicaoNumero?></td>
                  <td class="middle"><?php echo $NENumero?></td>
                  <td class="text-right"><?php echo $NEValor?></td>
                  <td class="middle"><?php echo $FaturaNumero?></td>
                  <td class="text-right"><?php echo $FaturaValor?></td>
                  <td class="middle"><?php echo $OBNumero?></td>
                  <td class="text-right"><?php echo $OBValor?></td>
                  <?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel5']==1)){ // 5 FINANCEIRO - ADMINISTRADOR, 6 FINANCEIRO - LEITURA?>
                  <td class="middle">
                    <a href="<?php echo base_url()?>ccontrato/editlancamento/<?php echo $ContratoId?>/<?php echo $LancamentoId?>">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                  </td>
                  <td class="middle">
                    <a href="#" onclick='return excluilancamento(<?php echo $ContratoId?>,<?php echo $LancamentoId?>);' title="Deletar registro.">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </td>
                  <?php }else{ ?>
                    <td class="middle">-</td>
                    <td class="middle">-</td>
                  <?php }?>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          <?php
          }else { ?>
            <div class="alert alert-warning" style="text-align:left;width:925px;margin-left:15px;">
              <strong>Aten&ccedil;&atilde;o!</strong>
              <br>Nenhum lançamento cadastrado.
            </div>
          <?php }?>
        </div>
      </form>
    </div><!-- FIM abaLanc de Lancamentos -->

    <div id="aba04" class="tab-pane" style="width:995px;"><!-- INICIO aba04 -->
      <?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel5']==1)){ // 5 FINANCEIRO - ADMINISTRADOR, 6 FINANCEIRO - LEITURA?>
      <div class="text-left" style="margin-left:13px;"><!-- INICIO POPUP NOTA DE ENPENHO CADASTRO -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalNotaEmpenho" title="NE = Nota de Empanho">Adicionar NE</button>
      </div>      
      <div id="myModalNotaEmpenho" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content" style="width:650px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <p class="modal-title" style="font-size:25px;">Adicionar NE</p>
            </div>
            <form role="form" method="post" action="<?php echo base_url();?>cnotaempenho/createnotaemp" name="formnotaemp">
            <div class="modal-body">
              <input type="hidden" name="contratoid" id="contratoid" value="<?php echo $IdContrato?>">
              <div class="row">
                <div class="col-xs-4">
                  <label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:-130px;">N&uacute;mero</label>
                  <input type="text" class="form-control" name="nenumcad" id="nenumcad" value="" maxlength="11" required autofocus>
                </div>
                <div class="col-xs-4">
                  <label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:-83px;">Data de emiss&atilde;o</label>
                  <input type="date" class="form-control" name="nedataemissaocad" id="nedataemissaocad" value="" required>
                </div>
                <div class="col-xs-4">
                  <label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:-145px;">Valor</label>
                  <input type="text" class="form-control" name="nevalorcad" id="nevalorcad" value="" style="width:160px;text-align:right;" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required>
                </div>
                <div class="col-xs-4">
                  <label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:-100px;">Valor anulado</label>
                  <input type="text" class="form-control" name="nevaloranuladocad" id="nevaloranuladocad" value="" style="width:160px;text-align:right;" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Salvar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <?php } ?>
      <!-- FINAL POPUP NOTA DE ENPENHO CADASTRO -->

      <div class="panel panel-info" style="margin-left:15px; margin-top:10px; width:962px;">
        <div class="panel-heading">
            <p class="panel-title text-left">Notas de Empenho</p>
        </div>
        <div class="panel-body text-left">
          <?php
          if(!empty($notasemp)&&(sizeof($notasemp)>0)){?>
          <div class="row">
            <div class="col-md-12">
              <!-- <table class="table" style="width:930px;margin-left:-15px;"> -->
              <table id="table_ne" class="table table-striped table-bordered" cellspacing="0"  style="width:900px;">
                <thead>
                  <tr style="background-color:#D3D3D3">
                    <th style="width:20%;text-align:center;">N&deg; Nota Empenho</th>
                    <th style="width:20%;text-align:center;">Data emiss&atilde;o</th>
                    <th style="width:25%;text-align:right;">Valor</th>
                    <th style="width:25%;text-align:right;">Valor anulado</th>
                    <th style="width:5%;text-align:center;">Alterar</th>
                    <th style="width:5%;text-align:center;">Excluir</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                foreach ($notasemp as $notemp):
                    $IdNotaEmp = $notemp->Id;
                    $ContratoId = $notemp->ContratoId;
                    $Numero = $notemp->Numero;
                    $EmissaoData = $notemp->EmissaoData; if($EmissaoData==""){$EmissaoData='';}else{$EmissaoData = date('d/m/Y',strtotime($EmissaoData));}
                    $Valor = $notemp->Valor; if($Valor != ""){$Valor = number_format($Valor, 2, ',', '.');}else{$Valor="0,00";}
                    $ValorAnulado = $notemp->ValorAnulado; if($ValorAnulado != ""){$ValorAnulado = number_format($ValorAnulado, 2, ',', '.');}else{$ValorAnulado="0,00";}?>
                  <tr>
                    <td style="text-align:center;"><?php echo $Numero?></td>
                    <td style="text-align:center;"><?php echo $EmissaoData?></td>
                    <td style="text-align:right;"><?php echo $Valor?></td>
                    <td style="text-align:right;"><?php echo $ValorAnulado?></td>
                    <?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel5']==1)){ // 5 FINANCEIRO - ADMINISTRADOR, 6 FINANCEIRO - LEITURA?>
                    <td style="text-align:center;">
                      <a href="#" onclick="ne_detalhe(<?php echo $IdNotaEmp?>)"><span class="glyphicon glyphicon-pencil"></span></a>
                    </td>
                    <td style="text-align:center;">
                      <a href="#"	onclick='return excluene(<?php echo $IdNotaEmp?>,<?php echo $ContratoId?>);' title="Deletar este registro."><span class="glyphicon glyphicon-trash"></a>
                    </td>
                    <?php }else{ ?>
                      <td style="text-align:center;">-</td>
                      <td style="text-align:center;">-</td>
                    <?php } ?>
                  </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
              <script type="text/javascript">
                $(document).ready( function () {
                    $('#table_ne').DataTable();
                });
                  var save_method; //for save method string
                  var table;
                  function ne_detalhe(IdNotaEmp){
                    pageEncoding="utf-8";
                    save_method = 'update';
                    $('#form_fatura')[0].reset(); // reset form on modals
                    $.ajax({
                      url : "<?php echo site_url();?>/index.php/cnotaempenho/getNotaEmpAjax/"+IdNotaEmp,
                      type: "GET",
                      dataType: "JSON",
                      success: function(data){
                        $('[name="notaempid"]').val(data.Id);
                        $('[name="contratoid"]').val(data.ContratoId);
                        $('[name="nenum"]').val(data.Numero);
                        $('[name="nedataemissao"]').val(data.EmissaoData);
                        $('[name="nevalor"]').val(data.Valor);
                        $('[name="nevaloranulado"]').val(data.ValorAnulado);
                        $('#modal_form_ne').modal('show'); // Mostra os dados depois de carregados
                        $('.modal-titlemed').text('Altera\xE7\xE3o de nota de empenho'); // Mostra o title no Modal
                      },
                      error: function (jqXHR, textStatus, errorThrown){
                          alert('N\xE3o foi poss\xEDvel buscar dados com ajax! Id: '+IdMedic);
                      }
                  });
                }
              </script>
              <!-- Begin bootstrap modal form medicao -->
              <div class="modal fade" id="modal_form_ne" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <p class="modal-titlemed" style="font-size:25px;"></p>
                    </div>
                    <form role="form" method="post" id="form_ne" action="<?php echo base_url();?>cnotaempenho/savenotaemp">
                      <div class="modal-body">
                        <input type="hidden" name="contratoid" id="contratoid" value="">
                        <input type="hidden" name="notaempid" id="notaempid" value="">
                        <div class="row">
                          <div class="col-xs-4">
                            <label class="control-label" style="margin-top:8px;margin-bottom:-2px;">N&uacute;mero</label>
                            <input type="text" class="form-control" name="nenum" id="nenum" value="" maxlength="10" required autofocus>
                          </div>
                          <div class="col-xs-4">
                            <label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Data de emiss&atilde;o</label>
                            <input type="date" class="form-control" name="nedataemissao" id="nedataemissao" value="" required>
                          </div>
                          <div class="col-xs-4">
                            <label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Valor</label>
                            <input type="text" class="form-control" name="nevalor" id="nevalor" value="" style="width:160px;text-align:right;" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required>
                          </div>
                          <div class="col-xs-4">
                            <label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Valor anulado</label>
                            <input type="text" class="form-control" name="nevaloranulado" id="nevaloranulado" value="" style="width:160px;text-align:right;" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Salvar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                      </div>
                    </form>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- End bootstrap modal form medicao  -->
            </div>
          </div>
          <?php }
          else { ?>
          <div class="alert alert-warning">
            <strong>Aten&ccedil;&atilde;o!</strong>
            <br>Nenhuma Nota de Empenho cadastrada!
          </div>
          <?php }?>
        </div>
      </div>
    </div><!-- FIM aba04 -->

    <div id="aba02" class="tab-pane" style="width:995px;"><!-- INICIO aba02 -->
      <!-- INICIO POPUP MEDICAO CADASTRO -->
      <?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel5']==1)){ // 5 FINANCEIRO - ADMINISTRADOR, 6 FINANCEIRO - LEITURA?>
      <div class="text-left" style="margin-left:13px;">
        <button type="button" id="btnMedicao" name="btnMedicao" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalMedicao">Adicionar medição</button>
      </div>
      <div id="myModalMedicao" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <p class="modal-title" style="font-size:25px;">Adicionar Medi&ccedil;&atilde;o</p>
            </div>
            <form role="form" method="post" action="<?php echo base_url();?>ccontrato/createmedicao" name="form">
            <div class="modal-body">
              <input type="hidden" name="contratoid" id="contratoid" value="<?php echo $IdContrato?>">
              <div class="row">
                <div class="col-xs-2">
                  <label class="control-label" style="margin-top:8px;margin-bottom:-2px;">N&uacute;mero</label>
                  <input type="text" class="form-control" name="mednumcad" id="mednumcad" value="" maxlength="2" onkeypress='return SomenteNumero(event)' required autofocus>
                </div>
                <div class="col-xs-5">
                  <label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Processo pagamento</label>
                  <input type="text" class="form-control" name="pradmcad" id="pradmcad" value="" maxlength="19" onkeypress='return SomenteNumero(event)' required>
                </div>
                <div class="col-xs-4">
                  <label class="control-label" style="margin-top:8px;margin-bottom:-2px;text-align:left;">Data liquida&ccedil;&atilde;o</label>
                  <input type="date" class="form-control" name="dataliqmedcad" id="dataliqmedcad" value="" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Salvar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <?php } ?>
      <!-- FINAL POPUP MEDICAO CADASTRO -->
    <div class="panel panel-info" style="margin-left:15px; margin-top:10px; width:962px;">
      <div class="panel-heading">
          <p class="panel-title text-left">Medi&ccedil;&otilde;es</p>
      </div>
      <div class="panel-body text-left">
            <?php
            if(!empty($medicoes)&&(sizeof($medicoes)>0)){?>
            <div class="row">
              <div class="col-md-12">
                <table id="table_medicao" class="table table-striped table-bordered" cellspacing="0"  style="width:900px;">
                  <thead>
                    <tr style="background-color:#D3D3D3">
                      <th style="width:25%;text-align:center;">N&deg; da Medi&ccedil;&atilde;o</th>
                      <th style="width:30%;text-align:center;">Processo de pagamento</th>
                      <th style="width:25%px;text-align:center;">Data de liquida&ccedil;&atilde;o</th>
                      <th style="width:10%;text-align:center;">Alterar</th>
                      <th style="width:10%;text-align:center;">Excluir</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    foreach ($medicoes as $med):
                      $IdMedic = $med->Id;
                      $NumeroMed = $med->Numero;
                      $ContratoId = $med->ContratoId;
                      $ProcessoPagMed = $med->ProcessoPagamento;
                      if($ProcessoPagMed != ""){ //112.000.222/2016
                        $primeiro = substr($ProcessoPagMed, 0, 3);
                        $segundo = substr($ProcessoPagMed, 3, 3);
                        $terceiro = substr($ProcessoPagMed, 6, 3);
                        $quarto = substr($ProcessoPagMed, 9, 4);
                        $ProcessoPagMed = $primeiro.".".$segundo.".".$terceiro."/".$quarto;
                      }else{$ProcessoPagMed = "";}
                      $DataLiqMed = $med->DataLiquidacao; if($DataLiqMed==""){$DataLiqMed='';}else{$DataLiqMed = date('d/m/Y',strtotime($DataLiqMed));}?>
                    <tr>
                      <th style="text-align:center;"><?php echo $NumeroMed?></th>
                      <td style="text-align:center;"><?php echo $ProcessoPagMed?></td>
                      <td style="text-align:center;"><?php echo $DataLiqMed?></td>
                      <?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel5']==1)){ // 5 FINANCEIRO - ADMINISTRADOR, 6 FINANCEIRO - LEITURA?>
                      <td style="text-align:center;">
                        <a href="#" onclick="medicao_detalhe(<?php echo $IdMedic?>)"><span class="glyphicon glyphicon-pencil"></span></a>
                      </td>
                      <td style="text-align:center;">
                        <a href="#"	onclick='return excluemedicao(<?php echo $IdMedic?>,<?php echo $ContratoId?>);' title="Deletar este registro."><span class="glyphicon glyphicon-trash"></a>
                      </td>
                      <?php }else{ ?>
                        <td style="text-align:center;">-</td>
                        <td style="text-align:center;">-</td>
                      <?php } ?>
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
                <script type="text/javascript">
                  $(document).ready( function () {
                      $('#table_medicao').DataTable();
                  });
                    var save_method; //for save method string
                    var table;
                    function medicao_detalhe(IdMedic){
                      pageEncoding="utf-8";
                      save_method = 'update';
                      $('#form_medicao')[0].reset(); // reset form on modals
                      $.ajax({
                        url : "<?php echo site_url();?>/index.php/ccontrato/getMedicaoAjax/"+IdMedic,
                        type: "GET",
                        dataType: "JSON",
                        success: function(data){
                          $('[name="medicaoid"]').val(data.Id);
                          $('[name="contratoid"]').val(data.ContratoId);
                          $('[name="mednum"]').val(data.Numero);
                          $('[name="pradm"]').val(data.ProcessoPagamento);
                          $('[name="dataliqmed"]').val(data.DataLiquidacao);
                          $('#modal_form_med').modal('show'); // Mostra os dados depois de carregados
                          $('.modal-titlemed').text('Altera\xE7\xE3o de medi\xE7\xE3o'); // Mostra o title no Modal
                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            alert('N\xE3o foi poss\xEDvel buscar dados com ajax! Id: '+IdMedic);
                        }
                    });
                  }
                </script>
                <!-- Begin bootstrap modal form medicao -->
                <div class="modal fade" id="modal_form_med" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p class="modal-titlemed" style="font-size:25px;"></p>
                      </div>
                      <form role="form" method="post" id="form_medicao" action="<?php echo base_url();?>ccontrato/savemedicao">
                        <div class="modal-body">
                          <input type="hidden" name="contratoid" id="contratoid" value="">
                          <input type="hidden" name="medicaoid" id="medicaoid" value="">
                          <div class="row">
                            <div class="col-xs-2">
                              <label class="control-label">N&uacute;mero</label>
                              <input type="text" class="form-control" name="mednum" id="mednum" value="" maxlength="2" onkeypress='return SomenteNumero(event)' required autofocus>
                            </div>
                            <div class="col-xs-4">
                              <label class="control-label">Processo pagamento</label>
                              <input type="text" class="form-control" name="pradm" id="pradm" value="" maxlength="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)' required>
                            </div>
                            <div class="col-xs-4">
                              <label class="control-label">Data liquida&ccedil;&atilde;o</label>
                              <input type="date" class="form-control" name="dataliqmed" id="dataliqmed" value="" required>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success">Salvar</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                      </form>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- End bootstrap modal form medicao  -->
              </div>
            </div>
            <?php }
            else { ?>
            <div class="alert alert-warning">
              <strong>Aten&ccedil;&atilde;o!</strong>
              <br>Nenhuma medi&ccedil;&atilde;o cadastrada!
            </div>
            <?php }?>
          </div>
        </div>
    </div><!-- FIM aba02 -->

    <div id="aba03" class="tab-pane" style="width:995px;"><!-- INICIO aba03 Faturas -->
      <!-- INICIO POPUP FATURA CADASTRO -->
      <?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel5']==1)){ // 5 FINANCEIRO - ADMINISTRADOR, 6 FINANCEIRO - LEITURA?>
      <div class="text-left" style="margin-left:13px;">
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalFaturas">Adicionar fatura</button>
      </div>
      <div id="myModalFaturas" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content" style="width:650px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <p class="modal-title" style="font-size:25px;">Adicionar Fatura</p>
            </div>
            <form role="form" method="post" action="<?php echo base_url();?>cfatura/createfatura" name="formfat">
            <div class="modal-body">
              <input type="hidden" name="contratoid" id="contratoid" value="<?php echo $IdContrato?>">
              <div class="row">
                <div class="col-xs-4">
                  <label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:-130px;">N&uacute;mero</label>
                  <input type="text" class="form-control" name="fatnumcad" id="fatnumcad" value="" maxlength="10" required autofocus>
                </div>
                <div class="col-xs-4">
                  <label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:-140px;">Valor</label>
                  <input type="text" class="form-control" name="fatvalorcad" id="fatvalorcad" value="" style="width:160px;text-align:right;" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required>
                </div>
                <div class="col-xs-4">
                  <label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:-88px;">Data liquida&ccedil;&atilde;o</label>
                  <input type="date" class="form-control" name="fatatestodatacad" id="fatatestodatacad" value="" required>
                </div>
                <div class="col-xs-4">
                  <label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:-145px;">Glosa</label>
                  <input type="text" class="form-control" name="fatglosacad" id="fatglosacad" value="" style="width:160px;text-align:right;" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Salvar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <?php } ?>
      <!-- FINAL POPUP FATURA CADASTRO -->

    <div class="panel panel-info" style="margin-left:15px; margin-top:10px; width:962px;">
      <div class="panel-heading">
          <p class="panel-title text-left">Faturas</p>
      </div>
      <div class="panel-body text-left">
          <?php
          if(!empty($faturas)&&(sizeof($faturas)>0)){?>
            <div class="row">
              <div class="col-md-12">
                <!-- <table class="table" style="width:930px;margin-left:-15px;"> -->
                <table id="table_fatura" class="table table-striped table-bordered" cellspacing="0"  style="width:900px;">
                  <thead>
                    <tr style="background-color:#D3D3D3">
                      <th style="width:15%;text-align:center;">Fatura n&deg;</th>
                      <th style="width:20%;text-align:right;">Valor</th>
                      <th style="width:20%;text-align:center;">Data atesto</th>
                      <th style="width:20%;text-align:right;">Glosa</th>
                      <th style="width:20%;text-align:right;">Retenções</th>
                      <th style="width:5%;text-align:center;">Alterar</th>
                      <th style="width:5%;text-align:center;">Excluir</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  foreach ($faturas as $fat):
                    $IdFat = $fat->Id;
                    $ContratoId = $fat->ContratoId;
                    $NumeroFat = $fat->Numero;
                    $ValorFat = $fat->Valor; //if($ValorFat != ""){$ValorFat = number_format($ValorFat, 2, ',', '.');}else{$ValorFat="0,00";}
                    $AtestoDataFat = $fat->AtestoData; //if($AtestoDataFat==""){$AtestoDataFat='';}else{$AtestoDataFat = date('d/m/Y',strtotime($AtestoDataFat));}
                    $GlosaFat = $fat->Glosa; //if($GlosaFat != ""){$GlosaFat = number_format($GlosaFat, 2, ',', '.');}else{$GlosaFat="0,00";}
                    $RetencoesFat = $fat->Retencoes; if($RetencoesFat==""){$RetencoesFat="0,00";}?>
                    <tr>
                      <td style="text-align:center;"><?php echo $NumeroFat?></td>
                      <td style="text-align:right;"><?php echo $ValorFat?></td>
                      <td style="text-align:center;"><?php echo $AtestoDataFat?></td>
                      <td style="text-align:right;"><?php echo $GlosaFat?></td>                      
                      <td style="text-align:right;">
                        <a href="<?php echo base_url();?>cretencoes/faturaretencoes/<?php echo $ContratoId?>/<?php echo $IdFat?>"><?php echo $RetencoesFat?></span></a>
                      </td>
                      <?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel5']==1)){ // 5 FINANCEIRO - ADMINISTRADOR, 6 FINANCEIRO - LEITURA?>
                      <td style="text-align:center;">
                        <a href="#" onclick="fatura_detalhe(<?php echo $IdFat?>)"><span class="glyphicon glyphicon-pencil"></span></a>
                      </td>
                      <td style="text-align:center;">
                        <a href="#"	onclick='return excluefat(<?php echo $IdFat?>,<?php echo $ContratoId?>);' title="Deletar este registro."><span class="glyphicon glyphicon-trash"></a>
                      </td>
                      <?php }else{ ?>
                        <td style="text-align:center;">-</td>
                        <td style="text-align:center;">-</td>
                      <?php } ?>
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
                <script type="text/javascript">
                  $(document).ready( function () {
                      $('#table_fatura').DataTable();
                  });
                    var save_method; //for save method string
                    var table;
                    function fatura_detalhe(IdFat){
                      pageEncoding="utf-8";
                      save_method = 'update';
                      $('#form_fatura')[0].reset(); // reset form on modals
                      $.ajax({
                        url : "<?php echo site_url();?>/index.php/cfatura/getFaturaAjax/"+IdFat,
                        type: "GET",
                        dataType: "JSON",
                        success: function(data){
                          $('[name="faturaid"]').val(data.Id);
                          $('[name="contratoid"]').val(data.ContratoId);
                          $('[name="fatnum"]').val(data.Numero);
                          $('[name="fatvalor"]').val(data.Valor);
                          $('[name="fatatestodata"]').val(data.DataLiquidacao);
                          $('[name="fatglosa"]').val(data.Glosa);
                          $('#modal_form_fat').modal('show'); // Mostra os dados depois de carregados
                          $('.modal-titlemed').text('Altera\xE7\xE3o de fatura'); // Mostra o title no Modal
                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            alert('N\xE3o foi poss\xEDvel buscar dados com ajax! Id: '+IdMedic);
                        }
                    });
                  }
                </script>
                <!-- Begin bootstrap modal form medicao -->
                <div class="modal fade" id="modal_form_fat" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p class="modal-titlemed" style="font-size:25px;"></p>
                      </div>
                      <form role="form" method="post" id="form_fatura" action="<?php echo base_url();?>cfatura/savefatura">
                        <div class="modal-body">
                          <input type="hidden" name="contratoid" id="contratoid" value="">
                          <input type="hidden" name="faturaid" id="faturaid" value="">
                          <div class="row">
                            <div class="col-xs-4">
                              <label class="control-label" style="margin-top:8px;margin-bottom:-2px;">N&uacute;mero</label>
                              <input type="text" class="form-control" name="fatnum" id="fatnum" value="" maxlength="10" required autofocus>
                            </div>
                            <div class="col-xs-4">
                              <label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Valor</label>
                              <input type="text" class="form-control" name="fatvalor" id="fatvalor" value="" style="width:160px;text-align:right;" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required>
                            </div>
                            <div class="col-xs-4">
                              <label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Data liquida&ccedil;&atilde;o</label>
                              <input type="date" class="form-control" name="fatatestodata" id="fatatestodata" value="" required>
                            </div>
                            <div class="col-xs-4">
                              <label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Valor</label>
                              <input type="text" class="form-control" name="fatglosa" id="fatglosa" value="" style="width:160px;text-align:right;" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success">Salvar</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                      </form>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- End bootstrap modal form medicao  -->
              </div>
            </div>
            <?php }
            else { ?>
            <div class="alert alert-warning">
              <strong>Aten&ccedil;&atilde;o!</strong>
              <br>Nenhuma fatura cadastrada!
            </div>
            <?php }?>
      </div>
    </div>
    </div><!-- FIM aba03 -->

    <div id="aba05" class="tab-pane" style="width:995px;"><!-- INICIO aba05 -->
      <!-- INICIO POPUP ORDEM BANCÁRIA CADASTRO -->
      <?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel5']==1)){ // 5 FINANCEIRO - ADMINISTRADOR, 6 FINANCEIRO - LEITURA?>
      <div class="text-left" style="margin-left:13px;">
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalOrdemBanc" title="OB = Ordem Banc&aacute;ria">Adicionar OB</button>
      </div>
      <div id="myModalOrdemBanc" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content" style="width:650px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <p class="modal-title" style="font-size:25px;">Adicionar OB</p>
            </div>
            <form role="form" method="post" action="<?php echo base_url();?>cordembancaria/createordembanc" name="formordembanc">
            <div class="modal-body">
              <input type="hidden" name="contratoid" id="contratoid" value="<?php echo $IdContrato?>">
              <div class="row">
                <div class="col-xs-4">
                  <label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:-130px;">N&uacute;mero</label>
                  <input type="text" class="form-control" name="obnumcad" id="obnumcad" value="" maxlength="11" required autofocus>
                </div>
                <div class="col-xs-4">
                  <label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:-83px;">Data de emiss&atilde;o</label>
                  <input type="date" class="form-control" name="obdataemissaocad" id="obdataemissaocad" value="" required>
                </div>
                <div class="col-xs-4">
                  <label class="control-label" style="margin-top:8px;margin-bottom:-2px;margin-left:-145px;">Valor</label>
                  <input type="text" class="form-control" name="obvalorcad" id="obvalorcad" value="" style="width:160px;text-align:right;" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Salvar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <?php } ?>
      <!-- FINAL POPUP ORDEM BANCÁRIA CADASTRO -->

    <div class="panel panel-info" style="margin-left:15px; margin-top:10px; width:962px;">
      <div class="panel-heading">
          <p class="panel-title text-left">Ordens Banc&aacute;rias</p>
      </div>
      <div class="panel-body text-left">
            <?php
            if(!empty($ordensbanc)&&(sizeof($ordensbanc)>0)){?>
            <div class="row">
              <div class="col-md-12">
                <!-- <table class="table" style="width:930px;margin-left:-15px;"> -->
                <table id="table_ob" class="table table-striped table-bordered" cellspacing="0"  style="width:900px;">
                  <thead>
                    <tr style="background-color:#D3D3D3">
                      <th style="width:20%;text-align:center;">N&deg; OB</th>
                      <th style="width:30%;text-align:center;">Data emiss&atilde;o</th>
                      <th style="width:30%;text-align:right;;">Valor</th>
                      <th style="width:10%;text-align:center;">Alterar</th>
                      <th style="width:10%;text-align:center;">Excluir</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  foreach ($ordensbanc as $ordemb):
                      $IdOrdemB = $ordemb->Id;
                      $ContratoId = $ordemb->ContratoId;
                      $Numero = $ordemb->Numero;
                      $EmissaoData = $ordemb->EmissaoData; if($EmissaoData==""){$EmissaoData='';}else{$EmissaoData = date('d/m/Y',strtotime($EmissaoData));}
                      $Valor = $ordemb->Valor; if($Valor != ""){$Valor = number_format($Valor, 2, ',', '.');}else{$Valor="0,00";}?>
                    <tr>
                      <td style="text-align:center;"><?php echo $Numero?></td>
                      <td style="text-align:center;"><?php echo $EmissaoData?></td>
                      <td style="text-align:right;"><?php echo $Valor?></td>
                      <?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel5']==1)){ // 5 FINANCEIRO - ADMINISTRADOR, 6 FINANCEIRO - LEITURA?>
                      <td style="text-align:center;">
                        <a href="#" onclick="ob_detalhe(<?php echo $IdOrdemB?>)"><span class="glyphicon glyphicon-pencil"></span></a>
                      </td>
                      <td style="text-align:center;">
                        <a href="#"	onclick='return exclueob(<?php echo $IdOrdemB?>,<?php echo $ContratoId?>);' title="Deletar este registro."><span class="glyphicon glyphicon-trash"></a>
                      </td>
                      <?php }else{ ?>
                        <td style="text-align:center;">-</td>
                        <td style="text-align:center;">-</td>
                      <?php } ?>
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
                <script type="text/javascript">
                  $(document).ready( function () {
                      $('#table_ob').DataTable();
                  });
                    var save_method; //for save method string
                    var table;
                    function ob_detalhe(IdOrdemB){
                      pageEncoding="utf-8";
                      save_method = 'update';
                      $('#form_ob')[0].reset(); // reset form on modals
                      $.ajax({
                        url : "<?php echo site_url();?>/index.php/cordembancaria/getOrdemBancAjax/"+IdOrdemB,
                        type: "GET",
                        dataType: "JSON",
                        success: function(data){
                          $('[name="ordembancid"]').val(data.Id);
                          $('[name="contratoid"]').val(data.ContratoId);
                          $('[name="obnum"]').val(data.Numero);
                          $('[name="obdataemissao"]').val(data.EmissaoData);
                          $('[name="obvalor"]').val(data.Valor);
                          $('#modal_form_ob').modal('show'); // Mostra os dados depois de carregados
                          $('.modal-titlemed').text('Altera\xE7\xE3o de ordem banc\xE1ria'); // Mostra o title no Modal
                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            alert('N\xE3o foi poss\xEDvel buscar dados com ajax! Id: '+IdMedic);
                        }
                    });
                  }
                </script>
                <!-- Begin bootstrap modal form medicao -->
                <div class="modal fade" id="modal_form_ob" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p class="modal-titlemed" style="font-size:25px;"></p>
                      </div>
                      <form role="form" method="post" id="form_ob" action="<?php echo base_url();?>cordembancaria/saveordembanc">
                        <div class="modal-body">
                          <input type="hidden" name="contratoid" id="contratoid" value="">
                          <input type="hidden" name="ordembancid" id="ordembancid" value="">
                          <div class="row">
                            <div class="col-xs-4">
                              <label class="control-label" style="margin-top:8px;margin-bottom:-2px;">N&uacute;mero</label>
                              <input type="text" class="form-control" name="obnum" id="obnum" value="" maxlength="10" required autofocus>
                            </div>
                            <div class="col-xs-4">
                              <label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Data de emiss&atilde;o</label>
                              <input type="date" class="form-control" name="obdataemissao" id="obdataemissao" value="" required>
                            </div>
                            <div class="col-xs-4">
                              <label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Valor</label>
                              <input type="text" class="form-control" name="obvalor" id="obvalor" value="" style="width:160px;text-align:right;" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success">Salvar</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                      </form>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- End bootstrap modal form medicao  -->
              </div>
            </div>
            <?php }
            else { ?>
            <div class="alert alert-warning">
              <strong>Aten&ccedil;&atilde;o!</strong>
              <br>Nenhuma Ordem Banc&aacute;ria cadastrada!
            </div>
            <?php }?>
      </div>
    </div><!-- FIM aba05 -->
    <!-- </div>   -->
  </div>
</div>
<?php //$this->load->view('view_rodape');?>
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
