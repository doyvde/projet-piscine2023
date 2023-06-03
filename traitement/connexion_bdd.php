<?php

	//identifier votre BDD
	$database = "projet-piscine2023";
	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','montretout1');
	$db_found = mysqli_select_db($db_handle, $database);

	return array($db_found,$db_handle);


?>