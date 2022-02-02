<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta charset="utf-8"/>

<title>Novacap | SisJUR</title>
<meta charset="UTF-8">
<link href="<?php echo base_url()?>css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>css/msg.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>css/table.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>css/estiloGeral.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>css/fonts.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>css/nav-h.css" rel="stylesheet" type="text/css"/>

<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>calendar/dhtmlgoodies_calendar.css" media="screen"/>
<link type="text/css" href="<?php echo base_url()?>tabs/development-bundle/themes/base/jquery.ui.all.css" rel="stylesheet"/>
<link type="text/css" href="<?php echo base_url()?>tabs/demos.css" rel="stylesheet"/>
<script type="text/javascript" src="<?php echo base_url()?>calendar/dhtmlgoodies_calendar.js"></script>

<javascript src="<?=base_url()?>assets/jquery/jquery.js" type="text/javascript"></javascript>

<script src="<?php echo base_url(); ?>js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/abreFecha.js" type="text/javascript"></script>
<SCRIPT type="text/javascript" src="<?php echo base_url(); ?>calendar/dhtmlgoodies_calendar.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>tabs/development-bundle/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>tabs/development-bundle/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>tabs/development-bundle/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>tabs/development-bundle/ui/jquery.ui.tabs.js"></script>

<style type="text/css" media="screen">
*{
	font-family: Helvetica, Arial, "Times New Roman", serif;
}

#container {
	width: 600px;
	margin: auto;
	font-family: helvetica, arial;
}

#pagination table {
	width: 600px;
	margin-bottom: 10px;
}

#pagination td {
	border-right: 1px solid #aaaaaa;
	padding: 1em;
}

#pagination td:last-child {
	border-right: none;
}

#pagination th {
	text-align: left;
	padding-left: 1em;
	background: #cac9c9;
	border-bottom: 1px solid white;
	border-right: 1px solid #aaaaaa;
}

.paginationBlock {
	text-align: center;
}

#pagination a,#pagination strong {
	background: #f0f0f0;
	padding: 4px 7px;
	text-decoration: none;
	border: 1px solid #cac9c9;
	color: #292929;
	font-size: 13px;
}

#pagination strong,#pagination a:hover {
	font-weight: normal;
	background: #e3e3e3;
}
</style>

<!-- LISTBOX -->
<script language="JavaScript">
function move(MenuOrigem, MenuDestino){
    var arrMenuOrigem = new Array();
    var arrMenuDestino = new Array();
    var arrLookup = new Array();
    var i;
    for (i = 0; i < MenuDestino.options.length; i++){
        arrLookup[MenuDestino.options[i].text] = MenuDestino.options[i].value;
        arrMenuDestino[i] = MenuDestino.options[i].text;
    }
    var fLength = 0;
    var tLength = arrMenuDestino.length;
    for(i = 0; i < MenuOrigem.options.length; i++){
        arrLookup[MenuOrigem.options[i].text] = MenuOrigem.options[i].value;
        if (MenuOrigem.options[i].selected && MenuOrigem.options[i].value != ""){
            arrMenuDestino[tLength] = MenuOrigem.options[i].text;
            tLength++;
        }
        else{
            arrMenuOrigem[fLength] = MenuOrigem.options[i].text;
            fLength++;
        }
    }
    arrMenuOrigem.sort();
    arrMenuDestino.sort();
    MenuOrigem.length = 0;
    MenuDestino.length = 0;
    var c;
    for(c = 0; c < arrMenuOrigem.length; c++){
        var no = new Option();
        no.value = arrLookup[arrMenuOrigem[c]];
        no.text = arrMenuOrigem[c];
        MenuOrigem[c] = no;
    }
    for(c = 0; c < arrMenuDestino.length; c++){
        var no = new Option();
        no.value = arrLookup[arrMenuDestino[c]];
        no.text = arrMenuDestino[c];
        MenuDestino[c] = no;
   }
}

function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;
    	if((tecla > 47 && tecla < 58)||(tecla==13)) return true;
    else{
    	if (tecla != 8){
    		return false;
        }else{
        	return true;
        }
    }
}

function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789-';
    var aux = aux2 = '';
    var whichCode =
        e.keyCode ? e.keyCode :
		e.charCode ? e.charCode :
		e.which ? e.which : void 0;

    if (whichCode == 13 || whichCode == 8) return true;
    key = String.fromCharCode(whichCode); // Valor para o c�digo da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inv�lida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}

function excluiracao(IdAcao){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>cjuridico/delete/"+IdAcao;
	} else {
		return false;
	}
}

function MaskPrAdm(campo, e){ //112.000.222/2016
	var kC = (document.all) ? event.keyCode : e.keyCode;
	var data = campo.value;
	if( kC!=8 && kC!=46 ){

		if(data.length==3){
			campo.value = data += '.';
		}
		else if(data.length==7){
			campo.value = data += '.';
		}
		else if(data.length==11){
			campo.value = data += '/';
		}
		else
			campo.value = data;
	}
}

function MaskPrJud(campo, e){ //0000818-14.2015.5.10.0004
	var kC = (document.all) ? event.keyCode : e.keyCode;
	var data = campo.value;
	if( kC!=8 && kC!=46 ){

		if(data.length==7){
			campo.value = data += '-';
		}
		else if(data.length==10){
			campo.value = data += '.';
		}
		else if(data.length==15){
			campo.value = data += '.';
		}
		else if(data.length==17){
			campo.value = data += '.';
		}
		else if(data.length==20){
			campo.value = data += '.';
		}
		else
			campo.value = data;
	}
}

function MaskPrSEI(campo, e){ //00112-00006762/2018-17
	var kC = (document.all) ? event.keyCode : e.keyCode;
	var data = campo.value;
	if( kC!=8 && kC!=46 ){

		if(data.length==5){
			campo.value = data += '-';
		}
		else if(data.length==14){
			campo.value = data += '/';
		}
		else if(data.length==19){
			campo.value = data += '-';
		}
		else if(data.length==21){
			campo.value = data;
		}
	}
}

$(function() {
	$("#tabs").tabs();
});
</script> <!--ABAS-->

<style>
*{ font-family: arial;}
#tabs { border: 0px; }
</style>

<!-- Função para ocultar e mostrar elemento -->
<script type="text/javascript">
window.onload = function(){
    var select = document.getElementById('assuntoid');
    select.onchange = function(){
        if(this.value == 9) //Opção que veio do banco de dados para ativar função desejada.
            document.getElementById('elemento').style.display = "block";
        else
            document.getElementById('elemento').style.display = "none";
    };
};
</script>

<style type="text/css">
#elemento{
	display: none; /* Iniciar div oculta antes da seleção do elemento na cobobox */
}
</style>

<!-- Exibir e ocultar div com botão -->
<style type="text/css" media="screen">
#botaoExibir  {
    width:920px;
    height:30px;
    text-align:center;
    color:#FFFFE0;
    background:url('<?php echo base_url();?>/img/exibirdiv.jpg');
    /* background-color:#104E8B; */
    cursor:pointer;
}
#form-oculto {
    background: none repeat scroll 0 0 #fff;
    border: 2px solid;
    float: left;
    padding: 10px;
    width: 896px;
}
div.active {
    cursor:pointer;
    text-align:center;
    background:url('<?php echo base_url();?>/img/iesconderdiv.jpg');
    width:920px;
    height:30px;
}
</style>

<script>
jQuery(document).ready(
	function(){
		jQuery("#botaoExibir").toggle(
		function(){
			jQuery("div#form-oculto").slideDown(); // slideDown() na div #form-oculto
			jQuery("#botaoExibir").find('div').addClass('active'); // altera para botao esconder
		},
		function(){
			jQuery("div#form-oculto").slideUp(); // slideUp()na div #form-oculto
			jQuery("#botaoExibir").find('div').removeClass('active'); //retorna para botao exibir
		}
	);
});

/* DERRUBA SESSÃO APÓS TEMPO DETERMINADO, TEMPO REINICIA AO ACIONAR O MOUSE */
seg = 0; //variável representando o tempo inativo atual
document.addEventListener("mousemove", function(){ //Adiciona evento a ser disparado sempre que o mouse se mover
	seg = 0; //zera a variável sempre que o mouse for acionado
});
setInterval(function(){ //A cada 1 segundo
seg = seg + 1;
if(seg == 3600) //tempo em segundos.
	window.location = '<?php echo base_url();?>/index.php/usuario/logout';
},1000);
</script>

<style> /* usando para tamanho de botoes */
.btnpequenomin {
	width: 12%;
	font-color: white;
}
.btnpequeno {
	width: 20%;
}
.btnmedio {
	width: 30%;
}
</style>
</head>
<body style="z-index:0;">
<div class="headerFundo"><!-- Fundo azul atrás do cabeçalho -->
	<div class="header">
		<div class='headerLogoNovacap'>
			<div class="home"><!-- Isolar função hover no style.css -->
				<a href="<?php echo base_url();?>" title="In&iacute;cio do sistema" style="text-decoration: none; color: #fff;">
					<span class='siglaSis'>SisJUR</span>
				</a>
			</div>
			<span class='descricaoSis'>
				Sistema de gerenciamento de ações jurídicas
			</span>
		</div>
		<div class='headerLogoNovacap2'>
			<!-- Lebel a esquerda da imagem direita -->
		</div>
	</div>
</div>

<div class="wrapper">
<div class="barraMenu">

<?php
// CONTROLE DE ACESSO AOS MÓDULOS DO SISTEMA.
// DB: Podas - tabela: UsuariosAcesso
$_SESSION['Nome'] = $this->session->userdata('Nome');
$_SESSION['Admin'] = $this->session->userdata('Admin'); //Gerência
$_SESSION['Nivel1'] = $this->session->userdata('Nivel1'); //JURÍDICO - ADMINISTRADOR
$_SESSION['Nivel2'] = $this->session->userdata('Nivel2'); //JURÍDICO - LEITURA
$_SESSION['Nivel3'] = $this->session->userdata('Nivel3'); //CONTRATOS E ATAS - ADMINISTRADOR
$_SESSION['Nivel4'] = $this->session->userdata('Nivel4'); //CONTRATOS E ATAS - LEITURA
$_SESSION['Nivel5'] = $this->session->userdata('Nivel5'); //FINANCEIRO - ADMINISTRADOR
$_SESSION['Nivel6'] = $this->session->userdata('Nivel6'); //FINANCEIRO - LEITURA
if (($this->session->userdata('usuario')!=NULL)&&($this->session->userdata('autenticado')==TRUE)){?>
<ul id="navmenu-h">
	<li>
		<a href="<?php echo base_url();?>" title="In&iacute;cio do sistema">
			<img src="<?php echo base_url();?>img/home.png" alt="Tela inicial" width="15"/>
		</a>
	</li>
	<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel1']==1)||($_SESSION['Nivel2']==1)){ //1 JURÍDICO - ADMINISTRADOR, 2 JURÍDICO - LEITURA?>
    	<li><a href="#">Ações &rsaquo;&rsaquo;</a>
    		<ul>
			<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel1']==1)){ //1 JURÍDICO - ADMINISTRADOR ?>
    			<li><a href="#">Incluir &rsaquo;&rsaquo;</a>
    				<ul>
    					<li><a href="<?php echo base_url();?>cacaocivel/addacaocivel">Ação cível</a></li>
    					<li><a href="<?php echo base_url();?>cjuridico/addacaotrab">Ação trabalhista</a></li>
    				</ul>
				</li>
			<?php } if(($_SESSION['Admin']==1)||($_SESSION['Nivel1']==1)||($_SESSION['Nivel2']==1)){ //1 JURÍDICO - ADMINISTRADOR, 2 JURÍDICO - LEITURA?>
    			<li><a href="#">Pesquisar &rsaquo;&rsaquo;</a>
    				<ul>
    					<li><a href="<?php echo base_url();?>cacaocivel/buscacaocivelindex">Ações cíveis</a></li>
						<li><a href="<?php echo base_url();?>cjuridico/buscacaotrabindex">Ações trabalhistas</a></li>
						<li><a href="<?php echo base_url();?>cjuridico/buscaudienciaindex">Audiências</a></li>
    					<li><a href="<?php echo base_url();?>cjuridico/buscaprazoindex">Prazos</a></li>						
    				</ul>
    			</li>
    			<li><a href="#">Relatório &rsaquo;&rsaquo;</a>
    				<ul>
    					<li><a href="<?php echo base_url();?>cjuridico/buscauditoriaindex">Auditoria</a></li>
    					<li><a href="<?php echo base_url();?>cjuridico/relatorioprovisaocontabil">Provisão Contábil </a></li>
    				</ul>
				</li>
			<?php } ?>
    		</ul>
    	</li>
    <?php } if(($_SESSION['Admin']==1)||($_SESSION['Nivel3']==1)||($_SESSION['Nivel4']==1)){ // 3 CONTRATOS E ATAS - ADMINISTRADOR, 4 CONTRATOS E ATAS - LEITURA?>
		<li>
			<a href="#">Atas &rsaquo;&rsaquo;</a>
    	<ul>
    		<li><a href="<?php echo base_url();?>catas/atasindex">Atas</a></li>
			<?php if(($_SESSION['Admin']==1)||($_SESSION['Nivel3']==1)){ // 3 CONTRATOS E ATAS - ADMINISTRADOR?>
				<!-- <li><a href="<?php echo base_url();?>buscaempresa/empresaadd">Cadastrar empresa</a></li> -->
				<li><a href="">Cadastrar empresa</a></li>
			<?php }	?>
    	</ul>
   	</li>
	<?php }	if(($_SESSION['Admin']==1)||($_SESSION['Nivel5']==1)||($_SESSION['Nivel6']==1)){ // 5 FINANCEIRO - ADMINISTRADOR, 6 FINANCEIRO - LEITURA?>
		<li>
			<a href="#">Financeiro &rsaquo;&rsaquo;</a>
    	<ul>
    		<li><a href="<?php echo base_url();?>cfinanceiro/financeiroindex">Ações</a></li>
    		<!-- <li><a href="<?php echo base_url();?>ccontrato/contratoindex">Contratos</a></li> -->
    	</ul>
	   </li>
	<?php } if($_SESSION['Admin']==1){ ?>
		<li><a href="<?php echo base_url();?>cadmin">Admin</a></li>
	<?php } ?>
	<li><a href="<?php echo base_url();?>sobre">Sobre</a></li>
</ul>
<div style='width:100%;text-align:right;padding-top:8px;font-size: 11px;'>
	<?php $usuarioAutenticado = $_SESSION['Nome'];
	echo $usuarioAutenticado." | <b><a title='Sair com seguran&ccedil;a' href='".base_url()."index.php/usuario/logout' style='text-decoration: none;'> <img src='../../../../../../sisprot/img/icons/logout.png'/></a></b>&nbsp;&nbsp;";?>
</div>
<?php }
?>
</div>
<?php if(!empty($prazosacoesqtd)&&(sizeof($prazosacoesqtd)>0)){
foreach ($prazosacoesqtd as $qtd):
	$Qtd = $qtd->Qtd;
endforeach;
if($Qtd>0){?>
<div class="status_box warning">
	Existem <b><?php echo $Qtd?></b> ações com prazos vencidos ou a 07(sete) dias do vencimento.
	<a href="<?php echo base_url();?>cjuridico/prazosacoesdetail"><font color="blue">Visualizar</font></a>
</div>
<?php }}?>