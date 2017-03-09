<?
define("NOT_LEFT_BLOCK", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
/**/?><!--
<script>
    alert('Внимание!!! В связи с высокой загруженностью, все новые заказы будут огружены не ранее 9 марта. Приносим извинения за неудобство.');
</script>
--><?
$APPLICATION->IncludeComponent(
    "bitrix:sale.order.ajax",
    "baccara",
    array(
        "COMPONENT_TEMPLATE" => "baccara",
        "PAY_FROM_ACCOUNT" => "N",
        "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
        "ALLOW_AUTO_REGISTER" => "Y",
        "SEND_NEW_USER_NOTIFY" => "Y",
        "DELIVERY_NO_AJAX" => "Y",
        "DELIVERY_NO_SESSION" => "Y",
        "TEMPLATE_LOCATION" => "popup",
        "DELIVERY_TO_PAYSYSTEM" => "d2p",
        "USE_PREPAYMENT" => "N",
        "COMPATIBLE_MODE" => "N",
        "USE_PRELOAD" => "Y",
        "ALLOW_USER_PROFILES" => "N",
        "ALLOW_NEW_PROFILE" => "N",
        "TEMPLATE_THEME" => "blue",
        "SHOW_ORDER_BUTTON" => "final_step",
        "SHOW_TOTAL_ORDER_BUTTON" => "N",
        "SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
        "SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
        "SHOW_DELIVERY_LIST_NAMES" => "Y",
        "SHOW_DELIVERY_INFO_NAME" => "Y",
        "SHOW_DELIVERY_PARENT_NAMES" => "Y",
        "SHOW_STORES_IMAGES" => "Y",
        "SKIP_USELESS_BLOCK" => "Y",
        "BASKET_POSITION" => "after",
        "SHOW_BASKET_HEADERS" => "Y",
        "DELIVERY_FADE_EXTRA_SERVICES" => "N",
        "SHOW_COUPONS_BASKET" => "Y",
        "SHOW_COUPONS_DELIVERY" => "N",
        "SHOW_COUPONS_PAY_SYSTEM" => "N",
        "SHOW_NEAREST_PICKUP" => "Y",
        "DELIVERIES_PER_PAGE" => "8",
        "PAY_SYSTEMS_PER_PAGE" => "8",
        "PICKUPS_PER_PAGE" => "5",
        "SHOW_MAP_IN_PROPS" => "N",
        "PROPS_FADE_LIST_1" => array(
            0 => "1",
            1 => "3",
            2 => "4",
            3 => "5",
            4 => "6",
            5 => "7",
        ),
        "PATH_TO_BASKET" => "/cart/",
        "PATH_TO_PERSONAL" => "index.php",
        "PATH_TO_PAYMENT" => "payment.php",
        "PATH_TO_AUTH" => "/auth/",
        "SET_TITLE" => "Y",
        "DISABLE_BASKET_REDIRECT" => "N",
        "PRODUCT_COLUMNS_VISIBLE" => array(
            0 => "PREVIEW_PICTURE",
            1 => "PROPS",
        ),
        "ADDITIONAL_PICT_PROP_1" => "-",
        "ADDITIONAL_PICT_PROP_8" => "-",
        "BASKET_IMAGES_SCALING" => "standard",
        "SERVICES_IMAGES_SCALING" => "standard",
        "PRODUCT_COLUMNS_HIDDEN" => array(),
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO",
        "USE_YM_GOALS" => "N",
        "USE_CUSTOM_MAIN_MESSAGES" => "N",
        "USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
        "USE_CUSTOM_ERROR_MESSAGES" => "N",
        "SHOW_MAP_FOR_DELIVERIES" => array(
            0 => "3",
            1 => "4",
            2 => "5",
            3 => "6",
            4 => "7",
        ),
        "SHOW_NOT_CALCULATED_DELIVERIES" => "L"
    ),
    false
);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>

