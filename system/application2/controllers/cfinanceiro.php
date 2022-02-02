<?php
class Cfinanceiro extends Controller {

	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Mjuridico');
		$this->load->model('Mfinanceiro');
		$this->load->model('Mfuncionario');

		//@@ADICIONAR EM TODAS AS PÁGINAS PROTEGIDAS
		$this->load->library('security');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Pragma: no-cache");
	}

	function financeiroindex(){
		$usuariolog = $this->session->userdata('usuario');
		$data['advogados'] = $this->Mjuridico->getAdvogados();
		$data['assuntos'] = $this->Mfinanceiro->getAssuntos();
		$this->security->verifiyLogin('view_financeiro_busca_index.php',$data,$this->router->class,$this->router->method);
	}

	function relatoriosindex(){
		$usuariolog = $this->session->userdata('usuario');
		$data['acoestipo'] = $this->Mjuridico->getAcoesTipo();
		$data['assuntos'] = $this->Mfinanceiro->getAssuntos();
		$data['contas'] = $this->Mfinanceiro->getContas();
		$this->security->verifiyLogin('view_financeiro_relatorios_index.php',$data,$this->router->class,$this->router->method);
	}

	function alteraquitado(){
		$status = $this->uri->segment(3);
		$IdAcao = $this->uri->segment(4);
		if($status==0){ //Não quitado
			$novostatus = 1; //Altera para quitado
			$this->Mfinanceiro->update_quitado($novostatus,$IdAcao);
		}else if($status==1){ //Quitado
			$novostatus = 0; //Altera para Não quitado
			$this->Mfinanceiro->update_quitado($novostatus,$IdAcao);
		}
		$redirecionamento = "/cfinanceiro/detailfinanceiro/".$IdAcao;
		redirect($redirecionamento);
	}

	function buscafinanceiroresult() {
		$this->load->library('pagination');
		if(isset($_POST['submit'])){
			$por_pg = 0;
			$nome = $this->input->post('nome');if($nome==""){$nome='NULL';} else{$nome="'$nome'";}
			$cpfcnpj = $this->input->post('cpfcnpj'); if($cpfcnpj==""){$cpfcnpj='NULL';} else{$cpfcnpj = preg_replace("/[^0-9]/", "", $cpfcnpj);}
			$advogadoid = $this->input->post('advogadoid'); if($advogadoid==""){$advogadoid='NULL';}
			$prjud = $this->input->post('prjud'); if($prjud==""){$prjud='NULL';} else{$prjud = preg_replace("/[^0-9]/", "", $prjud);}
			$pradm = $this->input->post('pradm'); if($pradm==""){$pradm='NULL';} else{$pradm = preg_replace("/[^0-9]/", "", $pradm);}
			$prsei = $this->input->post('prsei'); if($prsei==""){$prsei='NULL';} else{$prsei = preg_replace("/[^0-9]/", "", $prsei);}
			$assuntoid = $this->input->post('assuntoid'); if($assuntoid==""){$assuntoid='NULL';}

			$newdata = array(
				'nome' => $nome,
				'cpfcnpj' => $cpfcnpj,
				'advogadoid' => $advogadoid,
				'prjud' => $prjud,
				'pradm' => $pradm,
				'assuntoid' => $assuntoid,
			  'prsei' => $prsei
			);
			$this->session->set_userdata($newdata);
		}else{
			$por_pg = 1;
			$nome = $this->session->userdata('nome');
			$cpfcnpj = $this->session->userdata('cpfcnpj');
			$advogadoid = $this->session->userdata('advogadoid');
			$prjud = $this->session->userdata('prjud');
			$pradm = $this->session->userdata('pradm');
			$assuntoid = $this->session->userdata('assuntoid');
			$prsei = $this->session->userdata('prsei');
		}
		$config['uri_segment'] = '3';
		$config['base_url'] = base_url().'cfinanceiro/buscafinanceiroresult/';
		$config['per_page'] = '15';
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['first_link'] = 'Primeiro';
		$config['last_link'] = '&Uacute;ltimo';
		$config['next_link'] = 'Pr&oacute;ximo';
		$config['prev_link'] = 'Anterior';

		$totalLinhas = $this->Mfinanceiro->getFinanceiroQtd($nome,$cpfcnpj,$advogadoid,$prjud,$pradm,$assuntoid,$prsei);
		$totalLinhas2 = 0;

		foreach($totalLinhas as $row):
			$totalLinhas2 = $row->QTD;
		endforeach;
		$config['total_rows'] = $totalLinhas2;
		$this->pagination->initialize($config);
		$data = array();
		$data['total_linhas'] = $totalLinhas2; //para exibir na view o total de registros encontrados.

		$per_page = $this->uri->segment(3)+15;
		if($por_pg==0){ //Primeira página
			$data['pagina'] = 0;
		}
		if($por_pg==1){ //Demais páginas.
			$data['pagina'] = $this->uri->segment(3);
		}
		if($query = $this->Mfinanceiro->getFinanceiroResult($nome,$cpfcnpj,$advogadoid,$prjud,$pradm,$assuntoid,$prsei,$per_page,$this->uri->segment(3))){
			$data['docresult'] = $query;
		}
		$this->security->verifiyLogin('view_financeiro_busca_result.php',$data,$this->router->class,$this->router->method);
	}

	function detailfinanceiro(){
		$IdAcao = $this->uri->segment(3);
		$data['detailfinanceiro'] = $this->Mfinanceiro->getFinanceiroDetail($IdAcao);
		$this->security->verifiyLogin('view_financeiro_detail.php',$data,$this->router->class,$this->router->method);
	}

	function interessados(){
		$IdAcao = $this->uri->segment(3);
		$data['interessados'] = $this->Mfinanceiro->getInteressados($IdAcao);
		$data['detailfinanceiro'] = $this->Mfinanceiro->getFinanceiroDetail($IdAcao);
		$this->security->verifiyLogin('view_financeiro_interessados.php',$data,$this->router->class,$this->router->method);
	}

	function assuntos(){
		$IdAcao = $this->uri->segment(3);
		$data['assuntos'] = $this->Mfinanceiro->getAssuntosFiltro($IdAcao);
		$data['detailfinanceiro'] = $this->Mfinanceiro->getFinanceiroDetail($IdAcao);
		$this->security->verifiyLogin('view_financeiro_assuntos.php',$data,$this->router->class,$this->router->method);
	}

	function pagamentoacoes(){
		$IdAcao = $this->uri->segment(3);
		$data['pagamentoacoes'] = $this->Mfinanceiro->getPagamentoAcoes($IdAcao);
		$data['detailfinanceiro'] = $this->Mfinanceiro->getFinanceiroDetail($IdAcao);
		$this->security->verifiyLogin('view_financeiro1_pagamento_acoes.php',$data,$this->router->class,$this->router->method);
	}

	function estornopgtoacoes(){
		$IdAcao = $this->uri->segment(3);
		$data['estornopgtoacoes'] = $this->Mfinanceiro->getEstornoPgtoAcoes($IdAcao);
		$data['detailfinanceiro'] = $this->Mfinanceiro->getFinanceiroDetail($IdAcao);
		$this->security->verifiyLogin('view_financeiro2_estorno_acoes.php',$data,$this->router->class,$this->router->method);
	}

	function devpagamentoacoes(){
		$IdAcao = $this->uri->segment(3);
		$data['devpgtoacoes'] = $this->Mfinanceiro->getDevPgtoAcoes($IdAcao);
		$data['detailfinanceiro'] = $this->Mfinanceiro->getFinanceiroDetail($IdAcao);
		$this->security->verifiyLogin('view_financeiro3_devolucao_acoes.php',$data,$this->router->class,$this->router->method);
	}

	function depositosjudiciais(){
		$IdAcao = $this->uri->segment(3);
		$data['depositosjud'] = $this->Mfinanceiro->getDepositosJudiciais($IdAcao);
		$data['detailfinanceiro'] = $this->Mfinanceiro->getFinanceiroDetail($IdAcao);
		$this->security->verifiyLogin('view_financeiro4_depositos_judiciais.php',$data,$this->router->class,$this->router->method);
	}

	function depositosjudcorrecaomonet(){
	    $IdAcao = $this->uri->segment(3);
	    $data['depjudcorremonet'] = $this->Mfinanceiro->getDepositosJudCorrecaoMonet($IdAcao);
	    $data['detailfinanceiro'] = $this->Mfinanceiro->getFinanceiroDetail($IdAcao);
	    $this->security->verifiyLogin('view_financeiro13_depositos_jud_corre_monet.php',$data,$this->router->class,$this->router->method);
	}

	function depositosjudconvolados(){
		$IdAcao = $this->uri->segment(3);
		$data['depositosjudconvolados'] = $this->Mfinanceiro->getDepositosJudConvolados($IdAcao);
		$data['detailfinanceiro'] = $this->Mfinanceiro->getFinanceiroDetail($IdAcao);
		$this->security->verifiyLogin('view_financeiro5_depositos_jud_convolados.php',$data,$this->router->class,$this->router->method);
	}

	function depositosjuddevolucoes(){
		$IdAcao = $this->uri->segment(3);
		$data['depositosjuddevolucoes'] = $this->Mfinanceiro->getDepositosJudDevolucoes($IdAcao);
		$data['detailfinanceiro'] = $this->Mfinanceiro->getFinanceiroDetail($IdAcao);
		$this->security->verifiyLogin('view_financeiro6_depositos_jud_devolucoes.php',$data,$this->router->class,$this->router->method);
	}

	function depositosjudestornos(){
		$IdAcao = $this->uri->segment(3);
		$data['depositosjudestornos'] = $this->Mfinanceiro->getDepositosJudEstornos($IdAcao);
		$data['detailfinanceiro'] = $this->Mfinanceiro->getFinanceiroDetail($IdAcao);
		$this->security->verifiyLogin('view_financeiro7_depositos_jud_estornos.php',$data,$this->router->class,$this->router->method);
	}

	function bloqueiosjud(){
		$IdAcao = $this->uri->segment(3);
		$data['bloqjudiciais'] = $this->Mfinanceiro->getBloqueiosJud($IdAcao);
		$data['contasbanco'] = $this->Mfinanceiro->getContasBanco();
		$data['detailfinanceiro'] = $this->Mfinanceiro->getFinanceiroDetail($IdAcao);
		$this->security->verifiyLogin('view_financeiro8_bloqueios_jud.php',$data,$this->router->class,$this->router->method);
	}

	function bloqueiosjudcorrecaomonet(){
	    $IdAcao = $this->uri->segment(3);
	    $data['bloqjudcorremonet'] = $this->Mfinanceiro->getBloqJudCorrecaoMonet($IdAcao);
	    $data['contasbanco'] = $this->Mfinanceiro->getContasBanco();
	    $data['detailfinanceiro'] = $this->Mfinanceiro->getFinanceiroDetail($IdAcao);
	    $this->security->verifiyLogin('view_financeiro14_bloq_corre_monet.php',$data,$this->router->class,$this->router->method);
	}

	function bloqueiosjudconvolados(){
		$IdAcao = $this->uri->segment(3);
		$data['bloqueiosjudconvolados'] = $this->Mfinanceiro->getBloqueiosJudConvolados($IdAcao);
		$data['detailfinanceiro'] = $this->Mfinanceiro->getFinanceiroDetail($IdAcao);
		$this->security->verifiyLogin('view_financeiro9_bloqueios_jud_convolados.php',$data,$this->router->class,$this->router->method);
	}

	function bloqueiosjuddevolucoes(){
		$IdAcao = $this->uri->segment(3);
		$data['bloqjuddevolucoes'] = $this->Mfinanceiro->getBloqueiosJudDevolucoes($IdAcao);
		$data['detailfinanceiro'] = $this->Mfinanceiro->getFinanceiroDetail($IdAcao);
		$this->security->verifiyLogin('view_financeiro10_bloqueios_jud_devolucoes.php',$data,$this->router->class,$this->router->method);
	}

	function bloqueiosjudestornos(){
		$IdAcao = $this->uri->segment(3);
		$data['bloqjudestornos'] = $this->Mfinanceiro->getBloqueiosJudEstornos($IdAcao);
		$data['detailfinanceiro'] = $this->Mfinanceiro->getFinanceiroDetail($IdAcao);
		$this->security->verifiyLogin('view_financeiro11_bloqueios_jud_estornos.php',$data,$this->router->class,$this->router->method);
	}

	function pagamentocustas(){
		$IdAcao = $this->uri->segment(3);
		$data['pagamentocustas'] = $this->Mfinanceiro->getPagamentoCustas($IdAcao);
		$data['detailfinanceiro'] = $this->Mfinanceiro->getFinanceiroDetail($IdAcao);
		$this->security->verifiyLogin('view_financeiro12_pagamento_custas.php',$data,$this->router->class,$this->router->method);
	}

	function createpgtoacao(){ //Pagamento de ações - 1
		$IdAcao = $this->input->post('acaoid');
		$datapgtoacao = $this->input->post('datapgtoacao');
		if($datapgtoacao!=""){
			$ano = substr($datapgtoacao, 0,4);
			$mes = substr($datapgtoacao, 5,2);
			$dia =  substr($datapgtoacao, 8,2);
			$datapgtoacao = $mes.'-'.$dia.'-'.$ano;
		}else {$datapgtoacao = NULL;}
		$valorpgtoacao = $this->input->post('valorpgtoacao');
		if($valorpgtoacao != ""){
			$valorpgtoacao = str_replace(".", "", $valorpgtoacao);
			$valorpgtoacao = str_replace(",", ".", $valorpgtoacao);
			$valorpgtoacao = floatval($valorpgtoacao);
		}else{$valorpgtoacao=NULL;}
		$obspgtoacao = $this->input->post('obspgtoacao');
		if($obspgtoacao==""){$obspgtoacao = NULL;}else{$obspgtoacao=strtoupper($obspgtoacao);}
		$data = array(
			'AcaoId' => $IdAcao,
			'AuxFinanceiroId' => 1, //Pagamento de ação
			'Data' => $datapgtoacao,
			'Valor' => $valorpgtoacao,
			'Observacao' => $obspgtoacao
		);
		//print_r($data);
		$this->Mfinanceiro->add_pgto_acoes($data);
		$redirecionamento = "/cfinanceiro/pagamentoacoes/".$IdAcao;
		redirect($redirecionamento);
	}

	function createstornopgtoacao(){
		$IdAcao = $this->input->post('acaoid');
		$datapgtoacao = $this->input->post('datapgtoacao');
		if($datapgtoacao!=""){
			$ano = substr($datapgtoacao, 0,4);
			$mes = substr($datapgtoacao, 5,2);
			$dia =  substr($datapgtoacao, 8,2);
			$datapgtoacao = $mes.'-'.$dia.'-'.$ano;
		}else {$datapgtoacao = NULL;}
		$valorpgtoacao = $this->input->post('valorpgtoacao');
		if($valorpgtoacao != ""){
			$valorpgtoacao = str_replace(".", "", $valorpgtoacao);
			$valorpgtoacao = str_replace(",", ".", $valorpgtoacao);
			$valorpgtoacao = floatval($valorpgtoacao);
		}else{$valorpgtoacao=NULL;}
		$obspgtoacao = $this->input->post('obspgtoacao');
		if($obspgtoacao==""){$obspgtoacao = NULL;}else{$obspgtoacao=strtoupper($obspgtoacao);}
		$data = array(
			'AcaoId' => $IdAcao,
			'AuxFinanceiroId' => 2,  //Estorno de pagamento de ação
			'Data' => $datapgtoacao,
			'Valor' => $valorpgtoacao,
			'Observacao' => $obspgtoacao
		);
		//print_r($data);
		$this->Mfinanceiro->add_pgto_acoes($data);
		$redirecionamento = "/cfinanceiro/estornopgtoacoes/".$IdAcao;
		redirect($redirecionamento);
	}

	function createdevpgtoacao(){
		$IdAcao = $this->input->post('acaoid');
		$datapgtoacao = $this->input->post('datapgtoacao');
		if($datapgtoacao!=""){
			$ano = substr($datapgtoacao, 0,4);
			$mes = substr($datapgtoacao, 5,2);
			$dia =  substr($datapgtoacao, 8,2);
			$datapgtoacao = $mes.'-'.$dia.'-'.$ano;
		}else {$datapgtoacao = NULL;}
		$valorpgtoacao = $this->input->post('valorpgtoacao');
		if($valorpgtoacao != ""){
			$valorpgtoacao = str_replace(".", "", $valorpgtoacao);
			$valorpgtoacao = str_replace(",", ".", $valorpgtoacao);
			$valorpgtoacao = floatval($valorpgtoacao);
		}else{$valorpgtoacao=NULL;}
		$obspgtoacao = $this->input->post('obspgtoacao');
		if($obspgtoacao==""){$obspgtoacao = NULL;}else{$obspgtoacao=strtoupper($obspgtoacao);}
		$data = array(
			'AcaoId' => $IdAcao,
			'AuxFinanceiroId' => 3, //Devolução de pagamento de ação
			'Data' => $datapgtoacao,
			'Valor' => $valorpgtoacao,
			'Observacao' => $obspgtoacao
		);
		//print_r($data);
		$this->Mfinanceiro->add_pgto_acoes($data);
		$redirecionamento = "/cfinanceiro/devpagamentoacoes/".$IdAcao;
		redirect($redirecionamento);
	}

	function createdepositojud(){
		$IdAcao = $this->input->post('acaoid');
		$datapgtoacao = $this->input->post('datapgtoacao');
		if($datapgtoacao!=""){
			$ano = substr($datapgtoacao, 0,4);
			$mes = substr($datapgtoacao, 5,2);
			$dia =  substr($datapgtoacao, 8,2);
			$datapgtoacao = $mes.'-'.$dia.'-'.$ano;
		}else {$datapgtoacao = NULL;}
		$valorpgtoacao = $this->input->post('valorpgtoacao');
		if($valorpgtoacao != ""){
			$valorpgtoacao = str_replace(".", "", $valorpgtoacao);
			$valorpgtoacao = str_replace(",", ".", $valorpgtoacao);
			$valorpgtoacao = floatval($valorpgtoacao);
		}else{$valorpgtoacao=NULL;}
		$obspgtoacao = $this->input->post('obspgtoacao');
		if($obspgtoacao==""){$obspgtoacao = NULL;}else{$obspgtoacao=strtoupper($obspgtoacao);}
		$data = array(
			'AcaoId' => $IdAcao,
			'AuxFinanceiroId' => 4, //Depósitos judiciais
			'Data' => $datapgtoacao,
			'Valor' => $valorpgtoacao,
			'Observacao' => $obspgtoacao
		);
		//print_r($data);
		$this->Mfinanceiro->add_pgto_acoes($data);
		$redirecionamento = "/cfinanceiro/depositosjudiciais/".$IdAcao;
		redirect($redirecionamento);
	}

	function createdepositojudcmonet(){
	    $IdAcao = $this->input->post('acaoid');
	    $datapgtoacao = $this->input->post('datapgtoacao');
	    if($datapgtoacao!=""){
	        $ano = substr($datapgtoacao, 0,4);
	        $mes = substr($datapgtoacao, 5,2);
	        $dia =  substr($datapgtoacao, 8,2);
	        $datapgtoacao = $mes.'-'.$dia.'-'.$ano;
	    }else {$datapgtoacao = NULL;}
	    $valorpgtoacao = $this->input->post('valorpgtoacao');
	    if($valorpgtoacao != ""){
	        $valorpgtoacao = str_replace(".", "", $valorpgtoacao);
	        $valorpgtoacao = str_replace(",", ".", $valorpgtoacao);
	        $valorpgtoacao = floatval($valorpgtoacao);
	    }else{$valorpgtoacao=NULL;}
	    $obspgtoacao = $this->input->post('obspgtoacao');
	    if($obspgtoacao==""){$obspgtoacao = NULL;}else{$obspgtoacao=strtoupper($obspgtoacao);}
	    $data = array(
	        'AcaoId' => $IdAcao,
	        'AuxFinanceiroId' => 13, //Depósitos judiciais correção monetária
	        'Data' => $datapgtoacao,
	        'Valor' => $valorpgtoacao,
	        'Observacao' => $obspgtoacao
	    );
	    //print_r($data);
	    $this->Mfinanceiro->add_pgto_acoes($data);
	    $redirecionamento = "/cfinanceiro/depositosjudcorrecaomonet/".$IdAcao;
	    redirect($redirecionamento);
	}

	function createdepositojudconvolados(){
		$IdAcao = $this->input->post('acaoid');
		$datapgtoacao = $this->input->post('datapgtoacao');
		if($datapgtoacao!=""){
			$ano = substr($datapgtoacao, 0,4);
			$mes = substr($datapgtoacao, 5,2);
			$dia =  substr($datapgtoacao, 8,2);
			$datapgtoacao = $mes.'-'.$dia.'-'.$ano;
		}else {$datapgtoacao = NULL;}
		$valorpgtoacao = $this->input->post('valorpgtoacao');
		if($valorpgtoacao != ""){
			$valorpgtoacao = str_replace(".", "", $valorpgtoacao);
			$valorpgtoacao = str_replace(",", ".", $valorpgtoacao);
			$valorpgtoacao = floatval($valorpgtoacao);
		}else{$valorpgtoacao=NULL;}
		$obspgtoacao = $this->input->post('obspgtoacao');
		if($obspgtoacao==""){$obspgtoacao = NULL;}else{$obspgtoacao=strtoupper($obspgtoacao);}
		$data = array(
			'AcaoId' => $IdAcao,
			'AuxFinanceiroId' => 5, //Depósitos judiciais convolados
			'Data' => $datapgtoacao,
			'Valor' => $valorpgtoacao,
			'Observacao' => $obspgtoacao
		);
		//print_r($data);
		$this->Mfinanceiro->add_pgto_acoes($data);
		$redirecionamento = "/cfinanceiro/depositosjudconvolados/".$IdAcao;
		redirect($redirecionamento);
	}

	function createdepositojuddevolucoes(){
		$IdAcao = $this->input->post('acaoid');
		$datapgtoacao = $this->input->post('datapgtoacao');
		if($datapgtoacao!=""){
			$ano = substr($datapgtoacao, 0,4);
			$mes = substr($datapgtoacao, 5,2);
			$dia =  substr($datapgtoacao, 8,2);
			$datapgtoacao = $mes.'-'.$dia.'-'.$ano;
		}else {$datapgtoacao = NULL;}
		$valorpgtoacao = $this->input->post('valorpgtoacao');
		if($valorpgtoacao != ""){
			$valorpgtoacao = str_replace(".", "", $valorpgtoacao);
			$valorpgtoacao = str_replace(",", ".", $valorpgtoacao);
			$valorpgtoacao = floatval($valorpgtoacao);
		}else{$valorpgtoacao=NULL;}
		$obspgtoacao = $this->input->post('obspgtoacao');
		if($obspgtoacao==""){$obspgtoacao = NULL;}else{$obspgtoacao=strtoupper($obspgtoacao);}
		$data = array(
			'AcaoId' => $IdAcao,
			'AuxFinanceiroId' => 6, //Depósitos judiciais devoluções
			'Data' => $datapgtoacao,
			'Valor' => $valorpgtoacao,
			'Observacao' => $obspgtoacao
		);
		//print_r($data);
		$this->Mfinanceiro->add_pgto_acoes($data);
		$redirecionamento = "/cfinanceiro/depositosjuddevolucoes/".$IdAcao;
		redirect($redirecionamento);
	}

	function createdepositojudestornos(){
		$IdAcao = $this->input->post('acaoid');
		$datapgtoacao = $this->input->post('datapgtoacao');
		if($datapgtoacao!=""){
			$ano = substr($datapgtoacao, 0,4);
			$mes = substr($datapgtoacao, 5,2);
			$dia =  substr($datapgtoacao, 8,2);
			$datapgtoacao = $mes.'-'.$dia.'-'.$ano;
		}else {$datapgtoacao = NULL;}
		$valorpgtoacao = $this->input->post('valorpgtoacao');
		if($valorpgtoacao != ""){
			$valorpgtoacao = str_replace(".", "", $valorpgtoacao);
			$valorpgtoacao = str_replace(",", ".", $valorpgtoacao);
			$valorpgtoacao = floatval($valorpgtoacao);
		}else{$valorpgtoacao=NULL;}
		$obspgtoacao = $this->input->post('obspgtoacao');
		if($obspgtoacao==""){$obspgtoacao = NULL;}else{$obspgtoacao=strtoupper($obspgtoacao);}
		$data = array(
			'AcaoId' => $IdAcao,
			'AuxFinanceiroId' => 7, //Depósitos judiciais estornos
			'Data' => $datapgtoacao,
			'Valor' => $valorpgtoacao,
			'Observacao' => $obspgtoacao
		);
		//print_r($data);
		$this->Mfinanceiro->add_pgto_acoes($data);
		$redirecionamento = "/cfinanceiro/depositosjudestornos/".$IdAcao;
		redirect($redirecionamento);
	}

	function createbloqueiojud(){
		$IdAcao = $this->input->post('acaoid');
		$datapgtoacao = $this->input->post('datapgtoacao');
		if($datapgtoacao!=""){
			$ano = substr($datapgtoacao, 0,4);
			$mes = substr($datapgtoacao, 5,2);
			$dia =  substr($datapgtoacao, 8,2);
			$datapgtoacao = $mes.'-'.$dia.'-'.$ano;
		}else {$datapgtoacao = NULL;}
		$contabanco = $this->input->post('contabanco');
		$valorpgtoacao = $this->input->post('valorpgtoacao');
		if($valorpgtoacao != ""){
			$valorpgtoacao = str_replace(".", "", $valorpgtoacao);
			$valorpgtoacao = str_replace(",", ".", $valorpgtoacao);
			$valorpgtoacao = floatval($valorpgtoacao);
		}else{$valorpgtoacao=NULL;}
		$obspgtoacao = $this->input->post('obspgtoacao');
		if($obspgtoacao==""){$obspgtoacao = NULL;}else{$obspgtoacao=strtoupper($obspgtoacao);}
		$data = array(
			'AcaoId' => $IdAcao,
			'AuxFinanceiroId' => 8, //Bloqueios judiciais
			'Data' => $datapgtoacao,
			'Valor' => $valorpgtoacao,
			'Observacao' => $obspgtoacao,
			'ContaId' => $contabanco
		);
		//print_r($data);
		$this->Mfinanceiro->add_pgto_acoes($data);
		$redirecionamento = "/cfinanceiro/bloqueiosjud/".$IdAcao;
		redirect($redirecionamento);
	}

	function createbloqueiojudcmonet(){
	    $IdAcao = $this->input->post('acaoid');
	    $datapgtoacao = $this->input->post('datapgtoacao');
	    if($datapgtoacao!=""){
	        $ano = substr($datapgtoacao, 0,4);
	        $mes = substr($datapgtoacao, 5,2);
	        $dia =  substr($datapgtoacao, 8,2);
	        $datapgtoacao = $mes.'-'.$dia.'-'.$ano;
	    }else {$datapgtoacao = NULL;}
	    $contabanco = $this->input->post('contabanco');
	    $valorpgtoacao = $this->input->post('valorpgtoacao');
	    if($valorpgtoacao != ""){
	        $valorpgtoacao = str_replace(".", "", $valorpgtoacao);
	        $valorpgtoacao = str_replace(",", ".", $valorpgtoacao);
	        $valorpgtoacao = floatval($valorpgtoacao);
	    }else{$valorpgtoacao=NULL;}
	    $obspgtoacao = $this->input->post('obspgtoacao');
	    if($obspgtoacao==""){$obspgtoacao = NULL;}else{$obspgtoacao=strtoupper($obspgtoacao);}
	    $data = array(
	        'AcaoId' => $IdAcao,
	        'AuxFinanceiroId' => 14, //Bloqueios judiciais correção monetária
	        'Data' => $datapgtoacao,
	        'Valor' => $valorpgtoacao,
	        'Observacao' => $obspgtoacao,
	        'ContaId' => $contabanco
	    );
	    //print_r($data);
	    $this->Mfinanceiro->add_pgto_acoes($data);
	    $redirecionamento = "/cfinanceiro/bloqueiosjudcorrecaomonet/".$IdAcao;
	    redirect($redirecionamento);
	}

	function createbloqueiosjudconvolados(){
		$IdAcao = $this->input->post('acaoid');
		$datapgtoacao = $this->input->post('datapgtoacao');
		if($datapgtoacao!=""){
			$ano = substr($datapgtoacao, 0,4);
			$mes = substr($datapgtoacao, 5,2);
			$dia =  substr($datapgtoacao, 8,2);
			$datapgtoacao = $mes.'-'.$dia.'-'.$ano;
		}else {$datapgtoacao = NULL;}
		$valorpgtoacao = $this->input->post('valorpgtoacao');
		if($valorpgtoacao != ""){
			$valorpgtoacao = str_replace(".", "", $valorpgtoacao);
			$valorpgtoacao = str_replace(",", ".", $valorpgtoacao);
			$valorpgtoacao = floatval($valorpgtoacao);
		}else{$valorpgtoacao=NULL;}
		$obspgtoacao = $this->input->post('obspgtoacao');
		if($obspgtoacao==""){$obspgtoacao = NULL;}else{$obspgtoacao=strtoupper($obspgtoacao);}
		$data = array(
			'AcaoId' => $IdAcao,
			'AuxFinanceiroId' => 9, //Depósitos judiciais convolados
			'Data' => $datapgtoacao,
			'Valor' => $valorpgtoacao,
			'Observacao' => $obspgtoacao
		);
		//print_r($data);
		$this->Mfinanceiro->add_pgto_acoes($data);
		$redirecionamento = "/cfinanceiro/bloqueiosjudconvolados/".$IdAcao;
		redirect($redirecionamento);
	}

	function createbloqueiosjuddevolucoes(){
		$IdAcao = $this->input->post('acaoid');
		$datapgtoacao = $this->input->post('datapgtoacao');
		if($datapgtoacao!=""){
			$ano = substr($datapgtoacao, 0,4);
			$mes = substr($datapgtoacao, 5,2);
			$dia =  substr($datapgtoacao, 8,2);
			$datapgtoacao = $mes.'-'.$dia.'-'.$ano;
		}else {$datapgtoacao = NULL;}
		$valorpgtoacao = $this->input->post('valorpgtoacao');
		if($valorpgtoacao != ""){
			$valorpgtoacao = str_replace(".", "", $valorpgtoacao);
			$valorpgtoacao = str_replace(",", ".", $valorpgtoacao);
			$valorpgtoacao = floatval($valorpgtoacao);
		}else{$valorpgtoacao=NULL;}
		$obspgtoacao = $this->input->post('obspgtoacao');
		if($obspgtoacao==""){$obspgtoacao = NULL;}else{$obspgtoacao=strtoupper($obspgtoacao);}
		$data = array(
			'AcaoId' => $IdAcao,
			'AuxFinanceiroId' => 10, //Depósitos judiciais devoluções
			'Data' => $datapgtoacao,
			'Valor' => $valorpgtoacao,
			'Observacao' => $obspgtoacao
		);
		//print_r($data);
		$this->Mfinanceiro->add_pgto_acoes($data);
		$redirecionamento = "/cfinanceiro/bloqueiosjuddevolucoes/".$IdAcao;
		redirect($redirecionamento);
	}

	function createbloqueiosjudestornos(){
		$IdAcao = $this->input->post('acaoid');
		$datapgtoacao = $this->input->post('datapgtoacao');
		if($datapgtoacao!=""){
			$ano = substr($datapgtoacao, 0,4);
			$mes = substr($datapgtoacao, 5,2);
			$dia =  substr($datapgtoacao, 8,2);
			$datapgtoacao = $mes.'-'.$dia.'-'.$ano;
		}else {$datapgtoacao = NULL;}
		$valorpgtoacao = $this->input->post('valorpgtoacao');
		if($valorpgtoacao != ""){
			$valorpgtoacao = str_replace(".", "", $valorpgtoacao);
			$valorpgtoacao = str_replace(",", ".", $valorpgtoacao);
			$valorpgtoacao = floatval($valorpgtoacao);
		}else{$valorpgtoacao=NULL;}
		$obspgtoacao = $this->input->post('obspgtoacao');
		if($obspgtoacao==""){$obspgtoacao = NULL;}else{$obspgtoacao=strtoupper($obspgtoacao);}
		$data = array(
			'AcaoId' => $IdAcao,
			'AuxFinanceiroId' => 11, //Estornos de bloqueios judiciais
			'Data' => $datapgtoacao,
			'Valor' => $valorpgtoacao,
			'Observacao' => $obspgtoacao
		);
		//print_r($data);
		$this->Mfinanceiro->add_pgto_acoes($data);
		$redirecionamento = "/cfinanceiro/bloqueiosjudestornos/".$IdAcao;
		redirect($redirecionamento);
	}

	function createpagamentocustas(){
		$IdAcao = $this->input->post('acaoid');
		$datapgtoacao = $this->input->post('datapgtoacao');
		if($datapgtoacao!=""){
			$ano = substr($datapgtoacao, 0,4);
			$mes = substr($datapgtoacao, 5,2);
			$dia =  substr($datapgtoacao, 8,2);
			$datapgtoacao = $mes.'-'.$dia.'-'.$ano;
		}else {$datapgtoacao = NULL;}
		$valorpgtoacao = $this->input->post('valorpgtoacao');
		if($valorpgtoacao != ""){
			$valorpgtoacao = str_replace(".", "", $valorpgtoacao);
			$valorpgtoacao = str_replace(",", ".", $valorpgtoacao);
			$valorpgtoacao = floatval($valorpgtoacao);
		}else{$valorpgtoacao=NULL;}
		$obspgtoacao = $this->input->post('obspgtoacao');
		if($obspgtoacao==""){$obspgtoacao = NULL;}else{$obspgtoacao=strtoupper($obspgtoacao);}
		$data = array(
			'AcaoId' => $IdAcao,
			'AuxFinanceiroId' => 12, //Pagamento de custas
			'Data' => $datapgtoacao,
			'Valor' => $valorpgtoacao,
			'Observacao' => $obspgtoacao
		);
		//print_r($data);
		$this->Mfinanceiro->add_pgto_acoes($data);
		$redirecionamento = "/cfinanceiro/pagamentocustas/".$IdAcao;
		redirect($redirecionamento);
	}

	function buscafinanceirovlcindex(){
		$usuariolog = $this->session->userdata('usuario');
		$data['acoestipo'] = $this->Mjuridico->getAcoesTipo();
		$data['assuntos'] = $this->Mfinanceiro->getAssuntos();
		$data['idacaovlc'] = $this->uri->segment(3);
		$this->security->verifiyLogin('view_financeiro_busca_vlc_index.php',$data,$this->router->class,$this->router->method);
	}

	//function buscaNotaExplicativaRelatorioVLC(){
	function financeiroRelatorios(){
		$nome = $this->input->post('interessado');
			if($nome==""){$nome='NULL';}else{$nome="'$nome'";}
		$cpfcnpj = $this->input->post('cpfcnpj');
			if($cpfcnpj==""){$cpfcnpj='NULL';}
		$acoestipoid = $this->input->post('acaotipoid');
			if($acoestipoid==""){$acoestipoid='NULL';}
		$probperdaid = $this->input->post('probperdaid');
			if($probperdaid==""){$probperdaid='NULL';}
		$assuntoid = $this->input->post('assuntoid');
			if($assuntoid==""){$assuntoid='NULL';}
		$valorinicial = $this->input->post('valorini');
		if($valorinicial != ""){
			$valorinicial = str_replace(".", "", $valorinicial);
			$valorinicial = str_replace(",", ".", $valorinicial);
			$valorinicial = floatval($valorinicial);
		}else{$valorinicial=0;}
		$valorfinal = $this->input->post('valorfim'); if($valorfinal==""){$valorfinal='NULL';}
		if($valorfinal != ""){
			$valorfinal = str_replace(".", "", $valorfinal);
			$valorfinal = str_replace(",", ".", $valorfinal);
			$valorfinal = floatval($valorfinal);
		}else{$valorfinal=0;}
		
		$situacao = $this->input->post('situacao'); if($situacao==""){$situacao='NULL';}
		
		
		$chequevalbloq = $this->input->post('chequevalbloq');
		if($chequevalbloq=="null"){$chequevalbloq='NULL';}

		$chequevaldepositado = $this->input->post('chequevaldepositado'); 
		if($chequevaldepositado=="null"){$chequevaldepositado='NULL';}
		
		$conta = $this->input->post('conta'); if($conta==""){$conta='NULL';}
		
		$datacorte = $this->input->post('datacorte'); 
		$datacorteoriginal = $datacorte; 
		if($datacorteoriginal!=""){
	        $ano = substr($datacorteoriginal, 0,4);
	        $mes = substr($datacorteoriginal, 5,2);
	        $dia =  substr($datacorteoriginal, 8,2);
	        $datacorteoriginal = $dia.'/'.$mes.'/'.$ano;
	    }
	    $data['dtCorte'] = $datacorteoriginal;


		
		if($datacorte!=""){
	        $ano = substr($datacorte, 0,4);
	        $mes = substr($datacorte, 5,2);
	        $dia =  substr($datacorte, 8,2);
	        $datacorte = $ano.$mes.$dia;
	        $datacorte = "'".$datacorte."'";
	    }else {$datacorte = NULL;}


		$nomerelat = $this->input->post('nomerelat');
		$tiporelat = $this->input->post('tiporelat');
		// NE => PDF/EXCEL
		// VLC => PDF/EXCEL
		// DP => PDF/EXCEL
		// BJ => PDF/EXCEL		

		$this->load->library('session');
		$newdata = array( //permitir pegar no cabecalho os dados e repetir em todas as paginas.
			'dtCorte' => $datacorteoriginal,			
		);
		//print_r($newdata);
		$this->session->set_userdata($newdata);

		if(($nomerelat=='NE')&&($tiporelat=='PDF')){ //Nota explicativa .PDF
			$data['resultnotaexplic'] = $this->Mfinanceiro->getNotaExplicativa($nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte);
			$this->security->verifiyLogin('view_financeiro_relatorio_nota_ex_pdf.php',$data,$this->router->class,$this->router->method);
		}
		if(($nomerelat=='NE')&&($tiporelat=='EXCEL')){ //Nota explicativa .EXCEL
			$data['resultnotaexplic'] = $this->Mfinanceiro->getNotaExplicativa($nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte);
			$this->security->verifiyLogin('view_financeiro_relatorio_nota_ex_excel.php',$data,$this->router->class,$this->router->method);
		}
		if(($nomerelat=='VLC')&&($tiporelat=='PDF')){ //Relat VLC .PDF
			$data['resultvlc'] = $this->Mfinanceiro->getRelatorioVLC($nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte);
			//print_r($data['resultvlc']);
			$newdata = array( //exibir no header do relatorio
				'tipoacao' => $acoestipoid,
				'status' => $situacao
			);
			$this->session->set_userdata($newdata);
			$this->security->verifiyLogin('view_financeiro_relat_vlc_pdf.php',$data,$this->router->class,$this->router->method);
		}
		if(($nomerelat=='VLC')&&($tiporelat=='EXCEL')){ //Relat VLC .XLS (EXCEL)
			$data['resultvlc'] = $this->Mfinanceiro->getRelatorioVLC($nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte);
			//print_r($data['resultvlc']);
			$this->security->verifiyLogin('view_financeiro_relat_vlc_excel.php',$data,$this->router->class,$this->router->method);
		}
		if(($nomerelat=='DP')&&($tiporelat=='PDF')){ //Depósitos Judiciais PDF
			$data['resultvlc'] = $this->Mfinanceiro->getDepJudPDF($nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte);
			//$data['resultvlctotal'] = $this->Mfinanceiro->getDepJudPDFtotal($nome,$cpfcnpj,$probperdaid,$acoestipoid,$situacao,$chequevaldepositado);
			$this->security->verifiyLogin('view_financeiro_relat_dep_jud_pdf.php',$data,$this->router->class,$this->router->method);
		}
		if(($nomerelat=='DP')&&($tiporelat=='EXCEL')){ //Depósitos Judiciais EXCEL
			$data['resultvlc'] = $this->Mfinanceiro->getDepJudEXCEL($nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte);
			$this->security->verifiyLogin('view_financeiro_relat_dep_jud_excel.php',$data,$this->router->class,$this->router->method);
		}
		if(($nomerelat=='BJ')&&($tiporelat=='PDF')){ //Bloqueio Judicial PDF
			$data['resultvlc'] = $this->Mfinanceiro->getBloqJudPDF($nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte);
			$this->security->verifiyLogin('view_financeiro_relat_bloq_jud_pdf.php',$data,$this->router->class,$this->router->method);
		}
		if(($nomerelat=='BJ')&&($tiporelat=='EXCEL')){ //Bloqueio Judicial EXCEL
			$data['resultvlc'] = $this->Mfinanceiro->getBloqJudEXCEL($nome,$cpfcnpj,$assuntoid,$acoestipoid,$probperdaid,$valorinicial,$valorfinal,$situacao, $chequevalbloq,$chequevaldepositado,$datacorte);
			$this->security->verifiyLogin('view_financeiro_relat_bloq_jud_excel.php',$data,$this->router->class,$this->router->method);
		}
	}

	function delete(){
		$this->security->verifiyLogin('delete','Mfinanceiro',$this->router->class,$this->router->method);
	}

}
