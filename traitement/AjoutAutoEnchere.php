<?php
//include 'connexion_bdd.php';

function ajoutAutoEnchere($prixMax, $idVente, $idClient){
	//identifier votre BDD
	//$database = " ";
	$fin;
	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';

	if ($db_found) {
		//on regarde si il existe une enchere max pour le produit
		//si non
			//on verifie que le prix proposé soit dans les cordes
			//on la cree et augmente le prix actuelle de l'enchere
		//si oui
			//on regarde si le prix de celle proposée est superieur au prix de celle actuelle
				//si oui
					//on fixe le prix de l'enchere a l'ancien prix max+1 et on modifie lenchere max
				//si non
					//on fixe le prix actuel au prix de l'enchere proposé plus 1 et c tout

		$sqlAutoEnchere = "SELECT * FROM autoenchere WHERE IdVente = $idVente;";
		$resultAutoEnchere = mysqli_query($db_handle, $sqlAutoEnchere);
		if (mysqli_num_rows($resultAutoEnchere) == 0){
			$fin=nouvelleAutoEnchere($idVente,$idClient,$prixMax,$db_handle);
		}else{
			$data = mysqli_fetch_assoc($resultAutoEnchere);
			if($data['IdClient']!=$idClient)
			$fin =modifAutoEnchere($idVente,$idClient,$prixMax,$db_handle,$data);
		}
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
	return $fin;
}


function nouvelleAutoEnchere($idVente, $idClient, $prixMax, $db_handle){
	$sqlEnchere ="SELECT * FROM enchere WHERE IdVente = $idVente";
	$resultEnchere = mysqli_query($db_handle,$sqlEnchere);
	if (mysqli_num_rows($resultEnchere) == 0){
		$fin = nouvelle($idVente,$idClient,$prixMax,$db_handle);
	}else{
		$data = mysqli_fetch_assoc($resultEnchere);
	$fin =modif($idVente,$idClient,$prixMax,$db_handle,$data);
	}
	return $fin;
}


function nouvelle($idVente,$idClient,$prixMax,$db_handle){
	$sqlVente = "SELECT PrixDepart, PrixAchatImmediat FROM Vente WHERE IdVente = $idVente";
	$resultVente = mysqli_query($db_handle,$sqlVente);
	$data = mysqli_fetch_assoc($resultVente);
	if($data['PrixDepart']> $prixMax || $data['PrixAchatImmediat']<= $prixMax){
		echo "Vous ne pouvez pas entrer ce prix!";
		return 3;
	}
	else{
		creationAutoEnchere($idVente,$idClient,$prixMax,$db_handle);
		$p = $data['PrixDepart'];
		$sqlNewEnchere = "INSERT INTO enchere (IdVente, IdClient,PrixActuel) VALUES ('$idVente', '$idClient', '$p')";
		$res = mysqli_query($db_handle, $sqlNewEnchere);
		if($res == false){
			echo "error creation enchere";
			return;
		}
		echo "creation de l'enchere";
		return 1;
	}
}


function modif($idVente,$idClient,$prixMax,$db_handle,$data){
	$sqlVente = "SELECT PrixAchatImmediat FROM Vente WHERE IdVente = $idVente";
	$resultVente = mysqli_query($db_handle,$sqlVente);
	$data2 = mysqli_fetch_assoc($resultVente);
	if($data['PrixActuel']> $prixMax || $data2['PrixAchatImmediat']<= $prixMax){
		echo "Vous ne pouvez pas entrer ce prix!";
		return 3;
	}
	else{
		creationAutoEnchere($idVente,$idClient,$prixMax,$db_handle);
		$newprix = $data['PrixActuel']+1;
		$sqlModifEnchere = "UPDATE enchere SET IdClient = $idClient, PrixActuel = $newprix WHERE enchere.IdVente = $idVente ";
		$res = mysqli_query($db_handle, $sqlModifEnchere);
		if($res == false){
			echo "error modification enchere";
			return;
		}
		echo "modification de l'enchere";
		return 1;
	}
}

function creationAutoEnchere($idVente,$idClient,$prixMax,$db_handle){
	$sqlAutoEnchere = "INSERT INTO `autoenchere` (`IdVente`, `IdClient`, `PrixMax`) VALUES ('$idVente', '$idClient', '$prixMax')";
	$res = mysqli_query($db_handle, $sqlAutoEnchere);
	if($res == false){
		echo "error creation Auto enchere";
		return;
	}
	echo "creation de l'Autoenchere";
}


function modifAutoEnchere($idVente,$idClient,$prixMax,$db_handle,$data){
	$sqlEnchere ="SELECT * FROM enchere WHERE IdVente = $idVente";
	$resultEnchere = mysqli_query($db_handle,$sqlEnchere);
	$data2 = mysqli_fetch_assoc($resultEnchere);
	if($prixMax < $data2['PrixActuel']){
		echo "prix impossible";
		return 3;
	}
	else{
		if($data['PrixMax'] > $prixMax){
			$newprix = $prixMax+1;
			$sqlModifEnchere = "UPDATE enchere SET PrixActuel = $newprix WHERE enchere.IdVente = $idVente ";
			$res = mysqli_query($db_handle, $sqlModifEnchere);
			if($res == false){
				echo "error modification enchere";
				return;
			}
			echo "modification de l'enchere";
			return 2;
		}
		else if($data['PrixMax'] == $prixMax){
			$newprix = $prixMax;
			$sqlModifEnchere = "UPDATE enchere SET PrixActuel = $newprix WHERE enchere.IdVente = $idVente ";
			$res = mysqli_query($db_handle, $sqlModifEnchere);
			if($res == false){
				echo "error modification enchere";
				return;
			}
			echo "modification de l'enchere";
			return 2;
		}else{
			$newprix = $data['PrixMax']+1;
			$sqlModifEnchere = "UPDATE enchere SET IdClient = $idClient, PrixActuel = $newprix WHERE enchere.IdVente = $idVente ";
			$sqlModifAutoEnchere = "UPDATE autoenchere SET IdClient = $idClient, PrixMax = $prixMax WHERE autoenchere.IdVente = $idVente";
			$res = mysqli_query($db_handle, $sqlModifEnchere);
			$res2 = mysqli_query($db_handle, $sqlModifAutoEnchere);
			if($res == false || $res2 == false){
				echo "error modification enchere";
				return;
			}
			echo "modification de l'enchere";
			return 1;

		}
	}
}

session_start();
$prix = isset($_POST["prix"])? $_POST["prix"] : "";
$finenchere = ajoutAutoEnchere($prix,$_GET['idvente'],$_SESSION['Id']);
header('Location: http://localhost/projet-piscine2023/viewproduit.php?id='.$_GET['idvente'].'&autoenchere='.$finenchere);
exit;

?>
