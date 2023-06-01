<?php
session_reset();
session_start();
$_SESSION['Type']="";
$_SESSION['Id']="";
header('Location: http://localhost/projet-piscine2023/index.php');
exit;

 ?>