<?php
class Model_empresa extends Model {

	public function getEmpresa(){
		$this->db->order_by("RazaoSocial", "asc");
		$query=$this->db->get('Empresas');
		if($query->num_rows()>0){
			return $query->result_array();
		}
	}

	// Buscar empresa pelo nome.
	function getEmpresaNome($empresanome){
		$empresa = iconv("UTF-8","ISO-8859-1",$empresanome);
		$sql = "SELECT
			Id, CNPJ, RazaoSocial, Sigla, Logradouro, Bairro, Cidade, UF, Cep, Telefone, Email, Banco, Agencia, Conta, InscricaoEstadual, ContatoNome, ContatoTelefone, ContatoEmail

			-- Id, EmpresaCnpj, EmpresaRazaoSocial, EmpresaLogradouro, EmpresaBairro, EmpresaCidade,
			-- EmpresaUf, EmpresaCep, EmpresaTelefone, EmpresaFax, EmpresaEmail, EmpresaBanco,
			-- EmpresaAgencia, EmpresaConta

			FROM Empresas where RazaoSocial like '%$empresanome%' Order By RazaoSocial";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getEmpresaDetail(){
		$idEmpresa = $this->uri->segment(3);
		$sql = "SELECT
			Id, EmpresaCnpj, EmpresaRazaoSocial, EmpresaLogradouro, EmpresaBairro, EmpresaCidade,
			EmpresaUf, EmpresaCep, EmpresaTelefone, EmpresaFax, EmpresaEmail, EmpresaBanco,
			EmpresaAgencia, EmpresaConta
			FROM Empresas where Id='$idEmpresa'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function search($keyword){
		echo '<b>Nome informado: </b>'.strtoupper($empresa = iconv("UTF-8","ISO-8859-1",$keyword));
		$sql = "SELECT Id, RazaoSocial, CNPJ FROM Empresas where RazaoSocial like '%$empresa%'";
		$query = $this->db->query($sql);
		return $query->result();
	}

}
