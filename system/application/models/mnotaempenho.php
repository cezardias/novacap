<?php
class Mnotaempenho extends Model {

	function add_notaempenho($data){
		$this->db->insert('NotasDeEmpenho', $data);
		return;
	}

	function update_notaempenho($notaempid,$data){
		$this->db->where('Id', $notaempid);
		$this->db->update('NotasDeEmpenho', $data);
	}

	public function getFaturaDetail($IdNotaEmp){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
			$sql = "Select Id,ContratoId,Numero,convert(varchar, EmissaoData, 23) as EmissaoData,Valor,ValorAnulado from vw_NotasDeEmpenho where Id=$IdNotaEmp";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function delete_row(){
		$IdNotaEmp = $this->uri->segment(3);
		$contratoid = $this->uri->segment(4);
		$this->db->where('Id', $IdNotaEmp);
		$this->db->delete('NotasDeEmpenho');
		$redirecionamento = "/ccontrato/detailcontrato/".$contratoid."#aba04";
		redirect($redirecionamento);
	}

}
