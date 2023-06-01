<?php
//include 'connexion_bdd.php';

function ajoutEnchere($prix, $idVente, $idClient){
	//identifier votre BDD

	$finenchere=0;
	//$database = "ebayece";

	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';

	if ($db_found) {
		//on regarde si il y a deja une enchere
		//si non
			//test que le prix soit superieur au prix depart si non erreur
			//si oui on cree une enchere
		//si oui
			//test que le prix soit superieur au prix actuel si non erreur
			//si oui on change l'enchere idclient et prix
			//test si il y a une enchere max
				// si elle est inferieure au prix on la supprime
				// si elle est superieur au prix on change l'enchere id client et prix

		$sqlEnchere = "SELECT * FROM Enchere WHERE IdVente = $idVente;";
		$resultEnchere = mysqli_query($db_handle, $sqlEnchere);

		if (mysqli_num_rows($resultEnchere) == 0){
			$finenchere=nouvelleEnchere($idVente,$idClient,$prix,$db_handle);
		}else{
			$data = mysqli_fetch_assoc($resultEnchere);
			$finenchere = modifEnchere($idVente,$idClient,$prix,$db_handle,$data);
			$sqlAutoEnchere = "SELECT * FROM Autoenchere WHERE IdVente = $idVente;";
			$resultAutoEnchere = mysqli_query($db_handle, $sqlAutoEnchere);
			if (mysqli_num_rows($resultAutoEnchere) > 0){
				$data2 = mysqli_fetch_assoc($resultAutoEnchere);
				$finenchere = modifAutoEnchere($idVente,$prix,$data2,$db_handle);
			}
		}
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);

	return $finenchere;
}


function nouvelleEnchere($idVente,$idClient,$prix,$db_handle){
	$sqlVente = "SELECT PrixDepart,PrixAchatImmediat FROM Vente WHERE IdVente = $idVente";
	$resultVente = mysqli_query($db_handle,$sqlVente);
	$data = mysqli_fetch_assoc($resultVente);
	if($data['PrixDepart']> $prix || $data['PrixAchatImmediat']<= $prix)
	{
		echo "Vous ne pouvez pas entrer ce prix!";
		return 3;
	}
	else{
		$sqlNewEnchere = "INSERT INTO enchere (IdVente, IdClient,PrixActuel) VALUES ('$idVente', '$idClient', '$prix')";
		$res = mysqli_query($db_handle, $sqlNewEnchere);
		if($res == false){
		//	echo "error creation enchere";
			return;
		}
		echo "creation de l'enchere";
		return 1;
	}
}


function modifEnchere($idVente,$idClient,$prix,$db_handle,$data){
	$sqlVente = "SELECT PrixAchatImmediat FROM Vente WHERE IdVente = $idVente";
	$resultVente = mysqli_query($db_handle,$sqlVente);
	$data2 = mysqli_fetch_assoc($resultVente);
	if($data['PrixActuel']>= $prix || $data2['PrixAchatImmediat']<= $prix){
		echo "Vous ne pouvez pas entrer ce prix!";
		return 3;
	}
	else{
		$sqlModifEnchere = "UPDATE enchere SET IdClient = $idClient, PrixActuel = $prix WHERE enchere.IdVente = $idVente ";
		$res = mysqli_query($db_handle, $sqlModifEnchere);
		if($res == false){
		//	echo "error creation enchere";
			return;
		}
		echo "modification de l'enchere";
		return 1;
	}
}

function modifAutoEnchere($idVente,$prix,$data,$db_handle){
	if($data['PrixMax']<= $prix){
		$sqlDelete = "DELETE FROM autoenchere WHERE IdVente = $idVente";
   	// Exécution de la requête
		$resultat = mysqli_query($db_handle, $sqlDelete);
		if ($resultat == FALSE) {
		//	echo "error suppression";
		}
		return 1;
	}
	$newPrix = $prix+1;
	$maxClient = $data['IdClient'];
	$sqlModifEnchere = "UPDATE enchere SET IdClient = $maxClient, PrixActuel = $newPrix WHERE enchere.IdVente = $idVente";
	$res = mysqli_query($db_handle, $sqlModifEnchere);
	if($res == false){
	//	echo "error creation enchere";
		return;
	}
	echo "modification de l'enchere";
	return 2;
}

session_start();
$prix = isset($_POST["prix"])? $_POST["prix"] : "";
$finenchere = ajoutEnchere($prix,$_GET['idvente'],$_SESSION['Id']);
header('Location: http://localhost/projet-piscine2023/viewproduit.php?id='.$_GET['idvente'].'&enchere='.$finenchere);
exit;
?>
