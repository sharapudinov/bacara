<?
$aMenuLinks = Array(
	Array(
		"мои заказы", 
		"/personal/index.php", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"персональные данные", 
		"/personal/profile.php", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"профили доставок", 
		"/personal/profiles/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Обращения", 
		"/personal/support/", 
		Array(), 
		Array(), 
		"" 
	)
);

$id_user = $USER->GetID();
$arGroups = $USER->GetUserGroupArray($id_user);

if(in_array(11, $arGroups)):
    $aMenuLinks[] = array(
        "Пополнить счет",
        "/predoplata/?ELEMENT_ID=17136",
        array(),
        array(),
        ""
    );
endif;