<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//Make all properties present in order
//to prevent html table corruption
foreach($arResult["ITEMS"] as $key => $arElement)
{
	$arRes = array();
	foreach($arParams["PROPERTY_CODE"] as $pid)
	{
		$arRes[$pid] = CIBlockFormatProperties::GetDisplayValue($arElement, $arElement["PROPERTIES"][$pid], "catalog_out");
	}
	$arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"] = $arRes;
}

$arFilter = Array("IBLOCK_ID"=>5, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("SORT" => "DESC", "ID" => "ASC"), $arFilter, false, Array("nTopCount"=>100), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $arFields['PROPERTIES'] = $ob->GetProperties();
 foreach($arFields['PROPERTIES']['prods']['VALUE'] as $prod)  { 
	$arResult['ACTION'][$prod] = array("NAME" => $arFields['NAME'], "DETAIL_PAGE_URL" => $arFields['DETAIL_PAGE_URL']);
 }
}	
?>