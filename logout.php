<?php

session_start();
session_destroy();
 $fp = fopen("log.html", 'a');
    fwrite($fp, "<div style='color:red;'><i>User ". $_SESSION['user'] ." has left the chat session.</i><br></div>");
    fclose($fp);
header('Location:index.php');
?>