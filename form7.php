<?php
	require ('config.php');	//Чтение файла настроек

	//Отображение страницы
	echo "<h4>Редактирование списка вооружений</h4>";
	// Подключение к базе данных
	$dbconn = pg_connect("host=" . $hostName . " port=" . $Port . " dbname=" . $DatBaseName . " user=" . $UserName . " password=" . $Password);
	CheckBDResult($dbconn);

	// Формирование SQL запроса
	$query = "	select вооружение.номер_вооружения, вооружение.название_вооружения, воинская_часть.название_воинской_части
				from вооружение, воинская_часть 
				where вооружение.номер_воинской_части = воинская_часть.номер_воинской_части";
				
	$result = pg_query($query);
	CheckBDResult($result);

	// Вывод результата в табличном виде
	echo "<table>\n";
	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
	{
		echo "<tr>\n";
		foreach ($line as $Key => $col_value) 
		{
			if ( $Key != 'номер_вооружения' )	//Столбец 'номер_вооружения' не выводим на экран
			{
				echo "<td>$col_value</td>\n";
			}
		}
		echo "<td><button onClick=\"DeleteWeapon(" . $line['номер_вооружения'] . ");\">Удалить</button></td>";
		echo "</tr>\n";
	}

	//Вывод полей для редактирования
	echo "<tr>\n";
		echo "<td><input id=WeaponNameId></input</td>\n";
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
		echo "<td><button onClick=\"WriteWeapon();\">Добавить</button></td>";
	echo "</tr>\n";
	echo "</table>\n";
	// Очистка результата
	pg_free_result($result);
?>
