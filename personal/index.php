<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Блэк Баккара");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order",
	"",
	Array(
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"SEF_MODE" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"ORDERS_PER_PAGE" => "20",
		"PATH_TO_PAYMENT" => "/order/step2/payment.php",
		"PATH_TO_BASKET" => "/cart/",
		"SET_TITLE" => "Y",
		"SAVE_IN_SESSION" => "N",
		"NAV_TEMPLATE" => "",
		"CUSTOM_SELECT_PROPS" => array(""),
		"HISTORIC_STATUSES" => array("F"),
		"STATUS_COLOR_N" => "green",
		"STATUS_COLOR_F" => "gray",
		"STATUS_COLOR_PSEUDO_CANCELLED" => "red",
		"SEF_FOLDER" => "/personal/",
		"SEF_URL_TEMPLATES" => Array("list"=>"index.php","detail"=>"order_detail.php?ID=#ID#","cancel"=>"order_cancel.php?ID=#ID#"),
		"VARIABLE_ALIASES" => Array("list"=>Array(),"detail"=>Array("ID"=>"ID"),"cancel"=>Array("ID"=>"ID"),),
		"VARIABLE_ALIASES" => Array(
			"list" => Array(),
			"detail" => Array(
				"ID" => "ID"
			),
			"cancel" => Array(
				"ID" => "ID"
			),
		)
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>