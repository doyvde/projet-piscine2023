<!DOCTYPE html>
<html>

<head>
	<title>Ece-Ebay</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>



<body>


	<div class="container align-content-center">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container mt-5">
						<img src="ECEBAY.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<br>
				<br>
				<div class="d-flex justify-content-center form_container">

					<form action="traitementAjoutVente.php" method="post" enctype="multipart/form-data">
						<?php
							$error=isset($_GET["error"])? $_GET["error"] : "";
							if($error==1)
								echo '<div class="title mb-2" style="color:red"> Vente Invalide </div>';
							if($error==2)
								echo '<div class="title mb-2" style="color:red"> Type de photo invalide </div>';
							else echo '<div class="title mb-2"> Veuillez entrer une vente </div>';
						?>
							<div class="input-group mb-3">

								<input type="text" name="Nom" class="form-control input_user" placeholder="Nom du produit" >
							</div>

							<div class="input-group mb-1">
								<div class="input-group-append">
									<td > Catégorie <br></td>
								</div>
								<td class="ml-auto">

					<select class = "ml-2" name="Categorie" size="1">
									<option>Ferraille ou Tresor</option>
									<option>Bon pour le Musee</option>
									<option>Accessoire VIP</option>
					</select> </td>
							</div>

								<div class="input-group mb-3">
								<input type="text" name="Description" class="form-control" placeholder="Description" >
							</div>

							<div class="input-group mb-1">
								<div class="input-group-append">
									<td> Type de vente <br></td>
								</div>
								<td class="ml-auto">
					<select class="ml-2" name="TypeVente" size="1">
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
								<label class = "mr-2"> Date de fin de la vente :</label>
								<input type="date" name="DateFin" class="form-control input_user" placeholder="Date de fin">
							</div>

							<tr>
								<td>Image 1 produit</td>
								<td><input type="file" name="image"></td>
							</tr>
							<br>

							<tr>
								<td>Image 2 produit</td>
								<td><input type="file" name="image2"></td>
							</tr>
							<br>

							<tr>
								<td>Image 3 produit</td>
								<td><input type="file" name="image3"></td>
							</tr>
							<br>

							<tr>
								<td>Vidéo du produit</td>
								<td><input type="file" name="vidéo"></td>
							</tr>

						<div class="d-flex justify-content-center mt-3 login_container">
							<input type="submit" class="btn btn-outline-dark" value="Ajouter Cette vente">
						</div>
					</form>
				</div>

				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Vous avez changer d'avis <a href="viewventes.php" class="ml-2" style="color:grey">Retour à la page precedente</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
