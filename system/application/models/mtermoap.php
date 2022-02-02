<?php
class Mtermoap extends Model{

	function getTermoDetail($IdTermo){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from vw_TermosDeApostilamento where Id=$IdTermo";
		$query = $this->db->query($sql);
		return $query->result();	
	}
	
	function add_record_termo($data){
		$this->db->insert('TermosDeApostilamento', $data);
		return;
	}
	
	function update_termoap($data,$termoid){
		$this->db->where('Id', $termoid);
		$this->db->update('TermosDeApostilamento', $data);	
	}
	
	function delete_row(){
		$IdContrato = $this->uri->segment(3);
		$IdTermo = $this->uri->segment(4);
		$this->db->where('Id', $IdTermo);
		$this->db->delete('TermosDeApostilamento');		
		$redirecionamento = "/caditivo/detailcontrato/".$IdContrato."#tabs-3";
		redirect($redirecionamento);
	}
		
}