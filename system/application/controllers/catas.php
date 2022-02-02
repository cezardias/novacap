<?php
class Catas extends Controller {

	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
		$this->load->model('Mjuridico');
		$this->load->model('Mfinanceiro');
		$this->load->model('Mfuncionario');
		$this->load->model('Matas');

		//@@ADICIONAR EM TODAS AS P�GINAS PROTEGIDAS
		$this->load->library('security');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Pragma: no-cache");
	}

	function atasindex(){
		$usuariolog = $this->session->userdata('usuario');
		$data['auxlicitamod'] = $this->Mjuridico->getContratoModalidade();
		$this->security->verifiyLogin('view_atas_busca_index.php',$data,$this->router->class,$this->router->method);
	}

	function atabuscaresult() {
		$atanrfiltro = '';
		$pradmFiltro = '';
		$prseiFiltro = '';
		$nomempresaFiltro = '';
		$modalidadeidFiltro = '';
		$licitanrFiltro = '';
		$diretoriaidFiltro = '';
		$ataobjetoFiltro = '';
		$assdatainiFiltro = '';
		$assdatafimFiltro = '';
		$vigdatainiFiltro = '';
		$vigdatafimFiltro = '';
		$FiltroDataAss = '';
		$FiltroDataVig = '';
	    $this->load->library('pagination');
	    if(isset($_POST['submit'])){
	        $por_pg = 0;
			$atanr = $this->input->post('atanr');
			if($atanr==""){
				$atanr='NULL';
			}else{
				$atanr="'$atanr'";
				$atanrfiltro=' Ata Nº '.$atanr;
			}
			$pradm = $this->input->post('pradm');
			if($pradm==""){
				$pradm='NULL';
			}else{
				$pradm = preg_replace("/[^0-9]/", "", $pradm);
				$pradmFiltro = ' Processo nº '.$pradm;
			}
			$prsei = $this->input->post('prsei');
			if($prsei==""){
				$prsei='NULL';
			}else{
				$prsei = preg_replace("/[^0-9]/", "", $prsei);
				$prseiFiltro = $prsei;
			}
			$nomempresa = $this->input->post('nomempresa');
			if($nomempresa==""){
				$nomempresa='NULL';
			}else{
				$nomempresa="'$nomempresa'";
				$nomempresaFiltro=' Empresa: '.$nomempresa;
			}
			$modalidadeid = $this->input->post('modalidadeid');
			if($modalidadeid==""){
				$modalidadeid='NULL';
			}else{
				$modalidadeid="'$modalidadeid'";
				$modalidadeidFiltro = ' Modalidade: '.$modalidadeid;
			}
			$licitanr = $this->input->post('licitanr');
			if($licitanr==""){
				$licitanr='NULL';
			}else{
				$licitanr="'$licitanr'";
				$licitanrFiltro= ' Licitação nº '.$licitanr;
			}
			$diretoriaid = $this->input->post('diretoriaid');
			if($diretoriaid==""){
				$diretoriaid='NULL';
			}else{
				$diretoriaid="'$diretoriaid'";
				$diretoriaidFiltro= ' Diretoria: '.$diretoriaid;
			}
			$ataobjeto = $this->input->post('ataobjeto');
			if($ataobjeto==""){
				$ataobjeto='NULL';
			}else{
				$ataobjeto="'$ataobjeto'";
				$ataobjetoFiltro= 'Objeto: '.$ataobjeto;
			}
			$assdataini = $this->input->post('assdataini');
			if($assdataini!=""){
			    $ano = substr($assdataini, 0,4);
			    $mes = substr($assdataini, 5,2);
			    $dia =  substr($assdataini, 8,2);
			    $assdataini = $mes.'-'.$dia.'-'.$ano;
				$assdataini = "'$assdataini'";
				$assdatainiFiltro = $dia.'/'.$mes.'/'.$ano;
			}else{$assdataini = 'NULL';}
			$assdatafim = $this->input->post('assdatafim');
			if($assdatafim!=""){
			    $ano = substr($assdatafim, 0,4);
			    $mes = substr($assdatafim, 5,2);
			    $dia =  substr($assdatafim, 8,2);
			    $assdatafim = $mes.'-'.$dia.'-'.$ano;
				$assdatafim = "'$assdatafim'";
				$assdatafimFiltro = $dia.'/'.$mes.'/'.$ano;
				$FiltroDataAss = 'Data assinatura: '.$assdatainiFiltro.' a '.$assdatafimFiltro.'. ';
			}else{$assdatafim = 'NULL';}
			$vigdataini = $this->input->post('vigdataini');
			if($vigdataini!=""){
			    $ano = substr($vigdataini, 0,4);
			    $mes = substr($vigdataini, 5,2);
			    $dia =  substr($vigdataini, 8,2);
			    $vigdataini = $mes.'-'.$dia.'-'.$ano;
				$vigdataini = "'$vigdataini'";
				$vigdatainiFiltro = $dia.'/'.$mes.'/'.$ano;
			}else{$vigdataini = 'NULL';}
			$vigdatafim = $this->input->post('vigdatafim');
			if($vigdatafim!=""){
			    $ano = substr($vigdatafim, 0,4);
			    $mes = substr($vigdatafim, 5,2);
			    $dia =  substr($vigdatafim, 8,2);
			    $vigdatafim = $mes.'-'.$dia.'-'.$ano;
				$vigdatafim = "'$vigdatafim'";
				$vigdatafimFiltro = $dia.'/'.$mes.'/'.$ano;
				$FiltroDataVig = 'Data vigência: '.$vigdatainiFiltro.' a '.$vigdatafimFiltro.'. ';
			}else{$vigdatafim = 'NULL';}
			
			$filtro = strtoupper('PESQUISA POR - '.$atanrfiltro.$pradmFiltro.$prseiFiltro.$nomempresaFiltro.$modalidadeidFiltro.$licitanrFiltro.$diretoriaidFiltro.$ataobjetoFiltro.$FiltroDataAss.$FiltroDataVig);
			$filtro = str_replace("'", '', $filtro);
			if(($atanr=='NULL')
			   &&($pradm=='NULL')
			   &&($prsei=='NULL')
			   &&($nomempresa=='NULL')
			   &&($modalidadeid=='NULL')
			   &&($licitanr=='NULL')
			   &&($diretoriaid=='NULL')
			   &&($ataobjeto=='NULL')){
			   $filtro = 'PESQUISA POR - TODOS';
			}
	        $newdata = array(
	            'atanr' => $atanr,
	            'pradm' => $pradm,
	            'prsei' => $prsei,
	            'nomempresa' => $nomempresa,
	            'modalidadeid' => $modalidadeid,
	            'licitanr' => $licitanr,
	            'diretoriaid' => $diretoriaid,
				'ataobjeto' => $ataobjeto,
				'assdataini' => $assdataini,
				'assdatafim' => $assdatafim,
				'vigdataini' => $vigdataini,
				'vigdatafim' => $vigdatafim,
				'PesquisaFiltro' => $filtro 				
	        );
	        $this->session->set_userdata($newdata);
	    }else{
	        $por_pg = 1;
	        $atanr = $this->session->userdata('atanr');
	        $pradm = $this->session->userdata('pradm');
	        $prsei = $this->session->userdata('prsei');
	        $nomempresa = $this->session->userdata('nomempresa');
	        $modalidadeid = $this->session->userdata('modalidadeid');
	        $licitanr = $this->session->userdata('licitanr');
	        $diretoriaid = $this->session->userdata('diretoriaid');
			$ataobjeto = $this->session->userdata('ataobjeto');
			$assdataini = $this->session->userdata('assdataini');
			$assdatafim = $this->session->userdata('assdatafim');
			$vigdataini = $this->session->userdata('vigdataini');
			$vigdatafim = $this->session->userdata('vigdatafim');
	    }
	    $config['uri_segment'] = '3';
	    $config['base_url'] = base_url().'catas/atabuscaresult/';
	    $config['per_page'] = '15';
	    $config['full_tag_open'] = '<div id="pagination">';
	    $config['full_tag_close'] = '</div>';
	    $config['first_link'] = 'Primeiro';
	    $config['last_link'] = 'Último';
	    $config['next_link'] = 'Próximo';
	    $config['prev_link'] = 'Anterior';

	    $totalLinhas = $this->Matas->getAtasQtd($atanr,$pradm,$nomempresa,$modalidadeid,$assdataini,$assdatafim,$vigdataini,$vigdatafim,$licitanr,$diretoriaid,$ataobjeto,$prsei);
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
	    if($query = $this->Matas->getAtasResult($atanr,$pradm,$nomempresa,$modalidadeid,$assdataini,$assdatafim,$vigdataini,$vigdatafim,$licitanr,$diretoriaid,$ataobjeto,$prsei,$per_page,$this->uri->segment(3))){
	        $data['atasresult'] = $query;
	    }
	    $this->security->verifiyLogin('view_atas_busca_result.php',$data,$this->router->class,$this->router->method);
	}

	function atabuscaresultpdf(){
		$atanr = $this->session->userdata('atanr');
		$pradm = $this->session->userdata('pradm');
		$prsei = $this->session->userdata('prsei');
		$nomempresa = $this->session->userdata('nomempresa');
		$modalidadeid = $this->session->userdata('modalidadeid');
		$licitanr = $this->session->userdata('licitanr');
		$diretoriaid = $this->session->userdata('diretoriaid');
		$ataobjeto = $this->session->userdata('ataobjeto');
		$assdataini = $this->session->userdata('assdataini');
		$assdatafim = $this->session->userdata('assdatafim');
		$vigdataini = $this->session->userdata('vigdataini');
		$vigdatafim = $this->session->userdata('vigdatafim');
	    $data['atasresult'] = $this->Matas->getAtasResultPdfExcel($atanr,$pradm,$nomempresa,$modalidadeid,$assdataini,$assdatafim,$vigdataini,$vigdatafim,$licitanr,$diretoriaid,$ataobjeto,$prsei);
		$this->security->verifiyLogin('view_atas_busca_result_relat.php',$data,$this->router->class,$this->router->method);
	}

	function atabuscaresultexcel(){
		$atanr = $this->session->userdata('atanr');
		$pradm = $this->session->userdata('pradm');
		$prsei = $this->session->userdata('prsei');
		$nomempresa = $this->session->userdata('nomempresa');
		$modalidadeid = $this->session->userdata('modalidadeid');
		$licitanr = $this->session->userdata('licitanr');
		$diretoriaid = $this->session->userdata('diretoriaid');
		$ataobjeto = $this->session->userdata('ataobjeto');		
		$assdataini = $this->session->userdata('assdataini');
		$assdatafim = $this->session->userdata('assdatafim');
		$vigdataini = $this->session->userdata('vigdataini');
		$vigdatafim = $this->session->userdata('vigdatafim');		
	    $data['atasresult'] = $this->Matas->getAtasResultPdfExcel($atanr,$pradm,$nomempresa,$modalidadeid,$assdataini,$assdatafim,$vigdataini,$vigdatafim,$licitanr,$diretoriaid,$ataobjeto,$prsei);
		$this->security->verifiyLogin('view_atas_busca_result_excel.php',$data,$this->router->class,$this->router->method);
	}

	function atacreate(){
	    $atanr = $this->input->post('atanr'); if($atanr==""){$atanr='NULL';}
	    $pradm = $this->input->post('pradm'); if($pradm==""){$pradm='NULL';} else{$pradm = preg_replace("/[^0-9]/", "", $pradm);}
	    $prsei = $this->input->post('prsei'); if($prsei==""){$prsei='NULL';} else{$prsei = preg_replace("/[^0-9]/", "", $prsei);}
	    $licitanr = $this->input->post('licitanr'); if($licitanr==""){$licitanr='NULL';}
	    $atadatassinatura = $this->input->post('atadatassinatura');
	    if($atadatassinatura!=""){
	        $ano = substr($atadatassinatura, 0,4);
	        $mes = substr($atadatassinatura, 5,2);
	        $dia =  substr($atadatassinatura, 8,2);
	        $atadatassinatura = $mes.'-'.$dia.'-'.$ano;
	    }else {$atadatassinatura = NULL;}

	    $atadatavigenciainicio = $this->input->post('atadatavigenciainicio');
	    if($atadatavigenciainicio!=""){
	        $ano = substr($atadatavigenciainicio, 0,4);
	        $mes = substr($atadatavigenciainicio, 5,2);
	        $dia =  substr($atadatavigenciainicio, 8,2);
	        $atadatavigenciainicio = $mes.'-'.$dia.'-'.$ano;
	    }else {$atadatavigenciainicio = NULL;}

	    $ataprazovigencia = $this->input->post('ataprazovigencia'); if($ataprazovigencia==""){$ataprazovigencia='NULL';}
	    $atatipoprazo = $this->input->post('atatipoprazo'); if($atatipoprazo==""){$atatipoprazo='NULL';}

	    $licmodalidadeid = $this->input->post('licmodalidadeid'); if($licmodalidadeid==""){$licmodalidadeid='NULL';}
	    $diretoria = $this->input->post('diretoria'); if($diretoria==""){$diretoria='NULL';}
	    $ataobjeto = $this->input->post('ataobjeto'); if($ataobjeto==""){$ataobjeto='NULL';} else{$ataobjeto=utf8_decode($ataobjeto);}
	    $ataobs = $this->input->post('ataobs'); if($ataobs==""){$ataobs = 'NULL';} else{$ataobs=utf8_decode($ataobs);}

	    $data = array(
	        'AtaNumero' => $atanr,
	        'ProcessoNr' => $pradm,
	        'SEI' => $prsei,
	        'LicitacaoNumero' => $licitanr,
	        'PrazoDeVigenciaInicio' => $atadatavigenciainicio,
	        'PrazoDeVigenciaTipo' => $atatipoprazo, //dias/meses
	        'PrazoDeVigencia' => $ataprazovigencia, // inteiro
	        'AtaAssinaturaData' => $atadatassinatura,
	        'LicitacaoModalidadeId' => $licmodalidadeid,
	        'Diretoria' => $diretoria,
	        'AtaObjeto' => $ataobjeto,
	        'Observacoes' => $ataobs,
	    );
	    $this->Matas->addAtas($data);
	    $data['IdRefReg'] = $this->Matas->getRegAtual();
	    foreach ($data['IdRefReg'] as $item):
	       $computed = $item->computed;
	    endforeach;
	    $redirecionamento = "/catas/atadetail/".$computed;
	    redirect($redirecionamento);
	}

	function atasave(){
	    $ataid = $this->input->post('ataid'); if($ataid==""){$ataid='NULL';}
	    $atanr = $this->input->post('atanr'); if($atanr==""){$atanr='NULL';}
	    $pradm = $this->input->post('pradm'); if($pradm==""){$pradm='NULL';} else{$pradm = preg_replace("/[^0-9]/", "", $pradm);}
	    $prsei = $this->input->post('prsei'); if($prsei==""){$prsei='NULL';} else{$prsei = preg_replace("/[^0-9]/", "", $prsei);}
	    $licitanr = $this->input->post('licitanr'); if($licitanr==""){$licitanr='NULL';}

	    $atadatassinatura = $this->input->post('atadatassinatura');
	    if($atadatassinatura!=""){
	        $ano = substr($atadatassinatura, 0,4);
	        $mes = substr($atadatassinatura, 5,2);
	        $dia =  substr($atadatassinatura, 8,2);
	        $atadatassinatura = $mes.'-'.$dia.'-'.$ano;
	    }else {$atadatassinatura = NULL;}

	    $atadatavigenciainicio = $this->input->post('atadatavigenciainicio');
	    if($atadatavigenciainicio!=""){
	        $ano = substr($atadatavigenciainicio, 0,4);
	        $mes = substr($atadatavigenciainicio, 5,2);
	        $dia =  substr($atadatavigenciainicio, 8,2);
	        $atadatavigenciainicio = $mes.'-'.$dia.'-'.$ano;
	    }else {$atadatavigenciainicio = NULL;}
	    //$nomempresa = $this->input->post('nomempresa'); if($nomempresa==""){$nomempresa='NULL';}
	    $ataprazovigencia = $this->input->post('ataprazovigencia'); if($ataprazovigencia==""){$ataprazovigencia='NULL';}
	    $atatipoprazo = $this->input->post('atatipoprazo'); if($atatipoprazo==""){$atatipoprazo='NULL';}
	    $licmodalidadeid = $this->input->post('licmodalidadeid'); if($licmodalidadeid==""){$licmodalidadeid='NULL';}
	    $diretoria = $this->input->post('diretoria'); if($diretoria==""){$diretoria='NULL';}
	    $ataobjeto = $this->input->post('ataobjeto'); if($ataobjeto==""){$ataobjeto='NULL';} else{$ataobjeto=utf8_decode($ataobjeto);}
	    $ataobs = $this->input->post('ataobs'); if($ataobs==""){$ataobs = 'NULL';} else{$ataobs=utf8_decode($ataobs);}

	    $data = array(
	        'AtaNumero' => $atanr,
	        'ProcessoNr' => $pradm,
	        'SEI' => $prsei,
	        'LicitacaoNumero' => $licitanr,
	        //'EmpresaNome' => $nomempresa,
	        'PrazoDeVigenciaInicio' => $atadatavigenciainicio,
	        'PrazoDeVigenciaTipo' => $atatipoprazo, //dias/meses
	        'PrazoDeVigencia' => $ataprazovigencia, // inteiro
	        'AtaAssinaturaData' => $atadatassinatura,
	        'LicitacaoModalidadeId' => $licmodalidadeid,
	        'Diretoria' => $diretoria,
	        'AtaObjeto' => $ataobjeto,
	        'Observacoes' => $ataobs,
	        //'Valor' => $atavalor //CAMPO CALCULADO
	    );
	    $this->Matas->updateAta($data,$ataid);
	    $redirecionamento = "/catas/atadetail/".$ataid;
	    redirect($redirecionamento);
	}

	function ataadd(){
	    $usuariolog = $this->session->userdata('usuario');
	    $data['auxmodalidade'] = $this->Mjuridico->getContratoModalidade();
	    $this->security->verifiyLogin('view_atas_add.php',$data,$this->router->class,$this->router->method);
	}

	function atadetail(){
	    $IdAta = $this->uri->segment(3);
	    $data['atadetail'] = $this->Matas->getAtaDetail($IdAta);
	    $data['atalotes'] = $this->Matas->getAtaLotes($IdAta);
	    $data['auxempresa'] = $this->Matas->getEmpresas();
	    $data['auxrepresentante'] = $this->Matas->getRepresentantes();
	    $this->security->verifiyLogin('view_atas_detail.php',$data,$this->router->class,$this->router->method);
	}

	function atalotedetail(){
	    $IdAta = $this->uri->segment(3);
	    $IdLote = $this->uri->segment(4);
	    $data['atadetail'] = $this->Matas->getAtaDetail($IdAta);
	    $data['atalotes'] = $this->Matas->getAtaLotes($IdAta);
	    $data['atalotedetail'] = $this->Matas->getAtaLoteDetail($IdLote);
	    $data['ataloteitemdetail'] = $this->Matas->getAtaLoteItemDetail($IdLote);
	    $this->security->verifiyLogin('view_atas_lote_detail.php',$data,$this->router->class,$this->router->method);
	}

	function ataedit(){
	    $IdAta = $this->uri->segment(3);
	    $data['auxmodalide'] = $this->Mjuridico->getContratoModalidade();
	    $data['atadetail'] = $this->Matas->getAtaDetail($IdAta);
	    $this->security->verifiyLogin('view_atas_edit.php',$data,$this->router->class,$this->router->method);
	}

	function delete(){
		$this->security->verifiyLogin('delete','Matas',$this->router->class,$this->router->method);
	}

}
