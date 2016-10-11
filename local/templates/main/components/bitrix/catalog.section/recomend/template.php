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
	<div id="<?=$arItem['ID']?>" class="catalog_item">

		<div class="catalog_item_info catalog_item_info_recomend" style="">
			
			<a class="catalog_item_name" href="<?=$arItem['DETAIL_PAGE_URL']?>">
				<?=$arItem['NAME']?>
			</a>
			<div class="catalog_item_properties">
				<?foreach($arItem['DISPLAY_PROPERTIES'] as $propCode=>$propVal) { 
					$prop_val = implode(explode('|', $propVal['VALUE']), ', ');
				?>
					<div class="catalog_item_prop"><?=$propVal['NAME']?>: <?=$prop_val?></div>
				<? } ?>					
			</div>
		</div>
		<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img width="<?=$file['width']?>" alt="" src="<?=$file['src']?>"></a>
		<div class="catalog_item_price_block">
			<?if($arItem['PRICES']['Оптовая']['DISCOUNT_VALUE'] > 0){ ?>
			<div class="base_price">
				<span>Цена</span>
				<div class="base_prise_value"><?=$arItem['PRICES']['Оптовая']['DISCOUNT_VALUE']?></div>
			</div>
            <div class="cart-goods_count">
                <a class="minus-goods_count" href="javascript:void(0);">&ndash;</a>
                <input count_val="<?=($arItem['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']) ? $arItem['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']: 1?>" name="число" value="<?=($arItem['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']) ? $arItem['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']: 1?>" class="quantity<?=$arItem['ID']?>">
                <a class="plus-goods_count" href="javascript:void(0);">+</a>
            </div>
			<div class="cart-button cart-button-recommended">
				<a href='#' rel="<?=$arItem['ID']?>"><span>В КОРЗИНУ</span></a>
			</div>
			<? } else echo '<center>нет на складе</center>';?>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>

	</div>
<? } ?>

</div>