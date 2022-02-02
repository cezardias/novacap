<?php
class Mataslote extends Model {
	
    function addAtasLote($data){
        $this->db->insert('Lotes', $data);
        return;
    }    
    
    function addAtasItemLote($data){
        $this->db->insert('LoteDetalhe', $data);
        return;
    } 
    
    function  UpDateAtasLote($data,$IdLote){
        $this->db->where('Id', $IdLote);
        $this->db->update('Lotes', $data);
    }
    
    function UpDateAtasLoteItem($data,$IdLoteItem){
        $this->db->where('Id', $IdLoteItem);
        $this->db->update('LoteDetalhe', $data);
    }
    
    
	function delete_row(){
	    $IdAta = $this->uri->segment(3);
	    $IdLote = $this->uri->segment(4);
	    $this->db->where('Id', $IdLote);
		$this->db->delete('Lotes');
		$redirecionamento = "/catas/atadetail/".$IdAta."#tab02";
		redirect($redirecionamento);
	}
		
}