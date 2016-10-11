<?
define("NOT_SHOW_TITLE", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?>


                 <div class="order_block">   


<?
$APPLICATION->IncludeComponent(
	"bitrix:main.register", 
	"bbaccara2014", 
	array(
		"USER_PROPERTY_NAME" => "",
		"SEF_MODE" => "Y",
		"SHOW_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
			2 => "SECOND_NAME",
			3 => "LAST_NAME",
			4 => "PERSONAL_BIRTHDAY",
			5 => "PERSONAL_PHONE",
		),
		"REQUIRED_FIELDS" => array(
		),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "/personal/registration/success.php",
		"SET_TITLE" => "N",
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
		),
		"SEF_FOLDER" => "/"
	),
	false
); 
?>

</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>