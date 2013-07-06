<?php
$infos_perso = getUserInfo($bdd, $_SESSION['id']);

if(isset($_POST['modifier_infos_user']) && isset($_POST['mod_username']) && isset($_POST['mod_mail']) && isset($_POST['mod_locality']))
{
	if(!empty($_POST['mod_mail']))
	{
		if(!empty($_POST['mod_username']))
		{
			updateUserInfos($bdd, $_SESSION['id'], $_POST['mod_username'], $_POST['mod_mail'], $_POST['mod_locality']);
		}
		else
		{
?>
			<div class="alert alert-error">
				<strong>Erreur :</strong> Vous devez pr&eacute;ciser une adresse e-mail
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
<?php
		}
	}
	else
	{
?>
		<div class="alert alert-error">
			<strong>Erreur :</strong> Vous devez pr&eacute;ciser un nom d'utilisateur
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
<?php
	}
}
?>
<div class="container body-complete">
	<div class="left">
		<div class="bloc wall-menu">
			<ul>
				<li><a href="index.php?page=edit_user">Infos du compte<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>
				<li><a href="index.php?page=edit_password">Mot de passe<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>
				<li><a href="index.php?page=edit_theme">Th&egrave;me<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>
				<li><a href="index.php?page=edit_sup">Supprimer son compte<span class="menu-chev"><i class="icon-arrow-right"></i></span></a></li>
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
				<form method="POST">
					<li><label for="mod_username">Nom d'utilisateur :</label><input type="text" name="mod_username" value="<?php echo $infos_perso['username'];?>"></li>
					<li><label for="mod_mail">Email :</label><input type="text" name="mod_mail" value="<?php echo $infos_perso['email'];?>"></li>
					<li><label for="mod_locality">Location :</label><input type="text" name="mod_locality" value="<?php if( isset($infos_perso['locality']) )echo $infos_perso['locality'];?>"></li>
					<li>
		 				<button type="submit" class="btn btn-primary" name="modifier_infos_user">Enregistrer</button>
		  				<button type="button" class="btn">Annuler</button>
		  			</li>
				</form>


			</ul>
		</div>
		
	</div>
</div>