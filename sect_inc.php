<?/*GLOBAL $USER;

if(1):?>

<a class="women_day" href="/catalog/svadebnye_aksessuary/8_marta_valentin/">
    <span style="background: url('/img/8-logo3.png') 0px 0px;" class="ico ico-hover"></span>
    8 МАРТА
</a>

<?elseif(0):?>
<a class="valentine_day" href="/catalog/svadebnye_aksessuary/8_marta_valentin/">
    <span style="background: url('/img/valentine3.png') 0px 0px;" class="ico ico-hover"></span>
    День Валентина
</a>
<?else:?>

<a class="new_year" href="/catalog/svadebnye_aksessuary/novyy_god_1/">
    <span style="background: url('/img/elka3.png') 0px 0px;" class="ico ico-hover"></span>
    НОВЫЙ ГОД
</a>

<?endif;*/?>

<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"left", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
<div id="wrapper-250">
	<?$APPLICATION->IncludeComponent(
		"bitrix:menu", 
		"left_catalog", 
		array(
			"ROOT_MENU_TYPE" => "catalog",
			"MENU_CACHE_TYPE" => "A",
			"MENU_CACHE_TIME" => "3600",
			"MENU_CACHE_USE_GROUPS" => "N",
			"MENU_CACHE_GET_VARS" => array(
			),
			"MAX_LEVEL" => "4",
			"CHILD_MENU_TYPE" => "catalog",
			"USE_EXT" => "Y",
			"DELAY" => "N",
			"ALLOW_MULTI_SELECT" => "N"
		),
		false
	);?>
	<?/*<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"tree_left", 
	array(
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_ID" => "1",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "N",
		"TOP_DEPTH" => "3",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "UF_MAIN_LEVEL",
			1 => "",
		),
		"VIEW_MODE" => "TILE",
		"SHOW_PARENT_NAME" => "Y",
		"SECTION_URL" => "",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_SECTION_NAME" => "N"
	),
	false
);?>*/?>

</div>
<div class='left-block'>
	<h1>ОПЛАТА И ДОСТАВКА</h1>
	<p>Мы принимаем к оплате Visa, MasterCard, электронные деньги. Также можно оплатить, используя баланс мобильного номера или услуги интернет банков (Сбербанк-Онлайн, Альфа-Клик и др.). Расчет онлайн через наш сайт — это быстрый и удобный способ оплатить свой заказ, не выходя из дома.</p>
	<a href='/delivery/'>ПОДРОБНЕЕ</a>
</div>

