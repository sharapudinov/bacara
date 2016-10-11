<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$file = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array('width'=>180, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true); 
?>
	<?if($file) { ?>
	<img src="<?=$file['src']?>" style="float: left; margin-right: 20px;" alt="">
	<? } ?>
	<?=$arResult['DETAIL_TEXT']?>
	<p>&nbsp;</p>
	<div class="clr"></div>
	<?if(is_array( $arResult['PROPERTIES']['prods']['VALUE']) && count( $arResult['PROPERTIES']['prods']['VALUE']) > 0) { ?>
	<h3>ТОВАРЫ, УЧАСТВУЮЩИЕ В АКЦИИ</h3>
	
<div class="catalog_items catalog_tile">
<? 

global $arrFilterAction;
$arrFilterAction['ID'] = $arResult['PROPERTIES']['prods']['VALUE'];
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"action", 
	array(
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_ID" => "1",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "SORT",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilterAction",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"PAGE_ELEMENT_COUNT" => "99",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "CML2_ARTICLE",
			1 => "",
			2 => "",
			3 => "",
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_LIMIT" => "5",
		"TEMPLATE_THEME" => "blue",
		"PRODUCT_DISPLAY_MODE" => "N",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_COMPARE" => "Сравнить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"SET_STATUS_404" => "N",
		"CACHE_FILTER" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => array(
			0 => "Оптовая",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/cart/",
		"USE_PRODUCT_QUANTITY" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"OFFERS_CART_PROPERTIES" => array(
		),
		"ADD_TO_BASKET_ACTION" => "ADD",
		"DISPLAY_COMPARE" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"BROWSER_TITLE" => "-",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity"
	),
	false
);
?>
</div>	
<? } ?>
<?/*
	<div class="catalog_items catalog_tile">
		<div class="catalog_item catalog_sale">
			<a href="#" class="sale_info">
				<span class="sale_ribbon"><span class="ico"></span> акция</span>
				<span class="sale_info_name">Весенние скидки только до 30 апреля</span>
			</a>
			<div class="catalog_item_info">
				<img src="img/catalog_item_1.png" width="180" alt="">
				<a href="#" class="catalog_item_name">Оазис идеал шар 40х40</a>
				<div class="catalog_item_properties">
					<div class="catalog_item_prop">Артикул 678493</div>
					<div class="catalog_item_prop">Размер: 40х40</div>
					<div class="catalog_item_prop">Цвет: зеленый</div>
				</div>
			</div>
			<div class="catalog_item_price_block">
				<div class="base_price">
					<span>Цена</span>
					<div class="base_prise_value">250 <span class="ico"></span></div>
				</div>
				<div class="cart-button">
					<input name="число" value="1"><a href="#"><span>В КОРЗИНУ</span></a>
				</div>
				<div class="clr"></div>
			</div>
		</div>
	</div>*/?>