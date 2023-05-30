<?php

//include 'connexion_bdd.php';

function affichageProduit($idVente, $type){
	//identifier votre BDD
	//$database = "ebayece";

	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';

	if ($db_found) {
		if($type == 'Admin'){
			traitementAffichageAdmin($idVente,$db_handle);
		}
		elseif($type == 'Vendeur'){
			traitementAffichageVendeur($idVente,$db_handle);

		}elseif($type == 'Client'){
			traitementAffichageClient($idVente,$db_handle);

		}else echo "type invalide";
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

function traitementAffichageAdmin($idVente, $db_handle){
	$sqlVente = "SELECT * FROM Vente WHERE IdVente = $idVente;";
	$resultVente = mysqli_query($db_handle, $sqlVente);
	$dataVente = mysqli_fetch_assoc($resultVente);

	affichageVenteAdmin($dataVente);

}

function affichageVenteAdmin($dataVente){
	//teste data type de vente et affiche en fonction sachant que c un admin
	echo <<< FOOBAR
	<div class="container">
	<div class="row">
	<div class="col border-right">
	<img class="mx-auto  d-block" width="300"  src="{$dataVente['Photo']}">
	</div>
	<aside class="col-sm-7 border-right border-top border-bottom">
	<article class="card-body p-5">
	<h3 class="title mb-3">{$dataVente['Nom']}</h3>
	<dl class="item-property">
	<dt>Description</dt>
	<dd><p>{$dataVente['Description']}
	</dl>
	<dl class="param param-feature">
	<dt>Catégorie</dt>
	<dd>{$dataVente['Categorie']}</dd>
	</dl>
	<dl class="param param-feature">
	<dt>Type de vente</dt>
	<dd>{$dataVente['TypeVente']} ou Vente directe</dd>
	</dl>
	<hr>
	<a href="traitementSuppressionVente.php?idvente={$dataVente['IdVente']}" class="btn btn-lg btn-outline-danger text-uppercase"> <i class="fas fa-shopping-cart"></i> Supprimer cet article </a>
	</article>
	</aside>
	</div>
	</div>
	</div>
	FOOBAR;
}

function traitementAffichageVendeur($idVente, $db_handle){
	$sqlVente = "SELECT * FROM Vente WHERE IdVente = $idVente;";
	$resultVente = mysqli_query($db_handle, $sqlVente);
	$dataVente = mysqli_fetch_assoc($resultVente);
	affichageVenteVendeur($dataVente);

}

function affichageVenteVendeur($dataVente){
	//teste data type de vente et affiche en fonction sachant que c un vendeur
	echo <<< FOOBAR
	<div class="container">
	<div class="row">
	<div class="col border-right">
	<img class="mx-auto  d-block"  width="300" src="{$dataVente['Photo']}">
	</div>
	<aside class="col-sm-7 border-right border-top border-bottom">
	<article class="card-body p-5">
	<h3 class="title mb-3">{$dataVente['Nom']}</h3>
	<dl class="item-property">
	<dt>Description</dt>
	<dd><p>{$dataVente['Description']}
	</dl>
	<dl class="param param-feature">
	<dt>Catégorie</dt>
	<dd>{$dataVente['Categorie']}</dd>
	</dl>
	<dl class="param param-feature">
	<dt>Type de vente</dt>
	<dd>{$dataVente['TypeVente']} ou Vente directe</dd>
	</dl>
	</article>
	</aside>
	</div>
	</div>
	FOOBAR;
}

function traitementAffichageClient($idVente, $db_handle){
	$sqlVente = "SELECT * FROM Vente WHERE IdVente= $idVente;";
	$resultVente = mysqli_query($db_handle, $sqlVente);
	$dataVente = mysqli_fetch_assoc($resultVente);
	affichageVenteClient($dataVente,$db_handle);

}

function affichageVenteClient($dataVente,$db_handle){
	//teste data type de vente et affiche en fonction sachant que c un client
	$idVente=$dataVente['IdVente'];
	echo <<< FOOBAR
	<div class="container">
	<div class="row">
	<div class="col border-right">
	<img class="mx-auto  d-block"  width="300" src="{$dataVente['Photo']}">
	</div>
	<aside class="col-sm-7 border-right border-top border-bottom">
	<article class="card-body p-5">
	<h3 class="title mb-3">{$dataVente['Nom']}</h3>
	<hr>
	<dl class="item-property">
	<dt>Description</dt>
	<dd><p>{$dataVente['Description']}
	</dl>
	<dl class="param param-feature">
	<dt>Catégorie</dt>
	<dd>{$dataVente['Categorie']}</dd>
	</dl>
	<dl class="param param-feature">
	<dt>Type de vente</dt>
	<dd>{$dataVente['TypeVente']} ou Vente directe</dd>
	</dl>
	<hr>
	<dl class="param param-feature">
	<dt>Prix d'achat immédiat</dt>
	</dl>
	<p class="price-detail-wrap">
	<span class="price h3 text-warning">
	<span class="currency">EUR €</span><span class="num">{$dataVente['PrixAchatImmediat']} </span>
	</span>
	</p>
	<a href="traitementAjoutPanier.php?idvente={$dataVente['IdVente']}" class="btn btn-lg btn-outline-dark text-uppercase"> <i class="fas fa-shopping-cart"></i> Ajouter au panier </a> <a href="paiementImmediat.php?idvente={$dataVente['IdVente']}" class="btn btn-lg btn-outline-danger text-uppercase"> <i class="fas fa-shopping-cart"></i> Achat Immediat</a>
	FOOBAR;

	if($dataVente['TypeVente']=="Enchere")
	{
		$sql = "SELECT * FROM enchere WHERE IdVente = $idVente;";
		$result = mysqli_query($db_handle, $sql);

		if (mysqli_num_rows($result) != 0) $data = mysqli_fetch_assoc($result);

		echo <<< FOOBAR
		<hr>
		<dl class="param param-feature">
		<dt>Prix de départ</dt>
		</dl>
		<p class="price-detail-wrap">
		<span class="price h3 text-warning">
		<span class="currency">EUR €</span><span class="num">{$dataVente['PrixDepart']}</span>
		</span>
		FOOBAR;

		if (mysqli_num_rows($result) != 0){
			echo <<< FOOBAR
			<hr>
			<dl class="param param-feature">
			<dt>Prix Actuel</dt>
			</dl>
			<p class="price-detail-wrap">
			<span class="price h3 text-warning">
			<span class="currency">EUR €</span><span class="num">{$data['PrixActuel']}</span>
			</span>
			<dl class="param param-feature">
			<dt>Date de fin d'enchere</dt>
			</dl>
			<span class="price h3 text-danger">
			<span class="date">{$dataVente['DateFin']}</span>
			</span>
			FOOBAR;

		}
		echo <<< FOOBAR
		</p>
		<form action="traitementAjoutEnchere.php?idvente={$dataVente['IdVente']}" method="post">
		<div class="input-group mb-3">
		<input type="number" name="prix" class="form-control input_user" placeholder="Entrer ici votre prix" >
		</div>
		<div class="d-flex  mt-3 login_container">
		<input type="submit" class="btn btn-outline-dark text-uppercase" value="Faire une offre d'enchere">
		</div>
		</form>
		<hr>
		<dl class="param param-feature">
		<dt>Auto-Enchère Maximale</dt>
		</dl>
		<form action="traitementAjoutAutoEnchere.php?idvente={$dataVente['IdVente']}" method="post">
		<div class="input-group mb-3">
		<input type="number" name="prix" class="form-control input_user" placeholder="Entrer ici votre prix maximal pour l'auto-enchère" >
		</div>
		<div class="d-flex  mt-3 login_container">
		<input type="submit" class="btn btn-outline-dark text-uppercase" value="Faire une offre d'auto-enchere max">
		</div>
		</form>
		</article>
		</aside>
		</div>
		</div>
		</div>
		FOOBAR;
	}

	if($dataVente['TypeVente']=="Negociation"){

		$idclient=$_SESSION['Id'];
		$sqlnego = "SELECT * FROM negociation WHERE IdVente = $idVente AND IdClient = $idclient ;";
		$resultnego = mysqli_query($db_handle, $sqlnego);



		echo <<< FOOBAR
		<hr>
		<dl class="param param-feature">
		<dt>Prix de départ</dt>
		</dl>
		<p class="price-detail-wrap">
		<span class="price h3 text-warning">
		<span class="currency">EUR €</span><span class="num">{$dataVente['PrixDepart']}</span>
		</span>
		</p>
		<dl class="param param-feature">
		<dt>Date de fin </dt>
		</dl>
		<span class="price h3 text-danger">
		<span class="date">{$dataVente['DateFin']}</span>
		</span>
		<hr>
		<dl class="param param-feature">
		<dt>Négociation</dt>
		</dl>
		FOOBAR;
		if (mysqli_num_rows($resultnego) == 0)
		{
			echo <<< FOOBAR
			<form action="traitementNouvelleNego.php?idvente={$dataVente['IdVente']}" method="post">
			<div class="input-group mb-3">
			<input type="number" name="prix" class="form-control input_user" placeholder="Entrez ici votre prix" >
			</div>
			<div class="d-flex  mt-3 login_container">
			<input type="submit" class="btn btn-outline-dark text-uppercase" value="Proposer une négociation">
			</div>
			</form>
			</article>
			</aside>
			</div>
			</div>
			</div>
			FOOBAR;
		}else {
			echo <<< FOOBAR
			<dl class="param param-feature">
			<dd>Vous avez déjà entamé une négociation pour cet objet, veuillez consulter l'onglet Achats / Négociations en cliquant <a href="viewachats.php"> ici </a> </dd>
			</dl>
			</article>
			</aside>
			</div>
			</div>
			</div>
			FOOBAR;
		}
	}




}


?>