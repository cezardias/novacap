<?php
class Cprazo extends Controller {
	
	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Mjuridico');
		$this->load->model('Mfuncionario');
		$this->load->model('Mprazo');

		//@@ADICIONAR EM TODAS AS P?GINAS PROTEGIDAS
		$this->load->library('security');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Pragma: no-cache");	
	}

	function delete(){
		$this->security->verifiyLogin('delete','Mprazo',$this->router->class,$this->router->method);		
	}	

}