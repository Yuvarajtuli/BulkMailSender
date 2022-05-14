<?php
$step=isset($_GET['step'])?$_GET['step']:0;
if ($step==1) {
	include 'connections.php';
	$mailid=isset($_GET['mailid'])?$_GET['mailid']:0;
	$element_number=isset($_GET['elmnum'])?$_GET['elmnum']:0;
	// common var defines
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	// check
	$pre_sql="select * from actionurl where mailid=$mailid and elementvalue=$element_number and urlactive=1";
	$run_pre=sqlsrv_query($conn,$pre_sql,$params,$options);
	$cnt=sqlsrv_num_rows($run_pre);
	$fetch=sqlsrv_fetch_array($run_pre);
	if ($cnt>0) {
		$sql="insert into tracker VALUES(".$mailid.",".$element_number.",GETDATE())";
		$runsql=sqlsrv_query($conn,$sql,$params,$options);
		header("location:".$fetch['redirecturl']);
	}
}
?>