<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';



if(isset($_POST['item_id']) && $_POST['item_id'] > 0) {
    
    if(CModule::IncludeModule('sale')) {
        
        if(CSaleBasket::Delete($_POST['item_id'])) {
            
                /* $APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "small_cart", Array(
                    "PATH_TO_BASKET" => "/cart/",	// Страница корзины
                        "SHOW_NUM_PRODUCTS" => "Y",	// Показывать количество товаров
                        "SHOW_TOTAL_PRICE" => "Y",	// Показывать общую сумму по товарам
                        "SHOW_EMPTY_VALUES" => "N",	// Выводить нулевые значения в пустой корзине
                        "SHOW_PERSONAL_LINK" => "N",	// Отображать персональный раздел
                        "PATH_TO_PERSONAL" => SITE_DIR."personal/",	// Страница персонального раздела
                        "SHOW_AUTHOR" => "N",	// Добавить возможность авторизации
                        "PATH_TO_REGISTER" => SITE_DIR."login/",	// Страница регистрации
                        "PATH_TO_PROFILE" => SITE_DIR."personal/",	// Страница профиля
                        "SHOW_PRODUCTS" => "Y",	// Показывать список товаров
                        "POSITION_FIXED" => "N",	// Отображать корзину поверх шаблона
                    ),
                    false
                ); */
                
                    $dbItems = CSaleBasket::GetList(
                        array("ID" => "ASC"),
                        array(
                            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                            "LID" => SITE_ID,
                            "ORDER_ID" => "NULL"
                        ),
                        false,
                        false,
                        array("ID", "NAME", "PRODUCT_ID", "QUANTITY", "PRICE")
                    );
                    
                    $arGoods = array();
                    $arGoods['FULL_SUMM'] = 0;
                    $arGoods['FULL_COUNT'] = 0;
                    
                    while ($arItem = $dbItems->GetNext())
                    {
                        $arGoods['PROPS'][] = $arItem;
                        $arGoods['FULL_SUMM'] += $arItem['QUANTITY'] * $arItem['PRICE'];
                        $arGoods['FULL_COUNT'] += $arItem['QUANTITY'];
                    }
                                        
                    $arGoods['IN_CART'] = '<a class="cart_link" href="/cart/">Корзина:</a> '.$arGoods['FULL_COUNT'].' товаров на сумму '.number_format($arGoods['FULL_SUMM'], 2, '.', ' '). ' руб.';
                    $arGoods['FULL_SUMM'] = number_format($arGoods['FULL_SUMM'], 2, '.', ' ');
                    
                    print_r(json_encode($arGoods));
        }
    }     
}