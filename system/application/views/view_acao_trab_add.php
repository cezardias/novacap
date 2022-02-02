<?php
$this->load->view('view_cabecalho');
$attributes = array('name' =>  'calendar');
?>
<script language="JavaScript">
function validacaotrab(){
	prjud = document.formacaotrab.prjud.value; /* 0001069-77.2016.5.10.0010 - char[25] */
	vara = document.formacaotrab.varaid.value;
	psnvap = document.formacaotrab.posicaonovacap.value;
	var prsei = document.getElementById("prsei");
	// if((prjud=="")||(vara=="")||(psnvap=="")){
	// 	alert("Por favor, preencha todos os campos obrigat\u00f3rios!");
	// 	return false;
	// }
	if(prjud.length != 25){
		alert("Processo judicial inválido!");
		return false;
	}

	if(prsei.value != ""){
		if(prsei.value.length != 22){ //contagem bruta, considerar para crítica apenas os números.
			alert("Processo SEI deve ter exatamente 19 dígitos!");
			document.getElementById("prsei").focus();
			return false;
		}
	}
}

function getAdvogado(str) {
    if (str == "") {
        document.getElementById("advogadoshow").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            //code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("advogadoshow").innerHTML = this.responseText;
            }
        };
        //alert(str);
        xmlhttp.open("GET","./getadvogado.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>

<?php
$ProbPerda = array( //Manter probabilidade de perdas padrão.
    array(
        'Id' => 1, //NAO ALTERE
        'Descricao' => utf8_decode('PROVÁVEL')
    ),
    array(
        'Id' => 2, //NAO ALTERE
        'Descricao' => utf8_decode('POSSÍVEL')
    ),
        array(
        'Id' => 3, //NAO ALTERE
        'Descricao' => 'REMOTA'
    )
);
//print_r($ProbPerda);
?>
<fieldset class=visible style='width:938px;margin-left:0px;background-color: #87CEFA;'>
<font size="5">
	<img src="<?php echo base_url();?>img/icons/add.png"/> inclusão de ação trabalhista
</font>
</fieldset>

<div id="caixa7">
<div id="tabs">
<fieldset class='visible' style='width:938px; margin-left:-3px; margin-top: -3px;'>
<form method="post" action="<?php echo base_url();?>cjuridico/createacaotrab" name="formacaotrab" onsubmit="return validacaotrab()">

<div class="row">
	<div class="label">Processo judicial</div>
	<div class="field">
		<input type="text" name="prjud" id="prjud" maxlength="25" size="26" value="" onkeypress='MaskPrJud(this, event); return SomenteNumero(event)' required/>
	</div>
	&nbsp;&nbsp;&nbsp;
	Processo admin.
	<div class="field">
		<input type="text" name="pradm" id="pradm" maxlength="16" size="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)'/>
	</div>
	&nbsp;
	Processo SEI
	<div class="field">
		<input type="text" name="prsei" id="prsei" maxlength="22" size="23" value="" onkeypress='MaskPrSEI(this, event); return SomenteNumero(event)'/>
	</div>
</div>

<div class="row">
	<div class="label">Fundamento Legal</div>
	<div class="field">
		<input type="text" name="fundlegal" id="fundlegal" value="" maxlength="50" size="80" style="text-transform: uppercase;"/>
	</div>
</div>

<div class="row">
	<div class="label">C&aacute;lculo homologado</div>
	<div class="field">
		<input type="text" name="calchomovalor" id="calchomovalor" size="10"  value="" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
	&nbsp;
	Valor da causa
	<div class="field">
		<input type="text" name="causavalor" id="causavalor" size="10"  value="" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
	&nbsp;
	Valor senten&ccedil;a
	<div class="field">
		<input type="text" name="sentencavalor" id="sentencavalor" size="10"  value="" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
</div>

<div class="row">
	<div class="label">Valor ac&oacute;rd&atilde;o</div>	
	<div class="field">
		<input type="text" name="acordaovalor" id="acordaovalor" size="10"  value="" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
	&nbsp;
	Valor condena&ccedil;&atilde;o
	<div class="field">
		<input type="text" name="condenavalor" id="condenavalor" size="10"  value="" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
</div>

<div class="row">
	<div class="label">Vara</div>
	<div class="field">
		<select name="varaid" required>
			<option value=""></option>
			<?php foreach ($varas as $vr): ?>
				<option value="<?php echo $vr->VaraId;?>"><?php echo utf8_encode($vr->Descricao)?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Probab. de perda</div>
	<div class="field">
		<select name="probabilidadeid">
			<option value=""></option>
			<?php foreach ($ProbPerda as $prob): ?>
				<option value="<?php echo $prob['Id'];?>"><?php echo $prob['Descricao'];?></option>
			<?php endforeach;?>
		</select>
	</div>
	&nbsp;&nbsp;&nbsp;&nbsp;
	Posi&ccedil;&atilde;o da Novacap no processo
	<div class="field">
		<input type="radio" name="posicaonovacap" value="1"/>Autora
		<input type="radio" name="posicaonovacap" value="2" checked="checked"/>R&eacute;
	</div>
</div>

<div class="row">
	<div class="label">Observa&ccedil;&otilde;es</div>
	<div class="field">
		<textarea name="observacao" rows="3" cols="103" maxlength="255" style="text-transform: uppercase;"></textarea>
	</div>
</div>

<div class="row">
	<div class="label">Status do processo</div>
	<div class="field">
		<select name="statusprocessoid" required>
			<option value="1" selected>ATIVO</option>
			<option value="0">INATIVO</option>
		</select>
	</div>
	&nbsp;
	Data de ajuizamento
	<div class="field">
		<input type="text" value="" name="dtajuizamento" id="dtajuizamento" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formacaotrab.dtajuizamento,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
		<a onclick="document.getElementById('dtajuizamento').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url()?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
	</div>
	&nbsp;
	Data extin&ccedil;&atilde;o
	<div class="field">
		<input type="text" value="" name="dtextincao" id="dtextincao" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formacaotrab.dtextincao,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
		<a onclick="document.getElementById('dtextincao').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url()?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
	</div>
	&nbsp;
	Sisprot
	<div class="field">
		<input type="text" name="sisprot" id="sisprot" value="" size="8" maxlength="8" onkeypress='return SomenteNumero(event)'/>
	</div>
</div>

<div class="row">
	<div class="label">Caixa n&uacute;mero</div>
	<div class="field">
		<input type="text" name="cxnum" id="cxnum" size="3" maxlength="4" value="" onkeypress='return SomenteNumero(event)'/>
	</div>
	&nbsp;&nbsp;
	Processo pai
	<div class="field">
		<input type="text" name="prpai" id="prpai" maxlength="25" size="24" value="" onkeypress='MaskPrJud(this, event); return SomenteNumero(event)'/>
	</div>
</div>
<hr>
<div class="row">
	<input type="submit" value="Salvar" class="botao" style="text-decoration:none; color: green;"/>&nbsp;
	<a href="<?php echo base_url()."cjuridico/index/";?>" style="text-decoration:none;">
		<input type="button" value="Cancelar" onclick="location.href('<?php echo base_url()."cjuridico/index/";?>')" class="botao" style="color: red;">
	</a>
</div>
</form>
</fieldset>
</div>
</div>
<?php $this->load->view('view_rodape');?>
