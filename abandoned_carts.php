<?
define("NOT_LEFT_BLOCK", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Брошенные корзины");
define("NOT_LEFT_BLOCK", 1);
?>

<?
if(!$USER->IsAdmin()) {
    LocalRedirect('/');
}
?>

<?$APPLICATION->IncludeComponent(
    "baccara:abandoned_carts", 
    "", 
    array(
        "CART_COUNT" => 20
    ),
    false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>