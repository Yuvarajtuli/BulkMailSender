<?php
$step=isset($_POST['step'])?$_POST['step']:0;
if ($step==1) {
	$user=isset($_POST['user'])?$_POST['user']:1;
	$row=isset($_POST['row'])?$_POST['row']:1;
	$tot=isset($_POST['tot'])?$_POST['tot']:0;
	$url=isset($_POST['url'])?$_POST['url']:'http://api.wtpl.com/mail/files/tracker.csv';
	$def=isset($_POST['def'])?$_POST['def']:'http://api.wtpl.com/mail/files/contact.csv';
	// $subject=isset($_POST['subject'])?$_POST['subject']:'Testing Mail by Yuvaraj Tuli!';
	// $type=isset($_POST['type'])?$_POST['type']:'Testing';

	$name_arr='';
	$email_arr='';
	$cnt=0;
	if ($tot==0) {
		$ha = fopen($def, "r");
		while (($data = fgetcsv($ha,',')) !== FALSE) {
		$cnt++;
		}
		fclose($ha);
		$tot=$cnt;
	}
	// read csv for action url
	$handle = fopen($def, "r");
	$i=0;
	while (($data = fgetcsv($handle,',')) !== FALSE) {
		$i++;
		if ($i==$row) {
			if($row!=1){
		        if (strcmp($data[0], '')==0) {
		        	$name_arr='';
		        }else{
		        	$name_arr=$data[0];
		        }
		        if (strcmp($data[1], '')==0) {
		        	$email_arr='';
		        }else{
		        	$email_arr=$data[1];
		        }
	    	}
		}
	}
    fclose($handle);
	if ($row!=1) {
		// echo $row;
		if ($row==($tot+1)) {
			session_start();
			session_destroy();
			unlink("files/contact.csv");
			unlink("files/tracker.csv");
			echo "all mails sent!";
		}else{
			$vararray = [];
			array_push($vararray,$name_arr,$email_arr,$tot);
			echo $vararray[0].",".$vararray[1].",".$vararray[2];
			// header("location:http://api.wtpl.com/mail/send.php?step=1&next=1&row=".$row."&tot=".$tot."&from=".$user."&name=".$name_arr."&mail=".$email_arr."&subject=".$subject."&type=".$type."&url=".$url);
		}	
	}else{
		// $row++;
		// header("location:http://api.wtpl.com/mail/backhand.php?step=1&row=".$row."&tot=".$tot."&subject=".$subject."&type=".$type);
		// echo $row;
	}
	
}else {
	return 0;
}
?>