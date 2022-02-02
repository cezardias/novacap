<?php
class Matasloteitem extends Model {
	    
	function delete_row(){
	    $IdAta = $this->uri->segment(3);
	    $IdLote = $this->uri->segment(4);
	    $IdItem = $this->uri->segment(5);
	    $this->db->where('Id', $IdItem);
		$this->db->delete('LoteDetalhe');
		$redirecionamento = "/catas/atalotedetail/".$IdAta."/".$IdLote."#tab02";
		redirect($redirecionamento);
	}
		
}