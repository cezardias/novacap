<?php
class Cretencoes extends Controller {

	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Mjuridico');
		$this->load->model('Mfuncionario');
		$this->load->model('Mfatura');
		$this->load->model('Mretencoes');

		//@@ADICIONAR EM TODA PAG PROTEGIDA
		$this->load->library('security');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Pragma: no-cache");
	}

	function faturaretencoes(){
	    $IdContrato = $this->uri->segment(3);
			$IdFatura = $this->uri->segment(4);
	    $data['contratodetail'] = $this->Mjuridico->getContratoDetail($IdContrato);
	    $data['faturadetail'] = $this->Mjuridico->getDetailFatura($IdFatura);
			$data['auxretencoes'] = $this->Mretencoes->getAuxRetencoes();
			$data['retencoes'] = $this->Mretencoes->getRetencoes($IdFatura);
	    $this->security->verifiyLogin('view_financ_contr_fat_retencoes.php',$data,$this->router->class,$this->router->method);
	}

	function faturaretencoesedit(){
	    $IdContrato = $this->uri->segment(3);
			$IdFatura = $this->uri->segment(4);
			$IdRetencao = $this->uri->segment(5);
	    $data['contratodetail'] = $this->Mjuridico->getContratoDetail($IdContrato);
	    $data['faturadetail'] = $this->Mjuridico->getDetailFatura($IdFatura);
			$data['auxretencoes'] = $this->Mretencoes->getAuxRetencoes();
			$data['retencaodetail'] = $this->Mretencoes->getDetailRetencao($IdRetencao);
	    $this->security->verifiyLogin('view_financ_contr_fat_retencoes_edit.php',$data,$this->router->class,$this->router->method);
	}

	function createretencao(){
		$contratoid = $this->input->post('contratoid');
		$faturaid = $this->input->post('faturaid');
		$auxretencaoid = $this->input->post('auxretencaoid');
		$percentual = $this->input->post('percentual');
		$valor = $this->input->post('valor');
		if($valor != ""){
			$valor = str_replace(".", "", $valor);
			$valor = str_replace(",", ".", $valor);
			$valor = floatval($valor);
		}else{$valor=NULL;}
		$obnumero = $this->input->post('obnumero');
		$dataret = $this->input->post('dataret');
		if($dataret!=""){
			$ano = substr($dataret, 0,4);
			$mes = substr($dataret, 5,2);
			$dia =  substr($dataret, 8,2);
			$dataret = $mes.'-'.$dia.'-'.$ano;
		}else {$dataret = NULL;}

		$data = array(
			'ContratoId' => $contratoid,
			'FaturaId' => $faturaid,
			'RetencaoId' => $auxretencaoid,
			'Percentual' => $percentual,
			'Valor' => $valor,
			'OrdemBancariaNumero' => $obnumero,
			'OrdemBancariaEmissaoData' => $dataret
		);
		$this->Mretencoes->add_retencao($data);
		$redirecionamento = "/cretencoes/faturaretencoes/".$contratoid."/".$faturaid;
		redirect($redirecionamento);
	}

	function saveretencao(){
		$contratoid = $this->input->post('contratoid');
		$faturaid = $this->input->post('faturaid');
		$retencaoid = $this->input->post('retencaoid');
		$auxretencaoid = $this->input->post('auxretencaoid');
		$percentual = $this->input->post('percentual');
		$percentual = floatval($percentual);
		$valor = $this->input->post('valor');
		if($valor != ""){
			$valor = str_replace(".", "", $valor);
			$valor = str_replace(",", ".", $valor);
			$valor = floatval($valor);
		}else{$valor=NULL;}
		$obnumero = $this->input->post('obnumero');
		$dataret = $this->input->post('dataret');
		if($dataret!=""){
			$ano = substr($dataret, 0,4);
			$mes = substr($dataret, 5,2);
			$dia =  substr($dataret, 8,2);
			$dataret = $mes.'-'.$dia.'-'.$ano;
		}else {$dataret = NULL;}

		$data = array(
			'RetencaoId' => $auxretencaoid,
			'Percentual' => $percentual,
			'Valor' => $valor,
			'OrdemBancariaNumero' => $obnumero,
			'OrdemBancariaEmissaoData' => $dataret
		);
		$this->Mretencoes->update_retencao($retencaoid,$data);
		$redirecionamento = "/cretencoes/faturaretencoes/".$contratoid."/".$faturaid;
		redirect($redirecionamento);
	}

	function creactelancamentos(){
		$contratoid = $this->input->post('contratoid');
		$medicaoid = $this->input->post('medicaoid');
		$notaempid = $this->input->post('notaempid');
		$faturaid = $this->input->post('faturaid');
		$ordembancid = $this->input->post('ordembancid');
		$data = array(
			'ContratoId' => $contratoid,
			'MedicaoId' => $medicaoid,
			'NotaDeEmpenhoId' => $notaempid,
			'FaturaId' => $faturaid,
			'OrdemBancariaId' => $ordembancid
		);
		$this->Mretencoes->add_lancamento($data);
		$redirecionamento = "/ccontrato/detailcontrato/".$contratoid."#abaLanc";
		redirect($redirecionamento);
	}

	function savelancamentos(){
		$contratoid = $this->input->post('contratoid');
		$lancamentoid = $this->input->post('lancamentoid');
		$medicaoid = $this->input->post('medicaoid');
		$notaempid = $this->input->post('notaempid');
		$faturaid = $this->input->post('faturaid');
		$ordembancid = $this->input->post('ordembancid');
		$data = array(
			'ContratoId' => $contratoid,
			'MedicaoId' => $medicaoid,
			'NotaDeEmpenhoId' => $notaempid,
			'FaturaId' => $faturaid,
			'OrdemBancariaId' => $ordembancid
		);
		$this->Mretencoes->update_lancamento($lancamentoid,$data);
		$redirecionamento = "/ccontrato/detailcontrato/".$contratoid."#abaLanc";
		redirect($redirecionamento);
	}

	public function getFaturaAjax($IdFat){
	  $data = $this->Mfatura->getFaturaDetail($IdFat);
		echo json_encode($data);
	}

	function delete(){
		$this->security->verifiyLogin('delete','Mretencoes',$this->router->class,$this->router->method);
	}

}
