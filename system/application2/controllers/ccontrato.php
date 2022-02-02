<?php
class Ccontrato extends Controller {

	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Mjuridico');
		$this->load->model('Mfinanceiro');
		$this->load->model('Mfuncionario');
		$this->load->model('Mmedicao');
		$this->load->model('Mcontrato');
		$this->load->model('Macaocivel');
		$this->load->model('Mempresa');

		//@@ADICIONAR EM TODAS AS P�GINAS PROTEGIDAS
		$this->load->library('security');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Pragma: no-cache");
	}

	function empresaindex(){ //CADASTRAR NOVA EMPRESA COM POPUP
		$data['cpfcnpjencontrado'] = $this->uri->segment(3);
		$this->security->verifiyLogin('view_buscaempresaAdd.php',$data,$this->router->class,$this->router->method);
	}

	function empresacreate(){
		$nome = $this->input->post('nome'); if($nome==""){$nome=NULL;}
		$cpfcnpj = $this->input->post('cpfcnpj'); if($cpfcnpj==""){$cpfcnpj=NULL;}

		//Verificar se usuário já está cadastrado.
		$data['verificaexiste'] = $this->Mempresa->getEmpresaExiste($cpfcnpj);
		$IdEmpresa='';
		foreach ($data['verificaexiste'] as $exist):
			$IdEmpresa = $exist->Id;
		endforeach;
		if($IdEmpresa==''){//Se não existir, efetua cadastro
			$data = array(
				'CNPJ' => $cpfcnpj,
				'RazaoSocial' => strtoupper($nome)
			);
			$this->Mempresa->addEmpresa($data);
			$data['IdRefReg'] = $this->Mempresa->getRegAtual();
			foreach ($data['IdRefReg'] as $item):
				 $IdEmpresa = $item->computed;
			endforeach;
			$data['mensagem'] = '1';
			$data['records'] = $this->Mempresa->searchPorId($IdEmpresa);
		}else if($IdEmpresa!=''){ //já existe, mostra menasgem e dados do interessado.
			$data['mensagem'] = '0';
			$data['records'] = $this->Mempresa->searchPorId($IdEmpresa);
		}
		$data['inicio'] = 0;
		$this->security->verifiyLogin('view_buscaempresa',$data,$this->router->class,$this->router->method);
	}

	function contratoindex(){
	    $data['auxlicitamod'] = $this->Mjuridico->getContratoModalidade();
	    $this->security->verifiyLogin('view_financ_contr_busca_index.php',$data,$this->router->class,$this->router->method);
	}

	function contratobuscaresult() {
	    $this->load->library('pagination');
	    if(isset($_POST['submit'])){
	        $por_pg = 0;
	        $contratonr = $this->input->post('contratonr'); if($contratonr==""){$contratonr='NULL';}else{$contratonr="'$contratonr'";}
	        $prnum = $this->input->post('prnum'); if($prnum==""){$prnum='NULL';} else{$prnum = preg_replace("/[^0-9]/", "", $prnum);}
	        $prsei = $this->input->post('prsei'); if($prsei==""){$prsei='NULL';} else{$prsei = preg_replace("/[^0-9]/", "", $prsei);}
	        $prazovigstatus = $this->input->post('prazovigstatus'); if($prazovigstatus==""){$prazovigstatus='NULL';}
	        $empresanome = $this->input->post('empresanome'); if($empresanome==""){$empresanome='NULL';}else{$empresanome="'$empresanome'";}
	        $licitanum = $this->input->post('licitanum'); if($licitanum==""){$licitanum='NULL';}
	        $modalidade = $this->input->post('licitaid'); if($modalidade==""){$modalidade='NULL';}
	        $diretoria = $this->input->post('diretoria'); if($diretoria==""){$diretoria='NULL';}
	        $objeto = $this->input->post('objeto'); if($objeto==""){$objeto='NULL';} else{$objeto="'$objeto'";}
					$anocontr = 'NULL'; // Adequanto busca diferente em contrato e financeiro contrato.

	        $newdata = array(
	            'contratonr' => $contratonr,
	            'prnum' => $prnum,
	            'prsei' => $prsei,
	            'prazovigstatus' => $prazovigstatus,
	            'empresanome' => $empresanome,
	            'licitanum' => $licitanum,
	            'modalidade' => $modalidade,
	            'diretoria' => $diretoria,
	            'objeto' => $objeto,
				'anocontr' => $anocontr // Adequanto busca diferente em contrato e financeiro contrato.
	        );
	        $this->session->set_userdata($newdata);
	    }else{
	        $por_pg = 1;
	        $contratonr = $this->session->userdata('contratonr');
	        $prnum = $this->session->userdata('prnum');
	        $prsei = $this->session->userdata('prsei');
	        $prazovigstatus = $this->session->userdata('prazovigstatus');
	        $empresanome = $this->session->userdata('empresanome');
	        $licitanum = $this->session->userdata('licitanum');
	        $modalidade = $this->session->userdata('modalidade');
	        $diretoria = $this->session->userdata('diretoria');
	        $objeto = $this->session->userdata('objeto');
			$anocontr = $this->session->userdata('anocontr'); // Adequanto busca diferente em contrato e financeiro contrato.
	    }
	    //CONGFIGURA
	    $config['uri_segment'] = '3';
	    $config['base_url'] = base_url().'ccontrato/contratobuscaresult/';
	    $config['per_page'] = '15';
	    $config['full_tag_open'] = '<div id="pagination">';
	    $config['full_tag_close'] = '</div>';
	    $config['first_link'] = 'Primeiro';
	    $config['last_link'] = '&Uacute;ltimo';
	    $config['next_link'] = 'Pr&oacute;ximo';
	    $config['prev_link'] = 'Anterior';

	    $totalLinhas = $this->Mjuridico->getContratosQtd($contratonr,$prnum,$empresanome,$modalidade,$licitanum,$diretoria,$objeto,$prazovigstatus,$prsei,$anocontr);
	    $totalLinhas2 = 0;

	    foreach($totalLinhas as $row):
	       $totalLinhas2 = $row->QTD;
	    endforeach;
	    $config['total_rows'] = $totalLinhas2;
	    $this->pagination->initialize($config);
	    $data = array();
	    $data['total_linhas'] = $totalLinhas2; //para exibir na view o total de registros encontrados.

	    $per_page = $this->uri->segment(3)+15;
	    if($por_pg==0){ //Primeira pagina
	        $data['pagina'] = 0;
	    }
	    if($por_pg==1){ //Demais paginas.
	        $data['pagina'] = $this->uri->segment(3);
	    }
	    if($query = $this->Mjuridico->getContratosResult($contratonr,$prnum,$empresanome,$modalidade,$licitanum,$diretoria,$objeto,$prazovigstatus,$prsei,$anocontr,$per_page,$this->uri->segment(3))){
	        $data['contresult'] = $query;
	    }
	    $this->security->verifiyLogin('view_financ_contr_busca_result.php',$data,$this->router->class,$this->router->method);
	}

	function detailcontrato(){
	    $IdContrato = $this->uri->segment(3);
	    $data['contratodetail'] = $this->Mjuridico->getContratoDetail($IdContrato);
	    $data['medicoes'] = $this->Mjuridico->getContratoMedicoes($IdContrato);
	    $data['faturas'] = $this->Mjuridico->getContratoFaturas($IdContrato);
		$data['notasemp'] = $this->Mjuridico->getContratoNotaEmpenhos($IdContrato);
		$data['TermosDeApos'] = $this->Mjuridico->getTermosDeApostilamento($IdContrato);
	    $data['ordensbanc'] = $this->Mjuridico->getContratoOrdemBancarias($IdContrato);
		$data['lancamentos'] = $this->Mjuridico->getLancamentos($IdContrato);
		$data['bancos'] = $this->Mfinanceiro->getBancos();
		//$data['AuxTATipo'] = $this->Mjuridico->getAuxTATipo();
		//$data['AuxTADenominacao'] = $this->Mjuridico->getAuxTADenominacao();		
	    $this->security->verifiyLogin('view_financ_contr_detalhe.php',$data,$this->router->class,$this->router->method);
	}

	function editlancamento(){
	    $IdContrato = $this->uri->segment(3);
			$LancamentoId = $this->uri->segment(4);
	    $data['contratodetail'] = $this->Mjuridico->getContratoDetail($IdContrato);
	    $data['medicoes'] = $this->Mjuridico->getContratoMedicoes($IdContrato);
	    $data['faturas'] = $this->Mjuridico->getContratoFaturas($IdContrato);
	    $data['notasemp'] = $this->Mjuridico->getContratoNotaEmpenhos($IdContrato);
	    $data['ordensbanc'] = $this->Mjuridico->getContratoOrdemBancarias($IdContrato);
			$data['lancamentos'] = $this->Mjuridico->getLancamentos($IdContrato);
			$data['lancamentodetail'] = $this->Mjuridico->getLancamentoDetail($LancamentoId);
			$data['bancos'] = $this->Mfinanceiro->getBancos();
	    $this->security->verifiyLogin('view_financ_contr_lanc_edit.php',$data,$this->router->class,$this->router->method);
	}

	function updatedadosfin(){ // Dados financeiros do contrato.
		$contratoid = $this->input->post('contratoid');
		$siggo = $this->input->post('siggo');
		$programa = $this->input->post('programa');
		$fonterecursos = $this->input->post('fonterecursos');
		$naturezadespesa = $this->input->post('naturezadespesa');
		$banco = $this->input->post('banco');
		$contabancaria = $this->input->post('contabancaria');
		$numconvenio = $this->input->post('numconvenio');
		$ordemservico = $this->input->post('ordemservico');
		$ordemservicodata = $this->input->post('ordemservicodata');
		if($ordemservicodata!=""){
			$ano = substr($ordemservicodata, 0,4);
			$mes = substr($ordemservicodata, 5,2);
			$dia =  substr($ordemservicodata, 8,2);
			$ordemservicodata = $mes.'-'.$dia.'-'.$ano;
		}else {$ordemservicodata = NULL;}
		$data = array(
			'NaturezaDeDespesa' => $naturezadespesa,
			'FonteDeRecursos' => $fonterecursos,
			'SIGGO' => $siggo,
			'Programa' => $programa,
			'ContaBancariaBanco' => $banco,
			'ContaBancaria' => $contabancaria,
			'Convenio' => $numconvenio,
			'OrdemDeServico' => $ordemservico,
			'OrdemDeServicoData' => $ordemservicodata
		);
		$this->Mcontrato->update_contrato($contratoid,$data);
		$redirecionamento = "/ccontrato/detailcontrato/".$contratoid;
		redirect($redirecionamento);
	}


	function createmedicao(){
		$contratoid = $this->input->post('contratoid');
		$mednum = $this->input->post('mednumcad');
		$pradm = $this->input->post('pradmcad'); if($pradm==""){$pradm='NULL';} else{$pradm = preg_replace("/[^0-9]/", "", $pradm);}
		$datamed = $this->input->post('dataliqmedcad');
		if($datamed!=""){
			$ano = substr($datamed, 0,4);
			$mes = substr($datamed, 5,2);
			$dia =  substr($datamed, 8,2);
			$datamed = $mes.'-'.$dia.'-'.$ano;
		}else {$datamed = NULL;}
		$data = array(
			'ContratoId' => $contratoid,
			'Numero' => $mednum,
			'ProcessoPagamento' => $pradm,
			'DataLiquidacao' => $datamed
		);
		$this->Mmedicao->add_medicao($data);
		$redirecionamento = "/ccontrato/detailcontrato/".$contratoid."#aba02";
		redirect($redirecionamento);
	}

	function savemedicao(){
		$contratoid = $this->input->post('contratoid');
		$medicaoid = $this->input->post('medicaoid');
		$mednum = $this->input->post('mednum');
		$pradm = $this->input->post('pradm'); if($pradm==""){$pradm='NULL';} else{$pradm = preg_replace("/[^0-9]/", "", $pradm);}
		$datamed = $this->input->post('dataliqmed');
		if($datamed!=""){
			$ano = substr($datamed, 0,4);
			$mes = substr($datamed, 5,2);
			$dia =  substr($datamed, 8,2);
			$datamed = $mes.'-'.$dia.'-'.$ano;
		}else {$datamed = NULL;}
		$data = array(
			'ContratoId' => $contratoid,
			'Numero' => $mednum,
			'ProcessoPagamento' => $pradm,
			'DataLiquidacao' => $datamed
		);
		$this->Mmedicao->update_medicao($medicaoid,$data);
		$redirecionamento = "/ccontrato/detailcontrato/".$contratoid."#aba02";
		redirect($redirecionamento);
	}

	public function getMedicaoAjax($IdMedic){
	  $data = $this->Mmedicao->getMedicaoDetail($IdMedic);
		echo json_encode($data);
	}

	public function upDateValor(){
		print_r($data);
	}


	function delete(){
		$this->security->verifiyLogin('delete','Mfinanceiro',$this->router->class,$this->router->method);
	}

}
