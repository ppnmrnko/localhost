<?php
	require ('config.php');	//Чтение файла настроек

	echo "<h4>Вывод списка всех обладателей золотого значка ГТО</h4>";
	// Подключение к базе данных
	$dbconn = pg_connect("host=" . $hostName . " port=" . $Port . " dbname=" . $DatBaseName . " user=" . $UserName . " password=" . $Password);
	CheckBDResult($dbconn);

	// Формирование SQL запроса
	$query = "select фамилия, имя, отчество, описание from служащий as sl
				inner join характеристика_служащего as hs on hs.номер_служащего = sl.номер_служащего
				inner join характеристика as hr on hr.номер_характеристики = hs.номер_характеристики
				where (hr.название_характеристики = 'Значёк ГТО') and (hs.описание = 'Золотой')";
	
	$result = pg_query($query);
	CheckBDResult($result);

	// Вывод результата в табличном виде
	echo "<table>\n";
	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
	{
		echo "<tr>\n";
		foreach ($line as $col_value) 
		{
			echo "<td>$col_value</td>\n";
		}
		echo "</tr>\n";
	}
	echo "</table>\n";
	// Очистка результата
	pg_free_result($result);
?>
