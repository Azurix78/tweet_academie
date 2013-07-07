<div class="container body-complete error404" id="body-complete" style="<?php 
		$infos_perso = getUserInfo($bdd, $_SESSION['id']);		
		$fgcolor = hex2rgb($infos_perso['fgcolor']); 
				echo "background-color:rgba(" . $fgcolor . ",0.3)";
		 ?>">
	<img src="img/error404.png" alt="error404" >
	<p>Cette page n'existe pas ou plus !<p>
</div>