<?php
class Mprazocivel extends Model {

	function delete_row(){
		$IdAcao = $this->uri->segment(3);
		$IdRegPrazo = $this->uri->segment(4);				
		$this->db->where('Id', $IdRegPrazo);
		$this->db->delete('Prazos');
		$redirecionamento = "cacaocivel/detailacaocivel/".$IdAcao."#tabs-6";
		redirect($redirecionamento);
	}
		
}