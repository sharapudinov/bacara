<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>

<?

CModule::includeModule('sale');
CModule::includeModule('iblock');
CModule::includeModule('catalog');

$arBasketItems = array();
$dbBasketItems = CSaleBasket::GetList(
        array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
        array(
                "ORDER_ID" => 3628
            ),
        false,
        false,
        array("ID", "PRODUCT_ID")
    );
while ($arItems = $dbBasketItems->Fetch()) {
    $basketPositions[$arItems['ID']] = $arItems;
    $goodsId[] = $arItems['PRODUCT_ID'];
}

$arFilter = Array(
    "IBLOCK_ID" => 1,
    "ID" => $goodsId
);

$arSelect = Array(
    "ID",
    "IBLOCK_ID",
    "NAME",
    "PROPERTY_CML2_ARTICLE",
);

$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while ($ob = $res->Fetch()) {
    $arGoods[$ob['ID']] = $ob;
}

foreach($basketPositions as $position) {

    $arFields["PROPS"] = array(
        "NAME" => 'Артикул',
        "CODE" => 'CML2_ARTICLE',
        "VALUE" => $arGoods[$position['PRODUCT_ID']]['PROPERTY_CML2_ARTICLE_VALUE'],
    );

    //if(CSaleBasket::Update($position['ID'], $arFields)) echo 'ok';
}

/*$arFields["PROPS"] = array(
                        "NAME" => 'Артикул',
                        "CODE" => 'PREVIEW_PICTURE',
                        "VALUE" => $sku['DETAIL_PICTURE'],
                    );
*/
printr($basketPositions);

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>