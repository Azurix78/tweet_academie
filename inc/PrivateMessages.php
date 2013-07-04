<?php

?>

<div id="mp-new" style="display:block;">
	<div id="ctn-mp">
	</div>
	<div id="contain-mpnew" style="display:block;margin-top:100px">
		<div id="mp-bloc">
			<div class="title-bloc-tweet">
				<b>Messages Privés</b>
				<a href="#" onClick="closeTweet()"><i class="icon-remove"></i></a>
				<a href="#">Nouveau Message</a>
			</div>
			<?php if(isset($_GET['idmsg']))
					{
						require_once("inc/SendMessage.php"); 
					}
					else
					{ 
						require_once("inc/ListMessages.php");
					} ?>
			<div class="astuce">
				<p class="pastuce">Astuce : vous pouvez envoyer un message privé à vos abonnés.</p>
			</div>
		</div>
	</div>
</div>