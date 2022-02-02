<?php
class Mordembancaria extends Model {

	function add_ordembancaria($data){
		$this->db->insert('OrdensBancarias', $data);
		return;
	}

	function update_ordembancaria($ordembancid,$data){
		$this->db->where('Id', $ordembancid);
		$this->db->update('OrdensBancarias', $data);
	}

	public function getOrdemBancDetail($IdOrdemB){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
			$sql = "Select Id,ContratoId,Numero,convert(varchar, EmissaoData, 23) as EmissaoData,Valor from vw_OrdensBancarias where Id=$IdOrdemB";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function delete_row(){
		$IdOrdemB = $this->uri->segment(3);
		$contratoid = $this->uri->segment(4);
		$this->db->where('Id', $IdOrdemB);
		$this->db->delete('OrdensBancarias');
		$redirecionamento = "/ccontrato/detailcontrato/".$contratoid."#aba05";
		redirect($redirecionamento);
	}

}
