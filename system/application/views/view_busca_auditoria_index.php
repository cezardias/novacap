<?php 
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' => 'calendar');
?>

<script language="JavaScript">
function validauditoria(){
	tipoacao = document.formbuscacao.tipoacao.value;
	statusacao = document.formbuscacao.statusacao.value;
	probabilidadeid = document.formbuscacao.probabilidadeid.value; 
	
	if((tipoacao=="")&&(statusacao=="")&&(probabilidadeid=="")){
		alert("Informe pelo menos o tipo de ação!");	
		return false;
	}	
	if(tipoacao==""){
		alert("Informe o tipo de ação");	
		return false;
	}	
}
</script>

<div id="caixa7">
<div id="tabs">
<fieldset class=visible style='width:938px; margin-left:-3px; background-color: #87CEFA;'>
	<font size="5">Pesquisa de auditoria</font>
</fieldset>

<fieldset class='visible' style='width:938px; margin-left:-3px;'>
<form method="post" action="<?php echo base_url();?>cjuridico/relatauditoriaresult" name="formbuscacao" onsubmit="return validauditoria()">
<?php 
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
?>

<form method="post" action="<?php echo base_url();?>cjuridico/relatauditoriaresult" name="formauditoria" onsubmit="return validauditoria()">
<br>

<div class="row">
	<div class="label">Tipo de ação<font style="color:white; font-size:7;"> &#10054;</font></div>
	<div class="field">
		<select name="tipoacao">
			<option value=""></option>
			<option value="2">CÍVEL</option>
			<option value="1">TRABALHISTA</option>
		</select>
	</div>
</div>
 
<div class="row">
	<div class="label">Probabilidade perda<font style="color:white; font-size:7;"> &#10054;</font></div>
	<div class="field">
		<select name="probabilidadeid">
			<option value=""></option>
			<?php foreach ($ProbPerda as $prob): ?>
				<option value="<?php echo $prob['Id'];?>"><?php echo $prob['Descricao'];?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Status<font style="color:white; font-size:7;"> &#10054;</font></div>
	<div class="field">
		<select name="statusacao">
			<option value=""></option>
			<option value="1">ATIVO</option>
			<option value="0">INATIVO</option>
		</select>
	</div>
</div>

<div class="row">
	<div class="label"></div>
	<div class="field">
	Posição da Novacap no processo
		<input type="radio" name="posicaonovacap" value="1"/>Autora 
		<input type="radio" name="posicaonovacap" value="2"/>RÉ
	</div>	
</div>
<hr>
<input type="submit" name="submit" value="Pesquisar &#128270;" class="botao"/>
<br>
</form>
</fieldset>
</div>
</div>
</div>
<?php $this->load->view('view_rodape');?>