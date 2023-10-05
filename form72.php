<?php
	//Удаление из таблицы Служащий
	require ('config.php');	//Чтение файла настроек
	
	$WeaponNumber	= $_GET['WeaponNum'];	//Номер Оружия

	// Подключение к базе данных
	$dbconn = pg_connect("host=" . $hostName . " port=" . $Port . " dbname=" . $DatBaseName . " user=" . $UserName . " password=" . $Password);
	CheckBDResult($dbconn);

	//Фомирование запроса на запись воина
	$query = "delete from вооружение where номер_вооружения = " . $WeaponNumber;

	$result = pg_query($query);
	CheckBDResult($result);
	pg_free_result($result);
?>
