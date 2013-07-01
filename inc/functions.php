<?php
/* Fonctions diverses */

session_start();

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

?>