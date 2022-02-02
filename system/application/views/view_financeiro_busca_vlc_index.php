<?php 
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' => 'calendar');
 
$ProbPerda = array( //Manter probabilidade de perdas padrão.
    array(
        'Id' => 1, //NÃO ALTERE
        'Descricao' => 'PROVÁVEL'
    ),
    array(
        'Id' => 2, //NÃO ALTERE
        'Descricao' => 'POSSÍVEL'
    ),
        array(
        'Id' => 3, //NÃO ALTERE
        'Descricao' => 'REMOTA'
    )
); 
//print_r($ProbPerda);

$idacaovlc; //permitir voltar para detalhamento.
?>

<link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/3.3.7/bootstrap.min.css">
<script src="<?php echo base_url()?>bootstrap/jquery/3.2.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/js/3.3.7/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings.png"></script>
<script src="<?php echo base_url()?>bootstrap/img/glyphicons-halflings-white.png"></script>

<br>
<form method="post" action="<?php echo base_url();?>cfinanceiro/buscafinanceirovlcresult" name="formvlc">
<div class="container" style="width:1018px;margin-left:-30px;">

<div class="row">
	<div class="well well-sm" style="width:960px;margin-left:15px;">
		<font size="5">Pesquisa relatório VLC</font>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Nome</label>
		<input type="text" class="form-control" name="nome" id="nome" value="" style="text-transform:uppercase;" autofocus>					
	</div>
	<div class="col-xs-4">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">CPF/CNPJ</label>
		<input type="text" class="form-control" name="cpfcnpj" id="cpfcnpj" value="" maxlength="14" onkeypress='return SomenteNumero(event)'>					
	</div>	
	<div class="col-xs-4 selectContainer">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Ação tipo</label>
		<select class="form-control" name="acoestipoid" required>
			<option value=""></option>
			<?php foreach ($acoestipo as $acs):?>
				<option value="<?php echo $acs->Id;?>"><?php echo $acs->Descricao;?></option>
			<?php endforeach;?>
		</select>
	</div>		
	<div class="col-xs-4 selectContainer">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Probabilidade de perda</label>
		<select class="form-control" name="probperdaid">
			<option value=""></option>
			<?php foreach ($ProbPerda as $prob): ?>
				<option value="<?php echo $prob['Id'];?>"><?php echo $prob['Descricao'];?></option>
			<?php endforeach;?>			
		</select>
	</div>		
	<div class="col-xs-8 selectContainer">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Assunto</label>
		<select class="form-control" name="assuntoid">
			<option value=""></option>
			<?php foreach ($assuntos as $ass):?>
				<option value="<?php echo $ass->Id;?>"><?php echo $ass->Descricao;?></option>
			<?php endforeach;?>
		</select>
	</div>	
	<div class="col-xs-2">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Valor inicial</label>
		<input type="text" class="form-control" name="valorinicial" id="valorinicial" value="" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;">					
	</div>	
	<div class="col-xs-2">
		<label class="control-label" style="margin-top:8px;margin-bottom:-2px;">Valor final</label>
		<input type="text" class="form-control" name="valorfinal" id="valorfinal" value="" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;">					
	</div>				
</div>
<hr>
<input class="btn btn-primary btnpequenomin" type="submit" name="submit" id="submit" value="Pesquisar" style="margin-left:15px;" formtarget="_blank">
<button type="button" class="btn btn-primary btnpequenomin">
	<a href="<?php echo base_url()."cfinanceiro/detailfinanceiro/".$idacaovlc;?>" style="color:white;font-size:15px;font-family: Helvetica, Arial;">Voltar</a>	
</button>
<br><br>
</div>
</form>
<?php $this->load->view('view_rodape');?>