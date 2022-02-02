<?php
class Matas extends Model {

    function getAtasQtd($atanr,$pradm,$nomempresa,$modalidadeid,$assdataini,$assdatafim,$vigdataini,$vigdatafim,$licitanr,$diretoriaid,$ataobjeto,$prsei){
        $this->db->query('SET ANSI_NULLS ON');
        $this->db->query('SET ANSI_WARNINGS ON');
        $sql = "exec dbo.PesquisaAtas $atanr,$pradm,$nomempresa,$modalidadeid,$assdataini,$assdatafim,$vigdataini,$vigdatafim,$licitanr,$diretoriaid,$ataobjeto,$prsei,null,null,0";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getAtasResult($atanr,$pradm,$nomempresa,$modalidadeid,$assdataini,$assdatafim,$vigdataini,$vigdatafim,$licitanr,$diretoriaid,$ataobjeto,$prsei,$perpage,$primeiroregistro){
        $this->db->query('SET ANSI_NULLS ON');
        $this->db->query('SET ANSI_WARNINGS ON');
        $porpagina = $perpage;
        $data['pagina'] = $porpagina;
        if ($primeiroregistro == ''){
            $primeiroregistro = 0;
        }
        $sql = "exec dbo.PesquisaAtas $atanr,$pradm,$nomempresa,$modalidadeid,$assdataini,$assdatafim,$vigdataini,$vigdatafim,$licitanr,$diretoriaid,$ataobjeto,$prsei,$porpagina,$primeiroregistro,1";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getAtasResultPdfExcel($atanr,$pradm,$nomempresa,$modalidadeid,$assdataini,$assdatafim,$vigdataini,$vigdatafim,$licitanr,$diretoriaid,$ataobjeto,$prsei){
        $this->db->query('SET ANSI_NULLS ON');
        $this->db->query('SET ANSI_WARNINGS ON');
        $sql = "exec dbo.PesquisaAtas $atanr,$pradm,$nomempresa,$modalidadeid,$assdataini,$assdatafim,$vigdataini,$vigdatafim,$licitanr,$diretoriaid,$ataobjeto,$prsei,NULL,NULL,1";
        $query = $this->db->query($sql);
        return $query->result();        
    }

    function getAtaDetail($IdAta){
        $this->db->query('SET ANSI_NULLS ON');
        $this->db->query('SET ANSI_WARNINGS ON');
        $sql = "Select * from vw_Atas where Id=$IdAta";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getEmpresas(){
        $this->db->query('SET ANSI_NULLS ON');
        $this->db->query('SET ANSI_WARNINGS ON');
        //$sql = "Select * from AtasEmpresas Order By EmpresaRazaoSocial";
				$sql = "Select * from Empresas Order By RazaoSocial";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getRepresentantes(){
        $this->db->query('SET ANSI_NULLS ON');
        $this->db->query('SET ANSI_WARNINGS ON');
        $sql = "Select * from AtasRepresentantes Order By Nome";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getAtaLotes($IdAta){
        $this->db->query('SET ANSI_NULLS ON');
        $this->db->query('SET ANSI_WARNINGS ON');
        $sql = "Select * from VW_Lotes where AtaId=$IdAta";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getAtaLoteDetail($IdLote){
        $this->db->query('SET ANSI_NULLS ON');
        $this->db->query('SET ANSI_WARNINGS ON');
        $sql = "Select * from vw_lotes where Id=$IdLote";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getAtaLoteItemDetail($IdLote){
        $this->db->query('SET ANSI_NULLS ON');
        $this->db->query('SET ANSI_WARNINGS ON');
        $sql = "Select * from lotedetalhe where LoteId=$IdLote";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getAtaLoteItemUnicoDetail($IdItem){
        $this->db->query('SET ANSI_NULLS ON');
        $this->db->query('SET ANSI_WARNINGS ON');
        $sql = "Select * from lotedetalhe where Id=$IdItem";
        $query = $this->db->query($sql);
        return $query->result();
    }
    

    function addAtas($data){
        $this->db->insert('Atas', $data);
        return;
    }

    function getRegAtual(){
        $this->db->query('SET ANSI_NULLS ON');
        $this->db->query('SET ANSI_WARNINGS ON');
        $sql = "SELECT SCOPE_IDENTITY()";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function updateAta($data,$ataid){
        $this->db->where('Id', $ataid);
        $this->db->update('Atas', $data);
    }

	function delete_row(){
	    $IdAta = $this->uri->segment(3);
	    $this->db->where('Id', $IdAta);
		$this->db->delete('Atas');
		$redirecionamento = "/catas/atasindex";
		redirect($redirecionamento);
	}

}
