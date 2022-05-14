
<?php
$serverName ="DESKTOP-PACUU73\MSSQLSERVER01";

$connectionInfo = array( "Database"=>"WTPL-mailServer");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if($conn){
}else{
	phpinfo();
	die(print_r(sqlsrv_errors(),true));
	
}

?>