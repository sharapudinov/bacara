<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>

<?

/*         $rsUser = CUser::GetByID(65);
        $test = $rsUser->Fetch(); 
        $file = CFile::GetFileArray($test['UF_DOCS'][4]);

        file_put_contents($_SERVER['DOCUMENT_ROOT']. '/debug_alexkonst3.log',
          PHP_EOL . print_r($file, true), FILE_APPEND);   */
		  
/* 	CModule::includeModule('iblock');	  
		  
        
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
    } */
    
/*     echo '<pre>'; print_r($result); echo '</pre>';
    echo '<pre>'; print_r($arMat); echo '</pre>'; */
		  
		echo date("m.d.y", filectime($_SERVER["DOCUMENT_ROOT"]."/upload/iblock/4d6/4d6f4387b53204130853caa32c652411.jpg"));
        
		//  echo '<pre>'; print_r($_REQUEST); echo '</pre>';
?>
<?/*
<script>
  $(function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#amount" ).val(ui.values[ 0 ] + "-" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) +
      " - " + $( "#slider-range" ).slider( "values", 1 ) );
  });
  </script>
    
    <form method="post">
        <p>
          <label for="amount">Высота в см:</label>
          <input name="amount" type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;">
        </p>
        <button>Применить</button>
    </form>
  
  <div id="slider-range"></div>
*/?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>