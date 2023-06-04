<?php
//include 'connexion_bdd.php';
function affichageMonCompte($type, $id){

	//identifier votre BDD
	//$database = " ";

	//connectez-vous dans votre BDD
	list($db_found,$db_handle)=include 'connexion_bdd.php';

	if ($db_found) {
		if($type == "Vendeur"){
			$sqlVendeur = "SELECT * FROM Vendeur WHERE IdVendeur = $id;";
			$resultVendeur = mysqli_query($db_handle, $sqlVendeur);
			if (mysqli_num_rows($resultVendeur) == 0) {
			//le livre recherché n'existe pas
				echo "Pas d'objet trouvé";
			}else {
				$data = mysqli_fetch_assoc($resultVendeur);
				afficheVendeur($data);
			}

		}elseif ($type == "Client") {
			$sqlClient = "SELECT * FROM CLient WHERE IdClient = $id;";
			$resultClient = mysqli_query($db_handle, $sqlClient);
			if (mysqli_num_rows($resultClient) == 0) {
				//le livre recherché n'existe pas
				echo "Pas d'objet trouvé";
			}else {
				$data = mysqli_fetch_assoc($resultClient);
				afficheClient($data);
			}

		}
	}else {
		echo "Database not found";
	}
	//fermer la connexion
	mysqli_close($db_handle);
}

function afficheVendeur($data){

	echo <<< FOOBAR
	<div class="container">
			<div class="row">
					<div class="col-12">
							<div class="card">
								<div class="card-body">
											<div class="card-title mb-4">
													<div class="d-flex justify-content-start">
													<div class="userData ml-3">
															<h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">{$data['Prenom']} {$data['Nom']}</h2>
													<div class="image-container">
																	<img src="{$data['Photo']}" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
													</div>
													</div>
													</div>
											</div>
											<div class="row">
													<div class="col-12">
															<ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
																	<li class="nav-item">
																			<a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true"style="color:grey">Informations</a>
																	</li>
																</ul>
															<div class="tab-content ml-1" id="myTabContent">
																	<div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
																	<div class="row">
																					<div class="col-sm-3 col-md-2 col-5">
																							<label style="font-weight:bold;">Nom :</label>
																					</div>
																					<div class="col-md-8 col-6">
																							{$data['Nom']}
																					</div>
																			</div>
																			<hr />
																		<div class="row">
																					<div class="col-sm-3 col-md-2 col-5">
																							<label style="font-weight:bold;">Email :</label>
																					</div>
																					<div class="col-md-8 col-6">
																							{$data['E-mail']}
																					</div>
																			</div>
																			<hr />
																			<div class="row">
																					<div class="col-sm-3 col-md-2 col-5">
																							<label style="font-weight:bold;">Téléphone :</label>
																					</div>
																					<div class="col-md-8 col-6">
																							{$data['Telephone']}
																					</div>
																			</div>
																			<hr />
																		<div class="row">
																					<div class="col-sm-3 col-md-2 col-5">
																							<label style="font-weight:bold;">Pays :</label>
																					</div>
																					<div class="col-md-8 col-6">
																							{$data['Pays']}
																					</div>
																		</div>
																	</div>
															</div>
													</div>
											</div>
											</div>
									</div>
					</div>
			</div>
	</div>
	FOOBAR;
}

function afficheClient($data){
	echo <<< FOOBAR
	<div class="container">
			<div class="row">
					<div class="col-12">
							<div class="card">
							<div class="card-body">
											<div class="card-title mb-4">
													<div class="d-flex justify-content-start">
															<div class="userData ml-3">
																	<h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">INFORMATION</h2>
																	<br>
																	<h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">{$data['Prenom']} {$data['Nom']}</h2>
													<div class="image-container">
																	<img src="{$data['Photo']}" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
													</div>
																</div>
															<div class="ml-auto">
																	<input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
															</div>
													</div>
											</div>
											<div class="row">
													<div class="col-12">
															<ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
																	<li class="nav-item">
																			<a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true"style="color:grey">Identité et adresse</a>
																	</li>
																	<li class="nav-item">
																			<a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab" aria-controls="connectedServices" aria-selected="false" style="color:grey">Informations de financement</a>
																	</li>
															</ul>
															<div class="tab-content ml-1" id="myTabContent">
																	<div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
																	<div class="row">
																					<div class="col-sm-3 col-md-2 col-5">
																							<label style="font-weight:bold;">Nom :</label>
																					</div>
																					<div class="col-md-8 col-6">
																							{$data['Nom']}
																					</div>
																			</div>
																			<hr />
																			<div class="row">
																					<div class="col-sm-3 col-md-2 col-5">
																							<label style="font-weight:bold;">Prenom :</label>
																					</div>
																					<div class="col-md-8 col-6">
																							{$data['Prenom']}
																					</div>
																			</div>
																			<hr />
																	<div class="row">
																					<div class="col-sm-3 col-md-2 col-5">
																							<label style="font-weight:bold;">Email :</label>
																					</div>
																					<div class="col-md-8 col-6">
																							{$data['E-mail']}
																					</div>
																			</div>
																			<hr />
																		<div class="row">
																					<div class="col-sm-3 col-md-2 col-5">
																							<label style="font-weight:bold;">Adresse :</label>
																					</div>
																					<div class="col-md-8 col-6">
																							{$data['Adresse']}
																					</div>
																			</div>
																	<div class="row">
																					<div class="col-sm-3 col-md-2 col-5">
																							<label >Code Postal :</label>
																					</div>
																					<div class="col-md-8 col-6">
																							{$data['CodePostal']}
																					</div>
																			</div>
																		<div class="row">
																					<div class="col-sm-3 col-md-2 col-5">
																							<label>Ville : </label>
																					</div>
																					<div class="col-md-8 col-6">
																							{$data['Ville']}
																					</div>
																			</div>
																			<div class="row">
																					<div class="col-sm-3 col-md-2 col-5">
																							<label>Pays :</label>
																					</div>
																					<div class="col-md-8 col-6">
																							{$data['Pays']}
																					</div>
																			</div>
																</div>
																	<div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
																		<div class="row">
																				<div class="col-sm-3 col-md-2 col-5">
																						<label style="font-weight:bold;">Type de carte : </label>
																				</div>
																				<div class="col-md-8 col-6">
																						{$data['TypeCarte']}
																				</div>
																		</div>
																			<hr />
																		<div class="row">
																				<div class="col-sm-3 col-md-2 col-5">
																						<label style="font-weight:bold;">Nom de la carte : </label>
																				</div>
																				<div class="col-md-8 col-6">
																						{$data['NomCarte']}
																				</div>
																		</div>
																			<hr />
																		<div class="row">
																				<div class="col-sm-3 col-md-2 col-5">
																						<label style="font-weight:bold;">Solde du porte-monnaie: </label>
																				</div>
																				<div class="col-md-8 col-6">
																						{$data['PorteMonnaie']}
																				</div>
																		</div>
																	</div>
															</div>
													</div>
											</div>
									</div>
							</div>
					</div>
			</div>
	</div>
	FOOBAR;
}


?>
