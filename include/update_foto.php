<?
$_SERVER['DOCUMENT_ROOT']  =__DIR__.'/..';
require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';
CModule::IncludeModule('iblock');

  $arFilter = Array('IBLOCK_ID'=>1, 'GLOBAL_ACTIVE'=>'Y');
  $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, false);
  while($ar_result = $db_list->GetNext())
  {
    $arSec[strtolower($ar_result['NAME'])] = $ar_result['ID'];
  }

  echo '<pre>';
  var_dump(  $arSec);
  echo '</pre>';
  
$arFilter = Array("IBLOCK_ID"=>1, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $prop = $ob->GetProperties();
 
 
 $color = $prop['TSVET_SAYT']['VALUE'];
 $material  = $PROP['MATERIAL_SAYT']['VALUE'];
 
 $color_arr 	= explode('|', $color);
 $material_arr  = explode('|', $material);
 
 CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, array("color_real"=>$color_arr, "material_real" => $material_arr));
 
 $sec = explode('|', $prop['DEREVOTOVAROV']['VALUE']);
 $secID = array();
 $sec2 = array();
 if(count($sec) > 0) { 
	foreach($sec as $sName) {
		$sec2[] = strtolower($sName);
		if($arSec[strtolower($sName)])
			$secID[] =  $arSec[strtolower($sName)];
	}
 }
 if(count($secID) > 0) { 
	$el = new CIBlockElement;
	$el->Update($arFields['ID'], array("IBLOCK_SECTION" => $secID));
	
//	CIBlockElement::SetElementSection($arFields['ID'], $secID, false, 1);
	$el->RecalcSections($arFields['ID']);
 }

	var_dump($arFields['ID'], $secID, $sec2,  $sec);
	echo '<br /><hr />';


 



}

?>
