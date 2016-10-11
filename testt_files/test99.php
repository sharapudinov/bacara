<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>

<?

//$arFields['IBLOCK_ID'] = 1;
//$arFields['ID'] = 15558;

global $USER;


function delAllPhoto($arFields) {

	$db_props = CIBlockElement::GetProperty($arFields['IBLOCK_ID'], $arFields['ID'], "sort", "asc", Array("CODE"=>"MORE_PHOTO"));
	while($ar_props = $db_props->Fetch())
	{				
		$arr[$ar_props['PROPERTY_VALUE_ID']] = Array("VALUE" => Array("del" => "Y"));
		CIBlockElement::SetPropertyValueCode($arFields['ID'], "MORE_PHOTO", $arr);
	}

}

if($USER->IsAdmin()) {
	$arFilter = Array(
		"IBLOCK_ID" => 1,
		">=ID" => 18341,
		"<=ID" => 18645,
	);


	$arSelect = Array(
		"ID",
		"IBLOCK_ID",
		"NAME",
	);

	$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	while ($ob = $res->Fetch()) {
		$arRes[] = $ob;
	}

	//echo '<pre>'; print_r($arRes); echo '</pre>';

	foreach($arRes as $item) {
		delAllPhoto($item);
	}
}
?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>