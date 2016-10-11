<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

global $USER;
$arGroups = $USER->GetUserGroupArray();
$tpl = 'phizik';
if (in_array(6, $arGroups))
	$tpl = 'jur_ooo';
elseif (in_array(7, $arGroups))
	$tpl = 'jur_ip';
?>

<div class="order_block">
	<div class="profile_switch">
		<a href="#" id="profile_docs" class="switch_control active"><span>документация</span></a>
		<a href="#" id="profile_anketa" class="switch_control"><span>данные профиля</span></a>								
	</div>
	<div class="switch_content profile_docs active">


	<?$APPLICATION->IncludeComponent(
	"bitrix:main.profile", 
	"docs", 
	array(
		"USER_PROPERTY_NAME" => "",
		"SET_TITLE" => "Y",
		"AJAX_MODE" => "N",
		"USER_PROPERTY" => array(
			0 => "UF_DOCS",
		),
		"SEND_INFO" => "N",
		"CHECK_RIGHTS" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?> 



		<form action="">

		</form>
	</div>
	<div class="switch_content profile_anketa">	
	<?$APPLICATION->IncludeComponent(
	"bitrix:main.profile", 
	$tpl, 
	array(
		"USER_PROPERTY_NAME" => "",
		"SET_TITLE" => "Y",
		"AJAX_MODE" => "Y",
		"USER_PROPERTY" => array(
			0 => "UF_COMPANY_SHORT",
			1 => "UF_INN",
			2 => "UF_KPP",
			3 => "UF_OGRN",
			4 => "UF_ADDRESS_UR",
			5 => "UF_ADDRESS_FACT",
			6 => "UF_ADDRESS_POST",
			7 => "UF_PASSPORT_SERIAL",
			8 => "UF_PASSPORT_NUMBER",
			9 => "UF_PASSPORT_GIVE",
			10 => "UF_PASSPORT_FROM",
			11 => "UF_PASSPORT_FCODE",
			12 => "UF_ADDRESS_REG",
			13 => "UF_COMPANY_FULL",
		),
		"SEND_INFO" => "N",
		"CHECK_RIGHTS" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?> 

	</div>

</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>