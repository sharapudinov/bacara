<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';



if(isset($_POST['item_id']) && $_POST['item_id'] > 0) {
    
    if(CModule::IncludeModule('sale')) {
        $dbItems = CSaleBasket::GetList(
            array("ID" => "ASC"),
            array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL",
                "PRODUCT_ID" => $_POST['item_id']
            ),
            false,
            false,
            array("ID", "PRODUCT_ID", "QUANTITY")
        );

        if($arItem = $dbItems->GetNext(true, false)) {
            $count = (int) $arItem['QUANTITY'];            
        }
        
        print_r($count);
    }     
}