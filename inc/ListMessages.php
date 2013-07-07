<?php
	$msg = getMessages($bdd, $_SESSION['id']);
	$iduser = $_SESSION['id'];
?>
			<div class="contain-mp" id="contain-mp">
				<ul class="list-mp">
					<?php
					$test = ';';
					 foreach ($msg as $value) {
					 	if($_SESSION['id'] != $value['id_sender']){ $iduser = $value['id_sender'];} else { $iduser = $value['id_receiver']; }
 						if(!preg_match("/;" . $iduser . ";/", $test)){?>
					<li onClick="boutons(<?php echo $iduser; ?>);">
					<div class="imgtweets">
						<img src="<?php echo getAvatar($iduser); ?>" alt="avatar">
					</div>
					<div class="tweet">
						<b><?php echo getNameInfo($bdd, $iduser) ?></b>
						<span><?php echo getNameInfo($bdd, $iduser) ?></span>
						<span class="date-tweet"><?php echo date("j F y", date_timestamp_get(date_create($value['date']))); ?> <a href=""><i class="icon-chevron-right"></i></a></span>
						<p><?php echo checkTags($bdd, html_entity_decode($value['content']), $value['id_sender']); ?></p>
					</div>
					</li>
					<?php $test = $test . $iduser . ";";
					} }
					if($test == ";"){ echo "<p class='empty'>Aucune conversation</p>";} ?>
				</ul>
			</div>