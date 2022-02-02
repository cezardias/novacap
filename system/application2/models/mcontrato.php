<?php
class Mcontrato extends Model {

	function update_contrato($contratoid,$data){
		$this->db->where('Id', $contratoid);
		$this->db->update('Contratos', $data);
	}

	function addEmpresa($data){
		$this->db->insert('Empresas', $data);
		return;
	}

	function update_empresa($data,$empresaid){
		$this->db->where('Id', $empresaid);
		$this->db->update('Empresas', $data);
	}

	function getRegAtual(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "SELECT SCOPE_IDENTITY()";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getEmpresa($empresaId){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from vw_empresas where Id=$empresaId";
		$query = $this->db->query($sql);
		return $query->row();
	}

}
