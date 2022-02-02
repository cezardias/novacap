<?php
class Usuario extends Controller {
	
	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->library('security');
		$this->load->model('Mfuncionario');
		$this->load->model('Mjuridico');
	}

	function index(){
		redirect(base_url());
	}
	
	function verificanomeusuario(){
		$login = $this->input->post('login');
		$data = $this->Mfuncionario->nomeusuario($login);
		return $data;
	}

	function login(){
		$Id = '';
		$Matricula = '';
		$Nome = '';
		$Login = '';
		$Admin = '';
		$Nivel1 = '';
		$Nivel2 = '';
		$Nivel3 = '';
		$Nivel4 = '';
		$Nivel5 = '';
		$Nivel6 = '';
		$Ativo = '';
		$login = $this->input->post('login');
		$senha = $this->input->post('senha');
		$ldap_host = 'NSV22'; // LDAP SERVER	
		$ldap_host1 = 'NSV23'; // LDAP SERVER	
		$ldap_host2 = 'NSV201'; // LDAP SERVER	
		$grupo = 'SISJURIDICO';
		$paginaatual = $this->input->post('paginaatual');
		$data['retorno'] = $this->security->autentication($login,$senha,$grupo,$ldap_host,$ldap_host1,$ldap_host2);
		if($paginaatual!=''){
			$data['nivelacesso'] = $this->Mfuncionario->getAcessoUsuario($login);
			foreach($data['nivelacesso'] as $uso){
				$Id = $uso->Id;
				$Matricula = $uso->Matricula;
				$Nome = $uso->Nome;
				$Login = $uso->Login;
				$Admin = $uso->Admin;
				$Nivel1 = $uso->Nivel1;
				$Nivel2 = $uso->Nivel2;
				$Nivel3 = $uso->Nivel3;
				$Nivel4 = $uso->Nivel4;
				$Nivel5 = $uso->Nivel5;
				$Nivel6 = $uso->Nivel6;
				$Ativo = $uso->Ativo;
			}
			if($Ativo==1){
				$newdata = array(
					'Id' => $Id,
					'Matricula' => $Matricula,
					'Nome' => $Nome,
					'Login' => $Login,
					'Admin' => $Admin,
					'Nivel1' => $Nivel1, //JURÍDICO - ADMINISTRADOR
					'Nivel2' => $Nivel2, //JURÍDICO - LEITURA
					'Nivel3' => $Nivel3, //CONTRATOS E ATAS - ADMINISTRADOR
					'Nivel4' => $Nivel4, //CONTRATOS E ATAS - LEITURA
					'Nivel5' => $Nivel5, //FINANCEIRO - ADMINISTRADOR
					'Nivel6' => $Nivel6, //FINANCEIRO - LEITURA
					'Ativo' => $Ativo
				);
			}else{
				$newdata = array(
					'Id' => $Id,
					'Matricula' => $Matricula,
					'Nome' => $Nome,
					'Login' => $Login,
					'Admin' => 0,
					'Nivel1' => 0,
					'Nivel2' => 0,
					'Nivel3' => 0,
					'Nivel4' => 0,
					'Nivel5' => 0,
					'Nivel6' => 0,
					'Ativo' => 0
				);				
			}
			$this->session->set_userdata($newdata);	
			redirect($paginaatual);
		}else{
			$this->load->view('view_usuarioLogin',$data);
		}		
	}
	
	function logout(){
		//$data['geralog'] = $this->Mfuncionario->UsuLogSessionDestroi(); //Deletar tabela #Temp
		$this->session->unset_userdata('advogadoid');
		$this->session->unset_userdata('advogadonivel');		
		$this->security->logout();
	}
}