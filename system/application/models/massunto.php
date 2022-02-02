<?php
class Massunto extends Model {

	function delete_row(){
		$IdAcao = $this->uri->segment(3);
		$IdRegAss = $this->uri->segment(4);				
		$this->db->where('Id', $IdRegAss);
		$this->db->delete('AcoesAssunto');		
		$redirecionamento = "cjuridico/detailacaotrab/".$IdAcao."#tabs-3";
		redirect($redirecionamento);
	}
		
}