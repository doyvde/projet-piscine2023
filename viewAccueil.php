<?php session_start();
if($_SESSION['Type']=="" || $_SESSION['Id']=="")
{
  header('Location: http://localhost/projet-piscine2023/index.php');
  exit;
}
?>
<!doctype html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="viewAccueil.css" rel="stylesheet" type="text/css">
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

  <section class="jumbotron text-center" style="height:520px;background-image:url(musee.jpg);" >
    <div class="container">
      <h1 class="jumbotron-heading align-items-top" style="font-size:500%;font-weight:bold;color:white">BIENVENUE <br>SUR <br>DRIVE DEAL</h1>
      <p style="color:white;font-weight:bold"> <br>Retrouvez toutes nos offres à partir de l'onglet Catégories.<br> Allez consulter vos négociations et votre historique d'achat sur l'onglet Achats & Négociations.<br> <br><br><br><br><br><br><br><br><br>Si vous avez acquis un bien par une enchère ou une négociation, vos articles attendent leur paiement ci-dessous. </p>
    </div>
  </section>
  
  <div class=container>
    <h4 style="font-weight:bold;color:black">Vos Articles à Payer</h4>

  <hr>
  <?php

        include 'traitement/AffichageAPayer.php';
        aPayer($_SESSION['Id'],$_SESSION['Type']);
  ?>
  
  <br>
  <br>
  <h4 style="font-weight:bold;color:black">Vos Encheres en cours</h4>

  <hr>
    <?php

      enchereEnCours($_SESSION['Id'],$_SESSION['Type']);
      ?>

</div>
<!-- Site footer -->



  <!-- Copyright -->
</body>
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

<script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script id="rendered-js"> </script>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</html>