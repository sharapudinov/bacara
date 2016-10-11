<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/actions/([a-zA-Z0-9-_]+)/#",
		"RULE" => "ELEMENT_CODE=\$1&",
		"ID" => "",
		"PATH" => "/actions/detail.php",
	),
	array(
		"CONDITION" => "#^/personal/profiles/#",
		"RULE" => "",
		"ID" => "bitrix:sale.personal.profile",
		"PATH" => "/personal/profiles/index.php",
	),
	array(
		"CONDITION" => "#^/personal/support/#",
		"RULE" => "",
		"ID" => "bitrix:support.ticket",
		"PATH" => "/personal/support/index.php",
	),
	array(
		"CONDITION" => "#^/personal/#",
		"RULE" => "",
		"ID" => "bitrix:sale.personal.order",
		"PATH" => "/personal/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog/index.php",
	),
	array(
		"CONDITION" => "#^/#",
		"RULE" => "",
		"ID" => "bitrix:form.result.new",
		"PATH" => "/local/templates/main/header.php",
	),
);

?>