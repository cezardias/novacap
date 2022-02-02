<?php
class Mfatura extends Model {

	function add_fatura($data){
		$this->db->insert('Faturas', $data);
		return;
	}

	function update_fatura($faturaid,$data){
		$this->db->where('Id', $faturaid);
		$this->db->update('Faturas', $data);
	}

	public function getFaturaDetail($IdFat){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
			$sql = "Select Id,ContratoId,Numero,Valor,convert(varchar, AtestoData, 23) as DataLiquidacao,Glosa from vw_Faturas where Id=$IdFat";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function delete_row(){
		$IdFat = $this->uri->segment(3);
		$contratoid = $this->uri->segment(4);
		$this->db->where('Id', $IdFat);
		$this->db->delete('Faturas');
		$redirecionamento = "/ccontrato/detailcontrato/".$contratoid."#aba03";
		redirect($redirecionamento);
	}

}
