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
			$_SESSION['error_content'] = 1;
		}
	}
	if(isset($_POST['bouton_retweet' . $_GET['id_rep'] ]) AND isset($_POST['id_ans_tweet' . $_GET['id_rep'] ]) AND isset($_POST['user_rep' . $_GET['id_rep'] ]) )
	{
		
	}
}

if(isset($_POST['btn_add_abo']) && isset($_POST['id_add_abo']) && !empty($_POST['id_add_abo']))
{
	$id_add_abo = abs(intval($_POST['id_add_abo']));
	$test_result = mysqli_query($bdd, 'SELECT * FROM users WHERE id="'.$id_add_abo.'"');
	if(mysqli_num_rows($test_result) > 0 && mysqli_num_rows($test_result) != null && $test_result != false)
	{
		$results_abos = mysqli_query($bdd, 'SELECT follows FROM users WHERE id='.$_SESSION['id']);
		if($results_abos != false)
		{
			while($abos = mysqli_fetch_assoc($results_abos))
			{
				$liste_abos = explode(";", $abos['follows']);
				if(in_array($id_add_abo, $liste_abos))
				{
?>
					<div class="alert alert-error">
						<strong>Erreur :</strong> Vous &ecirc;tes d&eacute;j&agrave; abonn&eacute; &agrave;  <?php $alert_msg=getUserInfo($bdd, $id_add_abo);echo $alert_msg['username'];?>.
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
					</div>
<?php
					break;
				}
				array_push($liste_abos, $id_add_abo);
				$new_liste_abos = implode(";", $liste_abos);
				$update_abos = mysqli_query($bdd, 'UPDATE users SET follows="'.$new_liste_abos.'" WHERE id='.$_SESSION['id']);
				if($update_abos == true)
				{
?>
					<div class="alert alert-success">
						<strong>Succ&egrave;s :</strong> Vous &ecirc;tes abonn&eacute; &agrave; <?php $alert_msg=getUserInfo($bdd, $id_add_abo);echo $alert_msg['username'];?>.
	  					<button type="button" class="close" data-dismiss="alert">&times;</button>
					</div>
<?php
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

$id = $_GET['id'];
$tab_infos = getUserInfo($bdd, $id);
$followers = listFollower($bdd, $id);
$follows = explode(';', $tab_infos['follows']);
if(count($follows) == 1 && empty($follows[0]))
{
	$follows = array();
}

?>
<div class="container body-complete">
	<div class="left">
		<div class="bloc wall-menu">
			<ul>
				<li><a href="index.php?page=profil&amp;id=<?php echo $_GET['id']; ?>">Tweets<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>
				<li><a href="index.php?page=following&amp;id=<?php echo $_GET['id']; ?>">Abonnements<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>

				<li><a href="index.php?page=follower&amp;id=<?php echo $_GET['id']; ?>">Abonnés<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>
			</ul>
		</div>
		<div class="bloc wall-menu" id="msg_priv">
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
	<div class="right ban-profil">
		<div class="ban-info">
			<img class="avatar-ban" src="<?php echo getAvatar($id); ?>" alt="avatar">
			<div class="text_ban">
				<h1><?php echo $tab_infos['username']; ?></h1>
				<h2>@<?php echo $tab_infos['username']; ?></h2>
				<p><?php echo $tab_infos['locality']; ?></p>
			</div>
		</div>
		<div class="ban-nav">
			<ul class="inline link-nav">
				<li><a href="index.php?page=profil&amp;id=<?php echo $_GET['id']; ?>"><p><strong><?php echo count(getTweetsPerso($bdd, $id)); ?></strong>Tweets</p></a></li>
				<li><a href="index.php?page=following&amp;id=<?php echo $_GET['id']; ?>"><p><strong><?php echo count($follows); ?></strong>Abonnements</p></a></li>
				<li><a href="index.php?page=follower&amp;id=<?php echo $_GET['id']; ?>"><p><strong><?php echo count($followers); ?></strong>Abonn&eacute;s</p></a></li>
			</ul>
			<ul class="inline btn-nav">
<?php

if($_GET['id'] == $_SESSION['id'])
{
?>
				<li><button class="btn"><i class="icon-envelope"></i></button></li>
				<li><button class="btn">Editer le profil</button></li>
<?php
}
else
{
?>
				<form method="POST">
					<input type="hidden" name="id_add_abo" value="<?php echo $id; ?>">
					<input type="submit" class="btn btn-info" name="btn_add_abo" value="Suivre">
				</form>

<?php
}
?>
			</ul>
		</div>

	</div>


	<div class="right">
		<div class="bloc wall-tweets">
			<h4 class="tweets">Tweets</h4>
			<ul>
<?php

$tab_tweets = getTweetsPerso($bdd, $id);
$id_msg = 1;
if ( !empty($tab_tweets) )
{
	foreach($tab_tweets AS $value)
	{

	?>
					<li>
					<div class="imgtweets">
						<a href="index.php?page=profil&amp;id=<?php echo $value['id_user']; ?>">
							<img src="<?php echo getAvatar($value['id_user']); ?>" alt="avatar">
						</a>
					</div>
					<div class="tweet">
<?php
						if ( isset($value['id_reply']) AND $value['id_reply'] != NULL)
						{
							$reply = getTweet($bdd, $value['id_reply']);
?>
						<div id="<?php echo $id_msg; ?>ans" class="answer" onclick="tweet_rep('<?php echo $id_msg; ?>')">
							<b><a href="index.php?page=profil&amp;id=<?php echo $reply['id_user']; ?>"><?php echo $reply['username']; ?></a></b>
							<span>@<?php echo $reply['username']; ?></span>
							<span class="date-tweet"><?php echo date("j F y", date_timestamp_get(date_create($reply['date']))); ?></span>
							<br>
							<p><?php echo nl2br2($reply['content']); ?></p>
						</div>
<?php
						}
?>
						<div>

						</div>
						<div <?php if ( isset($value['id_retweet']) ){echo "style='border:5px red solid;' ";}?>onclick="tweet_rep('<?php echo $id_msg; ?>')">
							<b><a href="index.php?page=profil&amp;id=<?php echo $value['id_user']; ?>"><?php echo $value['username']; ?></a></b>
							<span>@<?php echo $value['username']; ?></span>
							<span class="date-tweet"><?php echo date("j F y", date_timestamp_get(date_create($value['date']))); ?></span>
							<br>
							<p><?php echo nl2br2($value['content']); ?></p>
						</div>
						<div class="tweet_rep" id="<?php echo $id_msg; ?>">
							<form method="POST" class="newtweet" action="index.php?page=profil&amp;id=<?php echo $_GET['id']; ?>&amp;id_rep=<?php echo $id_msg; ?>">
								<input type="hidden" name="id_ans_tweet<?php echo $id_msg; ?>" value="<?php echo $value['id']; ?>">
								<input type="hidden" name="user_rep<?php echo $id_msg; ?>" value="<?php echo $value['username']; ?>">
								<textarea required maxlength="140" id="<?php echo $id_msg; ?>text" style="resize:none;" name="rep_tweet<?php echo $id_msg; ?>" placeholder="R&eacute;pondre au tweet de <?php echo $value['username']; ?>"></textarea>
								<input type="submit" name="bouton_rep_tweet<?php echo $id_msg; ?>" class="btn btn-info" value="Tweeter">
								<div class="separ_btn_rep"></div>
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
}
else
{
?>
						<div class="tweet">
							<li id="no_abo"><p>Vous n'avez pas encore de tweet !</p></li>
						</div>
<?php
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