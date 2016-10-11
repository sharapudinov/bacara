<?
foreach($arResult['ITEMS']['AnDelCanBuy'] as $arItem) {
    $ids[] = $arItem['PRODUCT_ID'];
}

$rsElement = CIBlockElement::GetList(array(), array("ID"=>$ids), false, false, array("ID", "NAME" , "PROPERTY_KOLICHESTVO_V_UPAKOVKE"));
while($obElement = $rsElement->Fetch())
{
    $arResult['KOLICHESTVO_V_UPAKOVKE'][$obElement['ID']] = $obElement['PROPERTY_KOLICHESTVO_V_UPAKOVKE_VALUE'];
}