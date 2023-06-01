<?php

//include 'connexion_bdd.php';

function traitementNegocierVendeur($prixNego, $idVente, $idClient){
	//identifier votre BDD

	//$database = "ebayece";

	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';

	if ($db_found) {
		$sqlNego = "SELECT * FROM Negociation WHERE IdVente = $idVente AND IdClient = $idClient;";
		$resultNego = mysqli_query($db_handle,$sqlNego);
		$data = mysqli_fetch_assoc($resultNego);
		if($data['NbNego']==4){
			echo "vous ne pouvez plus negocier";
		}
		elseif($data['PrixNego']>$prixNego){
			echo "vous ne pouvez pas proposer un prix inferieur";
			$erreur=3; //erreur prix trop bas
		}
		else{
			$newNbNego = $data['NbNego']+1;
			$sqladd = "UPDATE negociation SET PrixNego = '$prixNego', NbNego = '$newNbNego' WHERE negociation.IdClient = $idClient AND negociation.IdVente = $idVente;" ;
			mysqli_query($db_handle, $sqladd);
			$erreur =1;
		}

	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);

	return $erreur;
}

function traitementNegocierClient($prixNego, $idVente, $idUser){
	//identifier votre BDD

	//$database = "ebayece";

	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';

	if ($db_found) {
		$sqlNego = "SELECT * FROM Negociation WHERE IdVente = $idVente AND IdClient = $idUser;";
		$resultNego = mysqli_query($db_handle,$sqlNego);
		$data = mysqli_fetch_assoc($resultNego);
		if($data['NbNego']==4)
			echo "vous ne pouvez plus negocier";
		elseif($data['PrixNego']<$prixNego){
			echo "vous ne pouvez pas proposer un prix superieur";
			$erreur=3;
		}
		else{
			$newNbNego = $data['NbNego']+1;
			$sqladd = "UPDATE negociation SET PrixNego = '$prixNego', NbNego = '$newNbNego' WHERE negociation.IdClient = $idUser AND negociation.IdVente = $idVente;" ;
			mysqli_query($db_handle, $sqladd);
			$erreur=1;
		}

	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);

	return $erreur;
}


 session_start();
 if($_SESSION['Type']=="Vendeur"){
	 $prix = isset($_POST["prix"])? $_POST["prix"] : "";
	 $error = traitementNegocierVendeur($prix,$_GET["idvente"],$_GET["IdClient"]);
	 header('Location:http://localhost/projet-piscine2023/viewcompte.php?result='.$error);
	 exit;
 }
 else{
	 $prix = isset($_POST["prix"])? $_POST["prix"] : "";
	 $error = traitementNegocierClient($prix,$_GET["idvente"],$_GET["IdClient"]);
	 header('Location:http://localhost/projet-piscine2023/viewcompte.php?result='.$error);
	 exit;
 }



?>
