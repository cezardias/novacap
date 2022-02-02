<?php
class Mfinanceiro extends Model{

	function getAcessoUsuario($login){
	    $this->db->query('SET ANSI_NULLS ON');
	    $this->db->query('SET ANSI_WARNINGS ON');
	    $sql = "Select * from UsuariosAcesso where Login='$login' and Ativo=1";
	    $query = $this->db->query($sql);
	    return $query->result();
	}

	function getAssuntos(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select Id,Descricao from vw_AuxAssunto order by Descricao";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getContas(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from vw_Contas Order By Combobox";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAssuntosFiltro($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec PesquisaAssuntos $IdAcao";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getBancos(){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from AuxBancos";
		$query = $this->db->query($sql);
		return $query->result();
	}


	function getFinanceiroQtd($nome,$cpfcnpj,$advogadoid,$prjud,$pradm,$assuntoid,$prsei){
	    $this->db->query('SET ANSI_NULLS ON');
	    $this->db->query('SET ANSI_WARNINGS ON');
	    $sql = "exec Pesquisafinanceiro $nome,$cpfcnpj,$advogadoid,$prjud,$pradm,$assuntoid,$prsei,null,null,0";
	    $query = $this->db->query($sql);
	    return $query->result();
	}

	function getFinanceiroResult($nome,$cpfcnpj,$advogadoid,$prjud,$pradm,$assuntoid,$prsei,$perpage,$primeiroregistro){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$porpagina = $perpage;
		$data['pagina'] = $porpagina;
		if ($primeiroregistro == ''){
			$primeiroregistro = 0;
		}
		$sql = "exec Pesquisafinanceiro $nome,$cpfcnpj,$advogadoid,$prjud,$pradm,$assuntoid,$prsei,$porpagina,$primeiroregistro,1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getFinanceiroDetail($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from vw_Financeiro where AcaoId=$IdAcao";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function update_quitado($novostatus,$IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "UPDATE Acoes SET Quitado=$novostatus WHERE Id=$IdAcao";
		$query = $this->db->query($sql);
	}

	function getNotaExplicativa($nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "EXEC relatorionotaexplicativa  $nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getRelatorioVLC($nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec RelatorioVLCComDataCorte $nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte";

		$query = $this->db->query($sql);

		//$str = $this->db->last_query();
		//echo $str;
		return $query->result();
	}

	function getDepJudPDF($nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec RelatorioDepositosJudiciaisComDataCorte $nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	// function getDepJudPDFtotal($nome,$cpfcnpj,$probperdaid,$acoestipoid,$situacao,$chequevaldepositado){
	// 	$this->db->query('SET ANSI_NULLS ON');
	//  	$this->db->query('SET ANSI_WARNINGS ON');
	// 	$sql = "exec Relatoriodepositosjudiciaistotal $nome,$cpfcnpj,$probperdaid,$acoestipoid,$situacao,$chequevaldepositado";
	// 	$query = $this->db->query($sql);
	// 	return $query->result();
	// }

	function getDepJudEXCEL($nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec RelatorioDepositosJudiciaisComDataCorte $nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getBloqJudPDF($nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec RelatorioBloqueiosJudiciaisComDataCorte $nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getBloqJudEXCEL($nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte){
		$this->db->query('SET ANSI_NULLS ON');
		$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec RelatorioBloqueiosJudiciaisComDataCorte $nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getInteressados($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec PesquisaInteressados $IdAcao";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getPagamentoAcoes($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec Pesquisafinanceirodetalhe $IdAcao,1"; // Pagamento valor a��o
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getEstornoPgtoAcoes($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec Pesquisafinanceirodetalhe $IdAcao,2"; //Estorno valor a��o
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getDevPgtoAcoes($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec Pesquisafinanceirodetalhe $IdAcao,3"; //Devolu��o valor a��o
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getDepositosJudiciais($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec Pesquisafinanceirodetalhe $IdAcao,4"; //Dep�sitos judiciais
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getDepositosJudCorrecaoMonet($IdAcao){
	    $this->db->query('SET ANSI_NULLS ON');
	    $this->db->query('SET ANSI_WARNINGS ON');
	    $sql = "exec Pesquisafinanceirodetalhe $IdAcao,13"; //Dep�sitos judiciais corre��o monet�ria
	    $query = $this->db->query($sql);
	    return $query->result();
	}

	function getDepositosJudConvolados($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec Pesquisafinanceirodetalhe $IdAcao,5"; //Dep�sitos judiciais convolados
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getDepositosJudDevolucoes($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec Pesquisafinanceirodetalhe $IdAcao,6"; //Dep�sitos judiciais devolu��es
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getDepositosJudEstornos($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec Pesquisafinanceirodetalhe $IdAcao,7"; //Dep�sitos judiciais estornos
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getBloqueiosJud($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec Pesquisafinanceirodetalhe $IdAcao,8"; //Bloqueios judiciais
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getBloqJudCorrecaoMonet($IdAcao){
	    $this->db->query('SET ANSI_NULLS ON');
	    $this->db->query('SET ANSI_WARNINGS ON');
	    $sql = "exec Pesquisafinanceirodetalhe $IdAcao,14"; //Bloqueios judiciais corre��o monet�ria
	    $query = $this->db->query($sql);
	    return $query->result();
	}

	function getBloqueiosJudConvolados($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec Pesquisafinanceirodetalhe $IdAcao,9"; //Bloqueios judiciais convolados
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getBloqueiosJudDevolucoes($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec Pesquisafinanceirodetalhe $IdAcao,10"; //Bloqueios judiciais devolu��es
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getBloqueiosJudEstornos($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec Pesquisafinanceirodetalhe $IdAcao,11"; //Bloqueios judiciais estornos
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getPagamentoCustas($IdAcao){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "exec Pesquisafinanceirodetalhe $IdAcao,12"; //Pagamentos de custas
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getContasBanco(){
		$this->db->query('SET ANSI_NULLS ON');
	 	$this->db->query('SET ANSI_WARNINGS ON');
		$sql = "Select * from contas order by Combobox";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function add_pgto_acoes($data){
		$this->db->insert('Financeiro', $data);
		return;
	}

	function delete_row(){ //tabela com diversos t�picos de dados.
		$IdPgtoAcao = $this->uri->segment(3);
		$IdAcao = $this->uri->segment(4);
		$voltar = $this->uri->segment(5);
		$this->db->where('Id', $IdPgtoAcao);
		$this->db->delete('Financeiro');
		if($voltar==1){ //volta para pagamento de a��es
			$redirecionamento = "/cfinanceiro/pagamentoacoes/".$IdAcao;
		}else if($voltar==2){ //volta para estorno de pagamento de a��es
			$redirecionamento = "/cfinanceiro/estornopgtoacoes/".$IdAcao;
		}else if($voltar==3){ //volta para devolu��o de pagamento de a��es
			$redirecionamento = "/cfinanceiro/devpagamentoacoes/".$IdAcao;
		}else if($voltar==4){ //volta para dep�stios judiciais
			$redirecionamento = "/cfinanceiro/depositosjudiciais/".$IdAcao;
		}else if($voltar==5){ //volta para dep�stios judiciais convolados
			$redirecionamento = "/cfinanceiro/depositosjudconvolados/".$IdAcao;
		}else if($voltar==6){ //volta para dep�stios judiciais devolu��es
			$redirecionamento = "/cfinanceiro/depositosjuddevolucoes/".$IdAcao;
		}else if($voltar==7){ //volta para dep�stios judiciais estornos
			$redirecionamento = "/cfinanceiro/depositosjudestornos/".$IdAcao;
		}else if($voltar==8){ //volta para bloqueios judiciais
			$redirecionamento = "/cfinanceiro/bloqueiosjud/".$IdAcao;
		}else if($voltar==9){ //volta para bloqueios judiciais convolados
			$redirecionamento = "/cfinanceiro/bloqueiosjudconvolados/".$IdAcao;
		}else if($voltar==10){ //volta para bloqueios judiciais devolu��es
			$redirecionamento = "/cfinanceiro/bloqueiosjuddevolucoes/".$IdAcao;
		}else if($voltar==11){ //volta para bloqueios judiciais devolu��es
			$redirecionamento = "/cfinanceiro/bloqueiosjudestornos/".$IdAcao;
		}else if($voltar==12){ //volta para pagamento de custas
			$redirecionamento = "/cfinanceiro/pagamentocustas/".$IdAcao;
		}else if($voltar==13){ //volta para pagamento de custas
		    $redirecionamento = "/cfinanceiro/depositosjudcorrecaomonet/".$IdAcao;
		}else if($voltar==14){ //volta para pagamento de custas
		    $redirecionamento = "/cfinanceiro/bloqueiosjudcorrecaomonet/".$IdAcao;
		}
		redirect($redirecionamento);
	}

}
