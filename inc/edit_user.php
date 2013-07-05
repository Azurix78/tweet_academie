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
			<h4 class="tweets">Choisissez vos param&egrave;tres</h4>
			<ul>
				<form>
					<li><label>Nom d'utilisateur :</label><input type="text" name="mod_username" value="<?php echo $infos_perso['username'];?>"></li>
					<li><label>Email :</label><input type="text" name="mod_mail" value="<?php echo $infos_perso['email'];?>"></li>
					<li><label>Location :</label><input type="text" name="mod_locality" value="<?php if( isset($infos_perso['locality']) )echo $infos_perso['locality'];?>"></li>
					<li><label>Mot de passe :</label><input type="text" name="mod_mdp" value=""></li>
					<li><label>Couleur de fond :</label><input name="mod_bgcolor" class="color" value="60a3d2"></li>
					<li><label>Couleur du recouvrement  :</label><input class="color" name="mod_fgcolor" value="FFF"></li>
					<li><label>Ajouter une image en arri&egrave;re-plan :</label><input type="file" name="mod_bgimg"></li>
					<li><label>What is that fucking "scrollcolor" ? :</label><input name="mod_scrollcolor" class="color" value="FF61A5"></li>
					<li>
		 				<button type="submit" class="btn btn-primary">Enregistrer</button>
		  				<button type="button" class="btn">Annuler</button>
		  			</li>
				</form>


			</ul>
		</div>
		
	</div>
</div>