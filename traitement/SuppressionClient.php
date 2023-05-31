<?php

//include 'connexion_bdd.php';

function suppressionClient($idClient){
	//identifier votre BDD
	//$database = "ebayece";

	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';

	if ($db_found) {
		$sqlVente ="SELECT * FROM Vente Where idClient = $idClient;";
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
	$idVente = $dataVente['IdVente'];
	if($dataVente['TypeVente']=='Negociation'){
		$sqlDeleteNego="UPDATE negociation SET IdClient = NULL WHERE IdVente = $idVente";
		mysqli_query($db_handle, $sqlDeleteNego);
	}elseif($dataVente['TypeVente']=='Enchere'){
		$sqlDeleteAutoEnchere="UPDATE AutoEnchere SET IdClient = NULL WHERE IdVente = $idVente";
		mysqli_query($db_handle, $sqlDeleteAutoEnchere);
		$sqlDeleteEnchere="UPDATE Enchere SET IdClient = NULL WHERE IdVente = $idVente";
		mysqli_query($db_handle, $sqlDeleteEnchere);
	}
	$sqlDeleteEnchere="UPDATE vente SET IdClient = NULL WHERE IdVente = $idVente";
	mysqli_query($db_handle, $sqlDeleteEnchere);
    $sqlDeleteEnchere="DELETE FROM historique WHERE IdVente = $idVente";
	mysqli_query($db_handle, $sqlDeleteEnchere);
}

suppressionVendeur($_GET['idvendeur']);
header('Location: viewAdmin.php?supress=1');
exit;
?>