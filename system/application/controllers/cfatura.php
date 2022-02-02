<?php
class Cfatura extends Controller {

	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Mjuridico');
		$this->load->model('Mfinanceiro');
		$this->load->model('Mfuncionario');
		$this->load->model('Mfatura');

		//@@ADICIONAR EM TODAS AS P�GINAS PROTEGIDAS
		$this->load->library('security');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Pragma: no-cache");
	}

	function createfatura(){ // ...cad somente no create
		$contratoid = $this->input->post('contratoid');
		$fatnumcad = $this->input->post('fatnumcad');
		$fatvalorcad = $this->input->post('fatvalorcad');
		if($fatvalorcad != ""){
			$fatvalorcad = str_replace(".", "", $fatvalorcad);
			$fatvalorcad = str_replace(",", ".", $fatvalorcad);
			$fatvalorcad = floatval($fatvalorcad);
		}else{$fatvalorcad=NULL;}
		$fatatestodatacad = $this->input->post('fatatestodatacad');
		if($fatatestodatacad!=""){
			$ano = substr($fatatestodatacad, 0,4);
			$mes = substr($fatatestodatacad, 5,2);
			$dia =  substr($fatatestodatacad, 8,2);
			$fatatestodatacad = $mes.'-'.$dia.'-'.$ano;
		}else {$fatatestodatacad = NULL;}
		$fatglosacad = $this->input->post('fatglosacad');
		if($fatglosacad != ""){
			$fatglosacad = str_replace(".", "", $fatglosacad);
			$fatglosacad = str_replace(",", ".", $fatglosacad);
			$fatglosacad = floatval($fatglosacad);
		}else{$fatglosacad=NULL;}

		$data = array(
			'ContratoId' => $contratoid,
			'Numero' => $fatnumcad,
			'Valor' => $fatvalorcad,
			'AtestoData' => $fatatestodatacad,
			'Glosa' => $fatglosacad
		);
		$this->Mfatura->add_fatura($data);
		$redirecionamento = "/ccontrato/detailcontrato/".$contratoid."#aba03";
		redirect($redirecionamento);
	}

	function savefatura(){ // ...cad somente no create
		$contratoid = $this->input->post('contratoid');
		$faturaid = $this->input->post('faturaid');
		$fatnumcad = $this->input->post('fatnum');
		$fatvalorcad = $this->input->post('fatvalor');
		if($fatvalorcad != ""){
			$fatvalorcad = str_replace(".", "", $fatvalorcad);
			$fatvalorcad = str_replace(",", ".", $fatvalorcad);
			$fatvalorcad = floatval($fatvalorcad);
		}else{$fatvalorcad=NULL;}
		$fatatestodatacad = $this->input->post('fatatestodata');
		if($fatatestodatacad!=""){
			$ano = substr($fatatestodatacad, 0,4);
			$mes = substr($fatatestodatacad, 5,2);
			$dia =  substr($fatatestodatacad, 8,2);
			$fatatestodatacad = $mes.'-'.$dia.'-'.$ano;
		}else {$fatatestodatacad = NULL;}
		$fatglosacad = $this->input->post('fatglosa');
		if($fatglosacad != ""){
			$fatglosacad = str_replace(".", "", $fatglosacad);
			$fatglosacad = str_replace(",", ".", $fatglosacad);
			$fatglosacad = floatval($fatglosacad);
		}else{$fatglosacad=NULL;}

		$data = array(
			'ContratoId' => $contratoid,
			'Numero' => $fatnumcad,
			'Valor' => $fatvalorcad,
			'AtestoData' => $fatatestodatacad,
			'Glosa' => $fatglosacad
		);
		$this->Mfatura->update_fatura($faturaid,$data);
		$redirecionamento = "/ccontrato/detailcontrato/".$contratoid."#aba03";
		redirect($redirecionamento);
	}

	public function getFaturaAjax($IdFat){
	  $data = $this->Mfatura->getFaturaDetail($IdFat);
		echo json_encode($data);
	}

	function delete(){
		$this->security->verifiyLogin('delete','Mfatura',$this->router->class,$this->router->method);
	}

}
