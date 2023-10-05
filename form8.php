<?php
	require ('config.php');	//Чтение файла настроек

	echo "<h4>Вывод таблицы аудита</h4>";

	// Подключение к базе данных
	$dbconn = pg_connect("host=" . $hostName . " port=" . $Port . " dbname=" . $DatBaseName . " user=" . $UserName . " password=" . $Password);
	CheckBDResult($dbconn);

	// Формирование SQL запроса
	$query = "	select * from audit_of_changes";

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
