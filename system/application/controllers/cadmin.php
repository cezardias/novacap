<?php
class Cadmin extends Controller {

	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Mfuncionario');

		//@@ADICIONAR EM TODAS AS PAGINAS PROTEGIDAS
		$this->load->library('security');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Pragma: no-cache");
	}

	function index(){
		$data['funcionarios'] = $this->Mfuncionario->getFuncionarios();
		$this->security->verifiyLogin('view_admin_index.php',$data,$this->router->class,$this->router->method);
	}
	
	function funcdetalhe(){
		$idFunc = $this->uri->segment(3);
		$data['funcdetalhe'] = $this->Mfuncionario->getFuncDetalhe($idFunc);
		$this->security->verifiyLogin('view_admin_update.php',$data,$this->router->class,$this->router->method);
	}

	function update(){
		$idFunc = $this->input->post('idFunc');
		$Nivel1 = $this->input->post('Nivel1');
		$Nivel2 = $this->input->post('Nivel2');
		$Nivel3 = $this->input->post('Nivel3');
		$Nivel4 = $this->input->post('Nivel4');
		$Nivel5 = $this->input->post('Nivel5');
		$Nivel6 = $this->input->post('Nivel6');
		$Ativo = $this->input->post('Ativo');
		$data = array(
			//Id
			//Matricula
			//Nome
			//Login
			//Admin
			'Nivel1' => $Nivel1,
			'Nivel2' => $Nivel2,
			'Nivel3' => $Nivel3,
			'Nivel4' => $Nivel4,
			'Nivel5' => $Nivel5,
			'Nivel6' => $Nivel6,
			'Ativo' => $Ativo
		);
		$this->Mfuncionario->update_func($data,$idFunc);
		$redirecionamento = "/cadmin";
		redirect($redirecionamento);
	}


}
