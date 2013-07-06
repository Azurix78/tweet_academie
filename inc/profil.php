<?php

if ( !isset($_GET['id']) )
	header("Location: index.php?page=404");

$id = $_GET['id'];
$tab_infos_perso = getUserInfo($bdd, $_SESSION['id']);
$tab_infos = getUserInfo($bdd, $id);
$follows = explode(';', $tab_infos['follows']);
$followers = listFollower($bdd, $id);
$myfollows = explode(';', $tab_infos_perso['follows']);
if(count($follows) == 1 && empty($follows[0]))
{
	$follows = array();
}
if(count($myfollows) == 1 && empty($myfollows[0]))
{
	$myfollows = array();
}
foreach ($myfollows as $value)
{
	if ( $_GET['id'] == $value )
	{
		$abo = "ok";
	}
}

if(isset($_POST['bouton_retweet']))
{
	if( isset($_POST['id_ans_tweet']) && !empty($_POST['id_ans_tweet']) )
	{
		if ( isset($_POST['id_retweeted_reply']) && !empty($_POST['id_retweeted_reply']) )
		{
			$id_ans_tweet = abs(intval($_POST['id_ans_tweet']));
			$id_retweeted_reply = abs(intval($_POST['id_retweeted_reply']));
			newTweet($bdd, $_SESSION['id'], "", '', $_SESSION['locality'], $id_retweeted_reply, $id_ans_tweet);
			?>
				<div class="alert alert-success">
					<strong>Succ&egrave;s :</strong> Message envoyé&eacute; !
  					<button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
			<?php
		}
		else
		{
				$id_ans_tweet = abs(intval($_POST['id_ans_tweet']));
				newTweet($bdd, $_SESSION['id'], "", '', '', NULL, $id_ans_tweet);
				?>
				<div class="alert alert-success">
					<strong>Succ&egrave;s :</strong> Message envoyé&eacute; !
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

if ( isset($tab_infos_perso['follows']) AND !empty($tab_infos_perso['follows']) )
{
	$raw_follow = explode(";", $tab_infos_perso['follows']);
	if ( isset($_POST['btn-delabo']) AND isset($_POST['id_del']))
	{
		$id_del = abs(intval($_POST['id_del']));
		foreach ($raw_follow as $key => $value)
		{
			if ( $value == $_POST['id_del'])
			{
				unset($raw_follow[$key]);
				if ( !empty($raw_follow) )
				{
					$new_abo = implode(";", $raw_follow);
					delFollows($bdd, $new_abo, $_SESSION['id']);
				}
				else
				{
					$new_abo = "";
					delFollows($bdd, $new_abo, $_SESSION['id']);
				}
					$del = 1;
				?>
				<div class="alert alert-success">
					<strong>Succ&egrave;s :</strong> Vous n'&ecirc;tes plus abonn&eacute; &agrave; <?php $alert_msg=getUserInfo($bdd, $value);echo $alert_msg['username'];?>.
  					<button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
				<?php
			}
		}
		if ( !isset($del))
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

if ( isset($_GET['id_rep']) )
{
	if(isset($_POST['bouton_rep_tweet' . $_GET['id_rep'] ]) AND isset($_POST['rep_tweet' . $_GET['id_rep'] ]) AND isset($_POST['id_ans_tweet' . $_GET['id_rep'] ]) AND isset($_POST['user_rep' . $_GET['id_rep'] ]) )
	{
		if ( strlen($_POST['rep_tweet'. $_GET['id_rep'] ]) <= 140 AND strlen($_POST['rep_tweet'. $_GET['id_rep'] ]) > 0 AND isset($_POST['user_rep' . $_GET['id_rep'] ]) )
		{
			$user = htmlentities( $_POST['user_rep' . abs(intval($_GET['id_rep'])) ] );
			$content = "@". $user . " " . htmlentities($_POST['rep_tweet' . abs(intval($_GET['id_rep'])) ]);
			newTweet($bdd, $_SESSION['id'], "$content", NULL, '', abs(intval($_POST['id_ans_tweet' . $_GET['id_rep'] ])), NULL );
			?>
				<div class="alert alert-success">
					<strong>Succ&egrave;s :</strong> Message envoyé&eacute; !
  					<button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
			<?php
		}
	}
}

if ( isset($_GET['id_abo']) )
{
	if( isset($_POST['btn_add_abo' . $_GET['id_abo'] ]) AND isset($_POST['id_add_abo' . $_GET['id_abo'] ]) )
	{
			addAbo($bdd, $_POST['id_add_abo' . $_GET['id_abo'] ]);
	}
}

if(isset($_POST['btn_add_abo']) && isset($_POST['id_add_abo']) && !empty($_POST['id_add_abo']))
{
	addAbo($bdd, $_POST['id_add_abo']);
}

unset($abo);
$tab_infos_perso = getUserInfo($bdd, $_SESSION['id']);
$tab_infos = getUserInfo($bdd, $id);
$follows = explode(';', $tab_infos['follows']);
$followers = listFollower($bdd, $id);
$myfollows = explode(';', $tab_infos_perso['follows']);
if(count($follows) == 1 && empty($follows[0]))
{
	$follows = array();
}
if(count($myfollows) == 1 && empty($myfollows[0]))
{
	$myfollows = array();
}
foreach ($myfollows as $value)
{
	if ( $_GET['id'] == $value )
	{
		$abo = "ok";
	}
}

?>
<div class="container body-complete" <?php if(isset($_GET['id'])){
		 if(isset($_GET['page']) && $_GET['page'] == "profil" && !empty($tab_infos['fgcolor'])){
				echo "style='background-color:#" . $tab_infos['fgcolor'] . "'";
			}
		} ?>>
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
				<li><a class="btn" id="edit_link" href="index.php?page=edit_user">Editer le profil</a></li>
<?php
}
elseif ( isset($abo) )
{
?>
				<form method="POST">
					<input type="hidden" name="id_del" value="<?php echo $_GET['id'];?>">
					<input type="submit" class="btn btn-danger" name="btn-delabo" value="Se d&eacute;sabonner">
				</form>
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
if(isset($value['id_retweet']) && $value['id_retweet'] != NULL)
{
	$retweet = getTweet($bdd, $value['id_retweet']);
	$username = getUserInfo($bdd, $value['id_user']);
?>
				<li>
					<div class="imgtweets">
						<a href="index.php?page=profil&amp;id=<?php echo $retweet['id_user']; ?>">
							<img src="<?php echo getAvatar($retweet['id_user']); ?>" alt="avatar">
						</a>
					</div>
					<div class="tweet">
<?php
}
else
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
}
if ( isset($value['id_reply']) AND $value['id_reply'] != NULL)
{
							$reply = getTweet($bdd, $value['id_reply']);
							if ( isset($reply['id_retweet']) )
							{
								$reply = getTweet($bdd, $reply['id_retweet']);
							}
?>
						<div id="<?php echo $id_msg; ?>ans" class="answer" onclick="tweet_rep('<?php echo $id_msg; ?>')">
							<b><a href="index.php?page=profil&amp;id=<?php echo $reply['id_user']; ?>"><?php echo $reply['username']; ?></a></b>
							<span>@<?php echo $reply['username']; ?></span>
							<span class="date-tweet"><?php echo date("j F y", date_timestamp_get(date_create($reply['date']))); ?></span>
							<br>
							<p><?php echo nl2br2(checkTags($bdd, html_entity_decode($reply['content']), $reply['id_user'])); ?></p>
						</div>
<?php
}
if(isset($value['id_retweet']) && $value['id_retweet'] !=  NULL)
{
?>
						<div id="<?php echo $id_msg; ?>" onclick="tweet_rep('<?php echo $id_msg; ?>')">
							<b><a href="index.php?page=profil&amp;id=<?php echo $retweet['id_user']; ?>"><?php echo $retweet['username']; ?></a></b>
							<span>@<?php echo $retweet['username']; ?> (re-tweeté par <?php echo $username['username']; ?>)</span>
							<span class="date-tweet"><?php echo date("j F y", date_timestamp_get(date_create($value['date']))); ?></span>
							<br>
							<p><?php echo nl2br2(checkTags($bdd, html_entity_decode($retweet['content']), $retweet['id_user'])); ?></p>
						</div>
<?php
$id_real_tweet = $retweet['id'];
}
else
{
?>
						<div id="<?php echo $id_msg; ?>" onclick="tweet_rep('<?php echo $id_msg; ?>')">
							<b><a href="index.php?page=profil&amp;id=<?php echo $value['id_user']; ?>"><?php echo $value['username']; ?></a></b>
							<span>@<?php echo $value['username']; ?></span>
							<span class="date-tweet"><?php echo date("j F y", date_timestamp_get(date_create($value['date']))); ?></span>
							<br>
							<p><?php echo nl2br2(checkTags($bdd, html_entity_decode($value['content']), $value['id_user'])); ?></p>
						</div>
<?php
$id_real_tweet = $value['id'];
}
?>
						<div class="tweet_rep" id="<?php echo $id_msg; ?>rep">
							<form method="POST" class="newtweet" action="index.php?id_rep=<?php echo $id_msg; ?>">
								<input type="hidden" name="id_ans_tweet<?php echo $id_msg; ?>" value="<?php echo $value['id']; ?>">
								<input type="hidden" name="user_rep<?php echo $id_msg; ?>" value="<?php echo $value['username']; ?>">
								<textarea required maxlength="140" id="<?php echo $id_msg; ?>text" style="resize:none;" name="rep_tweet<?php echo $id_msg; ?>" placeholder="R&eacute;pondre au tweet de <?php echo $value['username']; ?>"></textarea>
								<input type="submit" name="bouton_rep_tweet<?php echo $id_msg; ?>" class="btn btn-info" value="Tweeter">
								<div class="separ_btn_rep"></div>
							</form>
							<form class="newtweet" method="POST">
								<input type="hidden" name="id_ans_tweet" value="<?php echo $id_real_tweet; ?>">
								<input type="hidden" name="id_retweeted_reply" value="<?php echo $value['id_reply']; ?>">
								<input type="submit" value="Retweet" class="btn btn-info" name="bouton_retweet">
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
	if($id == $_SESSION['id'])
	{
?>
					<div class="tweet">
						<li id="no_abo"><p>Vous n'avez publi&eacute; aucun tweet pour l'instant.</p></li>
					</div>
<?php
	}
	else
	{
?>
					<div class="tweet">
						<li id="no_abo"><p><?php echo $tab_infos['username']; ?> n'a publi&eacute; aucun tweet pour l'instant.</p></li>
					</div>
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