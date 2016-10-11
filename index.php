<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Предлагаем купить аксессуары для флористики оптом в интернет-магазине «Баккара Декор»");
$APPLICATION->SetPageProperty('description', 'Интернет магазин аксессуаров для цветов «Баккара Декор» предлагает оптом элементы декора и флористики в ассортименте.');
$APPLICATION->SetPageProperty('keywords', 'оптовый магазин флористики');

$APPLICATION->SetPageProperty('NOT_SHOW_NAV_CHAIN', 'Y');
?>

<?
global $arrFilterBestseller;
$arrFilterBestseller['PROPERTY_best'] = 1;
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"mainpage", 
	array(
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_ID" => "1",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilterBestseller",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"PAGE_ELEMENT_COUNT" => "2",
		"LINE_ELEMENT_COUNT" => "2",
		"PROPERTY_CODE" => array(
			0 => "CML2_ARTICLE",
			1 => "SALE_OLD_PRICE",
			2 => "",
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
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"COMPONENT_TEMPLATE" => "mainpage"
	),
	false
);
?>


					
					
				<?$APPLICATION->IncludeComponent(
					"bitrix:catalog.section.list",
					"mainpage",
					Array(
						"IBLOCK_TYPE" => "1c_catalog",
						"IBLOCK_ID" => "1",
						"SECTION_ID" => "",
						"SECTION_CODE" => "",
						"COUNT_ELEMENTS" => "N",
						"TOP_DEPTH" => "1",
						"SECTION_FIELDS" => array("PICTURE", ""),
						"SECTION_USER_FIELDS" => array("", ""),
						"VIEW_MODE" => "TILE",
						"SHOW_PARENT_NAME" => "Y",
						"SECTION_URL" => "",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "36000000",
						"CACHE_GROUPS" => "N",
						"ADD_SECTIONS_CHAIN" => "N",
						"HIDE_SECTION_NAME" => "N"
					)
				);?>
                
                <div>
	<h1>&laquo;Баккара Декор&raquo; - аксессуары для профессиональной флористики</h1>
	<p>Интернет <strong style="font-weight: normal;">магазин</strong> &laquo;Баккара Декор&raquo; - один из главных <strong style="font-weight: normal;">оптовых</strong> поставщиков элементов декора и <strong style="font-weight: normal;">флористики</strong> в России, с которым сотрудничают многие профессиональные дизайнерские студии, флористы и оформители. Мы всегда рады новым партнерам и заказчикам, гарантируя качество всей имеющейся в наших виртуальных залах продукции, произведенной в разных странах мира. Работая в этом сегменте рынка уже на протяжении более чем десяти лет, наш <strong style="font-weight: normal;">оптовый магазин</strong> выработал собственную стратегию, основой которой является тщательный подбор элементов декора и <strong style="font-weight: normal;">флористики</strong> для творческих экспериментов наших клиентов. Мы сотрудничаем только с теми производителями, которые изготавливают действительно качественные продукты, эксклюзивные и привлекательные. Поэтому география наших закупок простирается по всему миру &ndash; Германия, Польша, Италия, Дания, Китай, Кения, Филиппины и множество других стран, где производятся достойные дизайнерские аксессуары. Мы постоянно проводим маркетинговые исследования рынка, чтобы пополнять каталог магазина интересными для наших клиентов новинками и уверены, что вы, однажды поработав с нами, войдете в список постоянных клиентов и партнеров.</p>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>