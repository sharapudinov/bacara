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
				<a class='sorter_type price_sort <?if($arParams["ELEMENT_SORT_FIELD"] == 'CATALOG_PRICE_2'){?>active<?}?> <?if($new_sort=='ASC'){?>asc<?}else{?>desc<?}?>' href="<?=$APPLICATION->GetCurPageParam('sort=price&order='.$new_sort,array('sort','order'));?>">ЦЕНЕ <span class="ico"></span></a>
				<a href='<?=$APPLICATION->GetCurPageParam('sort=name&order='.$new_sort,array('sort','order'));?>' class='sorter_type name_sort <?if($arParams["ELEMENT_SORT_FIELD"] == 'NAME'){?>active<?}?> <?if($new_sort=='ASC'){?>asc<?}else{?>desc<?}?>'>НАЗВАНИЮ <span class="ico"></span></a>
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
        <?/*
		<div class="view_switch filter_block">
			<div class="sorter_name">Вид списка:</div>
			<div class="sorter_body">
				<a class="view_type view_tile active" href='#'><span class="ico"></span></a>
				<a class="view_type view_list" href='#'><span class="ico"></span></a>			 					
			</div>
		</div>
        */?>
	</div>
    
    <?/*if(stripos($APPLICATION->GetCurDir(), '/katalog_tovarov/vazy/') !== false):?>
        <?//echo '<pre>'; print_r($GLOBALS); echo '</pre>';?>
        <div class="filter_high-button">Фильтр по высоте</div>
        <div class="filter_high-wrap" style="display:block;">
            <form method="get" class="filter_form">
                <div id="slider_filter"></div>
                <input type="hidden" name="high_filter" value="Y">
                <input type="hidden" class="slider_filterleft" value="<?=htmlspecialchars($_REQUEST['slider_filterleft'])?>">
                <input type="hidden" class="slider_filterright" value="<?=htmlspecialchars($_REQUEST['slider_filterright'])?>">
                <button name="form_submit" class="filter_form-submit">Применить</button>
                <a name="form_filter-reset" class="form_filter-reset" href="<?=$APPLICATION->GetCurPageParam("", array("slider_filterright", "slider_filterleft"))?>">Сбросить</a>
            </form>
        </div>
    <?endif;*/?>
    
    <?if(stripos($APPLICATION->GetCurDir(), '/katalog_tovarov/vazy/') !== false):?>
        <?//echo '<pre>'; print_r($_REQUEST); echo '</pre>';?>
        <?
            global $APPLICATION;
            $arAmount = explode("-", $_REQUEST['amount']);
            $min_val = intval($arAmount[0]);
            $max_val = intval($arAmount[1]);
        ?>
        
        
        <script>
           
        </script>
        
        
       <!-- <form method="get">
            <p>            
              <label for="amount">Высота в см:</label>
                <?/*if(isset($_REQUEST['amount'])):*/?>
                    <p><?/*=($min_val." - ".$max_val)*/?></p>
                    <a style="margin-bottom:15px;" href="<?/*=$APPLICATION->GetCurPageParam("", array("PAGEN_1", "amount"))*/?>">Выбрать другую высоту</a>
                <?/*else:*/?>
                    <input name="amount" type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;">
                <?/*endif;*/?>
            </p>
            
            <?/*if(!isset($_REQUEST['amount'])):*/?>
                <div style="margin:25px 0;" id="slider-range"></div>    
                <input type="hidden" name="high_filter" value="Y">
                <button name="form_submit">Применить</button>
            <?/*endif;*/?>
        </form> -->
    <?endif;?>

	<?=$arResult["NAV_STRING"]?>

	<div class="catalog_items catalog_tile">
		<?foreach($arResult['ITEMS'] as $arItem) { 
		/*echo '<pre>';
		var_dump($arItem);
		echo '</pre>';
		die();	*/	
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
		<div id=<?=$arItem['ID']?> class="catalog_item">            
                <div class="<?=(isset($arResult['CATALOG_ITEM_COUNT'][$arItem['ID']]) && $arResult['CATALOG_ITEM_COUNT'][$arItem['ID']] > 0) ? 'catalog_item-count lenta-act' : 'catalog_item-count';?>">
                    <?if(isset($arResult['CATALOG_ITEM_COUNT'][$arItem['ID']]) && $arResult['CATALOG_ITEM_COUNT'][$arItem['ID']] > 0):?>
                        <?=$arResult['CATALOG_ITEM_COUNT'][$arItem['ID']]?> шт. в корзине
                    <?endif;?>    
                </div>            
		<?if($arResult['ACTION'][$arItem['ID']]) { ?>
		<a href="<?=$arResult['ACTION'][$arItem['ID']]['DETAIL_PAGE_URL']?>" class="sale_info">
			<span class="sale_ribbon"><span class="ico"></span> акция</span>
			<span class="sale_info_name"><?=$arResult['ACTION'][$arItem['ID']]['NAME']?></span>
		</a>	
		<? } ?>		
			<div class="catalog_item_info">
				<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="catalog_item_img">
					<img src="<?= $file['src']?>" width="<?=$file['width']?>" height="<?=$file['height']?>" alt="<?=$arItem['NAME']?>">
				</a>
				<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="catalog_item_name"><?=$arItem['NAME']?></a>
				<div class="catalog_item_properties">
					<?foreach($arItem['DISPLAY_PROPERTIES'] as $propCode=>$propVal) { 
					if($propCode == 'SALE_OLD_PRICE') continue;
					$prop_val = implode(explode('|', $propVal['DISPLAY_VALUE']), ', ');
					
					?>
                        <?if($propVal['CODE'] == 'KOLICHESTVO_V_UPAKOVKE'):?>
                            <div class="catalog_item_prop"><?=$propVal['NAME']?>: <span class="catalog-product-val"><?=($propVal['VALUE']) ? $propVal['VALUE'] : '1';?></span></div>
                        <?else:?>
                            <div class="catalog_item_prop"><?=$propVal['NAME']?>: <span class="catalog-product-val"><?=$prop_val?></span></div>
                        <?endif;?>
					<? } ?>

				</div>
			</div>
			<div class="catalog_item_price_block">
				<div class="base_price">
					<span>Цена</span>
					<?if(floatval($arItem['MIN_PRICE']['DISCOUNT_VALUE']) > 0) { ?>
                   
                        <div class="sale_old_price"><?=$arItem['PROPERTIES']['SALE_OLD_PRICE']['VALUE']?></div>
                    
					<div class="base_prise_value"><?=$arItem['MIN_PRICE']['DISCOUNT_VALUE']?></div>
					<? } else { ?>
						
					<? } ?>
				</div>                
				<?if(floatval($arItem['MIN_PRICE']['DISCOUNT_VALUE']) > 0) { ?>
                <div class="cart-goods_count">
                    <a class="minus-goods_count" href="javascript:void(0);">&ndash;</a>
                    <input count_val="<?=($arItem['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']) ? $arItem['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']: 1?>" name="число" value="<?=($arItem['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']) ? $arItem['PROPERTIES']['KOLICHESTVO_V_UPAKOVKE']['VALUE']: 1?>" class="quantity<?=$arItem['ID']?>">
                    <a class="plus-goods_count" href="javascript:void(0);">+</a>
                </div>
                <div class="clr"></div>
                <?if(!$arItem['PROPERTIES']['SALE_OLD_PRICE']['VALUE']):?>
                    <div class="margin-top"></div>
                <?endif;?>
                <div class="other_prices">
                    <a style="float:left; margin-left:6px;" class="opt_prices_tip" href="javascript:void(0);">						
                        <span class="sign">!</span>
                    </a>    
                    <div style="float:left; width:82px;" class="hide_price">СП: <span><?=$arResult['PRICES'][$arItem['ID']]['СП']['VALUE']?> р.</span></div>
                    <div class="hide_price">КО: 
                        <?if(floatval($arResult['PRICES'][$arItem['ID']]['Крупный опт']['VALUE']) > 0 && ($USER->IsAdmin() || $arResult['SHOW_LARGE_WHOSALE'])):?>
                            <span><?=$arResult['PRICES'][$arItem['ID']]['Крупный опт']['VALUE']?> р.</span>
                        <?else:?>
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>">узнать</a>
                        <?endif;?>                            
                    </div>
                </div>
				<div class="cart-button">
					<a href='#' rel="<?=$arItem['ID']?>" cml2article="<?=$arItem['PROPERTIES']['CML2_ARTICLE']['VALUE']?>">
						<span>В КОРЗИНУ</span>
					</a>				</div>
                <div class="clr"></div>
				<? } else { ?>
				по запросу
				<? } ?>
				
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