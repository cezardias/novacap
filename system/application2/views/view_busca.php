<?php $this->load->view('view_cabecalho');?>

<script language="javascript">
		function excluir(id) {
			var confirma = confirm("Deseja realmente excluir este registro?")
			if (confirma){
				window.location = "<?php echo base_url(); ?>processo/delete/"+id;
			} else {
				return false;
			}
		}
</script>

<script type="text/javascript">
$(document).ready(function(){
    //hide the all of the element with class msg_body
    $(".toggleobras").hide();
    //toggle the componenet with class msg_body
	$(".msg_head").click(function() {
		$(this).next(".toggleobras").slideToggle(100);
		$(this).toggleClass('msg_head_expanded');
	});
});
</script>
<style type="text/css">
.toggleobras {
	padding: 0px 0px 0px;
	background-color: #fff;
}

.msg_head {
	padding: 5px 10px;
	cursor: pointer;
	position: relative;
	background: #ffffff
		url('<?php echo base_url(); ?>img/bullet_toggle_plus.gif') no-repeat 0;
	margin: 1px;
}

.msg_head_expanded {
	background: #ffffff
		url('<?php echo base_url(); ?>img/bullet_toggle_minus.gif') no-repeat
		0;
}
</style>
<link
	rel="stylesheet" href='<?php echo base_url(); ?>css/main.css'
	type="text/css" media="screen, projection" />
</head>

<body>
<h2>Levantamento Comparativo:</h2>

<?php
if(!empty($folhas)&&(sizeof($folhas)>1)){ ?>

<table class="data_grid" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th width=5%>Rubrica</th>
			<th width=30%>Descrição</th>
			<th width=10% style='text-align:right;'>Qtd.</th>
			<th width=10% style='text-align:right;'><?php echo $MesAno1;?></th>
			<th width=10% style='text-align:right;'>Qtd.</th>
			<th width=10% style='text-align:right;'><?php echo $MesAno2;?></th>
			<th width=10% style='text-align:right;'>Dif. Qtd</th>
			<th width=10% style='text-align:right;'>Dif. Vlr</th>
			<th width=5% style='text-align:center;'>Detail</th>
		</tr>
	</thead>
	<tfoot>
	</tfoot>
	<tbody>

	<?php foreach($folhas as $item):
		$rubrica   = $item->rubrica; 
		$descricao = $item->descricao;
		$mes1qtd   = $item->mes1qtd;
		$mes01     = number_format($item->mes1vlr, 2, ',', '.');
		$mes2qtd   = $item->mes2qtd;
		$mes02     = number_format($item->mes2vlr, 2, ',', '.');
		$difqtd    = $item->difqtd;
		$difvlr    = number_format($item->difvlr, 2, ',', '.');
	?>

	<tr style="border: 0;">
		<td colspan="9" style="border: 0; background-color: #fff; margin: 0px; padding: 0px; border: 0px;">
		<?php if($rubrica!='9999'){?>
		<table style="margin: 0px; padding: 0px; border: 0px;" width="100%">
			<tr>
				<td width=5%><?php echo $rubrica;?></td>
				<td width=30%><?php echo $descricao;?></td>
				<td width=10% style='text-align:right;'><?php echo $mes1qtd;?></td>
				<td width=10% style='text-align:right;'><?php echo $mes01;?></td>
				<td width=10% style='text-align:right;'><?php echo $mes2qtd;?></td>
				<td width=10% style='text-align:right;'><?php echo $mes02;?></td>
				<td width=10% style='text-align:right;'><?php echo $difqtd;?></td>
				<td width=10% style='text-align:right;'><?php echo $difvlr;?></td>	
				<td width=5% style='text-align:center;'>
					<a href="<?php 
						$descricao = preg_replace("/[^a-zA-Z\s]/", "", $descricao);
						echo base_url(); ?>crhaudit/detail/<?php echo $rubrica;?>/<?php echo $MesAno1;?>/<?php echo $MesAno2;?>/<?php echo $descricao;?>" target="_blank" title="Mostrar servidores" >
						<img src="<?php echo base_url();?>img/icons/application_cascade.png"/>
					</a>
				</td>
			</tr>
		</table>	
		<?php } 
		else if($rubrica=='9999'){?>
		<table style="margin: 0px; padding: 0px; border: 0px;" width="100%">
			<tr>
				<td width=35%>TOTAL</td>
				<td width=20% style='text-align:right;'><?php echo $mes01;?></td>
				<td width=20% style='text-align:right;'><?php echo $mes02;?></td>
				<td width=20% style='text-align:right;'><?php echo $difvlr;?></td>
				<td width=5% style='text-align:right;'></td>
			</tr>					
		</table>		
		<?php }?>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
<a href="<?php echo base_url()."crhaudit/relatorio/".$MesAno1."/".$MesAno2;?>" target="_blank"><input type="button" value="Gerar Relatório" onclick="location.href('<?php echo base_url()."crhaudit/relatorio/".$MesAno1."/".$MesAno2;?>')" class="botao"></a>
<br>
<?php } else { ?>

<div class="status_box warning">
	<h6>Aviso!</h6>
	<ul>
		<li>Nenhum registro retornado</li>
	</ul>
</div>
<?php } ?>
<br>

<?php $this->load->view('view_rodape');?>