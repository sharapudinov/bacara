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

<div id="myCarousel" class="carousel slide">
	<ol class="carousel-indicators">
		<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
			<li data-target="#myCarousel" data-slide-to="<?=$key?>" <?if($key==0){?>class="active"<?}?>></li>
		<?endforeach;?>
	</ol>
	<!-- Carousel items -->
	<div class="carousel-inner">
	
	
<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	
		<div class="<?if($key==0){?>active<?}?> item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<a href='<?=$arItem['PROPERTIES']['link']['VALUE']?>'><?=CFile::ShowImage($arItem['PREVIEW_PICTURE'], 980, 600)?></a>
            <?if(strlen($arItem['PROPERTIES']['text2']['VALUE'])>0):?>
                <div class="carousel-caption">
                    <h3><?=$arItem['NAME']?></h3>
                    <span><?=$arItem['PROPERTIES']['text2']['VALUE']?></span>
                    <a href="<?=$arItem['PROPERTIES']['link']['VALUE']?>"><?=$arItem['PROPERTIES']['link_name']['VALUE']?> <span class="ico"></span></a>
                </div>
            <?endif;?>
		</div>
				
<?endforeach;?>
	</div>
	<!-- Carousel nav -->
	<?if(count($arResult["ITEMS"]) > 1) { ?>
	<a class="carousel-control left" href="#myCarousel" data-slide="prev"><img src="/img/left.png"  /></a>
	<a class="carousel-control right" href="#myCarousel" data-slide="next"><img src="/img/right.png"  /></a>
	<? } ?>
</div>

