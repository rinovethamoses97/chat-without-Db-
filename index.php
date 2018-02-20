<?php
session_start()
?>
<?php
function login()
{
	echo '
	 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 <style>
	 body
		{
		
			background-image: url("https://storage.googleapis.com/gweb-uniblog-publish-prod/images/Background.2e16d0ba.fill-1422x800.jpg");
			background-size: cover;
		}
	 </style>
	 <h1 style="text-align:center;">Welcome to the R-chat</h1><br><br><br><br>
     <form action="index.php" method="post" style="margin-left:39%;">
     <label for="name">Name:</label>
     <input type="text" name="name" id="name">
     <input type="submit" class="btn btn-primary">
     </form>


	';
}

if(isset($_POST['name']))
{
   if($_POST['name']!="")
   {
   	 $_SESSION['user']=$_POST['name'];
   	 $f=fopen("log.html",'a');
   	 fwrite($f, "<div style='color:green;'><i>User ". $_SESSION['user'] ." is online.</i><br></div>");
   
   }
   else
   {
   	 ?>
     <script>
      alert("plz enter the name");
     </script>
   	 <?php
   }
}
?>
<?php
if(!isset($_SESSION['user']))
{
	login();
}
else
{
	
	?>
<!DOCTYPE html>
<html>
<head>
	<title>CHAT</title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style type="text/css">
		#message
		{
			height:50%;
		}
		#history
		{
			width:40%;
			height:50%;
			border:1px solid blue;
			background-color: white;
		}
		body
		{
		
			background-image: url("https://storage.googleapis.com/gweb-uniblog-publish-prod/images/Background.2e16d0ba.fill-1422x800.jpg");
			background-size: cover;
		}
	</style>
</head>
<body>
<h2 style="text-align:center; font-style: italic;font-size: 60px;">welcome <?php echo $_SESSION['user'] ?></h2>
<input type="button" style="margin-left: 47%" value="Exit chat" onclick="exit()" class="btn btn-danger"><br><br>
<div id="history" style="margin-left: 30%;">
	<?php
	if(filesize("log.html")>0)
	{
		$f=fopen("log.html",'r');
		$content=fread($f, filesize("log.html"));
		echo $content;
	}
	?>
</div>
<br>
<br>
<form method="post" action="" style="text-align: center;">

&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp	<input type="text" name="message" id="message" size="52" style="height: 35px; font-size: 18px;">&nbsp&nbsp&nbsp
	<input type="submit" value="send" onclick="send()"  class="btn btn-primary">
</form>
</body>
<script type="text/javascript">
	function exit()
	{
        var flag=confirm("Do you want to end the chat session?");
        if(flag)
        {
        	location="logout.php"
        }
	}
	function send()
	{
		var msg=document.getElementById("message").value;
		$.post("post.php",{text: msg});
		document.getElementById("message").value="";
		event.preventDefault();
	}
	function update()
	{
		$.ajax({url: "log.html", success: function(result){
            $("#history").html(result);
        }});
	}
	setInterval(update,2500);
</script>
</html>
<?php
}