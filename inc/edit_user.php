<?php
$infos_perso = getUserInfo($bdd, $_SESSION['id']);

if(isset($_POST['modifier_infos_user']))
{
	if((uploadImage($bdd, "upload/img/", "avatar", $_SESSION['id'])) == true)
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
		<div class="bloc wall-tweets edit-user">
			<h4 class="tweets">Choisissez vos param&egrave;tres</h4>
			<form method="POST" enctype="multipart/form-data">
			<ul>				
					<li><label for="mod_username">Nom d'utilisateur :</label><input type="text" name="mod_username" id="mod_username" value="<?php echo $infos_perso['username'];?>"></li>
					<li><label for="mod_mail">Email :</label><input type="text" name="mod_mail" id="mod_mail" value="<?php echo $infos_perso['email'];?>"></li>
					<li><label for="mod_locality">Location :</label><input type="text" name="mod_locality" id="mod_locality" value="<?php if( isset($infos_perso['locality']) )echo $infos_perso['locality'];?>"></li>
					<li><label for="avatar">Ajouter un avatar :</label><input type="file" id="avatar" name="avatar"></li>
					<li id="button">
		 				<button type="submit" class="btn btn-info" name="modifier_infos_user">Enregistrer</button>
		  			</li>
			</ul>
			</form>
		</div>
		
	</div>
</div>