<?php
if ( isset($_GET['id']) )
{
	$sup = getUserInfo($bdd, $_GET['id']);
	if ( $sup['registered'] == "9999-01-01" )
	{
		$user_sup = 1;
	}

	if ( isset($user_sup) )
	{
		header('location:index.php?page=404');
	}
}

if(isset($_POST['bouton']))
{
	if($_FILES['img-tweet']['name'] == "")
	{
		unset($_FILES['img-tweet']);
	}
	$image = NULL;
	if(isset($_FILES['img-tweet']))
	{
		if($_FILES['img-tweet']['error'] == 0)
		{
			if ($_FILES['img-tweet']['size'] <= 6000000)
	        {
				$infosfichier = pathinfo($_FILES['img-tweet']['name']);
				$extension_upload = $infosfichier['extension'];
				$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
		        if (in_array($extension_upload, $extensions_autorisees))
		        {
		        	move_uploaded_file($_FILES['img-tweet']['tmp_name'], 'tweet_image/'.basename($_FILES['img-tweet']['name']));
		        	$image = 'http://'.$_SERVER['HTTP_HOST'].'/tweet_academie/tweet_image/'.basename($_FILES['img-tweet']['name']);
		        	$image = bitly($image, 'sirwinn3r', 'R_a986bc181deda4a7ecabf5b69ac6663e');
		        }
		        else
		        {
?>
					<div class="alert alert-error">
						<strong>Erreur :</strong> Ce type de fichier n'est pas autoris&eacute;
						<button type="button" class="close" data-dismiss="alert">&times;</button>
					</div>
<?php
		        }
		    }
		    else
		    {
?>
				<div class="alert alert-error">
					<strong>Erreur :</strong> Votre fichier d&eacute;passe la taille maximale autoris&eacute;e
					<button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
<?php
		    }
		}
		else
		{
?>
			<div class="alert alert-error">
				<strong>Erreur :</strong> Une erreur s'est produite lors de l'importation de votre fichier
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
<?php
		}
	}
	newTweet($bdd, $_SESSION['id'], $_POST['tweet-area'], $image, $_SESSION['locality'], NULL, NULL);
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Tweet Academie</title>
		<meta name="author" content="rivier_n christ_a rubio_n">
		<meta charset="utf-8" />
		<link rel="icon" type="image/x-icon" href="img/favicon.ico" />
		<link rel="stylesheet" href="css/bootstrap.css" />
		<link rel="stylesheet" href="css/style.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript">// <![CDATA[
			$(document).ready(function() {
				$.ajaxSetup({ cache: false }); // This part addresses an IE bug.  without it, IE will only load the first number and will never refresh
				setInterval(function() {
				$('#compteur_newtweet').load('inc/tweetCount.php');}, 3000); // the "3000" here refers to the time to refresh the div.  it is in milliseconds. 
		});
		// ]]>
		</script>
	</head>
	<body style="<?php 
		if(isset($_GET['id'])){
			$infos_perso = getUserInfo($bdd, $_GET['id']);
		}
		else
		{
			$infos_perso = getUserInfo($bdd, $_SESSION['id']);
		}
		 	if(!empty($infos_perso['bgcolor']))
		 	{
		 		echo "background-color:" . $infos_perso['bgcolor'] . ";";
		 	}
		 	if(!empty($infos_perso['bgimg']))
		 	{
		 		echo "background-image:url(" . $infos_perso['bgimg'] . ");background-repeat:repeat; background-position:center 40px;";
		 	}			

		 ?>"
	>
		<?php require_once('inc/PrivateMessages.php'); ?>
		<div id="tweet-new">
				<div id="ctn-tweet">
				</div>
				<div id="contain-tweetnew">
					<div id="tweet-bloc">
						<div class="title-bloc-tweet">
							<b>Quoi de neuf?</b>
							<a href="#" onClick="closeBloc('tweet-new')"><i class="icon-remove"></i></a>
						</div>
						<form method="POST" enctype="multipart/form-data">
							<textarea  id="tweet-area" name="tweet-area" maxlength="141"  onKeyDown="nbcharTweet('tweet-area','nbcaract', 'max');" onKeyUp="nbcharTweet('tweet-area','nbcaract', 'max');"></textarea>
							<input type="file" name="img-tweet"><span class="btn"><img class="size24" src="img/image-tweet.png" alt=""></span>
							<b style="display:none;" id="max">Nombre de caractères maximum atteint !</b><em id="nbcaract">140</em>
							<input type="submit" class="btn btn-info" name="bouton" value="Tweeter">
						</form>
					</div>
				</div>
			</div>
		<header>
			<div class="container header">
				<div class="nav_left">
					<ul class="inline text_degrade">
						<li><a href="index.php?page=wall"><i class="icon-home icon-white"></i> Accueil</a></li>
						<li><a href="#"><i class="icon-star icon-white"></i> Connecter</a></li>
						<li><a href="index.php?page=discover"><i class="icon-eye-open icon-white"></i> D&eacute;couvrir</a></li>
						<li><a href="index.php?page=profil&amp;id=<?php echo $_SESSION['id']; ?>"><i class="icon-user icon-white"></i> Moi</a></li>
					</ul>
				</div>
				<div class="separation-header">
					<img class="img-logo-header" src="img/logo-header.png" alt="logo-header">
				</div>

				<div class="nav_right">
					<ul class="inline nav_right-recherche">
							<li>
								<form method="GET" action="index.php">
									<div class="input-append">
										<input class="span2" id="appendedInputButton" name="q" placeholder="Recherche..." type="text">
										<button type="submit" class="btn" id="recherche"><i class="icon-search"></i></button>
										<input type="hidden" name="page" value="recherche">
									</div>
								</form>
							</li>
							<li class="divider-vertical">&nbsp;</li>
							<li>
								<div class="btn-group config">
									<a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i><span class="caret"></span></a>
										<ul class="dropdown-menu pull-right">
							   				<li>
							   					<div class="pic-bulle"></div>
							   					<a class="link_sub" href="index.php?page=edit_user">
							   						<div class="profil_ul">
							   							<img class="sub_avatar" src="<?php echo getAvatar($_SESSION['id']); ?>" alt="sub_avatar">
							   							<p class="text-ulprofil"><b class="sub_user"><?php $sub_username = getUserInfo($bdd, $_SESSION['id']); echo $sub_username['username']; ?></b>
							   							<span class="sub_edit">Editer le profil</span></p>
							   						</div>
							   					</a>
							   				</li>
							   				<li class="divider"></li>
							   				<li><a href="index.php?page=following&amp;id=<?php echo $_SESSION['id']; ?>">Mes abonnements</a></li>
							   				<li><a href="index.php?page=follower&amp;id=<?php echo $_SESSION['id']; ?>">Mes abonnés</a></li>
							   				<li><a href="<?php echo str_replace('&', '&amp;',$_SERVER['REQUEST_URI']) . "&amp;bloc=msg"; ?>">Messages privés</a></li>
							   				<li class="divider"></li>
							   				<li><a href="inc/logout.php">Deconnexion</a></li>
							  			</ul>
								</div>
							</li>
							<li><button onClick="displayBloc('tweet-new');" class="btn btn-info write-tweet"><img src="img/pencil.png" class="size24" alt=""></button></li>
					</ul>
					

			</div>
		</div>

		</header>