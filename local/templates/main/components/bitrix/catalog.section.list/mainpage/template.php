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
<div class="product_items">
	<?foreach($arResult['SECTIONS'] as $arSection) { 
	$file = CFile::ResizeImageGet($arSection['PICTURE'], array('width'=>170, 'height'=>180), BX_RESIZE_IMAGE_EXACT, true);  
	if(!$file)
	 $file['src'] = '/images/line-empty.png';
	?>
		<div class="product_item">
			<div class='product-anotashion'>
				<a href='<?=$arSection['SECTION_PAGE_URL']?>' class='product-image'><img src="<?=$file['src']?>"  /></a>
				<a href="<?=$arSection['SECTION_PAGE_URL']?>" class='product-title'><?=$arSection['NAME']?></a>
			</div>			
		</div>
	<? } ?>
	<div class="clr"></div>
</div>