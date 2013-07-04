<?php

require_once("config.php");
require_once("db.php");
require_once("functions.php");

if ( isset($_GET['id']) )
{
	if(isset($_POST['bouton_rep_tweet' . $_GET['id'] ]) AND isset($_POST['rep_tweet' . $_GET['id'] ]) AND isset($_POST['id_ans_tweet' . $_GET['id'] ]) AND isset($_POST['user_rep' . $_GET['id'] ]) )
	{
		if ( strlen($_POST['rep_tweet'. $_GET['id'] ]) <= 140 AND strlen($_POST['rep_tweet'. $_GET['id'] ]) > 0 AND isset($_POST['user_rep' . $_GET['id'] ]) )
		{
			$user = htmlentities( $_POST['user_rep' . abs(intval($_GET['id'])) ] );
			$content = "@". $user . " " . $_POST['rep_tweet' . abs(intval($_GET['id'])) ];
			newTweet($bdd, $_SESSION['id'], "$content", NULL, '', abs(intval($_POST['id_ans_tweet' . $_GET['id'] ])), NULL );
		}
		else
		{
			$_SESSION['error_content'] = 1;
		}
	}
}


header('location:../index.php')
?>