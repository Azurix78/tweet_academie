<?php
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

if (isset($_SESSION['error_content']) )
{
		?>
				<div class="alert alert-error">
					<strong>Erreur :</strong> Don't fuck with Swiffer !
  					<button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
		<?php
		unset($_SESSION['error_content']);
}
?>

<div class="container body-complete">
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
				<li><a href=""><i class="icon-comment"></i>Mentions</a></li>
				<li><a href=""><i class="icon-envelope"></i>Messages privés</a></li>
				<li><a href=""><i class="icon-list"></i>Listes</a></li>
				<li><a href=""><i class="icon-signal"></i>Activité du réseau</a></li>
				<li class="fin-li"><a href=""><i class="icon-calendar"></i>A la une</a></li>
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
			<h4 class="tweets">Tweets</h4>
			<ul>
<?php
$tweets = getTweetsAll($bdd, $_SESSION['id']);
$id_msg = 1;
foreach($tweets AS $value)
{

?>
				<li>
					<div class="imgtweets">
						<a href="index.php?page=profil&amp;id=<?php echo $value['id_user']; ?>">
							<img src="<?php echo getAvatar($value['id_user']); ?>" alt="avatar">
						</a>
					</div>
					<div class="tweet">
						<div <?php if ( isset($value['id_retweet']) ){echo "style='border:5px red solid;' ";}?>onclick="tweet_rep('<?php echo $id_msg; ?>')">
							<b><a href="index.php?page=profil&amp;id=<?php echo $value['id_user']; ?>"><?php echo $value['username']; ?></a></b>
							<span>@<?php echo $value['username']; ?></span>
							<span class="date-tweet"><?php echo date("j F y", date_timestamp_get(date_create($value['date']))); ?></span>
							<p><?php echo nl2br2($value['content']); ?></p>
						</div>
						<div class="tweet_rep" id="<?php echo $id_msg; ?>">
							<form method="POST" class="newtweet" action="inc/form_rep_tweet.php?id=<?php echo $id_msg; ?>">
								<input type="hidden" name="id_ans_tweet<?php echo $id_msg; ?>" value="<?php echo $value['id']; ?>">
								<input type="hidden" name="user_rep<?php echo $id_msg; ?>" value="<?php echo $value['username']; ?>">
								<textarea required maxlength="140" id="<?php echo $id_msg; ?>text" style="resize:none;" name="rep_tweet<?php echo $id_msg; ?>" placeholder="R&eacute;pondre au tweet de <?php echo $value['username']; ?>"></textarea>
								<input type="submit" name="bouton_rep_tweet<?php echo $id_msg; ?>" class="btn btn-info" value="Tweeter">
								<div style="width:20px;float:right;height:30px;"></div>
								<input type="submit" name="bouton_retweet<?php echo $id_msg; ?>" class="btn btn-info" value="Retweet">
							</form>
						</div>
					</div>
					<div style="clear:both; padding-bottom:10px;">
						</div>
				</li>
<?php
$id_msg++;
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