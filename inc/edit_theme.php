<?php
var_dump($_FILES);
if(isset($_POST['modifier_theme_user']))
{
		if((uploadImage($bdd, "upload/bgimg", "img", $_SESSION['id'])) == true)
		{
			if(!empty($_FILES['mod_bgimg']['name'])){ $bgimg = "/upload/bgimg/" . $_SESSION['id'] . ".png"; } else { $bgimg = ''; }
			updateThemeInfos($bdd, $_SESSION['id'], $_POST['mod_bgcolor'], $_POST['mod_fgcolor'], $bgimg, $_POST['mod_scrollcolor']);
			 echo "<div class=\"alert alert-success\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                  <strong>Succés :</strong> Le thème a été modifié avec succés.
                  </div>";
		}
}

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
				<form method="POST" class="edit-theme" enctype="multipart/form-data">
					<li>
						<label for="mod_bgcolor">Couleur de fond :</label><input id="mod_bgcolor" type="text" name="mod_bgcolor"  value="<?php if(isset($_POST['mod_bgcolor'])) { echo htmlentities($_POST['mod_bgcolor']);} else { echo $infos_perso['bgcolor'];} ?>">
						<span class="box-theme" style="background-color:<?php if(!empty($infos_perso['bgcolor'])){ echo '#' . $infos_perso['bgcolor'];} else {echo '#60a3d2';} ?>"></span>
						<div class="color-choice">
							<span onClick="colorInput('000000','mod_bgcolor')" class="noir"></span>
							<span onClick="colorInput('BFBFBF','mod_bgcolor')" class="gris"></span>
							<span onClick="colorInput('FFFFFF','mod_bgcolor')" class="blanc"></span>
							<span onClick="colorInput('7004DB','mod_bgcolor')" class="violet"></span>
							<span onClick="colorInput('B240DB','mod_bgcolor')" class="grenat"></span>
							<span onClick="colorInput('FF3BE5','mod_bgcolor')" class="rose"></span>
							<span onClick="colorInput('DB0000','mod_bgcolor')" class="rouge"></span>
							<span onClick="colorInput('FF8000','mod_bgcolor')" class="orange"></span>
							<span onClick="colorInput('824500','mod_bgcolor')" class="marron"></span>
							<span onClick="colorInput('FFEF63','mod_bgcolor')" class="jaune"></span>
							<span onClick="colorInput('50E632','mod_bgcolor')" class="vert-clair"></span>
							<span onClick="colorInput('3EBD68','mod_bgcolor')" class="vert"></span>
							<span onClick="colorInput('009DB5','mod_bgcolor')" class="turquoise"></span>
							<span onClick="colorInput('0FAFFF','mod_bgcolor')" class="bleu-clair"></span>
							<span onClick="colorInput('','mod_bgcolor')" class="transparent"><i class="icon-remove"></i></span>
						</div>
					</li>
					<li><label for="mod_fgcolor">Couleur du recouvrement  :</label><input  id="mod_fgcolor" type="text" name="mod_fgcolor" value="<?php if(isset($_POST['mod_fgcolor'])) { echo htmlentities($_POST['mod_fgcolor']);} else { echo $infos_perso['fgcolor'];} ?>">
						<span class="box-theme" style="background-color:<?php if(isset($infos_perso['fgcolor'])){ echo '#' . $infos_perso['fgcolor'];} else {echo 'transparent';} ?>"></span>
						<div class="color-choice">
							<span onClick="colorInput('000000','mod_fgcolor')" class="noir"></span>
							<span onClick="colorInput('BFBFBF','mod_fgcolor')" class="gris"></span>
							<span onClick="colorInput('FFFFFF','mod_fgcolor')" class="blanc"></span>
							<span onClick="colorInput('7004DB','mod_fgcolor')" class="violet"></span>
							<span onClick="colorInput('B240DB','mod_fgcolor')" class="grenat"></span>
							<span onClick="colorInput('FF3BE5','mod_fgcolor')" class="rose"></span>
							<span onClick="colorInput('DB0000','mod_fgcolor')" class="rouge"></span>
							<span onClick="colorInput('FF8000','mod_fgcolor')" class="orange"></span>
							<span onClick="colorInput('824500','mod_fgcolor')" class="marron"></span>
							<span onClick="colorInput('FFEF63','mod_fgcolor')" class="jaune"></span>
							<span onClick="colorInput('50E632','mod_fgcolor')" class="vert-clair"></span>
							<span onClick="colorInput('3EBD68','mod_fgcolor')" class="vert"></span>
							<span onClick="colorInput('009DB5','mod_fgcolor')" class="turquoise"></span>
							<span onClick="colorInput('0FAFFF','mod_fgcolor')" class="bleu-clair"></span>
							<span onClick="colorInput('','mod_fgcolor')" class="transparent"><i class="icon-remove"></i></span>
						</div>
					</li>
					<li><label for="mod_bgimg">Ajouter une image en arri&egrave;re-plan :</label><input type="file" id="mod_bgimg" name="img"></li>
					<li><label for="mod_scrollcolor">What is that fucking "scrollcolor" ? :</label><input type="text" class="color" id="mod_scrollcolor" name="mod_scrollcolor" value="<?php if(isset($_POST['mod_scrollcolor'])) { echo htmlentities($_POST['mod_scrollcolor']);} else { echo $infos_perso['scrollcolor'];} ?>">
						<span class="box-theme" style="background-color:<?php if(isset($infos_perso['scrollcolor'])){ echo '#' . $infos_perso['scrollcolor'];} else {echo 'transparent';} ?>"></span>
						<div class="color-choice">
							<span onClick="colorInput('000000','mod_scrollcolor')" class="noir"></span>
							<span onClick="colorInput('BFBFBF','mod_scrollcolor')" class="gris"></span>
							<span onClick="colorInput('FFFFFF','mod_scrollcolor')" class="blanc"></span>
							<span onClick="colorInput('7004DB','mod_scrollcolor')" class="violet"></span>
							<span onClick="colorInput('B240DB','mod_scrollcolor')" class="grenat"></span>
							<span onClick="colorInput('FF3BE5','mod_scrollcolor')" class="rose"></span>
							<span onClick="colorInput('DB0000','mod_scrollcolor')" class="rouge"></span>
							<span onClick="colorInput('FF8000','mod_scrollcolor')" class="orange"></span>
							<span onClick="colorInput('824500','mod_scrollcolor')" class="marron"></span>
							<span onClick="colorInput('FFEF63','mod_scrollcolor')" class="jaune"></span>
							<span onClick="colorInput('50E632','mod_scrollcolor')" class="vert-clair"></span>
							<span onClick="colorInput('3EBD68','mod_scrollcolor')" class="vert"></span>
							<span onClick="colorInput('009DB5','mod_scrollcolor')" class="turquoise"></span>
							<span onClick="colorInput('0FAFFF','mod_scrollcolor')" class="bleu-clair"></span>
							<span onClick="colorInput('','mod_scrollcolor')" class="transparent"><i class="icon-remove"></i></span>
						</div>
					</li>
					<li class="button">
						<button type="submit" class="btn btn-info" name="modifier_theme_user">Enregistrer</button>
					</li>
			</ul>
		</div>
		
	</div>
</div>