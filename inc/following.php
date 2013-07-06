<?php
$user_abo = getUserInfo($bdd, $_GET['id']);
$id = $_GET['id'];
$tab_infos = getUserInfo($bdd, $id);
$tab_infos_perso = getUserInfo($bdd, $_SESSION['id']);
$followers = listFollower($bdd, $id);
$follows = explode(';', $tab_infos['follows']);
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

if ( isset($user_abo['follows']) AND !empty($user_abo['follows']) )
{
	$raw_follow = explode(";", $user_abo['follows']);
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

?>
<div class="container body-complete" style="<?php if(isset($_GET['id'])){
		$infos_perso = getUserInfo($bdd, $_GET['id']);
				$fgcolor = hex2rgb($infos_perso['fgcolor']); 
				echo "background-color:rgba(" . $fgcolor . ",0.3)";
		} ?>">
	<div class="left">
		<div class="bloc wall-menu">
			<ul>
				<li><a href="index.php?page=profil&amp;id=<?php echo $_GET['id']; ?>">Tweets<span class="menu-chev"><i class="icon-chevron-right"></i></span></a></li>
				<li class="active"><a href="index.php?page=following&amp;id=<?php echo $_GET['id']; ?>">Abonnements<span class="menu-chev"><i class="icon-chevron-right"></i></span></a></li>

				<li ><a href="index.php?page=follower&amp;id=<?php echo $_GET['id']; ?>">Abonnés<span class="menu-chev"><i class="icon-chevron-right"></i></span></a></li>
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
		<div class="separ-menu-left"></div>
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
			<h4 class="tweets">Abonnements</h4>
			<ul>
<?php
$id_msg = 1;
if (isset($raw_follow) AND !empty($raw_follow) )
{
	foreach ($raw_follow as $value)
	{
		$follow_abo=getUserInfo($bdd, $value);
?>
				<li>
					<div class="imgtweets">
						<a href="index.php?page=profil&amp;id=<?php echo $follow_abo['id']; ?>">
							<img src="<?php echo getAvatar($value); ?>" alt="avatar">
						</a>
					</div>
					<div class="tweet">
						<b><a href="index.php?page=profil&amp;id=<?php echo $follow_abo['id']; ?>"><?php echo $follow_abo['username']; ?></a></b>
						<span>@<?php echo $follow_abo['username']; ?></span>
						<div class="date-tweet">
<?php

		if(in_array($follow_abo['id'], $myfollows) && $follow_abo['id'] != $_SESSION['id'])
		{
?>
							<form method="POST">
								<input type="hidden" name="id_del" value="<?php echo $value;?>">
								<input type="submit" class="btn btn-danger" name="btn-delabo" value="Se d&eacute;sabonner">
							</form>
<?php
		}
		else if(!in_array($follow_abo['id'], $myfollows) && $follow_abo['id'] != $_SESSION['id'])
		{
?>
							<form method="POST" action="index.php?page=follower&amp;id=<?php echo $_GET['id']; ?>&amp;id_abo=<?php echo $id_msg; ?>">
								<input type="hidden" name="id_add_abo<?php echo $id_msg; ?>" value="<?php echo $follow_abo['id']; ?>">
								<input type="submit" class="btn btn-info" name="btn_add_abo<?php echo $id_msg; ?>" value="Suivre">
							</form>
<?php
		}
		if($follow_abo['id'] != $_SESSION['id']  && $_SESSION['id'] != $id)
		{
?>
			</div>
			<br>
			<p><a href="index.php?page=profil&amp;id=<?php echo $tab_infos['id']; ?>">@<?php echo $tab_infos['username']; ?></a> suit <?php echo $follow_abo['username']; ?><br><br></p>
<?php
		}
		else
		{
			if($_SESSION['id'] == $id)
			{
?>
						</div>
						<br>
						<p>Vous suivez <a href="index.php?page=profil&amp;id=<?php echo $follow_abo['id']; ?>">@<?php echo $follow_abo['username']; ?></a><br><br></p>
<?php
			}
			else if($follow_abo['id'] == $_SESSION['id'])
			{
?>
						</div>
						<br>
						<p><a href="index.php?page=profil&amp;id=<?php echo $tab_infos['id']; ?>">@<?php echo $tab_infos['username']; ?></a> vous suit<br><br></p>
<?php
			}
			else
			{
?>
						</div>
						<br>
						<p><?php echo $tab_infos['username']; ?> suit <a href="index.php?page=profil&amp;id=<?php echo $tab_infos['id']; ?>">@<?php echo $follow_abo['username']; ?></a><br><br></p>
<?php
			}
		}
?>
					</div>
				</li>	
<?php
$id_msg++;
	}
}
else
{
	if($_GET['id'] == $_SESSION['id'])
	{
?>
				<div class="tweet">
					<li id="no_abo"><p>Vous ne suivez personne.</p></li>
				</div>
<?php
	}
	else
	{
?>
				<div class="tweet">
					<li id="no_abo"><p><?php echo $tab_infos['username']; ?> ne suit personne.</p></li>
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