<?php
//include 'connexion_bdd.php';
function FinEnchere(){
	date_default_timezone_set('Europe/Paris');
	//identifier votre BDD
	//$database = "ebayece";

	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include "connexion_bdd.php";;

	if ($db_found) {
		$sqlVente = "SELECT * FROM vente";
		$resultVente = mysqli_query($db_handle, $sqlVente);
		if (mysqli_num_rows($resultVente) == 0) {
			echo "Aucune Vente sur le site";
		}
		while($dataVente = mysqli_fetch_assoc($resultVente)){
			$date = date('Y-m-d');
			if($date > $dataVente['DateFin']){
				if($dataVente['TypeVente'] == 'Enchere'){
					$idVente = $dataVente['IdVente'];
					$sqlEnchere = "SELECT * FROM Enchere WHERE IdVente = $idVente;";
					$resultEnchere = mysqli_query($db_handle, $sqlEnchere);
					if(mysqli_num_rows($resultEnchere) == 0){
						suppressionVente($dataVente,$db_handle);
					}else{
						$dataEnchere = mysqli_fetch_assoc($resultEnchere);
						addaPayer($dataVente,$dataEnchere,$db_handle);
						suppressionVente($dataVente,$db_handle);
					}
				}else{
					suppressionVente($dataVente,$db_handle);
				}
			}
		}
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}




function addaPayer($dataVente,$dataEnchere,$db_handle){
	$idVente = $dataVente['IdVente'];
	$idVendeur = $dataVente['IdVendeur'];
	$idClient = $dataEnchere['IdClient'];
	$nom = $dataVente['Nom'];
	$photo = $dataVente['Photo'];
	$categorie = $dataVente['Categorie'];
	$prixDepart = $dataVente['PrixDepart'];
	$prixAchat = $dataEnchere['PrixActuel'];
	$description = $dataVente['Description'];

	$sqlHisto = "INSERT INTO `apayer` (`IdVente`, `IdClient`, `IdVendeur`, Nom, `PrixAchat`, PrixDepart, `Photo`, `Video`, Description, `TypeAchat`, Categorie) VALUES ('$idVente', '$idClient', '$idVendeur', '$nom', '$prixAchat', '$prixDepart', '$photo', NULL, '$description','Enchere', '$categorie');";
	mysqli_query($db_handle, $sqlHisto);
}


function suppressionVente($dataVente,$db_handle){
	$idVente = $dataVente['IdVente'];
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
}

FinEnchere();
?>
