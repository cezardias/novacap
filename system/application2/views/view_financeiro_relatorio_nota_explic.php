<?php
//header('Content-type: application/pdf');
$this->load->library('Fpdf_Table_nota_explic_vert.php');
$pdf = new Fpdf_Table_nota_explic_vert('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();

//print_r($resultnotaexplic);
if($resultnotaexplic!=NULL):
	$pdf->SetFont('Arial','',7);
	//pdf->Ln();
	foreach ($resultnotaexplic as $nota):
		$Assunto = $nota->Assunto;
		$Sentenca = $nota->Sentenca;
			if($Sentenca != ""){$Sentenca = number_format($Sentenca, 2, ',', '.');}else{$Sentenca="0,00";}
		$Condenacao = $nota->Condenacao;
			if($Condenacao != ""){$Condenacao = number_format($Condenacao, 2, ',', '.');}else{$Condenacao="0,00";}
		$Acordao = $nota->Acordao;
			if($Acordao != ""){$Acordao = number_format($Acordao, 2, ',', '.');}else{$Acordao="0,00";}
		$Quantidade = $nota->Quantidade;if($Quantidade==""){$Quantidade="-";}
		if($Assunto != 'TOTAL'){
			$titulo = array();
			$col = array();
			$col[] = array('text' => $Assunto, 'width' => '103', 'height' => '5', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
			$col[] = array('text' => $Sentenca, 'width' => '24', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
			$col[] = array('text' => $Condenacao, 'width' => '24', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
			$col[] = array('text' => $Acordao, 'width' => '24', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
			$col[] = array('text' => $Quantidade, 'width' => '15', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'T');
			$titulo[] = $col;
			$pdf->WriteTable($titulo);
		}else if($Assunto == 'TOTAL'){
			$titulo = array();
			$col = array();
			$col[] = array('text' => 'TOTAL', 'width' => '103', 'height' => '5', 'align' => 'J', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '211,211,211', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
			$col[] = array('text' => $Sentenca, 'width' => '24', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '211,211,211', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
			$col[] = array('text' => $Condenacao, 'width' => '24', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '211,211,211', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
			$col[] = array('text' => $Acordao, 'width' => '24', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '211,211,211', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
			$col[] = array('text' => $Quantidade, 'width' => '15', 'height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => 'B', 'fillcolor' => '211,211,211', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'BT');
			$titulo[] = $col;
			$pdf->WriteTable($titulo);
		}
	endforeach;
	//$pdf->Output("relatorio.pdf","I");
	$pdf->Output("relatorio.pdf","D");
else:?>
<?php $this->load->view('view_cabecalho');?>
	<h2>Relat�rio - Horas Extras</h2>
	<div class="status_box warning">
	<h6>Aten��o</h6>
		<ul>
			<li>Nenhum registro encontrado!</li>
		</ul>
	</div>
	<br>
<?php
	$this->load->view('view_rodape');
endif;

?>
