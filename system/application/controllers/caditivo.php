<?php
class Caditivo extends Controller {
	
	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Mjuridico');
		$this->load->model('Maditivo');
		$this->load->model('Mfuncionario');

		//@@ADICIONAR EM TODAS AS P�GINAS PROTEGIDAS
		$this->load->library('security');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Pragma: no-cache");	
	}
	
	function addaditivo(){
		$IdContrato = $this->uri->segment(3);
		$data['contratodetail'] = $this->Mjuridico->getContratoDetail($IdContrato);
		$data['aditivos'] = $this->Mjuridico->getAditivos($IdContrato);
		$data['denominacao'] = $this->Maditivo->AuxAditivoDenominacao();
		$data['tipo'] = $this->Maditivo->AuxAditivoTipo();
		$data['contratoid'] = $IdContrato;
		$this->security->verifiyLogin('view_aditivo_add.php',$data,$this->router->class,$this->router->method);
	}		

	function editaditivo(){
		$IdContrato = $this->uri->segment(3);
		$IdAditivo = $this->uri->segment(4);
		$data['contratodetail'] = $this->Mjuridico->getContratoDetail($IdContrato);
		$data['aditivodetail'] = $this->Maditivo->getAditivoDetail($IdAditivo);
		$data['aditivodetailongo'] = $this->Maditivo->getAditivoDetailLongo($IdAditivo); //Campos Motiva��o com texto longo
		$data['aditivos'] = $this->Mjuridico->getAditivos($IdContrato);
		$data['denominacao'] = $this->Maditivo->AuxAditivoDenominacao();
		$data['tipo'] = $this->Maditivo->AuxAditivoTipo();
		$data['contratoid'] = $IdContrato;
		$this->security->verifiyLogin('view_aditivo_edit.php',$data,$this->router->class,$this->router->method);
	}		
	
	function detailaditivo(){
		$IdContrato = $this->uri->segment(3);
		$IdAditivo = $this->uri->segment(4);
		$data['contratodetail'] = $this->Mjuridico->getContratoDetail($IdContrato);
		$data['aditivodetail'] = $this->Maditivo->getAditivoDetail($IdAditivo);
		$data['aditivodetailongo'] = $this->Maditivo->getAditivoDetailLongo($IdAditivo); //Campos Motiva��o com texto longo
		$data['denominacao'] = $this->Maditivo->AuxAditivoDenominacao();
		$data['tipo'] = $this->Maditivo->AuxAditivoTipo();
		$data['contratoid'] = $IdContrato;
		$this->security->verifiyLogin('view_aditivo_detail.php',$data,$this->router->class,$this->router->method);
	}	
	
	function aditivodetail(){
		//if($_SESSION['redirect'] == 'VoltaBuscaContrato'){$_SESSION['redirect'] = 'VoltaBuscaContrato';}
		$IdContrato = $this->uri->segment(3);
		$Redirect = $this->uri->segment(4);
		if($Redirect=='00'){
			$data['redirect'] = 'RegCria';
		}else{
			$data['redirect'] = '';
		}
		$data['aditivos'] = $this->Mjuridico->getAditivos($IdContrato);
		$data['contratodetail'] = $this->Mjuridico->getContratoDetail($IdContrato);
		$data['contratosituacao'] = $this->Mjuridico->getContratoSituacao();
		$data['denominacao'] = $this->Maditivo->AuxAditivoDenominacao();
		$data['tipo'] = $this->Maditivo->AuxAditivoTipo();		
		$this->security->verifiyLogin('view_aditivo_detail.php',$data,$this->router->class,$this->router->method);
	}	
	
	function detailcontrato(){
		//if($_SESSION['redirect'] == 'VoltaBuscaContrato'){$_SESSION['redirect'] = 'VoltaBuscaContrato';}
		$IdContrato = $this->uri->segment(3);
		$Redirect = $this->uri->segment(4);
		if($Redirect=='00'){
			$data['redirect'] = 'RegCria';
		}else if($Redirect=='11'){
			$data['redirect'] = 'buscaResult';
		}else if($Redirect=='22'){
			$data['redirect'] = 'contratoSituacao';
		}
		else{
			$data['redirect'] = '';
		}
		$data['aditivos'] = $this->Mjuridico->getAditivos($IdContrato);
		$data['contratodetail'] = $this->Mjuridico->getContratoDetail($IdContrato);
		$data['contratosituacao'] = $this->Mjuridico->getContratoSituacao();
		$data['denominacao'] = $this->Maditivo->AuxAditivoDenominacao();
		$data['tipo'] = $this->Maditivo->AuxAditivoTipo();		
		$data['contratomodalide'] = $this->Mjuridico->getContratoModalidade();
		$data['AuxTATipo'] = $this->Mjuridico->getAuxTATipo();
		$data['AuxTADenominacao'] = $this->Mjuridico->getAuxTADenominacao();
		$data['TermosDeApos'] = $this->Mjuridico->getTermos($IdContrato);
		$this->security->verifiyLogin('view_contrato_detail.php',$data,$this->router->class,$this->router->method);
	}	
	
	function relatcontrato(){
		$IdContrato = $this->uri->segment(3);
		$data['aditivos'] = $this->Mjuridico->getAditivos($IdContrato);
		$data['contratodetail'] = $this->Mjuridico->getContratoDetail($IdContrato);
		$data['contratosituacao'] = $this->Mjuridico->getContratoSituacao();
		$data['denominacao'] = $this->Maditivo->AuxAditivoDenominacao();
		$data['tipo'] = $this->Maditivo->AuxAditivoTipo();
		$data['contratomodalide'] = $this->Mjuridico->getContratoModalidade();
		$this->security->verifiyLogin('view_contrato_relatorio.php',$data,$this->router->class,$this->router->method);
	}	
	
	function createaditivo(){
		$contratoid = $this->input->post('contratoid'); //Inteiro obrigat�rio		
		$adtdenominacao = $this->input->post('adtdenominacao'); if($adtdenominacao==""){$adtdenominacao=NULL;}
		$tipodenomin = $this->input->post('tipodenomin'); if($tipodenomin==""){$tipodenomin=NULL;}
		$praditivo = $this->input->post('praditivo');
		if($praditivo==""){$praditivo=NULL;}
		else{
			$praditivo = preg_replace("/[^0-9]/", "", $praditivo);
			$praditivo = str_replace(" ","",$praditivo);
		}	
		$prsei = $this->input->post('prsei');
		if($prsei==""){$prsei=NULL;}
		else{
		    $prsei = preg_replace("/[^0-9]/", "", $prsei);
		    $prsei = str_replace(" ","",$prsei);
		}
		// $dtaditivo = $this->input->post('dtaditivo');
		// if($dtaditivo!=""){ //2017-05-22		 
		// 	$ano = substr($dtaditivo, 0,4);
		// 	$mes = substr($dtaditivo, 5,2); 
		// 	$dia =  substr($dtaditivo, 8,2);
		// 	$dtaditivo = $mes.'-'.$dia.'-'.$ano; 
		// }else {$dtaditivo = NULL;}	
		// $dtsol = $this->input->post('dtsol');
		// if($dtsol!=""){		
		// 	$ano = substr($dtsol, 0,4);
		// 	$mes = substr($dtsol, 5,2); 
		// 	$dia =  substr($dtsol, 8,2);
		// 	$dtsol = $mes.'-'.$dia.'-'.$ano;
		// }else {$dtsol = NULL;}			
		// $dtpublica = $this->input->post('dtpublica');
		// if($dtpublica!=""){		
		// 	$ano = substr($dtpublica, 0,4);
		// 	$mes = substr($dtpublica, 5,2); 
		// 	$dia =  substr($dtpublica, 8,2);
		// 	$dtpublica = $mes.'-'.$dia.'-'.$ano;
		// 	//$dtpublica = "'$dtpublica'";
		// }else {$dtpublica = NULL;}
		$aditivovlr = $this->input->post('aditivovlr');
		if($aditivovlr != ""){
			$aditivovlr = str_replace(".", "", $aditivovlr);
			$aditivovlr = str_replace(",", ".", $aditivovlr);
			$aditivovlr = floatval($aditivovlr);		
		}else{$aditivovlr=0;}			
		$adtprazovig = $this->input->post('adtprazovig'); if($adtprazovig==""){$adtprazovig=0;}
		$adtprazovigtipo = $this->input->post('adtprazovigtipo'); if($adtprazovigtipo==""){$adtprazovigtipo="DIAS";}
		$adtmotivacao = $this->input->post('adtmotivacao');	if($adtmotivacao==""){$adtmotivacao='NULL';}
		$adtobservacoes = $this->input->post('adtobservacoes');	if($adtobservacoes==""){$adtobservacoes=NULL;}
		// $dtexecinicio = $this->input->post('dtexecinicio');
		// if($dtexecinicio!=""){ //2017-05-22
		// 	$ano = substr($dtexecinicio, 0,4);
		// 	$mes = substr($dtexecinicio, 5,2);
		// 	$dia =  substr($dtexecinicio, 8,2);
		// 	$dtexecinicio = $mes.'-'.$dia.'-'.$ano;
		// }else {$dtexecinicio = NULL;}
		// $dtexefim = $this->input->post('dtexefim');
		// if($dtexefim!=""){ //2017-05-22
		// 	$ano = substr($dtexefim, 0,4);
		// 	$mes = substr($dtexefim, 5,2);
		// 	$dia =  substr($dtexefim, 8,2);
		// 	$dtexefim = $mes.'-'.$dia.'-'.$ano;
		// }else {$dtexefim = NULL;}		
		
		$data = array(
			'ContratoId' => $contratoid,
			'AditivoDenominacaoId' => $adtdenominacao,
			'AditivoTipoId' => $tipodenomin,
			'AditivoValor' => $aditivovlr,
			//'AditivoPrazo' => ,
			'AditivoProcessoNr' => $praditivo,
			//'AditivoData' => $dtaditivo,
			//'AditivoDataSolicitacao' => $dtsol,
			//'AditivoDataPublicacao' => $dtpublica,
			//'AditivoResultado' => ,
			//'AditivoPDF' => ,
			'Observacoes' => strtoupper($adtobservacoes),
			'PrazoDeVigenciaTipo' => $adtprazovigtipo,
			'PrazoDeVigencia' => $adtprazovig,
			//'PrazoDeExecucaoTipo' => $adtprazoexectipo,
			//'PrazoDeExecucao' => $adtprazoexec,
			//'PrazoDeVigenciaFim' => ,
			//'PrazoDeExecucaoFim' =>,
			'Motivacao' => strtoupper($adtmotivacao),
			//'PrazoDeExecucaoInicio' => $dtexecinicio,
			//'PrazoDeExecucaoFim' => $dtexefim,
		    'SEI' => $prsei
		);
		//print_r($data);
		$this->Maditivo->add_record_adt($data);
		$redirecionamento = "/caditivo/detailcontrato/".$contratoid."#tabs-2";		
		redirect($redirecionamento);	
	}	
		
	function saveaditivo(){
		$contratoid = $this->input->post('contratoid');//Inteiro
		$aditivoid = $this->input->post('aditivoid');//Inteiro
		$adtdenominacao = $this->input->post('adtdenominacao'); if($adtdenominacao==""){$adtdenominacao=NULL;}
		$tipodenomin = $this->input->post('tipodenomin'); if($tipodenomin==""){$tipodenomin=NULL;}
		$praditivo = $this->input->post('praditivo');
		if($praditivo==""){$praditivo=NULL;}
		else{
			$praditivo = preg_replace("/[^0-9]/", "", $praditivo);
			$praditivo = str_replace(" ","",$praditivo);
		}	
		$prsei = $this->input->post('prsei');
		if($prsei==""){$prsei=NULL;}
		else{
		    $prsei = preg_replace("/[^0-9]/", "", $prsei);
		    $prsei = str_replace(" ","",$prsei);
		}
		// $dtaditivo = $this->input->post('dtaditivo');
		// if($dtaditivo!=""){		
		// 	$diadoc = substr($dtaditivo, 0,2);
		// 	$mesdoc = substr($dtaditivo, 3,2); 
		// 	$anodoc =  substr($dtaditivo, 6,4);
		// 	$dtaditivo = $mesdoc.'-'.$diadoc.'-'.$anodoc;
		// }else {$dtaditivo = NULL;}			
		// $dtsol = $this->input->post('dtsol');
		// if($dtsol!=""){		
		// 	$diadoc = substr($dtsol, 0,2);
		// 	$mesdoc = substr($dtsol, 3,2); 
		// 	$anodoc =  substr($dtsol, 6,4);
		// 	$dtsol = $mesdoc.'-'.$diadoc.'-'.$anodoc;
		// }else {$dtsol = NULL;}			
		// $dtpublica = $this->input->post('dtpublica');
		// if($dtpublica!=""){		
		// 	$diadoc = substr($dtpublica, 0,2);
		// 	$mesdoc = substr($dtpublica, 3,2); 
		// 	$anodoc =  substr($dtpublica, 6,4);
		// 	$dtpublica = $mesdoc.'-'.$diadoc.'-'.$anodoc;
		// 	//$dtpublica = "'$dtpublica'";
		// }else {$dtpublica = NULL;}		
		$aditivovlr = $this->input->post('aditivovlr');
		if($aditivovlr != ""){
			$aditivovlr = str_replace(".", "", $aditivovlr);
			$aditivovlr = str_replace(",", ".", $aditivovlr);
			$aditivovlr = floatval($aditivovlr);		
		}else{$aditivovlr=NULL;}			
		$adtprazovig = $this->input->post('adtprazovig'); if($adtprazovig==""){$adtprazovig=NULL;}
		$adtprazovigtipo = $this->input->post('adtprazovigtipo'); if($adtprazovigtipo==""){$adtprazovigtipo=NULL;}
		//$adtprazoexec = $this->input->post('adtprazoexec'); if($adtprazoexec==""){$adtprazoexec=NULL;}
		//$adtprazoexectipo = $this->input->post('adtprazoexectipo'); if($adtprazoexectipo==""){$adtprazoexectipo=NULL;}
		$adtmotivacao = $this->input->post('adtmotivacao');	if($adtmotivacao==""){$adtmotivacao=NULL;}
		$adtobservacoes = $this->input->post('adtobservacoes');	if($adtobservacoes==""){$adtobservacoes=NULL;}
		// $dtexecinicio = $this->input->post('dtexecinicio');
		// if($dtexecinicio!=""){
		// 	$diadoc = substr($dtexecinicio, 0,2);
		// 	$mesdoc = substr($dtexecinicio, 3,2);
		// 	$anodoc =  substr($dtexecinicio, 6,4);
		// 	$dtexecinicio = $mesdoc.'-'.$diadoc.'-'.$anodoc;
		// }else {$dtexecinicio = NULL;}		
		
		// $dtexefim = $this->input->post('dtexefim');
		// if($dtexefim!=""){
		// 	$diadoc = substr($dtexefim, 0,2);
		// 	$mesdoc = substr($dtexefim, 3,2);
		// 	$anodoc =  substr($dtexefim, 6,4);
		// 	$dtexefim = $mesdoc.'-'.$diadoc.'-'.$anodoc;
		// }else {$dtexefim = NULL;}	
		
		$data = array(
			'ContratoId' => $contratoid,
			'AditivoDenominacaoId' => $adtdenominacao,
			'AditivoTipoId' => $tipodenomin,
			'AditivoValor' => $aditivovlr,
			//'AditivoPrazo' => ,
			'AditivoProcessoNr' => $praditivo,
			//'AditivoData' => $dtaditivo,
			//'AditivoDataSolicitacao' => $dtsol,
			//'AditivoDataPublicacao' => $dtpublica,
			//'AditivoResultado' => ,
			//'AditivoPDF' => ,
			'Observacoes' => strtoupper($adtobservacoes),
			'PrazoDeVigenciaTipo' => $adtprazovigtipo,
			'PrazoDeVigencia' => $adtprazovig,
			//'PrazoDeExecucaoTipo' => $adtprazoexectipo,
			//'PrazoDeExecucao' => $adtprazoexec,
			//'PrazoDeVigenciaFim' => ,
			//'PrazoDeExecucaoFim' =>,
			'Motivacao' => strtoupper($adtmotivacao),
			//'PrazoDeExecucaoInicio' => $dtexecinicio,
			//'PrazoDeExecucaoFim' => $dtexefim,
		    'SEI' => $prsei
		);
		$this->Maditivo->update_adt($data,$aditivoid);
		$redirecionamento = "/caditivo/detailcontrato/".$contratoid."/".$aditivoid."#tabs-2";		
		redirect($redirecionamento);	
	}		
	
	function delete(){
		$this->security->verifiyLogin('delete','Maditivo',$this->router->class,$this->router->method);		
	}	

}