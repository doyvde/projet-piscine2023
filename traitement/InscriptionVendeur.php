<?php
//include 'connexion_bdd.php';

function inscrireVendeur($nom,$prenom,$tel,$email,$pays,$identifiant,$mdp){
	
	
	if(isset($_FILES['image'])){
		$errors = array();
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_tmp = $_FILES['image']['tmp_name'];
		$file_type = $_FILES['image']['type'];
		$file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
	
		$extensions = array("jpeg", "jpg", "png");
	
		if (in_array($file_ext, $extensions) === false) {
			$errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
		}
	
		if ($file_size > 2097152) {
			$errors[] = 'File size must be less than 2 MB';
		}
	
		if (empty($errors) == true) {
			$destination_folder = "../PhotoProfil/";
			$destination_path = $destination_folder . $file_name;
			move_uploaded_file($file_tmp, $destination_path);
			echo "Image uploaded successfully. Path: " . $destination_path;
		} else {
			print_r($errors);
		}
	}


	/*$dossier = 'PhotoProfil/';
	$image = isset($_POST["image"])? $_POST["image"] : "";
	$photo = $dossier. $fichier;
	//$database = "ebayece";

  	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';

	$sqlVendeur = "INSERT INTO `vendeur`(`IdVendeur`, `E-mail`, `Pseudo`, `MotDePasse`, `Photo`, `ImageFond`, `Nom`, `Prenom`, `Pays`, `Telephone`, `PorteMonnaie`) VALUES  (NULL, '$email', '$identifiant', '$mdp', '$photo1', '$photo1', '$nom', '$prenom', '$pays', '$tel', NULL)";
	$res = mysqli_query($db_handle, $sqlVendeur);
	echo '<div class="title mt-5 mb-2 justify-content-center" style="color:red"> Pas de rajout à la base. </div>';
	mysqli_close($db_handle);*/

}


$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
$tel = isset($_POST["telephone"])? $_POST["telephone"] : "";
$email= isset($_POST["email"])? $_POST["email"] : "";
$pays = isset($_POST["pays"])? $_POST["pays"] : "";
$identifiant= isset($_POST["identifiant"])? $_POST["identifiant"] : "";
$mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";

if($nom=="" || $prenom =="" || $tel=="" || $email=="" || $pays=="" || $identifiant=="" || $mdp==""){
	//header('Location: http://localhost/projet-piscine2023/viewInscriptionVendeur.php?error=1');
	exit;

}
else{
	inscrireVendeur($nom,$prenom, $tel,$email,$pays,$identifiant,$mdp);
	//header('Location: Location: http://localhost/projet-piscine2023/index.php?error=2');
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Importation d'image</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="image">Choisir une image :</label>
        <input type="file" name="image" id="image">
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>
