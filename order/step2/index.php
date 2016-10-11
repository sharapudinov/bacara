<?
define("NOT_LEFT_BLOCK", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
if(!$USER->IsAuthorized()) LocalRedirect('/order/');
?>




<?$APPLICATION->IncludeComponent(
	"bacara:sale.order.full", 
	"order-last", 
	array(
		"ALLOW_PAY_FROM_ACCOUNT" => "N",
		"SHOW_MENU" => "N",
		"CITY_OUT_LOCATION" => "Y",
		"COUNT_DELIVERY_TAX" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"SEND_NEW_USER_NOTIFY" => "N",
		"DELIVERY_NO_SESSION" => "Y",
		"PROP_1" => array(
		),
		"PATH_TO_BASKET" => "/cart/",
		"PATH_TO_PERSONAL" => "/personal/",
		"PATH_TO_AUTH" => "/auth/",
		"PATH_TO_PAYMENT" => "/order/step2/payment.php",
		"USE_AJAX_LOCATIONS" => "Y",
		"SHOW_AJAX_DELIVERY_LINK" => "Y",
		"SET_TITLE" => "Y",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "Y"
	),
	false
);?>
<br clear="both"> <br />

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>