<?php
class Cjuridico extends Controller {

	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Macaocivel');
		$this->load->model('Mjuridico');
		$this->load->model('Mfuncionario');

		//@@ADICIONAR EM TODAS AS PÁGINAS PROTEGIDAS
		$this->load->library('security');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Pragma: no-cache");
	}

	function index(){
		$usuariolog = $this->session->userdata('usuario');
		//$usuariolog = 'claudia.tertuliano';
		$newdata = array(
		    'btnvoltar' => 'createacaotrab' //ressetar botão voltar no detalhamento e pesquisas.
		);
		$this->session->set_userdata($newdata);
		$grupologsis = $this->session->userdata('grupologsis');
		$login = $this->session->userdata('usuario');
		$senha = $this->session->userdata('usuariops');
		$data['GrupoJuridico'] = $this->Mfuncionario->verificagrupo($login,$senha);
		foreach ($data['GrupoJuridico'] as $items):
			$resultado = $items->resultado;
		endforeach;
		if((($login=="")&&($senha==""))||($resultado != 0)){
			$data['usuarionivel'] = $this->Mjuridico->getUsuarioNivel($usuariolog); //Pegar nivel acesso
			foreach ($data['usuarionivel'] as $usu):
				$usuarioNivel = $usu->Nivel; //Advogado chefe tem acesso todal
				if($usu->Id != NULL){
					$data['geralog'] = $this->Mfuncionario->UsuLogSession($usuariolog); //Executar #Temp para auxiliar no log
					$newdata = array( //mostrar o advogado em toda a sess�o.
						'usuarioid' => $usu->Id,
						'usuarionivel' => $usuarioNivel
					);
					$this->session->set_userdata($newdata);
				}
			endforeach;
		}else{
			$redirecionamento = "/usuario/logout";
			redirect($redirecionamento);
		}
		$data['prazosacoesqtd'] = $this->Mjuridico->getPrazosAcoesQtd($usuariolog);
		$this->security->verifiyLogin('view_index.php',$data,$this->router->class,$this->router->method);
	}

	function prazosacoesdetail(){
		$usuariolog = $this->session->userdata('usuario');
		//$usuariolog = 'claudia.tertuliano';
		$data['prazosacoesdetail'] = $this->Mjuridico->getPrazosAcoesDetail($usuariolog);
		$this->security->verifiyLogin('view_busca_prazo_acoes_result.php',$data,$this->router->class,$this->router->method);
	}

	function buscaprazoindex(){
		$usuariolog = $this->session->userdata('usuario');
		$IdAdvogado = 'NULL';
		$AdvgNivel = 'NULL';
		//$usuariolog = 'claudia.tertuliano';
		$data['acoestipo'] = $this->Mjuridico->getAcoesTipo();
		$data['tipoaudiencia'] = $this->Mjuridico->getTipoAudiencia();
		$data['advogados'] = $this->Mjuridico->getAdvogados();
		$data['varas'] = $this->Mjuridico->getVarasTrab();
		$data['advogadodetail'] = $this->Mjuridico->getAdvogadoDetail($usuariolog);
		$data['advogadonivel'] = $this->Mjuridico->getAdvogadoNivel($usuariolog);
		foreach ($data['advogadodetail'] as $adv):
			$IdAdvogado = $adv->Id; //usaso no cabe�alho pra mostrar ou ocultar o menu prazos.
		endforeach;
		foreach ($data['advogadonivel'] as $advn):
			//$advNome = $advn->Nome;
			$AdvgNivel = $advn->Adv; //Advogado chefe tem acesso todal
			//$AdvgNivel = 1; //Advogado chefe tem acesso todal
		endforeach;
		$data['advogadoid'] = $IdAdvogado;
		$data['advogadonivel'] = $AdvgNivel;
		$data['varaexclusiva'] = $this->Mjuridico->getVaraExclusiva($IdAdvogado);
		$this->security->verifiyLogin('view_busca_prazos_index.php',$data,$this->router->class,$this->router->method);
	}

	function addacaotrab(){
		$usuariolog = $this->session->userdata('usuario');
		$data['advogados'] = $this->Mjuridico->getAdvogados();
		$data['advlogado'] = $this->Mjuridico->getAdvLogado($usuariolog);
		$data['auxandamentos'] = $this->Mjuridico->getAuxAndamento();
		$data['auxandamentotodos'] = $this->Mjuridico->getAuxAndamentoTodos(); //Civel e Trabalhista para o Detail
		$data['acoestipo'] = $this->Mjuridico->getAcoesTipo();
		$data['assuntos'] = $this->Mjuridico->getAssuntos();
		$data['varas'] = $this->Mjuridico->getVarasTrab();
		$this->security->verifiyLogin('view_acao_trab_add.php',$data,$this->router->class,$this->router->method);
	}

	function buscacaotrabindex(){
		$usuariolog = $this->session->userdata('usuario');
		$data['assuntos'] = $this->Mjuridico->getAssuntos();
		$data['advogados'] = $this->Mjuridico->getAdvogados();
		$data['advlogado'] = $this->Mjuridico->getAdvLogado($usuariolog);
		$data['varas'] = $this->Mjuridico->getVarasTrab();
		$data['acoestipo'] = $this->Mjuridico->getAcoesTipo();
		$data['auxandamentos'] = $this->Mjuridico->getAuxAndamento();
		$data['auxandamentotodos'] = $this->Mjuridico->getAuxAndamentoTodos(); //Civel e Trabalhista para o Detail
		$usuariolog = $this->session->userdata('usuario');
		$this->security->verifiyLogin('view_acao_trab_busca_index.php',$data,$this->router->class,$this->router->method);
	}

	function buscacontratoindex(){
		$usuariolog = $this->session->userdata('usuario');
		$data['assuntos'] = $this->Mjuridico->getAssuntos();
		$data['advogados'] = $this->Mjuridico->getAdvogados();
		$data['advlogado'] = $this->Mjuridico->getAdvLogado($usuariolog);
		$data['varas'] = $this->Mjuridico->getVarasTrab();
		$data['situacaoctrs'] = $this->Mjuridico->getSituacaoContratos();
		$data['auxlicitamod'] = $this->Mjuridico->getContratoModalidade();
		$usuariolog = $this->session->userdata('usuario');
		$this->security->verifiyLogin('view_contrato_busca_index.php',$data,$this->router->class,$this->router->method);
	}

	function buscauditoriaindex(){
		$this->security->verifiyLogin('view_busca_auditoria_index.php','',$this->router->class,$this->router->method);
	}
	function relatorioprovisaocontabil(){
		$this->security->verifiyLogin('view_provisao_contabil_index.php','',$this->router->class,$this->router->method);
	}

	function relatauditoriaresult(){
		if(isset($_POST['submit'])){
			$probid = $this->input->post('probabilidadeid'); if($probid==""){$probid='NULL';}
			$tipoacao = $this->input->post('tipoacao'); if($tipoacao==""){$tipoacao='NULL';}
			$statusacao = $this->input->post('statusacao');	if($statusacao==""){$statusacao='NULL';}
			$posicaonovacap = $this->input->post('posicaonovacap');	if($posicaonovacap==""){$posicaonovacap='NULL';}
			$newdata = array( //guardar na sess�o.
				'probabid' => $probid,
				'tipoacao' => $tipoacao,
				'statusacao' => $statusacao,
				'posicaonovacap' => $posicaonovacap
			);
			$this->session->set_userdata($newdata);
		}
		else{
			$probid = $this->session->userdata('probabid');
			$tipoacao = $this->session->userdata('tipoacao');
			$statusacao = $this->session->userdata('statusacao');
			$posicaonovacap = $this->session->userdata('posicaonovacap');
		}
		$data['auditoriaresult'] = $this->Mjuridico->getAuditorias($probid,$tipoacao,$statusacao,$posicaonovacap);
		$filtro = '';
		$statusacao = '';
		$ProbPerda = array( //Manter probabilidade de perdas padrão.
		    array(
		        'Id' => 1,
		        'Descricao' => 'PROVÁVEL'
		    ),
		    array(
		        'Id' => 2,
		        'Descricao' => 'POSSÍVEL'
		    ),
		    array(
		        'Id' => 3,
		        'Descricao' => 'REMOTA'
		    )
		);
		if($tipoacao=='NULL'){$filtro = ' TIPO DE AÇÃO: TODAS. ';}
		if($tipoacao==1){$filtro = ' TIPO DE AÇÃO: TRABALHISTA. ';}
		if($tipoacao==2){$filtro = ' TIPO DE AÇÃO: CÍVEL. ';}

		if($probid != NULL){
		    foreach($ProbPerda as $prob):
		    if($probid==$prob['Id']){
		        $filtro = $filtro.' PROBABILIDADE DE PERDA: '.$prob['Descricao'].'. ';
		    }
		    endforeach;
		}
		if($statusacao=='1'){$filtro = $filtro.' STATUS: ATIVO. ';}
		if($statusacao=='0'){$filtro = $filtro.' STATUS: INATIVO. ';}

		if($posicaonovacap=='1'){$filtro = $filtro.' POSIÇÃO: AUTORA ';}
		if($posicaonovacap=='2'){$filtro = $filtro.' POSIÇÃO: RÉU ';}

		$newdata = array( //guardar na session.
		    'filtro' => $filtro
		);
		$this->session->set_userdata($newdata);
		$this->security->verifiyLogin('view_busca_auditoria_result.php',$data,$this->router->class,$this->router->method);
	}

	function relatodeprovcontresult(){
		if(isset($_POST['submit'])){
			$probid = $this->input->post('probabilidadeid'); if($probid==""){$probid='NULL';}
			$tipoacao = $this->input->post('tipoacao'); if($tipoacao==""){$tipoacao='NULL';}
			$statusacao = $this->input->post('statusacao');	if($statusacao==""){$statusacao='NULL';}
			$posicaonovacap = $this->input->post('posicaonovacap');	if($posicaonovacap==""){$posicaonovacap='NULL';}
			$newdata = array( //guardar na sess�o.
				'probabid' => $probid,
				'tipoacao' => $tipoacao,
				'statusacao' => $statusacao,
				'posicaonovacap' => $posicaonovacap
			);
			$this->session->set_userdata($newdata);
		}
		else{
			$probid = $this->session->userdata('probabid');
			$tipoacao = $this->session->userdata('tipoacao');
			$statusacao = $this->session->userdata('statusacao');
			$posicaonovacap = $this->session->userdata('posicaonovacap');
		}
		$data['auditoriaresult'] = $this->Mjuridico->getAuditorias($probid,$tipoacao,$statusacao,$posicaonovacap);
		$filtro = '';
		$statusacao = '';
		$ProbPerda = array( //Manter probabilidade de perdas padrão.
		    array(
		        'Id' => 1,
		        'Descricao' => 'PROVÁVEL'
		    ),
		    array(
		        'Id' => 2,
		        'Descricao' => 'POSSÍVEL'
		    ),
		    array(
		        'Id' => 3,
		        'Descricao' => 'REMOTA'
		    )
		);
		if($tipoacao=='NULL'){$filtro = ' TIPO DE AÇÃO: TODAS. ';}
		if($tipoacao==1){$filtro = ' TIPO DE AÇÃO: TRABALHISTA. ';}
		if($tipoacao==2){$filtro = ' TIPO DE AÇÃO: CÍVEL. ';}

		if($probid != NULL){
		    foreach($ProbPerda as $prob):
		    if($probid==$prob['Id']){
		        $filtro = $filtro.' PROBABILIDADE DE PERDA: '.$prob['Descricao'].'. ';
		    }
		    endforeach;
		}
		if($statusacao=='1'){$filtro = $filtro.' STATUS: ATIVO. ';}
		if($statusacao=='0'){$filtro = $filtro.' STATUS: INATIVO. ';}

		if($posicaonovacap=='1'){$filtro = $filtro.' POSIÇÃO: AUTORA ';}
		if($posicaonovacap=='2'){$filtro = $filtro.' POSIÇÃO: RÉU ';}

		$newdata = array( //guardar na session.
		    'filtro' => $filtro
		);
		$this->session->set_userdata($newdata);
		$this->security->verifiyLogin('view_provisao_contabil_result.php',$data,$this->router->class,$this->router->method);
	}

	function contratosituacao(){
		$data['situacaoctrs'] = $this->Mjuridico->getSituacaoContratos();
		$data['totalcontr'] = $this->Mjuridico->getSituacaoContratosTotal();
		$this->security->verifiyLogin('view_contrato_situacao.php',$data,$this->router->class,$this->router->method);
	}

	function contratosituacaorelat(){
		$data['situacaoctrs'] = $this->Mjuridico->getSituacaoContratos();
		$data['totalcontr'] = $this->Mjuridico->getSituacaoContratosTotal();
		$TotalContratos = 0;
		foreach ($data['totalcontr'] as $cont):
		 	$TotalContratos = $cont->TotalContratos;
		endforeach;
		$newdata = array(
		    'msgcontratos' => $TotalContratos.' contrato(s) com prazo de vigêcia vencido(s) ou a menos de 40 dias do vencimento'
		);
		$this->session->set_userdata($newdata);
		$this->security->verifiyLogin('view_contrato_situacao_relat.php',$data,$this->router->class,$this->router->method);
	}

	function buscacaotrabresult() {
		$newdata = array(
			'btnvoltar' => 'buscacaotrabresult' //voltar para busca de ação a partir de um detail
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
			if($prjudnum==""){$prjudnum='NULL';} else{$prjudnum = preg_replace("/[^0-9]/", "", $prjudnum);}
			$pradmnum = $this->input->post('pradm');
			if($pradmnum==""){$pradmnum='NULL';}else{$pradmnum = preg_replace("/[^0-9]/", "", $pradmnum);}//Somente n�meros
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
				'prjudnum' => $prjudnum,
				'pradmnum' => $pradmnum,
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
			$prjudnum = $this->session->userdata('prjudnum');
			$pradmnum = $this->session->userdata('pradmnum');
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
		$config['base_url'] = base_url().'cjuridico/buscacaotrabresult/';
		$config['per_page'] = '15';
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['first_link'] = 'Primeiro';
		$config['last_link'] = 'Último';
		$config['next_link'] = 'Próximo';
		$config['prev_link'] = 'Anterior';

		$totalLinhas = $this->mjuridico->getAcoesQtd($interesado,$prjudnum,$pradmnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim);
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
		if($query = $this->mjuridico->getAcoesResult($interesado,$prjudnum,$pradmnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim,$per_page,$this->uri->segment(3))){
			$data['docresult'] = $query;
		}
		$this->security->verifiyLogin('view_acao_trab_busca_result.php',$data,$this->router->class,$this->router->method);
	}

	function geraexcel(){
		$interesado = $this->session->userdata('Interesadonome');
		$cpfcnpj = $this->session->userdata('cpfcnpj');
		$prjudnum = $this->session->userdata('prjudnum');
		$pradmnum = $this->session->userdata('pradmnum');
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
		$data['docresult'] = $this->mjuridico->getAcoesExcel($interesado,$prjudnum,$pradmnum,$assuntoid,$advogadoid,$varaid,$obsbusca,$statusprocessoid,$andamentoid,$posicaonovacap,$cpfcnpj,$dtajuizamentoini,$dtajuizamentofim,$dtextincaoini,$dtextincaofim,$prsei,$dtinclusaoini,$dtinclusaofim);
		$this->security->verifiyLogin('view_acao_trab_excel.php',$data,$this->router->class,$this->router->method);
	}

	function buscaudienciaresult(){
		$newdata = array(
			'btnvoltar' => 'buscaudienciaresult' //volta pra busca audiência
			);
		$this->session->set_userdata($newdata);

		$this->load->library('pagination');
		if(isset($_POST['submit'])){
			$AudienciaDataIni = $this->input->post('AudienciaDataIni');
			if($AudienciaDataIni!=""){
				$diadoc = substr($AudienciaDataIni, 0,2);
				$mesdoc = substr($AudienciaDataIni, 3,2);
				$anodoc =  substr($AudienciaDataIni, 6,4);
				$AudienciaDataIni = $mesdoc.'-'.$diadoc.'-'.$anodoc;
				$AudienciaDataIni = "'$AudienciaDataIni'";
			}else {$AudienciaDataIni = 'NULL';}

			$AudienciaDataFim = $this->input->post('AudienciaDataFim');
			if($AudienciaDataFim!=""){
				$diadoc = substr($AudienciaDataFim, 0,2);
				$mesdoc = substr($AudienciaDataFim, 3,2);
				$anodoc =  substr($AudienciaDataFim, 6,4);
				$AudienciaDataFim = $mesdoc.'-'.$diadoc.'-'.$anodoc;
				$AudienciaDataFim = "'$AudienciaDataFim'";
			}else {$AudienciaDataFim = 'NULL';}
			$tipoacaoid = $this->input->post('tipoacaoid'); if($tipoacaoid==""){$tipoacaoid='NULL';}
			$advogadoid = $this->input->post('advogadoid');	if($advogadoid==""){$advogadoid='NULL';}
			$tipoaudienciaid = $this->input->post('tipoaudienciaid');
			if($tipoaudienciaid==""){$tipoaudienciaid='NULL';}else{$tipoaudienciaid="'$tipoaudienciaid'";}
			$varaid = $this->input->post('varaid');	if($varaid==""){$varaid='NULL';}
			$preposto = $this->input->post('preposto'); if($preposto==""){$preposto='NULL';}else{$preposto="'$preposto'";}

			$newdata = array(
				'AudienciaDataIni' => $AudienciaDataIni,
				'AudienciaDataFim' => $AudienciaDataFim,
				'tipoacaoid' => $tipoacaoid,
				'advogadoid' => $advogadoid,
				'tipoaudienciaid' => $tipoaudienciaid,
				'varaid' => $varaid,
				'preposto' => $preposto
			);
			$this->session->set_userdata($newdata);
		}
		else{
			$AudienciaDataIni = $this->session->userdata('AudienciaDataIni');
			$AudienciaDataFim = $this->session->userdata('AudienciaDataFim');
			$tipoacaoid = $this->session->userdata('tipoacaoid');
			$advogadoid = $this->session->userdata('advogadoid');
			$tipoaudienciaid = $this->session->userdata('tipoaudienciaid');
			$varaid = $this->session->userdata('varaid');
			$preposto = $this->session->userdata('preposto');
		}
		$data['audienciasresult'] = $this->Mjuridico->getAudienciasFiltro($AudienciaDataIni,$AudienciaDataFim,$preposto,$varaid,$tipoaudienciaid,$tipoacaoid,$advogadoid);
		$this->security->verifiyLogin('view_busca_audiencia_result.php',$data,$this->router->class,$this->router->method);
	}

	function geraexcelaudiencia(){
		$AudienciaDataIni = $this->session->userdata('AudienciaDataIni');
		$AudienciaDataFim = $this->session->userdata('AudienciaDataFim');
		$tipoacaoid = $this->session->userdata('tipoacaoid');
		$advogadoid = $this->session->userdata('advogadoid');
		$tipoaudienciaid = $this->session->userdata('tipoaudienciaid');
		$varaid = $this->session->userdata('varaid');
		$preposto = $this->session->userdata('preposto');
		$data['audienciasresult'] = $this->Mjuridico->getAudienciasFiltro($AudienciaDataIni,$AudienciaDataFim,$preposto,$varaid,$tipoaudienciaid,$tipoacaoid,$advogadoid);
		$this->security->verifiyLogin('view_audiencia_excel.php',$data,$this->router->class,$this->router->method);
	}

	function buscaprazosresult(){
		$newdata = array(
			'btnvoltar' => 'buscaprazosresult'
			);
		$this->session->set_userdata($newdata);

		$this->load->library('pagination');
		if(isset($_POST['submit'])){
			$prazoini = $this->input->post('prazoini');
			if($prazoini!=""){
				$anodoc = substr($prazoini, 0,4);
				$mesdoc = substr($prazoini, 5,2);
				$diadoc =  substr($prazoini, 8,4);
				$prazoini = $mesdoc.'-'.$diadoc.'-'.$anodoc;
				$prazoini = "'$prazoini'";
			}else {$prazoini="NULL";}

			$prazofim = $this->input->post('prazofim');
			if($prazofim!=""){ // 2020-08-01
				$anodoc = substr($prazofim, 0,4);
				$mesdoc = substr($prazofim, 5,2);
				$diadoc =  substr($prazofim, 8,4);
				$prazofim = $mesdoc.'-'.$diadoc.'-'.$anodoc;
				$prazofim = "'$prazofim'";
			}else {$prazofim="NULL";}

			$tipoacaoid = $this->input->post('tipoacaoid'); if($tipoacaoid==""){$tipoacaoid='NULL';}
			$prazoconcluido = $this->input->post('prazoconcluido');
			$soma = $prazoconcluido;
			if($soma==""){$soma='NULL';}

			$advogadoid = $this->input->post('advogadoid'); if($advogadoid==""){$advogadoid='NULL';}
			$varaid = $this->input->post('varaid'); if($varaid==""){$varaid='NULL';}
			$newdata = array(
				'prazoini' => $prazoini,
				'prazofim' => $prazofim,
				'tipoacaoid' => $tipoacaoid,
				'prazoconcluido' => $soma,
				'advogadoid' => $advogadoid,
				'varaid' => $varaid
			);
			$this->session->set_userdata($newdata);
		}
		else{
			$prazoini = $this->session->userdata('prazoini');
			$prazofim = $this->session->userdata('prazofim');
			$tipoacaoid = $this->session->userdata('tipoacaoid');
			$soma = $this->session->userdata('prazoconcluido');
			$advogadoid = $this->session->userdata('advogadoid');
			$varaid	= $this->session->userdata('varaid');
		}
		$data['prazosresult'] = $this->Mjuridico->getPrazoFiltro($prazoini,$prazofim,$varaid,$tipoacaoid,$advogadoid,$soma);
		$this->security->verifiyLogin('view_busca_prazos_result.php',$data,$this->router->class,$this->router->method);
	}

	function relatprazos(){
		//relatório com dados da sessão.
		$prazoini = $this->session->userdata('prazoini');
		$prazofim = $this->session->userdata('prazofim');
		$tipoacaoid = $this->session->userdata('tipoacaoid');
		$soma = $this->session->userdata('prazoconcluido');
		$advogadoid = $this->session->userdata('advogadoid');
		$varaid	= $this->session->userdata('varaid');

		$data['acoestipo'] = $this->Mjuridico->getAcoesTipo();
		$data['advogados'] = $this->Mjuridico->getAdvogados();
		$data['varas'] = $this->Mjuridico->getVarasTrab();

		$data['prazosresult'] = $this->Mjuridico->getPrazoFiltro($prazoini,$prazofim,$varaid,$tipoacaoid,$advogadoid,$soma);
		$this->security->verifiyLogin('view_busca_prazos_relat.php',$data,$this->router->class,$this->router->method);
	}

	function buscacontratoresult(){
		$newdata = array(
			'btnvoltar' => 'buscacontratoresult'
			);
		$this->session->set_userdata($newdata);
		$this->load->library('pagination');
		if(isset($_POST['submit1'])||(isset($_POST['submit2']))){ //Bot�o pesquisar/imprimir na view
			$por_pg = 0;
			$prazovigstatus = $this->input->post('prazovigstatus');
				if($prazovigstatus==""){$prazovigstatus='NULL';}
			$contratonr = $this->input->post('contratonr');
				if($contratonr==""){$contratonr='NULL';}
				else{$contratonr="'$contratonr'";}
			$prnum = $this->input->post('prnum');
				if($prnum==""){$prnum='NULL';}
				else{$prnum=preg_replace("/[^0-9]/", "", $prnum);}
			$empresanome = $this->input->post('empresanome');
				if($empresanome==""){$empresanome='NULL';}
				else{$empresanome="'$empresanome'";}
			$anocontr = $this->input->post('anocontr');
				if($anocontr==""){$anocontr='NULL';}
				//else{$anocontr="'$anocontr'";}
			$licitanum = $this->input->post('licitanum');
				if($licitanum==""){$licitanum='NULL';}
				else{$licitanum="'$licitanum'";}
			$modalidade = $this->input->post('modalidade');
				if($modalidade==""){$modalidade='NULL';}
				else{$modalidade="'$modalidade'";}
			$diretoria = $this->input->post('diretoria');
				if($diretoria==""){$diretoria='NULL';}
				else{$diretoria="'$diretoria'";}
			$objeto = $this->input->post('objeto');
				if($objeto==""){$objeto='NULL';}
				else{$objeto="'$objeto'";}
			$prsei = $this->input->post('prsei');
				if($prsei==""){$prsei='NULL';} else{$prsei = preg_replace("/[^0-9]/", "", $prsei);}

			$newdata = array(
				'prazovigstatus' => $prazovigstatus,
				'contratonr' => $contratonr,
				'prnum' => $prnum,
				'empresanome' => $empresanome,
				'anocontr' => $anocontr,
				'licitanum' => $licitanum,
				'modalidade' => $modalidade,
				'diretoria' => $diretoria,
				'objeto' => $objeto,
			  'situacao' => $prazovigstatus,
			  'prsei' => $prsei
			);
			$this->session->set_userdata($newdata);
		}else{
			$por_pg = 1;
			$prazovigstatus = $this->session->userdata('prazovigstatus');
			$contratonr = $this->session->userdata('contratonr');
			$prnum = $this->session->userdata('prnum');
			$empresanome = $this->session->userdata('empresanome');
			$anocontr = $this->session->userdata('anocontr');
			$licitanum = $this->session->userdata('licitanum');
			$modalidade = $this->session->userdata('modalidade');
			$diretoria = $this->session->userdata('diretoria');
			$objeto = $this->session->userdata('objeto');
			$situacao = $this->session->userdata('situacao');
			$prsei = $this->session->userdata('prsei');
		}
		//CONGFIGURAÇÕES
		$config['uri_segment'] = '3';
		$config['base_url'] = base_url().'cjuridico/buscacontratoresult/';
		$config['per_page'] = '15';
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['first_link'] = 'Primeiro';
	  $config['last_link'] = 'Último';
	  $config['next_link'] = 'Próximo';
		$config['prev_link'] = 'Anterior';

		$totalLinhas = $this->mjuridico->getContratosQtd($contratonr,$prnum,$empresanome,$modalidade,$licitanum,$diretoria,$objeto,$prazovigstatus,$prsei,$anocontr);
		$totalLinhas2 = 0;

		foreach($totalLinhas as $row):
			$totalLinhas2 = $row->QTD;
		endforeach;

		$newdata = array(
		    'totalLinhas2' => $totalLinhas2,
		);
		$this->session->set_userdata($newdata);

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
		if($query = $this->mjuridico->getContratosResult($contratonr,$prnum,$empresanome,$modalidade,$licitanum,$diretoria,$objeto,$prazovigstatus,$prsei,$anocontr,$per_page,$this->uri->segment(3))){
		     $data['contratosresult'] = $query;
		}
		$this->security->verifiyLogin('view_contrato_busca_result.php',$data,$this->router->class,$this->router->method);
	}

	function buscacontratorelat(){ //Imprimir contrtos depois das busca, dados pegos da session.
	    $prazovigstatus = $this->session->userdata('prazovigstatus');
	    $contratonr = $this->session->userdata('contratonr');
	    $prnum = $this->session->userdata('prnum');
	    $empresanome = $this->session->userdata('empresanome');
			$anocontr = $this->session->userdata('anocontr');
	    $licitanum = $this->session->userdata('licitanum');
	    $modalidade = $this->session->userdata('modalidade');
	    $diretoria = $this->session->userdata('diretoria');
	    $objeto = $this->session->userdata('objeto');
	    $situacao = $this->session->userdata('situacao');
	    $prsei = $this->session->userdata('prsei');
	    $totalLinhas2 = $this->session->userdata('totalLinhas2');
	    $data['contresult'] = $this->mjuridico->getContratosRelat($contratonr,$prnum,$empresanome,$modalidade,$licitanum,$diretoria,$objeto,$prazovigstatus,$prsei,$anocontr,$totalLinhas2);
	    $this->security->verifiyLogin('view_contrato_busca_relat.php',$data,$this->router->class,$this->router->method);
	}

	function status_prazo(){ // VINDO DA BUSCA DE PRAZOS
		$IdPrazo = $this->uri->segment(3);
		$Status = $this->uri->segment(4);
		if($Status==0) {$Status=1;}
		else if($Status==1) {$Status=0;}
		$this->Mjuridico->update_status_prazo($IdPrazo,$Status); //Troca status do prazo
		$redirecionamento = "/cjuridico/buscaprazosresult";
		redirect($redirecionamento);
	}

	function status_prazo_acao_detail(){ //VINDO DA AÇÃO DETAIL.
		$IdPrazo = $this->uri->segment(3);
		$Status = $this->uri->segment(4);
		$IdAcao = $this->uri->segment(5);
		if($Status==0) {$Status=1;}
		else if($Status==1) {$Status=0;}
		$this->Mjuridico->update_status_prazo($IdPrazo,$Status); //Troca status do prazo
		$redirecionamento = "/cjuridico/detailacaotrab/".$IdAcao."#tabs-6";
		redirect($redirecionamento);
	}

	function relataudiencia(){
		$AudienciaDataHoraIni = $this->session->userdata('AudienciaDataIni');
		$AudienciaDataHoraFim = $this->session->userdata('AudienciaDataFim');
		$tipoacaoid = $this->session->userdata('tipoacaoid');
		$advogadoid = $this->session->userdata('advogadoid');
		$tipoaudienciaid = $this->session->userdata('tipoaudienciaid');
		$varaid = $this->session->userdata('varaid');
		$preposto = $this->session->userdata('preposto');

		$data['acoestipo'] = $this->Mjuridico->getAcoesTipo();
		$data['advogados'] = $this->Mjuridico->getAdvogados();
		$data['varas'] = $this->Mjuridico->getVarasTrab();
		$data['audienciasresult'] = $this->Mjuridico->getAudienciasFiltro($AudienciaDataHoraIni,$AudienciaDataHoraFim,$preposto,$varaid,$tipoaudienciaid,$tipoacaoid,$advogadoid);
		$this->security->verifiyLogin('view_busca_audiencia_relat.php',$data,$this->router->class,$this->router->method);
	}

	function relatauditoria(){
		$probid = $this->session->userdata('probabid');
		$tipoacao = $this->session->userdata('tipoacao');
		$statusacao = $this->session->userdata('statusacao');
		$posicaonovacap = $this->session->userdata('posicaonovacap');
		$data['auditoriaresult'] = $this->Mjuridico->getAuditorias($probid,$tipoacao,$statusacao,$posicaonovacap);
		$this->security->verifiyLogin('view_relatorio_auditoria.php',$data,$this->router->class,$this->router->method);
	}

		function relatodeprovcont(){
		$probid = $this->session->userdata('probabid');
		$tipoacao = $this->session->userdata('tipoacao');
		$statusacao = $this->session->userdata('statusacao');
		$posicaonovacap = $this->session->userdata('posicaonovacap');
		$data['auditoriaresult'] = $this->Mjuridico->getAuditorias($probid,$tipoacao,$statusacao,$posicaonovacap);
		$this->security->verifiyLogin('view_relatorio_provcont.php',$data,$this->router->class,$this->router->method);
	}

	function solautprocessoresult(){ //mesmo nome em cível, mas aponta pra views diferentes, jur/civel
		$IdAcao = $this->uri->segment(3);
		$data['detailautuacao'] = $this->Mjuridico->getCodSisprot($IdAcao);
		$this->security->verifiyLogin('view_relat_aut_processo_juridico.php',$data,$this->router->class,$this->router->method);

	}

	function relatauditoriaexcel(){
		$probid = $this->session->userdata('probabid');
		$tipoacao = $this->session->userdata('tipoacao');
		$statusacao = $this->session->userdata('statusacao');
		$posicaonovacap = $this->session->userdata('posicaonovacap');
		$data['auditoriaresult'] = $this->Mjuridico->getAuditorias($probid,$tipoacao,$statusacao,$posicaonovacap);
		$this->security->verifiyLogin('view_auditoria_excel.php',$data,$this->router->class,$this->router->method);
	}

	function relatodeprovcontexcel(){
		$probid = $this->session->userdata('probabid');
		$tipoacao = $this->session->userdata('tipoacao');
		$statusacao = $this->session->userdata('statusacao');
		$posicaonovacap = $this->session->userdata('posicaonovacap');
		$data['auditoriaresult'] = $this->Mjuridico->getAuditorias($probid,$tipoacao,$statusacao,$posicaonovacap);
		$this->security->verifiyLogin('view_provcont_excel.php',$data,$this->router->class,$this->router->method);
	}

	function buscaudienciaindex(){
		$data['acoestipo'] = $this->Mjuridico->getAcoesTipo();
		$data['advogados'] = $this->Mjuridico->getAdvogados();
		$data['tipoaudiencia'] = $this->Mjuridico->getTipoAudiencia();
		$data['varas'] = $this->Mjuridico->getVarasGeral(); //Na audiência a busca é geral
		$this->security->verifiyLogin('view_busca_audiencia_index.php',$data,$this->router->class,$this->router->method);
	}

	function detailacaotrab(){
		$IdAcao = $this->uri->segment(3);
		$usuariolog = $this->session->userdata('usuario');
		$data['acaodetail'] = $this->Mjuridico->getAcaoDetail($IdAcao);
		$data['advlogado'] = $this->Mjuridico->getAdvLogado($usuariolog);
		$data['interessadoacao'] = $this->Mjuridico->getInteressadoAcao($IdAcao);
		$data['auxandamentotodos'] = $this->Mjuridico->getAuxAndamentoTodos(); //Civel e Trabalhista para o Detail
		$data['andamentorecente'] = $this->Mjuridico->getAndamentoRecente($IdAcao);
		$data['andamentos'] = $this->Mjuridico->getAndamentosAcao($IdAcao);
		$data['acao_assuntos'] = $this->Mjuridico->getAcaoAssuntos($IdAcao);
		$data['audiencias'] = $this->Mjuridico->getAudiencias($IdAcao);
		$data['advogadoalteraprazo'] = $this->Mjuridico->getAdvogadoAlteraPrazo($IdAcao);	
		$data['advogados'] = $this->Mjuridico->getAdvogados();
		$data['interessados'] = $this->Mjuridico->getInteressados();
		$data['auxandamentos'] = $this->Mjuridico->getAuxAndamentos();	
		$data['acoestipo'] = $this->Mjuridico->getAcoesTipo();
		$data['varas'] = $this->Mjuridico->getVarasTrab();
		$data['assuntos'] = $this->Mjuridico->getAssuntos();		
		$data['tipoaudiencia'] = $this->Mjuridico->getTipoAudiencia();
		$data['prazos'] = $this->Mjuridico->getPrazos($IdAcao);
		$data['detailusuario'] = $this->Mjuridico->getNivelAcesso($usuariolog);
		
		$IdUsuario = '';
		$Nome = '';
		$Matricula = '';
		$Login = '';
		//$Nivel = 0;
		//$Descricao = '';
		$NomeCompleto = '';			
		foreach ($data['detailusuario'] as $usudtl):
			$IdUsuario = $usudtl->Id;
			$Nome = $usudtl->Nome;
			$Matricula = $usudtl->Matricula;
			$Login = $usudtl->Login;
			//$Nivel = $usudtl->Nivel;
			//$Descricao = $usudtl->Descricao;
			$NomeCompleto = $usudtl->NomeCompleto;
		endforeach;
		//$data['tiporeu'] = $this->Macaocivel->getTipoReu($IdAcao);
		$data['localizaproc'] = $this->Mjuridico->getLocalizaProc($IdUsuario,$IdAcao); //Decicir crítica no botão solicitar processo.
		$this->security->verifiyLogin('view_acao_trab_detail.php',$data,$this->router->class,$this->router->method);
	}

	function relatacaotrab(){
		$IdAcao = $this->uri->segment(3);
		$usuariolog = $this->session->userdata('usuario');
		$data['acaodetail'] = $this->Mjuridico->getAcaoDetail($IdAcao);
		$data['advogados'] = $this->Mjuridico->getAdvogados();
		$data['advlogado'] = $this->Mjuridico->getAdvLogado($usuariolog);
		$data['interessados'] = $this->Mjuridico->getInteressados();
		//$data['interessadoEoutros'] = $this->Mjuridico->getInteressadoEoutros($IdAcao);
		$data['interessadoacao'] = $this->Mjuridico->getInteressadoAcao($IdAcao);
		$data['auxandamentos'] = $this->Mjuridico->getAuxAndamentos();
		$data['auxandamentotodos'] = $this->Mjuridico->getAuxAndamentoTodos(); //Civel e Trabalhista para o Detail
		$data['andamentorecente'] = $this->Mjuridico->getAndamentoRecente($IdAcao);
		$data['andamentos'] = $this->Mjuridico->getAndamentosAcao($IdAcao);
		$data['acoestipo'] = $this->Mjuridico->getAcoesTipo();
		$data['varas'] = $this->Mjuridico->getVarasTrab();
		$data['assuntos'] = $this->Mjuridico->getAssuntos();
		$data['acao_assuntos'] = $this->Mjuridico->getAcaoAssuntos($IdAcao);
		$data['audiencias'] = $this->Mjuridico->getAudiencias($IdAcao);
		$data['tipoaudiencia'] = $this->Mjuridico->getTipoAudiencia();
		$data['prazos'] = $this->Mjuridico->getPrazos($IdAcao);
		$this->security->verifiyLogin('view_relatorio_acao_trab.php',$data,$this->router->class,$this->router->method);
	}

	function addcontrato(){
		$data['contratomodalide'] = $this->Mjuridico->getContratoModalidade();
		$data['contratosituacao'] = $this->Mjuridico->getContratoSituacao();
		$this->security->verifiyLogin('view_contrato_add.php',$data,$this->router->class,$this->router->method);
	}

	function editcontrato(){
		$IdContrato = $this->uri->segment(3);
		$data['contratodetail'] = $this->Mjuridico->getContratoDetail($IdContrato);
		$data['contratosituacao'] = $this->Mjuridico->getContratoSituacao();
		$data['contratomodalide'] = $this->Mjuridico->getContratoModalidade();
		$this->security->verifiyLogin('view_contrato_edit.php',$data,$this->router->class,$this->router->method);
	}

	function editacaotrab(){
		$IdAcao = $this->uri->segment(3);
		$usuariolog = $this->session->userdata('usuario');
		$data['nivelacesso'] = $this->Mjuridico->getNivelAcesso($usuariolog);
		$data['acaodetail'] = $this->Mjuridico->getAcaoDetail($IdAcao);
		$data['assuntos'] = $this->Mjuridico->getAssuntos();
		$data['advogados'] = $this->Mjuridico->getAdvogados();
		//$data['interessadoEoutros'] = $this->Mjuridico->getInteressadoEoutros($IdAcao);
		$data['acoestipo'] = $this->Mjuridico->getAcoesTipo();
		$data['auxandamentos'] = $this->Mjuridico->getAuxAndamentos();
		$data['auxandamentotodos'] = $this->Mjuridico->getAuxAndamentoTodos(); //Civel e Trabalhista para o Detail
		$data['varas'] = $this->Mjuridico->getVarasTrab();
		//$data['tiporeu'] = $this->Macaocivel->getTipoReu($IdAcao);
		$this->security->verifiyLogin('view_acao_trab_edit.php',$data,$this->router->class,$this->router->method);
	}

	function editaudiencia(){
		$_SESSION['redirect'] = $this->uri->segment(5); //EditVoltaBuscaAudi se veio da busca por audiências.
		$IdAcao = $this->uri->segment(3);
		$IdRegAud = $this->uri->segment(4);
		$Flag = $this->uri->segment(5);
		$usuariolog = $this->session->userdata('usuario');
		$data['flag'] = $Flag;
		$data['audienciadetail'] = $this->Mjuridico->getAudienciaDetail($IdRegAud);
		$data['tipoaudiencia'] = $this->Mjuridico->getTipoAudiencia();
		$this->security->verifiyLogin('view_audiencia_edit.php',$data,$this->router->class,$this->router->method);
	}

	function editandamento(){
		$IdAcao = $this->uri->segment(3);
		$IdRegAnd = $this->uri->segment(4);
		$Flag = $this->uri->segment(5);
		$usuariolog = $this->session->userdata('usuario');
		$data['flag'] = $Flag;
		$data['andamentodetail'] = $this->Mjuridico->getAndamentoDetail($IdRegAnd);
		$data['auxandamentos'] = $this->Mjuridico->getAuxAndamentos();
		$data['auxandamentotodos'] = $this->Mjuridico->getAuxAndamentoTodos(); //Civel e Trabalhista para o Detail
		$this->security->verifiyLogin('view_andamento_edit_trab.php',$data,$this->router->class,$this->router->method);
	}

	function editprazo(){
		$_SESSION['redirect'] = $this->uri->segment(5); //EditVoltaBuscaAudi se veio da busca por audiências.
		$IdAcao = $this->uri->segment(3);
		$IdPrazo = $this->uri->segment(4);
		$Flag = $this->uri->segment(5);
		$usuariolog = $this->session->userdata('usuario');
		$data['flag'] = $Flag;
		$data['prazodetail'] = $this->Mjuridico->getPrazoDetail($IdPrazo);
		$this->security->verifiyLogin('view_prazo_edit.php',$data,$this->router->class,$this->router->method);
	}

	function createacaotrab(){
		$newdata = array(
			'btnvoltar' => 'createacaotrab' //ressetar botão voltar no detalhamento.
			);
		$this->session->set_userdata($newdata);
		$tipoacaoid = 1; //nativo no cadastro de cada ação.
		$prjud = $this->input->post('prjud'); if($prjud==""){$prjud=NULL;}else{$prjud = preg_replace("/[^0-9]/", "", $prjud);}
		$pradm = $this->input->post('pradm'); if($pradm==""){$pradm=NULL;}else{$pradm = preg_replace("/[^0-9]/", "", $pradm);}
		$prpai = $this->input->post('prpai'); if($prpai==""){$prpai=NULL;}else{$prpai = preg_replace("/[^0-9]/", "", $prpai);}
		$fundlegal = $this->input->post('fundlegal'); if($fundlegal==""){$fundlegal=NULL;}

		$calchomovalor = $this->input->post('calchomovalor');
		if($calchomovalor != ""){
			$calchomovalor = str_replace(".", "", $calchomovalor);
			$calchomovalor = str_replace(",", ".", $calchomovalor);
			$calchomovalor = floatval($calchomovalor);
		}else{$calchomovalor=0;}

		$causavalor = $this->input->post('causavalor');
		if($causavalor != ""){
			$causavalor = str_replace(".", "", $causavalor);
			$causavalor = str_replace(",", ".", $causavalor);
			$causavalor = floatval($causavalor);
		}else{$causavalor=0;}

		$sentencavalor = $this->input->post('sentencavalor');
		if($sentencavalor != ""){
			$sentencavalor = str_replace(".", "", $sentencavalor);
			$sentencavalor = str_replace(",", ".", $sentencavalor);
			$sentencavalor = floatval($sentencavalor);
		}else{$sentencavalor=0;}

		$condenavalor = $this->input->post('condenavalor');
		if($condenavalor != ""){
			$condenavalor = str_replace(".", "", $condenavalor);
			$condenavalor = str_replace(",", ".", $condenavalor);
			$condenavalor = floatval($condenavalor);
		}else{$condenavalor=0;}

		$acordaovalor = $this->input->post('acordaovalor');
		if($acordaovalor != ""){
			$acordaovalor = str_replace(".", "", $acordaovalor);
			$acordaovalor = str_replace(",", ".", $acordaovalor);
			$acordaovalor = floatval($acordaovalor);
		}else{$acordaovalor=0;}

		$varaid = $this->input->post('varaid'); if($varaid==""){$varaid=NULL;}
		$probabilidadeid = $this->input->post('probabilidadeid'); if($probabilidadeid==""){$probabilidadeid=NULL;}
		$observacao = $this->input->post('observacao');
		if($observacao==""){$observacao=NULL;}else{$observacao=strtoupper($observacao);}
		$statusprocessoid = $this->input->post('statusprocessoid');//valor default - 1.
		$cxnum = $this->input->post('cxnum'); if($cxnum==""){$cxnum=NULL;}
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
		$posicaonovacap = $this->input->post('posicaonovacap'); if($posicaonovacap==""){$posicaonovacap=NULL;}
		$prsei = $this->input->post('prsei'); if($prsei==""){$prsei=NULL;}else{$prsei = preg_replace("/[^0-9]/", "", $prsei);}

		//VERIFICAR ANTES SE O PROCESSO JÁ ESTÁ CADASTARDO.
		$data['processoexiste'] = $this->Macaocivel->getProcessoExsite($prjud);
		foreach ($data['processoexiste'] as $prEx):
			$PrExiste = $prEx->PrExiste;
		endforeach;
		if($PrExiste==0){//processo não cadastrado
			$data = array(
				'AcaoTipoId' => $tipoacaoid,
				'ProcessoJudicialNumero' => $prjud,
				'VaraId' => $varaid,
				'ProcessoAdministrativoNumero' => $pradm,
				'CalculoHomologadoValor' => $calchomovalor,
				'CausaValor' => $causavalor,
				'SentencaValor' => $sentencavalor,
				'CondenacaoValor' => $condenavalor,
				'AcordaoValor' => $acordaovalor,
				'ProbabilidadeDePerdaId' => $probabilidadeid,
				'FundamentoLegal' => $fundlegal,
				'Observacoes' => $observacao,
				'Ativo' => $statusprocessoid,
				'Caixa' => $cxnum,
				'DataDoAjuizamento' => $dtajuizamento,
				'DataDeExtincao' => $dtextincao,
				'Sisprot' => $sisprot,
				'PosicaoNovacap' => $posicaonovacap,
			  'ProcessoPai' => $prpai,
			  'SEI' => $prsei
			);
			$this->Macaocivel->add_acao_civel($data);
			$data['IdRefReg'] = $this->Macaocivel->getRegAtual();
			foreach ($data['IdRefReg'] as $item):
				$computed = $item->computed;
			endforeach;
			$redirecionamento = "/cjuridico/detailacaotrab/".$computed."#tabs-1";
			redirect($redirecionamento);
		}else{ //processo já cadastrado
			$redirecionamento = "/cacaocivel/procexiste/".$PrExiste.'/1'; //CÍVEL E TRABALHISTA, Enviar também o tipo de ação
			redirect($redirecionamento);
		}
	}

	function saveacaotrab(){
		$IdAcao = $this->input->post('idacao');
		$pradm = $this->input->post('pradm'); if($pradm==""){$pradm=NULL;}else{$pradm = preg_replace("/[^0-9]/", "", $pradm);}
		$prpai = $this->input->post('prpai'); if($prpai==""){$prpai=NULL;}else{$prpai = preg_replace("/[^0-9]/", "", $prpai);}
		$fundlegal = $this->input->post('fundlegal'); if($fundlegal==""){$fundlegal=NULL;}else{$fundlegal=utf8_decode($fundlegal);}

		$calchomovalor = $this->input->post('calchomovalor');
		if($calchomovalor != ""){
			$calchomovalor = str_replace(".", "", $calchomovalor);
			$calchomovalor = str_replace(",", ".", $calchomovalor);
			$calchomovalor = floatval($calchomovalor);
		}else{$calchomovalor=0;}

		$causavalor = $this->input->post('causavalor');
		if($causavalor != ""){
			$causavalor = str_replace(".", "", $causavalor);
			$causavalor = str_replace(",", ".", $causavalor);
			$causavalor = floatval($causavalor);
		}else{$causavalor=NULL;}

		$sentencavalor = $this->input->post('sentencavalor');
		if($sentencavalor != ""){
			$sentencavalor = str_replace(".", "", $sentencavalor);
			$sentencavalor = str_replace(",", ".", $sentencavalor);
			$sentencavalor = floatval($sentencavalor);
		}else{$sentencavalor=NULL;}

		$condenavalor = $this->input->post('condenavalor');
		if($condenavalor != ""){
			$condenavalor = str_replace(".", "", $condenavalor);
			$condenavalor = str_replace(",", ".", $condenavalor);
			$condenavalor = floatval($condenavalor);
		}else{$condenavalor=NULL;}

		$acordaovalor = $this->input->post('acordaovalor');
		if($acordaovalor != ""){
			$acordaovalor = str_replace(".", "", $acordaovalor);
			$acordaovalor = str_replace(",", ".", $acordaovalor);
			$acordaovalor = floatval($acordaovalor);
		}else{$acordaovalor=0;}

		$varaid = $this->input->post('varaid'); if($varaid==""){$varaid=NULL;}
		$probabilidadeid = $this->input->post('probabilidadeid'); if($probabilidadeid==""){$probabilidadeid=NULL;}
		$observacao = $this->input->post('observacao'); if($observacao==""){$observacao=NULL;}else{$observacao=utf8_decode($observacao);}
		if($observacao==""){$observacao=NULL;}else{$observacao=strtoupper($observacao);}
		$statusprocessoid = $this->input->post('statusprocessoid');
		$cxnum = $this->input->post('cxnum');
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
		$posicaonovacap = $this->input->post('posicaonovacap'); if($posicaonovacap==""){$posicaonovacap=NULL;}
		$prsei = $this->input->post('prsei'); if($prsei==""){$prsei=NULL;}else{$prsei = preg_replace("/[^0-9]/", "", $prsei);}

		$nivelacs = $this->input->post('nivelacs'); //Liberar ou não todos os campos.
		if(($nivelacs==1)||($nivelacs==2)||($nivelacs==3)){
			$data = array(
				'VaraId' => $varaid,
				'ProcessoAdministrativoNumero' => $pradm,
				'CalculoHomologadoValor' => $calchomovalor,
				'CausaValor' => $causavalor,
				'SentencaValor' => $sentencavalor,
				'CondenacaoValor' => $condenavalor,
				'AcordaoValor' => $acordaovalor,
				'ProbabilidadeDePerdaId' => $probabilidadeid,
				'FundamentoLegal' => $fundlegal,
				'Observacoes' => $observacao,
				'Ativo' => $statusprocessoid,
				'Caixa' => $cxnum,
				'DataDoAjuizamento' => $dtajuizamento,
				'DataDeExtincao' => $dtextincao,
				'Sisprot' => $sisprot,
				'PosicaoNovacap' => $posicaonovacap,
			  'ProcessoPai' => $prpai,
			  'SEI' => $prsei
			);
		}
		else{
			$data = array(
				'CalculoHomologadoValor' => $calchomovalor,
				'SentencaValor' => $sentencavalor,
				'CondenacaoValor' => $condenavalor,
				'AcordaoValor' => $acordaovalor,
				'ProbabilidadeDePerdaId' => $probabilidadeid,
				'FundamentoLegal' => $fundlegal,
				'Observacoes' => $observacao,
				'Ativo' => $statusprocessoid
			);
		}
		$this->Mjuridico->update_acao($data,$IdAcao);
		$redirecionamento = "/cjuridico/detailacaotrab/".$IdAcao;
		redirect($redirecionamento);
	}

	function createassunto(){
		$tipoacao = $this->input->post('tipoacao'); // 1 -  Trabalhista, 2 - Cível
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
		//$tipoacao = $this->input->post('tipoacao'); // 1 -  Trabalhista, 2 - Cível
		$IdAcao = $this->input->post('idacao');
		$IdParte = $this->input->post('IdParte');
		$InteressadoTipo = $this->input->post('interessadotipo');

		$data = array(
			'AcoesId' => $IdAcao,
			'InteressadoTipo' => $InteressadoTipo,
			'ParteId' => $IdParte
		);
		$this->Mjuridico->add_record_interessado($data);
		$redirecionamento = "/cjuridico/detailacaotrab/".$IdAcao."#tabs-2";
		redirect($redirecionamento);
	}

	function createaudiencia(){
		$tipoacao = $this->input->post('tipoacao'); // 1 -  Trabalhista, 2 - Cível
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

	function createandamento(){
		$tipoacao = $this->input->post('tipoacao'); // 1 -  Trabalhista, 2 - Cível
		$IdAcao = $this->input->post('idacao');
		$andamentohora = $this->input->post('andamentohora');
		$andamentomin = $this->input->post('andamentomin');
		$dtandamento = $this->input->post('dtandamento');
		if($dtandamento!=""){
			$dia = substr($dtandamento, 0,2);
			$mes = substr($dtandamento, 3,2);
			$ano =  substr($dtandamento, 6,4);
			$dtandamento = $mes.'-'.$dia.'-'.$ano.' '.$andamentohora.':'.$andamentomin;
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

	function createprazo(){
		$tipoacao = $this->input->post('tipoacao'); // 1 -  Trabalhista, 2 - Cível
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

	function saveprazo(){
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
		$redirecionamento = "/cjuridico/detailacaotrab/".$IdAcao.'#tabs-6';
		redirect($redirecionamento);
	}

	function saveaudiencia(){
		$flag = $this->input->post('flag'); //Decidir se vem de uma pesquisa de audiência ou detalhe de ação
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
		$redirecionamento = "/cjuridico/detailacaotrab/".$IdAcao.'#tabs-4';
		redirect($redirecionamento);
	}

	function saveandamento(){
		$flag = $this->input->post('flag'); //Decidir se vem de uma pesquisa de audiência ou detalhe de ação
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
		$redirecionamento = "/cjuridico/detailacaotrab/".$IdAcao.'#tabs-5';
		redirect($redirecionamento);
	}

	function createcontrato(){
		$processonr = $this->input->post('processonr');
		if($processonr==""){$processonr=NULL;}else{$processonr = preg_replace("/[^0-9]/", "", $processonr);}$processonr = str_replace(" ","",$processonr);
		$prsei = $this->input->post('prsei');
		if($prsei==""){$prsei=NULL;}else{$prsei = preg_replace("/[^0-9]/", "", $prsei);}$prsei = str_replace(" ","",$prsei);
		$licitanr = $this->input->post('licitanr'); if($licitanr==""){$licitanr=NULL;}
		$licitacaomodalidade = $this->input->post('licitacaomodalidade'); if($licitacaomodalidade==""){$licitacaomodalidade=NULL;}
		$diretoria = $this->input->post('diretoria'); if($diretoria==""){$diretoria=NULL;}
		$empresaid = $this->input->post('empresaid'); if($empresaid==""){$empresaid=NULL;}
		$contratonr = $this->input->post('contratonr');
		if($contratonr==""){
			$contratonr=NULL;
		}else{
			$contratonr=strtoupper($contratonr);
			$contratonr=preg_replace("/[^0-9]/", "", $contratonr);
		}				
		$contratovalor = $this->input->post('contratovalor');
		if($contratovalor != ""){
			$contratovalor = str_replace(".", "", $contratovalor);
			$contratovalor = str_replace(",", ".", $contratovalor);
			$contratovalor = floatval($contratovalor);
		}else{$contratovalor=0;}
		$status = $this->input->post('status'); if($status==""){$status=NULL;}
		$prazodevigenciainicio = $this->input->post('prazodevigenciainicio');
		if($prazodevigenciainicio!=""){
			$diadoc = substr($prazodevigenciainicio, 0,2);
			$mesdoc = substr($prazodevigenciainicio, 3,2);
			$anodoc =  substr($prazodevigenciainicio, 6,4);
			$prazodevigenciainicio = $mesdoc.'-'.$diadoc.'-'.$anodoc;
		}else {$prazodevigenciainicio = NULL;}
		$prazodevigencia = $this->input->post('prazodevigencia'); if($prazodevigencia==""){$prazodevigencia=NULL;}
		$prazodevigenciatipo = $this->input->post('prazodevigenciatipo'); if($prazodevigenciatipo==""){$prazodevigenciatipo=NULL;}
		$contratoobjeto = $this->input->post('contratoobjeto'); if($contratoobjeto==""){$contratoobjeto=NULL;}else{$contratoobjeto=utf8_decode($contratoobjeto);}
		$observacoes = $this->input->post('observacoes'); if($observacoes==""){$observacoes=NULL;}{$observacoes=utf8_decode($observacoes);}

		$data = array(
			'ContratoNr' => $contratonr,
			'ProcessoNr' => $processonr,
    		'SEI' => $prsei,
			'EmpresaId' => $empresaid,
			'Valor' => $contratovalor,
			'LicitacaoModalidadeId' => $licitacaomodalidade,
			'LicitacaoNumero' => $licitanr,
			'ContratoObjeto' => $contratoobjeto,
			'VigenciaInicio' => $prazodevigenciainicio,
			'VigenciaTipo' => $prazodevigenciatipo,
			'VigenciaPrazo' => $prazodevigencia,
			'Diretoria' => $diretoria,
			'Observacoes' => $observacoes,
			'Ativo' => $status
		);
		$this->Mjuridico->add_record_contrato($data);
		$data['IdRefReg'] = $this->Mjuridico->getRegAtual();
		foreach ($data['IdRefReg'] as $item):
			$computed = $item->computed;
		endforeach;
		$redirecionamento = "/caditivo/detailcontrato/".$computed.'/00'; //Seguimento 4 para mostrar ou ocultar Voltar
		redirect($redirecionamento);
	}

	function savecontrato(){
		$idcontrato = $this->input->post('idcontrato');
		$processonr = $this->input->post('processonr');
		$processonr = str_replace(" ","",$processonr);
		if($processonr==""){$processonr=NULL;}else{$processonr = preg_replace("/[^0-9]/", "", $processonr);}
		$prsei = $this->input->post('prsei');if($prsei==""){$prsei=NULL;}else{$prsei = preg_replace("/[^0-9]/", "", $prsei);}
		$prsei = str_replace(" ","",$prsei);
		$licitanr = $this->input->post('licitanr'); if($licitanr==""){$licitanr=NULL;}
		$licitacaomodalidade = $this->input->post('licitacaomodalidade'); if($licitacaomodalidade==""){$licitacaomodalidade=NULL;}
		$diretoria = $this->input->post('diretoria'); if($diretoria==""){$diretoria=NULL;}
		$empresaid = $this->input->post('empresaid'); if($empresaid==""){$empresaid=NULL;}
		$contratonr = $this->input->post('contratonr');
		if($contratonr==""){
			$contratonr=NULL;
		}else{
			$contratonr=strtoupper($contratonr);
			$contratonr=preg_replace("/[^0-9]/", "", $contratonr);
		}		
		$contratovalor = $this->input->post('contratovalor');
		if($contratovalor != ""){
			$contratovalor = str_replace(".", "", $contratovalor);
			$contratovalor = str_replace(",", ".", $contratovalor);
			$contratovalor = floatval($contratovalor);
		}else{$contratovalor=0;}
		//$situacaodocontratoid = $this->input->post('situacaocontratoid'); if($situacaodocontratoid==""){$situacaodocontratoid=NULL;}
		$status = $this->input->post('status'); if($status==""){$status=NULL;}
		$prazodevigenciainicio = $this->input->post('prazodevigenciainicio');
		if($prazodevigenciainicio!=""){
			$diadoc = substr($prazodevigenciainicio, 0,2);
			$mesdoc = substr($prazodevigenciainicio, 3,2);
			$anodoc =  substr($prazodevigenciainicio, 6,4);
			$prazodevigenciainicio = $mesdoc.'-'.$diadoc.'-'.$anodoc;
		}else {$prazodevigenciainicio = NULL;}
		$prazodevigencia = $this->input->post('prazodevigencia'); if($prazodevigencia==""){$prazodevigencia=NULL;}
		$prazodevigenciatipo = $this->input->post('prazodevigenciatipo'); if($prazodevigenciatipo==""){$prazodevigenciatipo=NULL;}
		$contratoobjeto = $this->input->post('contratoobjeto'); if($contratoobjeto==""){$contratoobjeto=NULL;}else{$contratoobjeto=utf8_decode($contratoobjeto);}
		$observacoes = $this->input->post('observacoes'); if($observacoes==""){$observacoes=NULL;}{$observacoes=utf8_decode($observacoes);}

		$data = array(
			'ContratoNr' => $contratonr,
			'ProcessoNr' => $processonr,
			'SEI' => $prsei,
			'EmpresaId' => $empresaid,
			'Valor' => $contratovalor,
			'LicitacaoModalidadeId' => $licitacaomodalidade,
			'LicitacaoNumero' => $licitanr,
			'ContratoObjeto' => $contratoobjeto,
			'VigenciaInicio' => $prazodevigenciainicio,
			'VigenciaTipo' => $prazodevigenciatipo,
			'VigenciaPrazo' => $prazodevigencia,
			'Diretoria' => $diretoria,
			'Observacoes' => $observacoes,
			'Ativo' => $status
		);
		$this->Mjuridico->update_record_contrato($data,$idcontrato);
		$redirecionamento = "/caditivo/detailcontrato/".$idcontrato.'/00'; //Seguimento 4 para mostrar ou ocultar Voltar
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
