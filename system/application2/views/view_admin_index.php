<?php
$this->load->view('view_cabecalho');
$acessoNivel = $this->session->userdata('acessoNivel');
$attributes = array('name' =>  'calendar');?>

<script type="text/javascript" src="<?php echo base_url();?>js/ajax.js"></script>

<script language='JavaScript'>
function excluir(id){
	var confirma = confirm("Deseja realmente excluir este registro?")
	if (confirma){
		window.location = "<?php echo base_url();?>cdoc/delete/"+id;
	} else {
		return false;
	}
}
</script>

<div id="caixa7">
<div id="tabs">
<div id="tabs-1">
<fieldset class=visible style='width:940px;margin-left:-3px;background-color: #87CEFA;'>
    <font size="5">Gerenciamento de acesso aos módulos do sistema</font><br>
</fieldset>

<fieldset class=visible style='width:940px;margin-left:-3px;'>
<?php
if(!empty($funcionarios)&&(sizeof($funcionarios)>0)){?>
	<table class="data_grid" cellspacing="0">
		<thead>
			<tr>
				<td width=10%><b>Matrícula</b></td>
				<td width=47%><b>Nome</b></td>
				<td width=8%><b>Login</b></td>
				<td width=5% class="middle" title="JA - Jurídico Admin"><b>JA</b></td>
				<td width=5% class="middle" title="JL - Jurídico Leitura"><b>JL</b></td>
				<td width=5% class="middle" title="CAA - Contratos e Atas Amin"><b>CAA</b></td>
				<td width=5% class="middle" title="CAL - Contratos e Atas Leitura"><b>CAL</b></td>
				<td width=5% class="middle" title="FA - Financeiro Admin"><b>FA</b></td>
                <td width=5% class="middle" title="FL - Financiero Leituras"><b>FL</b></td>
                <td width=5% class="middle" title="Situação do funcionário"><b>Status</b></td>
			</tr>
		</thead>
		<tfoot>
		</tfoot>
		<tbody>
		<?php
		foreach($funcionarios as $fun):
            $Id = $fun->Id;
            $Matricula = sprintf('%08d', $fun->Matricula);
            $Nome = strtoupper(utf8_encode($fun->Nome));
            $Login = strtolower($fun->Login); if($Login==""){$Login="-";}
            $Admin = $fun->Admin;
            $Nivel1 = $fun->Nivel1;if($Nivel1==0){$Nivel1='<font color="red">N</font>';}if($Nivel1==1){$Nivel1='<font color="blue"><b>S</b></font>';}
            $Nivel2 = $fun->Nivel2;if($Nivel2==0){$Nivel2='<font color="red">N</font>';}if($Nivel2==1){$Nivel2='<font color="blue"><b>S</b></font>';}
            $Nivel3 = $fun->Nivel3;if($Nivel3==0){$Nivel3='<font color="red">N</font>';}if($Nivel3==1){$Nivel3='<font color="blue"><b>S</b></font>';}
            $Nivel4 = $fun->Nivel4;if($Nivel4==0){$Nivel4='<font color="red">N</font>';}if($Nivel4==1){$Nivel4='<font color="blue"><b>S</b></font>';}
            $Nivel5 = $fun->Nivel5;if($Nivel5==0){$Nivel5='<font color="red">N</font>';}if($Nivel5==1){$Nivel5='<font color="blue"><b>S</b></font>';}
            $Nivel6 = $fun->Nivel6;if($Nivel6==0){$Nivel6='<font color="red">N</font>';}if($Nivel6==1){$Nivel6='<font color="blue"><b>S</b></font>';}
            $Ativo = $fun->Ativo;if($Ativo==0){$Ativo='<font color="red">INATIVO</font>';}if($Ativo==1){$Ativo='<font color="green">ATIVO</font>';}?>
            <tr style="border:0;">
                <?php if($Admin==0){ //nao Admin?>
                    <td>
                        <a href="<?php echo base_url();?>cadmin/funcdetalhe/<?php echo $Id;?>" style="color:blue;">
                            <?php echo $Matricula;?>
                        </a>                    
                    </td>
                    <td><?php echo $Nome?></td>
                <?php }else{ ?>
                    <td><?php echo $Matricula?></td>    
                    <td><?php echo '<font color="blue"><b><i>&#10029;Admin&#10029;</i></b></font> '.$Nome?></td>
                <?php }?>
                <td><?php echo $Login?></td>
                <td class="middle" title="JA - Jurídico Admin"><?php echo $Nivel1?></td>
                <td class="middle" title="JL - Jurídico Leitura"><?php echo $Nivel2?></td>
                <td class="middle" title="CAA - Contratos e Atas Amin"><?php echo $Nivel3?></td>
                <td class="middle" title="CAL - Contratos e Atas Leitura"><?php echo $Nivel4?></td>
                <td class="middle" title="FA - Financeiro Admin"><?php echo $Nivel5?></td>
                <td class="middle" title="FL - Financiero Leituras"><?php echo $Nivel6?></td>
                <td class="middle" title="Situação do funcionário"><?php echo $Ativo?></td>
			</tr>
	    <?php endforeach; ?>
		</tbody>
	</table>
<?php
}
else { ?>
<div class="status_box warning">
<h6>Aviso!</h6>
<ul>
	<li>Nenhum registro encontardo!</li>
</ul>
</div>
<?php }?>
<br>
</fieldset>

</div>

<br>
</div>
</div>

<?php $this->load->view('view_rodape');?>
