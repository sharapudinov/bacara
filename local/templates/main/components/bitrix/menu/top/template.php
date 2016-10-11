<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>


<?if (!empty($arResult)):?>
 <div id='menu_it'>

<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?if($arItem["SELECTED"]):?>
		<a href="<?=$arItem["LINK"]?>" class="selected"><?=strtoupper($arItem["TEXT"])?></a>
	<?else:?>
		<a href="<?=$arItem["LINK"]?>"><?=strtoupper($arItem["TEXT"])?></a>
	<?endif?>
	
<?endforeach?>

</div>
<?endif?>