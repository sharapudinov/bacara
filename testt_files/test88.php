<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>

<?
$str1 = 'Ваза "Мини - Флорариум"';
$str2 = 'Ваза "Мини - Флорариум"';
		  
    if($str1 == $str2) {
        echo 'succ';
    }
    else echo 'nope';
   
    
?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>