<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->IncludeComponent("bitrix:sender.subscribe","",Array(
        "COMPONENT_TEMPLATE" => ".default",
        "USE_PERSONALIZATION" => "Y",
        "CONFIRMATION" => "Y",
        "SHOW_HIDDEN" => "Y",
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_JUMP" => "Y",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "SET_TITLE" => "Y"
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>