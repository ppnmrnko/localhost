<?php
	require ('config.php');	//Чтение файла настроек

	echo "<h4>Вывод колличества вооружения в определённой части</h4>";
	
	$Num_voinsk_ch = $_GET['nomer_voinsk_ch'];//Чтение номера воинской части из строки запроса
	
	// Подключение к базе данных
	$dbconn = pg_connect("host=" . $hostName . " port=" . $Port . " dbname=" . $DatBaseName . " user=" . $UserName . " password=" . $Password);
	CheckBDResult($dbconn);

	// Фомирование запроса о наименования воинских частей
	$query = "select номер_воинской_части, название_воинской_части from воинская_часть";
	$result = pg_query($query);
	CheckBDResult($result);

	// Вывод результата в выпадающий список
	echo "<select id='someSelect' onChange='showFormWithParam(\"form4.php?nomer_voinsk_ch=\", \"someSelect\" );'>\n";
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

	
	// Формирование SQL запроса с рассчётом количества вооружений в выбранной воинской части
	// $query = "select count(номер_вооружения) from вооружение as vor
				// inner join воинская_часть as vc on vor.номер_воинской_части = vc.номер_воинской_части
				// where (vc.номер_воинской_части = " . $Num_voinsk_ch .")";

	$query = "select kolicestvo_voorujenie (" . $Num_voinsk_ch . ")";

	$result = pg_query($query);
	CheckBDResult($result);

	// Вывод результата в табличном виде
	echo "<table>\n";
	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
	{
		echo "<tr>\n";
		foreach ($line as $col_value) 
		{
			echo "<td>Количество вооружений = $col_value</td>\n";
		}
		echo "</tr>\n";
	}
	echo "</table>\n";
	// Очистка результата
	pg_free_result($result);
?>
