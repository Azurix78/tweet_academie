<?php

?>
<div class="container body-complete" id="body-complete" style="<?php 
		$infos_perso = getUserInfo($bdd, $_SESSION['id']);		
		$fgcolor = hex2rgb($infos_perso['fgcolor']); 
				echo "background-color:rgba(" . $fgcolor . ",0.3)";
		 ?>">
	<div class="left">
		<div class="bloc wall-menu">
			<ul>
				<li><a href="index.php?page=profil&amp;id=<?php echo $_SESSION['id']; ?>">Tweets<span class="menu-chev"><i class="icon-chevron-right"></i></span></a></li>
				<li><a href="index.php?page=following&amp;id=<?php echo $_SESSION['id']; ?>">Abonnements<span class="menu-chev"><i class="icon-chevron-right"></i></span></a></li>
				<li><a href="index.php?page=follower&amp;id=<?php echo $_SESSION['id']; ?>">Abonnés<span class="menu-chev"><i class="icon-chevron-right"></i></span></a></li>
			</ul>
		</div>
		<div class="bloc wall-menu" id="msg_priv">
			<ul>
				<li><a href="index.php?page=edit_user">Modifier mon compte<span class="menu-chev"><i class="icon-chevron-right"></i></span></a></li>
				<li><a href="index.php?page=edit_password">Modifier mot de passe<span class="menu-chev"><i class="icon-chevron-right"></i></span></a></li>
				<li><a href="index.php?page=edit_theme">Modifier mon th&egrave;me<span class="menu-chev"><i class="icon-chevron-right"></i></span></a></li>
				<li><a href="index.php?page=edit_sup">Supprimer mon compte<span class="menu-chev"><i class="icon-chevron-right"></i></span></a></li>
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
			<h4 class="tweets">Suppression du compte</h4>
			<form method="POST" action="connect.php">
			<ul>
					<li>
						<label for="sup_ok">Voulez-supprimer votre compte définitivement ?</label>
						<button type="submit" id="sup_ok" class="btn btn-info" name="sup_ok">Oui</button>
						<a href="index.php?page=edit_user" class="btn btn-danger" name="modifier_pass_user">Non</a>
					</li>
			</ul>
			</form>
		</div>
		
	</div>
</div>