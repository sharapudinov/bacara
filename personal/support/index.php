<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обращения");
?><?$APPLICATION->IncludeComponent(
	"bitrix:support.ticket",
	"",
	Array(
		"SEF_MODE" => "Y",
		"TICKETS_PER_PAGE" => "50",
		"MESSAGES_PER_PAGE" => "20",
		"MESSAGE_MAX_LENGTH" => "70",
		"MESSAGE_SORT_ORDER" => "asc",
		"SET_PAGE_TITLE" => "Y",
		"SHOW_COUPON_FIELD" => "N",
		"SET_SHOW_USER_FIELD" => array(),
		"SEF_FOLDER" => "/personal/support/",
		"SEF_URL_TEMPLATES" => Array("ticket_list"=>"index.php","ticket_edit"=>"#ID#.php"),
		"VARIABLE_ALIASES" => Array("ticket_list"=>Array(),"ticket_edit"=>Array(),),
		"VARIABLE_ALIASES" => Array(
			"ticket_list" => Array(),
			"ticket_edit" => Array(),
		)
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>