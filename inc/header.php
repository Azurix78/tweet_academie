<?php

if(isset($_POST['bouton']))
{
	newTweet($bdd, $_SESSION['id'], $_POST['tweet-area'], NULL, '', NULL, NULL);
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Tweet Academie</title>
		<meta name="author" content="rivier_n christ_a rubio_n">
		<meta charset="utf-8" />
		<link rel="icon" type="image/x-icon" href="img/favicon.ico" />
		<link rel="stylesheet" href="css/bootstrap.css" />
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
		<div id="tweet-new">
				<div id="ctn-tweet">
				</div>
				<div id="contain-tweetnew">
					<div id="tweet-bloc">
						<div class="title-bloc-tweet">
							<b>Quoi de neuf?</b>
							<a href="#" onClick="closeTweet()"><i class="icon-remove"></i></a>
						</div>
						<form method="POST">
							<textarea  id="tweet-area" name="tweet-area" maxlength="141"  onKeyDown="nbcharTweet();" onKeyUp="nbcharTweet();"></textarea>
							<input type="file" name="img-tweet"><span class="btn"><img class="size24" src="img/image-tweet.png" alt=""></span>
							<b style="display:none;" id="max">Nombre de caractères maximum atteint !</b><em id="nbcaract">140</em>
							<input type="submit" class="btn btn-info" name="bouton" value="Tweeter">
						</form>
					</div>
				</div>
			</div>
		<header>
			<div class="container header">
				<div class="nav_left">
					<ul class="inline text_degrade">
						<li><a href="index.php?page=wall&amp;id=<?php echo $_SESSION['id']; ?>"><i class="icon-home icon-white"></i> Accueil</a></li>
						<li><a href="connect.php"><i class="icon-star icon-white"></i> Connecter</a></li>
						<li><a href=""><i class="icon-eye-open icon-white"></i> D&eacute;couvrir</a></li>
						<li><a href="index.php?page=profil&amp;id=<?php echo $_SESSION['id']; ?>"><i class="icon-user icon-white"></i> Moi</a></li>
					</ul>
				</div>
				<div class="separation-header">
					<img class="img-logo-header" src="img/logo-header.png" alt="logo-header">
				</div>

				<div class="nav_right">
					<ul class="inline nav_right-recherche">
							<li>
								<form method="POST">
									<div class="input-append">
										<input class="span2" id="appendedInputButton" placeholder="Recherche..." type="text">
										<button class="btn recherche" type="button"><i class="icon-search"></i></button>
									</div>
								</form>
							</li>
							<li class="divider-vertical">&nbsp;</li>
							<li>
								<div class="btn-group config">
									<a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i><span class="caret"></span></a>
										<ul class="dropdown-menu pull-right">
							   				<li>
							   					<div class="pic-bulle"></div>
							   					<a class="link_sub" href="">
							   						<div class="profil_ul">
							   							<img class="sub_avatar" src="img/avatar.png" alt="sub_avatar">
							   							<p class="text-ulprofil"><b class="sub_user">Rubio Nicolas</b>
							   							<span class="sub_edit">Editer le profil</span></p>
							   						</div>
							   					</a>
							   				</li>
							   				<li class="divider"></li>
							   				<li><a href="">Mes abonnements</a></li>
							   				<li><a href="">Mes abonnés</a></li>
							   				<li><a href="">Messages privés</a></li>
							   				<li class="divider"></li>
							   				<li><a href="">Paramètres</a></li>
							   				<li><a href="inc/logout.php">Deconnexion</a></li>
							  			</ul>
								</div>
							</li>
							<li><button onClick="newTweet();" class="btn btn-info write-tweet"><img src="img/pencil.png" class="size24" alt=""></button></li>
					</ul>
					

			</div>
		</div>

		</header>