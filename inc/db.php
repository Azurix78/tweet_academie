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
		if(crypt($password, $password_hash) == $password_hash)
		{
			$return = true;
		}
	}
	return $return;
}

function getUserInfo($bdd, $user)
{
	$user = mysqli_real_escape_string($bdd, $user);
	$result = mysqli_query($bdd, "SELECT * FROM users WHERE  username = \"$user\" OR email = \"$user\" OR id = \"$user\" ");
	$tab = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$tab[] = $row;
	}
	mysqli_free_result($result);
	return $tab[0];
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
	$password = crypt($password);
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

function getTweetsAll($bdd, $id_user)
{
	$tab_followers = array();
	$string_followers = "";
	$results_followers = mysqli_query($bdd, 'SELECT * FROM users');
	while($followers = mysqli_fetch_assoc($results_followers))
	{
		if(in_array($_SESSION['id'], explode(';', $followers['follows'])))
		{
			array_push($tab_followers, $followers['id']);
		}
	}
	mysqli_free_result($results_followers);
	if(count($tab_followers) > 0)
	{
		$string_followers = implode(" OR id_user=", $tab_followers);
		$string_followers = ' OR id_user='.$string_followers;
	}
	$result = mysqli_query($bdd, 'SELECT t.id, t.id_user, t.content, t.hashtags, t.image, t.date, t.locality, t.id_reply, t.id_retweet, u.username FROM tweets t LEFT JOIN users u ON t.id_user = u.id WHERE id_user='.$id_user.$string_followers.' ORDER BY date DESC');
	$tab = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$tab[] = $row;
	}
	mysqli_free_result($result);
	return $tab;
}

function getTweetsPerso($bdd, $id_user)
{
	$result = mysqli_query($bdd, 'SELECT t.id, t.id_user, t.content, t.hashtags, t.image, t.date, t.locality, t.id_reply, t.id_retweet, u.username FROM tweets t LEFT JOIN users u ON t.id_user = u.id WHERE id_user = "'.$id_user.'" ORDER BY date DESC');
	$tab = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$tab[] = $row;
	}
	mysqli_free_result($result);
	return $tab;
}

function newTweet($bdd, $id_user, $content, $image=NULL, $locality, $id_reply=NULL, $id_retweet=NULL)
{
	$id_user = abs(intval($id_user));
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
		$hashtags = implode(";", $hashtags);
	}
	else
	{
		$hashtags = "";
	}
	$result = mysqli_prepare($bdd, 'INSERT INTO tweets(id_user,content,hashtags,image,date,locality,id_reply,id_retweet) VALUES (?,?,?,?, NOW(),?,?,?)');
	mysqli_stmt_bind_param($result, "issssii", $id_user, $content, $hashtags, $image, $locality, $id_reply, $id_retweet);
	mysqli_stmt_execute($result);
}

?>