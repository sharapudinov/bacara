<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?if (!empty($arResult)):?>
<div class="section_nav">
<div id="navbar" class="sub_nav">
<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?if($arItem["SELECTED"]):?>
		<a href="<?=$arItem["LINK"]?>" class="active"><span><?=strtoupper($arItem["TEXT"])?></span></a>
	<?else:?>
		<a href="<?=$arItem["LINK"]?>"><span><?=strtoupper($arItem["TEXT"])?></span></a>
	<?endif?>
<?endforeach?>
 </div> 	
</div>
<?endif?>
