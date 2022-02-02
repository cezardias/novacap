<?php
class Mjuridico extends Model {

	function getAuxTATipo(){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from AuxTATipo";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAuxTADenominacao(){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from AuxTADenominacao";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getPrazosAcoesQtd($usuariolog){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "EXEC pesquisaprazosacoes '$usuariolog',0"; //QTD
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getPrazosAcoesDetail($usuariolog){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "EXEC pesquisaprazosacoes '$usuariolog',1"; //Detalhamento
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAssuntos(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "SELECT * FROM vw_assuntostrabalhistas ORDER BY descricao ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAuxAndamento(){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "SELECT * FROM vw_andamentostrabalhistas ORDER BY Descricao";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAuxAndamentoTodos(){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "SELECT * FROM AuxAndamento ORDER BY Descricao";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAcaoAssuntos($idAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from vw_AcoesAssunto where AcoesId=$idAcao";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getSituacaoContratos(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		//$sql = "SELECT c.id AS Id, c.diretoria AS Diretoria, c.contratonr AS Contrato, dbo.Formatarprocessoadm(c.processonr) AS ProcessoNr, c.empresanome AS Empresa, v.vigenciaaditada AS Vigencia, v.mensagem AS Mensagem, v.PrazoParaFim as DiasRestanteCor  FROM contratos c INNER JOIN vw_vigexeccontratos v ON c.id = v.id ORDER BY v.prazoparafim";
		$sql = "EXEC SituacaoDosContratos";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getContratoModalidade(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from AuxLicitacaoModalidade order by Descricao asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getSituacaoContratosTotal(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		//$sql = "Select count(*) AS TotalContratos from vw_vigexeccontratos where prazoparafim < 40";
		$sql = "EXEC SituacaoDosContratosTotal";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAdvogadoNivel($usuariolog){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "SELECT * FROM UsuariosAcesso WHERE Login='$usuariolog'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAdvLogado($usuariolog){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from vw_Advogados where Login='$usuariolog'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAdvogados(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "select * from vw_Advogados order by NomeCompleto";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAdvogadoDetail($usuariolog){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "select * from vw_Advogados where Login='$usuariolog'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getUsuarioNivel($usuariolog){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from UsuariosAcesso where Login='$usuariolog'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getInteressados(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from Interessados Order By InteressadoNome asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAuditorias($probid,$tipoacao,$statusacao,$posicaonovacap){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec RelatorioAuditoria $probid,$tipoacao,$statusacao,$posicaonovacap";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getInteressadoAcao($idAcao){ //INTERESSADOS EM A��ES
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from Interessados where AcoesId=$idAcao Order By InteressadoNome asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAcoesTipo(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from AuxAcoesTipo";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getVarasTrab(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from vw_Varas where TipoId=1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getVarasGeral(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from vw_Varas";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getVaraExclusiva($IdAdvogado){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from vw_Varas where AdvogadoId=$IdAdvogado"; //Filtrar pelo tipo de a��o.
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAuxAndamentos(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "SELECT * FROM vw_andamentostrabalhistas ORDER BY Descricao";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAndamentoRecente($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from vw_AndamentoMaisRecente where acoesid=$IdAcao";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAndamentosAcao($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from Andamentos where AcoesId=$IdAcao order by Data desc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAudiencias($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from Audiencias where AcaoId=$IdAcao ORDER BY AudienciaDataHora Desc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getTipoAudiencia(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from AuxAudienciaTipo";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAuditoria(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec relatorioauditoria";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAcoesQtd($interesado,$prjudnum,$pradmnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtacausa,$dtaacordao,$dtasentenca,$dtacalculohomologado,$dtacondenacao,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec dbo.PesquisaAcaoTrabalhista $interesado,$prjudnum,$pradmnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtacausa,$dtaacordao,$dtasentenca,$dtacalculohomologado,$dtacondenacao,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim,null,null,0";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAcoesResult($interesado,$prjudnum,$pradmnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtacausa,$dtaacordao,$dtasentenca,$dtacalculohomologado,$dtacondenacao,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim,$perpage,$primeiroregistro){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$porpagina = $perpage;
		$data['pagina'] = $porpagina;
		if ($primeiroregistro == ''){
			$primeiroregistro = 0;
		}
		$sql = "exec dbo.PesquisaAcaoTrabalhista $interesado,$prjudnum,$pradmnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtacausa,$dtaacordao,$dtasentenca,$dtacalculohomologado,$dtacondenacao,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim,$porpagina,$primeiroregistro,1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAcoesExcel($interesado,$prjudnum,$pradmnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec dbo.PesquisaAcaoTrabalhista $interesado,$prjudnum,$pradmnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim,NULL,NULL,2";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAudienciasFiltro($AudienciaDataIni,$AudienciaDataFim,$preposto,$varaid,$tipoaudienciaid,$tipoacaoid,$advogadoid){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "EXEC PesquisaAudiencia $AudienciaDataIni,$AudienciaDataFim,$preposto,$varaid,$tipoaudienciaid,$tipoacaoid,$advogadoid";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getPrazoFiltro($prazoini,$prazofim,$varaid,$tipoacaoid,$advogadoid,$soma){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "EXEC pesquisaprazos $prazoini,$prazofim,$varaid,$tipoacaoid,$advogadoid,$soma";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getContratosQtd($contratonr,$prnum,$empresanome,$modalidade,$licitanum,$diretoria,$objeto,$prazovigstatus,$prsei,$anocontr){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
	 	$sql = "exec PesquisaContrato $contratonr,$prnum,$empresanome,$modalidade,$licitanum,$diretoria,$objeto,$prazovigstatus,$prsei,$anocontr,null,null,0";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getContratosResult($contratonr,$prnum,$empresanome,$modalidade,$licitanum,$diretoria,$objeto,$prazovigstatus,$prsei,$anocontr,$perpage,$primeiroregistro){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$porpagina = $perpage;
		$data['pagina'] = $porpagina;
		if ($primeiroregistro == ''){
			$primeiroregistro = 0;
		}
		$sql = "exec PesquisaContrato $contratonr,$prnum,$empresanome,$modalidade,$licitanum,$diretoria,$objeto,$prazovigstatus,$prsei,$anocontr,$porpagina,$primeiroregistro,1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getContratosRelat($contratonr,$prnum,$empresanome,$modalidade,$licitanum,$diretoria,$objeto,$prazovigstatus,$prsei,$anocontr,$totalLinhas2){
		//echo 'Ano: '.$anocontr;
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec PesquisaContrato $contratonr,$prnum,$empresanome,$modalidade,$licitanum,$diretoria,$objeto,$prazovigstatus,$prsei,$anocontr,$totalLinhas2,0,1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAcaoDetail($idAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from Acoes where Id=$idAcao";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getPrazos($idAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from Prazos where AcaoId=$idAcao Order by Data desc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getNivelAcesso($usuariolog){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "select * from UsuariosAcesso where Login='$usuariolog'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getContratoDetail($IdContrato){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from vw_Contratos where Id=$IdContrato";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getContratoMedicoes($IdContrato){
	    $this->db->query('SET ANSI_NULLS ON');
	    $this->db->query('SET ANSI_WARNINGS ON');
	    $sql = "Select * from Medicoes where ContratoId=$IdContrato order by Numero";
	    $query = $this->db->query($sql);
	    return $query->result();
	}

	function getContratoFaturas($IdContrato){
	    $this->db->query('SET ANSI_NULLS ON');
	    $this->db->query('SET ANSI_WARNINGS ON');
	    $sql = "Select * from vw_Faturas where ContratoId=$IdContrato order by Numero";
	    $query = $this->db->query($sql);
	    return $query->result();
	}

	function getDetailFatura($IdFatura){
	    $this->db->query('SET ANSI_NULLS ON');
	    $this->db->query('SET ANSI_WARNINGS ON');
	    $sql = "Select * from vw_faturas where Id=$IdFatura order by Numero";
	    $query = $this->db->query($sql);
	    return $query->result();
	}

	function getContratoNotaEmpenhos($IdContrato){
	    $this->db->query('SET ANSI_NULLS ON');
	    $this->db->query('SET ANSI_WARNINGS ON');
	    $sql = "Select * from NotasDeEmpenho where ContratoId=$IdContrato order by Numero";
	    $query = $this->db->query($sql);
	    return $query->result();
	}

	function getContratoOrdemBancarias($IdContrato){
	    $this->db->query('SET ANSI_NULLS ON');
	    $this->db->query('SET ANSI_WARNINGS ON');
	    $sql = "Select * from OrdensBancarias where ContratoId=$IdContrato order by Numero";
	    $query = $this->db->query($sql);
	    return $query->result();
	}

	function getLancamentos($IdContrato){
	    $this->db->query('SET ANSI_NULLS ON');
	    $this->db->query('SET ANSI_WARNINGS ON');
	    $sql = "Select * from vw_Lancamentos where ContratoId=$IdContrato";
	    $query = $this->db->query($sql);
	    return $query->result();
	}

	function getLancamentoDetail($LancamentoId){
		$this->db->query('SET ANSI_NULLS ON');
	    $this->db->query('SET ANSI_WARNINGS ON');
	    $sql = "Select * from vw_Lancamentos where LancamentoId=$LancamentoId";
	    $query = $this->db->query($sql);
	    return $query->result();
	}

	function getContratoSituacao(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from AuxContratoSituacao";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAditivos($IdContrato){
	    $this->db->query('SET ANSI_NULLS ON');
	    $this->db->query('SET ANSI_WARNINGS ON');
	    $sql = "exec ContratoAditivo $IdContrato";
	    $query = $this->db->query($sql);
	    return $query->result();
	}
	
	function getTermos($IdContrato){
	    $this->db->query('SET ANSI_NULLS ON');
	    $this->db->query('SET ANSI_WARNINGS ON');
	    $sql = "Select * from vw_TermosDeApostilamento where ContratoId=$IdContrato";
	    $query = $this->db->query($sql);
	    return $query->result();
	}

	function getTermosDeApostilamento($IdContrato){
	    $this->db->query('SET ANSI_NULLS ON');
	    $this->db->query('SET ANSI_WARNINGS ON');
	    $sql = "Select * from vw_TermosDeApostilamento Where ContratoId=$IdContrato";
	    $query = $this->db->query($sql);
	    return $query->result();
	}

	function getAudienciaDetail($IdRegAud){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from Audiencias where Id=$IdRegAud";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAndamentoDetail($IdRegAnd){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from Andamentos where Id=$IdRegAnd";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getPrazoDetail($IdPrazo){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from Prazos where Id=$IdPrazo";
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

	function getCodSisprot($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "EXEC SolicitacaoAutuacaoProcesso $IdAcao";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getLocalizaProc($IdUsuario,$IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec dbo.solicitaprocesso 2,6847";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAdvogadoAlteraPrazo($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from vw_advogadoacao where AcaoId=$IdAcao";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function add_record_acao($data){
		$this->db->insert('Acoes', $data);
		return;
	}

	function add_record_assunto($data){
		$this->db->insert('AcoesAssunto', $data);
		return;
	}

	function add_record_interessado($data){
		$this->db->insert('Interessados', $data);
		return;
	}

	function add_record_audiencia($data){
		$this->db->insert('Audiencias', $data);
		return;
	}

	function add_record_contrato($data){
		$this->db->insert('Contratos', $data);
		return;
	}

	function add_andamento($data){
		$this->db->insert('Andamentos', $data);
		return;
	}

	function add_prazo($data){
		$this->db->insert('Prazos', $data);
		return;
	}

	function update_prazo($data,$IdPrazo){
		$this->db->where('Id', $IdPrazo);
		$this->db->update('Prazos', $data);
	}

	function update_status_prazo($IdPrazo,$Status){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Update Prazos set Concluido=$Status Where Id=$IdPrazo";
		$query = $this->db->query($sql);
	}

	function update_acao($data,$IdAcao){
		$this->db->where('Id', $IdAcao);
		$this->db->update('Acoes', $data);
	}

	function update_audiencia($data,$IdRegAud){
		$this->db->where('Id', $IdRegAud);
		$this->db->update('Audiencias', $data);
	}

	function update_andamento($data,$IdRegAnd){
		$this->db->where('Id', $IdRegAnd);
		$this->db->update('Andamentos', $data);
	}

	function update_record_contrato($data,$idcontrato){
		$this->db->where('Id', $idcontrato);
		$this->db->update('Contratos', $data);
	}
	
	function update_principal($IdAcao,$IdRegAssunto){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec AssuntoPrincipal $IdAcao,$IdRegAssunto";
		$query = $this->db->query($sql);
	}

	function delete_row(){
		$IdAcao = $this->uri->segment(3);
		$this->db->where('Id', $IdAcao);
		$this->db->delete('Acoes');
		$redirecionamento = "/cjuridico/index";
		redirect($redirecionamento);
	}

}
