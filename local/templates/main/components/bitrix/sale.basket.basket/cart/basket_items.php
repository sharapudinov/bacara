<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
echo ShowError($arResult["ERROR_MESSAGE"]);

$bDelayColumn  = false;
$bDeleteColumn = false;
$bWeightColumn = false;
$bPropsColumn  = false;
$bPriceType    = false;

if ($normalCount > 0):
//echo '<pre>';
//var_dump($arResult['ITEMS']['AnDelCanBuy'][0]);
//echo '</pre>';
?>


<div id="basket_items_list">
	<div class="bx_ordercart_order_table_container">


	<div class="basket_items catalog_list">
		<table>
			<tbody><tr>
				<th class="basket_item_name">Описание товара</th>
				<th class="price_col">Цена за шт.</th>
				<th class="qt_col">Кол-во</th>
				<th class="summ_col">Сумма</th>
				<th class="remove_col">Удалить</th>
			</tr>
			<?foreach($arResult['ITEMS']['AnDelCanBuy'] as $arBasketFields) {
		
			$picture['src'] = $arBasketFields['DETAIL_PICTURE_SRC'];
			if(!$picture['src'] ) { 
				$picture['src'] = '/upload/foto/blank.jpg';
				$picture['width'] = 110;
				$picture['height'] = 110;				
			}
			?>
			<tr>
				<td class="basket_item_name"> 
					<div class="basket_item_info">
						<a class="catalog_item_name" href="<?=$arBasketFields['DETAIL_PAGE_URL']?>"><img width="<?=$picture['width']?>" alt="" src="<?=$picture['src']?>"></a>
						<a class="catalog_item_name" href="<?=$arBasketFields['DETAIL_PAGE_URL']?>"><?=$arBasketFields['NAME']?></a>
						<?/*<div class="catalog_item_properties">
							<div class="catalog_item_prop">Артикул 678493</div>
							<div class="catalog_item_prop">Размер: 40х40</div>
							<div class="catalog_item_prop">Цвет: зеленый</div>
						</div>*/?>
					</div>
				</td>
				<td>
					<div class="base_prise_value basket_item_cost"><span class="value"><?=$arBasketFields['PRICE']?></span> <span class="ico"></span></div>
				</td>
				<td>
				<input count_val="<?=($arResult['KOLICHESTVO_V_UPAKOVKE'][$arBasketFields['PRODUCT_ID']]) ? $arResult['KOLICHESTVO_V_UPAKOVKE'][$arBasketFields['PRODUCT_ID']] : 1;?>" type="text" class="qt_mod quantity_in_cart" value="<?=$arBasketFields['QUANTITY']?>"  step="0" max="1" min="0" maxlength="18" name="QUANTITY[<?=$arBasketFields['ID']?>]" id="QUANTITY_INPUT_<?=$arBasketFields['ID']?>" size="3">
				<input count_val="<?=($arResult['KOLICHESTVO_V_UPAKOVKE'][$arBasketFields['PRODUCT_ID']]) ? $arResult['KOLICHESTVO_V_UPAKOVKE'][$arBasketFields['PRODUCT_ID']] : 1;?>" type="hidden" value="<?=$arBasketFields['QUANTITY']?>"  step="0" max="1" min="0" maxlength="18" name="QUANTITY_<?=$arBasketFields['ID']?>" id="QUANTITY_<?=$arBasketFields['ID']?>" size="3">				
				</td>
				<td>
					<div class="base_prise_value basket_item_summ" id="all_price<?=$arBasketFields['ID']?>"><span class="value"><?=number_format($arBasketFields['PRICE']*$arBasketFields['QUANTITY'], 2, '.', ' ')?></span> <span class="ico"></span></div>
				</td>
				<td>
                    <?if(1):?>
                        <input type="checkbox" name="del_position[]" class="del_position" value="<?=$arBasketFields['ID']?>">
                    <?else:?>
                        <a class="remove_basket_position" href="?action=delete&id=<?=$arBasketFields['ID']?>"></a>
                    <?endif;?>    
				</td>
			</tr>
			<? } ?>
		</tbody></table>
	
        <?if(1):?>
            <div style="float:right;"><a class="button del_marked" href="javascript:void(0);">Удалить отмеченные</a></div>
            <div style="clear:both;"></div>
        <?endif;?>
    </div>
    
	<div class="basket_footer">
		<a class="back_link" href="/catalog/"><span class="ico"></span>назад к покупкам</a>
		<div class="basket_total">Итого: <span class="basket_total_value"><?=number_format($arResult["allSum"], 2, '.', ' ')?></span></div>
		<div class="clr"></div>
		<a class="button order_button" href="/order/" >оформить заказ</a>
		<div class="clr"></div> 
	</div>

	
	
	</div>
	<input type="hidden" id="column_headers" value="<?=CUtil::JSEscape(implode($arHeaders, ","))?>" />
	<input type="hidden" id="offers_props" value="<?=CUtil::JSEscape(implode($arParams["OFFERS_PROPS"], ","))?>" />
	<input type="hidden" id="action_var" value="<?=CUtil::JSEscape($arParams["ACTION_VARIABLE"])?>" />
	<input type="hidden" id="quantity_float" value="<?=$arParams["QUANTITY_FLOAT"]?>" />
	<input type="hidden" id="count_discount_4_all_quantity" value="<?=($arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="price_vat_show_value" value="<?=($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="hide_coupon" value="<?=($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="coupon_approved" value="N" />
	<input type="hidden" id="use_prepayment" value="<?=($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N"?>" />

	<div class="bx_ordercart_order_pay">

		<div class="bx_ordercart_order_pay_left">
			<div class="bx_ordercart_coupon">
				<?
				if ($arParams["HIDE_COUPON"] != "Y"):

					$couponClass = "";
					if (array_key_exists('VALID_COUPON', $arResult))
					{
						$couponClass = ($arResult["VALID_COUPON"] === true) ? "good" : "bad";
					}
					elseif (array_key_exists('COUPON', $arResult) && !empty($arResult["COUPON"]))
					{
						$couponClass = "good";
					}

				?>
					<span><?=GetMessage("STB_COUPON_PROMT")?></span>
					<input type="text" id="coupon" name="COUPON" value="<?=$arResult["COUPON"]?>" onchange="enterCoupon();" size="21" class="<?=$couponClass?>">
				<?else:?>
					&nbsp;
				<?endif;?>
			</div>
		</div>
	</div>
</div>
<?
else:
?>
		<div id="basket_items_list">
		<div class="basket_items catalog_list basket_empty">
			<p>У Вас пока нет ни одного товара.<br>Начните покупки прямо сейчас :)</p>
		</div>
		</div>
<?
endif;
?>