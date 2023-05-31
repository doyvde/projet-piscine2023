<?php
//include 'connexion_bdd.php';

function importer(){
	if(isset($_FILES["image"])){ 
		$dossier = "PhotoProfil/";
		$fichier = basename($_FILES['image']['name']);
		$photo = $dossier.$fichier;
		move_uploaded_file($_FILES['image']['tmp_name'], $photo);
	}else{
		header('Location: http://localhost/projet-piscine2023/viewInscriptionVendeur.php?error=3');
		exit;
	}
}



function inscrireVendeur($nom,$prenom,$tel,$email,$pays,$identifiant,$mdp,$image){
	
	//$database = "ebayece";

  	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'traitement/connexion_bdd.php';

	$sqlVendeur = "INSERT INTO `vendeur` (`IdVendeur`, `E-mail`, `Pseudo`, `MotDePasse`, `Photo`, `Nom`, Prenom, `Pays`, `Telephone`, `PorteMonnaie`) VALUES (NULL, '$email', '$identifiant', '$mdp', '$image', '$nom', '$prenom', '$pays', '$tel', '0')";
	$res = mysqli_query($db_handle, $sqlVendeur);

	mysqli_close($db_handle);

}


$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
$tel = isset($_POST["telephone"])? $_POST["telephone"] : "";
$email= isset($_POST["email"])? $_POST["email"] : "";
$pays = isset($_POST["pays"])? $_POST["pays"] : "";
$identifiant= isset($_POST["identifiant"])? $_POST["identifiant"] : "";
$mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";
$image="PhotoProfil/".basename($_FILES['image']['name']);

if($nom=="" || $prenom =="" || $tel=="" || $email=="" || $pays=="" || $identifiant=="" || $mdp==""){
	header('Location: http://localhost/projet-piscine2023/viewInscriptionVendeur.php?error=1');
	exit;

}
else{
	inscrireVendeur($nom,$prenom, $tel,$email,$pays,$identifiant,$mdp,$image);
	importer();
	header('Location: http://localhost/projet-piscine2023/index.php?error=2');
	exit;
}
?>