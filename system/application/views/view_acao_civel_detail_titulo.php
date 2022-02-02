<table style="width:100%; border:1px solid #4169E1; background-color:#DCDCDC; margin-top:7px;">
  <tr>
    <td style="width:15%">
    	<font color="#4169E1">
    		<b>&nbsp;INTERESSADO</b>
    	</font>
    </td>
    <td style="width:85%;text-transform:uppercase;" colspan="6">
    	<font color="#191970">
    		<b><?php echo $autorAcao?></b>
    	</font>
    </td>
  </tr>
  <tr>
    <td style="width:15%">
    	<font color="#4169E1">
    		<b>&nbsp;PROCESSO JUDICIAL</b>
    	</font>
    </td>
    <td style="width:25%">
    	<font color="#191970">
    		<b><?php echo $ProcessoJud ?></b>
    	</font>
    </td> 
    <td style="width:5%">
    	<font color="#4169E1">
    		<b>VARA</b>
    	</font>
    </td>
    <td style="width:30%">
    	<font color="#191970">
    	<?php foreach ($varas as $vrs):
    		if($VaraId==$vrs->VaraId){?>
    		<b><?php echo utf8_encode($vrs->Descricao)?></b>
    	<?php } endforeach;?>
    	</font>
    </td>
    <td style="font-color:#537F8B; width:12%">
    	<font color="#4169E1">
    		<b>&nbsp;TIPO DE AÇÃO</b>
    	</font>
    </td>
    <td style="width:13%">
    	<font color="#191970">
    		<b><?php echo $NomeTipoAcao ?></b>
    	</font>
    </td>     
  </tr>
  <tr>
    <td style="width:15%">
    	<font color="#4169E1">
    		<b>&nbsp;ANDAMENTO</b>
    	</font>
    </td>
    <td style="width:85%" colspan="6">
    	<font color="#191970">
		<?php
		if(!empty($andamentorecente)&&(sizeof($andamentorecente)>0)){
			foreach ($andamentorecente as $ands): ?>    	
    		<b><?php echo utf8_encode($ands->Descricao)?></b>
    	<?php endforeach;
		}else{ echo '-';} ?>
    	</font>
    </td> 
  </tr> 
  <tr>
    <td style="width:15%">
    	<font color="#4169E1">
    		<b>&nbsp;RESUMO</b>
    	</font>
    </td>
    <td style="width:85%;text-transform:uppercase;" colspan="6">
    	<font color="#191970">
    		<b><?php echo $ObsAcaoCivil?></b>
    	</font>
    </td> 
  </tr>   
</table>