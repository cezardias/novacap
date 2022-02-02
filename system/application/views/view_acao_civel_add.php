<?php
$this->load->view('view_cabecalho');
$attributes = array('name' =>  'calendar');?>

<script language="JavaScript">
function validacaocivil(){
	prjud = document.formacaocivel.prjudantigo.value; /* 0001069-77.2016.5.10.0010 - char[25] */
	varaid = document.formacaocivel.varaid.value;
	psnvap = document.formacaocivel.posicaonovacap.value;
	var prsei = document.getElementById("prsei");
	// if((prjud=="")||(varaid=="")||(psnvap=="")){
	// 	alert("Por favor, preencha todos os campos obrigatórios!");
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
$ProbPerda = array( //Manter probabilidade de perdas padrao.
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
	<img src="<?php echo base_url();?>img/icons/add.png"/> inclusão de ação cível
</font>
</fieldset>

<div id="caixa7">
<div id="tabs">
<fieldset class='visible' style='width:938px; margin-left:-3px; margin-top: -3px;'>
<form method="post" action="<?php echo base_url();?>cacaocivel/createacaocivel" name="formacaocivel" onsubmit="return validacaocivil()">
<div class="row">
	<!-- Tipo de acao no controla, para trabalhista -->
	<input type="hidden" name="tipo" id="tipo" size="4" value="2"/>
	<div class="label">Processo judicial</div>
	<div class="field">
		<input type="text" name="prjudantigo" id="prjudantigo" maxlength="25" size="27" value="" style="text-transform:uppercase;" required autofocus/>
	</div>
	&nbsp;&nbsp;
	CNJ
	<div class="field">
		<input type="text" name="prjud_cnj" id="prjud_cnj" maxlength="25" size="27" value="" onkeypress='MaskPrJud(this, event); return SomenteNumero(event)'/>
	</div>
</div>

<div class="row">
	<!-- Tipo de acao no controla, para trabalhista 1 -->
	<input type="hidden" name="tipo" id="tipo" size="4" value="2"/>
	<div class="label">Processo admin.</div>
	<div class="field">
		<input type="text" name="pradm" id="pradm" size="15" maxlength="16" onkeypress='MaskPrAdm(this, event); return SomenteNumero(event)'/>
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
	<div class="label">Cálculo homologado</div>
	<div class="field">
		<input type="text" name="calchomovalor" id="calchomovalor" size="16"  value="" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
	&nbsp;&nbsp;
	Cálculo homologado Tipo
	<div class="field">
		<select name="calchomovalortipo" required>
			<option value=""></option>
			<?php foreach ($auxvalorestipo as $vrltipo): ?>
				<option value="<?php echo $vrltipo->Id;?>"><?php echo $vrltipo->Descricao?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Valor da causa</div>
	<div class="field">
		<input type="text" name="causavalor" id="causavalor" size="16"  value="" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
	&nbsp;&nbsp;
	Causa valor Tipo
	<div class="field">
		<select name="causavalortipo" required>
			<option value=""></option>
			<?php foreach ($auxvalorestipo as $vrltipo): ?>
				<option value="<?php echo $vrltipo->Id;?>"><?php echo $vrltipo->Descricao?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Valor da sentença</div>
	<div class="field">
		<input type="text" name="sentencavalor" id="sentencavalor" size="16"  value="" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
	&nbsp;&nbsp;
	Senten&ccedil;a valor Tipo
	<div class="field">
		<select name="sentensavalortipo" required>
			<option value=""></option>
			<?php foreach ($auxvalorestipo as $vrltipo): ?>
				<option value="<?php echo $vrltipo->Id;?>"><?php echo $vrltipo->Descricao?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Valor do acórdão</div>
	<div class="field">
		<input type="text" name="acordamvalor" id="acordamvalor" size="16"  value="" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
	&nbsp;&nbsp;
	Acórdão valor Tipo
	<div class="field">
		<select name="acordamvalortipo" required>
			<option value=""></option>
			<?php foreach ($auxvalorestipo as $vrltipo): ?>
				<option value="<?php echo $vrltipo->Id;?>"><?php echo $vrltipo->Descricao?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>

<div class="row">
	<div class="label">Valor condenação</div>
	<div class="field">
		<input type="text" name="condenavalor" id="condenavalor" size="16"  value="" onKeyPress="return MascaraMoeda(this,'.',',',event);" style="text-align:right;" required/>
	</div>
	&nbsp;&nbsp;
	Condenação valor Tipo
	<div class="field">
		<select name="condenacaovalortipo" required>
			<option value=""></option>
			<?php foreach ($auxvalorestipo as $vrltipo): ?>
				<option value="<?php echo $vrltipo->Id;?>"><?php echo $vrltipo->Descricao?></option>
			<?php endforeach;?>
		</select>
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
		</select><font style="color:red; font-size:7;"> &#10054;</font>
	</div>
</div>

<div class="row">
	<div class="label">Probab. de perda</div>
	<div class="field">
		<select name="probabilidadeid">
			<option value=""></option>
			<?php foreach ($ProbPerda as $prob): ?>
				<option value="<?php echo $prob['Id'];?>"><?php echo utf8_encode($prob['Descricao'])?></option>
			<?php endforeach;?>
		</select>
	</div>
	&nbsp;&nbsp;&nbsp;&nbsp;
	Posição da Novacap no processo
	<div class="field">
		<input type="radio" name="posicaonovacap" value="1"/>Autora
		<input type="radio" name="posicaonovacap" value="2"/>R&eacute;
	</div>
</div>

<div class="row">
	<div class="label">Observações</div>
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
	&nbsp;&nbsp;
	Data de ajuizamento
	<div class="field">
		<input type="text" value="" name="dtajuizamento" id="dtajuizamento" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly />
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formacaocivel.dtajuizamento,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
		<a onclick="document.getElementById('dtajuizamento').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url();?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
	</div>
	&nbsp;&nbsp;
	Data extinção
	<div class="field">
		<input type="text" value="" name="dtextincao" id="dtextincao" size="11" maxlength="10" onkeyup="Formatadata(this,event)" readonly/>
		<img src="<?php echo base_url(); ?>calendar/calendar.png" onclick="displayCalendar(document.formacaocivel.dtextincao,'dd/mm/yyyy',this)" border="0" style="cursor: pointer; cursor: hand;">
		<a onclick="document.getElementById('dtextincao').value='';" style="cursor:pointer; cursor:hand"><img src="<?php echo base_url();?>/img/famfamfam/icons/application_form_delete.png" border="0"  title="Limpar campo"></a>
	</div>
	&nbsp;&nbsp;
	Sisprot
	<div class="field">
		<input type="text" name="sisprot" id="sisprot" value="" size="8" maxlength="8" onkeypress='return SomenteNumero(event)'/>
	</div>
</div>

<div class="row">
	<div class="label">Caixa número</div>
	<div class="field">
		<input type="text" name="cxnum" id="cxnum" size="3" maxlength="4" value="" onkeypress='return SomenteNumero(event)'/>
	</div>
	&nbsp;&nbsp;
	Palavras chave
	<div class="field">
		<input type="text" name="palavraschave" id="palavraschave" size="60" maxlength="60" value=""/>
	</div>
</div>

<div class="row">
	<div class="label">Processo pai</div>
	<div class="field">
		<input type="text" name="prpai" id="prpai" maxlength="25" size="27" value="" onkeypress='MaskPrJud(this, event); return SomenteNumero(event)'/>
	</div>
</div>
<hr>
<div class="row">
	<input type="submit" value="Salvar" class="botao" style="text-decoration:none; color: green;"/>&nbsp;
	<a href="<?php echo base_url()."cjuridico/index/";?>" style="text-decoration:none;">
		<input type="button" value="Cancelar" onclick="location.href('<?php echo base_url()."cjuridico/index/"?>')" class="botao" style="color: red;"/>
	</a>
</div>
</form>
</fieldset>
</div>
</div>
<?php $this->load->view('view_rodape');?>
