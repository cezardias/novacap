<?php
class Mlancamentos extends Model {

	function delete_row(){
		$contratoid = $this->uri->segment(3);
		$lancamentoid = $this->uri->segment(4);
		$this->db->where('Id', $lancamentoid);
		$this->db->delete('Lancamentos');
		$redirecionamento = "/ccontrato/detailcontrato/".$contratoid."#abaLanc";
		redirect($redirecionamento);
	}

}
