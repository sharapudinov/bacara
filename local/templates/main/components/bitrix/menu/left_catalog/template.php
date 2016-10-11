<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="accordion">
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>
<?

?>


	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="<?if ($arItem["SELECTED"]):?>active<?endif?>"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>active<?endif?>">
			<?if(intval($arItem['PARAMS']['ICON2']) > 0) { ?>
				<span style="background: url('<?=CFile::GetPath(intval($arItem['PARAMS']['ICON2']))?>') 0px 0px;" class="ico ico-hover"></span>
			<? } ?>				
			<?if(intval($arItem['PARAMS']['ICON']) > 0) { ?>
				<span style="background: url('<?=CFile::GetPath(intval($arItem['PARAMS']['ICON']))?>') 0px 0px;" class="ico ico-main"></span>
			<? } ?>
			<?=$arItem["TEXT"]?>
			
				<span class="arrow"></span>
			
			</a>
				<ul class="sub-menu" <?if ($arItem["SELECTED"]):?>style="display:block"<?endif;?>>
		<?else:?>
			<li<?if ($arItem["SELECTED"]):?> class="active"<?endif?>><a href="<?=$arItem["LINK"]?>" class="parent">
			<?=$arItem["TEXT"]?></a>
				<ul class="sub-menu" <?if ($arItem["SELECTED"]):?>style="display:block"<?endif;?>>
		<?endif?>

	<?else:?>


			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li
				<?if($arItem['TEXT'] == 'АКЦИИ'){?>id="seven"<?}?>
				class="<?if ($arItem["SELECTED"]):?>active<?endif?>"><a href="<?=$arItem["LINK"]?>" class="link <?if ($arItem["SELECTED"]):?>active<?endif?>">
				<?if(intval($arItem['PARAMS']['ICON2']) > 0) { ?>
					<span style="background: url('<?=CFile::GetPath(intval($arItem['PARAMS']['ICON2']))?>') 0px 0px;" class="ico ico-hover"></span>
				<? } ?>				
				<?if(intval($arItem['PARAMS']['ICON']) > 0) { ?>
					<span style="background: url('<?=CFile::GetPath(intval($arItem['PARAMS']['ICON']))?>') 0px 0px;" class="ico ico-main"></span>
				<? } ?>			
				<?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li<?if ($arItem["SELECTED"]):?> class="active"<?endif?>><a class="link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>



	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>

<?endif?>