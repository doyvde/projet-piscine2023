<?php session_start();
if($_SESSION['Type']=="" || $_SESSION['Id']=="")
{
  header('Location: http://localhost/projet-piscine2023/index.php');
  exit;
}
?>
<!doctype HTML>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="viewproduit.css" rel="stylesheet" type="text/css">
  <title>Drive Deal</title>
</head>
<body >
  <nav class="navbar navbar-expand-lg navbar-light align-items-end"  style="font-size:130%;font-weight:bold">
    <a class="navbar-brand" href="viewAccueil.php"> <img src="systeme/logo3.png" width="150"  alt="logo"></a>

    <form class="form-inline ml-auto" style="padding-left: 18%">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit"><img src="systeme/search.png" width="30" height="30" class="d-inline-block align-top" alt="search"></button>
    </form>

    <ul class="navbar-nav ml-auto align-items-end" >

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
          Catégories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="accessible.php">Nos pieces accessibles</a>
          <a class="dropdown-item" href="collection.php">Nos pieces de collection</a>
          <a class="dropdown-item" href="unique.php">Nos pieces uniques</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="tout.php">Voir tous les articles</a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" style="color:black" href="viewAbout.php">À propos</a>
      </li>

     <!-- <li class="nav-item">
        <a class="nav-link" style="color:black" href="viewachats.php">Achats & Négociations</a>
      </li>-->
      <!--<li class="nav-item">
        <a class="nav-link" href="viewventes.php">Vendre mon produit</a>
      </li>-->
      <li class="nav-item">
        <a class="navbar-brand" href="viewpanier.php">
          <img src="systeme/panier.png" width="40" height="40" class="d-inline-block align-top" alt="">

        </a>
      </li>
      <!--<li class="nav-item">
        <a class="nav-link" style="color:black" href="viewAdmin.php">Admin</a>
      </li>-->
       
      <li class="nav-item">
        <a class="nav-link" style="color:black" href="traitement/Logout.php">
          <input type="submit" class="btn btn-primary" style="text-transform:uppercase" value="Se deconnecter">
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link"style="color:black" href="viewcompte.php">
          <img src="systeme/compte.jpg" width="40" height="40" class="d-inline-block align-top" alt="compte">
        </a>
      </li>


    </ul>
  </nav>

  <section class="jumbotron text-center" style="background-image:url(bibli.png);" >
    <div class="container">
      <h1 class="jumbotron-heading align-items-top" style="font-size:500%;font-weight:bold;color:white">MON PRODUIT</h1>

    </div>
  </section>


  <?php
  include 'traitement/Produit.php';
  affichageProduit($_GET['id'],$_SESSION['Type']);
  $enchere = isset($_GET["enchere"])? $_GET["enchere"] : "";
  $nego = isset($_GET["nego"])? $_GET["nego"] : "";
  $autoenchere = isset($_GET["autoenchere"])? $_GET["autoenchere"] : "";
  $result = isset($_GET["result"])? $_GET["result"] : "";

  if($result==3){
    echo <<< FOOBAR
    <script language="javascript"> alert("Le produit est déjà dans votre panier"); </script>
    FOOBAR;
  }

  if($result==1){
    echo <<< FOOBAR
    <script language="javascript"> alert("Le produit a été ajouté au panier"); </script>
    FOOBAR;
  }
  if($enchere==3){
    echo <<< FOOBAR
    <script language="javascript"> alert("Vous ne pouvez pas entrer ce prix, l'offre n'a pas été ajoutée"); </script>
    FOOBAR;
  }

  if($enchere==1){
    echo <<< FOOBAR
    <script language="javascript"> alert("Bravo, l'offre a été ajoutée, vous avez acquis l'enchère"); </script>
    FOOBAR;
  }
  if($enchere==2){
    echo <<< FOOBAR
    <script language="javascript"> alert("Votre offre a été prise en compte mais un autre utilisateur a proposé un prix supérieur en auto-enchère"); </script>
    FOOBAR;
  }

  if($nego==1){
    echo <<< FOOBAR
    <script language="javascript"> alert("Bravo, votre première offre a été prise en compte"); </script>
    FOOBAR;
  }
  if($nego==2){
    echo <<< FOOBAR
    <script language="javascript"> alert("Vous ne pouvez pas proposer une offre à ce prix ou vous avez déjà proposé une négociation"); </script>
    FOOBAR;
  }
  if($autoenchere==3){
    echo <<< FOOBAR
    <script language="javascript"> alert("Vous ne pouvez pas entrer ce prix, l'offre n'a pas été ajoutée"); </script>
    FOOBAR;
  }

  if($autoenchere==1){
    echo <<< FOOBAR
    <script language="javascript"> alert("Bravo, l'offre a été ajoutée, vous avez acquis l'enchère"); </script>
    FOOBAR;
  }
  if($autoenchere==2){
    echo <<< FOOBAR
    <script language="javascript"> alert("Votre offre a été prise en compte mais un autre utilisateur a proposé un prix supérieur en auto-enchère"); </script>
    FOOBAR;
  }



  ?>

</body>
<br> 
<br>
<br>
<div>
<footer class="site-footer mt-auto" style="clear:both;height:150px;bottom:0px;width:100%; padding: 50px">
  <hr>
  
  <div class="container mt-2">
    <div class="row">
      <div class="col-sm-12 col-md-6" style="padding: 50px">
      <a href="viewAccueil.php"><input type="submit" class="btn btn-secondary" style="text-transform:uppercase" value="Retour en haut " ></a>
      </div>

      <div class="col-xs-6 col-md-3">
        
      </div>

      <div class=" col-md-3">
        <h6 style="padding: 50px"><strong>DRIVE DEAL</strong></h6>
      </div>
    </div>
    
  </div>
  <div class="footer-copyright text-center py-2" style="background-color:white">Copyright &copy; 2023 All Rights Reserved to Drive Deal
  </div>

</footer>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</html>