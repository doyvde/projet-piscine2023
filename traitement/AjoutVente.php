<?php
//include 'connexion_bdd.php';

function importer(){
	if(isset($_FILES["image"])){ 
		$dossier = "../PhotoItem/";
		$fichier = basename($_FILES['image']['name']);
		$photo = $dossier.$fichier;
		move_uploaded_file($_FILES['image']['tmp_name'], $photo);
	}else{
		header('Location: http://localhost/projet-piscine2023/viewInscriptionVendeur.php?error=3');
		exit;
	}
}
function importer2(){
	if(isset($_FILES["image2"])){ 
		$dossier = "../PhotoItem/";
		$fichier = basename($_FILES['image2']['name']);
		$photo = $dossier.$fichier;
		move_uploaded_file($_FILES['image2']['tmp_name'], $photo);
	}else{
		header('Location: http://localhost/projet-piscine2023/viewInscriptionVendeur.php?error=3');
		exit;
	}
}
function importer3(){
	if(isset($_FILES["image3"])){ 
		$dossier = "../PhotoItem/";
		$fichier = basename($_FILES['image3']['name']);
		$photo = $dossier.$fichier;
		move_uploaded_file($_FILES['image3']['tmp_name'], $photo);
	}else{
		header('Location: http://localhost/projet-piscine2023/viewInscriptionVendeur.php?error=3');
		exit;
	}
}

function vente($idVendeur,$nom,$description,$categorie,$prixDepart,$prixAchatImmediat,$typeVente,$datefin,$photo,$image2,$image3){
	
	

	if($nom=="" || $description=="" || $categorie=="" || $prixDepart=="" || $prixAchatImmediat=="" || $typeVente=="" || $datefin=="" || $datefin < date('Y-m-d')){

  		header('Location: http://localhost/projet-piscine2023/viewcompte.php?error=1');
		exit;
	}else{
		ajoutVente($idVendeur,$nom,$description,$categorie,$prixDepart,$prixAchatImmediat,$typeVente,$datefin,$photo,$image2,$image3);
		header('Location: http://localhost/projet-piscine2023/viewcompte.php?result=1');
	}
}

function ajoutVente($idVendeur,$nom,$description,$categorie,$prixDepart,$prixAchatImmediat,$typeVente,$datefin,$photo,$image2,$image3){

	//$database = "ebayece";

  //connectez-vous dans votre BDD
  	list($db_found,$db_handle)=include 'connexion_bdd.php';
	$dateToday = date('Y-m-d');
	$sqlVente = "INSERT INTO `vente`(`IdVente`,`IdVendeur`, `Nom`, `Photo`, `Video`, `Description`, `Categorie`, `PrixDepart`, `PrixAchatImmediat`, `TypeVente`, `DateAjout`, `DateFin`, `Image2`, `Image3`)
	 VALUES (NULL,'$idVendeur','$nom','$photo',NULL,'$description','$categorie','$prixDepart','$prixAchatImmediat','$typeVente','$dateToday','$datefin','$image2','$image3')";
	$res = mysqli_query($db_handle, $sqlVente);

	mysqli_close($db_handle);

}


session_start();
$nom = isset($_POST["Nom"])? $_POST["Nom"] : "";
$description = isset($_POST["Description"])? $_POST["Description"] : "";
$categorie = isset($_POST["Categorie"])? $_POST["Categorie"] : "";
$prixDepart = isset($_POST["PrixDepart"])? $_POST["PrixDepart"] : "";
$prixAchatImmediat = isset($_POST["PrixAchatImmediat"])? $_POST["PrixAchatImmediat"] : "";
$typeVente = isset($_POST["TypeVente"])? $_POST["TypeVente"] : "";
$datefin = isset($_POST["DateFin"])? $_POST["DateFin"] : "";
$image="PhotoItem/".basename($_FILES['image']['name']);
$image2="PhotoItem/".basename($_FILES['image2']['name']);
$image3="PhotoItem/".basename($_FILES['image3']['name']);
vente($_SESSION['Id'],$nom,$description,$categorie,$prixDepart,$prixAchatImmediat,$typeVente,$datefin,$image,$image2,$image3);
importer();
importer2();
importer3();
?>