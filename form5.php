<?php
	require ('config.php');	//Чтение файла настроек

	echo "<h4>Вывод колличества определённой должности в определённой воинской части</h4>";
	
	$Num_zvanie = $_GET['nv'];	//Чтение номера звания из строки запроса
	$Num_voinsk_ch = $_GET['rt'];//Чтение номера воинской части из строки запроса
	$Name_zvanie = 'Рядовой';
	
	// Подключение к базе данных
	$dbconn = pg_connect("host=" . $hostName . " port=" . $Port . " dbname=" . $DatBaseName . " user=" . $UserName . " password=" . $Password);
	CheckBDResult($dbconn);

	// Фомирование запроса о наименованиях воинских частей
	$query = "select номер_воинской_части, название_воинской_части from воинская_часть";
	$result = pg_query($query);
	CheckBDResult($result);

	// Вывод результата в выпадающий список
	echo "<select id='someSelectIDRT' onChange='showFormWith2Param(\"form5.php\", \"someSelectIDNV\", \"someSelectIDRT\" );'>\n";
	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
	{
		if ( $line['номер_воинской_части'] == $Num_voinsk_ch )
		{
			echo "<option value='" . $line['номер_воинской_части']. "' selected>" . $line['название_воинской_части']. "</option>\n";
		} else
		{
			echo "<option value='" . $line['номер_воинской_части']. "'>" . $line['название_воинской_части']. "</option>\n";
		}
	}
	echo"</select>\n";

	
	// Фомирование запроса о наименованиях воинских званий
	$query = "	select номер_звания, название_звания from звание";

	$result = pg_query($query);
	CheckBDResult($result);

	// Вывод результата в выпадающий список
	echo "<select id='someSelectIDNV' onChange='showFormWith2Param(\"form5.php\", \"someSelectIDNV\", \"someSelectIDRT\" );'>\n";
	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
	{
		if ( $line['номер_звания'] == $Num_zvanie )
		{
			echo "<option value='" . $line['номер_звания']. "' selected>" . $line['название_звания']. "</option>\n";
			$Name_zvanie = $line['название_звания'];
		} else
		{
			echo "<option value='" . $line['номер_звания']. "'>" . $line['название_звания']. "</option>\n";
		}
	}
	echo"</select>\n";
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

	// Формирование SQL запроса с обращением к функции БД "nazvanie_chasti"
	$query = "select nazvanie_chasti ('" . $Name_zvanie ."', " . $Num_voinsk_ch .")";
	$result = pg_query($query);
	CheckBDResult($result);

	// Вывод результата в табличном виде
	echo "<table>\n";
	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
	{
		echo "<tr>\n";
		foreach ($line as $col_value) 
		{
			echo "<td>Количество количество должностей = $col_value</td>\n";
		}
		echo "</tr>\n";
	}
	echo "</table>\n";

	// Очистка результата
	pg_free_result($result);
?>
