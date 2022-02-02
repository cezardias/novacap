<?php
class Cacaocivel extends Controller {

	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Mjuridico');
		$this->load->model('Macaocivel');
		$this->load->model('Mfuncionario');

		//@@ADICIONAR EM TODAS AS PAGINAS PROTEGIDAS
		$this->load->library('security');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Pragma: no-cache");
	}

	function addacaocivel(){
		$usuariolog = $this->session->userdata('usuario');
		$data['advogados'] = $this->Mjuridico->getAdvogados();
		$data['advlogado'] = $this->Mjuridico->getAdvLogado($usuariolog);
		$data['auxandamentos'] = $this->Macaocivel->getAuxAndamento();
		$data['auxandamentotodos'] = $this->Mjuridico->getAuxAndamentoTodos(); //Civel e Trabalhista para o Detail
		$data['acoestipo'] = $this->Mjuridico->getAcoesTipo();
		$data['assuntos'] = $this->Macaocivel->getAssuntos();
		$data['varas'] = $this->Macaocivel->getAuxVaras();
		$data['auxvalorestipo'] = $this->Macaocivel->getAuxValoresTipo();
		$this->security->verifiyLogin('view_acao_civel_add.php',$data,$this->router->class,$this->router->method);
	}

	function buscacaocivelindex(){
		$usuariolog = $this->session->userdata('usuario');
		$data['assuntos'] = $this->Macaocivel->getAssuntos();
		$data['advogados'] = $this->Mjuridico->getAdvogados();
		$data['advlogado'] = $this->Mjuridico->getAdvLogado($usuariolog);
		$data['varas'] = $this->Macaocivel->getAuxVaras();
		$data['acoestipo'] = $this->Mjuridico->getAcoesTipo();
		$data['auxandamentos'] = $this->Macaocivel->getAuxAndamento();
		$data['auxandamentotodos'] = $this->Mjuridico->getAuxAndamentoTodos(); //Civel e Trabalhista para o Detail
		$usuariolog = $this->session->userdata('usuario');
		$this->security->verifiyLogin('view_acao_civel_busca_index.php',$data,$this->router->class,$this->router->method);
	}

	function buscacaocivelresult(){
		$newdata = array(
			'btnvoltar' => 'buscacaocivelresult' //voltar para busca de a��o a partir de um detail
			);
		$this->session->set_userdata($newdata);

		$this->load->library('pagination');
		if(isset($_POST['submit'])){
			$por_pg = 0;
			$interesado = $this->input->post('Interesadonome');
			if($interesado==""){$interesado='NULL';} else{$interesado="'$interesado'";} //'' para campos texto
			$cpfcnpj = $this->input->post('cpfcnpj');
			if($cpfcnpj==""){$cpfcnpj='NULL';}
			$prjudnum = $this->input->post('prjudnum');
			if($prjudnum==""){$prjudnum='NULL';} else{$prjudnum = preg_replace("/[^0-9]/", "", $prjudnum);}//Somente números
			$pradmnum = $this->input->post('pradm');
			if($pradmnum==""){$pradmnum='NULL';}else{$pradmnum = preg_replace("/[^0-9]/", "", $pradmnum);}//Somente números
			$prcnj = $this->input->post('prcnj');
			if($prcnj==""){$prcnj='NULL';}else{$prcnj = preg_replace("/[^0-9]/", "", $prcnj);}//Somente números
			$assuntoid = $this->input->post('assuntoid'); if($assuntoid==""){$assuntoid='NULL';}
			$advogadoid = $this->input->post('advogadoid');	if($advogadoid==""){$advogadoid='NULL';}
			$varaid = $this->input->post('varaid');	if($varaid==""){$varaid='NULL';}
			$obsbusca = $this->input->post('obsbusca');
			if($obsbusca==""){$obsbusca='NULL';} else{$prjudnum="'$obsbusca'";}
			$statusprocessoid = $this->input->post('statusprocessoid');if($statusprocessoid==""){$statusprocessoid='NULL';}
			$andamentoid = $this->input->post('andamentoid');if($andamentoid==""){$andamentoid='NULL';}
			$posicaonovacap = $this->input->post('posicaonovacap');if($posicaonovacap==""){$posicaonovacap='NULL';}
			$dtajuizamentoini = $this->input->post('dtajuizamentoini');
			if($dtajuizamentoini!=""){
				$diadoc = substr($dtajuizamentoini, 0,2);
				$mesdoc = substr($dtajuizamentoini, 3,2);
				$anodoc =  substr($dtajuizamentoini, 6,4);
				$dtajuizamentoini = $mesdoc.'-'.$diadoc.'-'.$anodoc;
				$dtajuizamentoini = "'$dtajuizamentoini'";
			}else {$dtajuizamentoini = 'NULL';}
			$dtajuizamentofim = $this->input->post('dtajuizamentofim');
			if($dtajuizamentofim!=""){
				$diadoc = substr($dtajuizamentofim, 0,2);
				$mesdoc = substr($dtajuizamentofim, 3,2);
				$anodoc =  substr($dtajuizamentofim, 6,4);
				$dtajuizamentofim = $mesdoc.'-'.$diadoc.'-'.$anodoc;
				$dtajuizamentofim = "'$dtajuizamentofim'";
			}else {$dtajuizamentofim = 'NULL';}
			$dtextincaoini = $this->input->post('dtextincaoini');
			if($dtextincaoini!=""){
				$diadoc = substr($dtextincaoini, 0,2);
				$mesdoc = substr($dtextincaoini, 3,2);
				$anodoc =  substr($dtextincaoini, 6,4);
				$dtextincaoini = $mesdoc.'-'.$diadoc.'-'.$anodoc;
				$dtextincaoini = "'$dtextincaoini'";
			}else {$dtextincaoini = 'NULL';}
			$dtextincaofim = $this->input->post('dtextincaofim');
			if($dtextincaofim!=""){
				$diadoc = substr($dtextincaofim, 0,2);
				$mesdoc = substr($dtextincaofim, 3,2);
				$anodoc =  substr($dtextincaofim, 6,4);
				$dtextincaofim = $mesdoc.'-'.$diadoc.'-'.$anodoc;
				$dtextincaofim = "'$dtextincaofim'";
			}else {$dtextincaofim = 'NULL';}
			$prsei = $this->input->post('prsei');
			if($prsei==""){$prsei='NULL';} else{$prsei = preg_replace("/[^0-9]/", "", $prsei);}
			$dtinclusaoini = $this->input->post('dtinclusaoini');
			if($dtinclusaoini!=""){
				$diadoc = substr($dtinclusaoini, 0,2);
				$mesdoc = substr($dtinclusaoini, 3,2);
				$anodoc =  substr($dtinclusaoini, 6,4);
				$dtinclusaoini = $mesdoc.'-'.$diadoc.'-'.$anodoc;
				$dtinclusaoini = "'$dtinclusaoini'";
			}else {$dtinclusaoini = 'NULL';}
			$dtinclusaofim = $this->input->post('dtinclusaofim');
			if($dtinclusaofim!=""){
				$diadoc = substr($dtinclusaofim, 0,2);
				$mesdoc = substr($dtinclusaofim, 3,2);
				$anodoc =  substr($dtinclusaofim, 6,4);
				$dtinclusaofim = $mesdoc.'-'.$diadoc.'-'.$anodoc;
				$dtinclusaofim = "'$dtinclusaofim'";
			}else {$dtinclusaofim = 'NULL';}

			$newdata = array(
				'Interesadonome' => $interesado,
				'cpfcnpj' => $cpfcnpj,
				'prcnj' => $prcnj,
				'pradmnum' => $pradmnum,
				'prjudnum' => $prjudnum,
				'assuntoid' => $assuntoid,
				'advogadoid' => $advogadoid,
				'varaid' => $varaid,
				'obsbusca' => $obsbusca,
				'statusprocessoid' => $statusprocessoid,
				'andamentoid' => $andamentoid,
				'posicaonovacap' => $posicaonovacap,
				'dtajuizamentoini' => $dtajuizamentoini,
				'dtajuizamentofim' => $dtajuizamentofim,
				'dtextincaoini' => $dtextincaoini,
			    'dtextincaofim' => $dtextincaofim,
				'dtinclusaoini' => $dtinclusaoini,
			    'dtinclusaofim' => $dtinclusaofim,				
			    'prsei' => $prsei
			);
			$this->session->set_userdata($newdata);
		}
		else{
			$por_pg = 1;
			$interesado = $this->session->userdata('Interesadonome');
			$cpfcnpj = $this->session->userdata('cpfcnpj');
			$prcnj = $this->session->userdata('prcnj');
			$pradmnum = $this->session->userdata('pradmnum');
			$prjudnum = $this->session->userdata('prjudnum');
			$assuntoid = $this->session->userdata('assuntoid');
			$advogadoid	= $this->session->userdata('advogadoid');
			$varaid	= $this->session->userdata('varaid');
			$obsbusca = $this->session->userdata('obsbusca');
			$statusprocessoid = $this->session->userdata('statusprocessoid');
			$andamentoid = $this->session->userdata('andamentoid');
			$posicaonovacap = $this->session->userdata('posicaonovacap');
			$dtajuizamentoini = $this->session->userdata('dtajuizamentoini');
			$dtajuizamentofim = $this->session->userdata('dtajuizamentofim');
			$dtextincaoini = $this->session->userdata('dtextincaoini');
			$dtextincaofim = $this->session->userdata('dtextincaofim');
			$dtinclusaoini = $this->session->userdata('dtinclusaoini');
			$dtinclusaofim = $this->session->userdata('dtinclusaofim');			
			$prsei = $this->session->userdata('prsei');
		}
		//CONGFIGURAÇÕES
		$config['uri_segment'] = '3';
		$config['base_url'] = base_url().'cacaocivel/buscacaocivelresult/';
		$config['per_page'] = '15';
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['first_link'] = 'Primeiro';
		$config['last_link'] = 'Último';
		$config['next_link'] = 'Próximo';
		$config['prev_link'] = 'Anterior';

		$totalLinhas = $this->Macaocivel->getAcoesQtd($interesado,$prcnj,$pradmnum,$prjudnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim);
		$totalLinhas2 = 0;

		foreach($totalLinhas as $row):
			$totalLinhas2 = $row->QTD;
		endforeach;
		$config['total_rows'] = $totalLinhas2;
		echo $this->pagination->initialize($config);
		$data = array();
		$data['total_linhas'] = $totalLinhas2; //para exibir na view o total de registros encontrados.

		$per_page = $this->uri->segment(3)+15;
		if($por_pg==0){ //Primeira pagina
			$data['pagina'] = 0;
		}
		if($por_pg==1){ //Demais paginas.
			$data['pagina'] = $this->uri->segment(3);
		}
		if($query = $this->Macaocivel->getAcoesResult($interesado,$prcnj,$pradmnum,$prjudnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim,$per_page,$this->uri->segment(3))){
			$data['docresult'] = $query;
		}
		//print_r($data);
		$this->security->verifiyLogin('view_acao_civel_busca_result.php',$data,$this->router->class,$this->router->method);
	}

	function geraexcel(){
		$interesado = $this->session->userdata('Interesadonome');
		$cpfcnpj = $this->session->userdata('cpfcnpj');
		$prcnj = $this->session->userdata('prcnj');
		$pradmnum = $this->session->userdata('pradmnum');
		$prjudnum = $this->session->userdata('prjudnum');
		$assuntoid = $this->session->userdata('assuntoid');
		$advogadoid	= $this->session->userdata('advogadoid');
		$varaid	= $this->session->userdata('varaid');
		$obsbusca = $this->session->userdata('obsbusca');
		$statusprocessoid = $this->session->userdata('statusprocessoid');
		$andamentoid = $this->session->userdata('andamentoid');
		$posicaonovacap = $this->session->userdata('posicaonovacap');
		$dtajuizamentoini = $this->session->userdata('dtajuizamentoini');
		$dtajuizamentofim = $this->session->userdata('dtajuizamentofim');
		$dtextincaoini = $this->session->userdata('dtextincaoini');
		$dtextincaofim = $this->session->userdata('dtextincaofim');
		$dtinclusaoini = $this->session->userdata('dtinclusaoini');
		$dtinclusaofim = $this->session->userdata('dtinclusaofim');			
		$prsei = $this->session->userdata('prsei');

		$data['docresult'] = $this->Macaocivel->getAcoesExcel($interesado,$prcnj,$pradmnum,$prjudnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim);
		$this->security->verifiyLogin('view_acao_civel_excel.php',$data,$this->router->class,$this->router->method);
	}

	function buscaudienciaindex(){
		$data['acoestipo'] = $this->Mjuridico->getAcoesTipo();
		$data['advogados'] = $this->Mjuridico->getAdvogados();
		$data['tipoaudiencia'] = $this->Mjuridico->getTipoAudiencia();
		$data['varas'] = $this->Mjuridico->getVaras();
		$data['auxvalorestipo'] = $this->Macaocivel->getAuxValoresTipo();
		$this->security->verifiyLogin('view_busca_audiencia_index.php',$data,$this->router->class,$this->router->method);
	}

	function parteinteressadoindex(){
		$data['cpfcnpjencontrado'] = $this->uri->segment(3);
		$this->security->verifiyLogin('view_interessado_parte_index.php',$data,$this->router->class,$this->router->method);
	}

	function createparteinteressado(){
		$nome = $this->input->post('nome'); if($nome==""){$nome=NULL;}
		$cpfcnpj = $this->input->post('cpfcnpj'); if($cpfcnpj==""){$cpfcnpj=NULL;}
		$Tipo = $this->input->post('Tipo'); if($Tipo==""){$Tipo=NULL;}
		$Matricula = $this->input->post('Matricula'); if($Matricula==""){$Matricula=NULL;}
		$Endereco = $this->input->post('Endereco'); if($Endereco==""){$Endereco=NULL;}
		$Complemento = $this->input->post('Complemento'); if($Complemento==""){$Complemento=NULL;}
		$Bairro = $this->input->post('Bairro'); if($Bairro==""){$Bairro=NULL;}
		$Municipio = $this->input->post('Municipio'); if($Municipio==""){$Municipio=NULL;}
		$UF = $this->input->post('UF'); if($UF==""){$UF=NULL;}
		$CEP = $this->input->post('CEP'); if($CEP==""){$CEP=NULL;}
		$Telefone = $this->input->post('Telefone'); if($Telefone==""){$Telefone=NULL;}

		//Verificar se usuario ja esta cadastrado.
		$data['verificaexiste'] = $this->Macaocivel->getUsuarioExiste($cpfcnpj);
		foreach ($data['verificaexiste'] as $exist):
			$IdServidor = $exist->Id;
			$Existe = $exist->Resultado;
		endforeach;
		if($Existe==0){//Se nao existir, efetua cadastro
			$data['IdRefReg'] = $this->Macaocivel->add_parte_interessado($Tipo,$nome,$cpfcnpj,$Matricula,$Endereco,$Complemento,$Bairro,$Municipio,$UF,$CEP,$Telefone);
			foreach ($data['IdRefReg'] as $item):
				$IdServidor = $item->Id; //Servidor que acabou de ser gravado.
			endforeach;
			$data['mensagem'] = '1';
			$data['records'] = $this->Mfuncionario->searchPorId($IdServidor);
		}else if($Existe==1){ //já existe, mostra menasgem e dados do interessado.
			$data['mensagem'] = '0';
			$data['records'] = $this->Mfuncionario->searchPorId($IdServidor);
		}
		$data['inicio'] = 0;
		$this->security->verifiyLogin('view_buscafuncionario',$data,$this->router->class,$this->router->method);
	}

	function detailacaocivel(){
		$IdAcao = $this->uri->segment(3);
		$usuariolog = $this->session->userdata('usuario');
		$data['acaodetail'] = $this->Mjuridico->getAcaoDetail($IdAcao);
		$data['advogados'] = $this->Mjuridico->getAdvogados();
		//$data['sentencadata'] = $this->Mjuridico->getAcaoDetail();
		$data['advlogado'] = $this->Mjuridico->getAdvLogado($usuariolog);
		$data['interessados'] = $this->Mjuridico->getInteressados($IdAcao);
		$data['auxandamentotodos'] = $this->Mjuridico->getAuxAndamentoTodos(); //Civel e Trabalhista para o Detail
		$data['andamentorecente'] = $this->Mjuridico->getAndamentoRecente($IdAcao);
		$data['andamentos'] = $this->Mjuridico->getAndamentosAcao($IdAcao);
		$data['interessadoacao'] = $this->Mjuridico->getInteressadoAcao($IdAcao);
		$data['acao_assuntos'] = $this->Mjuridico->getAcaoAssuntos($IdAcao);
		$data['audiencias'] = $this->Mjuridico->getAudiencias($IdAcao);
		$data['advogadoalteraprazo'] = $this->Mjuridico->getAdvogadoAlteraPrazo($IdAcao);
		$data['auxandamentos'] = $this->Macaocivel->getAuxAndamento();		
		$data['acoestipo'] = $this->Mjuridico->getAcoesTipo();
		$data['varas'] = $this->Macaocivel->getAuxVaras();
		$data['assuntos'] = $this->Macaocivel->getAssuntos();
		$data['tipoaudiencia'] = $this->Mjuridico->getTipoAudiencia();
		$data['prazos'] = $this->Mjuridico->getPrazos($IdAcao);
		$data['auxvalorestipo'] = $this->Macaocivel->getAuxValoresTipo();
		$this->security->verifiyLogin('view_acao_civel_detail.php',$data,$this->router->class,$this->router->method);
	}

	function solautprocessoresult(){ //mesmo nome em civel, mas aponta pra views diferentes, jur/civel
		$data['detailautuacao'] = $this->Macaocivel->getCodSisprot($this->uri->segment(3));
		$this->security->verifiyLogin('view_relat_aut_processo_civel.php',$data,$this->router->class,$this->router->method);
	}

	function relatacaocivel(){
		$IdAcao = $this->uri->segment(3);
		$usuariolog = $this->session->userdata('usuario');
		$data['acaodetail'] = $this->Mjuridico->getAcaoDetail($IdAcao);
		$data['advogados'] = $this->Mjuridico->getAdvogados();
		$data['advlogado'] = $this->Mjuridico->getAdvLogado($usuariolog);
		$data['interessados'] = $this->Mjuridico->getInteressados();
		//$data['interessadoEoutros'] = $this->Mjuridico->getInteressadoEoutros($IdAcao);
		$data['interessadoacao'] = $this->Mjuridico->getInteressadoAcao($IdAcao);
		$data['auxandamentos'] = $this->Macaocivel->getAuxAndamento();
		$data['auxandamentotodos'] = $this->Mjuridico->getAuxAndamentoTodos(); //Civel e Trabalhista para o Detail
		$data['andamentorecente'] = $this->Mjuridico->getAndamentoRecente($IdAcao);
		$data['andamentos'] = $this->Mjuridico->getAndamentosAcao($IdAcao);
		$data['acoestipo'] = $this->Mjuridico->getAcoesTipo();
		$data['varas'] = $this->Macaocivel->getAuxVaras();
		$data['assuntos'] = $this->Macaocivel->getAssuntos();
		$data['acao_assuntos'] = $this->Mjuridico->getAcaoAssuntos($IdAcao);
		$data['audiencias'] = $this->Mjuridico->getAudiencias($IdAcao);
		$data['tipoaudiencia'] = $this->Mjuridico->getTipoAudiencia();
		$data['prazos'] = $this->Mjuridico->getPrazos($IdAcao);
		$data['auxvalorestipo'] = $this->Macaocivel->getAuxValoresTipo();
		$data['valorestipo'] = $this->Macaocivel->getAuxValoresTipo();
		$this->security->verifiyLogin('view_relatorio_acao_civel.php',$data,$this->router->class,$this->router->method);
	}

	function editacaocivel(){
		$IdAcao = $this->uri->segment(3);
		$usuariolog = $this->session->userdata('usuario');
		$data['nivelacesso'] = $this->Mjuridico->getNivelAcesso($usuariolog);
		$data['acaodetail'] = $this->Mjuridico->getAcaoDetail($IdAcao);
		$data['assuntos'] = $this->Macaocivel->getAssuntos();
		$data['advogados'] = $this->Mjuridico->getAdvogados();
		//$data['interessadoEoutros'] = $this->Mjuridico->getInteressadoEoutros($IdAcao);
		$data['acoestipo'] = $this->Mjuridico->getAcoesTipo();
		$data['auxandamentos'] = $this->Macaocivel->getAuxAndamento();
		$data['auxandamentotodos'] = $this->Mjuridico->getAuxAndamentoTodos(); //Civel e Trabalhista para o Detail
		$data['varas'] = $this->Macaocivel->getAuxVaras();
		$data['auxvalorestipo'] = $this->Macaocivel->getAuxValoresTipo();
		//$data['tiporeu'] = $this->Macaocivel->getTipoReu($IdAcao);
		$this->security->verifiyLogin('view_acao_civel_edit.php',$data,$this->router->class,$this->router->method);
	}

	function editaudienciacivel(){
		$_SESSION['redirect'] = $this->uri->segment(5); //EditVoltaBuscaAudi se veio da busca por audiencias.
		$IdAcao = $this->uri->segment(3);
		$IdRegAud = $this->uri->segment(4);
		$Flag = $this->uri->segment(5);
		$usuariolog = $this->session->userdata('usuario');
		$data['flag'] = $Flag;
		$data['audienciadetail'] = $this->Mjuridico->getAudienciaDetail($IdRegAud);
		$data['tipoaudiencia'] = $this->Mjuridico->getTipoAudiencia();
		$data['auxvalorestipo'] = $this->Macaocivel->getAuxValoresTipo();
		$this->security->verifiyLogin('view_audiencia_edit_civel.php',$data,$this->router->class,$this->router->method);
	}

	function editandamentocivel(){
		$IdAcao = $this->uri->segment(3);
		$IdRegAnd = $this->uri->segment(4);
		$Flag = $this->uri->segment(5);
		$usuariolog = $this->session->userdata('usuario');
		$data['flag'] = $Flag;
		$data['andamentodetail'] = $this->Mjuridico->getAndamentoDetail($IdRegAnd);
		$data['auxandamentos'] = $this->Macaocivel->getAuxAndamento();
		$data['auxandamentotodos'] = $this->Mjuridico->getAuxAndamentoTodos(); //Civel e Trabalhista para o Detail
		$data['auxvalorestipo'] = $this->Macaocivel->getAuxValoresTipo();
		$this->security->verifiyLogin('view_andamento_edit_civel.php',$data,$this->router->class,$this->router->method);
	}

	function editprazocivel(){
		$_SESSION['redirect'] = $this->uri->segment(5); //EditVoltaBuscaAudi se veio da busca por audi�ncias.
		$IdAcao = $this->uri->segment(3);
		$IdPrazo = $this->uri->segment(4);
		$Flag = $this->uri->segment(5);
		$usuariolog = $this->session->userdata('usuario');
		$data['flag'] = $Flag;
		$data['prazodetail'] = $this->Mjuridico->getPrazoDetail($IdPrazo);
		$data['auxvalorestipo'] = $this->Macaocivel->getAuxValoresTipo();
		$this->security->verifiyLogin('view_prazo_edit_civel.php',$data,$this->router->class,$this->router->method);
	}

	function createacaocivel(){
		$newdata = array( //usar apra tomar decisao para onde voltar.
			'btnvoltar' => 'acaocivilcreate' //ressetar botao voltar caso tenha sido usado na busca.
		);
		$this->session->set_userdata($newdata);
		$prjud = $this->input->post('prjud_cnj'); if($prjud==""){$prjud=NULL;}else{$prjud = preg_replace("/[^0-9]/", "", $prjud);}
		$prpai = $this->input->post('prpai'); if($prpai==""){$prpai=NULL;}else{$prpai = preg_replace("/[^0-9]/", "", $prpai);}
		$prjudantigo = $this->input->post('prjudantigo'); if($prjudantigo==""){$prjudantigo=NULL;}//else{$prjudantigo = preg_replace("/[^0-9]/", "", $prjudantigo);}
		$pradm = $this->input->post('pradm'); if($pradm==""){$pradm=NULL;}else{$pradm = preg_replace("/[^0-9]/", "", $pradm);}
		$fundlegal = $this->input->post('fundlegal');  if($fundlegal==""){$fundlegal=NULL;}
		$calchomovalor = $this->input->post('calchomovalor');
		if($calchomovalor != ""){
			$calchomovalor = str_replace(".", "", $calchomovalor);
			$calchomovalor = str_replace(",", ".", $calchomovalor);
			$calchomovalor = floatval($calchomovalor);
		}else{$calchomovalor=0;}
		$calchomovalortipo = $this->input->post('calchomovalortipo');	if($calchomovalortipo==""){$calchomovalortipo=NULL;}
		$ValorEconomicoDoRisco = $this->input->post('ValorEconomicoDoRisco');
		if($ValorEconomicoDoRisco != ""){
			$ValorEconomicoDoRisco = str_replace(".", "", $ValorEconomicoDoRisco);
			$ValorEconomicoDoRisco = str_replace(",", ".", $ValorEconomicoDoRisco);
			$ValorEconomicoDoRisco = floatval($ValorEconomicoDoRisco);
		}else{$ValorEconomicoDoRisco=0;}
		$causavalor = $this->input->post('causavalor');
		if($causavalor != ""){
			$causavalor = str_replace(".", "", $causavalor);
			$causavalor = str_replace(",", ".", $causavalor);
			$causavalor = floatval($causavalor);
		}else{$causavalor=0;}
		$causavalortipo = $this->input->post('causavalortipo');	if($causavalortipo==""){$causavalortipo=NULL;}
		$sentencavalor = $this->input->post('sentencavalor');
			if($sentencavalor != ""){
			$sentencavalor = str_replace(".", "", $sentencavalor);
			$sentencavalor = str_replace(",", ".", $sentencavalor);
			$sentencavalor = floatval($sentencavalor);
		}else{$sentencavalor=0;}
		$sentensavalortipo = $this->input->post('sentensavalortipo'); if($sentensavalortipo==""){$sentensavalortipo=NULL;}
		$condenavalor = $this->input->post('condenavalor');
		if($condenavalor != ""){
			$condenavalor = str_replace(".", "", $condenavalor);
			$condenavalor = str_replace(",", ".", $condenavalor);
			$condenavalor = floatval($condenavalor);
		}else{$condenavalor=0;}
		$condenacaovalortipo = $this->input->post('condenacaovalortipo'); if($condenacaovalortipo==""){$condenacaovalortipo=NULL;}
		$acordamvalor = $this->input->post('acordamvalor');
		if($acordamvalor != ""){
			$acordamvalor = str_replace(".", "", $acordamvalor);
			$acordamvalor = str_replace(",", ".", $acordamvalor);
			$acordamvalor = floatval($condenavalor);
		}else{$acordamvalor=0;}
		$acordamvalortipo = $this->input->post('acordamvalortipo'); if($acordamvalortipo==""){$acordamvalortipo=NULL;}
		$varaid = $this->input->post('varaid'); if($varaid==""){$varaid=NULL;}
		$probabilidadeid = $this->input->post('probabilidadeid'); if($probabilidadeid==""){$probabilidadeid=NULL;}
		$observacao = $this->input->post('observacao');
		if($observacao==""){$observacao=NULL;}else{$observacao=="'$observacao'";}
		$statusprocessoid = $this->input->post('statusprocessoid'); if($statusprocessoid==""){$statusprocessoid=NULL;} else{$statusprocessoid=intval($statusprocessoid);}
		$dtajuizamento = $this->input->post('dtajuizamento');
		if($dtajuizamento!=""){
			$diadoc = substr($dtajuizamento, 0,2);
			$mesdoc = substr($dtajuizamento, 3,2);
			$anodoc =  substr($dtajuizamento, 6,4);
			$dtajuizamento = $mesdoc.'-'.$diadoc.'-'.$anodoc;
		}else {$dtajuizamento = NULL;}
		$dtextincao = $this->input->post('dtextincao');
		if($dtextincao!=""){
			$diadoc = substr($dtextincao, 0,2);
			$mesdoc = substr($dtextincao, 3,2);
			$anodoc =  substr($dtextincao, 6,4);
			$dtextincao = $mesdoc.'-'.$diadoc.'-'.$anodoc;
		}else {$dtextincao = NULL;}
		$sisprot = $this->input->post('sisprot'); if($sisprot==""){$sisprot=NULL;}
		$cxnum = $this->input->post('cxnum'); if($cxnum==""){$cxnum=NULL;}
		$palavraschave = $this->input->post('palavraschave');
		if($palavraschave==""){$palavraschave=NULL;}else{$palavraschave=="'$palavraschave'";}
		//$processopai = $this->input->post('processopai');
		//if($processopai==""){$processopai=NULL;}else{$processopai=="'$processopai'";}
		$posicaonovacap = $this->input->post('posicaonovacap'); if($posicaonovacap==""){$posicaonovacap=NULL;}
		$prsei = $this->input->post('prsei'); if($prsei==""){$prsei=NULL;}else{$prsei = preg_replace("/[^0-9]/", "", $prsei);}

		//VERIFICAR ANTES SE O PROCESSO J� EST� CADASTARDO.
		$data['processoexiste'] = $this->Macaocivel->getProcessoExsite($prjud);
		foreach ($data['processoexiste'] as $prEx):
			$PrExiste = $prEx->PrExiste;
		endforeach;
		if($PrExiste==0){//processo nao cadastrado
			$data = array(
				'AcaoTipoId' => 2, // Acao civel sempre 2.
				'ProcessoJudicialNumero' => $prjud,
				'VaraId' => $varaid,
				'ProcessoAdministrativoNumero' => $pradm,
				'CalculoHomologadoValor' => $calchomovalor,
				'ValorEconomicoDoRisco' => $ValorEconomicoDoRisco,
				'CalculoHomologadoValorTipo' => $calchomovalortipo,
				'CausaValor' => $causavalor,
				'ValorEconomicoDoRisco'=> $ValorEconomicoDoRisco,
				'SentencaValor' => $sentencavalor,
				'CondenacaoValor' => $condenavalor,
				'ProbabilidadeDePerdaId' => $probabilidadeid,
				'FundamentoLegal' => $fundlegal,
				'Observacoes' => $observacao,
				'Ativo' => $statusprocessoid,
				'Caixa' => $cxnum,
				'DataDoAjuizamento' => $dtajuizamento,
				'Sisprot' => $sisprot,
				'ProcessoJudicialNumeroAntigo' => $prjudantigo,
				'AcordaoValor' => $acordamvalor,
				'CausaValorTipo' => $causavalortipo,
				'SentencaValorTipo' => $sentensavalortipo,
				'CondenacaoValorTipo' => $condenacaovalortipo,
				'AcordaoValorTipo' => $acordamvalortipo,
				'DataDeExtincao' => $dtextincao,
				'PalavrasChave' => $palavraschave,
				'PosicaoNovacap' => $posicaonovacap,
				'ProcessoPai' => $prpai,
			  'SEI' => $prsei
			);
			$this->Macaocivel->add_acao_civel($data);
			$data['IdRefReg'] = $this->Macaocivel->getRegAtual();
			foreach ($data['IdRefReg'] as $item):
				$computed = $item->computed;
			endforeach;
			$redirecionamento = "/cacaocivel/detailacaocivel/".$computed."#tabs-1";
			redirect($redirecionamento);
		}else{ //processo ja cadastrado
			$redirecionamento = "/cacaocivel/procexiste/".$PrExiste.'/2';  //C�VEL e TRABALHISTA, enviar tamb�m o tipo de a��o
			redirect($redirecionamento);
		}
	}

	function saveacaocivel(){
		$IdAcao = $this->input->post('idacao');
		$prjud = $this->input->post('prjud_cnj'); if($prjud==""){$prjud=NULL;}else{$prjud = preg_replace("/[^0-9]/", "", $prjud);}
		$prpai = $this->input->post('prpai'); if($prpai==""){$prpai=NULL;}else{$prpai = preg_replace("/[^0-9]/", "", $prpai);}
		$prjudantigo = $this->input->post('prjudantigo'); if($prjudantigo==""){$prjudantigo=NULL;}
		$pradm = $this->input->post('pradm'); if($pradm==""){$pradm=NULL;}else{$pradm = preg_replace("/[^0-9]/", "", $pradm);}
		$fundlegal = $this->input->post('fundlegal');  if($fundlegal==""){$fundlegal=NULL;}
		$calchomovalor = $this->input->post('calchomovalor');
		if($calchomovalor != ""){
			$calchomovalor = str_replace(".", "", $calchomovalor);
			$calchomovalor = str_replace(",", ".", $calchomovalor);
			$calchomovalor = floatval($calchomovalor);
		}else{$calchomovalor=0;}
		$calchomovalortipo = $this->input->post('calchomovalortipo');	if($calchomovalortipo==""){$calchomovalortipo=NULL;}
		$ValorEconomicoDoRisco = $this->input->post('ValorEconomicoDoRisco');
		if($ValorEconomicoDoRisco != ""){
			$ValorEconomicoDoRisco = str_replace(".", "", $ValorEconomicoDoRisco);
			$ValorEconomicoDoRisco = str_replace(",", ".", $ValorEconomicoDoRisco);
			$ValorEconomicoDoRisco = floatval($ValorEconomicoDoRisco);
		}else{$ValorEconomicoDoRisco=0;}
		$causavalor = $this->input->post('causavalor');
		if($causavalor != ""){
			$causavalor = str_replace(".", "", $causavalor);
			$causavalor = str_replace(",", ".", $causavalor);
			$causavalor = floatval($causavalor);
		}else{$causavalor=0;}
		$causavalortipo = $this->input->post('causavalortipo');	if($causavalortipo==""){$causavalortipo=NULL;}
		$sentencavalor = $this->input->post('sentencavalor');
			if($sentencavalor != ""){
			$sentencavalor = str_replace(".", "", $sentencavalor);
			$sentencavalor = str_replace(",", ".", $sentencavalor);
			$sentencavalor = floatval($sentencavalor);
		}else{$sentencavalor=0;}
		$sentensavalortipo = $this->input->post('sentensavalortipo');	if($sentensavalortipo==""){$sentensavalortipo=NULL;}
		$condenavalor = $this->input->post('condenavalor');
		if($condenavalor != ""){
			$condenavalor = str_replace(".", "", $condenavalor);
			$condenavalor = str_replace(",", ".", $condenavalor);
			$condenavalor = floatval($condenavalor);
		}else{$condenavalor=0;}
		$condenacaovalortipo = $this->input->post('condenacaovalortipo'); if($condenacaovalortipo==""){$condenacaovalortipo=NULL;}
		$acordamvalor = $this->input->post('acordamvalor');
		if($acordamvalor != ""){
			$acordamvalor = str_replace(".", "", $acordamvalor);
			$acordamvalor = str_replace(",", ".", $acordamvalor);
			$acordamvalor = floatval($condenavalor);
		}else{$acordamvalor=0;}
		$acordamvalortipo = $this->input->post('acordamvalortipo'); if($acordamvalortipo==""){$acordamvalortipo=NULL;}
		$varaid = $this->input->post('varaid'); if($varaid==""){$varaid=NULL;}
		$probabilidadeid = $this->input->post('probabilidadeid'); if($probabilidadeid==""){$probabilidadeid=NULL;}
		$observacao = $this->input->post('observacao');
		if($observacao==""){$observacao=NULL;}else{$observacao=="'$observacao'";}
		$statusprocessoid = $this->input->post('statusprocessoid'); if($statusprocessoid==""){$statusprocessoid=NULL;}
		$dtajuizamento = $this->input->post('dtajuizamento');
		if($dtajuizamento!=""){
			$diadoc = substr($dtajuizamento, 0,2);
			$mesdoc = substr($dtajuizamento, 3,2);
			$anodoc =  substr($dtajuizamento, 6,4);
			$dtajuizamento = $mesdoc.'-'.$diadoc.'-'.$anodoc;
		}else {$dtajuizamento = NULL;}
		$dtextincao = $this->input->post('dtextincao');
		if($dtextincao!=""){
			$diadoc = substr($dtextincao, 0,2);
			$mesdoc = substr($dtextincao, 3,2);
			$anodoc =  substr($dtextincao, 6,4);
			$dtextincao = $mesdoc.'-'.$diadoc.'-'.$anodoc;
		}else {$dtextincao = NULL;}
		$sisprot = $this->input->post('sisprot'); if($sisprot==""){$sisprot=NULL;}
		$cxnum = $this->input->post('cxnum'); if($cxnum==""){$cxnum=NULL;}
		$palavraschave = $this->input->post('palavraschave');
		if($palavraschave==""){$palavraschave=NULL;}else{$palavraschave=="'$palavraschave'";}
		$posicaonovacap = $this->input->post('posicaonovacap'); if($posicaonovacap==""){$posicaonovacap=NULL;}
		$prsei = $this->input->post('prsei'); if($prsei==""){$prsei=NULL;}else{$prsei = preg_replace("/[^0-9]/", "", $prsei);}

		$data = array(
			//'AcaoTipoId' => 2, // Acao civel sempre 2, nao pode ser alterado.
			'ProcessoJudicialNumero' => $prjud,
			'VaraId' => $varaid,
			'ProcessoAdministrativoNumero' => $pradm,
			'CalculoHomologadoValor' => $calchomovalor,
			'ValorEconomicoDoRisco' => $ValorEconomicoDoRisco,
			'CalculoHomologadoValorTipo' => $calchomovalortipo,
			'CausaValor' => $causavalor,
			'ValorEconomicoDoRisco'=> $ValorEconomicoDoRisco,
			'SentencaValor' => $sentencavalor,
			'CondenacaoValor' => $condenavalor,
			'ProbabilidadeDePerdaId' => $probabilidadeid,
			'FundamentoLegal' => $fundlegal,
			'Observacoes' => $observacao,
			'Ativo' => $statusprocessoid,
			'Caixa' => $cxnum,
			'DataDoAjuizamento' => $dtajuizamento,
			'Sisprot' => $sisprot,
			'ProcessoJudicialNumeroAntigo' => $prjudantigo,
			'AcordaoValor' => $acordamvalor,
			'CausaValorTipo' => $causavalortipo,
			'SentencaValorTipo' => $sentensavalortipo,
			'CondenacaoValorTipo' => $condenacaovalortipo,
			'AcordaoValorTipo' => $acordamvalortipo,
			'DataDeExtincao' => $dtextincao,
			'PalavrasChave' => $palavraschave,
			'PosicaoNovacap' => $posicaonovacap,
		  'ProcessoPai' => $prpai,
		  'SEI' => $prsei
		);
		$this->Macaocivel->update_acao_civel($data,$IdAcao);
		$redirecionamento = "/cacaocivel/detailacaocivel/".$IdAcao;
		redirect($redirecionamento);
	}

	//FUNCAO usada para CIVEL e TRABALHISTA.
	function procexiste(){ //direciona para tentativa de cadastro de processo/a��o duplicada.
		$data['idprexiste'] = $this->uri->segment(3); //USADO EM CIVEL E TRABALHISTA
		$data['tipoprexiste'] = $this->uri->segment(4); //USADO EM CIVEL E TRABALHISTA
		$this->security->verifiyLogin('view_create_processo_existe.php',$data,$this->router->class,$this->router->method);
	}

	function createassuntocivel(){
		$tipoacao = $this->input->post('tipoacao'); // 1 -  Trabalhista, 2 - C�vel
		$IdAcao = $this->input->post('idacao');
		$IdAssunto = $this->input->post('assuntoid');
		$paradigma = $this->input->post('paradigma'); if($paradigma==""){$paradigma=NULL;}
		$data = array(
			'AcoesId' => $IdAcao,
			'AssuntoId' => $IdAssunto,
			'Paradigma' => $paradigma
		);
		$this->Mjuridico->add_record_assunto($data);
		if($tipoacao==1){
			$redirecionamento = "/cjuridico/detailacaotrab/".$IdAcao."#tabs-3";
		} if($tipoacao==2){
			$redirecionamento = "/cacaocivel/detailacaocivel/".$IdAcao."#tabs-3";
		}
		redirect($redirecionamento);
	}

	function createinteressado(){
		//$tipoacao = $this->input->post('tipoacao'); // 1 -  Trabalhista, 2 - C�vel
		$IdAcao = $this->input->post('idacao');
		$IdParte = $this->input->post('IdParte');
		$InteressadoTipo = $this->input->post('interessadotipo');

		$data = array(
			'AcoesId' => $IdAcao,
			'InteressadoTipo' => $InteressadoTipo,
			'ParteId' => $IdParte
		);
		$this->Mjuridico->add_record_interessado($data);
		$redirecionamento = "/cacaocivel/detailacaocivel/".$IdAcao."#tabs-2";
		redirect($redirecionamento);
	}

	function createaudienciacivel(){
		$tipoacao = $this->input->post('tipoacao'); // 1 -  Trabalhista, 2 - C�vel
		$IdAcao = $this->input->post('idacao');
		$hora = $this->input->post('AudienciaHora');
		$min = $this->input->post('AudienciaMin');
		$AudienciaData = $this->input->post('AudienciaData');
		if($AudienciaData!=""){
			$diadoc = substr($AudienciaData, 0,2);
			$mesdoc = substr($AudienciaData, 3,2);
			$anodoc =  substr($AudienciaData, 6,4);
			$AudienciaDataHora = $mesdoc.'-'.$diadoc.'-'.$anodoc.' '.$hora.':'.$min;
		}else {$AudienciaDataHora = NULL;}
		$audienciatipo = $this->input->post('audienciatipo');
		$preposto = $this->input->post('preposto');
		$audobs = $this->input->post('audobs');
		if($audobs==""){$audobs='NULL';}else{$audobs=strtoupper($audobs);}

		$data = array(
			'AcaoId' => $IdAcao,
			'AudienciaDataHora' => $AudienciaDataHora,
			'AudienciaTipoId' => $audienciatipo,
			'AudienciaPreposto' =>$preposto,
			'Observacao' => $audobs
		);
		$this->Mjuridico->add_record_audiencia($data);
		if($tipoacao==1){
			$redirecionamento = "/cjuridico/detailacaotrab/".$IdAcao."#tabs-4";
		}else if($tipoacao==2){
			$redirecionamento = "/cacaocivel/detailacaocivel/".$IdAcao."#tabs-4";
		}
		redirect($redirecionamento);
	}

	function createandamentocivel(){
		$tipoacao = $this->input->post('tipoacao'); // 1 -  Trabalhista, 2 - C�vel
		$IdAcao = $this->input->post('idacao');
		$andamentohora = $this->input->post('andamentohora');
		$andamentomin = $this->input->post('andamentomin');
		$dtandamento = $this->input->post('dtandamento');
		if($dtandamento!=""){
			$diadoc = substr($dtandamento, 0,2);
			$mesdoc = substr($dtandamento, 3,2);
			$anodoc =  substr($dtandamento, 6,4);
			$dtandamento = $mesdoc.'-'.$diadoc.'-'.$anodoc.' '.$andamentohora.':'.$andamentomin;
		}else {$dtandamento = NULL;}
		$andamentoid = $this->input->post('andamentoid');
		if($andamentoid==""){$andamentoid=NULL;}
		$obsandamento = $this->input->post('obsandamento');
		if($obsandamento==""){$obsandamento=NULL;}else{$obsandamento=strtoupper($obsandamento);}

		$data = array(
			'Data' => $dtandamento,
			'AuxAndamentoId' => $andamentoid,
			'AcoesId' => $IdAcao,
			'Observacao' => $obsandamento
		);
		$this->Mjuridico->add_andamento($data);
		if($tipoacao==1){
			$redirecionamento = "/cjuridico/detailacaotrab/".$IdAcao."#tabs-5";
		}else if($tipoacao==2){
			$redirecionamento = "/cacaocivel/detailacaocivel/".$IdAcao."#tabs-5";
		}
		redirect($redirecionamento);
	}

	function createprazocivel(){
		$tipoacao = $this->input->post('tipoacao'); // 1 -  Trabalhista, 2 - C�vel
		$IdAcao = $this->input->post('idacao');
		$dtprazo = $this->input->post('dtprazo');
		if($dtprazo!=""){
			$diadoc = substr($dtprazo, 0,2);
			$mesdoc = substr($dtprazo, 3,2);
			$anodoc =  substr($dtprazo, 6,4);
			$dtprazo = $mesdoc.'-'.$diadoc.'-'.$anodoc;
		}else {$dtprazo = NULL;}
		$descprazo = $this->input->post('descprazo');
		if($descprazo==""){$descprazo=NULL;}else{$descprazo=strtoupper($descprazo);}
		$obsprazo = $this->input->post('obsprazo');
		if($obsprazo==""){$obsprazo=NULL;}else{$obsprazo=strtoupper($obsprazo);}
		$prazoconcluido = $this->input->post('prazoconcluido');
		if($prazoconcluido==""){$prazoconcluido=0;}
		$soma = 0;
		if(empty($prazoconcluido)){
		}else{
			$N = count($prazoconcluido);
			for($i=0; $i < $N; $i++){
				$soma = $soma + $prazoconcluido[$i];
			}
		}
		$data = array(
			'AcaoId' => $IdAcao,
			'Descricao' => $descprazo,
			'Data' => $dtprazo,
			'Observacoes' => $obsprazo,
			'Concluido' => $soma,
		);
		$this->Mjuridico->add_prazo($data);
		if($tipoacao==1){
			$redirecionamento = "/cjuridico/detailacaotrab/".$IdAcao."#tabs-6";
		}else if($tipoacao==2){
			$redirecionamento = "/cacaocivel/detailacaocivel/".$IdAcao."#tabs-6";
		}
		redirect($redirecionamento);
	}

	function saveprazocivel(){
		$IdAcao = $this->input->post('idacao');
		$IdPrazo = $this->input->post('idprazo');
		$dtprazo = $this->input->post('dtprazo');
		if($dtprazo!=""){
			$diadoc = substr($dtprazo, 0,2);
			$mesdoc = substr($dtprazo, 3,2);
			$anodoc =  substr($dtprazo, 6,4);
			$dtprazo = $mesdoc.'-'.$diadoc.'-'.$anodoc;
		}else {$dtprazo = NULL;}
		$descprazo = $this->input->post('descprazo');
		if($descprazo==""){$descprazo=NULL;}else{$descprazo=strtoupper($descprazo);}
		$obsprazo = $this->input->post('obsprazo');
		if($obsprazo==""){$obsprazo=NULL;}else{$obsprazo=strtoupper($obsprazo);}
		$prazoconcluido = $this->input->post('prazoconcluido');
		if($prazoconcluido==""){$prazoconcluido=0;}
		$soma = 0;
		if(empty($prazoconcluido)){
		}else{
			$N = count($prazoconcluido);
			for($i=0; $i < $N; $i++){
				$soma = $soma + $prazoconcluido[$i];
			}
		}
		$data = array(
			'Descricao' => $descprazo,
			'Data' => $dtprazo,
			'Observacoes' => $obsprazo,
			'Concluido' => $soma
		);
		$this->Mjuridico->update_prazo($data,$IdPrazo);
		$redirecionamento = "/cacaocivel/detailacaocivel/".$IdAcao.'#tabs-6';
		redirect($redirecionamento);
	}

	function status_prazo_acao_civel_detail(){ //VINDO DA A��O DETAIL.
		$IdPrazo = $this->uri->segment(3);
		$Status = $this->uri->segment(4);
		$IdAcao = $this->uri->segment(5);
		if($Status==0) {$Status=1;}
		else if($Status==1) {$Status=0;}
		$this->Macaocivel->update_status_prazo_civel($IdPrazo,$Status); //Troca status do prazo
		$redirecionamento = "/cacaocivel/detailacaocivel/".$IdAcao.'#tabs-6';
		redirect($redirecionamento);
	}

	function saveaudienciacivel(){
		$flag = $this->input->post('flag'); //Decidir se vem de uma pesquisa de audiencia ou detalhe de acao
		$IdAcao = $this->input->post('idacao');
		$IdRegAud = $this->input->post('idregaud');
		$hora = $this->input->post('AudienciaHora');
		$min = $this->input->post('AudienciaMin');
		$AudienciaData = $this->input->post('AudienciaData');
		if($AudienciaData!=""){
			$diadoc = substr($AudienciaData, 0,2);
			$mesdoc = substr($AudienciaData, 3,2);
			$anodoc =  substr($AudienciaData, 6,4);
			$AudienciaDataHora = $mesdoc.'-'.$diadoc.'-'.$anodoc.' '.$hora.':'.$min;
		}else {$AudienciaDataHora = NULL;}
		$audienciatipo = $this->input->post('audienciatipo');
		$preposto = $this->input->post('preposto');
		if($preposto==""){$preposto=NULL;}else{$preposto=strtoupper($preposto);}
		$audobs = $this->input->post('audobs');
		if($audobs==""){$audobs=NULL;}else{$audobs=strtoupper($audobs);}

		$data = array(
			'AudienciaDataHora' => $AudienciaDataHora,
			'AudienciaTipoId' => $audienciatipo,
			'AudienciaPreposto' =>$preposto,
			'Observacao' => $audobs
		);
		$this->Mjuridico->update_audiencia($data,$IdRegAud);
		//if(($flag=='VoltaBuscaAudi')||($flag=='EditVoltaBuscaAudi')){
			//$_SESSION['redirect'] = $flag;
			//$redirecionamento = "/cjuridico/buscaudienciaresult";
			//redirect($redirecionamento);
		//}
		//if(($flag=='VoltaBuscaAcao')||($flag=='VoltaAcaoDetail')){
			//$_SESSION['redirect'] = $flag;
			$redirecionamento = "/cacaocivel/detailacaocivel/".$IdAcao.'#tabs-4';
			redirect($redirecionamento);
		//}
	}

	function saveandamentocivel(){
		$flag = $this->input->post('flag'); //Decidir se vem de uma pesquisa de audiencia ou detalhe de acao
		$IdAcao = $this->input->post('idacao');
		$IdRegAnd = $this->input->post('idregand');
		$andamentohora = $this->input->post('andamentohora');
		$andamentomin = $this->input->post('andamentomin');
		$dtandamento = $this->input->post('dtandamento');
		if($dtandamento!=""){
			$diadoc = substr($dtandamento, 0,2);
			$mesdoc = substr($dtandamento, 3,2);
			$anodoc =  substr($dtandamento, 6,4);
			$dtandamento = $mesdoc.'-'.$diadoc.'-'.$anodoc.' '.$andamentohora.':'.$andamentomin;
		}else {$dtandamento = NULL;}
		$andamentoid = $this->input->post('andamentoid');
		if($andamentoid==""){$andamentoid=NULL;}
		$obsandamento = $this->input->post('obsandamento');
		if($obsandamento==""){$obsandamento=NULL;}else{$obsandamento=strtoupper($obsandamento);}

		$data = array(
			'Data' => $dtandamento,
			'AuxAndamentoId' => $andamentoid,
			'Observacao' => $obsandamento
		);
		$this->Mjuridico->update_andamento($data,$IdRegAnd);
		$redirecionamento = "/cacaocivel/detailacaocivel/".$IdAcao.'#tabs-5';
		redirect($redirecionamento);
	}

	function updateprincipal(){ //muda status de assunto principal.
		$IdAcao = $this->uri->segment(3);
		$IdRegAssunto = $this->uri->segment(4);
		$AcaoTipoId = $this->uri->segment(5);
		$this->Mjuridico->update_principal($IdAcao,$IdRegAssunto);
		$redirecionamento = "/cacaocivel/detailacaocivel/".$IdAcao.'#tabs-3';
		redirect($redirecionamento);
	}

	function delete(){
		$this->security->verifiyLogin('delete','Mjuridico',$this->router->class,$this->router->method);
	}

}
