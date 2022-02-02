<?php
class Macaocivel extends Model {

	function getAssuntos(){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "SELECT * FROM vw_assuntosciveis ORDER BY descricao asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAuxAndamento(){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "SELECT * FROM vw_andamentosciveis ORDER BY Descricao";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function add_acao_civel($data){
		$this->db->insert('Acoes', $data);
		return;
	}

	function add_parte_interessado($Tipo,$nome,$cpfcnpj,$Matricula,$Endereco,$Complemento,$Bairro,$Municipio,$UF,$CEP,$Telefone){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "EXEC InsertPartes $Tipo,'$nome','$cpfcnpj','$Matricula','$Endereco','$Complemento','$Bairro','$Municipio','$UF','$CEP','$Telefone'";
		$query = $this->db->query($sql);
		return $query->result(); //Essa função insere e retorna, não faz uso do SCOPE_IDENTITY()
	}

	function getUsuarioExiste($cpfcnpj){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec verificacpfcnpjexistente '$cpfcnpj'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getRegAtual(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "SELECT SCOPE_IDENTITY()";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getProcessoExsite($prjud){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select dbo.Pesquisaprocesso('$prjud') as PrExiste";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAcoesQtd($interesado,$prcnj,$pradmnum,$prjudnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtacausa,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec PesquisaAcaoCivel $interesado,$prcnj,$pradmnum,$prjudnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtacausa,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim,null,null,0";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAcoesResult($interesado,$prcnj,$pradmnum,$prjudnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtacausa,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim,$perpage,$primeiroregistro){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$porpagina = $perpage;
		$data['pagina'] = $porpagina;
		if ($primeiroregistro == ''){
			$primeiroregistro = 0;
		}
		$sql = "exec PesquisaAcaoCivel $interesado,$prcnj,$pradmnum,$prjudnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtacausa,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim,$porpagina,$primeiroregistro,1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAcoesExcel($interesado,$prcnj,$pradmnum,$prjudnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec PesquisaAcaoCivel $interesado,$prcnj,$pradmnum,$prjudnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim,NULL,NULL,2";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAuxValoresTipo(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from AuxValoresTipo Order By Descricao";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function update_acao_civel($data,$IdAcao){
		$this->db->where('Id', $IdAcao);
		$this->db->update('Acoes', $data);
	}

	function getAuxVaras(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from vw_varas where TipoId=2"; //Filtrar pelo tipo de a��o.
		$query = $this->db->query($sql);
		return $query->result();
	}

	function update_status_prazo_civel($IdPrazo,$Status){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Update Prazos set Concluido=$Status Where Id=$IdPrazo";
		$query = $this->db->query($sql);
	}

	function getCodSisprot($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "EXEC SolicitacaoAutuacaoProcesso $IdAcao";
		$query = $this->db->query($sql);
		return $query->result();
	}

}
