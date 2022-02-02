<?php
header('Content-type: application/pdf');
require_once("fpdf.php");
session_start();
$_SESSION['usulog'] = utf8_decode('Login impressão: '.strtolower($this->session->userdata('usuario')));
$_SESSION['filtro'] = ($this->session->userdata('filtro'));

class Fpdf_Table_Horizontal_Audiencia extends FPDF{
	var $left = 10;
	var $right = 10;
	var $top = 10;
	var $bottom = 10;

	function Header(){
		$this->Image('img/novacapLogo.jpg',10,5,55);
		$this->SetFont('Courier','B',8);
		$this->Text(125,8,'GOVERNO DO DISTRITO FEDERAL');
		$this->Text(110,13,utf8_decode('SECRETARIA DE INFRAESTRUTURA E SERVIÇOS PÚBLICOS'));
		$this->Text(110,18,'COMPANHIA URBANIZADORA DA NOVA CAPITAL DO BRASIL');
		$this->Text(115,23,utf8_decode('ASSESSORIA JURÍDICA - RELATÓRIO DE AUDITORIA'));
      $this->ln(15);
		// $this->SetFont('Courier','B',7);
		// $this->SetFillColor(211,211,211);
		// $this->SetXY(10,27);
		// $this->MultiCell(170,5,utf8_decode($_SESSION['filtro']),1,'J',1,0);

		// $this->SetXY(180,27);
		// $this->MultiCell(96,5,'VALORES',1,'C',1,0);

		// $this->SetXY(276,27);
		// $this->MultiCell(11,10,'STATUS',1,'C',1,0);

		// $this->SetXY(10,27);
		// $this->MultiCell(50,10,utf8_decode("AUTOR / RÉU"),1,'C',1,0);
		// $this->SetXY(60,27);
		// $this->MultiCell(35,10,"PROC. JUDICIAL",1,'C',1,0);
		// $this->SetXY(95,27);
		// $this->MultiCell(23,10,"PROC. ADMIN.",1,'C',1,0);
		// $this->SetXY(118,27);
		// $this->MultiCell(45,10,"ASSUNTO",1,'C',1,0);
		// $this->SetXY(163,27);
		// $this->MultiCell(17,10,"PROB PERDA",1,'C',1,0);
		// $this->SetXY(180,32);
		// $this->MultiCell(24,5,"CAUSA",1,'C',1,0);
		// $this->SetXY(204,32)	;
		// $this->MultiCell(24,5,utf8_decode("SENTENÇA"),1,'C',1,0);
		// $this->SetXY(228,32);
		// $this->MultiCell(24,5,utf8_decode("ACORDÃO"),1,'C',1,0);
		// $this->SetXY(252,32);
		// $this->MultiCell(24,5,utf8_decode("CONDENAÇÃO"),1,'C',1,0);
	}

	function Footer(){
		$this->SetY(-15);
		$this->SetFont('Courier','',8);
		$data=date("d/m/Y H:i");
		$this->SetLineWidth(0.4);
		$this->Cell(277,0,'','T',0,'C');
		$this->Ln(2);
		$this->Cell(90,0,$data,0,0,'L');
		$this->Cell(97,0,$_SESSION['usulog'],0,0,'C');
		$this->Cell(90,0,utf8_decode('Página: ').$this->PageNo().'/{nb}',0,0,'R');
	}

   // Create Table
   function WriteTable($tcolums){
      // go through all colums
      for ($i = 0; $i < sizeof($tcolums); $i++){
         $current_col = $tcolums[$i];
         $height = 0;

         // get max height of current col
         $nb=0;
         for($b = 0; $b < sizeof($current_col); $b++){
            // set style
            $this->SetFont($current_col[$b]['font_name'], $current_col[$b]['font_style'], $current_col[$b]['font_size']);
            $color = explode(",", $current_col[$b]['fillcolor']);
            $this->SetFillColor($color[0], $color[1], $color[2]);
            $color = explode(",", $current_col[$b]['textcolor']);
            $this->SetTextColor($color[0], $color[1], $color[2]);
            $color = explode(",", $current_col[$b]['drawcolor']);
            $this->SetDrawColor($color[0], $color[1], $color[2]);
            $this->SetLineWidth($current_col[$b]['linewidth']);

            $nb = max($nb, $this->NbLines($current_col[$b]['width'], $current_col[$b]['text']));
            $height = $current_col[$b]['height'];
         }
         $h=$height*$nb;

         // Issue a page break first if needed
         $this->CheckPageBreak($h);

         // Draw the cells of the row
         for($b = 0; $b < sizeof($current_col); $b++){
            $w = $current_col[$b]['width'];
            $a = $current_col[$b]['align'];

            // Save the current position
            $x=$this->GetX();
            $y=$this->GetY();

            // set style
            $this->SetFont($current_col[$b]['font_name'], $current_col[$b]['font_style'], $current_col[$b]['font_size']);
            $color = explode(",", $current_col[$b]['fillcolor']);
            $this->SetFillColor($color[0], $color[1], $color[2]);
            $color = explode(",", $current_col[$b]['textcolor']);
            $this->SetTextColor($color[0], $color[1], $color[2]);
            $color = explode(",", $current_col[$b]['drawcolor']);
            $this->SetDrawColor($color[0], $color[1], $color[2]);
            $this->SetLineWidth($current_col[$b]['linewidth']);

            $color = explode(",", $current_col[$b]['fillcolor']);
            $this->SetDrawColor($color[0], $color[1], $color[2]);


            // Draw Cell Background
            $this->Rect($x, $y, $w, $h, 'FD');

            $color = explode(",", $current_col[$b]['drawcolor']);
            $this->SetDrawColor($color[0], $color[1], $color[2]);

            // Draw Cell Border
            if (substr_count($current_col[$b]['linearea'], "T") > 0)
            {
               $this->Line($x, $y, $x+$w, $y);
            }

            if (substr_count($current_col[$b]['linearea'], "B") > 0)
            {
               $this->Line($x, $y+$h, $x+$w, $y+$h);
            }

            if (substr_count($current_col[$b]['linearea'], "L") > 0)
            {
               $this->Line($x, $y, $x, $y+$h);
            }

            if (substr_count($current_col[$b]['linearea'], "R") > 0)
            {
               $this->Line($x+$w, $y, $x+$w, $y+$h);
            }


            // Print the text
            $this->MultiCell($w, $current_col[$b]['height'], $current_col[$b]['text'], 0, $a, 0);

            // Put the position to the right of the cell
            $this->SetXY($x+$w, $y);
         }

         // Go to the next line
         $this->Ln($h);
      }
   }


   // If the height h would cause an overflow, add a new page immediately
   function CheckPageBreak($h)
   {
      if($this->GetY()+$h>$this->PageBreakTrigger)
         $this->AddPage($this->CurOrientation);
   }


   // Computes the number of lines a MultiCell of width w will take
   function NbLines($w, $txt)
   {
      $cw=&$this->CurrentFont['cw'];
      if($w==0)
         $w=$this->w-$this->rMargin-$this->x;
      $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
      $s=str_replace("\r", '', $txt);
      $nb=strlen($s);
      if($nb>0 and $s[$nb-1]=="\n")
         $nb--;
      $sep=-1;
      $i=0;
      $j=0;
      $l=0;
      $nl=1;
      while($i<$nb)
      {
         $c=$s[$i];
         if($c=="\n")
         {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
         }
         if($c==' ')
            $sep=$i;
         $l+=$cw[$c];
         if($l>$wmax)
         {
            if($sep==-1)
            {
               if($i==$j)
                  $i++;
            }
            else
               $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
         }
         else
            $i++;
      }
      return $nl;
   }
}
