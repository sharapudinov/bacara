<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';



if(isset($_POST['item_id']) && $_POST['item_id'] > 0 && isset($_POST['summ']) && $_POST['summ'] && isset($_POST['delivery_payment']) && $_POST['delivery_payment']) {
    
    if(CModule::IncludeModule('sale')) {
        
        CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());        
        
        
/*         $arProps = array();

          $arProps[] = array(
            "NAME" => "Оплата услуг логистики",
            "CODE" => "delivery_payment",
            "VALUE" => $_POST['delivery_payment']
          );

        $arFields["PROPS"] = $arProps; */
        
        $arFields = array(
            "PRODUCT_ID" => 16904,
            "PRODUCT_PRICE_ID" => 0,
            "PRICE" => $_POST['summ'],
            "CURRENCY" => "RUB",
            "WEIGHT" => 1,
            "QUANTITY" => 1,
            "LID" => LANG,
            "DELAY" => "N",
            "CAN_BUY" => "Y",
            "NAME" => "Предоплата за цветочную и флористическую продукцию",            
        );   
        
        if(CSaleBasket::Add($arFields))
            print_r($_POST['delivery_payment']);
        else
            print_r(false);
    }     
}