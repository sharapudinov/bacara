<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


if(CModule::IncludeModule('sale') && CModule::IncludeModule('iblock')) {
    //CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
    
    global $USER;
    if ($USER->IsAuthorized()) {
        
        $dbBasketItems = CSaleBasket::GetList(
            array(
                    "NAME" => "ASC",
                    "ID" => "ASC"
                ),
            array(
                    "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                    "LID" => SITE_ID,
                    "ORDER_ID" => "NULL"
                ),
            false,
            false,
            array("ID", "PRODUCT_ID", "QUANTITY")
        );
        
        while ($arItems = $dbBasketItems->Fetch())
        {
            $ids[] = $arItems['PRODUCT_ID'];
            $goods['quantity'][$arItems['PRODUCT_ID']] = $arItems['QUANTITY'];
        }

        //echo '<pre>'; print_r($ids); echo '</pre>';

        $price_code = array(
            0 => "Крупный опт",
            1 => "Оптовая",
            2 => "СП",
        );
                   
        $ararResultPrices = CIBlockPriceTools::GetCatalogPrices($arParams["IBLOCK_ID"], $price_code);

        $total_summ = 0;
        
        $rsElement = CIBlockElement::GetList(array(), array("ID"=>$ids), false, false, array("ID", "CATALOG_GROUP_1", "CATALOG_GROUP_2", "CATALOG_GROUP_3"));
        while($obElement = $rsElement->GetNextElement())
        {
            $item = $obElement->GetFields();
            $ararResult["PRICES"][$item['ID']] = CIBlockPriceTools::GetItemPrices($arParams["IBLOCK_ID"], $ararResultPrices, $item, 1, array("CURRENCY_ID" => "RUB"));
            $total_summ += $ararResult["PRICES"][$item['ID']]['СП']['VALUE']*$goods['quantity'][$item['ID']];
            $total_summ_ko += $ararResult["PRICES"][$item['ID']]['Крупный опт']['VALUE']*$goods['quantity'][$item['ID']];
            $total_summ_opt += $ararResult["PRICES"][$item['ID']]['Оптовая']['VALUE']*$goods['quantity'][$item['ID']];
        }
        
        $userId = $USER->GetID(); 
        $arGroups = $USER->GetUserGroup($userId); 
        
        if(in_array(10, $arGroups)) {
            $arResult['TOTAL_SUMM']['KO'] = $total_summ_ko;
        }
        
        $arResult['TOTAL_SUMM']['SP'] = $total_summ;        
    }
}

$this->IncludeComponentTemplate();