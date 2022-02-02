<?php
class Mandamentocivel extends Model {

	function delete_row(){
		$IdAcao = $this->uri->segment(3);
		$IdRegAnd = $this->uri->segment(4);				
		$this->db->where('Id', $IdRegAnd);
		$this->db->delete('Andamentos');
		$redirecionamento = "cacaocivel/detailacaocivel/".$IdAcao."#tabs-5";
		redirect($redirecionamento);
	}
		
}