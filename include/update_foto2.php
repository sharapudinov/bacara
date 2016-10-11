<?
$_SERVER['DOCUMENT_ROOT']  = '/var/www/bacara-decor.ru/httpdocs';
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
 



$foto = explode('|', $prop['KARTINKI_SAYT']['VALUE']);

if(is_array($foto) && count($foto) > 0) {  

	//$path1 = CFile::GetPath($arFields['PREVIEW_PICTURE']);
	$path2 = CFIle::GetPath($arFields['DETAIL_PICTURE']);
	
	//$p1 = is_file($_SERVER['DOCUMENT_ROOT'].$path1);
	$p2 = is_file($_SERVER['DOCUMENT_ROOT'].$path2);


	if(!$arFields['PREVIEW_PICTURE'] || !$arFields['DETAIL_PICTURE'] || !$p2) { 
	
	
	echo $_SERVER['DOCUMENT_ROOT'].'/upload/foto/'.$foto[0].'<br />';
	$a++;
	
	if(!is_file($_SERVER['DOCUMENT_ROOT'].'/upload/foto/'.$foto[0]))
		$foto[0] = strtoupper($foto[0]);
	
		if(is_file($_SERVER['DOCUMENT_ROOT'].'/upload/foto/'.$foto[0])) { 
			$el = new CIBlockElement;
			
			$el->Update($arFields['ID'], array( 
				"PREVIEW_PICTURE" => CFile::MakeFileArray($_SERVER['DOCUMENT_ROOT'].'/upload/foto/'.$foto[0]),
				"DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER['DOCUMENT_ROOT'].'/upload/foto/'.$foto[0]),
			), false, false, false);
		}
} 

	if(count($foto) > 1) { 
		$PROP['MORE_PHOTO'] = array();
		if(!is_array($prop['MORE_PHOTO']['VALUE']) || count($prop['MORE_PHOTO']['VALUE']) < (count($foto)-1))
		{
			foreach($foto as $key=>$val) { 
				if($key == 0) Continue;
				if(!is_file($_SERVER['DOCUMENT_ROOT'].'/upload/foto/'.$val))
				 $val = strtoupper($val);
				$PROP['MORE_PHOTO'][] = CFile::MakeFileArray($_SERVER['DOCUMENT_ROOT'].'/upload/foto/'.$val);
			}
			CIBlockElement::SetPropertyValueCode($arFields['ID'], 'MORE_PHOTO', $PROP['MORE_PHOTO']);
		}
	}
	
}
 


}

?>
