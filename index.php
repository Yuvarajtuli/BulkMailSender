<?php
session_start();
$msg=isset($_GET['msg'])?$_GET['msg']:'';
if (isset($_SESSION["id"])) {
	header("location:http://api.wtpl.com/mail/run.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Send Mails</title>
		<style>
		body,html{
			margin:0;
		}
		*{
			font-family:arial;
		}
		*:focus{
			outline:none;
		}
		label{
	font-size:18px;
	color:#333;
	line-height:40px;
	letter-spacing:1px;
	text-transform:capitalize;
	padding:20px;
}
input{
	font-size:15px;
	color:#333;
	letter-spacing:1px;
	text-transform:capitalize;
	margin:20px;
	padding:10px;
	width:400px;
}
button{
	font-size:18px;
	color:#333;
	letter-spacing:1px;
	text-transform:capitalize;
	padding:10px;
	margin:20px;
	background:#222;
	color:#ffc000;
	border:0;
	border-radius:5px;
	cursor:pointer;
}
::placeholder{
	font-size:15px;
	color:#333;
	letter-spacing:1px;
	text-transform:capitalize;
}
p{
	font-size:25px;
	color:#333;
	line-height:30px;
	letter-spacing:1px;
	text-transform:capitalize;
	padding:20px;
}
</style>
</head>
<body>
<label>Enter Actual Email id :-</label>
<input type="email" id="email" placeholder="Enter Email id"><br>
<label>Enter Orignal Password Of this Email Id :-</label>
<input type="password" id="pass" placeholder="Enter Password"><br>
<button type="button" id="sub">LogIn!</button>
<a href="register.php"><button type="button" id="register">Register!</button></a>
<br><br>
<p><span style="color:red;">
<?php 
echo $msg;
?></span>
</p>
</body>
</html>
<script src="jquery-1.11.0.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#sub").click(function() {
			if ($("#email").val()=='' || $("#pass").val()=='') {
				alert("Please Enter All The Fields!");
			}else{
			var form_data = new FormData();  
			form_data.append('step',1);
			form_data.append('email',$("#email").val());
            form_data.append('password',$("#pass").val());
			$.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "functions/step",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data:  form_data 
            }).done(function() {
				location.href="run.php";
			}).fail(function() {
				alert("error");
			});
			}
		});
	});
</script>