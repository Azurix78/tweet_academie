<?php
/**
 * [Projet Tweet Academie]
 * @author [rivier_n, rubio_n, christ_a]
 */

require_once("inc/config.php");
require_once("inc/db.php");
require_once("inc/functions.php");
require_once("inc/header.php");

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
	if(!isset($_GET['page'])) {
		include_once("inc/wall.php");
		$included = true;
		break;
	}
	if (isset($_GET['page']) && $_GET['page'] != "index" && $_GET['page'] != "config" && $_GET['page'] != "header" && $_GET['page'] != "footer" && $_GET['page'] != "functions" && $_GET['page'] != "db") {
		if($_GET['page'] == $val) {
			include_once("inc/".$val.".php");
			$included = true;
			break;
		}
	}
}
if(!$included) {
	include_once("inc/404.php");
}

require_once("inc/footer.php");
bddclose($bdd);
?>
