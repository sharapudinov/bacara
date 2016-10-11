<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => "Отображение спец. цен",
	"DESCRIPTION" => "Отображение суммы в корзине в спец. ценах",
	"ICON" => "/images/news_list.gif",
	"SORT" => 20,
//	"SCREENSHOT" => array(
//		"/images/post-77-1108567822.jpg",
//		"/images/post-1169930140.jpg",
//	),
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "baccara",
		"CHILD" => array(
			"ID" => "cart_prices",
			"NAME" => "Отображение спец. цен",
			"SORT" => 10,
	),
);

?>