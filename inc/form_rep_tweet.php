<?php

require_once("config.php");
require_once("db.php");
require_once("functions.php");

if ( isset($_GET['id']) )
{
	if(isset($_POST['bouton_rep_tweet' . $_GET['id'] ]) AND isset($_POST['rep_tweet' . $_GET['id'] ]) AND isset($_POST['id_ans_tweet' . $_GET['id'] ]) AND isset($_POST['user_rep' . $_GET['id'] ]) )
	{
		if ( strlen($_POST['rep_tweet'. $_GET['id'] ]) <= 140 )
		{
			$user = $_POST['user_rep' . $_GET['id'] ];
			$content = "@". $user . $_POST['rep_tweet' . $_GET['id'] ];
			newTweet($bdd, $_SESSION['id'], "$content", NULL, '', $_POST['id_ans_tweet' . $_GET['id'] ], NULL );
		}
	}
}


header('location:../index.php')
?>