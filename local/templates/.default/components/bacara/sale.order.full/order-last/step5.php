<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if (!$arResult['CONFIRMED']): ?>
    <div class="oferta-wrap">
        <img width="50" src="<?= SITE_TEMPLATE_PATH ?>/images/i35003.png"> <span
            style="color:red;">Обратите внимание!</span>
        подтверждая заказ, вы соглашаетесья с <a href="#oferta" class="oferta-href">офертой.</a>

        <!-- Ссылки на вызов модальных окон-->

        <a class="overlay" id="oferta"></a>
        <div class="popup oferta-popup">
            <?= $arResult['OFERTA'] ?>
            <div style="text-align:center;" class="oferta-wrapper">
                <label class="label-of-wrap" style="display:inline-block;">
                        <span class="oferta-cb-wrap">
                            <input class="checkbox-oferta" type="checkbox">
                            Принимаю оферту
                        </span>
                </label>
                <a id="close_ofert" class="submit-ofert button confirm_ofert" href="#close"
                   data="<?= $arResult['REQUIRED_OFERT'] ?>">Подтвердить</a>
            </div>

            <a class="close" title="Закрыть" href="#close"></a>
        </div>

    </div>
<? endif; ?>
<div class="order_confirm_tile">
    <div class="order_confirm_block">
        <?
        if (!empty($arResult["ORDER_PROPS_PRINT"])) {
            ?>


            <?
            foreach ($arResult["ORDER_PROPS_PRINT"] as $arProperties) {
                if ($arProperties["SHOW_GROUP_NAME"] == "Y") {
                    ?>
                    <div class="order_confirm_title"><?= $arProperties["GROUP_NAME"] ?></div>
                    <?
                }
                if (strLen($arProperties["VALUE_FORMATED"]) > 0) {
                    ?>
                    <?/*<?= $arProperties["NAME"] ?>:*/
                    ?>
                    <div class="order_prop"><?= $arProperties["VALUE_FORMATED"] ?></div>
                    <?
                }
            }
            ?>

            <?
        }
        ?>
    </div>
    <div class="order_confirm_block">
        <div class="order_confirm_title">Данные покупателя:</div>
        <div class="order_properties">
            <?
            $q = 0;
            foreach ($arResult["BASKET_ITEMS"] as $arBasketItems) {
                $q += $arBasketItems['QUANTITY'];
            }
            ?>
            <div class="order_prop">Товаров: <?= $q ?></div>
            <div class="order_prop">На сумму <? /*<span class="base_summ">48 000 руб.</span>*/ ?><span
                    class="discount_summ"><?= $arResult["ORDER_TOTAL_PRICE_FORMATED"] ?></span></div>
            <? if (floatval($arResult['DELIVERY_PRICE']) > 0) { ?>
                <div class="order_prop">Включая стоимость доставки <?= $arResult["DELIVERY_PRICE_FORMATED"] ?></div>
            <? } ?>

            <? /*
				<a href="#" class="sale_info">
					<span class="sale_ribbon">Ваша скидка 10%</span>
					<span class="sale_info_name">Ваша дополнительная скидка за первый заказ 10%</span>
				</a>*/ ?>
        </div>
    </div>
    <br clear="both"/>
    <div class="order_confirm_block">
        <div class="order_confirm_title">Оплата и доставка:</div>
        <div class="order_properties">
            <div class="order_prop">Оплата:
                <?
                if ($arResult["PAYED_FROM_ACCOUNT"] == "Y")
                    echo " (" . GetMessage("STOF_PAYED_FROM_ACCOUNT") . ")";
                elseif (is_array($arResult["PAY_SYSTEM"])) {
                    echo $arResult["PAY_SYSTEM"]["PSA_NAME"];
                } elseif ($arResult["PAY_SYSTEM"] == "ERROR") {
                    echo ShowError(GetMessage("SALE_ERROR_PAY_SYS"));
                } elseif ($arResult["PAYED_FROM_ACCOUNT"] != "Y") {
                    echo GetMessage("STOF_NOT_SET");
                }

                ?>
            </div>
            <div class="order_prop">Доставка:
                <?
                //echo "<pre>"; print_r($arResult); echo "</pre>";
                if (is_array($arResult["DELIVERY"])) {
                    echo $arResult["DELIVERY"]["NAME"];
                    if (is_array($arResult["DELIVERY_ID"])) {
                        echo " (" . $arResult["DELIVERY"]["PROFILES"][$arResult["DELIVERY_PROFILE"]]["TITLE"] . ")";
                    }
                } elseif ($arResult["DELIVERY"] == "ERROR") {
                    echo ShowError(GetMessage("SALE_ERROR_DELIVERY"));
                } else {
                    echo GetMessage("SALE_NO_DELIVERY");
                }
                ?>
            </div>

        </div>
    </div>
    <div class="order_confirm_block">
        <div class="order_confirm_title">Комментарий:</div>
        <div class="input_group">
            <textarea rows="2" name="ORDER_DESCRIPTION"><?= $arResult["ORDER_DESCRIPTION"] ?></textarea>
        </div>
    </div>
    <div class="clr"></div>
</div>
<div class="order_complete">
    <input type="submit" value="подтвердить заказ" name="contButton" class="button" id="confirm_order"
           data="<?= $arResult['REQUIRED_OFERT'] ?>">
</div>
