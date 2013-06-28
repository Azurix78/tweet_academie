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
	$result = mysqli_query($bdd, "SELECT COUNT(*) AS res FROM users WHERE  username = \"$user\" AND $password = \"$password\" ");
	$donnees = mysqli_fetch_assoc($result);
	mysqli_free_result($result);
	return $donnees['res'];
}

?>