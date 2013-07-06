<?php
	
?>

<div id="mp-new">
	<div id="ctn-mp">
	</div>
	<div id="contain-mpnew" >
		<div id="mp-bloc">
			<div class="title-bloc-tweet">
				<b>Messages Privés</b>
				<a href="#" ><i class="icon-remove"></i></a>
				<a href="#">Nouveau Message</a>
			</div>
			<?php if(isset($_GET['idmsg']))
					{
						require_once("inc/SendMessage.php"); 
						$idmsg = $_GET['idmsg'];
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