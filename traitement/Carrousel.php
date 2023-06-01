<?php

//creer un liste avec a l'interrieur les idvente 
//compte le nombre d'annonce 
//i= nombre d'annonce
//si l'idvente de la 2eme annonces =47 alors on aura array(i)=47

function affichageCarou($id){

    echo <<< FOOBAR
        <section class="pt-5 pb-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                
                                <h3 class="mb-3" style="font-weight:bold;color:black">Offre du Moment:</h3>
	                            <hr>
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-danger mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                                    Prec
                                </a>
                                <a class="btn btn-danger mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">
                                    Suiv
                                </a>
                            </div>
                            <div class="col-12">
                                <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">

                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="row">
FOOBAR;
	//identifier votre BDD
	//$database = "ebayece";

	//connectez-vous dans votre BDD
    $i=1;
	list($db_found,$db_handle)=include 'connexion_bdd.php';
	if ($db_found) {
		$sqlClient = "SELECT *
        FROM vente
        ORDER BY ABS(DATEDIFF(DateFin, CURDATE()))
        LIMIT 6;";

		$resultClient = mysqli_query($db_handle, $sqlClient);
        $l=mysqli_num_rows($resultClient);
		if (mysqli_num_rows($resultClient) == 0) {
			//le livre recherché n'existe pas
			echo "Aucun Articles";
		}else {
			while($data = mysqli_fetch_assoc($resultClient)){
                $i++;
                if($i%3==1){
                echo <<< FOOBAR
                
                                <div class="col-md-4 mb-3">
                                FOOBAR;
                afficheHistoClient($data);
                echo'    
                                </div>
                                

                            </div>
                        </div>';if($i != $l+1 ){echo'
                        <div class="carousel-item">
                            <div class="row">';}}
                    else{
                           echo'  <div class="col-md-4 mb-3">';
                                    
                            afficheHistoClient($data);
                            echo'     </div>';
                    }
                        
                       }echo'       </div>
                </div>
            </div>
        </div>
    </div>
</section>
';
				//afficheHistoClient($data);
                //afficheCar($data);
			}
		

	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}


function afficheHistoClient($data){




	echo <<< FOOBAR
	<div class="card" id="{$data['IdVente']}" style="width: 18rem">
 <img src="{$data['Photo']}"class="card-img-top" width="50%">
	<div class="card-body" ">
	<div class="label-group fixed">
	<h5 class=" card-title">{$data['Nom']}</h5>
	</div>
	<div class="min-gap"></div>
	<div class="label-group">
	<p class="caption">Type d'achat</p>
	<p class="title">{$data['TypeVente']}</p>
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
	<p class="caption">Prix d'Achat Immediat</p>
	<p class="title">{$data['PrixAchatImmediat']}€</p>
	</div>
    <br>
    <a href="viewproduit.php?id={$data['IdVente']}" class="btn btn-outline-danger align-self-center" > Voir l'Annonce </a>
</div>
</div>
FOOBAR;
}

function afficheCar($data){


	echo <<< FOOBAR
	<div id="carrousel">
        
        <img id="img1" src="images/france1.jpg"  />
        <img id="img2" src="images/france2.jpg"  />
        <img id="img3" src="images/france3.jpg"  />
        <img id="img4" src="images/france4.jpg" " />
        <img id="img5" src="images/france5.jpg"  />
        <img id="img6" src="images/france6.jpg"  />
        <img id="img7" src="images/france7.jpg"  />
    </div>
    <div id="carrousel_petit">
        
        <img  src="images/france1.jpg" width="320" />
        <img  src="images/france2.jpg" width="320" />
        <img  src="images/france3.jpg" width="320" />
        <img  src="images/france4.jpg" width="320" />
        <img  src="images/france5.jpg" width="320" />
        <img  src="images/france6.jpg" width="320" />
        <img  src="images/france7.jpg" width="320" />
    </div>
    <div  id="buuton">
        <input type="button" value="Précédent" class="prev">
        <input type="button" value="Suivant" class="next"> 
    </div>
FOOBAR;
}

?>