<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';

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
                   
        $arResultPrices = CIBlockPriceTools::GetCatalogPrices($arParams["IBLOCK_ID"], $price_code);

        $total_summ = 0;
        
        $rsElement = CIBlockElement::GetList(array(), array("ID"=>$ids), false, false, array("ID", "CATALOG_GROUP_1", "CATALOG_GROUP_2", "CATALOG_GROUP_3"));
        while($obElement = $rsElement->GetNextElement())
        {
            $item = $obElement->GetFields();
            $arResult["PRICES"][$item['ID']] = CIBlockPriceTools::GetItemPrices($arParams["IBLOCK_ID"], $arResultPrices, $item, 1, array("CURRENCY_ID" => "RUB"));
            $total_summ += $arResult["PRICES"][$item['ID']]['СП']['VALUE']*$goods['quantity'][$item['ID']];
            $total_summ_ko += $arResult["PRICES"][$item['ID']]['Крупный опт']['VALUE']*$goods['quantity'][$item['ID']];
            $total_summ_opt += $arResult["PRICES"][$item['ID']]['Оптовая']['VALUE']*$goods['quantity'][$item['ID']];
        }
                  
        $userId = $USER->GetID(); 
        $arGroups = $USER->GetUserGroup($userId); 
        
        if(($total_summ >= 50000 && $total_summ_ko < 200000) || ($total_summ_ko >= 200000 && !in_array(10, $arGroups))) {

            if($key = array_search(8, $arGroups)) {
                unset($arGroups[$key]);
            }
                
            if(!in_array(9, $arGroups)) {
                
                $arGroups[] = 9;
                $USER->SetUserGroup($userId, $arGroups);
                $USER->SetUserGroupArray($arGroups);
                $result = array('action' => 'add_sp', 'summ' => $total_summ);
                print_r(json_encode($result));
            }
            else {
                $result = array('action' => 'add_sp_but_no_changes', 'summ' => $total_summ);
                print_r(json_encode($result));
            }
        }
        else if($total_summ_ko >= 200000 && in_array(10, $arGroups)) {
            
            if($key = array_search(9, $arGroups)) {
                unset($arGroups[$key]);
            }
            
            if(!in_array(8, $arGroups)) {
                
                $arGroups[] = 8;
                $USER->SetUserGroup($userId, $arGroups);
                $USER->SetUserGroupArray($arGroups);
                $result = array('action' => 'add_ko', 'summ' => $total_summ_ko);
                print_r(json_encode($result));
            }
            else {
                $result = array('action' => 'add_ko_but_no_changes', 'summ' => $total_summ_ko);
                print_r(json_encode($result));
            }
        }
        else {
            
            if($key = array_search(8, $arGroups)) {
                unset($arGroups[$key]);
            }
            
            if($key = array_search(9, $arGroups)) {
                unset($arGroups[$key]);
            }
      
            $USER->SetUserGroup($userId, $arGroups);
            $USER->SetUserGroupArray($arGroups);
            $result = array('action' => 'del_sp_and_ko', 'summ' => $total_summ_opt);
            print_r(json_encode($result));
        }
    }
    else {
        print_r('not_auth');
    }
}