<?php
class Minteressado extends Model { // USADO PARA CÍVEL E TRABALHISTA

	function delete_row(){
		$AcoesInterId = $this->uri->segment(3);
		$IdRegInter = $this->uri->segment(4);
		$AcaoTipoId = $this->uri->segment(5); //1 - Trabalhista, 2 - Cível 
		$this->db->where('Id', $IdRegInter);
		$this->db->delete('Interessados');		
		if($AcaoTipoId==1){
			$redirecionamento = "cjuridico/detailacaotrab/".$AcoesInterId."#tabs-2";
		}else if($AcaoTipoId==2){
			$redirecionamento = "cacaocivel/detailacaocivel/".$AcoesInterId."#tabs-2";
		}
		redirect($redirecionamento);
	}	
		
}