<!DOCTYPE html>
<html>

<head>
	<title>Page de paiement</title>
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

					<form  action="traitementAchatImmediat.php?idvente=<?php echo $_GET['idvente']; ?>" method="post">
						<?php
						$error=isset($_GET["error"])? $_GET["error"] : "";
						if($error==1)
							echo '<div class="title mb-2" style="color:red"> Type de Carte Incorrect </div>';
						elseif($error==2)
							echo '<div class="title mb-2" style="color:red"> nom de la carte Incorrect </div>';
						elseif($error==3)
							echo '<div class="title mb-2" style="color:red"> infos personnelles Incorrect </div>';
						elseif($error==4)
							echo '<div class="title mb-2" style="color:red"> Fonds insuffisants </div>';
						else echo '<div class="title mb-2"> Veuillez entrer vos informations de paiement </div>';
						?>

						<div class="input-group mb-1">
							<div class="input-group-append">
								<td> Carte <br></td>
							</div>
							<td class="ml-auto">

								<select name="TypeCarte" size="1">
									<option>Visa</option>
									<option>MasterCard</option>
									<option>American Express</option>
									<option>Paypal</option>
								</select> </td>
							</div>


							<div class="input-group mb-3">
								<input type="text" name="NomCarte" class="form-control input_user" placeholder="Nom de la Carte, ex : Jean Dupond" >
							</div>

							<div class="input-group mb-3">
								<input type="text" name ="NumCarte" class="form-control input_user" placeholder="Numéro de carte">
							</div>

							<div class="input-group mb-3">
								<input type="text" name = "DateExpCarte" class="form-control input_user" placeholder="Date d'expiration, ex : 12/2020">
							</div>

							<div class="input-group mb-3">
								<input type="number" name= "CodeCarte" class="form-control input_user" placeholder="Cryptogramme de sécurité">
							</div>


							<div class="d-flex justify-content-center mt-3 login_container">
								<input type="submit" class="btn btn-outline-dark" value="Payer">
							</div>
						</form>
					</div>	

					<div class="mt-4">
						<div class="d-flex justify-content-center links">
							Vous Souhaitez annuler le paiement ? <a href="viewproduit.php?id=<?php echo $_GET['idvente']; ?>" class="ml-2" style="color:grey">Retour sur le site</a>
						</div>	

				</div>
			</div>
		</div>
	</body>
	</html>