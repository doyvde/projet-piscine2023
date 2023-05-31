<?php

function affichageAchat($type, $id){

	if($type == "Vendeur" || $type == "Admin"){
			
			return;
	}
	echo <<< FOOBAR
	<h4 style="font-weight:bold;color:black">Votre Historique d'achats</h4>
	<hr>
	FOOBAR;
	//identifier votre BDD
	//$database = "ebayece";

	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';
	if ($db_found) {
		$sqlClient = "SELECT * FROM Historique WHERE IdClient = $id;";
		$resultClient = mysqli_query($db_handle, $sqlClient);
		if (mysqli_num_rows($resultClient) == 0) {
			//le livre recherché n'existe pas
			echo "Aucun achat";
		}else {
			while($data = mysqli_fetch_assoc($resultClient)){
				afficheHistoClient($data);
			}
		}

	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}


function afficheHistoClient($data){




	echo <<< FOOBAR
	<div class="border-card">
 <img src="{$data['Photo']}"class="img-thumbnail" width=100px height=100px>
	<div class="content-wrapper">
	<div class="label-group fixed">
	<p class="caption ml-5">Nom du produit</p>
	<p class="title ml-5">{$data['Nom']}</p>
	</div>
	<div class="min-gap"></div>
	<div class="label-group">
	<p class="caption">Type d'achat</p>
	<p class="title">{$data['TypeAchat']}</p>
	</div>
	<div class="min-gap"></div>
	<div class="label-group">
	<p class="caption">Catégorie</p>
	<p class="title">{$data['Categorie']}</p>
	</div>
	<div class="min-gap"></div>
	<div class="label-group">
	<p class="caption">Prix de Départ </p>
	<p class="title">{$data['PrixDepart']}€</p>
	</div>
	<div class="min-gap"></div>
	<div class="label-group">
	<p class="caption">Prix d'Achat </p>
	<p class="title">{$data['PrixAchat']}€</p>
	</div>
</div>
</div>
FOOBAR;
}

?>
