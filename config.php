<?php
	// Объявление констант
	// $hostName		= 'localhost';	//Имя хоста
	// $Port           = '5432';		//Порт
	// $DatBaseName	= 'test';		//Имя базы данных
	// $UserName		= 'postgres';	//Имя пользовател
	// $Password		= '';

	$hostName		= 'pg-jail';	//Имя хоста
    $Port			= '5432';		//Порт
	$DatBaseName	= 'test';		//Имя базы данных
	$UserName		= 'test';		//Имя пользовател
	$Password		= 'js7gdGrnLhrvR6gkFjgD';

	ini_set('display_errors', '0');

	session_start();

	if ( !isset($_SESSION['Login'] ) )
	{
		$_SESSION['Login'] = 'admin';
	}
	$UserName = $_SESSION['Login'];
	
	function CheckBDResult( $Value )
	{
		if ( $Value == false )
		{
			echo 'Ошибка: ' . pg_last_error();
			die;
		}
	}
?>


	
