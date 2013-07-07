<?php
	if(isset($_GET['idmsg'])){
		$msgId = getMessagesId($bdd, $_SESSION['id'], $_GET['idmsg']);
		$link = preg_replace('#\&idmsg\=(.+)#isU', '', $_SERVER['REQUEST_URI']); 
		$link = str_replace('&', '&amp;', $link);
		$title = "<b ><a id=\"title-a\" href=\"" . $link . "\"> Messages Privés </a> > " . getNameInfo($bdd, $_GET['idmsg']) . "</b>";
	}
	else
	{
		$title = "<b> Messages Privés </b>";
	}
	$linkclose = preg_replace('#\&idmsg\=(.+)#isU', '', $_SERVER['REQUEST_URI']); 
	$linkclose = preg_replace('#\&bloc\=msg#isU', '', $linkclose); 
	$linkclose = str_replace('&', htmlspecialchars('&'), $linkclose);
?>

<div id="mp-new" <?php if(isset($_GET['bloc']) && $_GET['bloc'] == "msg"){ echo "style='display:block'"; } ?>>
	<div id="ctn-mp">
	</div>
	<div id="contain-mpnew" >
		<div id="mp-bloc">
			<div class="title-bloc-tweet">
				<?php echo $title; ?> 
				<a href="<?php echo $linkclose; ?> " ><i class="icon-remove"></i></a>
				<?php if(!isset($_GET['idmsg'])){ ?><ul class="new-mp">
					<li><a href="">Nouveau Message</a>
						<ul class="subnav">
							<?php $listabo = listFollower($bdd, $_SESSION['id']);
							foreach ($listabo as $value)
							{
								echo "<li onClick=\"boutons(" . $value . ")\">" . getNameInfo($bdd, $value) . "</li>";
							} ?>
						</ul>
					<li>
				</ul> <?php } ?>
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