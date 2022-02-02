<?php
class Ctermoap extends Controller {
	
	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Mjuridico');
		$this->load->model('Mtermoap');
		$this->load->model('Mfuncionario');

		//@@ADICIONAR EM TODAS AS P�GINAS PROTEGIDAS
		$this->load->library('security');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Pragma: no-cache");	
	}
	
	function detailtermoap(){
		$IdContrato = $this->uri->segment(3);
		$IdTermo = $this->uri->segment(4);
		$data['contratodetail'] = $this->Mjuridico->getContratoDetail($IdContrato);
		$data['termodetail'] = $this->Mtermoap->getTermoDetail($IdTermo);
		$data['AuxTATipo'] = $this->Mjuridico->getAuxTATipo();
		$data['AuxTADenominacao'] = $this->Mjuridico->getAuxTADenominacao();
		$data['contratoid'] = $IdContrato;
		$this->security->verifiyLogin('view_termoap_detail.php',$data,$this->router->class,$this->router->method);
	}
	
	function termoedit(){
		$IdContrato = $this->uri->segment(3);
		$IdTermo = $this->uri->segment(4);
		$data['contratodetail'] = $this->Mjuridico->getContratoDetail($IdContrato);
		$data['termodetail'] = $this->Mtermoap->getTermoDetail($IdTermo);
		$data['AuxTATipo'] = $this->Mjuridico->getAuxTATipo();
		$data['AuxTADenominacao'] = $this->Mjuridico->getAuxTADenominacao();
		$data['contratoid'] = $IdContrato;
		$this->security->verifiyLogin('view_termoap_edit.php',$data,$this->router->class,$this->router->method);
	}

	function createtermoap(){
		$contratoid = $this->input->post('contratoid');
		$termodenominacaoid = $this->input->post('termodenominacaoid');
		$termotipoid = $this->input->post('termotipoid');
		$prsei = $this->input->post('prsei');if($prsei==""){$prsei='NULL';} else{$prsei = preg_replace("/[^0-9]/", "", $prsei);}//Somente numeros
		$termoval = $this->input->post('termoval');
		if($termoval != ""){
			$termoval = str_replace(".", "", $termoval);
			$termoval = str_replace(",", ".", $termoval);
			$termoval = floatval($termoval);		
		}else{$termoval=0;}			
		$termopercent = $this->input->post('termopercent');
		$motiva = $this->input->post('motiva'); //if($motiva!=""){$motiva = utf8_decode($motiva);}
		$termobs = $this->input->post('termobs'); //if($termobs!=""){$termobs = utf8_decode($termobs);}
		
		$data = array(
			'DenominacaoId' => $termodenominacaoid,
			'TipoId' => $termotipoid,
			'SEI' => $prsei,
			'Valor' => $termoval,
			'Percentual' => $termopercent,
			'Motivacao' => $motiva,
			'Observacoes' => $termobs,
			'ContratoId' => $contratoid
		);
		$this->Mtermoap->add_record_termo($data);
		$redirecionamento = "/caditivo/detailcontrato/".$contratoid."#tabs-3";		
		redirect($redirecionamento);	
	}	
		
	function savetermoap(){
		$termoid = $this->input->post('termoid');
		$contratoid = $this->input->post('contratoid');
		$termodenominacaoid = $this->input->post('termodenominacaoid');
		$termotipoid = $this->input->post('termotipoid');
		$prsei = $this->input->post('prsei'); if($prsei==""){$prsei='NULL';} else{$prsei = preg_replace("/[^0-9]/", "", $prsei);}//Somente numeros
		$termoval = $this->input->post('termoval');
		if($termoval != ""){
			$termoval = str_replace(".", "", $termoval);
			$termoval = str_replace(",", ".", $termoval);
			$termoval = floatval($termoval);		
		}else{$termoval=0;}			
		$termopercent = $this->input->post('termopercent'); if($termopercent==""){$termopercent=0;}	
		$motiva = $this->input->post('motiva'); //if($motiva!=""){$motiva = utf8_decode($motiva);}
		$termobs = $this->input->post('termobs'); if($termobs==""){$termobs = "NULL";}		
		
		$data = array(
			'DenominacaoId' => $termodenominacaoid,
			'TipoId' => $termotipoid,
			'SEI' => $prsei,
			'Valor' => $termoval,
			'Percentual' => $termopercent,
			'Motivacao' => $motiva,
			'Observacoes' => $termobs,
			//'ContratoId' => $contratoid
		);
		$this->Mtermoap->update_termoap($data,$termoid);
		$redirecionamento = "/ctermoap/detailtermoap/".$contratoid."/".$termoid."#tabs-3";		
		redirect($redirecionamento);	
	}	
	
	function delete(){
		$this->security->verifiyLogin('delete','Mtermoap',$this->router->class,$this->router->method);		
	}	

}