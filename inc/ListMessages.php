<?php
	$msg = getMessages($bdd, $_SESSION['id']);
	$iduser = $_SESSION['id'];
?>
			<div class="contain-mp" id="contain-mp">
				<ul class="list-mp">
					<?php foreach ($msg as $value) {
 ?>
					<li onClick="boutons(<?php echo $value['id_msg']; ?>);">
					<div class="imgtweets">
						<img src="<?php echo getAvatar($value['id_sender']); ?>" alt="avatar">
					</div>
					<div class="tweet">
						<b><?php echo $value['username']; ?></b>
						<span><?php echo $value['username']; ?></span>
						<?php 	$last = getContent($bdd,$value['id_receiver'], $value['id_sender']); ?>
						<span class="date-tweet"><?php echo date("j F y", date_timestamp_get(date_create($last[0]['date_re']))); ?> <a href=""><i class="icon-chevron-right"></i></a></span>
						<p><?php echo $last[0]['content']; ?></p>
					</div>
					</li>
					<?php } ?>
				</ul>
			</div>