<?php
session_start();
require_once("config.php");
require_once("db.php");
$newtweetCount = count(getTweetsAll($bdd, $_SESSION['id']));
if ( $newtweetCount != $_SESSION['old'] )
{
	$res = $newtweetCount-$_SESSION['old'];
	if ($res == 1)
	{
	?>
		<a class="new-btn" href="index.php"><?php echo $res; ?> nouveau swiff !</a>
	<?php
	}
	if ($res > 1)
	{
		?>
		<a class="new-btn" href="index.php"><?php echo $res; ?> nouveaux swiffs !</a>
		<?php
	}
}

?>