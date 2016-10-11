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

//echo '<pre>';
//var_dump($arResult['ITEMS'][0]); 
//echo '</pre>';die();
?>

<?foreach($arResult['ITEMS'] as $arItem) { 

	$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>180, 'height'=>180), BX_RESIZE_IMAGE_EXACT, true);
	if(!$file) { 
	 $file['src'] = '/img/logo.png';
	 $file['width'] = 180;
	 $file['height'] = 180;
	}
?>
	<div class='luchshee catalog_item_price_block'>
		<div class='product-name'>
			<a class="product_title" href='<?=$arItem['DETAIL_PAGE_URL']?>'><?=$arItem['NAME']?></a>
			<div class='artical'>
				<div class="properties">
					<?foreach($arItem['DISPLAY_PROPERTIES'] as $propCode=>$propVal) { ?>
                        <?if($propCode == 'SALE_OLD_PRICE') continue;?>
						<div class="prop"><?=$propVal['NAME']?> <?=$propVal['VALUE']?></div>
					<? } ?>
				</div>
			</div>
            
			<div class='price'>
                
                    
                    <?if($arItem['PROPERTIES']['SALE_OLD_PRICE']['VALUE']):?>
                        <p class="sale_old_price"><?=$arItem['PROPERTIES']['SALE_OLD_PRICE']['VALUE']?><img src='/img/rouble8.jpg'></p>
                    <?else:?>
                        <div style="margin-top:28px;"></div>
                    <?endif;?>                   
              
                
                <p><?=$arItem['PRICES']['Оптовая']['DISCOUNT_VALUE']?><img src='/img/rouble.png'></p>
			</div>
            
			<div class='cart-button cart-goods_count'>
				<input count_val="<?=($arItem['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']) ? $arItem['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']: 1?>" name="число" value='<?=($arItem['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']) ? $arItem['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']: 1?>' class="quantity<?=$arItem['ID']?>"><a href='#' rel="<?=$arItem['ID']?>"><span>В КОРЗИНУ</span></a>
			</div>
		</div>
		<div class='lpredlojenie'><p>ЛУЧШЕЕ ПРЕДЛОЖЕНИЕ</p>
		</div>
		<div class='luchshee-product'>
			<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$file['src']?>"  /></a>
		</div>		
	</div>
<? } ?>