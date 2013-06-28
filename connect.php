<?php 
require_once("inc/config.php");
require_once("inc/db.php");
require_once("inc/functions.php");
require_once("inc/header.php");

if(isset($_POST['bouton']))
{
	if(isset($_POST['signin-email']) && isset($_POST['signin-password']))
	{
		$user = htmlentities($_POST['signin-email']);
		$password = htmlentities($_POST['signin-password']);
		if(CheckLogin($bdd, $user, $password) == 1)
		{
			echo 'coucou';
		}
		else
		{
			$error = "<div class=\"alert alert-error\">
  				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  				<strong>Erreur :</strong> Vos identifiants sont incorrects.
			</div>";	
		}
	}
	else
	{
	$error = "<div class=\"alert alert-error\">
  				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  				<strong>Erreur :</strong> Merci de remplir tous les champs.
			</div>";
	}
}



if(isset($_POST['bouton-register']))
{
	$error_register = "<div class=\"alert alert-error\">
  				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  				<strong>Erreur :</strong> Ce nom est déjà pris.
			</div>";
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Connexion Tweet-Academie</title>
		<meta name="author" content="rivier_n christ_a rubio_n">
		<meta charset="utf-8" />
		<link rel="icon" type="image/x-icon" href="img/favicon.ico" />
		<link rel="stylesheet" href="css/bootstrap.css" />
		<link rel="stylesheet" href="css/connect.css" />
		<script type="text/javascript">
			
		</script>
	</head>
	<body>
<h1 class="logo-connexion" id="logo-connect" <?php if(isset($_POST['bouton']) || isset($_POST['bouton-register'])){ echo "style=\"animation:opacity 0s;-webkit-animation:opacity 0s;\"";} ?>><img src="img/logo-connect.png" alt="logo"></h1>

<div id="bloc-connect" <?php if(isset($_POST['bouton']) || isset($_POST['bouton-register'])){ echo "style=\"animation:opacity 0s;-webkit-animation:opacity 0s;\"";} ?>>
	<div class="welcome">
		<h4>Bienvenue sur Swiffer</h4>
		<p>Découvrez ce qui se passe en ce moment chez les personnes et dans les organismes qui vous tiennent à cœur.</p>
		<p>Pour vous inscrire, c'est trés simple.</p>
		<p>Entrez les informations suivantes :</p>
		<p>
			<ul>
				<li>Nom &amp; Prénom</li>
				<li>Email</li>
				<li>Mot de passe</li>
			</ul>
		</p>

		<p>Un fois inscrit, il ne vous reste plus qu'à vous connectez et à profiter des nombreuses fonctionnalités que vous propose Swiffer.</p>
	</div>
	<div class="contain-bloc" >
		<?php if(isset($error)){ echo $error;} ?>
		<div class="connexion ">
			<form class="signin" method="post">
    	    	<label for="signin-email">Nom d'utilisateur ou email</label>
    	    	<input type="text" class="input-large" name="signin-email" id="signin-email" placeholder="Nom d'utilisateur ou email">
     	   	<label for="signin-password">Mot de passe</label>
    	    	<input class="input-medium" type="password" name="signin-password" id="signin-password" placeholder="Mot de passe">
    	    	<input class="btn btn-info" type="submit" value="Se connecter" name="bouton">
   			</form>
   	 </div>
   	 <?php if(isset($error_register)){ echo $error_register;} ?>
		<div class="inscription">
			<h5>Nouveau sur Swiffer ? Inscrivez-vous</h5>
			<form class="signin" method="post">
     	   	<label for="fullname">Nom complet</label>
      	  	<input type="text" class="input-large" name="fullname" id="fullname" placeholder="Nom complet">
     	   	<label for="email">Nom complet</label>
      	  	<input type="text" class="input-large" name="email" id="email" placeholder="Email">
    	   	<label for="register-password">Mot de passe</label>
      	  	<input type="password" class="input-medium" name="register-password" id="register-password" placeholder="Mot de passe">
     	   	<input class="btn" type="submit" value="S'inscrire" name="bouton-register">
   			</form>
		</div>
	<div>
<?php if(!isset($_POST['bouton']) && !isset($_POST['bouton-register'])){ echo "<script type=\"text/javascript\" src=\"js/connect.js\"></script>";} ?>
	<script src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	</div>
	</body>
</html>
