<?php
//include 'connexion_bdd.php';

function affichageNego($id, $type){
	//identifier votre BDD
	//$database = "ebayece";

	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';

	if ($db_found) {
		if($type == 'Admin'){

		}
		//on regarde si le client a deja fait une nego si oui on quitte
		//si non on cree la nego
		elseif($type == 'Vendeur'){
			echo'<h4 style="font-weight:bold;color:black">Vos Negociations en cours</h4>
        <hr>';
			traitementAffichageVendeur($id,$db_handle);

		}elseif($type == 'Client'){
			echo'<h4 style="font-weight:bold;color:black">Vos Negociations en cours</h4>
        <hr>';
			traitementsAffichageClient($id,$db_handle);
			echo'<hr>';

		}
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}


function traitementAffichageVendeur($id,$db_handle){ //idsession
	$sqlVente = "SELECT * FROM Vente WHERE IdVendeur = $id;";
	$resultVente = mysqli_query($db_handle, $sqlVente);
	if( mysqli_num_rows($resultVente) == 0){
		echo "Vous n'avez pas de ventes donc pas de Nego";
		return;
	}
	while($dataVente = mysqli_fetch_assoc($resultVente)){
		if($dataVente['TypeVente'] == 'Negociation'){
			$vente = $dataVente['IdVente'];
			$sqlNego = "SELECT * FROM Negociation WHERE IdVente = $vente;";
			$resultNego = mysqli_query($db_handle, $sqlNego);
			while($dataNego = mysqli_fetch_assoc($resultNego))
			{
				$nego=$dataNego['IdVente'];
				$sqlVentedeNego = "SELECT * FROM Vente WHERE IdVente = $nego;";
				$resultVentedeNego = mysqli_query($db_handle, $sqlVentedeNego);
				if(mysqli_num_rows($resultVentedeNego) != 0){
					$dataVentedeNego =  mysqli_fetch_assoc($resultVentedeNego);
					$aQui = aQuiLeTour($dataNego);
					affichageNegoCoteVendeur($dataNego, $dataVentedeNego, $aQui);
				}
			}
		}
	}
}

function affichageNegoCoteVendeur($dataNego,$dataVenteAssocie,$aQuiLeTour)
{
	$tour=$dataNego['NbNego']+1;
	if($aQuiLeTour =="Client"){
		echo <<< FOOBAR
		<div class="border-card">
		<a href="viewproduit.php?id={$dataVenteAssocie['IdVente']}" style="text-decoration:none">
		<img src="{$dataVenteAssocie['Photo']}"class="img-thumbnail" width=100px height=100px>
		</a>
		<div class="content-wrapper">
		<div class="label-group fixed">
		<p class="caption ml-4">Nom du produit</p>
		<p class="title ml-4">{$dataVenteAssocie['Nom']}</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">Prix de Départ </p>
		<p class="title">{$dataVenteAssocie['PrixDepart']}€</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">Prix d'Achat Immediat </p>
		<p class="title">{$dataVenteAssocie['PrixAchatImmediat']}€</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">Prix Négociation </p>
		<p class="title">{$dataNego['PrixNego']}€</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">En attente du </p>
		<p class="title">{$aQuiLeTour}</p>
		</div>
		</div>
		</div>
		FOOBAR;
	}
	else{
		echo <<< FOOBAR
		<div class="border-card">
		<a href="viewproduit.php?id={$dataVenteAssocie['IdVente']}" style="text-decoration:none">
		<img src="{$dataVenteAssocie['Photo']}"class="img-thumbnail" width=100px height=100px>
		</a>
		<div class="content-wrapper">
		<div class="label-group">
		<p class="caption ml-4">Nom du produit</p>
		<p class="title ml-4">{$dataVenteAssocie['Nom']}</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">Départ </p>
		<p class="title">{$dataVenteAssocie['PrixDepart']}€</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">Achat Immediat </p>
		<p class="title">{$dataVenteAssocie['PrixAchatImmediat']}€</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">Prix Négociation </p>
		<p class="title">{$dataNego['PrixNego']}€</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">Client n° </p>
		<p class="title">{$dataNego['IdClient']}</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">Tour n° </p>
		<p class="title">{$tour}</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<form action="traitementNegocier.php?idvente={$dataNego['IdVente']}&IdClient={$dataNego['IdClient']}" method="post">
		<div class="input-group mb-3 ">
		<input type="number" name="prix" class="form-control input_user " placeholder="Entrer ici un prix" >
		</div>
		<div class="d-flex  mt-3 login_container">
		<input type="submit" class="btn btn-outline-dark text-uppercase" value="Negocier">
		</div>
		</form>
		<form action="traitementValiderNegoVendeur.php?idvente={$dataNego['IdVente']}&IdClient={$dataNego['IdClient']}" method="post">
		<div class="d-flex  mt-3 login_container">
		<input type="submit" class="btn btn-outline-success text-uppercase" value="Accepter l'offre ">
		</div>
		</form>
		<form action="traitementRefuserNego.php?idvente={$dataNego['IdVente']}&IdClient={$dataNego['IdClient']}" method="post">
		<div class="d-flex  mt-3 login_container">
		<input type="submit" class="btn btn-outline-danger text-uppercase" value="Refuser l'offre ">
		</div>
		</form>
		</div>
		</div>
		</div>
		FOOBAR;
	}
	//si c'est son tour je met un bouton sinon juste sa nego en cours, au tour du client
}


function traitementsAffichageClient($id,$db_handle)
{
	$sqlNego = "SELECT * FROM Negociation WHERE IdClient = $id;";
	$resultNego = mysqli_query($db_handle, $sqlNego);
	if(mysqli_num_rows($resultNego)==0){
		echo "Vous n'avez pas fait d'offre de Negociation";
	}else{
		while($dataNego =  mysqli_fetch_assoc($resultNego)){
			$idVente = $dataNego['IdVente'];
			$sqlVente = "SELECT * FROM Vente WHERE IdVente = $idVente;";
			$resultVente = mysqli_query($db_handle, $sqlVente);
			$dataVenteAssocie = mysqli_fetch_assoc($resultVente);
			$aQui = aQuiLeTour($dataNego);
			affichageNegoCoteClient($dataNego,$dataVenteAssocie,$aQui);
		}
	}
}

function affichageNegoCoteClient($dataNego,$dataVenteAssocie,$aQuiLeTour){
	$tour=$dataNego['NbNego']+1;
	if($aQuiLeTour =="Vendeur"){
		echo <<< FOOBAR
		<div class="border-card">
		<a href="viewproduit.php?id={$dataVenteAssocie['IdVente']}" style="text-decoration:none">
		<img src="{$dataVenteAssocie['Photo']}"class="img-thumbnail" width=100px height=100px>
		</a>
		<div class="content-wrapper">
		<div class="label-group fixed">
		<p class="caption ml-4">Nom du produit</p>
		<p class="title ml-4">{$dataVenteAssocie['Nom']}</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">Prix de Départ </p>
		<p class="title">{$dataVenteAssocie['PrixDepart']}€</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">Prix d'Achat Immediat </p>
		<p class="title">{$dataVenteAssocie['PrixAchatImmediat']}€</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">Prix Négociation </p>
		<p class="title">{$dataNego['PrixNego']}€</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">En attente du </p>
		<p class="title">{$aQuiLeTour}</p>
		</div>
		</div>
		</div>
		FOOBAR;
	}else{
		echo <<< FOOBAR
		<div class="border-card">
		<a href="viewproduit.php?id={$dataVenteAssocie['IdVente']}" style="text-decoration:none">
		<img src="{$dataVenteAssocie['Photo']}"class="img-thumbnail" width=100px height=100px>
		</a>
		<div class="content-wrapper">
		<div class="label-group">
		<p class="caption ml-4">Nom du produit</p>
		<p class="title ml-4">{$dataVenteAssocie['Nom']}</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">Départ </p>
		<p class="title">{$dataVenteAssocie['PrixDepart']}€</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">Achat Immediat </p>
		<p class="title">{$dataVenteAssocie['PrixAchatImmediat']}€</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">Prix Négociation </p>
		<p class="title">{$dataNego['PrixNego']}€</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<p class="caption">Tour n° </p>
		<p class="title">{$tour}</p>
		</div>
		<div class="min-gap"></div>
		<div class="label-group">
		<form action="traitementNegocier.php?idvente={$dataNego['IdVente']}&IdClient={$dataNego['IdClient']}" method="post">
		<div class="input-group mb-3 ">
		<input type="number" name="prix" class="form-control input_user " placeholder="Entrer ici un prix" >
		</div>
		<div class="d-flex  mt-3 login_container">
		<input type="submit" class="btn btn-outline-dark text-uppercase" value="Negocier">
		</div>
		</form>
		<form action="paiementNego.php?idvente={$dataNego['IdVente']}" method="post">
		<div class="d-flex  mt-3 login_container">
		<input type="submit" class="btn btn-outline-success text-uppercase" value="Accepter l'offre en cours">
		</div>
		</form>
		<form action="paiementNego.php?idvente={$dataNego['IdVente']}&IdClient={$dataNego['IdClient']}" method="post">
		<div class="d-flex  mt-3 login_container">
		<input type="submit" class="btn btn-outline-danger text-uppercase" value="Refuser l'offre en cours">
		</div>
		</form>
		</div>
		</div>
		</div>
		FOOBAR;
	}
}

function aQuileTour($dataNego){
	$nbNego = $dataNego['NbNego'];
	if($nbNego%2 == 0)
	return 'Vendeur';
	else return 'Client';
}

?>
