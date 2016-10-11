<?$APPLICATION->IncludeComponent("bitrix:menu", "sub_nav", Array(
	"ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
		"MENU_CACHE_TIME" => "36000",	// Время кеширования (сек.)
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
		"MAX_LEVEL" => "1",	// Уровень вложенности меню
		"CHILD_MENU_TYPE" => "top",	// Тип меню для остальных уровней
		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
	),
	false
);?>

<?if(CModule::IncludeModule('sale')):?>
    
    <?    
    $db_sales = CSaleOrderUserProps::GetList(
        array("DATE_UPDATE" => "DESC"),
        array("USER_ID" => $USER->GetID())
    );

    if($ar_sales = $db_sales->Fetch()):
    ?>


        <?$APPLICATION->IncludeComponent(
            "baccara:get_balance",
            "",
            Array(
            )
        );?>

    <?endif;?>
<?endif;?>