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


$arrCount = array(
	"12", "24", "36", "48"
);
//PAGE_ELEMENT_COUNT

if(!is_array($arResult['ITEMS']) || count($arResult['ITEMS']) == 0) ShowError('В данном разделе товаров пока нет! Но заходите позже, они обязательно появятся!');
else { 

if($arParams['ELEMENT_SORT_ORDER'] == 'ASC')
 $new_sort = 'DESC';
else $new_sort = 'ASC';

?>

<div class="catalog">
	<div class='order'>
		<div class="sorter filter_block">
			<div class="sorter_name">Сортировать по:</div>
			<div class="sorter_body">
				<a class='sorter_type price_sort <?if($arParams["ELEMENT_SORT_FIELD"] == 'CATALOG_PRICE_1'){?>active<?}?> <?if($new_sort=='ASC'){?>asc<?}else{?>desc<?}?>' href='?sort=price&order=<?=$new_sort?>'>ЦЕНЕ <span class="ico"></span></a>
				<a href='?sort=name&order=<?=$new_sort?>' class='sorter_type name_sort <?if($arParams["ELEMENT_SORT_FIELD"] == 'NAME'){?>active<?}?> <?if($new_sort=='ASC'){?>asc<?}else{?>desc<?}?>'>НАЗВАНИЮ <span class="ico"></span></a> 			 					
			</div>
		</div>
		<div class="scope filter_block">
			<div class="sorter_name">Показывать по:</div>
			<div class="sorter_body">
				<?foreach($arrCount as $val) { ?>
					<a <?if($arParams['PAGE_ELEMENT_COUNT'] == $val){?>class='active'<?}?> href='?PAGE_COUNT=<?=$val?>'><?=$val?></a>
				<? } ?>		 					
			</div>
		</div>
		<div class="view_switch filter_block">
			<div class="sorter_name">Вид списка:</div>
			<div class="sorter_body">
				<a class="view_type view_tile active" href='#'><span class="ico"></span></a>
				<a class="view_type view_list" href='#'><span class="ico"></span></a>			 					
			</div>
		</div>
	</div>
	<div class="catalog_items catalog_tile">
		<?foreach($arResult['ITEMS'] as $arItem) { 
		
		$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		if(!$file) { 
		 $file = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			
		
			if(!$file) { 
			 $file['src'] = '/img/logo.png';
			 $file['width'] = 150;
			 $file['height'] = 150;
			}
		}
		?>
		<div class="catalog_item">
		<?//if($arResult['ACTION'][$arItem['ID']]) { ?>
		<a href="<?=$arResult['ACTION'][$arItem['ID']]['DETAIL_PAGE_URL']?>" class="sale_info">
			<span class="sale_ribbon"><span class="ico"></span> акция</span>
			<span class="sale_info_name"><?=$arResult['ACTION'][$arItem['ID']]['NAME']?></span>
		</a>	
		<?// } ?>		
			<div class="catalog_item_info">
				<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="catalog_item_img">
					<img src="<?= $file['src']?>" width="<?=$file['width']?>" height="<?=$file['height']?>" alt="<?=$arItem['NAME']?>">
				</a>
				<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="catalog_item_name"><?=$arItem['NAME']?></a>
				<div class="catalog_item_properties">
					<?foreach($arItem['DISPLAY_PROPERTIES'] as $propCode=>$propVal) { 
					
					$prop_val = implode(explode('|', $propVal['DISPLAY_VALUE']), ', ');
					
					?>
						<div class="catalog_item_prop"><?=$propVal['NAME']?>: <span class="catalog-product-val"><?=$prop_val?></span></div>
					<? } ?>

				</div>
			</div>
			<div class="catalog_item_price_block">
				<div class="base_price">
					<span>Цена</span>
					<?if(floatval($arItem['MIN_PRICE']['DISCOUNT_VALUE']) > 0) { ?>
					<div class="base_prise_value"><?=$arItem['MIN_PRICE']['DISCOUNT_VALUE']?></div>
					<? } else { ?>
						
					<? } ?>
				</div>
				<?if(floatval($arItem['MIN_PRICE']['DISCOUNT_VALUE']) > 0) { ?>
				<div class="cart-button">
					<input name="число" value="1" class="quantity<?=$arItem['ID']?>"><a href="#" rel="<?=$arItem['ID']?>"><span>В КОРЗИНУ</span></a>
				</div>
				<? } else { ?>
				по запросу
				<? } ?>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
		<? } ?>
		<div class="clr"></div>
	</div>
	<!-- end of .catalog_items -->
	<?=$arResult["NAV_STRING"]?>
</div>

<script>
	$(function(){
		$(".pager a").click(function(){
			var destination = $("#catalog-body").offset().top;
			$('html, body').animate({ scrollTop: destination }, 700);		
			$("#catalog-body").html('<img src="/img/loader.gif" />');
			window.history.pushState({}, null, $(this).attr('href'));
			var url = $(this).attr('href');
			if(url.indexOf('?') + 1)
			url += '&ajax=Y';
			else url += '?ajax=Y';
			$.get(url, function(data){
				$("#catalog-body").html(data);
			});
			return false;
		});
	});
</script>
<? } ?>