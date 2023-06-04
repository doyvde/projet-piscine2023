<?php

//include 'connexion_bdd.php';

function suppressionVente($idVente){
	//identifier votre BDD
	//$database = " ";

	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';

	if ($db_found) {
		$sqlVente = "SELECT * FROM Vente WHERE IdVente = $idVente;";
		$resultVente = mysqli_query($db_handle, $sqlVente);
		$dataVente = mysqli_fetch_assoc($resultVente);
		if($dataVente['TypeVente']=='Negociation'){
			$sqlDeleteNego="DELETE FROM Negociation WHERE IdVente = $idVente";
			mysqli_query($db_handle, $sqlDeleteNego);
		}elseif($dataVente['TypeVente']=='Enchere'){
			$sqlDeleteAutoEnchere="DELETE FROM AutoEnchere WHERE IdVente = $idVente";
			mysqli_query($db_handle, $sqlDeleteAutoEnchere);
			$sqlDeleteEnchere="DELETE FROM Enchere WHERE IdVente = $idVente";
			mysqli_query($db_handle, $sqlDeleteEnchere);
		}
		$sqlDeleteEnchere="DELETE FROM Vente WHERE IdVente = $idVente";
		mysqli_query($db_handle, $sqlDeleteEnchere);
		header('Location: http://localhost/projet-piscine2023/tout.php');
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

suppressionVente($_GET['idvente']);

?>