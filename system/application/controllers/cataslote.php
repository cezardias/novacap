<?php
class Cataslote extends Controller {

	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Mjuridico');
		$this->load->model('Mfinanceiro');
		$this->load->model('Mfuncionario');
		$this->load->model('Mataslote');
		$this->load->model('Matas');

		//@@ADICIONAR EM TODAS AS PÁGINAS PROTEGIDAS
		$this->load->library('security');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Pragma: no-cache");
	}

	function atalotecreate(){ // Criar LOTE
	    $ataid = $this->input->post('ataid');
	    $atalotenr = $this->input->post('atalotenr'); if($atalotenr==""){$atalotenr='NULL';}
	    $atalotedesc = $this->input->post('atalotedesc'); if($atalotedesc==""){$atalotedesc='NULL';}
	    $ataloteidempresa = $this->input->post('empresaid'); if($ataloteidempresa==""){$ataloteidempresa='NULL';}
	    $ataloteidrepresentante = $this->input->post('ataloterepresentante'); if($ataloteidrepresentante==""){$ataloteidrepresentante=0;}

	    $data = array(
	        'AtaId' => $ataid,
	        'LoteNumero' => $atalotenr,
	        'Descricao' => $atalotedesc,
	        'EmpresaId' => $ataloteidempresa,
			'EmpresaRepresentante' => $ataloteidrepresentante
	    );
	    $this->Mataslote->addAtasLote($data);
	    $redirecionamento = "/catas/atadetail/".$ataid."#02lotes";
	    redirect($redirecionamento);
	}

	function atalotesave(){ //Salvar LOTE
	    $IdLote = $this->input->post('idlote');
	    $IdAta = $this->input->post('idata');
	    $atalotenr = $this->input->post('atalotenr'); if($atalotenr==""){$atalotenr='NULL';}
	    $atalotedesc = $this->input->post('atalotedesc'); if($atalotedesc==""){$atalotedesc='NULL';}
	    $ataloteidempresa = $this->input->post('ataloteidempresa'); if($ataloteidempresa==""){$ataloteidempresa='NULL';}
	    $ataloteidrepresentante = $this->input->post('ataloterepresentante'); if($ataloteidrepresentante==""){$ataloteidrepresentante='NULL';}

	    $data = array(
	        'LoteNumero' => $atalotenr,
	        'Descricao' => $atalotedesc,
	        'EmpresaId' => $ataloteidempresa,
					'EmpresaRepresentante' => $ataloteidrepresentante
	        //'RepresentanteId' => $ataloteidrepresentante
	    );
	    $this->Mataslote->UpDateAtasLote($data,$IdLote);
	    $redirecionamento = "/catas/atadetail/".$IdAta."#02lotes";
	    redirect($redirecionamento);
	}

	function ataloteitemcreate(){ // Criar ITEM do LOTE
	    $idata = $this->input->post('idata');
	    $idlote = $this->input->post('idlote');
	    $itemlote = $this->input->post('itemlote'); if($itemlote==""){$itemlote='NULL';}
	    $itemloteqtd = $this->input->post('itemloteqtd'); if($itemloteqtd==""){$itemloteqtd='NULL';}
	    $itemloteunid = $this->input->post('itemloteunid'); if($itemloteunid==""){$itemloteunid='NULL';}
	    $itemlotevalorunit = $this->input->post('itemlotevalorunit');
	    if($itemlotevalorunit != ""){
	        $itemlotevalorunit = str_replace(".", "", $itemlotevalorunit);
	        $itemlotevalorunit = str_replace(",", ".", $itemlotevalorunit);
	        $itemlotevalorunit = floatval($itemlotevalorunit);
	    }else{$itemlotevalorunit=NULL;}
	    $itemlotedesc = $this->input->post('itemlotedesc'); if($itemlotedesc==""){$itemlotedesc='NULL';}

	    $data = array(
	        'LoteId' => $idlote,
	        'Item' => $itemlote,
	        'Descricao' => $itemlotedesc,
	        'Quantidade' => $itemloteqtd,
	        'Unidade' => $itemloteunid,
	        'ValorUnitario' => $itemlotevalorunit
	    );
	    $this->Mataslote->addAtasItemLote($data);
	    $redirecionamento = "/catas/atalotedetail/".$idata."/".$idlote;
	    redirect($redirecionamento);
	}

	function atalotedit(){
	    $IdAta = $this->uri->segment(3);
	    $IdLote = $this->uri->segment(4);
	    $data['atalotedetail'] = $this->Matas->getAtaLoteDetail($IdLote);
	    $data['ataloteitemdetail'] = $this->Matas->getAtaLoteItemDetail($IdLote);
	    $data['atadetail'] = $this->Matas->getAtaDetail($IdAta);
	    $data['atalotes'] = $this->Matas->getAtaLotes($IdAta);
	    $data['auxempresa'] = $this->Matas->getEmpresas();
	    $data['auxrepresentante'] = $this->Matas->getRepresentantes();
	    $this->security->verifiyLogin('view_atas_lote_edit.php',$data,$this->router->class,$this->router->method);
	}

	function ataloteitemedit(){
	    $IdAta = $this->uri->segment(3);
	    $IdLote = $this->uri->segment(4);
	    $IdItem = $this->uri->segment(5);
	    $data['atadetail'] = $this->Matas->getAtaDetail($IdAta);
	    $data['atalotes'] = $this->Matas->getAtaLotes($IdAta);
	    $data['atalotedetail'] = $this->Matas->getAtaLoteDetail($IdLote);
		$data['ataloteitemdetail'] = $this->Matas->getAtaLoteItemDetail($IdLote);
		$data['ataloteitemunicodetail'] = $this->Matas->getAtaLoteItemUnicoDetail($IdItem);
	    $this->security->verifiyLogin('view_atas_lote_item_edit.php',$data,$this->router->class,$this->router->method);
	}

	function ataloteitemsave(){ //Salvar ITEM do LOTE
	    $IdLoteItem = $this->input->post('idloteitem');
	    $IdAta = $this->input->post('idata');
	    $IdLote = $this->input->post('idlote');
	    $itemlote = $this->input->post('itemlote'); if($itemlote==""){$itemlote='NULL';}
	    $itemloteqtd = $this->input->post('itemloteqtd'); if($itemloteqtd==""){$itemloteqtd='NULL';}
	    $itemloteunid = $this->input->post('itemloteunid'); if($itemloteunid==""){$itemloteunid='NULL';}
	    $itemlotevalorunit = $this->input->post('itemlotevalorunit'); if($itemlotevalorunit==""){$itemlotevalorunit='NULL';}
	    if($itemlotevalorunit != ""){
	        $itemlotevalorunit = str_replace(".", "", $itemlotevalorunit);
	        $itemlotevalorunit = str_replace(",", ".", $itemlotevalorunit);
	        $itemlotevalorunit = floatval($itemlotevalorunit);
	    }else{$itemlotevalorunit=NULL;}
	    $itemlotedesc = $this->input->post('itemlotedesc'); if($itemlotedesc==""){$itemlotedesc='NULL';}

	    $data = array(
	        'LoteId' => $IdLote,
	        'Item' => $itemlote,
	        'Descricao' => $itemlotedesc,
	        'Quantidade' => $itemloteqtd,
	        'Unidade' => $itemloteunid,
	        'ValorUnitario' => $itemlotevalorunit
	    );
	    $this->Mataslote->UpDateAtasLoteItem($data,$IdLoteItem);
	    $redirecionamento = "/catas/atalotedetail/".$IdAta."/".$IdLote;
	    redirect($redirecionamento);
	}

	function delete(){
		$this->security->verifiyLogin('delete','Mataslote',$this->router->class,$this->router->method);
	}

}
