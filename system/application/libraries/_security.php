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
   
   function verifiyLogin($view,$data,$classe,$metodo){
   	$this->CI =& get_instance();
	$this->CI->load->library('session');

	if (($this->CI->session->userdata('usuario')!=NULL)&&($this->CI->session->userdata('autenticado')==TRUE)){
		//VERIFICA GRUPO DO USUARIO utilizando o grupo da sessão
		//VALIDA PERMISSOES utilizando grupo, classe e metodo if não tem permissão retorna uma view_paginaSempermissao
		if($view=='delete'){
			//$view neste caso é o parâmetro view
			//$data neste caso é o parâmetro model 
			$this->CI->$data->delete_row();
			//redirect('/');
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
    	$this->CI =& get_instance();
    	if (($connect = @ldap_connect("ns07"))){
    	}else{
    		echo "Erro conexão serviço de diretório<hr>";
    	}
    	if(($login=="")||($senha=="")||($nivel==9)){
    		$retorno = "vazio";
    	}   	 
    	else{ // Acesso Autorizado.
    		$login = "novacap\\".$login;
    		if (($bind = @ldap_bind($connect, $login, $senha))&&($nivel!=0)) {    			
    			$this->CI->load->library('session');
    			$usuarioAutenticado = str_replace('novacap\\', '', $login);
    			$usuarioAutenticadoPs = $senha;
    			$acessoNivel = $nivel;
    			//@@CARREGA QUAL O GRUPO O USUARIO PERTENCE NO BANCO... select * from grupos...
    			//EXECUTA PROCEDURE E RETORNA SE TEM ACESSO OU NÃO
    				
    			// grupo a ser usado SGPOUser

    			//$this->CI->Model_usuario->contextInfo($usuarioAutenticado);
    				
    			$newdata = array(
					'usuario'	=> $usuarioAutenticado,
	    			'usuariops' => $usuarioAutenticadoPs,
	    			'acessoNivel' => $acessoNivel,
	    			'grupologsis' => $grupo,
	    			//'nomeusuario' => $nomeUsuarioAutenticado,
	    			
	    			//SET CONTEXT_INFO @Ctx
	    			//@@'grupo'	=> 'administrador', if retorno vazio atribui = semacesso (autenticado, mas sem acesso ao sistema)
	    			//PROCEDURE RETORNA O NOME DO GRUPO
					'autenticado'	=> TRUE
    			);
    			$this->CI->session->set_userdata($newdata);
    			$retorno = "ok";
    		}else {
    			if($nivel==0) $retorno = "acessonot"; //Usuário fora do Grupo de Permissão.
    			else $retorno = "erro";
    		}
    	}
    	$this->CI->session->set_userdata('msg', $retorno);
    	//return $retorno;
    }
    
}