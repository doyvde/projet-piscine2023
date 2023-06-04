<?php
//include 'connexion_bdd.php';
function AchatImmediat($idVente, $idClient,$typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite){
	//identifier votre BDD
	//$database = " ";

	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';

	if ($db_found) {
		return traitement($idClient,$idVente,$db_handle,$typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite);

	}else{
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

function traitement($idClient,$idVente,$db_handle,$typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite){
	$sqlVente = "SELECT * FROM Vente WHERE IdVente = $idVente;";
	$resultVente = mysqli_query($db_handle, $sqlVente);
	$dataVente = mysqli_fetch_assoc($resultVente);
	include 'Payement.php';
	$prix = $dataVente['PrixAchatImmediat'];
	$retourTraitement =paiement($prix,$idClient, $typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite);
	if($retourTraitement == 5){
		addHistorique($dataVente,$idClient,$db_handle);
		suppressionVente($dataVente,$db_handle);
		return $retourTraitement;
	}
	else {
		return $retourTraitement;
	}
}

function addHistorique($dataVente,$idClient,$db_handle){
	$idVente = $dataVente['IdVente'];
	$idVendeur = $dataVente['IdVendeur'];
	$nom = $dataVente['Nom'];
	$photo = $dataVente['Photo'];
	$categorie = $dataVente['Categorie'];
	$prixDepart = $dataVente['PrixDepart'];
	$prixAchat = $dataVente['PrixAchatImmediat'];
	$description = $dataVente['Description'];

	$sqlHisto = "INSERT INTO `historique` (`IdVente`, `IdClient`, `IdVendeur`, `Nom`, `Photo`, `Video`, `Categorie`, `PrixDepart`, `PrixAchat`, `TypeAchat`, `Description`) VALUES ('$idVente', '$idClient', '$idVendeur', '$nom', '$photo', NULL, '$categorie', '$prixDepart', '$prixAchat', 'Immediat', '$description');";
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

function testRetour($retour){
	if($retour==5){
		header('Location: http://localhost/projet-piscine2023/viewcompte.php?result='.$retour);
		exit;
	}
	else {
		header('Location: http://localhost/projet-piscine2023/paiementImmediat.php?idvente='.$_GET['idvente'].'&error='.$retour);
		exit;
	}
}

session_start();
$type = isset($_POST["TypeCarte"])? $_POST["TypeCarte"] : "";
$numeroCarte = isset($_POST["NumCarte"])? $_POST["NumCarte"] : "";
$nomCarte = isset($_POST["NomCarte"])? $_POST["NomCarte"] : ""; 
$dateExpiration = isset($_POST["DateExpCarte"])? $_POST["DateExpCarte"] : ""; 
$codeSecurite = isset($_POST["CodeCarte"])? $_POST["CodeCarte"] : "";
$retour = AchatImmediat($_GET['idvente'],$_SESSION['Id'],$type,$numeroCarte,$nomCarte,$dateExpiration,$codeSecurite);
testRetour($retour);

?>