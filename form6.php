<?php
	require ('config.php');	//Чтение файла настроек

	//Отображение страницы
	echo "<h4>Редактирование списка служащих</h4>";
	// Подключение к базе данных
	$dbconn = pg_connect("host=" . $hostName . " port=" . $Port . " dbname=" . $DatBaseName . " user=" . $UserName . " password=" . $Password);
	CheckBDResult($dbconn);

	// Формирование SQL запроса
	$query = "	select служащий.номер_служащего, служащий.фамилия, служащий.имя, служащий.отчество, звание.название_звания, воинская_часть.название_воинской_части
				from служащий, воинская_часть, звание
				where (служащий.номер_состава = воинская_часть.номер_воинской_части) and (служащий.номер_звания = звание.номер_звания)";
	$result = pg_query($query);
	CheckBDResult($result);

	// Вывод результата в табличном виде
	echo "<table>\n";
	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
	{
		echo "<tr>\n";
		foreach ($line as $Key => $col_value) 
		{
			if ( $Key != 'номер_служащего' )	//Столбец 'номер_служащего' не выводим на экран
			{
				echo "<td>$col_value</td>\n";
			}
		}
		echo "<td><button onClick=\"DeleteWarior(" . $line['номер_служащего'] . ");\">Удалить</button></td>";
		echo "</tr>\n";
	}

	//Вывод полей для редактирования
	echo "<tr>\n";
		echo "<td><input id=FamiliaId value='Иванов'></input</td>\n";
		echo "<td><input id=NameId value='Иван'></input</td>\n";
		echo "<td><input id=OtchestvoId value='Иванович'></input</td>\n";
		echo "<td>";
			// Фомирование запроса о наименованиях воинских званий
			$query = "select номер_звания, название_звания from звание";
			$result = pg_query($query);
			CheckBDResult($result);
			// Вывод результата в выпадающий список
			echo "<select id='ZvanieId'>\n";
			while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
			{
				echo "<option value='" . $line['номер_звания']. "'>" . $line['название_звания']. "</option>\n";
			}
			echo"</select>\n";
		echo "</td>";

		echo "<td>";
			// Фомирование запроса о наименованиях воинских частей
			$query = "select номер_воинской_части, название_воинской_части from воинская_часть";
			$result = pg_query($query);
			CheckBDResult($result);
			// Вывод результата в выпадающий список
			echo "<select id='VoinChastId'>\n";
			while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
			{
				echo "<option value='" . $line['номер_воинской_части']. "'>" . $line['название_воинской_части']. "</option>\n";
			}
			echo"</select>\n";
		echo "</td>";
		echo "<td><button onClick=\"WriteWarior();\">Добавить</button></td>";
	echo "</tr>\n";
	echo "</table>\n";
	// Очистка результата
	pg_free_result($result);
?>
