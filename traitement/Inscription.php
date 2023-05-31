<?php
//include 'connexion_bdd.php';

function inscrireClient ($nom,$prenom,$tel,$email,$adresse,$ville,$codePostal,$pays,$identifiant,$mdp,$typeCarte,$nomCarte,$numCarte,$dateExpi,$codeSecu,$porteMonnaie,$image){

  //$database = "ebayece";

  //connectez-vous dans votre BDD
  list($db_found,$db_handle)=include 'connexion_bdd.php';

  $sqlClient = "INSERT INTO `client`(`Nom`, `Prenom`, `E-mail`, `Pseudo`, `MotDePasse`, `Adresse`, `CodePostal`, `Ville`, `Pays`, `Telephone`,`Panier`,`TypeCarte`,`NumCarte`,`NomCarte`,`DateExpCarte`,`CodeCarte`,`PorteMonnaie`,`Photo`)
  VALUES  ('$nom', '$prenom', '$email', '$identifiant', '$mdp', '$adresse', '$codePostal', '$ville', '$pays', '$tel',NULL, '$typeCarte','$numCarte','$nomCarte','$dateExpi','$codeSecu','$porteMonnaie','$image')";

  $res = mysqli_query($db_handle, $sqlClient);


  mysqli_close($db_handle);

}


$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
$tel = isset($_POST["telephone"])? $_POST["telephone"] : "";
$email= isset($_POST["email"])? $_POST["email"] : "";
$adresse = isset($_POST["adresse"])? $_POST["adresse"] : "";
$ville = isset($_POST["ville"])? $_POST["ville"] : "";
$codePostal = isset($_POST["codepostal"])? $_POST["codepostal"] : "";
$pays = isset($_POST["pays"])? $_POST["pays"] : "";
$identifiant= isset($_POST["identifiant"])? $_POST["identifiant"] : "";
$mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";
$typeCarte = isset($_POST["typecarte"])? $_POST["typecarte"] : "";
$nomCarte = isset($_POST["nomcarte"])? $_POST["nomcarte"] : "";
$numCarte = isset($_POST["numcarte"])? $_POST["numcarte"] : "";
$dateExpi = isset($_POST["dateExpi"])? $_POST["dateExpi"] : "";
$codeSecu = isset($_POST["crypto"])? $_POST["crypto"] : "";
$porteMonnaie = isset($_POST["portemonnaie"])? $_POST["portemonnaie"] : "";

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
      move_uploaded_file($file_tmp, "../PhotoProfil/" . $file_name);
      echo "Image uploaded successfully.";
  } else {
      print_r($errors);
  }
}

$image=$file_name;//" isset($_POST["image"])? $_POST["image"] : "";

if($nom=="" || $prenom=="" || $tel=="" || $email=="" || $adresse=="" || $ville=="" || $codePostal=="" || $pays=="" || $identifiant=="" ||
$mdp=="" || $typeCarte=="" || $nomCarte=="" || $numCarte=="" || $dateExpi==""||$codeSecu==""||$porteMonnaie==""||$image==""){

  header('Location: http://localhost/projet-piscine2023/viewInscription.php?error=1');
  exit;

}
else{
  inscrireClient ($nom,$prenom,$tel,$email,$adresse,$ville,$codePostal,$pays,$identifiant,$mdp,$typeCarte,$nomCarte,$numCarte,$dateExpi,$codeSecu,$porteMonnaie,$image);
  header('Location: http://localhost/projet-piscine2023/index.php?error=2');
  exit;
}
?>
