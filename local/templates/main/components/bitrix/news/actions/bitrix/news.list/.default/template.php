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
<div class="catalog_items catalog_list sales_list">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	 $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>100, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true); 
	?>
	<div class="catalog_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="catalog_item_info">	
			<?if($file){?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" ><img style="position:absolute;" src="<?=$file['src']?>" alt=""></a><?}?>
			<div class="catalog_item_name"><?=$arItem['NAME']?></div>
			<div class="catalog_item_properties">
				<p><?=$arItem['PREVIEW_TEXT']?></p>
				<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="view_detail">товары, участвующие в акции</a>
			</div>
		</div>
		<div class="clr"></div>
	</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
