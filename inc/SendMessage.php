<?php
	$msgId = getMessagesId($bdd, $_SESSION['id'], $_GET['idmsg']);
	if(isset($_POST['bouton-msg']))
	{
		if(!empty($_POST['msg-content']))
		{
			if(strlen($_POST['msg-content']) <= 140)
			{
				if(in_array($_GET['idmsg'],listFollower($bdd, $_SESSION['id'])))
				{
					$content = htmlentities($_POST['msg-content']);
					$maxparent = checkMaxMessages($bdd, $_GET['idmsg'], $_SESSION['id']);
					if(empty($maxparent)) { $maxparent = NULL; }
					SendMessage($bdd, $maxparent, $_SESSION['id'], $_GET['idmsg'],$content);
				}
				else
				{
					$error_msg = "Cette personne n'est pas abonné à vous";
				}
			}
			else
			{
				$error_msg = "Le message est trop long ! (max : 140)";
			}
		}
		else
		{
			$error_msg = "Votre message est vide !";
		}
	}

	$msgId = getMessagesId($bdd, $_SESSION['id'], $_GET['idmsg']);
?>

<div class="contain-msgp" >
	<?php if(isset($error_msg)) { echo "<div class='alert alert-error error-msg'>
					<i class='icon-warning-sign'></i>
					<strong>Error :</strong> " . $error_msg . "
  					<button type='button' class='close' data-dismiss='alert'>&times;</button>
				</div>"; }?>
	<div class="list-msg" id="list-msg">
		<?php foreach($msgId as $value) { ?>
			<div class="ctn-msg <?php if($value['id_sender'] == $_SESSION['id']){ echo "ctn-msg-right";} ?>">
				<div class="ctn-msg-date"><?php echo date("j F y", date_timestamp_get(date_create($value['date']))); ?></div>
				<img src="<?php echo getAvatar($value['id_sender'])?>" alt="">
				<p><?php echo checkTags($bdd, html_entity_decode($value['content']), $value['id_sender']); ?></p>
			</div>

				<?php } ?>
	</div>
	<form method="post" class="astuce form-msg">
		<textarea  name="msg-content" id="msg-content"  maxlength="141" onKeyDown="nbcharTweet('msg-content','nb-caract', 'max-caract');" onKeyUp="nbcharTweet('msg-content','nb-caract', 'max-caract');" placeholder="Ecrire un message"></textarea>
		<b style="display:none;" id="max-caract">Nombre de caractères maximum atteint !</b><em id="nb-caract">140</em>
		<input type="submit" name="bouton-msg" value="Envoyer" class="btn btn-info">
	</form>
</div>
<script type="text/javascript">
	document.getElementById('list-msg').scrollTop = document.getElementById('list-msg').scrollHeight;
</script>