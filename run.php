<?php
session_start();
if (isset($_SESSION["id"])) {}else {
	header("location:http://api.wtpl.com/mail/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Send Mail | Form</title>
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
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #ffc000;
  width: 120px;
  height: 120px;
  margin-left:45%;
  margin-top:18%;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}
.overlay{
	position:fixed;
	top:0;
	width:100%;
	height:100%;
	background:rgba(0,0,0,0.5);
	display:none;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
p{
	font-size:15px;
	color:#333;
	line-height:30px;
	letter-spacing:1px;
	text-transform:capitalize;
	padding:20px;
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
}
select{
	font-size:15px;
	color:#333;
	letter-spacing:1px;
	text-transform:capitalize;
	margin:20px;
	padding:10px;
}
option{
	text-transform:capitalize;
	color:#333;
	font-size:15px;
	letter-spacing:1px;
}
textarea{
	font-size:15px;
	color:#333;
	letter-spacing:1px;
	text-transform:capitalize;
	margin:20px;
	padding:10px;
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
</style>
</head>
<body>
	<div class="overlay"><div class="loader"></div></div>

<p>
	The contact file should be csv.<br>
	the csv file should have heading <span style="color:red;">(name,email)</span>.<br>
	<span style="color:red;">Note : Headings should be in  same order and same names as mentioned above.</span>
</p>
<p>
	The tracker file should also be csv file.<br>
	The csv file should have heading <span style="color:red;">(element,elementnumber,url,status)</span><br>
	<span style="color:red;">Note : Headings should be in  same order and same names as mentioned above.</span>
</p>
<center>
	<hr style="width:80%;height:2px;background:#333;border:0;border-radius:10px;">
</center>
<label>Select Contact File :-</label>
<input type="file" name="cfile" id="cfile" style="margin-left:0;padding:0;"><br>
<label>Select Tracking File :-</label>
<input type="file" name="tfile" id="tfile" style="margin-left:0;padding:0;"><br>
<label>Enter Subject Line :-</label><br>
<textarea id="subject" style="width:200px;height:200px;" placeholder="Enter Subject.."></textarea><br>
<label>Enter Content Type :-</label>
<select id="type" style="width:400px;">
	<option>Select Option</option>
	<option>Test (Try)</option>
	<option>Sales (Staff Augmentation)</option>
	<option>Sales (Software Development)</option>
	<option>Sales (SAAS Products)</option>
	<option>Sales (Genral 1)</option>
	<option>Sales (Genral 2)</option>
	<option>Job Application</option>
	<option>Job Discription</option>
	<option>Meeting Link</option>
	<option>Status (Heired / Rejected)</option>
	<option>On Boarding Link</option>
	<option>Contol Panal credentials</option>
	<option>On Boarding Link</option>
	<option>Exam Link</option>
	<option>Confirmations 1</option>
	<option>Confirmations 2</option>
</select><br>
<button type="button" id="send">Send Mails!</button>
<br><br><br><br>
<script src="jquery-1.11.0.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#send").click(function(){
			var cfile = $('#cfile')[0].files[0];
			var tfile = $('#tfile')[0].files[0];
			if (cfile=='' || tfile=='' || $("#subject").val()=='' || $("#type").val()=='') {
				alert("Please Enter all The Fields!");
			}else{
			$(".overlay").fadeIn();
			var form_data = new FormData();  
			form_data.append('step',2);
			form_data.append('cfile',cfile);
            form_data.append('tfile',tfile);
            // form_data.append('subject',$("#subject").val());
            // form_data.append('type',$("#type").val());
			$.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "functions/step",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data:  form_data 
            }).done(function() {
            	location.href="http://api.wtpl.com/mail/result?subject="+$("#subject").val()+"&type="+$("#type").val();
			}).fail(function() {
				alert("error");
				location.reload();
			});
		}
		});
	});
</script>
</body>
</html>