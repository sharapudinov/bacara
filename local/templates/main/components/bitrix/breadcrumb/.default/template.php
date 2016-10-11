<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '<div class="kroshki">';

$num_items = count($arResult);
$first = true;
for($index = 0, $itemSize = $num_items; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	
	if(!$first) $strReturn .= ' > ';
	
	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
		$strReturn .= ' <a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a> ';
	else
		$strReturn .= ' <span>'.$title.'</span> ';
		
	$first = false;
}

$strReturn .= '</div>';

return $strReturn;
?>