<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Security { 
	
	//private $ci;    
	public function __construct(){
		$this->CI =& get_instance();
		//$this->CI->load->model('Model_auxcidades');
		//$this->CI->load->model('Model_usuario');
	
		$usuarioAutenticado = $this->CI->session->userdata('usuario');
		$usuarioAutenticadoPs = $this->CI->session->userdata('usuariops');
		//$nomeUsuarioAutenticado = $this->CI->session->userdata('nomeusuario');
		$acessoNivel = $this->CI->session->userdata('acessoNivel');
	
		$sql33 = "DECLARE @Ctx varbinary(128)
		SELECT @Ctx = CONVERT(varbinary(128), '$usuarioAutenticado')
		SET CONTEXT_INFO @Ctx";
		$query = $this->CI->db->query($sql33);
	}	
	
	function autentication($login,$senha,$grupo,$ldap_host,$ldap_host1,$ldap_host2){ //AUTENTICAR
		$access = '';
		$retorno = '';
    	$ldap_dn = "DC=novacap,DC=sede"; // active directory DN (base location of ldap search)
		$ldap_user_group = $grupo; // active directory user group name
		$ldap_manager_group = $grupo; // active directory manager group name
		$ldap_usr_dom = '@novacap.sede'; // domain, for purposes of constructing $login
		$ldap = ldap_connect($ldap_host); // NSV22
		$ldap1 = ldap_connect($ldap_host1); // NSV23
		$ldap2 = ldap_connect($ldap_host2); // NSV201
		
		ldap_set_option($ldap,LDAP_OPT_PROTOCOL_VERSION,3); // configure ldap params
		ldap_set_option($ldap,LDAP_OPT_REFERRALS,0);

		ldap_set_option($ldap1,LDAP_OPT_PROTOCOL_VERSION,3); // configure ldap params
		ldap_set_option($ldap1,LDAP_OPT_REFERRALS,0);

		$this->CI->load->library('session');			
		if($bind = @ldap_bind($ldap, $login.$ldap_usr_dom, $senha)){ // Verifica NSV22
			$filter = "(sAMAccountName=".$login.")";
			$attr = array("memberof");
			$result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
			$entries = ldap_get_entries($ldap, $result);
			ldap_unbind($ldap);			
			foreach($entries[0]['memberof'] as $grps){
				if(strpos($grps, $ldap_manager_group)){
					$access = 2;
					break;					
				}else if(strpos($grps, $ldap_user_group)){
					$access = 1;
					break;
				}else{
					$access = 0;
					$retorno = "acessonot";
				}
			}	 
    		if($access != 0){
    			$this->CI->load->library('session');
    			$newdata = array(
					'usuario'	  => $login,
	    			'usuariops'   => $senha,
	    			'acessoNivel' => $access,
	    			'grupologsis' => $grupo,
					'autenticado' => TRUE
    			);
    			$this->CI->session->set_userdata($newdata);
    			$retorno = "ok";
    		}
		}
		if($bind = @ldap_bind($ldap1, $login.$ldap_usr_dom, $senha)){ // Verifica NSV22
			$filter = "(sAMAccountName=".$login.")";
			$attr = array("memberof");
			$result = ldap_search($ldap1, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
			$entries = ldap_get_entries($ldap1, $result);
			ldap_unbind($ldap1);			
			foreach($entries[0]['memberof'] as $grps){
				if(strpos($grps, $ldap_manager_group)){
					$access = 2;
					break;					
				}else if(strpos($grps, $ldap_user_group)){
					$access = 1;
					break;
				}else{
					$access = 0;
					$retorno = "acessonot";
				}
			}	 
    		if($access != 0){
    			$this->CI->load->library('session');
    			$newdata = array(
					'usuario'	  => $login,
	    			'usuariops'   => $senha,
	    			'acessoNivel' => $access,
	    			'grupologsis' => $grupo,
					'autenticado' => TRUE
    			);
    			$this->CI->session->set_userdata($newdata);
    			$retorno = "ok";
    		}
		}
		if($bind = @ldap_bind($ldap2, $login.$ldap_usr_dom, $senha)){ // Verifica NSV201
			$filter = "(sAMAccountName=".$login.")";
			$attr = array("memberof");
			$result = ldap_search($ldap2, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
			$entries = ldap_get_entries($ldap2, $result);
			ldap_unbind($ldap2);			
			foreach($entries[0]['memberof'] as $grps){
				if(strpos($grps, $ldap_manager_group)){
					$access = 2;
					break;					
				}else if(strpos($grps, $ldap_user_group)){
					$access = 1;
					break;
				}else{
					$access = 0;
					$retorno = "acessonot";
				}
			}	 
    		if($access != 0){
    			$this->CI->load->library('session');
    			$newdata = array(
					'usuario'	  => $login,
	    			'usuariops'   => $senha,
	    			'acessoNivel' => $access,
	    			'grupologsis' => $grupo,
					'autenticado' => TRUE
    			);
    			$this->CI->session->set_userdata($newdata);
    			$retorno = "ok";
    		}
		}		
		else{
    		if($access == 0) $retorno = "acessonot";
    		else $retorno = "erro";
    	}
   		$this->CI->session->set_userdata('msg', $retorno);
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
    
}