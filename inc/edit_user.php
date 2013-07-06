<?php
$infos_perso = getUserInfo($bdd, $_SESSION['id']);
?>
<div class="container body-complete">
	<div class="left">
		<div class="bloc wall-menu">
			<ul>
				<li><a href="index.php?page=profil&amp;id=<?php echo $_SESSION['id']; ?>">Tweets<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>
				<li><a href="index.php?page=following&amp;id=<?php echo $_SESSION['id']; ?>">Abonnements<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>

				<li><a href="index.php?page=follower&amp;id=<?php echo $_SESSION['id']; ?>">Abonnés<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>
			</ul>
		</div>
		<div class="bloc wall-menu" id="msg_priv">
			<ul>
				<li><a href="index.php?page=edit_user">Modifier mon compte<span class="menu-chev"><i class="icon-chevron-right"></i></span></a></li>
				<li><a href="index.php?page=edit_password">Modifier mot de passe<span class="menu-chev"><i class="icon-chevron-right"></i></span></a></li>
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
		<div class="bloc wall-tweets edit-user">
			<h4 class="tweets">Choisissez vos param&egrave;tres</h4>
			<ul>
				<form method="POST" >
					<li><label for="mod_username">Nom d'utilisateur :</label><input type="text" id="mod_username" name="mod_username" value="<?php echo $infos_perso['username'];?>"></li>
					<li><label for="mod_mail">Email :</label><input type="text" id="mod_mail" name="mod_mail" value="<?php echo $infos_perso['email'];?>"></li>
					<li><label for="mod_locality">Location :</label><input type="text" id="mod_locality" name="mod_locality" value="<?php if( isset($infos_perso['locality']) )echo $infos_perso['locality'];?>"></li>
					<li><label for="mod_mdp">Mot de passe :</label><input type="text" id="mod_mdp" name="mod_mdp" value=""></li>
					<li><label for="mod_bgcolor">Couleur de fond :</label><input id="mod_bgcolor" name="mod_bgcolor" class="color" value="60a3d2"></li>
					<li><label for="mod_fgcolor">Couleur du recouvrement  :</label><input class="color" id="mod_fgoclor" name="mod_fgcolor" value="FFF"></li>
					<li><label for="mod_bgimg">Ajouter une image en arri&egrave;re-plan :</label><input type="file" id="mod_bgimg" name="mod_bgimg"></li>
					<li><label for="mod_scrollcolor">What is that fucking "scrollcolor" ? :</label><input id="mod_scrollcolor" name="mod_scrollcolor" class="color" value="FF61A5"></li>
					<li>
		 				<button type="submit" class="btn btn-primary">Enregistrer</button>
		  				<button type="button" class="btn">Annuler</button>
		  			</li>
				</form>


			</ul>
		</div>
		
	</div>
</div>