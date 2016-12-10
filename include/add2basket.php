<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

CModule::IncludeModule('sale');
CModule::IncludeModule('catalog');
CModule::IncludeModule('currency');


$arProductParams = array(
    array(
        'NAME' => 'Артикул',
        'CODE' => 'CML2_ARTICLE',
        'VALUE' => $_REQUEST['cml2article'],
        'SORT' => 500
    )
);

if ($_REQUEST['add2basket'] == 'Y') {
    Add2BasketByProductID($_REQUEST['id'], $_REQUEST['quantity'], $arProductParams);
}


?>

<? $APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "small_cart", Array(
    "PATH_TO_BASKET" => "/cart/",    // Страница корзины
    "SHOW_NUM_PRODUCTS" => "Y",    // Показывать количество товаров
    "SHOW_TOTAL_PRICE" => "Y",    // Показывать общую сумму по товарам
    "SHOW_EMPTY_VALUES" => "N",    // Выводить нулевые значения в пустой корзине
    "SHOW_PERSONAL_LINK" => "N",    // Отображать персональный раздел
    "PATH_TO_PERSONAL" => SITE_DIR . "personal/",    // Страница персонального раздела
    "SHOW_AUTHOR" => "N",    // Добавить возможность авторизации
    "PATH_TO_REGISTER" => SITE_DIR . "login/",    // Страница регистрации
    "PATH_TO_PROFILE" => SITE_DIR . "personal/",    // Страница профиля
    "SHOW_PRODUCTS" => "Y",    // Показывать список товаров
    "POSITION_FIXED" => "N",    // Отображать корзину поверх шаблона
),
    false
); ?>

