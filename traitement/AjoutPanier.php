<?php
//include 'connexion_bdd.php';

function ajoutPanier($idClient, $idVente){
	//identifier votre BDD
	//$database = " ";
	$erreur=1;
	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';;


	if ($db_found) {
		$sqlpanier = "SELECT Panier FROM client WHERE IdClient = $idClient;";
		$resultpanier = mysqli_query($db_handle, $sqlpanier);
		$data = mysqli_fetch_assoc($resultpanier);
		if($data['Panier']==null){
			$sqlnull = "UPDATE client SET Panier = '$idVente' WHERE client.IdClient = $idClient";
				mysqli_query($db_handle, $sqlnull);
		}
		else{
			if(verifPanier($data,$idVente)){
				$panier = $data['Panier'].',' . $idVente;
				$sqladd = "UPDATE client SET Panier = '$panier' WHERE client.IdClient = $idClient";
				mysqli_query($db_handle, $sqladd);
			}
			else{
				$erreur=3;
			}
		}
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
	return $erreur;
}

function verifPanier($data,$idVente){
	$panier = $data['Panier'];
	$tok = strtok($panier,",");

	while ($tok != false) {
		if($tok == $idVente)
			return false;
  		$tok = strtok(",");
	}
	return true;
}

session_start();
$result = ajoutPanier($_SESSION['Id'],$_GET['idvente']);
header('Location: http://localhost/projet-piscine2023/viewproduit.php?id='.$_GET['idvente'].'&result='.$result);
exit;
?>
