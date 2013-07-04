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
	session_destroy();
	header('Location: ../index.php');
}

?>