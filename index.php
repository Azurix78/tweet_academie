<?php 

/**
 * [Projet Tweet Academie]
 * @author [rivier_n, rubio_n, christ_a]
 */

require_once("inc/config.php");
require_once("inc/db.php");
require_once("inc/functions.php");
if(!isset($_SESSION['id']))
{
	header('Location:connect.php');
}
require_once("inc/header.php");

anti_repost();

if(isset($_GET['id']))
{
	$test_get_id = mysqli_query($bdd, 'SELECT * FROM users WHERE id='.$_GET['id']);
	if(mysqli_num_rows($test_get_id) != 1)
	{
		header('Location: index.php?page=404');
	}
}

$amp = html_entity_decode('&amp;');

$inc = array();
$included = false;

$folder = opendir("./inc/");
while($file = readdir($folder)) {
	$path = pathinfo($file);
	if($path['extension'] == "php" && $file != "config.php") {
		$inc[] = $path['filename'];
	}
}

foreach($inc as $val) {
	if(!isset($_GET['page']) AND isset($_SESSION['id'])) {
		include_once("inc/wall.php");
		$included = true;
		break;
	}

	if (isset($_SESSION['id']) && isset($_GET['page']) && $_GET['page'] != "index" && $_GET['page'] != "config" && $_GET['page'] != "header" && $_GET['page'] != "footer" && $_GET['page'] != "functions" && $_GET['page'] != "db") {
		if($_GET['page'] == $val) {
			include_once("inc/".$val.".php");
			$included = true;
			break;
		}
	}
}
if(!$included AND isset($_SESSION['id'])) {
	include_once("inc/404.php");
}
require_once("inc/footer.php");
bddclose($bdd);
?>
