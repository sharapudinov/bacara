<?
$arFilter = Array("IBLOCK_ID"=>1, "SECTION_ID" => 74, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("SORT" => "DESC", "ID" => "ASC"), $arFilter, false, Array("nTopCount"=>100), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 //$arFields['PROPERTIES'] = $ob->GetProperties();
 //foreach($arFields['PROPERTIES']['prods']['VALUE'] as $prod)  { 
	$arResult['ACTION'][$arFields["ID"]] = $arFields["ID"];//array("NAME" => $arFields['NAME'], "DETAIL_PAGE_URL" => $arFields['DETAIL_PAGE_URL']);
 //}
}	

    $dbItems = CSaleBasket::GetList(
        array("ID" => "ASC"),
        array(
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL"
        ),
        false,
        false,
        array("ID", "PRODUCT_ID", "QUANTITY")
    );

    while($arItem = $dbItems->GetNext(true, false)) {
        $arResult['CATALOG_ITEM_COUNT'][$arItem['PRODUCT_ID']] = (int) $arItem['QUANTITY'];
    }

    $id_user = $USER->GetID();
    $arGroups = $USER->GetUserGroupArray($id_user);
    $arResult['SHOW_LARGE_WHOSALE'] = (count(array_uintersect(array(8, 10), $arGroups, "strcasecmp")) > 0) ? true : false;    
    
    foreach($arResult['ITEMS'] as $arItem) {
        $ids[] = $arItem['ID'];
    }
    
    $price_code = array(
        0 => "Крупный опт",
        1 => "Оптовая",
        2 => "СП",
    );
               
    $arResultPrices = CIBlockPriceTools::GetCatalogPrices($arParams["IBLOCK_ID"], $price_code);

    $rsElement = CIBlockElement::GetList(array(), array("ID"=>$ids), false, false, array("ID", "CATALOG_GROUP_1", "CATALOG_GROUP_2", "CATALOG_GROUP_3"));
    while($obElement = $rsElement->GetNextElement())
    {
        $item = $obElement->GetFields();
        $arResult["PRICES"][$item['ID']] = CIBlockPriceTools::GetItemPrices($arParams["IBLOCK_ID"], $arResultPrices, $item, 1, array("CURRENCY_ID" => "RUB"));
    }

    //echo '<pre>'; print_r($arResult["PRICES"]); echo '</pre>';	
?>