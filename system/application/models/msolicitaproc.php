<?php
class Msolicitaproc extends Model {

	function getProcessoExiste($proc){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select dbo.pesquisaprocesso ('$proc') as EncontraProc";
		$query = $this->db->query($sql);
		return $query->result();	
	}	
			
	function getProcDetail($proc){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from Acoes where ProcessoJudicialNumero=$proc";
		$query = $this->db->query($sql);
		return $query->result();	
	}
	
	
	
	
	
	function delete_row(){
		$IdAcao = $this->uri->segment(3);
		$IdRegPrazo = $this->uri->segment(4);				
		$this->db->where('Id', $IdRegPrazo);
		$this->db->delete('Prazos');
		$redirecionamento = "cjuridico/detailacaotrab/".$IdAcao."#tabs-6";
		redirect($redirecionamento);
	}
	
	
}