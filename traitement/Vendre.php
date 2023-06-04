<?php

//include 'connexion_bdd.php';

function affichageVendre($type, $id){

	if($type == "Client" || $type == "Admin"){
			//echo "Vous etes $type, cette page est reservée aux vendeurs";
			return;
	}
	//identifier votre BDD
	//$database = " ";

	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';
	afficheFormulaireVente();
		echo '<h4 style="font-weight:bold;color:black">Vos Ventes en Cours</h4><hr>';
	if ($db_found) {
		$sqlVendeur = "SELECT * FROM Vente WHERE IdVendeur = $id;";
		$resultVendeur = mysqli_query($db_handle, $sqlVendeur);
		if (mysqli_num_rows($resultVendeur) == 0) {
			//le livre recherché n'existe pas
			echo "Aucune Vente";
		}else {
		
			while($data = mysqli_fetch_assoc($resultVendeur)){
				$sql2 = "SELECT Nom FROM vendeur WHERE IdVendeur=$id;";
				$result2 = mysqli_query($db_handle, $sql2);
				$data2 = mysqli_fetch_assoc($result2);
				afficheVenteVendeur($data,$data2);
			}
		}

	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}


function afficheVenteVendeur($data, $data2){

	echo <<< FOOBAR
	<a href="viewproduit.php?id={$data['IdVente']}" style="text-decoration: none;">
	<div class="border-card">
 <img src="{$data['Photo']}"class="img-thumbnail" width=100px height=100px>
  <div class="content-wrapper">
  <div class="label-group fixed">
  <p class="caption ml-5">Nom du produit</p>
  <p class="title ml-5">{$data['Nom']}</p>
  </div>
  <div class="min-gap"></div>
  <div class="label-group">
  <p class="caption">Type de Vente</p>
  <p class="title">{$data['TypeVente']}</p>
  </div>
	<div class="min-gap"></div>
  <div class="label-group">
  <p class="caption">Catégorie</p>
  <p class="title">{$data['Categorie']}</p>
  </div>
  <div class="min-gap"></div>
  <div class="label-group">
  <p class="caption">Prix d'achat immediat</p>
  <p class="title">{$data['PrixAchatImmediat']}€</p>
  </div>
	<div class="min-gap ml-auto"></div>
	<form action="traitement/SuppressionVenteVendeur.php?idvente={$data['IdVente']}" method="post">
	<input type="submit" class="btn btn-outline-danger text-uppercase" value="Supprimer cette vente">
	</form>
</div>
</div>
</a>
FOOBAR;
}

function afficheFormulaireVente (){
	echo  <<< FOOBAR
	<div class="container align-content-center">
	<hr>
	<div class="d-flex  h-100">
	<div class="user_card">
	<div class="d-flex ">
	</div>
	<div class="d-flex  form_container">
	<form action="traitement/AjoutVente.php" method="post" enctype="multipart/form-data">
	<div class="input-group mb-3">
	<input type="text" name="Nom" class="form-control input_user" placeholder="Nom du produit" >
	</div>
	<div class="input-group mb-1">
	<div class="input-group-append">
	<td > Catégorie <br></td>
	</div>
	<td class="ml-auto">
	<select class="form-control ml-2 mb-2 " name="Categorie" size="1">
	<option>Accessible</option>
	<option>Collection</option>
	<option>Unique</option>
	</select> </td>
	</div>
	<div class="form-group">
	<textarea class="form-control rounded-1" name="Description"placeholder="Description du produit" rows="4"></textarea>
	</div>
	<div class="input-group mb-1">
	<div class="input-group-append">
	<td> Type de vente <br></td>
	</div>
	<td class="ml-auto">
	<select class="form-control ml-2 mb-2" name="TypeVente" size="1">
	<option>Negociation</option>
	<option>Enchere</option>
	</select> </td>
	</div>
	<div class="input-group mb-3">
	<input type="number" name="PrixDepart" class="form-control input_user" placeholder="Prix de départ">
	</div>
	<div class="input-group mb-3">
	<input type="number" name="PrixAchatImmediat" class="form-control input_user" placeholder="Prix d'achat immediat">
	</div>
	<div class="input-group mb-3">
	<table>
	<tr>
	<td><label class = "mr-2"> Date de fin de la vente :</label></td>
	<td><input type="date" name="DateFin" class="form-control input_user" placeholder="Date de fin"></td>
	</tr>
	</table>
	</div>
	<hr>
	<div class="input-group mb-3">
	<table>
	<tr>
	<td>Image 1 du produit : </td>
	<td><input type="file" name="image"></td>
	</tr>
	<br>
	<tr> 
	<td>Image 2 du produit :</td>
	<td><input type="file" name="image2"></td>
	</tr>
	<br>
	<tr>
	<td>Image 3 du produit :</td>
	<td><input type="file" name="image3"></td>
	</tr>
	<br>
	<tr>
	<td>Vidéo du produit :</td>
	<td><input type="file" name="vidéo"></td>
	</tr>
	</table>
	</div>
	<div class="d-flex  mt-3 mb-5 login_container">
	<input type="submit" class="btn btn-outline-dark" style="text-transform : uppercase" value="Ajouter Cette vente">
	</div>
	</form>
	</div>
	</div>
	</div>
	</div>
	<br>
	FOOBAR;
}

?>