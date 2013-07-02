<?php

$id = $_GET['id'];
$tab_infos = getUserInfo($bdd, $id);
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
				<li><a href="">Tweets<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>
				<li><a href="index.php?page=following">Abonnements<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>
				<li><a href="index.php?page=follower">Abonnés<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>
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
			<img class="avatar-ban" src="<?php echo getAvatar($id); ?>" alt="avatar">
			<div class="text_ban">
				<h1><?php echo $tab_infos['username']; ?></h1>
				<h2>@<?php echo $tab_infos['username']; ?></h2>
				<p><?php echo $tab_infos['locality']; ?></p>
			</div>
		</div>
		<div class="ban-nav">
			<ul class="inline link-nav">
				<li><a href=""><p><strong><?php echo count(getTweetsPerso($bdd, $id)); ?></strong>Tweet</p></a></li>
				<li><a href=""><p><strong>202</strong>Abonnement</p></a></li>
				<li><a href=""><p><strong><?php echo count($follows); ?></strong>Abonn&eacute;</p></a></li>
			</ul>
			<ul class="inline btn-nav">
				<li><button class="btn"><i class="icon-envelope"></i></button></li>
				<li><button class="btn">Editer le profil</button></li>
			</ul>
		</div>

	</div>


	<div class="right">
		<div class="bloc wall-tweets">
			<h4 class="tweets">Tweets</h4>
			<ul>
<?php

$tab_tweets = getTweetsPerso($bdd, $id);
foreach($tab_tweets AS $value)
{

?>
				<li>
					<div class="imgtweets">
						<a href="index.php?page=profil&amp;id=<?php echo $value['id_user']; ?>">
							<img src="<?php echo getAvatar($id); ?>" alt="avatar">
						</a>
					</div>
					<div class="tweet">
						<b><a href="index.php?page=profil&amp;id=<?php echo $value['id_user']; ?>"><?php echo $value['username']; ?></a></b>
						<span>@<?php echo $value['username']; ?></span>
						<span class="date-tweet"><?php echo date("F j Y", date_timestamp_get(date_create($value['date']))); ?></span>
						<p><?php echo $value['content']; ?></p>
						<a href="#" class="open-tweet">Ouvrir</a>
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