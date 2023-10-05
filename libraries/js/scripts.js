// Смена пользователя
function ChangeUser()
{
	var Login = document.getElementById('LoginId');
	var urlChangeUser = "ChangeUsr.php?NewUser=" + Login.value;
	$.get(urlChangeUser, function(data, status) {}, "html");
};

function showForm(url) {
  $.get(url, function(data, status) {
	var result = document.getElementById('FormId');
    if ( result != null ) {
      if ( status == "success" ) {
        result.innerHTML = data;
      } else {
        result.innerHTML = "ошибка выполнения запроса";
      }
    }
  }, "html");
};

function showFormWithParam(url, someID) {
	var resultID = document.getElementById(someID);
	if ( resultID != null ) {
		url = url + resultID.value;
		$.get(url, function(data, status) {
			var result = document.getElementById('FormId');
			if ( result != null ) {
				if ( status == "success" ) {
					result.innerHTML = data;
				} else {
					result.innerHTML = "ошибка выполнения запроса";
				}
			}
		}, "html");
	}
};

function showFormWith2Param(url, someID1, someID2) {
	var resultID1 = document.getElementById(someID1);
	if ( resultID1 != null ) {
		var resultID2 = document.getElementById(someID2);
		if ( resultID2 != null ) {
			url = url + "?nv=" + resultID1.value + "&rt=" + resultID2.value;
			$.get(url, function(data, status) {
				var result = document.getElementById('FormId');
				if ( result != null ) {
					if ( status == "success" ) {
						result.innerHTML = data;
					} else {
						result.innerHTML = "ошибка выполнения запроса";
					}
				}
			}, "html");
		}
	}
};

// Добавление служащего
function WriteWarior()
{
	var Familia = document.getElementById('FamiliaId');
	var Name = document.getElementById('NameId');
	var Otchestvo = document.getElementById('OtchestvoId');
	var Zvanie = document.getElementById('ZvanieId');
	var VoinChast = document.getElementById('VoinChastId');
	
	var urlWriter = "form61.php?f=" + Familia.value + "&n=" + Name.value + "&o=" + Otchestvo.value + "&z=" + Zvanie.value + "&VCh=" + VoinChast.value;
	$.get(urlWriter, function(data, status) 
	{
		var result = document.getElementById('FormId');
		if ( result != null ) 
		{
			if ( status == "success" ) 
			{
				$.get("form6.php", function(data, status) 
				{
					if ( status == "success" ) 
					{
						result.innerHTML = data;
					} else
					{
						result.innerHTML = "ошибка выполнения запроса";
					}
				}, "html");
			} else 
			{
				result.innerHTML = "ошибка запроса для записи в БД";
			}
		}
	}, "html");

};

// Удаление служащего
function DeleteWarior(WariorNumber)
{
	var urlDeleter = "form62.php?WariorNum=" + WariorNumber;
	$.get(urlDeleter, function(data, status) 
	{
		var result = document.getElementById('FormId');
		if ( result != null ) 
		{
			if ( status == "success" ) 
			{
				$.get("form6.php", function(data, status) 
				{
					if ( status == "success" ) 
					{
						result.innerHTML = data;
					} else
					{
						result.innerHTML = "ошибка выполнения запроса";
					}
				}, "html");
			} else 
			{
				result.innerHTML = "ошибка запроса для записи в БД";
			}
		}
	}, "html");
};

// Добавление оружия
function WriteWeapon()
{
	var WeaponName = document.getElementById('WeaponNameId');
	var VoinChast = document.getElementById('VoinChastId');
	var urlWriter = "form71.php?WeapNam=" + WeaponName.value + "&VCh=" + VoinChast.value;
	$.get(urlWriter, function(data, status) 
	{
		var result = document.getElementById('FormId');
		if ( result != null ) 
		{
			if ( status == "success" ) 
			{
				$.get("form7.php", function(data, status) 
				{
					if ( status == "success" ) 
					{
						result.innerHTML = data;
					} else
					{
						result.innerHTML = "ошибка выполнения запроса";
					}
				}, "html");
			} else 
			{
				result.innerHTML = "ошибка запроса для записи в БД";
			}
		}
	}, "html");

};

// Удаление Оружия
function DeleteWeapon(WeaponNumber)
{
	var urlDeleter = "form72.php?WeaponNum=" + WeaponNumber;
	$.get(urlDeleter, function(data, status) 
	{
		var result = document.getElementById('FormId');
		if ( result != null ) 
		{
			if ( status == "success" ) 
			{
				$.get("form7.php", function(data, status) 
				{
					if ( status == "success" ) 
					{
						result.innerHTML = data;
					} else
					{
						result.innerHTML = "ошибка выполнения запроса";
					}
				}, "html");
			} else 
			{
				result.innerHTML = "ошибка запроса для записи в БД";
			}
		}
	}, "html");

};

