
<?php

//include 'connexion_bdd.php';

function validerNegoVendeur($idClient,$idVente){
	//identifier votre BDD
	//$database = "ebayece";

	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';

	if ($db_found) {
		validerVendeur($idClient,$db_handle,$idVente);
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}



function validerVendeur($idClient,$db_handle,$idVente){

	$sqlNego ="SELECT * FROM Negociation Where IdClient = $idClient AND IdVente = $idVente;";
	$resultNego = mysqli_query($db_handle, $sqlNego);
	$dataNego =  mysqli_fetch_assoc($resultNego);
	$sqlVente = "SELECT * FROM Vente Where IdVente = $idVente;";
	$resultVente = mysqli_query($db_handle, $sqlVente);
	$dataVente =  mysqli_fetch_assoc($resultVente);
	addaPayer($dataVente,$dataNego,$db_handle);
	suppressionVente($dataVente,$db_handle);
}


function addaPayer($dataVente,$dataNego,$db_handle){
	$idVente = $dataVente['IdVente'];
	$idVendeur = $dataVente['IdVendeur'];
	$idClient = $dataNego['IdClient'];
	$nom = $dataVente['Nom'];
	$photo = $dataVente['Photo'];
	$categorie = $dataVente['Categorie'];
	$prixDepart = $dataVente['PrixDepart'];
	$prixAchat = $dataNego['PrixNego'];
	$description = $dataVente['Description'];

	$sqlHisto = "INSERT INTO `apayer` (`IdVente`, `IdClient`, `IdVendeur`, Nom, `PrixAchat`, PrixDepart, `Photo`, `Video`, Description, `TypeAchat`, Categorie) VALUES ('$idVente', '$idClient', '$idVendeur', '$nom', '$prixAchat', '$prixDepart', '$photo', NULL, '$description','Negociation', '$categorie');";
	$res = mysqli_query($db_handle, $sqlHisto);
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

validerNegoVendeur($_GET['IdClient'],$_GET['idvente']);
header('Location: http://localhost/projet-piscine2023/viewcompte.php?result=4');
exit;

?>
