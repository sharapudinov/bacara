<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>

<?

	$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter); // выбираем пользователей
	$is_filtered = $rsUsers->is_filtered; // отфильтрована ли выборка ?
	$rsUsers->NavStart(50); // разбиваем постранично по 50 записей
	echo $rsUsers->NavPrint(GetMessage("PAGES")); // печатаем постраничную навигацию
	echo '<br>-----------------<br>';
	while($rsUsers->NavNext(true, "f_")) :
		echo $f_EMAIL.'<br>';	
	endwhile;	  
		  
?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>