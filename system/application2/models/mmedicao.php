<?php
class Mmedicao extends Model {

	function add_medicao($data){
		$this->db->insert('Medicoes', $data);
		return;
	}

function update_medicao($medicaoid,$data){
	$this->db->where('Id', $medicaoid);
	$this->db->update('Medicoes', $data);
}

	public function getMedicaoDetail($IdMedic){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select Id,ContratoId,Numero,ProcessoPagamento,convert(varchar, DataLiquidacao, 23) as DataLiquidacao from vw_Medicoes where Id=$IdMedic";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function delete_row(){
		$IdMedic = $this->uri->segment(3);
		$contratoid = $this->uri->segment(4);
		$this->db->where('Id', $IdMedic);
		$this->db->delete('Medicoes');
		$redirecionamento = "/ccontrato/detailcontrato/".$contratoid."#aba02";
		redirect($redirecionamento);
	}

}
