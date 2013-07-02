<?php
$user_abo = getUserInfo($bdd, $_SESSION['id']);

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
				$new_abo = implode(";", $raw_follow);
				delFollows($bdd, $new_abo, $_SESSION['id']);

			}
		}
	}
}




?>
<div class="container body-complete">
	<div class="left">
		<div class="bloc wall-menu">
			<ul>
				<li><a href="">Tweets<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>
				<li><a href="">Abonnements<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>
				<li><a href="">Abonnés<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>
				<li><a href="">Favoris<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>
				<li><a href="">Listes<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>
			</ul>
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
	<div class="right ban-profil">
		<div class="ban-info">
			<img class="avatar-ban" src="img/avatar.png" alt="avatar">
			<div class="text_ban">
				<h1>USERNAME</h1>
				<h2>@htags_user</h2>
				<p>Locacity</p>
			</div>
		</div>
		<div class="ban-nav">
			<ul class="inline link-nav">
				<li><a href=""><p><strong>202</strong>Tweet</p></a></li>
				<li><a href=""><p><strong>202</strong>Abonnement</p></a></li>
				<li><a href=""><p><strong>202</strong>Abonn&eacute;</p></a></li>
			</ul>
			<ul class="inline btn-nav">
				<li><button class="btn"><i class="icon-envelope"></i></button></li>
				<li><button class="btn">Editer le profil</button></li>
			</ul>
		</div>

	</div>
	<div class="right">
		<div class="bloc wall-tweets">
			<h4 class="tweets">Abonnements</h4>
			<ul>

			<?php
			if (isset($raw_follow) )
			{
				foreach ($raw_follow as $value)
				{
					?>
					<li>
						<?php $follow_abo=getUserInfo($bdd, $value); ?>
						<div class="imgtweets">
							<img src="<?php echo getAvatar($value); ?>" alt="avatar">
						</div>
						<div class="tweet">
							<b><?php echo $follow_abo['username']; ?></b>
							<span>@<?php echo $follow_abo['username']; ?></span>
							<span class="date-tweet">
								<form method="POST">
									<input type="hidden" name="id_del" value="<?php echo $value;?>">
									<input type="submit" class="btn btn-danger" name="btn-delabo" value="Se d&eacute;sabonner">
								</form>
							</span>
							<p>Vous suivez <?php echo $follow_abo['username']; ?><br><br></p>
						</div>
					</li>
					<?php
				}
			}
			else
			{
				?>
				<li>
						<div class="tweet">
							<p>Vous ne suivez personne.</p>
						</div>
					</li>
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