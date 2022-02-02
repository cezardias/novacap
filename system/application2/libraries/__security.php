<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Security { //private $ci;    
	public function __construct(){
		$this->CI =& get_instance();	
	}
   
	function verifiyLogin($view,$data,$classe,$metodo){
		$this->CI =& get_instance();
		$this->CI->load->library('session');
		if (($this->CI->session->userdata('usuario')!=NULL)&&($this->CI->session->userdata('autenticado')==TRUE)){
			if($view=='delete'){
				$this->CI->$data->delete_row(); //redirect('/');
			}else{
				$this->CI->load->view($view,$data);
			}		
		}else{
			$this->CI->load->view('view_paginaProtegida');
		}
	}	
	
	function logout(){
		$this->CI->session->sess_destroy();
		redirect(base_url());
	}
    
	function autentication($login,$senha,$nivel,$grupo){
    	if(($login=="")||($senha=="")){
    		$retorno = "vazio";
    	}   	 
    	else{ // Não autorizado.
    		if ($nivel != 0){    			
    			$this->CI->load->library('session');
    			$newdata = array(
					'usuario'	  => $login,
	    			'usuariops'   => $senha,
	    			'acessoNivel' => $nivel,
	    			'grupologsis' => $grupo,
					'autenticado' => TRUE
    			);
    			$this->CI->session->set_userdata($newdata);
    			$retorno = "ok";
    		} 
    		else {
    			if($nivel == 0) $retorno = "acessonot";
    			else $retorno = "erro";
    		}
    	}
    	$this->CI->session->set_userdata('msg', $retorno);
    }
    
}