<?php
class Cnotaempenho extends Controller {

	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Mjuridico');
		$this->load->model('Mfinanceiro');
		$this->load->model('Mfuncionario');
		$this->load->model('Mnotaempenho');

		//@@ADICIONAR EM TODAS AS P�GINAS PROTEGIDAS
		$this->load->library('security');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Pragma: no-cache");
	}

	function createnotaemp(){ // ...cad somente no create
		$contratoid = $this->input->post('contratoid');
		$nenumcad = $this->input->post('nenumcad');
		$nedataemissaocad = $this->input->post('nedataemissaocad');
		if($nedataemissaocad!=""){
			$ano = substr($nedataemissaocad, 0,4);
			$mes = substr($nedataemissaocad, 5,2);
			$dia =  substr($nedataemissaocad, 8,2);
			$nedataemissaocad = $mes.'-'.$dia.'-'.$ano;
		}else {$nedataemissaocad = NULL;}
		$nevalorcad = $this->input->post('nevalorcad');
		if($nevalorcad != ""){
			$nevalorcad = str_replace(".", "", $nevalorcad);
			$nevalorcad = str_replace(",", ".", $nevalorcad);
			$nevalorcad = floatval($nevalorcad);
		}else{$nevalorcad=NULL;}
		$nevaloranuladocad = $this->input->post('nevaloranuladocad');
		if($nevaloranuladocad != ""){
			$nevaloranuladocad = str_replace(".", "", $nevaloranuladocad);
			$nevaloranuladocad = str_replace(",", ".", $nevaloranuladocad);
			$nevaloranuladocad = floatval($nevaloranuladocad);
		}else{$nevaloranuladocad=NULL;}
		$data = array(
			'ContratoId' => $contratoid,
			'Numero' => $nenumcad,
			'EmissaoData' => $nedataemissaocad,
			'Valor' => $nevalorcad,
			'ValorAnulado' => $nevaloranuladocad
		);
		$this->Mnotaempenho->add_notaempenho($data);
		$redirecionamento = "/ccontrato/detailcontrato/".$contratoid."#aba04";
		redirect($redirecionamento);
	}

	function savenotaemp(){ // ...cad somente no create
		$notaempid = $this->input->post('notaempid');
		$contratoid = $this->input->post('contratoid');
		$nenumcad = $this->input->post('nenum');
		$nedataemissaocad = $this->input->post('nedataemissao');
		if($nedataemissaocad!=""){
			$ano = substr($nedataemissaocad, 0,4);
			$mes = substr($nedataemissaocad, 5,2);
			$dia =  substr($nedataemissaocad, 8,2);
			$nedataemissaocad = $mes.'-'.$dia.'-'.$ano;
		}else {$nedataemissaocad = NULL;}
		$nevalorcad = $this->input->post('nevalor');
		if($nevalorcad != ""){
			$nevalorcad = str_replace(".", "", $nevalorcad);
			$nevalorcad = str_replace(",", ".", $nevalorcad);
			$nevalorcad = floatval($nevalorcad);
		}else{$nevalorcad=NULL;}
		$nevaloranuladocad = $this->input->post('nevaloranulado');
		if($nevaloranuladocad != ""){
			$nevaloranuladocad = str_replace(".", "", $nevaloranuladocad);
			$nevaloranuladocad = str_replace(",", ".", $nevaloranuladocad);
			$nevaloranuladocad = floatval($nevaloranuladocad);
		}else{$nevaloranuladocad=NULL;}
		$data = array(
			'ContratoId' => $contratoid,
			'Numero' => $nenumcad,
			'EmissaoData' => $nedataemissaocad,
			'Valor' => $nevalorcad,
			'ValorAnulado' => $nevaloranuladocad
		);
		$this->Mnotaempenho->update_notaempenho($notaempid,$data);
		$redirecionamento = "/ccontrato/detailcontrato/".$contratoid."#aba04";
		redirect($redirecionamento);
	}

	public function getNotaEmpAjax($IdNotaEmp){
	  $data = $this->Mnotaempenho->getFaturaDetail($IdNotaEmp);
		echo json_encode($data);
	}

	function delete(){
		$this->security->verifiyLogin('delete','Mnotaempenho',$this->router->class,$this->router->method);
	}

}
