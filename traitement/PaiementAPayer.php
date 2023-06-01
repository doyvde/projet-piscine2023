<?php
//include 'connexion_bdd.php';
function achatAPayer($idVente, $idClient,$typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite){
	//identifier votre BDD
	//$database = "ebayece";

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
	$sqlAPayer = "SELECT * FROM apayer WHERE IdVente = $idVente AND IdClient = $idClient;";
	$resultAPayer = mysqli_query($db_handle, $sqlAPayer);
	$dataAPayer = mysqli_fetch_assoc($resultAPayer);
	include 'Payement.php';
	$prix = $dataAPayer['PrixAchat'];
	$retourTraitement =paiement($prix,$idClient, $typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite);
	if($retourTraitement == 5){
		addHistorique($dataAPayer,$idClient,$db_handle);
		suppressionAPayer($dataAPayer,$db_handle);
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
	$prixAchat = $dataVente['PrixAchat'];
	$description = $dataVente['Description'];
	$typeAchat = $dataVente['TypeAchat'];

	$sqlHisto = "INSERT INTO `historique`(`IdVente`, `IdClient`, `IdVendeur`, `Nom`, `Photo`, `Video`, `Categorie`, `PrixDepart`, `PrixAchat`, `TypeAchat`, `Description`) VALUES  ('$idVente', '$idClient', '$idVendeur', '$nom', '$photo', NULL, '$categorie', '$prixDepart', '$prixAchat', '$typeAchat', '$description');";
	mysqli_query($db_handle, $sqlHisto);
}

function suppressionAPayer($dataAPayer,$db_handle){
	$idVente = $dataAPayer['IdVente'];
	$sqlDelete="DELETE FROM apayer WHERE IdVente = $idVente";
	mysqli_query($db_handle, $sqlDelete);
}

function testRetour($retour){
	if($retour==5){
		header('Location: http://localhost/projet-piscine2023/viewcompte.php?result='.$retour);
		exit;
	}
	else {
		header('Location: http://localhost/projet-piscine2023/paiementAPayer.php?idvente='.$_GET['idvente'].'&error='.$retour);
		exit;
	}
}

session_start();
$type = isset($_POST["TypeCarte"])? $_POST["TypeCarte"] : "";
$numeroCarte = isset($_POST["NumCarte"])? $_POST["NumCarte"] : "";
$nomCarte = isset($_POST["NomCarte"])? $_POST["NomCarte"] : ""; 
$dateExpiration = isset($_POST["DateExpCarte"])? $_POST["DateExpCarte"] : ""; 
$codeSecurite = isset($_POST["CodeCarte"])? $_POST["CodeCarte"] : "";
$retour = achatAPayer($_GET['idvente'],$_SESSION['Id'],$type,$numeroCarte,$nomCarte,$dateExpiration,$codeSecurite);
testRetour($retour);

?>