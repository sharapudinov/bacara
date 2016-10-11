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

/* echo '<pre>';
print_r($arResult);
echo '</pre>'; */
?>


	<div class="catalog_detail" id="<?=$arResult['ID']?>">
		<div class="detail_photo_section">
			<?/*<a href="#" class="sale_info">
				<span class="sale_ribbon"><span class="ico"></span> акция</span>
				<span class="sale_info_name">Весенние скидки только до 30 апреля</span>
			</a>*/?>
			
			<?
			
		$file = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], array('width'=>550, 'height'=>550), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		if(!$file) { 
		 $file['src'] = '/img/cvety.png';
		 $file['width'] = 550;
		 $file['height'] = 550;
		 
		}			
			?>
			
			
				<img src="<?=$file['src']?>" width='<?=$file['width']?>' alt="">
				<span class="zoom"></span>
			
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
		<div class="detail_payment_section">
			<div class="catalog_item_price_block detail_price prepayment-wrap">
				<div class="prepayment_summ">
					<span>CУММА (<i></i>)</span>					
					<div class="base_prise_value"><input type="input"> <span class="ico"></span></div>					
				</div>
                <div class="delivery_payment">
                    <label><input type="radio" value="dpn" class="delivery" name="delivery"> Оплата товара <span class="bold">без учета доставки</span></label>
                    <label><input type="radio" value="dpym" class="delivery" name="delivery"> Оплата товара <span class="bold">с учетом доставки по Москве и МО</span></label>
                    <label><input type="radio" value="dpyr" class="delivery" name="delivery"> Оплата товара <span class="bold">с учетом доставки по России</span></label>                    
                </div>
				<div class="cart-button cart-button-detail">
					<div class="predoplata">Оплатить</div>
				</div>				
				<div class="clr"></div>				
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