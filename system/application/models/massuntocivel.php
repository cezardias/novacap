<?php
class Massuntocivel extends Model {

	function delete_row(){
		$IdAcao = $this->uri->segment(3);
		$IdRegAss = $this->uri->segment(4);	
		$AcaoTipoId = $this->uri->segment(5); //1 - Trabalhista, 2 - Cível			
		$this->db->where('Id', $IdRegAss);
		$this->db->delete('AcoesAssunto');
		if($AcaoTipoId==1){		
			$redirecionamento = "cjuridoco/detailacaotrab/".$IdAcao."#tabs-3";
		}else if($AcaoTipoId==2){
			$redirecionamento = "cacaocivel/detailacaocivel/".$IdAcao."#tabs-3";
		}
		redirect($redirecionamento);
	}
		
}