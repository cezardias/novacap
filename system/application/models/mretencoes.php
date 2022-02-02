<?php
class Mretencoes extends Model {

	function getAuxRetencoes(){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select Id, Descricao from AuxRetencoes ORDER BY Descricao";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function add_retencao($data){
		$this->db->insert('Retencoes', $data);
		return;
	}

	function update_retencao($retencaoid,$data){
		$this->db->where('Id', $retencaoid);
		$this->db->update('Retencoes', $data);
	}

	function add_lancamento($data){
		$this->db->insert('Lancamentos', $data);
		return;
	}

function update_lancamento($lancamentoid,$data){
	$this->db->where('Id', $lancamentoid);
	$this->db->update('Lancamentos', $data);
}

	function getRetencoes($IdFatura){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from vw_Retencoes where FaturaId=$IdFatura";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getDetailRetencao($IdRetencao){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from vw_Retencoes where Id=$IdRetencao";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function delete_row(){
		$contratoid = $this->uri->segment(3);
		$faturaid = $this->uri->segment(4);
		$retencaoid = $this->uri->segment(5);
		$this->db->where('Id', $retencaoid);
		$this->db->delete('Retencoes');
		$redirecionamento = "/cretencoes/faturaretencoes/".$contratoid."/".$faturaid;;
		redirect($redirecionamento);
	}

}
