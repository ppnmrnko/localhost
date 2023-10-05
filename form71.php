<?php
	//Запись в таблицу Оружие
	require ('config.php');	//Чтение файла настроек
	
	$WeaponName	= $_GET['WeapNam'];	//Название оружия
	$VoinChast	= $_GET['VCh'];		//Воинская часть

	// Подключение к базе данных
	$dbconn = pg_connect("host=" . $hostName . " port=" . $Port . " dbname=" . $DatBaseName . " user=" . $UserName . " password=" . $Password);
	CheckBDResult($dbconn);

	//Фомирование запроса на запись воина
	$query = "insert into вооружение
				(название_вооружения, номер_воинской_части)
				values
				('" . $WeaponName . "' , '" . $VoinChast . "')";

	$result = pg_query($query);
	CheckBDResult($result);
	pg_free_result($result);
?>
