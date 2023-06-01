<?php
//include 'connexion_bdd.php';
function panier($type, $id){
	if($type == "Vendeur" || $type == "Admin"){
		echo "Vous etes un $type vous n'avez pas acces au panier"; //dans un beau message
		return;
	}

	//identifier votre BDD
	//$database = "ebayece";

	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';

	if ($db_found) {
		$sqlPanier = "SELECT Panier FROM Client WHERE IdClient = $id;";
		$resultPanier = mysqli_query($db_handle, $sqlPanier);
		if(mysqli_num_rows($resultPanier) == 0)
			return;
		$data = mysqli_fetch_assoc($resultPanier);
		affichePanierDuClient($data, $db_handle,$id);
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

function affichePanierDuClient($data,$db_handle,$idClient){
	$total=0;
	$panier = $data['Panier'];
	$tok = strtok($panier,",");

	while ($tok !== false) {
		//on regarde si l'objet est encore dans la liste des ventes
		$ok = testPresence($tok,$db_handle);
		if($ok == false){
			//on supprime si il est plus dans la liste des ventes

			$sqlPanier2 = "SELECT Panier FROM Client WHERE IdClient = $idClient;";
			$resultPanier2 = mysqli_query($db_handle, $sqlPanier2);
			if(mysqli_num_rows($resultPanier2) != 0){
				$data3= mysqli_fetch_assoc($resultPanier2);
				$newPanier =suppressionString($data3['Panier'], $tok);
				if($newPanier == 'null'){
					$sqladd = "UPDATE client SET Panier = NULL WHERE client.IdClient = $idClient";
					mysqli_query($db_handle, $sqladd);
				}else{
					$sqladd = "UPDATE client SET Panier = '$newPanier' WHERE client.IdClient = $idClient";
					mysqli_query($db_handle, $sqladd);
				}
			}
		}
		$tok = strtok(",");
	}

	$sqlPanier = "SELECT Panier FROM Client WHERE IdClient = $idClient;";
	$resultPanier = mysqli_query($db_handle, $sqlPanier);
	if(mysqli_num_rows($resultPanier) == 0)
		return;
	$data2 = mysqli_fetch_assoc($resultPanier);
	affiche($data2,$db_handle);
}



function affiche($data,$db_handle){
	$total=0;
	$panier = $data['Panier'];
	$tok = strtok($panier,",");

	while ($tok !== false) {
		$total=afficheVenteFavorite($tok,$db_handle,$total);
  		$tok = strtok(",");

	}

	echo <<<FOOBAR
	<tr>
			<td>   </td>
			<td>   </td>
			<td>   </td>
			<td><h3 class="text-center">Total</h3></td>
			<td class="text-right"><h3> {$total} €</h3></td>
	</tr>
	FOOBAR;
}


function testPresence($tok,$db_handle){
	$sqlVente = "SELECT * FROM vente WHERE IdVente = $tok;";
	$resultVente = mysqli_query($db_handle, $sqlVente);
	if(mysqli_num_rows($resultVente) == 0)
		return false;
	return true;
}

function suppressionString($string,$idVente){

	if($string == $idVente){
		$string = 'null';
		return $string;
	}
	else{
		$string = 'o'. $string .'o';
		$remplace = 'o'.$idVente.',';
		$string = str_replace($remplace,'', $string);
		$remplace1 = ','.$idVente.',';
		$string = str_replace($remplace1,',', $string);
		$remplace2 = ','.$idVente.'o';
		$string = str_replace($remplace2,'', $string);
		$string = str_replace('o', '', $string);
	}
	return $string;
}


function afficheVenteFavorite($id,$db_handle,$total){
	$sqlFav = "SELECT * FROM Vente WHERE IdVente = $id;";
	$resultFav = mysqli_query($db_handle, $sqlFav);
	$data = mysqli_fetch_assoc($resultFav);
	$total+=$data['PrixAchatImmediat'];
	afficheVente($data,$db_handle);
	return $total;
}

function afficheVente($data,$db_handle){

	$vendeur = $data['IdVendeur'];
	$sql = "SELECT * FROM vendeur WHERE IdVendeur = $vendeur;";
	$result= mysqli_query($db_handle, $sql);
	$datavendeur = mysqli_fetch_assoc($result);
	$nomvendeur=$datavendeur['Nom'];

	echo <<< FOOBAR
	<tr>
	<td class="col-sm-8 col-md-6">
	<div class="media">
	<a class="thumbnail pull-left" href="#"> <img class="media-object" src="{$data['Photo']} " style="width: 72px; height: 72px;"> </a>
	<div class="media-body ">
	<h5 class="mt-0 font-weight-bold mb-2 ml-2"> <a style="color:black" href="viewproduit.php?id={$data['IdVente']}">{$data['Nom']}</a></h5>
	<h6 class="mt-0 mb-2 ml-2"> Vendeur : {$nomvendeur}</h6>
	</div>
	</div></td>
	<td> </td>
	<td> </td>
	<td class="col-sm-1 col-md-1 text-center"><strong>{$data['PrixAchatImmediat']} € </strong></td>
	<td class="col-sm-1 col-md-1">
	<a href="traitement/SuppressionPanier.php?idvente={$data['IdVente']}" style="text-decoration:none">
	<button type="button" class="btn btn-outline-danger">
	<span class="glyphicon glyphicon-remove"></span> Supprimer cet article
	</button>
	</a></td>
	</tr>
	FOOBAR;
}

?>