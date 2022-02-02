<?php
echo 'Teste'; 
echo $q = intval($_GET['q']);

$SQL = "Select Nome from vw_Varas where VaraId = '".$q."'";
$res = mssql_query($SQL);
while($RFP = mssql_fetch_array($res)) {
    echo $RFP['Nome'];
}
?>