<?php
/* Fonctions diverses */

session_start();


function nl2br2($string)
{ 
    $string = str_replace(array("\\r\\n", "\\r", "\\n"), "<br>", $string); 
    return $string;
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

function uploadImage($bdd, $destination, $name, $id = false){
    if(!empty($_FILES[$name]['name']))
    {
        if(is_writable($destination))
        {
            $fichier = basename($_FILES[$name]['name']);
            $taille_maxi = 300000;
            $extensions = array('.png', '.bmp', '.jpg', '.jpeg');
            $extension = strrchr($_FILES[$name]['name'], '.'); 
            if(!in_array($extension, $extensions)) //Si l'extension est mauvaise
            {
                 $erreur = "<div class=\"alert alert-error\>
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <strong>Erreur :</strong> Les formats acceptés sont .png, .bmp, .jpg, .jpeg .
                        </div>";
            }
            if($_FILES[$name]['size'] > $taille_maxi)
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

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = $r ."," . $g ."," .  $b;
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

function supavatar($id)
{
   if ( unlink('upload/img/' . $id . '.png') )
   {
    return true;
   }
   else
   {
    return false;
   }
}

function supbgimg($id)
{
    if ( unlink('upload/bgimg/' . $id . '.png') )
   {
    return true;
   }
   else
   {
    return false;
   }
}

function curl_get_result($url)
{
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function bitly($url, $login, $appkey, $format='txt')
{
    $connectURL = 'http://api.bit.ly/v3/shorten?login='.$login.'&apiKey='.$appkey.'&uri='.urlencode($url).'&format='.$format;
    return curl_get_result($connectURL);
}

?>