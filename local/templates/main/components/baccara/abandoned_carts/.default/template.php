<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//echo '<pre>'; print_r($arResult['CARTS']); echo '</pre>';

?>
<style>
    .main_carts_table {
        text-align:center;
        color: #111;
    }
    
    .main_carts_table tr:nth-child(2n) {
        background-color: #ddd;
    }
    
    .cart_letter_text-wrap {
        display: none;
    }
    
    .cart_letter_text {
        resize: none;
        width:500px;
        height:200px;
    }
</style>

<?if(!$arResult['SEND_LETTER_SUCCESS']):?>
    <form method="post">
        <input type="hidden" class="letter_receiver" name="letter_receiver" value="">
        <table class="main_carts_table">
            <tr>
                <th>Имя Клиента</th>
                <th>Почта Клиента</th>
                <th>Телефон Клиента</th>
                <th>Дата последнего добавления</th>
                <th>Общая сумма товаров в корзине</th>
                <th>Запись в админке</th>
                <th>Отправить письмо</th>
            </tr>
            <?foreach($arResult['CARTS'] as $user_id => $cart):?>
                <tr>
                    <td><?=$arResult['USERS'][$user_id]['NAME'].' '.$arResult['USERS'][$user_id]['LAST_NAME']?></td>
                    <td><?=$arResult['USERS'][$user_id]['EMAIL']?></td>
                    <td><?=$arResult['USERS'][$user_id]['PERSONAL_PHONE']?></td>
                    <td><?=$cart['DATE_UPDATE']?></td>
                    <td style="color:green;"><?=$cart['AMOUNT_SUMM'].' руб.'?></td>
                    <td><a target="_blank" href="/bitrix/admin/sale_basket.php?PAGEN_1=1&SIZEN_1=20&lang=ru&set_filter=Y&adm_filter_applied=0&filter_user_id=<?=$user_id?>">Посмотреть</a></td>
                    <td><a class="send_letter-href" email_to="<?=$arResult['USERS'][$user_id]['EMAIL']?>" user_id = <?=$user_id?> href="javascript:void(0);">Отправить</a></td>
                </tr>
            <?endforeach;?>
        </table>
        <br><hr><br>
        <div class="cart_letter_text-wrap">
            <p>Email to: <span style="color:#000; font-weight:bold;" class="email_to"></span></p>
            <p>Тема письма: <input type="text" name="letter_theme" class="letter_theme"></p>
            <textarea class="cart_letter_text" name="letter_text">
                Текст письма...
            </textarea>
            <br>
            <button name="send_letter-submit">Отправить</button>
        </div>
        
        
    </form>
<?else:?>
    <div>
        Письмо успешно отправлено!<br>
        <a href="/abandoned_carts.php">Вернуться к списку корзин</a>
    </div>
<?endif;?>