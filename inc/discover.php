<?php

if ( isset($_GET['id_rep']) )
{
	if(isset($_POST['bouton_rep_tweet' . $_GET['id_rep'] ]) AND isset($_POST['rep_tweet' . $_GET['id_rep'] ]) AND isset($_POST['id_ans_tweet' . $_GET['id_rep'] ]) AND isset($_POST['user_rep' . $_GET['id_rep'] ]) )
	{
		if ( strlen($_POST['rep_tweet'. $_GET['id_rep'] ]) <= 140 AND strlen($_POST['rep_tweet'. $_GET['id_rep'] ]) > 0 AND isset($_POST['user_rep' . $_GET['id_rep'] ]) )
		{
			$user = htmlentities( $_POST['user_rep' . abs(intval($_GET['id_rep'])) ] );
			$content = "@". $user . " " . htmlentities($_POST['rep_tweet' . abs(intval($_GET['id_rep'])) ]);
			newTweet($bdd, $_SESSION['id'], "$content", NULL, '', abs(intval($_POST['id_ans_tweet' . $_GET['id_rep'] ])), NULL );
		}
		else
		{
			$error_content = 1;
		}
	}
}

if(isset($_POST['bouton-newtweet']) AND isset($_POST['new-tweet']) )
{
	if ( strlen($_POST['new-tweet']) <= 140 )
	{
		newTweet($bdd, $_SESSION['id'], $_POST['new-tweet'], NULL, '', NULL, NULL);
	}
	else
	{
		?>
				<div class="alert alert-error">
					<strong>Erreur :</strong> Don't fuck with Swiffer !
  					<button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
		<?php
	}
}

if (isset($error_content) )
{
		?>
				<div class="alert alert-error">
					<strong>Erreur :</strong> Don't fuck with Swiffer !
  					<button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
		<?php
}
?>

<div class="container body-complete" style="<?php 
		$infos_perso = getUserInfo($bdd, $_SESSION['id']);		
		$fgcolor = hex2rgb($infos_perso['fgcolor']); 
				echo "background-color:rgba(" . $fgcolor . ",0.3)";
		 ?>">
	<div class="left">
		<div class="bloc wall-profil">
			<div class="imgfullname">
				<img src="<?php echo getAvatar($_SESSION['id']); ?>" alt="avatar">
				<span class="fullname">
					<b><?php echo $_SESSION['username']; ?></b>
					<a href="index.php?page=profil&amp;id=<?php echo $_SESSION['id']; ?>">Voir ma page de profil</a>
				</span>
			</div>
				<form method="POST" class="newtweet">
					<input type="text" name="new-tweet" placeholder="Ecrire un nouveau tweet...">
					<input type="submit" name="bouton-newtweet">
				</form>
		</div>
		<div class="bloc wall-menu">
			<ul>
				<li><a href=""><i class="icon-envelope"></i>Messages privés</a></li>
			</ul>
		</div>
		<div class="bloc wall-footer">
			<ul>
				<li>&copy; 2013 Swiffer</li>
				<li><a href="">A propos</a></li>
				<li><a href="">Aide</a></li>
				<li><a href="">Conditions</a></li>
				<li><a href="">Confidentialité</a></li>
				<li><a href="">Blog</a></li>
				<li><a href="">Statut</a></li>
				<li><a href="">Applications</a></li>
				<li><a href="">Ressources</a></li>
				<li><a href="">Offre d'emploi</a></li>
				<li><a href="">Annonceurs</a></li>
				<li><a href="">Professionels</a></li>
				<li><a href="">Médias</a></li>
				<li><a href="">Développeurs</a></li>
			</ul>
		</div>
	</div>
	<div class="right">
		<div class="bloc wall-tweets">
			<h4 class="tweets">Membres</h4>
			<ul>

<?php
$users = getUsers($bdd);
foreach($users AS $value)
{
	if ( $value['id'] != $_SESSION['id'])
	{
?>
				<li>
					<div class="imgtweets">
						<a href="index.php?page=profil&amp;id=<?php echo $value['id']; ?>">
							<img src="<?php echo getAvatar($value['id']); ?>" alt="avatar">
						</a>
					</div>
					<div class="tweet">
						<div>
							<b><a href="index.php?page=profil&amp;id=<?php echo $value['id']; ?>"><?php echo $value['username']; ?></a></b>
							<span>@<?php echo $value['username']; ?></span>
							<span class="date-tweet"></span>
							<br>
							<p></p>
						</div>
					</div>
					<div style="clear:both; padding-bottom:10px;">
					</div>
				</li>
<?php
	}
}

?>
				<li id="back">
					<div class="div-back">
						<img class="back-top" src="img/back-logo.png" alt="logo retour en haut"><br>
						<a href="#" onClick="scrolTop();" class="back-toptext">Retour en haut ↑</a>
					</div>
				</li>
			</ul>
		</div>
		
	</div>
</div>