<?php
class Csolicitaproc extends Controller {
	
	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Mjuridico');
		$this->load->model('Mfuncionario');
		$this->load->model('Msolicitaproc');

		//@@ADICIONAR EM TODAS AS PÁGINAS PROTEGIDAS
		$this->load->library('security');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Pragma: no-cache");	
	}

	function index(){
		$usuariolog = $this->session->userdata('usuario');
		$data['prexiste'] = 'Inicio'; //Tela inicial do sistema.
		$this->security->verifiyLogin('view_solicita_proc_index.php',$data,$this->router->class,$this->router->method);
	}	
	
	function buscaproc(){
		$usuariolog = $this->session->userdata('usuario');
		$proc = $this->input->post('proc');
		if($proc==""){$proc='NULL';}else{$proc = preg_replace("/[^0-9]/", "", $proc);}
		$data['procexiste'] = $this->Msolicitaproc->getProcessoExiste($proc);
		foreach ($data['procexiste'] as $prexist):
			$res = $prexist->EncontraProc;
		endforeach;
		if($res==1){
			$data['procdetailsol'] = NULL;
			$IdAcao = 'NULL';		
			$data['prdetail'] = $this->Msolicitaproc->getProcDetail($proc);
			$this->security->verifiyLogin('view_solicita_proc_detail.php',$data,$this->router->class,$this->router->method);
		}else{
			$data['prexiste'] = 'Nao'; //Se prequisa não encontrar nada.
			$this->security->verifiyLogin('view_solicita_proc_index.php',$data,$this->router->class,$this->router->method);
		}
	}
		
	function delete(){
		$this->security->verifiyLogin('delete','Msolicitaproc',$this->router->class,$this->router->method);		
	}	

}