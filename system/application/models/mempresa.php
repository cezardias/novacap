<?php
class Mempresa extends Model {

	function verificagrupo($login,$senha){
		if($login == ""){ $login="NULL"; }
		if($senha == ""){ $senha="NULL"; }
		if(($login=="")||($senha=="")){
			return 9; //se não verificar a senha tamb�m o usu�rio logo somente usando o login.
		}else{
			$this->db->query('SET ANSI_NULLS ON');
	 		$this->db->query('SET ANSI_WARNINGS ON');
			$sql = "exec xpto.dbo.pesquisagruposede '$login','SISJURIDICO'";
			$query = $this->db->query($sql);
			return $query->result();
		}
	}

	function UsuLogSession($usuariolog){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "IF OBJECT_ID('tempdb..#temp') IS NOT NULL DROP TABLE #temp; CREATE TABLE #temp(Id INT, Usuario VARCHAR(50));INSERT INTO #temp (Id, Usuario) VALUES (1,'$usuariolog')";
		$query = $this->db->query($sql);
	}

	public function getFiscal(){
		$this->db->order_by("Nome", "asc");
		$query=$this->db->get('Servidores');
		if($query->num_rows()>0){
			return $query->result_array();
		}
	}

	function search($keyword){
		//$fiscal = iconv("UTF-8","ISO-8859-1",$keyword);
		$sql = "SELECT Id, RazaoSocial, CNPJ FROM Empresas where RazaoSocial like '%$keyword%' and len(Empresas.CNPJ)<>12 order by RazaoSocial asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function addEmpresa($data){
			$this->db->insert('Empresas', $data);
			return;
	}

	function getRegAtual(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "SELECT SCOPE_IDENTITY()";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getEmpresaExiste($cpfcnpj){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from Empresas where Cnpj='$cpfcnpj'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function searchCPFCNPJ($cpfcnpj){
		$sql = "SELECT Id, RazaoSocial, CNPJ FROM Empresas where CNPJ='$cpfcnpj' and len(CNPJ)<>12 Order By RazaoSocial";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function searchPorId($IdEmpresa){
		$sql = "SELECT Id, CNPJ, RazaoSocial from Empresas where Id='$IdEmpresa'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function searchMatricula($matricula){
		$sql = "SELECT Id, Nome, Matricula FROM Servidores where Matricula like '%$matricula%' Order By Matricula asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function searchMatriculaId($Id){
		$sql = "SELECT Id, Nome, Matricula FROM Servidores where Id = '$Id'";
		$query = $this->db->query($sql);
		return $query->result();
	}
/*
	function verificagrupo($login,$senha){
		if($login == ""){ $login="NULL"; }
		if($senha == ""){ $senha="NULL"; }
		if(($login=="")||($senha=="")){
			return 9; //se n�o verificar a senha tamb�m o usu�rio logo somente usando o login.
		}else{
			$this->db->query('SET ANSI_NULLS ON');
	 		$this->db->query('SET ANSI_WARNINGS ON');
	 		//exec retornaNomeUsuario 'joseas'  //Usar essa procedure para achar o Departamento.
			$sql = "exec pesquisagrupo '$login','SISJURIDICO'";
			$query = $this->db->query($sql);
			return $query->result();

		}
	}	*/

	function nomeusuario($login){
		if($login == ""){ $login="NULL"; }
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "
			SELECT displayname FROM OPENROWSET('ADSDSOObject', 'adsdatasource;',
			'SELECT cn, mail, co, distinguishedName, displayName, samAccountname
			FROM ''LDAP://novacap'' where objectClass = ''User'' order by cn')
			where samaccountname = '$login'";
		$query = $this->db->query($sql);
		return $query->result();
	}
}
