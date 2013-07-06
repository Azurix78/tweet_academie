<?php
$infos_perso = getUserInfo($bdd, $_SESSION['id']);

if(isset($_POST['modifier_pass_user']) && isset($_POST['mod_old_pass']) && isset($_POST['mod_new_pass1']) && isset($_POST['mod_new_pass2']))
{
	if(!empty($_POST['mod_old_pass']))
	{
		if(!empty($_POST['mod_new_pass1']) && !empty($_POST['mod_new_pass2']))
		{
			updateUserPassword($bdd, $_SESSION['id'], $_POST['mod_old_pass'], $_POST['mod_new_pass1'], $_POST['mod_new_pass2']);
		}
		else
		{
?>
			<div class="alert alert-error">
				<strong>Erreur :</strong> Vous devez choisir un nouveau mot de passe et le confirmer
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
<?php
		}
	}
	else
	{
?>
		<div class="alert alert-error">
			<strong>Erreur :</strong> Veuillez entrer votre mot de passe actuel
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
<?php
	}
}
?>
<div class="container body-complete" style="<?php 
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
			<h4 class="tweets">Modifiez votre mot de passe</h4>
			<ul>
				<form method="POST">
					<li><label for="mod_old_pass">Mot de passe actuel :</label><input type="password" id="mod_old_pass" name="mod_old_pass"></li>
					<li><label for="mod_new_pass1">Choisissez un nouveau mot de passe :</label><input type="password" id="mod_new_pass1" name="mod_new_pass1"></li>
					<li><label for="mod_new_pass2">Retapez le nouveau mot de passe :</label><input type="password" id="mod_new_pass2" name="mod_new_pass2"></li>
					<li id="button">
		 				<button type="submit" class="btn btn-info" name="modifier_pass_user">Enregistrer</button>
		  			</li>
				</form>


			</ul>
		</div>
		
	</div>
</div>