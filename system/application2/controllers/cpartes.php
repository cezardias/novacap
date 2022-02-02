<?php
class Cpartes extends Controller {
	
	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Mjuridico');
		$this->load->model('Mfuncionario');
		$this->load->model('Maudienciacivel');
		$this->load->model('Mpartes');

		//@@ADICIONAR EM TODAS AS P�GINAS PROTEGIDAS
		$this->load->library('security');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Pragma: no-cache");	
	}

	function indexpartes(){
		$grupologsis = $this->session->userdata('grupologsis');
		$login = $this->session->userdata('usuario');
		$senha = $this->session->userdata('usuariops');
		//$data['tipo'] = $this->Mjuridico->;	
		$data['tipo'] = '';
		$this->security->verifiyLogin('view_partes_index.php',$data,$this->router->class,$this->router->method);
	}	
	
	function addpartes(){
		$grupologsis = $this->session->userdata('grupologsis');
		$login = $this->session->userdata('usuario');
		$senha = $this->session->userdata('usuariops');
		//$data['tipo'] = $this->Mjuridico->;	
		$data['tipo'] = '';
		$this->security->verifiyLogin('view_partes_add.php',$data,$this->router->class,$this->router->method);
	}	
	
	
	function createparte(){
		$prjud = $this->input->post('prjud'); if($prjud==""){$prjud=NULL;}else{$prjud = preg_replace("/[^0-9]/", "", $prjud);}
		$pradm = $this->input->post('pradm'); if($pradm==""){$pradm=NULL;}else{$pradm = preg_replace("/[^0-9]/", "", $pradm);}
		$fundlegal = $this->input->post('fundlegal'); if($fundlegal==""){$fundlegal=NULL;}
		$causavalor = $this->input->post('causavalor');
		if($causavalor != ""){
			$causavalor = str_replace(".", "", $causavalor);
			$causavalor = str_replace(",", ".", $causavalor);
			$causavalor = floatval($causavalor);		
		}else{$causavalor=0;}		

		$dtajuizamento = $this->input->post('dtajuizamento');
		if($dtajuizamento!=""){		
			$diadoc = substr($dtajuizamento, 0,2);
			$mesdoc = substr($dtajuizamento, 3,2); 
			$anodoc =  substr($dtajuizamento, 6,4);
			$dtajuizamento = $mesdoc.'-'.$diadoc.'-'.$anodoc;
		}else {$dtajuizamento = NULL;}			
		
		//VERIFICAR ANTES SE J� EST� CADASTARDO.
		$data['processoexiste'] = $this->Macaocivel->getProcessoExsite($prjud);
		foreach ($data['processoexiste'] as $prEx):
			$PrExiste = $prEx->PrExiste;
		endforeach;
		if($PrExiste==0){// n�o cadastrado		
			$data = array(
				'AcaoTipoId' => $tipoacaoid,
				'ProcessoJudicialNumero' => $prjud,

			);
			$this->Mpartes->add_parte($data);
			$data['IdRefReg'] = $this->Mpartes->getRegAtual();
			foreach ($data['IdRefReg'] as $item):
				$computed = $item->computed;
			endforeach;
			$redirecionamento = "/cpartes/detailpartes/".$computed."#tabs-1";
			redirect($redirecionamento);
		}else{ //processo j� cadastrado
			$redirecionamento = "/cpartes/parteexiste/".$PrExiste;
			redirect($redirecionamento);
		}		
	}
	
	function index(){
		$data['inicio'] = 1;
		$data['mensagem'] = '2';
		$this->security->verifiyLogin('view_buscapartes',$data,$this->router->class,$this->router->method);
	}

	function searchCPFCNPJ() {
		$cpfcnpj = $this->uri->segment(3);
		if($query = $this->Mpartes->searchCPFCNPJ($cpfcnpj)){
		 	$data['records'] = $query;
		}
		$data['inicio'] = 0;
		$data['mensagem'] = '2';
		$data['cpfcnpjencontrado'] = $this->uri->segment(3);
		$this->security->verifiyLogin('view_buscapartes',$data,$this->router->class,$this->router->method);
	}
	
	function searchNOME() {
		//$nome = $this->uri->segment(3);
		$data = array();
		$nome = iconv("UTF-8","ISO-8859-1",$this->uri->segment(3));
		function removeacentos($str){
		 	$a = array('�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', '�', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', '?', '?', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', '�', '�', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', '�', '�', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', '�', 'Z', 'z', 'Z', 'z', '�', '�', '?', '�', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?');
		 	$b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
			return str_replace($a, $b, $str);
		}
		$nome = removeacentos($nome);
		if($query = $this->Mpartes->searchNOME($nome)){
		 	$data['records'] = $query;
		}
	
		$data['inicio'] = 0;
		$data['mensagem'] = '2';
		$this->security->verifiyLogin('view_buscapartes',$data,$this->router->class,$this->router->method);
	}	


	function delete(){
		$this->security->verifiyLogin('delete','Maudienciacivel',$this->router->class,$this->router->method);		
	}	

}