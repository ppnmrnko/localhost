<?php
	//Удаление из таблицы Служащий
	require ('config.php');	//Чтение файла настроек
	
	$WariorNumber	= $_GET['WariorNum'];	//Номер служащего

	// Подключение к базе данных
	$dbconn = pg_connect("host=" . $hostName . " port=" . $Port . " dbname=" . $DatBaseName . " user=" . $UserName . " password=" . $Password);
	CheckBDResult($dbconn);

	//Фомирование запроса на запись воина
	$query = "delete from служащий where номер_служащего = " . $WariorNumber;

	$result = pg_query($query);
	CheckBDResult($result);
	pg_free_result($result);
?>
