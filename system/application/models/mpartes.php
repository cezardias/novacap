<?php
class Mpartes extends Model {

	function delete_row(){
		$IdAcao = $this->uri->segment(3);
		$IdRegAnd = $this->uri->segment(4);				
		$this->db->where('Id', $IdRegAnd);
		$this->db->delete('Andamentos');
		$redirecionamento = "cacaocivel/detailacaocivel/".$IdAcao."#tabs-5";
		redirect($redirecionamento);
	}

	function searchCPFCNPJ($cpfcnpj){	
		if($cpfcnpj==""){$cpfcnpj='99999999999';}
		$sql = "EXEC PesquisaPartes NULL,$cpfcnpj";
		$query = $this->db->query($sql);
		return $query->result();
	}
		
	function searchNOME($nome){	
		if($nome==""){$nome='AAAAAAAAAAAAAAAAAAAA';}
		$sql = "EXEC PesquisaPartes '$nome',NULL";
		$query = $this->db->query($sql);
		return $query->result();
	}	

}