<?php
//include 'connexion_bdd.php';
function achatPanier($idClient,$typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite){
	//identifier votre BDD
	//$database = "ebayece";

	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';

	if ($db_found) {
		return traitement($idClient,$db_handle,$typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite);

	}else{
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

function traitement($idClient,$db_handle,$typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite){
	$sqlclient ="SELECT Panier FROM client WHERE IdClient=$idClient;";
	$resultClient = mysqli_query($db_handle, $sqlclient);
	$dataClient = mysqli_fetch_assoc($resultClient);
	if($dataClient['Panier']==NULL){
		header('Location: http://localhost/projet-piscine2023/viewPanier.php');
		exit;
	}
	$prix = calculPrix($dataClient,$db_handle);
	include 'Payement.php';
	$retourTraitement =paiement($prix,$idClient, $typeCarte, $numeroCarte, $nomCarte, $dateExpiration, $codeSecurite);
	if($retourTraitement == 5){
		achat($dataClient,$idClient,$db_handle);
		$sqldelete = "UPDATE client SET Panier = NULL WHERE client.IdClient = $idClient";
		mysqli_query($db_handle, $sqldelete);
		return $retourTraitement;
	}
	else {
		return $retourTraitement;
	}
}

function calculPrix($data,$db_handle){
	$panier = $data['Panier'];
	$tok = strtok($panier,",");
	$prix = 0;
	while ($tok != false) {
		$sqlVente ="SELECT PrixAchatImmediat FROM vente WHERE IdVente = $tok;";
		$resultVente = mysqli_query($db_handle, $sqlVente);
		$dataVente = mysqli_fetch_assoc($resultVente);
		$prix += $dataVente['PrixAchatImmediat'];
  		$tok = strtok(",");
	}
	return $prix;
}


function achat($data,$idClient,$db_handle){
	$panier = $data['Panier'];
	$tok = strtok($panier,",");
	$prix = 0;
	while ($tok != false) {
		$sqlVente ="SELECT * FROM vente WHERE IdVente = $tok;";
		$resultVente = mysqli_query($db_handle, $sqlVente);
		$dataVente = mysqli_fetch_assoc($resultVente);
		addHistorique($dataVente,$idClient,$db_handle);
		suppressionVente($dataVente,$db_handle);
  		$tok = strtok(",");
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

	$sqlHisto = "INSERT INTO `historique`(`IdVente`, `IdClient`, `IdVendeur`, `Nom`, `Photo`, `Video`, `Categorie`, `PrixDepart`, `PrixAchat`, `TypeAchat`, `Description`) VALUES  ('$idVente', '$idClient', '$idVendeur', '$nom', '$photo', NULL, '$categorie', '$prixDepart', '$prixAchat', 'Immediat', '$description')";
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

function testRetour($retour){
	if($retour==5){
		header('Location: http://localhost/projet-piscine2023/viewcompte.php?result='.$retour);
		exit;
	}
	else {
		header('Location: http://localhost/projet-piscine2023/paiementPanier.php?error='.$retour);
		exit;
	}
}

session_start();
$type = isset($_POST["TypeCarte"])? $_POST["TypeCarte"] : "";
$numeroCarte = isset($_POST["NumCarte"])? $_POST["NumCarte"] : "";
$nomCarte = isset($_POST["NomCarte"])? $_POST["NomCarte"] : ""; 
$dateExpiration = isset($_POST["DateExpCarte"])? $_POST["DateExpCarte"] : ""; 
$codeSecurite = isset($_POST["CodeCarte"])? $_POST["CodeCarte"] : "";
$retour = achatPanier($_SESSION['Id'],$type,$numeroCarte,$nomCarte,$dateExpiration,$codeSecurite);
testRetour($retour);

?>