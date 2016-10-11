<?
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
foreach($arResult['ITEMS'] as $key => $arItem)
{

	$arResult['ITEMS'][$key]["DETAIL_PAGE_URL"] = $arItem['DETAIL_PAGE_URL'] = "/actions/".$arItem['CODE']."/";
	
}	
?>