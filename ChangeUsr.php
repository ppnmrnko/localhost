<?php
	require ('config.php');	//Чтение файла настроек

	$NewUsr	= $_GET['NewUser'];

	$_SESSION['Login'] ='';

	switch ($NewUsr)
	{
		case '1':
			$_SESSION['Login'] = 'admin';
		break;

		case '2':
			$_SESSION['Login'] = 'general';
		break;

		case '3':
			$_SESSION['Login'] = 'solder';
		break;
	}
?>
