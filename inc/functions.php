<?php
/* Fonctions diverses */

session_start();


function nl2br2($string)
{ 
    $string = str_replace(array("\\r\\n", "\\r", "\\n"), "<br>", $string); 
    return $string;
} 

function anti_repost()
{
    if(!empty($_POST) OR !empty($_FILES))
    {
        $_SESSION['sauvegarde'] = $_POST;
        $_SESSION['sauvegardeFILES'] = $_FILES;
         
        $fichierActuel = $_SERVER['PHP_SELF'];
        if(!empty($_SERVER['QUERY_STRING']))
        {
            $fichierActuel .= '?' . $_SERVER['QUERY_STRING'];
        }
         
        header('Location: ' . $fichierActuel);
        exit;
    }

    if(isset($_SESSION['sauvegarde']))
    {
        $_POST = $_SESSION['sauvegarde'];
        $_FILES = $_SESSION['sauvegardeFILES'];

        unset($_SESSION['sauvegarde'], $_SESSION['sauvegardeFILES']);
    }
}

function getAvatar($id)
{
	if(file_exists('upload/img/'.$id.'.png'))
	{
		return 'upload/img/'.$id.'.png';
	}
	else
	{
		return 'upload/img/defaut.png';
	}
}

function logOut()
{
    setcookie('id', '');
    setcookie('username', '');
    setcookie('email', '');
    setcookie('password', '');
    setcookie('locality', '');
    session_destroy();
    header('Location: ../index.php');
}

function curl_get_result($url)
{
    $curl = curl_init();
    $timeout = 5;
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $exec = curl_exec($curl);
    curl_close($curl);
    return $exec;
}

function bitly($url, $login, $appkey, $format='txt')
{
    $connectURL = 'http://api.bit.ly/v3/shorten?login='.$login.'&apiKey='.$appkey.'&uri='.urlencode($url).'&format='.$format;
    return curl_get_result($connectURL);
}

function uploadImage($bdd, $destination, $name, $id = false){
    if(!empty($_FILES[$name]['name']))
    {
        if(is_writable($destination))
        {
            $fichier = basename($_FILES[$name]['name']);
            $taille_maxi = 100000;
            $taille = filesize($_FILES[$name]['tmp_name']);
            $extensions = array('.png', '.bmp', '.jpg', '.jpeg');
            $extension = strrchr($_FILES[$name]['name'], '.'); 
            if(!in_array($extension, $extensions)) //Si l'extension est mauvaise
            {
                 $erreur = "<div class=\"alert alert-error\>
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <strong>Erreur :</strong> Les formats acceptés sont .png, .bmp, .jpg, .jpeg .
                        </div>";
            }
            if($taille>$taille_maxi)
            {
                 $erreur = "<div class=\"alert alert-error\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <strong>Succès :</strong> Le fichier envoyé est trop gros.
                        </div>";
            }
            if(!isset($erreur)) //Si les vérifications ne renvoient pas d'erreurs, on upload.
            {
                $fichier = $id . ".png";
                if(move_uploaded_file($_FILES[$name]['tmp_name'], $destination . $fichier)) 
                {
                    return true;
                }
                else
                {
                    echo "<div class=\"alert alert-error\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <strong>Erreur :</strong> Echec de l'envoi de votre fichier. 
                        </div>";
                    return false;
                }
            }
            else
            {
                echo $erreur;
                return false;
            }
        }
        else
        {
            echo "<div class=\"alert alert-error\" >
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <strong>Erreur :</strong> Le dossier d'upload n'est pas accessible en écriture, changez les permissions de celui-ci ($destination).
                        </div>";
                    return false;
        }
    }
    else
    {
        return true;
    }
}

?>