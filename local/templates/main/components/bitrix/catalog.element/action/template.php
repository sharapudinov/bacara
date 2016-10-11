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

/*echo '<pre>';
var_dump($arResult);
echo '</pre>';*/
?>


	<div class="catalog_detail">
		<div class="detail_photo_section">
			<?/*<a href="#" class="sale_info">
				<span class="sale_ribbon"><span class="ico"></span> акция</span>
				<span class="sale_info_name">Весенние скидки только до 30 апреля</span>
			</a>*/?>
			
			<?
			
		$file = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], array('width'=>550, 'height'=>550), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		if(!$file) { 
		 $file['src'] = '/img/logo.png';
		 $file['width'] = 550;
		 $file['height'] = 550;
		 
		}			
			?>
			
			<a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" rel="prettyPhoto" class="main_photo">
				<img src="<?=$file['src']?>" width='<?=$file['width']?>' alt="">
				<span class="zoom"></span>
			</a>
			<?if(is_array($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']) && count($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']) > 0 && $arResult['DETAIL_PICTURE']){?>
			<div class="sub_photos">
				<div class="sub_photo_scroller slider8">
					<?
					$file2 = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], array('width'=>90, 'height'=>90), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					?>
						<span href="<?=$file['src']?>" class="sub_photo slide">
							<img src="<?=$file2['src']?>" height="<?=$file2['height']?>" width="<?=$file2['width']?>" alt="">
						</span>
					
				
					<?foreach($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $photo) { 
					$file = CFile::ResizeImageGet($photo, array('width'=>550, 'height'=>550), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					$file2 = CFile::ResizeImageGet($photo, array('width'=>90, 'height'=>90), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					if($file) { 
					?>
						<span href="<?=$file['src']?>" class="sub_photo slide">
							<img src="<?=$file2['src']?>" height="<?=$file2['height']?>" width="<?=$file2['width']?>" alt="">
						</span>
					<? } ?>
					<? } ?>
				</div>
			</div>
			<? } ?>
			<?if(count($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']) > 2) {?>
			<a href="#" class="more_sub"></a>
			<? } ?>
			<div class="clr"></div>
		</div>
		<div class="detail_info_section">
			<div class="catalog_item_price_block detail_price">
				<div class="base_price">
					<span>Цена</span>
					<?if(floatval($arResult['PRICES']['Оптовая']['DISCOUNT_VALUE']) > 0) { ?>
					<div class="base_prise_value"><?=$arResult['PRICES']['Оптовая']['DISCOUNT_VALUE']?> <span class="ico"></span></div>
					<? } else { ?>
						
					<? } ?>
				</div>
				<?if(floatval($arResult['PRICES']['Оптовая']['DISCOUNT_VALUE']) > 0) { ?>
				<div class="cart-button">
					<input name="число" value="1" class="quantity<?=$arResult['ID']?>"><a href="#" rel="<?=$arResult['ID']?>"><span>В КОРЗИНУ</span></a>
				</div>
				<? } else  {?>
				по запросу
				<? } ?>
				<div class="clr"></div>
				<div class="opt_prices">
					<?if(floatval($arResult['PRICES']['СП']['DISCOUNT_VALUE']) > 0 || floatval($arResult['PRICES']['Крупный опт']['DISCOUNT_VALUE']) > 0) { ?>
					<a href="javascript:void(0);" class="opt_prices_tip">
						<span class="opt_prices_tooltip">Текст о том, как получить возможность пользоватеся специальными и оптовыми ценами.</span>
						<span class="sign">?</span>
					</a>
					<? } ?>
					<?if(floatval($arResult['PRICES']['СП']['DISCOUNT_VALUE']) > 0) { ?>
					<div class="opt_price"><strong><?=$arResult['PRICES']['СП']['DISCOUNT_VALUE']?> р.</strong> (спец. цена)</div>
					<? } ?>
					<?if(floatval($arResult['PRICES']['Крупный опт']['DISCOUNT_VALUE']) > 0) { ?>
					<div class="opt_price"><strong><?=$arResult['PRICES']['Крупный опт']['DISCOUNT_VALUE']?> р.</strong> (крупный опт.)</div>
					<? } ?>
				</div> 
			</div>								
			<div class="catalog_item_properties">
				<?foreach($arResult['DISPLAY_PROPERTIES'] as $propCode=>$propVal) {
					$prop_val = implode(explode('|', $propVal['DISPLAY_VALUE']), ', ');
				?>
					<div class="catalog_item_prop"><?=$propVal['NAME']?>: <b><?=$prop_val?></b></div>
				<? } ?>				
			</div>
			<?/*<div class="catalog_item_properties">
				<div class="catalog_item_prop">Артикул 678493</div>
				<div class="catalog_item_prop">Размер: 40х40</div>
				<div class="catalog_item_prop">Цвет: зеленый</div>
			</div>*/?>
		</div>
		<div class="clr"></div>
		<?if(strlen($arResult['DETAIL_TEXT']) > 0) { ?>
		<div class="detail_description">
			<h3>Описание</h3>
			<?=$arResult['DETAIL_TEXT']?>
		</div>
		<? } ?>
	</div>
	


	
	
	
