<?php
/**
* [Gestion de la SQL, seulement des fonctions ici]
*/

// Connexion à la base

if($bdd = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db)) {
}
else {
	echo "Impossible de se connecter a la base de donnees";
	exit;

}
if (!mysqli_set_charset($bdd, "utf8")) {
    printf("Erreur lors du chargement du jeu de caractères utf8 : %s\n", mysqli_error($bdd));
    exit;
}

function bddclose($bdd) {
	mysqli_close($bdd);
	return;
}

//	RICKY

function delFollows($bdd, $new_follow, $id_user)
{
	$id_user= intval($id_user);

		$req = mysqli_prepare($bdd, 'UPDATE users SET follows = ? WHERE id = ?');
		mysqli_stmt_bind_param($req, "si", $new_follow, $id_user);
		mysqli_stmt_execute($req);
}

function getTweet($bdd, $id)
{
	$result = mysqli_query($bdd, 'SELECT t.id, t.id_user, t.content, t.hashtags, t.image, t.date, t.locality, t.id_reply, t.id_retweet, u.username FROM tweets t LEFT JOIN users u ON t.id_user = u.id WHERE t.id='.$id);
	$tab = array();
	if($result != false)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$tab[] = $row;
		}
		mysqli_free_result($result);
	}
	return $tab[0];
}

function search_select($bdd, $table, $champ, $recherche)
{
	$result = mysqli_query($bdd, "SELECT t.id, t.id_user, t.content, t.hashtags, t.image, t.date, t.locality, t.id_reply, t.id_retweet, u.username FROM tweets t LEFT JOIN users u ON t.id_user = u.id WHERE t.hashtags LIKE '%$recherche%' ORDER BY date DESC");
		$tab=array();
		while($result_fetch = mysqli_fetch_assoc($result))
		{
			$tab[] = $result_fetch;
		}
	return $tab;
}

function getUsers($bdd)
{
	$result = mysqli_query($bdd, "SELECT * FROM users ORDER BY username DESC ");
		$tab=array();
		while($result_fetch = mysqli_fetch_assoc($result))
		{
			$tab[] = $result_fetch;
		}
	return $tab;
}

function addAbo($bdd, $id_add_abo)
{
	$id_add_abo = abs(intval($id_add_abo));
	$test_result = mysqli_query($bdd, 'SELECT * FROM users WHERE id="'.$id_add_abo.'"');
	if(mysqli_num_rows($test_result) > 0 && mysqli_num_rows($test_result) != null && $test_result != false)
	{
		$results_abos = mysqli_query($bdd, 'SELECT follows FROM users WHERE id='.$_SESSION['id']);
		if($results_abos != false)
		{
			while($abos = mysqli_fetch_assoc($results_abos))
			{
				if($abos['follows'] != "")
					$liste_abos = explode(";", $abos['follows']);
				else
					$liste_abos = array();
				if(in_array($id_add_abo, $liste_abos))
				{
?>
					<div class="alert alert-error">
						<strong>Erreur :</strong> Vous &ecirc;tes d&eacute;j&agrave; abonn&eacute; &agrave;  <?php $alert_msg=getUserInfo($bdd, $id_add_abo);echo $alert_msg['username'];?>.
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
					</div>
<?php
					break;
				}
				array_push($liste_abos, $id_add_abo);
				$new_liste_abos = implode(";", $liste_abos);
				$update_abos = mysqli_query($bdd, 'UPDATE users SET follows="'.$new_liste_abos.'" WHERE id='.$_SESSION['id']);
				if($update_abos == true)
				{
?>
					<div class="alert alert-success">
						<strong>Succ&egrave;s :</strong> Vous &ecirc;tes abonn&eacute; &agrave; <?php $alert_msg=getUserInfo($bdd, $id_add_abo);echo $alert_msg['username'];?>.
	  					<button type="button" class="close" data-dismiss="alert">&times;</button>
					</div>
<?php
				}
				else
				{
?>
					<div class="alert alert-error">
						<strong>Erreur :</strong> Don't fuck with Swiffer !
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
					</div>
<?php
				}
			}
		}
		else
		{
?>
			<div class="alert alert-error">
				<strong>Erreur :</strong> Don't fuck with Swiffer !
					<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
<?php
		}
	}
	else
	{
?>
		<div class="alert alert-error">
			<strong>Erreur :</strong> Don't fuck with Swiffer !
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
<?php
	}
}

// Nico 

function CheckLogin($bdd, $user, $password)
{
	$return = false;
	$user = mysqli_real_escape_string($bdd, $user);
	$password = mysqli_real_escape_string($bdd, $password);
	$result = mysqli_query($bdd, "SELECT * FROM users WHERE ( username = \"$user\" OR email = \"$user\" )");
	if(mysqli_num_rows($result) == 1)
	{
		while($result_fetch = mysqli_fetch_assoc($result))
		{
			$password_hash = $result_fetch['password'];
		}
		if(hash("ripemd160", $password."si tu aime la wac leve les bras") == $password_hash)
		{
			setcookie('id', $result_fetch['id'], time()+(60*60*24*30));
			setcookie('username', $result_fetch['username'], time()+(60*60*24*30));
			setcookie('email', $result_fetch['email'], time()+(60*60*24*30));
			setcookie('password', $result_fetch['password'], time()+(60*60*24*30));

			$return = true;
		}
	}
	return $return;
}

function getUserInfo($bdd, $user)
{
	$user = mysqli_real_escape_string($bdd, $user);

	$result = mysqli_query($bdd, "SELECT * FROM users WHERE username = \"$user\" OR email = \"$user\" OR id = \"$user\" ");
	$tab = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$tab[] = $row;
	}
	mysqli_free_result($result);
	return $tab[0];
}

function listFollower($bdd, $id)
{
	$tab = array();
	$result = mysqli_query($bdd, 'SELECT id, follows FROM users WHERE id!='.$id);
	while($row = mysqli_fetch_assoc($result))
	{
		if(in_array($id, explode(";", $row['follows'])))
		{
			array_push($tab, $row['id']);
		}
	}
	return $tab;
}

function countElement($bdd, $table, $search, $searchname)
{
	$table = mysqli_real_escape_string($bdd, $table);
	$searchname = mysqli_real_escape_string($bdd, $searchname);
	$search = mysqli_real_escape_string($bdd, $search);
	$result = mysqli_query($bdd, "SELECT COUNT(*) FROM $table WHERE $search = \"$searchname\"");
	$row = mysqli_fetch_array($result, MYSQL_NUM);

	mysqli_free_result($result);
	return $row[0];
}

function Inscription($bdd, $fullname, $email, $password)
{
	$fullname = mysqli_real_escape_string($bdd, $fullname);
	$email = mysqli_real_escape_string($bdd, $email);
	$password = mysqli_real_escape_string($bdd, $password);
	$password = hash("ripemd160", $password."si tu aime la wac leve les bras");
	$result = mysqli_prepare($bdd, "INSERT INTO users(username,email,password,registered) VALUES (?,?,?, NOW())");
	mysqli_stmt_bind_param($result, "sss", $fullname, $email, $password);
	mysqli_stmt_execute($result);
	$id_result = mysqli_query($bdd, 'SELECT id FROM users WHERE email = "'.$email.'"');
	while($id = mysqli_fetch_assoc($id_result))
	{
		$id_return = $id['id'];
	}
	mysqli_free_result($id_result);
	return $id_return;
}

function getMessages($bdd, $id)
{
	$result = mysqli_query($bdd, "SELECT id_sender, id_receiver, users.username AS username, messages.id AS id_msg FROM messages LEFT JOIN users ON messages.id_sender = users.id  WHERE id_receiver = $id GROUP BY id_sender ORDER BY date DESC");
	$tab = array();
	if($result != false)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$tab[] = $row;
		}
		mysqli_free_result($result);
	}
	return $tab;
}

function getContent($bdd, $id_receiver, $id_sender)
{
	$result = mysqli_query($bdd, "SELECT id_parent,content, date as date_re FROM messages WHERE id_receiver  AND id_sender in ($id_receiver, $id_sender) ORDER BY id_parent DESC");
	$tab = array();
	if($result != false)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$tab[] = $row;
		}
		mysqli_free_result($result);
	}
	return $tab;
}

function getMessagesId($bdd, $id_receiver, $id_sender)
{
	$result = mysqli_query($bdd, "SELECT date, content,id_sender, id_receiver, users.username AS username, messages.id AS id_msg FROM messages LEFT JOIN users ON messages.id_sender = users.id  WHERE id_receiver  AND id_sender in ($id_receiver, $id_sender)");
	$tab = array();
	if($result != false)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$tab[] = $row;
		}
		mysqli_free_result($result);
	}
	return $tab;
}

// AMBROISE

function checkCookies()
{
	if(isset($_COOKIE['id']) && !empty($_COOKIE['id']) && isset($_COOKIE['username']) && !empty($_COOKIE['username']) && isset($_COOKIE['email']) && !empty($_COOKIE['email']) && isset($_COOKIE['password']) && !empty($_COOKIE['password']))
	{
		CheckLogin($bdd, $_COOKIE['email'], $_COOKIE['password']);
	}
}

function getTweetsAll($bdd, $id_user)
{
	$tab_followers = array();
	$string_followers = "";
	$results_followers = mysqli_query($bdd, 'SELECT follows FROM users WHERE id='.$id_user);
	while($followers = mysqli_fetch_assoc($results_followers))
	{
		$tab_followers = explode(";", $followers['follows']);
		if(count($tab_followers) == 1 && $tab_followers[0] == "")
		{
			$tab_followers = array();
		}
	}
	mysqli_free_result($results_followers);
	if(count($tab_followers) > 0)
	{
		$string_followers = implode(" OR t.id_user=", $tab_followers);
		$string_followers = ' OR t.id_user='.$string_followers;
	}
	$result = mysqli_query($bdd, 'SELECT t.id, t.id_user, t.content, t.hashtags, t.image, t.date, t.locality, t.id_reply, t.id_retweet, u.username FROM tweets t LEFT JOIN users u ON t.id_user = u.id WHERE t.id_user='.$id_user.$string_followers.' ORDER BY date DESC');
	$tab = array();
	if($result != false)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$tab[] = $row;
		}
		mysqli_free_result($result);
	}
	return $tab;
}

function getTweetsPerso($bdd, $id_user)
{
	$result = mysqli_query($bdd, 'SELECT t.id, t.id_user, t.content, t.hashtags, t.image, t.date, t.locality, t.id_reply, t.id_retweet, u.username FROM tweets t LEFT JOIN users u ON t.id_user = u.id WHERE t.id_user = "'.$id_user.'" ORDER BY date DESC');
	$tab = array();
	if($result != false)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$tab[] = $row;
		}
		mysqli_free_result($result);
	}
	return $tab;
}

function newTweet($bdd, $id_user, $content, $image=NULL, $locality, $id_reply=NULL, $id_retweet=NULL)
{
	$id_user = abs(intval($id_user));

	if(strlen($content) > 140)
	{
		return false;
	}
	$content = htmlentities($content);
	$content = mysqli_real_escape_string($bdd, $content);
	if ( isset($image) ) 
		$image = mysqli_real_escape_string($bdd, $image);
	if ( isset($locality) )
		$locality = mysqli_real_escape_string($bdd, $locality);
	if ( isset($id_reply) )
		$id_reply = abs(intval($id_reply));
	if ( isset($id_retweet) )
		$id_retweet = abs(intval($id_retweet));
	if ( $hashtags = preg_grep("%^#.+%", explode(" ", $content)) )
	{
		$hashtags = implode("", $hashtags);
	}
	else
	{
		$hashtags = "";
	}
	$result = mysqli_prepare($bdd, 'INSERT INTO tweets(id_user,content,hashtags,image,date,locality,id_reply,id_retweet) VALUES (?,?,?,?, NOW(),?,?,?)');
	mysqli_stmt_bind_param($result, "issssii", $id_user, $content, $hashtags, $image, $locality, $id_reply, $id_retweet);
	mysqli_stmt_execute($result);

	return true;
}

?>