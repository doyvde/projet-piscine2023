<?php

//include 'connexion_bdd.php';

function refuserNego($idClient,$idVente){
	//identifier votre BDD
	//$database = " ";

	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';

	if ($db_found) {
		refuser($idClient,$db_handle,$idVente);
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

function refuser($idClient,$db_handle,$idVente){
	$sqlNego ="DELETE FROM Negociation Where IdClient = $idClient AND IdVente= $idVente ";
	mysqli_query($db_handle, $sqlNego);
}

refuserNego($_GET['IdClient'],$_GET['idvente']);
header('Location: http://localhost/projet-piscine2023/viewcompte.php?result=7');
exit;


?>