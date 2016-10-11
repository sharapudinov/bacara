<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult["TAGS_CHAIN"] = array();
if($arResult["REQUEST"]["~TAGS"])
{
	$res = array_unique(explode(",", $arResult["REQUEST"]["~TAGS"]));
	$url = array();
	foreach ($res as $key => $tags)
	{
		$tags = trim($tags);
		if(!empty($tags))
		{
			$url_without = $res;
			unset($url_without[$key]);
			$url[$tags] = $tags;
			$result = array(
				"TAG_NAME" => htmlspecialcharsex($tags),
				"TAG_PATH" => $APPLICATION->GetCurPageParam("tags=".urlencode(implode(",", $url)), array("tags")),
				"TAG_WITHOUT" => $APPLICATION->GetCurPageParam((count($url_without) > 0 ? "tags=".urlencode(implode(",", $url_without)) : ""), array("tags")),
			);
			$arResult["TAGS_CHAIN"][] = $result;
		}
	}
}

foreach($arResult["SEARCH"] as &$arItem) {
    $res = CIBlockElement::GetByID($arItem['ITEM_ID']);
    if($ar_res = $res->GetNext())
        $img_code = $ar_res['DETAIL_PICTURE'];
    
    $arItem['IMAGE'] = CFile::GetFileArray($img_code);
    if(is_array($arItem['IMAGE']))
        {
            $arFileTmp = CFile::ResizeImageGet(
                $arItem["IMAGE"],
                array("width" => 150, "height" => 150),
                BX_RESIZE_IMAGE_PROPORTIONAL,
                true
            );

           $arItem['IMAGE'] = array(
                "SRC" => $arFileTmp["src"],
                "WIDTH" => $arFileTmp["width"],
                "HEIGHT" => $arFileTmp["height"],
            );
        }
}

/* if(CModule::IncludeModule("iblock")) {
    $res = CIBlockElement::GetByID(16608);
    
    
    $img = CFile::GetFileArray($test["DETAIL_PICTURE"]); 
    
    echo '<pre>'; print_r($img); echo '</pre>';
} */
