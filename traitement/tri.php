<?php

function triTC($sqlVente,$prixDepartMin,$prixDepartMax,$prixAchatImmediatMin,$prixAchatImmediatMax,$ordre){
    
    if( $prixDepartMin != "" && $prixDepartMax != "" && $prixAchatImmediatMin == "" && $prixAchatImmediatMax == ""){
        $sqlVente .= "WHERE PrixDepart BETWEEN '$prixDepartMin' AND '$prixDepartMax'";
        if( $ordre == "Croissant" ){
            $sqlVente .= "ORDER BY PrixDepart ASC;";
        }else{
            $sqlVente .= "ORDER BY PrixDepart DESC;";
        }
    }
    if( $prixAchatImmediatMin != "" && $prixAchatImmediatMax != "" && $prixDepartMin == "" && $prixDepartMax == ""){
        $sqlVente .= "WHERE PrixAchatImmediat BETWEEN '$prixAchatImmediatMin' AND '$prixAchatImmediatMax'";
        if( $ordre == "Croissant" ){
            $sqlVente .= "ORDER BY PrixAchatImmediat ASC;";
        }else{
            $sqlVente .= "ORDER BY PrixAchatImmediat DESC;";
        }
    }
    return $sqlVente;
}

function tri($sqlVente,$prixDepartMin,$prixDepartMax,$prixAchatImmediatMin,$prixAchatImmediatMax,$ordre){
    
    if( $prixDepartMin != "" && $prixDepartMax != "" && $prixAchatImmediatMin == "" && $prixAchatImmediatMax == ""){
        $sqlVente .= "AND PrixDepart BETWEEN '$prixDepartMin' AND '$prixDepartMax'";
        if( $ordre == "Croissant" ){
            $sqlVente .= "ORDER BY PrixDepart ASC;";
        }else{
            $sqlVente .= "ORDER BY PrixDepart DESC;";
        }
    }
    if( $prixAchatImmediatMin != "" && $prixAchatImmediatMax != "" && $prixDepartMin == "" && $prixDepartMax == ""){
        $sqlVente .= "AND PrixAchatImmediat BETWEEN '$prixAchatImmediatMin' AND '$prixAchatImmediatMax'";
        if( $ordre == "Croissant" ){
            $sqlVente .= "ORDER BY PrixAchatImmediat ASC;";
        }else{
            $sqlVente .= "ORDER BY PrixAchatImmediat DESC;";
        }
    }
    return $sqlVente;
}

//include 'connexion_bdd.php';
function affichageCategorie($mode,$prixDepartMin,$prixDepartMax,$prixAchatImmediatMin,$prixAchatImmediatMax,$ordre){

    header('Location: http://localhost/projet-piscine2023/tout.php?result=1');

    

	/*//identifier votre BDD
	$database = " ";

	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root','montretout1');
	$db_found = mysqli_select_db($db_handle, $database);*/
	list($db_found,$db_handle)=include 'connexion_bdd.php';

	if ($db_found) {
		if($mode == 1){
			$sqlVente = "SELECT * FROM Vente ";
            $sqlVente = triTC($sqlVente,$prixDepartMin,$prixDepartMax,$prixAchatImmediatMin,$prixAchatImmediatMax,$ordre);
            echo"<p>{$sqlVente}</p>";
			$resultVente = mysqli_query($db_handle, $sqlVente);
			if (mysqli_num_rows($resultVente) == 0) {
				echo "Aucune Vente pour cette categorie";
			}else {
				while($data = mysqli_fetch_assoc($resultVente)){
					afficheVente($data);
				}
			}

		}elseif($mode == "Accessible"){
			$sqlVente = "SELECT * FROM Vente WHERE Categorie = 'Accessible';";
            $sqlVente = tri($sqlVente,$prixDepartMin,$prixDepartMax,$prixAchatImmediatMin,$prixAchatImmediatMax,$ordre);
			$resultVente = mysqli_query($db_handle, $sqlVente);
			if (mysqli_num_rows($resultVente) == 0) {
				echo "Aucune Vente pour cette categorie";
			}else {
				while($data = mysqli_fetch_assoc($resultVente)){
					afficheVente($data);
				}
			}

		}elseif ($mode =="Collection") {
			$sqlVente = "SELECT * FROM Vente WHERE Categorie = 'Collection';"; 
            $sqlVente = tri($sqlVente,$prixDepartMin,$prixDepartMax,$prixAchatImmediatMin,$prixAchatImmediatMax,$ordre); 
			$resultVente = mysqli_query($db_handle, $sqlVente);
			if (mysqli_num_rows($resultVente) == 0) {
				echo "Aucune Vente pour cette categorie";
			}else {
				while($data = mysqli_fetch_assoc($resultVente)){
					afficheVente($data);
				}
			} 

		}elseif($mode =="Unique"){
			$sqlVente = "SELECT * FROM Vente WHERE Categorie = 'Unique';";
            $sqlVente = tri($sqlVente,$prixDepartMin,$prixDepartMax,$prixAchatImmediatMin,$prixAchatImmediatMax,$ordre);
			$resultVente = mysqli_query($db_handle, $sqlVente);
			if (mysqli_num_rows($resultVente) == 0) {
				//le livre recherché n'existe pas
				echo "Aucune Vente pour cette categorie";
			}else {
				while($data = mysqli_fetch_assoc($resultVente)){
					afficheVente($data);
				}
			}
		}else echo "categorie non definie";
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}


function afficheVente($data){
	echo <<< FOOBAR
	<li class="list-group-item">
	<div class="media align-items-lg-center flex-column flex-lg-row p-3">
	<div class="media-body order-2 order-lg-1" style="font-size:120%">
	<a href="viewproduit.php?id={$data['IdVente']}" class="mt-0 font-weight-bold mb-2" style="color:black"> {$data['Nom']}  </a>
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
$result = isset($_GET["result"])? $_GET["result"] : "";
session_start();
	$prixDepartMin = isset($_POST["PrixDepartMin"])? $_POST["PrixDepartMin"] : "";
    $prixDepartMax = isset($_POST["PrixDepartMax"])? $_POST["PrixDepartMax"] : "";
    $prixAchatImmediatMin = isset($_POST["PrixAchatImmediatMin"])? $_POST["PrixAchatImmediatMin"] : "";
    $prixAchatImmediatMax = isset($_POST["PrixAchatImmediatMax"])? $_POST["PrixAchatImmediatMax"] : "";
    $ordre = isset($_POST["flexRadioDefault"])? $_POST["flexRadioDefault"] : "";

    
	
    affichageCategorie($result,$prixDepartMin,$prixDepartMax,$prixAchatImmediatMin,$prixAchatImmediatMax,$ordre);

?>