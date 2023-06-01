<?php

//include 'connexion_bdd.php';

function suppressionClient($idClient){
	//identifier votre BDD
	//$database = "ebayece";

	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';

	if ($db_found) {
		$sqlVente ="SELECT * FROM client Where IdClient = $idClient;";
		$resultVente = mysqli_query($db_handle, $sqlVente);
		while($dataVente= mysqli_fetch_assoc($resultVente)){
			suppressionVenteClient($dataVente,$db_handle);
		}
		$sqlDelete = "DELETE FROM client WHERE IdClient=$idClient;";
		mysqli_query($db_handle, $sqlDelete);
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}


function suppressionVenteClient($dataVente,$db_handle){
	$idVente = $dataVente['IdClient'];
	$sqlDeleteNego="DELETE FROM negociation WHERE IdClient = $idVente";
	mysqli_query($db_handle, $sqlDeleteNego);
	$sqlDeleteAutoEnchere="DELETE FROM AutoEnchere  WHERE IdClient = $idVente";
	mysqli_query($db_handle, $sqlDeleteAutoEnchere);
	$sqlDeleteEnchere="DELETE FROM Enchere  WHERE IdClient = $idVente";
	mysqli_query($db_handle, $sqlDeleteEnchere);
    $sqlDeleteEnchere="DELETE FROM historique WHERE IdClient = $idVente";
	mysqli_query($db_handle, $sqlDeleteEnchere);
}

suppressionClient($_GET['idvendeur']);
header('Location: http://localhost/projet-piscine2023/viewcompte.php?supress=2');
exit;
?>