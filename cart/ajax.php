<?
require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';
CModule::IncludeModule('iblock');
CModule::IncludeModule('sale');
CModule::IncludeModule('catalog');

if($_POST['QUANTITY'] && is_array($_POST['QUANTITY'])) { 
	foreach($_POST['QUANTITY'] as $key=> $q) { 
		CSaleBasket::Update($key, array("QUANTITY" => $q));
	}
}

$arBasketItems = array();

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
        array("ID", "CALLBACK_FUNC", "MODULE", 
              "PRODUCT_ID", "QUANTITY", "DELAY", 
              "CAN_BUY", "PRICE", "WEIGHT")
    );
$q = 0;
$price = 0;
while ($arItems = $dbBasketItems->Fetch())
{
    $arBasketItems[] = $arItems;
	
	if($arItems['CAN_BUY'] == 'Y') { 
		$arrItem[$arItems['ID']] = $arItems['PRICE'] * $arItems['QUANTITY'];
		$q += $arItems['QUANTITY'];
		$price += $arItems['QUANTITY'] * $arItems['PRICE'];
	}
}

$arr = array(
	"PRICE" => $price,
	"ITEMS" => $arrItem
);
echo json_encode($arr);
?>