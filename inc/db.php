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

// Nico 

function CheckLogin($bdd, $user, $password)
{
	$user = mysqli_real_escape_string($bdd, $user);
	$password = mysqli_real_escape_string($bdd, $password);
	$result = mysqli_query($bdd, "SELECT COUNT(*) FROM users WHERE  ( username = \"$user\" OR email = \"$user\" ) AND password = \"$password\" ");
	$row = mysqli_fetch_array($result, MYSQL_NUM);
	mysqli_free_result($result);
	return $row[0];
}

function getUserInfo($bdd, $user)
{
	$user = mysqli_real_escape_string($bdd, $user);
	$result = mysqli_query($bdd, "SELECT * FROM users WHERE  username = \"$user\" OR email = \"$user\"  ");
	$tab = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$tab[] = $row;
	}
	mysqli_free_result($result);
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
	$result = mysqli_prepare($bdd, "INSERT INTO users(username,email,password,registered) VALUES (?,?,?, NOW())");
	mysqli_stmt_bind_param($result, "sss", $fullname, $email, $password);
	mysqli_stmt_execute($result);
}

?>