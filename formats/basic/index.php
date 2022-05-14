<?php 
$content = "<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
</head>
<body style='overflow:hidden;margin:0;scroll-behavior:smooth;background:rgba(0, 0, 0, 0.05);'>
	<div style='position:absolute;top:12%;left:25%;width:50%;height:auto;background:rgba(255,255,255,0.9);box-shadow:0 0 16px 0 rgba(0, 0, 0,0.2);border-radius:3px;overflow:hidden;font-family:arial;'>
		<div style='position:relative;width:100%;padding:20px;'>
			<span style='color:#111;'>Hi, ".$name."</span><br>
			<p style='text-transform:capitalize;font-size:15px;width:90%;line-height:25px;color:#333;'>
				Hope You and your family is doing well in this pandemic situation.<br>
				We have reached out to tell that Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</p>
			<br>
			<p style='text-transform:capitalize;font-size:15px;width:90%;line-height:25px;color:#333;'>
				Hope You and your family is doing well in this pandemic situation.<br>
				We have reached out to tell that Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua.
			</p>
			<br><br>
			<span style='color:#111;font-weight:600;'>Regards,</span><br><br>
			<a href='http://api.wtpl.com/mail/functions/action.php?step=1&mailid=".$fetchmailid['id']."&elmnum=1' style='color:#111;font-weight:300;letter-spacing:2px;text-decoration:none;'>Workman Technologies Pvt. Ltd.</a><br>
			<br>
			<a href='http://api.wtpl.com/mail/functions/action.php?step=1&mailid=".$fetchmailid['id']."&elmnum=2'><img src='images/logo.png' alt='Workman Technologies Logo' style='width:300px;height:73px;'></a>
		</div>
	</div>
</body>
</html>";
?>