<?php 
session_start();
if (isset($_SESSION["id"])) {}else {
	header("location:http://api.wtpl.com/mail/index.php");
}
$subject=isset($_GET['subject'])?$_GET['subject']:'';
$type=isset($_GET['type'])?$_GET['type']:'';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Result mailing</title>
</head>
<body>
	<input type="text" id="subject" hidden value="<?php echo $subject; ?>" style="display: block;">
	<input type="text" id="type" hidden value="<?php echo $type; ?>" style="display: block;">
	<input type="text" id="ids" hidden value="<?php echo $_SESSION['id']; ?>" style="display: block;">
	<p id="emailids"></p>
	<p id="emailNames"></p>
	<script src="jquery-1.11.0.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$.fn.sendMail=(next,from,name,mail,subject,type)=>{
				var form_data = new FormData();  
				form_data.append('step',1);
				form_data.append('next',next);
	            form_data.append('from',from);
	            form_data.append('name',name);
	            form_data.append('mail',mail);
	            form_data.append('subject',subject);
	            form_data.append('type',type);
	            // form_data.append('url',url);
				$.ajax({
	                        type: "POST",
	                        dataType: 'html',
	                        url: "send",
	                        cache: false,
	                        contentType: false,
	                        processData: false,
	                        data:  form_data 
	            }).done(function(data) {
	            	alert(data);
				}).fail(function() {
					alert("error");
				});
			}
			$.fn.getContacts = function(row,tot){
				
				var ids = $("#ids").val();
				var type = $("#type").val();
				var subject = $("#subject").val();
				var form_data = new FormData();  
				form_data.append('step',1);
				form_data.append('user',ids);
	            form_data.append('row',row);
	            form_data.append('tot',tot);
				$.ajax({
	                        type: "POST",
	                        dataType: 'html',
	                        url: "backhand",
	                        cache: false,
	                        contentType: false,
	                        processData: false,
	                        data:  form_data 
	            }).done(function(data) {
	            	if(data==""){
	            		var temp_rows = row;
	            		temp_rows++;
	            		$.fn.getContacts(temp_rows,tot);
	            	}else if(data == "all mails sent!"){
	            		setTimeout(function () {location.href="http://api.wtpl.com/mail/result?msg=All mails Sent!";},10000);
	            	}else{
	            		data = data.split(",");
	            		var prev = $("#emailids").html();
	            		var prev_name = $("#emailNames").html();
	            		$("#emailids").html(prev + "<br>" + data[1]);
	            		$("#emailNames").html(prev_name + "<br>" + data[0] + data[2]);
	            		temp_rows1 = row;
	            		temp_rows1++;
	            		// var form_user = ids;
	            		$.fn.sendMail(1,ids,data[0],data[1],subject,type);
	            		$.fn.getContacts(temp_rows1,data[2]);
	            	}
	            	// location.href="http://api.wtpl.com/mail/result?subject="+$("#subject").val()+"&type="+$("#type").val();

				}).fail(function() {
					alert("error");
					// location.reload();
				});
			}
			$.fn.getContacts(1,0);
		});
	</script>
</body>
</html>

