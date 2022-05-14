<?php
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$step=isset($_POST['step'])?$_POST['step']:0;
if ($step==1) {
	include 'functions/connections.php';
	// get from url
	$next=isset($_POST['next'])?$_POST['next']:0;
	$from=isset($_POST['from'])?$_POST['from']:0;
	$name=isset($_POST['name'])?$_POST['name']:'';
	$mailing=isset($_POST['mail'])?$_POST['mail']:'';
	$subject=isset($_POST['subject'])?$_POST['subject']:'';
	$type=isset($_POST['type'])?$_POST['type']:'';
	$url=isset($_POST['url'])?$_POST['url']:'files/tracker.csv';
	// date time genral
	date_default_timezone_set('Asia/Kolkata');
	$today_date=date("Y-m-d h:i:s");
	// common var defines
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	// insert mail
	$mailinsert = "insert into mails VALUES(".$from.",'".$name."','".$mailing."','".$type."','".$url."',0,'".$today_date."')";
	$runmailinsert = sqlsrv_query($conn,$mailinsert,$params,$options);
	// get id from mail table
	$getmailid = "select id from mails where tomail='".$mailing."' and deliverydate='".$today_date."'";
	$rungetmailid = sqlsrv_query($conn,$getmailid,$params,$options);
	$fetchmailid=sqlsrv_fetch_array($rungetmailid);
	// read csv for action url
	$row = 1;
	if (($handle = fopen($url, "r")) !== FALSE) {
	    while (($data = fgetcsv($handle, ",")) !== FALSE) {
	        $num = count($data);
	        if($row!=1){
		        // insert into actionurl
	        	$actionurlinsert = "insert into actionurl VALUES(".$fetchmailid['id'].",'".$data[0]."','".$data[2]."',".$data[3].",".$data[1].")";
	        	$runactionurlinsert=sqlsrv_query($conn,$actionurlinsert,$params,$options);
	    	}
	    	$row++;
	    }
	    fclose($handle);
	}
	// get sending user
	$getuser = "select name,email,password from admins where id=".$from;
	$rungetuser = sqlsrv_query($conn,$getuser,$params,$options);
	$fetchuser = sqlsrv_fetch_array($rungetuser);
	$fromname =$fetchuser['name'];
	$fromemail=$fetchuser['email'];
	$frompassword = $fetchuser['password'];
	// send mail system
	switch($type){
		case "Test (Try)":
			include 'formats/basic/index.php';
		break;
		case "Sales (Genral 1)":
			include 'formats/Mail 1/Mail 1/sales.php';
		break;
		default :
			$content="<a href='http://api.wtpl.com/mail/functions/action.php?step=1&mailid=".$fetchmailid['id']."&elmnum=1'>Click</a>";
		break;
	}
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/Exception.php';
    $mail = new PHPMailer;
    $mail->isSMTP();     
    $mail->SMTPDebug = 0;
    $mail->Host = gethostbyname('smtp.gmail.com');
    $mail->SMTPAuth = true;
    $mail->Username = $fromemail;
    $mail->Password = $frompassword;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
    $mail->setFrom($fromemail,$fromname);
    $mail->addAddress($mailing,$name);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $content;
    if(!$mail->send()) {
    // if ($next==1) {
    // 		$row=isset($_POST['row'])?$_POST['row']:0;
    // 		$tot=isset($_POST['tot'])?$_POST['tot']:0;
    // 		$row++;
    // 		header("location:http://api.wtpl.com/mail/backhand.php?step=1&row=".$row."&tot=".$tot."&subject=".$subject."&type=".$type);
    // 	}
    } else {
    	$sql = "update mails set deliverystatus = 1 where tomail='".$mailing."' and deliverydate='".$today_date."'";
    	$runsql=sqlsrv_query($conn,$sql,$params,$options);
    	// if ($next==1) {
    	// 	$row=isset($_POST['row'])?$_POST['row']:0;
    	// 	$tot=isset($_POST['tot'])?$_POST['tot']:0;
    	// 	$row++;
    	// 	header("location:http://api.wtpl.com/mail/backhand.php?step=1&row=".$row."&tot=".$tot."&subject=".$subject."&type=".$type);
    	// }
    }
echo $step;
}else{
	echo $step;
}
?>