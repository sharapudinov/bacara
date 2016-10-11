<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Профили доставок");
?><?$APPLICATION->IncludeComponent("bitrix:sale.personal.profile", "profiles", Array(
	"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
		"PER_PAGE" => "20",	// Количество на одной странице
		"USE_AJAX_LOCATIONS" => "N",	// Использовать расширенный выбор местоположения
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"SEF_FOLDER" => "/personal/profiles/",	// Каталог ЧПУ (относительно корня сайта)
		"SEF_URL_TEMPLATES" => array(
			"list" => "profile_list.php",
			"detail" => "profile_detail.php?ID=#ID#",
		),
		"VARIABLE_ALIASES" => array(
			"list" => "",
			"detail" => array(
				"ID" => "ID",
			),
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>