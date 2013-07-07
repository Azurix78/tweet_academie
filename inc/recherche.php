<?php

if ( isset($_GET['id_rep']) )
{
	if(isset($_POST['bouton_rep_tweet' . $_GET['id_rep'] ]) AND isset($_POST['rep_tweet' . $_GET['id_rep'] ]) AND isset($_POST['id_ans_tweet' . $_GET['id_rep'] ]) AND isset($_POST['user_rep' . $_GET['id_rep'] ]) )
	{
		if ( strlen($_POST['rep_tweet'. $_GET['id_rep'] ]) <= 140 AND strlen($_POST['rep_tweet'. $_GET['id_rep'] ]) > 0 AND isset($_POST['user_rep' . $_GET['id_rep'] ]) )
		{
			$user = $_POST['user_rep' . abs(intval($_GET['id_rep'])) ];
			$content = "@". $user . " " . $_POST['rep_tweet' . abs(intval($_GET['id_rep'])) ];
			newTweet($bdd, $_SESSION['id'], "$content", NULL, '', abs(intval($_POST['id_ans_tweet' . $_GET['id_rep'] ])), NULL );
			
				$error = "<div class='alert alert-success'>
					<strong>Succ&egrave;s :</strong> Message envoyé&eacute; !
  					<button type='button' class='close' data-dismiss='alert'>&times;</button>
				</div>";
		

		}
		else
		{
			$error_content = 1;
		}
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
			newTweet($bdd, $_SESSION['id'], "", '', '', $id_retweeted_reply, $id_ans_tweet);
		}
		else
		{
				$id_ans_tweet = abs(intval($_POST['id_ans_tweet']));
				newTweet($bdd, $_SESSION['id'], "", '', '', NULL, $id_ans_tweet);
				
				$error = "<div class='alert alert-success'>
					<strong>Succ&egrave;s :</strong> Message retweet&eacute; !
  					<button type='button' class='close' data-dismiss='alert'>&times;</button>
				</div>";
		
		}
	}
	else
	{
		
				$error = "<div class='alert alert-error'>
					<strong>Erreur :</strong> Don't fuck with Swiffer !
  					<button type='button' class='close' data-dismiss='alert'>&times;</button>
				</div>";
		
	}
}


if(isset($_POST['bouton-newtweet']) AND isset($_POST['new-tweet']) )
{
	if ( strlen($_POST['new-tweet']) <= 140 )
	{
		newTweet($bdd, $_SESSION['id'], $_POST['new-tweet'], NULL, '', NULL, NULL);
		
				$error = "<div class='alert alert-success'>
					<strong>Succ&egrave;s :</strong> Message envoyé&eacute; !
  					<button type='button' class='close' data-dismiss='alert'>&times;</button>
				</div>";
		
	}
	else
	{
		
				$error = "<div class='alert alert-error'>
					<strong>Erreur :</strong> Don't fuck with Swiffer !
  					<button type='button' class='close' data-dismiss='alert'>&times;</button>
				</div>";
		
	}
}

if (isset($error_content))
{
		
				$error = "<div class='alert alert-error'>
					<strong>Erreur :</strong> Don't fuck with Swiffer !
  					<button type='button' class='close' data-dismiss='alert'>&times;</button>
				</div>";
		
		unset($error_content);
}


if(isset($_GET['q']))
{
	$_SESSION['recherche'] = $_GET['q'];
	$_SESSION['recherche'] = htmlentities($_SESSION['recherche']);
	$_SESSION['recherche'] = mysqli_real_escape_string($bdd, $_SESSION['recherche']);
	if ( !empty($_SESSION['recherche']) )
	{
		$recherche = $_SESSION['recherche'];
		$tweets = search_select($bdd, "tweets", "hashtags", $recherche);
	}
	else
	{

		$tweets = array();
		
				$error = "<div class='alert alert-error'>
					<strong>Erreur :</strong> Veuillez rentrez un hashtags dans la recherche !
  					<button type='button' class='close' data-dismiss='alert'>&times;</button>
				</div>";
		
	}
}
elseif( isset($_SESSION['recherche']) )
{
	$recherche = $_SESSION['recherche'];
	$tweets = search_select($bdd, "tweets", "hashtags", $recherche);
}
else
{
	$tweets = array();
		
				$error = "<div class='alert alert-error'>
					<strong>Erreur :</strong> Veuillez rentrez un hashtags dans la recherche !
  					<button type='button' class='close' data-dismiss='alert'>&times;</button>
				</div>";
		
}

?>
<div class="container body-complete" id="body-complete" style="<?php 
		$infos_perso = getUserInfo($bdd, $_SESSION['id']);		
		$fgcolor = hex2rgb($infos_perso['fgcolor']); 
				echo "background-color:rgba(" . $fgcolor . ",0.3)";
		 ?>">
	<?php if(isset($error)){ echo $error;} ?>
	<div class="left">
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

$id_msg = 1;
if (!isset($tweets))
$tweets = array();
foreach($tweets AS $value)
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
							<form method="POST" class="newtweet" action="index.php?page=recherche&amp;id_rep=<?php echo $id_msg; ?>">
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