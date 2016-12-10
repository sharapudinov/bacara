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
?>

<?foreach($arResult['ITEMS'] as $arItem) { 

	$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>180, 'height'=>180), BX_RESIZE_IMAGE_EXACT, true);
	if(!$file) { 
	 $file['src'] = '/img/logo.png';
	 $file['width'] = 180;
	 $file['height'] = 180;
	}
?>
	<div class="catalog_item catalog_sale">
		<?if($arResult['ACTION'][$arItem['ID']]) { ?>
		<a href="<?=$arResult['ACTION'][$arItem['ID']]['DETAIL_PAGE_URL']?>" class="sale_info">
			<span class="sale_ribbon"><span class="ico"></span> акция</span>
			<span class="sale_info_name"><?=$arResult['ACTION'][$arItem['ID']]['NAME']?></span>
		</a>	
		<? } ?>
		<div class="catalog_item_info" style="height: 290px;">
			<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img width="<?=$file['width']?>" alt="" src="<?=$file['src']?>"></a>
			<a class="catalog_item_name" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
			<div class="catalog_item_properties">
				<?foreach($arItem['DISPLAY_PROPERTIES'] as $propCode=>$propVal) { ?>
					<div class="catalog_item_prop"><?=$propVal['NAME']?> <?=$propVal['VALUE']?></div>
				<? } ?>					
			</div>
		</div>
		<div class="catalog_item_price_block" style="height: 40px;">
			<?if($arItem['PRICES']['Оптовая']['DISCOUNT_VALUE'] > 0){ ?>
			<div class="base_price">
				<span>Цена</span>
				<div class="base_prise_value"><?=$arItem['PRICES']['Оптовая']['DISCOUNT_VALUE']?></div>
			</div>
			<div class='cart-button'>
				<input name="число" value='1' class="quantity<?=$arItem['ID']?>">
				<a href='#' rel="<?=$arItem['ID']?>" cml2article="<?=$arItem['PROPERTIES']['CML2_ARTICLE']['VALUE']?>">
					<span>В КОРЗИНУ</span>
				</a>
			</div>
			<? } else echo '<center>нет на складе</center>';?>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
	</div>
<? } ?>

</div>