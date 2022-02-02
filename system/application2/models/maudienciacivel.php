<?php
class Maudienciacivel extends Model {

	function delete_row(){
		$IdAcao = $this->uri->segment(3);
		$IdRegAud = $this->uri->segment(4);				
		$this->db->where('Id', $IdRegAud);
		$this->db->delete('Audiencias');
		$redirecionamento = "cacaocivel/detailacaocivel/".$IdAcao."#tabs-4";
		redirect($redirecionamento);
	}
		
}