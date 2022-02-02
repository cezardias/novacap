<?php
class Mfuncionario extends Model {

	function verificagrupo($login,$senha){
		if($login == ""){ $login="NULL"; }
		if($senha == ""){ $senha="NULL"; }
		if(($login=="")||($senha=="")){
			return 9; //se não verificar a senha também o usuário logo somente usando o login.
		}else{
			$this->db->query('SET ANSI_NULLS ON');
	 		$this->db->query('SET ANSI_WARNINGS ON');
			//$sql = "exec xpto.dbo.pesquisagruposede '$login','SISJURIDICO'";
			$sql = "exec pesquisagrupo2 '$login','SISJURIDICO'";
			$query = $this->db->query($sql);
			return $query->result();
		}
	}
	
	function getFuncionarios(){				
		$sql = "Select Id,Matricula,UPPER(Nome) as Nome,lower(Login) as Login,Admin,Nivel1,Nivel2,Nivel3,Nivel4,Nivel5,Nivel6,Ativo from UsuariosAcesso order by Ativo DESC, admin desc, Nome asc";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getFuncDetalhe($idFunc){
		$sql = "Select * from UsuariosAcesso where Id=$idFunc";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function update_func($data,$idFunc){
		$this->db->where('Id', $idFunc);
		$this->db->update('UsuariosAcesso', $data);
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
		$sql = "SELECT Id, Nome, CPFCNPJ FROM Partes where Nome like '%$keyword%' and len(Partes.CPFCNPJ)<>12 order by Nome asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function searchCPFCNPJ($cpfcnpj){
		//$sql = "SELECT Id, Nome, CPFCNPJ FROM Partes where CPFCNPJ like '%$cpfcnpj%' and len(Partes.CPFCNPJ)<>12 Order By Nome asc";
		$sql = "SELECT Id, RazaoSocial as Nome, CNPJ as CPFCNPJ FROM Empresas where CNPJ='$cpfcnpj' and len(CNPJ)<>12 Order By Nome";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function searchPorId($IdServidor){
		$sql = "SELECT Id, Nome, CPFCNPJ FROM Partes where Id = '$IdServidor' and len(Partes.CPFCNPJ)<>12";
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
	
	function getAcessoUsuario($login){
	    $this->db->query('SET ANSI_NULLS ON');
	    $this->db->query('SET ANSI_WARNINGS ON');
	    $sql = "Select * from UsuariosAcesso where Login='$login' and Ativo=1";
	    $query = $this->db->query($sql);
	    return $query->result();
	}

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
