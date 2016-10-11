<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>

<?


CModule::includeModule('iblock');	  
		  
        
    $arFilter = Array(
        "IBLOCK_ID"                 =>  1,
        "SECTION_ID"                =>  109,
        "!PROPERTY_MATERIAL_SAYT"   =>  false, 
        "ACTIVE"                    =>  "Y",
    );
    
    $arSelect = Array(
        "ID", 
        "IBLOCK_ID", 
        "NAME", 
        "PROPERTY_MATERIAL_SAYT",
        "PROPERTY_material_real",
    );
    
    
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->Fetch()){
        $arMat = explode('|', $ob['PROPERTY_MATERIAL_SAYT_VALUE']);
        //$result[] = $ob;
        
        CIBlockElement::SetPropertyValueCode($ob['ID'], "material_real", $arMat);
    }



?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>