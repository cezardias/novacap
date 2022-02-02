<?php
class Clancamentos extends Controller {

	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Mjuridico');
		$this->load->model('Mfuncionario');
		$this->load->model('Mfatura');
		$this->load->model('Mlancamentos');

		//@@ADICIONAR EM TODA PAG PROTEGIDA
		$this->load->library('security');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Pragma: no-cache");
	}

	function delete(){
		$this->security->verifiyLogin('delete','Mlancamentos',$this->router->class,$this->router->method);
	}

}
