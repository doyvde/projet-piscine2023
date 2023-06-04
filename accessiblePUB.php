<?php session_start();

?>
<!doctype html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="accessible.css" rel="stylesheet" type="text/css">
    <title>Drive Deal</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light align-items-end" style="font-size:130%;font-weight:bold">
        <a class="navbar-brand" href="index.php"> <img src="systeme/logo3.png" width="150" alt="logo"></a>

        <form action="SearchPUB.php" method="post" class="form-inline ml-auto" style="padding-left: 18%">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit"><img src="systeme/search.png" width="30" height="30" class="d-inline-block align-top" alt="search"></button>
        </form>

        <ul class="navbar-nav ml-auto align-items-end">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Catégories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="accessiblePUB.php">Nos pieces accessibles</a>
                    <a class="dropdown-item" href="collectionPUB.php">Nos pieces de collection</a>
                    <a class="dropdown-item" href="uniquePUB.php">Nos pieces uniques</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="toutPUB.php">Voir tous les articles</a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" style="color:black" href="viewAboutPUB.php">À propos</a>
            </li>

            <!-- <li class="nav-item">
        <a class="nav-link" style="color:black" href="viewachats.php">Achats & Négociations</a>
      </li>-->
            <!--<li class="nav-item">
        <a class="nav-link" href="viewventes.php">Vendre mon produit</a>
      </li>-->

            <?php
            if ($_SESSION['Type'] == "Client") {
                echo '
        <li class="nav-item">
          <a class="navbar-brand" href="viewpanier.php">
            <img src="systeme/panier.png" width="40" height="40" class="d-inline-block align-top" alt="">

          </a>
        </li>';
            } ?>
            <!--<li class="nav-item">
        <a class="nav-link" style="color:black" href="viewAdmin.php">Admin</a>
      </li>-->

            <li class="nav-item">
                <a class="nav-link" style="color:black" href="index1.php">
                    <input type="submit" class="btn btn-danger" style="text-transform:uppercase" value="Se Connecter">
                </a>
            </li>
            <?php
            if ($_SESSION['Type'] == "Vendeur") {
                $id = $_SESSION['Id'];
                list($db_found, $db_handle) = include 'traitement/connexion_bdd.php';
                if ($db_found) {
                    $sqlVendeur = "SELECT * FROM vendeur WHERE IdVendeur = $id;";
                    $resultVendeur = mysqli_query($db_handle, $sqlVendeur);
                    if (mysqli_num_rows($resultVendeur) == 0) {
                        //le livre recherché n'existe pas
                        echo "Aucun Vendeur";
                    } else {
                        $data = mysqli_fetch_assoc($resultVendeur);
                        echo <<< FOOBAR
              <li class="nav-item">
                <a class="nav-link"style="color:black" href="viewcompte.php">
                  <img src="{$data['Photo']}" width="40" height="40" class="d-inline-block align-top" alt="compte" style="border-radius: 100%;">
                </a>
              </li> 
              FOOBAR;
                    }
                }
            } elseif ($_SESSION['Type'] == "Client") {
                $id = $_SESSION['Id'];
                list($db_found, $db_handle) = include 'traitement/connexion_bdd.php';
                if ($db_found) {
                    $sqlClient = "SELECT * FROM client WHERE IdClient = $id;";
                    $resultClient = mysqli_query($db_handle, $sqlClient);
                    if (mysqli_num_rows($resultClient) == 0) {
                        //le livre recherché n'existe pas
                        echo "Aucun Client";
                    } else {
                        $data = mysqli_fetch_assoc($resultClient);
                        echo <<< FOOBAR
              <li class="nav-item">
                <a class="nav-link"style="color:black" href="viewcompte.php">
                  <img src="{$data['Photo']}" width="40" height="40" class="d-inline-block align-top" alt="compte" style="border-radius: 100%;">
                </a>
              </li> 
              FOOBAR;
                    }
                }
            } else {
                echo '<li class="nav-item">
        <a class="nav-link"style="color:black" href="index1.php">
          <img src="systeme/compte.jpg" width="40" height="40" class="d-inline-block align-top" alt="compte">
        </a>
      </li>';
            }
            ?>

        </ul>
    </nav>

    <section class="jumbotron text-center" style=" background-image: url(diademe.png)">
        <div class="container">
            <h1 class="jumbotron-heading align-items-top" style="font-size:500%;font-weight:bold;color:white">Nos pièces les plus accessibles</h1>

        </div>
    </section>

    <div class="container py-5">


        <div class="row">

            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <h5 class="card-header">
                        <a class="btn btn-outline-secondary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Filtre et Tri
                        </a>
                    </h5>
                    <div class="collapse" id="collapseExample">
                        <div class="card-body">
                            <h5 class="card-title">Filtrer par :</h5>
                            <form action="accessiblePUB.php?result=2" method="post">
                                <h6 class="card-title">Prix de Depart</h6>
                                <div class="input-group mb-3">
                                    <input type="number" name="PrixDepartMin" class="form-control input_user" placeholder="Min">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="number" name="PrixDepartMax" class="form-control input_user" placeholder="Max">
                                </div>
                                <h6 class="card-title">Prix Achat Immediat</h6>
                                <div class="input-group mb-3">
                                    <input type="number" name="PrixAchatImmediatMin" class="form-control input_user" placeholder="Min">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="number" name="PrixAchatImmediatMax" class="form-control input_user" placeholder="Max">
                                </div>
                                <h6 class="card-title">Type de vente :</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="type" value="nego" id="checkoutForm1" />
                                    <label class="form-check-label" for="checkoutForm1">
                                        Negociations
                                    </label>
                                </div>

                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" name="type2" value="enchere" id="checkoutForm2" />
                                    <label class="form-check-label" for="checkoutForm2">
                                        Enchere
                                    </label>
                                </div>

                                <hr>
                                <h5 class="card-title">Trier par :</h5>


                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="checkoutForm3" value="Croissant" checked />
                                    <label class="form-check-label" for="checkoutForm3">
                                        Croissant
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="checkoutForm4" value="Decroissant" />
                                    <label class="form-check-label" for="checkoutForm4">
                                        Décroissant
                                    </label>
                                </div>
                                <br>


                                <div class="d-flex  mt-3  login_container">
                                    <input type="submit" class="btn btn-outline-danger" style="text-transform : uppercase" value="Appliquer">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <br>
                <!-- List group-->
                <ul class="list-group shadow">
                    <!-- list group item-->
                    <?php $result = isset($_GET["result"]) ? $_GET["result"] : "";
                    if ($result == 2) {

                        function triTC($sqlVente, $prixDepartMin, $prixDepartMax, $prixAchatImmediatMin, $prixAchatImmediatMax, $ordre, $type, $type2)
                        {
                            if ($type == 'nego') {

                                if ($type2 == 'enchere') {
                                    if ($prixDepartMin != "" && $prixDepartMax != "" && $prixAchatImmediatMin == "" && $prixAchatImmediatMax == "") {
                                        $sqlVente .= "WHERE PrixDepart BETWEEN '$prixDepartMin' AND '$prixDepartMax'";
                                        if ($ordre == "Croissant") {
                                            $sqlVente .= "ORDER BY PrixDepart ASC;";
                                        } else {
                                            $sqlVente .= "ORDER BY PrixDepart DESC;";
                                        }
                                    }
                                    if ($prixAchatImmediatMin != "" && $prixAchatImmediatMax != "" && $prixDepartMin == "" && $prixDepartMax == "") {
                                        $sqlVente .= "WHERE PrixAchatImmediat BETWEEN '$prixAchatImmediatMin' AND '$prixAchatImmediatMax'";
                                        if ($ordre == "Croissant") {
                                            $sqlVente .= "ORDER BY PrixAchatImmediat ASC;";
                                        } else {
                                            $sqlVente .= "ORDER BY PrixAchatImmediat DESC;";
                                        }
                                    }
                                } else {
                                    $sqlVente .= "WHERE TypeVente = 'Negociation'";
                                    if ($prixDepartMin != "" && $prixDepartMax != "" && $prixAchatImmediatMin == "" && $prixAchatImmediatMax == "") {
                                        $sqlVente .= "AND PrixDepart BETWEEN '$prixDepartMin' AND '$prixDepartMax'";
                                        if ($ordre == "Croissant") {
                                            $sqlVente .= "ORDER BY PrixDepart ASC;";
                                        } else {
                                            $sqlVente .= "ORDER BY PrixDepart DESC;";
                                        }
                                    }
                                    if ($prixAchatImmediatMin != "" && $prixAchatImmediatMax != "" && $prixDepartMin == "" && $prixDepartMax == "") {
                                        $sqlVente .= "AND PrixAchatImmediat BETWEEN '$prixAchatImmediatMin' AND '$prixAchatImmediatMax'";
                                        if ($ordre == "Croissant") {
                                            $sqlVente .= "ORDER BY PrixAchatImmediat ASC;";
                                        } else {
                                            $sqlVente .= "ORDER BY PrixAchatImmediat DESC;";
                                        }
                                    }
                                }
                            } elseif ($type2 == 'enchere') {
                                $sqlVente .= "WHERE TypeVente = 'Enchere'";
                                if ($prixDepartMin != "" && $prixDepartMax != "" && $prixAchatImmediatMin == "" && $prixAchatImmediatMax == "") {
                                    $sqlVente .= "AND PrixDepart BETWEEN '$prixDepartMin' AND '$prixDepartMax'";
                                    if ($ordre == "Croissant") {
                                        $sqlVente .= "ORDER BY PrixDepart ASC;";
                                    } else {
                                        $sqlVente .= "ORDER BY PrixDepart DESC;";
                                    }
                                }
                                if ($prixAchatImmediatMin != "" && $prixAchatImmediatMax != "" && $prixDepartMin == "" && $prixDepartMax == "") {
                                    $sqlVente .= "AND PrixAchatImmediat BETWEEN '$prixAchatImmediatMin' AND '$prixAchatImmediatMax'";
                                    if ($ordre == "Croissant") {
                                        $sqlVente .= "ORDER BY PrixAchatImmediat ASC;";
                                    } else {
                                        $sqlVente .= "ORDER BY PrixAchatImmediat DESC;";
                                    }
                                }
                            }


                            if ($prixAchatImmediatMin == "" && $prixAchatImmediatMax == "" && $prixDepartMin == "" && $prixDepartMax == "") {

                                if ($ordre == "Croissant") {
                                    $sqlVente .= "ORDER BY PrixAchatImmediat ASC;";
                                } else {
                                    $sqlVente .= "ORDER BY PrixAchatImmediat DESC;";
                                }
                            }
                            return $sqlVente;
                        }

                        function tri($sqlVente, $prixDepartMin, $prixDepartMax, $prixAchatImmediatMin, $prixAchatImmediatMax, $ordre, $type, $type2)
                        {
                            if ($type == 'nego') {

                                if ($type2 == 'enchere') {
                                    if ($prixDepartMin != "" && $prixDepartMax != "" && $prixAchatImmediatMin == "" && $prixAchatImmediatMax == "") {
                                        $sqlVente .= "AND PrixDepart BETWEEN '$prixDepartMin' AND '$prixDepartMax'";
                                        if ($ordre == "Croissant") {
                                            $sqlVente .= "ORDER BY PrixDepart ASC;";
                                        } else {
                                            $sqlVente .= "ORDER BY PrixDepart DESC;";
                                        }
                                    }
                                    if ($prixAchatImmediatMin != "" && $prixAchatImmediatMax != "" && $prixDepartMin == "" && $prixDepartMax == "") {
                                        $sqlVente .= "AND PrixAchatImmediat BETWEEN '$prixAchatImmediatMin' AND '$prixAchatImmediatMax'";
                                        if ($ordre == "Croissant") {
                                            $sqlVente .= "ORDER BY PrixAchatImmediat ASC;";
                                        } else {
                                            $sqlVente .= "ORDER BY PrixAchatImmediat DESC;";
                                        }
                                    }
                                } else {
                                    $sqlVente .= "AND TypeVente = 'Negociation'";
                                    if ($prixDepartMin != "" && $prixDepartMax != "" && $prixAchatImmediatMin == "" && $prixAchatImmediatMax == "") {
                                        $sqlVente .= "AND PrixDepart BETWEEN '$prixDepartMin' AND '$prixDepartMax'";
                                        if ($ordre == "Croissant") {
                                            $sqlVente .= "ORDER BY PrixDepart ASC;";
                                        } else {
                                            $sqlVente .= "ORDER BY PrixDepart DESC;";
                                        }
                                    }
                                    if ($prixAchatImmediatMin != "" && $prixAchatImmediatMax != "" && $prixDepartMin == "" && $prixDepartMax == "") {
                                        $sqlVente .= "AND PrixAchatImmediat BETWEEN '$prixAchatImmediatMin' AND '$prixAchatImmediatMax'";
                                        if ($ordre == "Croissant") {
                                            $sqlVente .= "ORDER BY PrixAchatImmediat ASC;";
                                        } else {
                                            $sqlVente .= "ORDER BY PrixAchatImmediat DESC;";
                                        }
                                    }
                                }
                            } elseif ($type2 == 'enchere') {
                                $sqlVente .= "AND TypeVente = 'Enchere'";
                                if ($prixDepartMin != "" && $prixDepartMax != "" && $prixAchatImmediatMin == "" && $prixAchatImmediatMax == "") {
                                    $sqlVente .= "AND PrixDepart BETWEEN '$prixDepartMin' AND '$prixDepartMax'";
                                    if ($ordre == "Croissant") {
                                        $sqlVente .= "ORDER BY PrixDepart ASC;";
                                    } else {
                                        $sqlVente .= "ORDER BY PrixDepart DESC;";
                                    }
                                }
                                if ($prixAchatImmediatMin != "" && $prixAchatImmediatMax != "" && $prixDepartMin == "" && $prixDepartMax == "") {
                                    $sqlVente .= "AND PrixAchatImmediat BETWEEN '$prixAchatImmediatMin' AND '$prixAchatImmediatMax'";
                                    if ($ordre == "Croissant") {
                                        $sqlVente .= "ORDER BY PrixAchatImmediat ASC;";
                                    } else {
                                        $sqlVente .= "ORDER BY PrixAchatImmediat DESC;";
                                    }
                                }
                            }


                            if ($prixAchatImmediatMin == "" && $prixAchatImmediatMax == "" && $prixDepartMin == "" && $prixDepartMax == "") {

                                if ($ordre == "Croissant") {
                                    $sqlVente .= "ORDER BY PrixAchatImmediat ASC;";
                                } else {
                                    $sqlVente .= "ORDER BY PrixAchatImmediat DESC;";
                                }
                            }
                            return $sqlVente;
                        }

                        //include 'connexion_bdd.php';
                        function affichageCategorie($mode, $prixDepartMin, $prixDepartMax, $prixAchatImmediatMin, $prixAchatImmediatMax, $ordre, $type, $type2)
                        {

                            list($db_found, $db_handle) = include 'traitement/connexion_bdd.php';

                            if ($db_found) {
                                if ($mode == 1) {
                                    $sqlVente = "SELECT * FROM Vente ";
                                    $sqlVente = triTC($sqlVente, $prixDepartMin, $prixDepartMax, $prixAchatImmediatMin, $prixAchatImmediatMax, $ordre, $type, $type2);
                                    echo "<p>{$sqlVente}</p>";
                                    $resultVente = mysqli_query($db_handle, $sqlVente);
                                    if (mysqli_num_rows($resultVente) == 0) {
                                        echo "Aucune Vente pour cette categorie";
                                    } else {
                                        while ($data = mysqli_fetch_assoc($resultVente)) {
                                            afficheVente($data);
                                        }
                                    }
                                } elseif ($mode == 2) {
                                    $sqlVente = "SELECT * FROM Vente WHERE Categorie = 'Accessible'";
                                    $sqlVente = tri($sqlVente, $prixDepartMin, $prixDepartMax, $prixAchatImmediatMin, $prixAchatImmediatMax, $ordre, $type, $type2);
                                    $resultVente = mysqli_query($db_handle, $sqlVente);
                                    if (mysqli_num_rows($resultVente) == 0) {
                                        echo "Aucune Vente pour cette categorie";
                                    } else {
                                        while ($data = mysqli_fetch_assoc($resultVente)) {
                                            afficheVente($data);
                                        }
                                    }
                                } elseif ($mode == 3) {
                                    $sqlVente = "SELECT * FROM Vente WHERE Categorie = 'Collection'";
                                    $sqlVente = tri($sqlVente, $prixDepartMin, $prixDepartMax, $prixAchatImmediatMin, $prixAchatImmediatMax, $ordre, $type, $type2);
                                    $resultVente = mysqli_query($db_handle, $sqlVente);
                                    if (mysqli_num_rows($resultVente) == 0) {
                                        echo "Aucune Vente pour cette categorie";
                                    } else {
                                        while ($data = mysqli_fetch_assoc($resultVente)) {
                                            afficheVente($data);
                                        }
                                    }
                                } elseif ($mode == 4) {
                                    $sqlVente = "SELECT * FROM Vente WHERE Categorie = 'Unique'";
                                    $sqlVente = tri($sqlVente, $prixDepartMin, $prixDepartMax, $prixAchatImmediatMin, $prixAchatImmediatMax, $ordre, $type, $type2);
                                    $resultVente = mysqli_query($db_handle, $sqlVente);
                                    if (mysqli_num_rows($resultVente) == 0) {
                                        //le livre recherché n'existe pas
                                        echo "Aucune Vente pour cette categorie";
                                    } else {
                                        while ($data = mysqli_fetch_assoc($resultVente)) {
                                            afficheVente($data);
                                        }
                                    }
                                } else echo "categorie non definie";
                            } else {
                                echo "Database not found";
                            }
                            //fermer la connexion
                            mysqli_close($db_handle);
                        }


                        function afficheVente($data)
                        {
                            echo <<< FOOBAR
                <li class="list-group-item">
                <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                <div class="media-body order-2 order-lg-1" style="font-size:120%">
                <a href="viewproduitPUB.php?id={$data['IdVente']}" class="mt-0 font-weight-bold mb-2" style="color:black"> {$data['Nom']}  </a>
                <p class="font-italic text-muted mb-0 small">{$data['Description']}</p>
                <p class="text mb-0 small" style="black">Catégorie de Vente : {$data['TypeVente']}</p>
                <p class="price-detail-wrap">
                <dl class="param param-feature">
                <dt>Prix de départ</dt>
                <span class="price h3 text-warning">
                <span class="currency">EUR €</span><span class="num">{$data['PrixDepart']}</span>
                </span>
                <dt>Prix d'achat immédiat</dt>
                <span class="price h3 text-warning">
                <span class="currency">EUR €</span><span class="num">{$data['PrixAchatImmediat']}</span>
                </span>
                </dl>
                </div>
                <img src="{$data['Photo']}"alt="Generic placeholder image" width="200" class="ml-lg-5 order-1 order-lg-2">
                </div>  </li>
                FOOBAR;
                        }
                        $result = isset($_GET["result"]) ? $_GET["result"] : "";

                        $prixDepartMin = isset($_POST["PrixDepartMin"]) ? $_POST["PrixDepartMin"] : "";
                        $prixDepartMax = isset($_POST["PrixDepartMax"]) ? $_POST["PrixDepartMax"] : "";
                        $prixAchatImmediatMin = isset($_POST["PrixAchatImmediatMin"]) ? $_POST["PrixAchatImmediatMin"] : "";
                        $prixAchatImmediatMax = isset($_POST["PrixAchatImmediatMax"]) ? $_POST["PrixAchatImmediatMax"] : "";
                        $type = isset($_POST["type"]) ? $_POST["type"] : "";
                        $type2 = isset($_POST["type2"]) ? $_POST["type2"] : "";
                        $ordre = isset($_POST["flexRadioDefault"]) ? $_POST["flexRadioDefault"] : "";



                        affichageCategorie($result, $prixDepartMin, $prixDepartMax, $prixAchatImmediatMin, $prixAchatImmediatMax, $ordre, $type, $type2);
                    } else {

                        include 'traitement/Categories.php';
                        affichageNoCategorie("Accessible");
                    }
                    ?>

                </ul> <!-- End -->
            </div>
        </div>
    </div>

</body>

<footer class="site-footer mt-auto" style="clear:both;height:150px;bottom:0px;width:100%; padding: 50px">
    <hr>

    <div class="container mt-2">
        <div class="row">
            <div class="col-sm-12 col-md-6" style="padding: 50px">
                <a href="#"><input type="submit" class="btn btn-secondary" style="text-transform:uppercase" value="Retour en haut "></a>
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

<!-- Copyright -->



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

</html>