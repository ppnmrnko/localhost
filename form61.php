<?php
	//Запись в таблицу Служащий
	require ('config.php');	//Чтение файла настроек
	
	$Familia 	= $_GET['f'];	//Чтение фамилии
	$Name 		= $_GET['n'];	//Чтение имя
	$Otchestvo	= $_GET['o'];	//Чтение отчество
	$Zvanie		= $_GET['z'];	//Чтение звание (номер)
	$VoinChast	= $_GET['VCh'];	//Воинская часть

	// Подключение к базе данных
	$dbconn = pg_connect("host=" . $hostName . " port=" . $Port . " dbname=" . $DatBaseName . " user=" . $UserName . " password=" . $Password);
	CheckBDResult($dbconn);

	//Фомирование запроса на запись воина
	$query = "insert into служащий
				(номер_состава, номер_звания, имя, фамилия, отчество)
				values
				('" . $VoinChast . "' , '" . $Zvanie . "', '" . $Name . "', '" . $Familia . "', '" . $Otchestvo . "')";

	$result = pg_query($query);
	CheckBDResult($result);
	pg_free_result($result);
?>
