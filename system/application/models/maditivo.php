<?php
class Maditivo extends Model{

	function add_record_contrato($data){
		$this->db->insert('Contratos', $data);
		return;
	}
	
	function add_record_adt($data){
		$this->db->insert('Aditivos', $data);
		return;
	}
	
	function update_acao($data,$IdAcao){
		$this->db->where('Id', $IdAcao);
		$this->db->update('Acoes', $data);	
	}

	function AuxAditivoDenominacao(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from AuxAditivoDenominacao Order by Id asc";
		$query = $this->db->query($sql);
		return $query->result();	
	}	
	
	function AuxAditivoTipo(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from AuxAditivoTipo Order by Id asc";
		$query = $this->db->query($sql);
		return $query->result();	
	}	
	
	function getAditivoDetail($IdAditivo){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from Aditivos where Id=$IdAditivo";
		$query = $this->db->query($sql);
		return $query->result();	
	}
	function getAditivoDetailLongo($IdAditivo){ //TEXTOS LONGOS, MOTIVAÇÃO
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select cast(Motivacao as Text) as Motivacao from Aditivos where Id=$IdAditivo";
		$query = $this->db->query($sql);
		return $query->result();	
	}	
	
	function update_adt($data,$aditivoid){
		$this->db->where('Id', $aditivoid);
		$this->db->update('Aditivos', $data);			
	}
	
	function delete_row(){
		$IdContrato = $this->uri->segment(3);
		$IdAditivo = $this->uri->segment(4);
		$this->db->where('Id', $IdAditivo);
		$this->db->delete('Aditivos');		
		$redirecionamento = "/caditivo/detailcontrato/".$IdContrato."#tabs-2";
		redirect($redirecionamento);
	}
		
}