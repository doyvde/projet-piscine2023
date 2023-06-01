<?php session_start();
if($_SESSION['Type']=="" || $_SESSION['Id']=="")
{
  header('Location: http://localhost/projet-piscine2023/index.php');
  exit;
}
?>
<!doctype html>
<html >
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="viewachats.css" rel="stylesheet" type="text/css">
  <title>Ebay Ece</title>
</head>
<body >
  <nav class="navbar navbar-expand-lg navbar-light align-items-end"  style="font-size:130%;font-weight:bold">
    <a class="navbar-brand" href="viewAccueil.php"> <img src="systeme/logo3.png" width="150"  alt="logo"></a>

    <form action="traitement/Search.php" method="post" class="form-inline ml-auto" style="padding-left: 18%">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
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

      <?php
      if($_SESSION['Type']=="Client"){
        echo'
        <li class="nav-item">
          <a class="navbar-brand" href="viewpanier.php">
            <img src="systeme/panier.png" width="40" height="40" class="d-inline-block align-top" alt="">

          </a>
        </li>';
      }?>
      <!--<li class="nav-item">
        <a class="nav-link" style="color:black" href="viewAdmin.php">Admin</a>
      </li>-->
       
      <li class="nav-item">
        <a class="nav-link" style="color:black" href="traitement/Logout.php">
          <input type="submit" class="btn btn-primary" style="text-transform:uppercase" value="Se deconnecter">
        </a>
      </li>
      <?php
      if($_SESSION['Type']=="Vendeur"){
        $id=$_SESSION['Id'];
        list($db_found,$db_handle)=include 'traitement/connexion_bdd.php';
        if ($db_found) {
          $sqlVendeur = "SELECT * FROM vendeur WHERE IdVendeur = $id;";
          $resultVendeur = mysqli_query($db_handle, $sqlVendeur);
          if (mysqli_num_rows($resultVendeur) == 0) {
            //le livre recherché n'existe pas
            echo "Aucun Vendeur";
          }else {
            $data = mysqli_fetch_assoc($resultVendeur);
              echo <<< FOOBAR
              <li class="nav-item">
                <a class="nav-link"style="color:black" href="viewcompte.php">
                  <img src="{$data['Photo']}" width="40" height="40" class="d-inline-block align-top" alt="compte" style="border-radius: 100%;">
                </a>
              </li> 
              FOOBAR;
            }}
        
      }elseif($_SESSION['Type']=="Client"){
        $id=$_SESSION['Id'];
        list($db_found,$db_handle)=include 'traitement/connexion_bdd.php';
        if ($db_found) {
          $sqlClient = "SELECT * FROM client WHERE IdClient = $id;";
          $resultClient = mysqli_query($db_handle, $sqlClient);
          if (mysqli_num_rows($resultClient) == 0) {
            //le livre recherché n'existe pas
            echo "Aucun Client";
          }else {
            $data = mysqli_fetch_assoc($resultClient);
              echo <<< FOOBAR
              <li class="nav-item">
                <a class="nav-link"style="color:black" href="viewcompte.php">
                  <img src="{$data['Photo']}" width="40" height="40" class="d-inline-block align-top" alt="compte" style="border-radius: 100%;">
                </a>
              </li> 
              FOOBAR;
            }}
      }else{
      echo'<li class="nav-item">
        <a class="nav-link"style="color:black" href="viewcompte.php">
          <img src="systeme/compte.jpg" width="40" height="40" class="d-inline-block align-top" alt="compte">
        </a>
      </li>';}
      ?>

    </ul>
  </nav>

  <section class="jumbotron text-center" style="background-image:url(ventes.jpg);" >
    <div class="container">
      <h1 class="jumbotron-heading align-items-top" style="font-size:500%;font-weight:bold;color:white">ACHATS</h1>

    </div>
  </section>

  <div class=container>
    <h4 style="font-weight:bold;color:black">Vos Negociations en cours</h4>
    <hr>
    <?php include'traitement/AffichageNego.php';
    affichageNego($_SESSION['Id'],$_SESSION['Type']); ?>
    <hr>
    <h4 style="font-weight:bold;color:black">Votre Historique d'achats</h4>
    <hr>
    <?php include'traitement/Achat.php';
      affichageAchat($_SESSION['Type'],$_SESSION['Id']); 
    ?>

    <?php $result = isset($_GET["result"])? $_GET["result"] : "";

    if($result==3){
      echo <<< FOOBAR
      <script language="javascript"> alert("Vous ne pouvez pas entrer ce prix, l'offre n'a pas été ajoutée veuillez réessayer ou contacter un administrateur"); </script>
      FOOBAR;
    }

    if($result==1){
      echo <<< FOOBAR
      <script language="javascript"> alert("Bravo, l'offre a été ajoutée, attendez maintenant la réponse de l'autre partie"); </script>
      FOOBAR;
    }

    if($result==5){
      echo <<< FOOBAR
      <script language="javascript"> alert("Bravo, vous avez acquis l'objet"); </script>
      FOOBAR;
    }

    if($result==4){
      echo <<< FOOBAR
      <script language="javascript"> alert("Vous avez accepté la négociation, restez en attente du paiement du client"); </script>
      FOOBAR;
    }
    if($result==6){
      echo <<< FOOBAR
      <script language="javascript"> alert("Vous avez refusé la négociation, cette négociation n'apparaitra plus chez le client"); </script>
      FOOBAR;
    }?>
  </div>

  </body>

  <footer class="site-footer mt-auto" style="clear:both;height:150px;bottom:0px;position:relative;;width:100%">
    <hr>
    
    <div class="container mt-2">
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <h6><strong>A propos de nous</strong></h6>
          <p class="text-justify">Ecebay est une intiative pour les amateurs de beaux objets. Notre site recense uniquement des articles de qualité. Notre univers varié de produits permettra au plus avide des collectionneurs comme à un client de simple passage de trouver son bonheur .</p>
        </div>

        <div class="col-xs-6 col-md-3">
          <h6><strong>Navigation</strong></h6>
          <ul style="color:black">
            <li><a href="tout.php" style="color:black">Tous les articles</a></li>
            <li><a href="viewachats.php"style="color:black">Achats et Négociations</a></li>
            <li><a href="viewventes.php"style="color:black">Vendre un produit</a></li>
            <li><a href="viewcompte.php"style="color:black">Mon compte</a></li>
            <li><a href="viewpanier.php"style="color:black">Panier</a></li>
          </ul>
        </div>

        <div class=" col-md-3">
          <h6><strong>Nous contacter</strong></h6>
          <ul class="footer-links ">
            <li>Par téléphone au <strong> 01.03.04.89.33 </strong></li>
            <li>Par email: <a href="mailto:contact@ecebay.com"style="color:black"><strong>contact@ecebay.com</strong></a></li>
          
          </ul>
        </div>
      </div>
      
    </div>
    <div class="footer-copyright text-center py-2" style="background-color:#f1f1f1">Copyright &copy; 2020 All Rights Reserved by ECEBAY 
    </div>

  </footer>

  <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
  <script id="rendered-js"> </script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</html>