<?php
//include 'connexion_bdd.php';

function aPayer($id, $type){
	
	//identifier votre BDD
	//$database = "ebayece";
	
	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';
	
	if ($db_found) {
		if($type == 'Client'){
			echo '
	<h4 style="font-weight:bold;color:black">Vos Articles à Payer</h4>
    <hr>';
			traitementAffichageClient($id,$db_handle);
			
		}
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

function enchereEnCours($id, $type){
	//identifier votre BDD
	//$database = "ebayece";
	
	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';
	
	if ($db_found) {
		if($type == 'Client'){
			echo '<h4 style="font-weight:bold;color:black">Vos Encheres en cours</h4>
        <hr>';
			traitementAffichageEnchere($id,$db_handle);
			
		}
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

function traitementAffichageClient($id,$db_handle)
{
	$sqlNego = "SELECT * FROM apayer WHERE IdClient = $id;";
	$resultAPayer = mysqli_query($db_handle, $sqlNego);
	if(mysqli_num_rows($resultAPayer)==0) echo "Aucun article n'attend votre paiement.";
	if(mysqli_num_rows($resultAPayer)!=0){
		while($dataAPayer =  mysqli_fetch_assoc($resultAPayer)){
			affichageAPayer($dataAPayer);
		}
	}
}
function traitementAffichageEnchere($id,$db_handle)
{
	$sqlNego = "SELECT * FROM enchere WHERE IdClient = $id;";
	$resultAPayer = mysqli_query($db_handle, $sqlNego);
	if(mysqli_num_rows($resultAPayer)==0) echo "Vous n'avez pas fait d'Enchères.";
	if(mysqli_num_rows($resultAPayer)!=0){
		while($dataAPayer =  mysqli_fetch_assoc($resultAPayer)){
			affichageEnchere($dataAPayer,$db_handle);
		}
	}
}

function affichageAPayer($dataAPayer){
	
	echo <<< FOOBAR
	<div class="border-card">
	<img src="{$dataAPayer['Photo']}"class="img-thumbnail" width=100px height=100px>
	<div class="content-wrapper">
	<div class="label-group fixed">
	<p class="caption ml-4">Nom du produit</p>
	<p class="title ml-4">{$dataAPayer['Nom']}</p>
	</div>
	<div class="min-gap"></div>
	<div class="label-group">
	<p class="caption">Prix de Départ </p>
	<p class="title">{$dataAPayer['PrixDepart']}€</p>
	</div>
	<div class="min-gap"></div>
	<div class="label-group">
	<p class="caption">Prix à payer </p>
	<p class="title">{$dataAPayer['PrixAchat']}€</p>
	</div>
	<div class="min-gap ml-auto"></div>
	<form action="paiementAPayer.php?idvente={$dataAPayer['IdVente']}" method="post">
	<input type="submit" class="btn btn-outline-success text-uppercase" value="Procéder au paiement">
	</form>
	</div>
	</div>
	FOOBAR;
}


function affichageEnchere($dataAPayer,$db_handle){
	
	$idvente = $dataAPayer['IdVente'];
	$sql = "SELECT * FROM vente WHERE IdVente = $idvente;";
	$result = mysqli_query($db_handle, $sql);
	$data = mysqli_fetch_assoc($result);
	
	echo <<< FOOBAR
	<a href="viewproduit.php?id={$data['IdVente']}" style="text-decoration: none;">
	<div class="border-card">
		<img src="{$data['Photo']}"class="img-thumbnail" width=100px height=100px>
		<div class="content-wrapper">
			<div class="label-group fixed">
				<p class="caption ml-4">Nom du produit</p>
				<p class="title ml-4">{$data['Nom']}</p>
			</div>
			<div class="min-gap"></div>
				<div class="label-group">
					<p class="caption">Prix de Départ </p>
					<p class="title">{$data['PrixDepart']}€</p>
				</div>
				<div class="min-gap"></div>
					<div class="label-group">
						<p class="caption">Prix Actuel </p>
						<p class="title">{$dataAPayer['PrixActuel']}€</p>
					</div>
			</div>
	</div>
	</a>
	FOOBAR;
}



?>