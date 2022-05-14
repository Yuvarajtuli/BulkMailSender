<?php

$step=isset($_POST['step'])?$_POST['step']:3;
switch ($step) {
	case 1:
		$email=isset($_POST['email'])?$_POST['email']:'';
		$password=isset($_POST['password'])?$_POST['password']:'';
		include 'connections.php';
		$sql="select id from admins where email='".$email."' and password='".$password."'";
		$run=sqlsrv_query($conn,$sql);
		$fetch=sqlsrv_fetch_array($run);
		session_start();
		$_SESSION["id"]=$fetch["id"];
		break;
	case 2:
		$cfile=isset($_FILES['cfile']['name'])?$_FILES['cfile']['name']:"";
		if(strcmp($cfile, "")!=0){
			$cl="../files/contact.csv";
		move_uploaded_file($_FILES['cfile']['tmp_name'], $cl);
		}

		$tfile=isset($_FILES['tfile']['name'])?$_FILES['tfile']['name']:"";
		if(strcmp($tfile, "")!=0)
		{
			$tl="../files/tracker.csv";
		move_uploaded_file($_FILES['tfile']['tmp_name'], $tl);
		}
		// $subject=isset($_POST['subject'])?$_POST['subject']:'';
		// $type=isset($_POST['type'])?$_POST['type']:'';
		// header("location:http://api.wtpl.com/mail/backhand.php?step=1&subject=".$subject."&type=".$type);
		break;
		case 3:
			$email=isset($_POST['email'])?$_POST['email']:'';
			$password=isset($_POST['password'])?$_POST['password']:'';
			include 'encypt.php';
			$password = encrypt($password);
			include 'connections.php';
			$sql="Insert into admins (email,[password],lastusedate,verify,currentstatus) VALUES ('".$email."','".$password."',getdate(),1,1)";
			$run=sqlsrv_query($conn,$sql);
			$fetch=sqlsrv_fetch_array($run);
			session_start();
			$_SESSION["id"]=$fetch["id"];
		break;
	default:
		return 0;
		break;
}
?>