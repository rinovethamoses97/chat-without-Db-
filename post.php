<?php
session_start();
$msg=$_POST['text'];
$f=fopen("log.html",'a');
fwrite($f,"<div>".date("d:m:y::h:i:s A")."--".$_SESSION['user']."::".$msg."<br></div>");

?>