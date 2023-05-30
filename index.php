<!DOCTYPE html>
<html>

<head>
	<title>Agora Francia</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>



<body style=" background-image: url(systeme/fondlogin.jpg);background-repeat: no-repeat;background-size: cover;background-color: black;width:100%;height:100%" >


	<div class="container align-content-center ">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container mt-5">
						<img src="systeme/logo3.png" class="brand_logo" alt="Logo" width="275">
					</div>
					
				</div>
				
				<br>
				<br>
				
				<p class="d flex title justify-content-center text-center font-weight-bold" style="color:white;text-align:justify;"> Bienvenue sur Agora Francia<br> Les plus beaux articles vous attendent. <br>Connectez-vous ou créez votre compte.<br> </p>
				<div class=" justify-content-center p-3" style="color:white;background-color:none" >



					<form action="traitement/Login.php" method="post" >

						<?php
						$error=isset($_GET["error"])? $_GET["error"] : "";
						if($error==1)

							echo '<div class="title mb-2" style="color:red"> Votre identifiant ou votre mot de passe est incorrect  </div>';
							elseif ($error==2) {
								echo '<div class="title mb-2"> Connectez-vous maintenant grâce à votre nouvel identifiant </div>';
							}
						else echo '<div class="title mb-2"> Veuillez entrer votre identifiant et votre mot de passe  </div>';
						?>

						<div class="input-group mb-3">

							<input type="text" name="pseudo" class="form-control input_user" placeholder="Identifiant" >
						</div>
						<div class="input-group mb-2">

							<input type="password" name="mdp" class="form-control input_pass" placeholder="Mot de passe" >
						</div>
						<div class="input-group mb-1">
							<div class="input-group-append">
								<td> Votre statut : <br></td>
							</div>
							<td class="ml-auto">

								<select class="form-control"name="type" size="1">
									<option>Client</option>
									<option>Admin</option>
									<option>Vendeur</option>
								</select> </td>
							</div>

							<div class="d-flex justify-content-center mt-3 login_container">
								<input type="submit" class="btn btn-outline-light" style="text-transform:uppercase" value="Se connecter">
							</div>
						</form>


					<div class="mt-4">
						<div class="d-flex justify-content-center links" style="padding-top: 85%;">
							Vous n'avez pas de compte? <a href="viewInscription.php" class="ml-2" style="color:yellow">Créer un compte</a>
						</div>
					</div>

					</div>
				</div>
			</div>
		</div>
	</body>
	
	</html>