<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>            
<?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view", 
	".default", 
	array(
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.79802325195567;s:10:\"yandex_lon\";d:37.63137655225398;s:12:\"yandex_scale\";i:16;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.631376552254;s:3:\"LAT\";d:55.798021741062;s:4:\"TEXT\";s:127:\"ООО «Блэк Баккара» Россия, Москва, Рижская площадь , дом 9 , строение 2А.\";}}}",
		"MAP_WIDTH" => "100%",
		"MAP_HEIGHT" => "400",
		"CONTROLS" => array(
			0 => "ZOOM",
			1 => "MINIMAP",
			2 => "TYPECONTROL",
			3 => "SCALELINE",
		),
		"OPTIONS" => array(
			0 => "ENABLE_DBLCLICK_ZOOM",
			1 => "ENABLE_DRAGGING",
		),
		"MAP_ID" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
 <br>
 <b>Адрес Cash&amp;Carry и офиса продаж:</b><br>
 <br>
 Россия, Москва, Рижская площадь, дом 9, строение 2А. <br>
 <br>
 <b>График работы Сash&amp;Сarry:</b><br>
 <br>
 с 6:30 до 20:00<br>
 Без перерывов, без выходных.<br>
 <br>
 <b>Телефоны для консультаций:</b><br>
 <br>
 <a class="telefon_ref" href="tel:+74957225855">+7 (495) 722-58-55</a><br>
 <a class="telefon_ref" href="tel:+79037225855">+7 (903)&nbsp;722-58-55</a><br>
 <br>
 E-mail для соискателей: <a href="mailto:hr@black-baccara.ru">hr@black-baccara.ru</a> <br>
 E-mail для коммерческих предложений: <a href="mailto:info@black-baccara.ru">info@black-baccara.ru</a> <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>