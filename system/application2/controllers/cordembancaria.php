<?php
class Cordembancaria extends Controller {

	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Mjuridico');
		$this->load->model('Mfinanceiro');
		$this->load->model('Mfuncionario');
		$this->load->model('Mordembancaria');

		//@@ADICIONAR EM TODAS AS P�GINAS PROTEGIDAS
		$this->load->library('security');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Pragma: no-cache");
	}

	function createordembanc(){ // ...cad somente no create
		$contratoid = $this->input->post('contratoid');
		$obnumcad = $this->input->post('obnumcad');
		$obdataemissaocad = $this->input->post('obdataemissaocad');
		if($obdataemissaocad!=""){
			$ano = substr($obdataemissaocad, 0,4);
			$mes = substr($obdataemissaocad, 5,2);
			$dia =  substr($obdataemissaocad, 8,2);
			$obdataemissaocad = $mes.'-'.$dia.'-'.$ano;
		}else {$obdataemissaocad = NULL;}
		$obvalorcad = $this->input->post('obvalorcad');
		if($obvalorcad != ""){
			$obvalorcad = str_replace(".", "", $obvalorcad);
			$obvalorcad = str_replace(",", ".", $obvalorcad);
			$obvalorcad = floatval($obvalorcad);
		}else{$obvalorcad=NULL;}
		$data = array(
			'ContratoId' => $contratoid,
			'Numero' => $obnumcad,
			'EmissaoData' => $obdataemissaocad,
			'Valor' => $obvalorcad
		);
		$this->Mordembancaria->add_ordembancaria($data);
		$redirecionamento = "/ccontrato/detailcontrato/".$contratoid."#aba05";
		redirect($redirecionamento);
	}

	function saveordembanc(){ // ...cad somente no create
		$ordembancid = $this->input->post('ordembancid');
		$contratoid = $this->input->post('contratoid');
		$obnumcad = $this->input->post('obnum');
		$obdataemissaocad = $this->input->post('obdataemissao');
		if($obdataemissaocad!=""){
			$ano = substr($obdataemissaocad, 0,4);
			$mes = substr($obdataemissaocad, 5,2);
			$dia =  substr($obdataemissaocad, 8,2);
			$obdataemissaocad = $mes.'-'.$dia.'-'.$ano;
		}else {$obdataemissaocad = NULL;}
		$obvalorcad = $this->input->post('obvalor');
		if($obvalorcad != ""){
			$obvalorcad = str_replace(".", "", $obvalorcad);
			$obvalorcad = str_replace(",", ".", $obvalorcad);
			$obvalorcad = floatval($obvalorcad);
		}else{$obvalorcad=NULL;}
		$data = array(
			'ContratoId' => $contratoid,
			'Numero' => $obnumcad,
			'EmissaoData' => $obdataemissaocad,
			'Valor' => $obvalorcad
		);
		$this->Mordembancaria->update_ordembancaria($ordembancid,$data);
		$redirecionamento = "/ccontrato/detailcontrato/".$contratoid."#aba05";
		redirect($redirecionamento);
	}

	public function getOrdemBancAjax($IdOrdemB){
	  $data = $this->Mordembancaria->getOrdemBancDetail($IdOrdemB);
		echo json_encode($data);
	}

	function delete(){
		$this->security->verifiyLogin('delete','Mordembancaria',$this->router->class,$this->router->method);
	}

}
