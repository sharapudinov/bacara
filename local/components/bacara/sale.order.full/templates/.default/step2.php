<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!function_exists('PrintPropsForm'))
{
	function PrintPropsForm($arSource=Array(), $PRINT_TITLE = "", $arParams)
	{
		if (!empty($arSource))
		{
			/*if (strlen($PRINT_TITLE) > 0)
			{
				?>
				<b><?= $PRINT_TITLE ?></b><br /><br />
				<?
			}*/
			?>
			
			<?
			foreach($arSource as $arProperties)
			{
				if($arProperties["SHOW_GROUP_NAME"] == "Y")
				{
					?>
					<div class="form_section_title"><?= $arProperties["GROUP_NAME"] ?>:</div>
					<?
				}
				?>
				<div class="input_group">
						<label><?= $arProperties["NAME"] ?>:<?
						if($arProperties["REQUIED_FORMATED"]=="Y")
						{
							?><span class="sof-req">*</span><?
						}
						?></label>

						<?
						if($arProperties["TYPE"] == "CHECKBOX")
						{
							?>
							<input type="checkbox" name="<?=$arProperties["FIELD_NAME"]?>" value="Y"<?if ($arProperties["CHECKED"]=="Y") echo " checked";?>>
							<?
						}
						elseif($arProperties["TYPE"] == "TEXT")
						{
							?>
							<input type="text" maxlength="250" size="<?=$arProperties["SIZE1"]?>" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>">
							<?
						}
						elseif($arProperties["TYPE"] == "SELECT")
						{
							?>
							<select name="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
							<?
							foreach($arProperties["VARIANTS"] as $arVariants)
							{
								?>
								<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
								<?
							}
							?>
							</select>
							<?
						}
						elseif ($arProperties["TYPE"] == "MULTISELECT")
						{
							?>
							<select multiple name="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
							<?
							foreach($arProperties["VARIANTS"] as $arVariants)
							{
								?>
								<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
								<?
							}
							?>
							</select>
							<?
						}
						elseif ($arProperties["TYPE"] == "TEXTAREA")
						{
							?>
							<textarea rows="<?=$arProperties["SIZE2"]?>" cols="<?=$arProperties["SIZE1"]?>" name="<?=$arProperties["FIELD_NAME"]?>"><?=$arProperties["VALUE"]?></textarea>
							<?
						}
						elseif ($arProperties["TYPE"] == "LOCATION")
						{
							$value = 0;
							foreach ($arProperties["VARIANTS"] as $arVariant)
							{
								if ($arVariant["SELECTED"] == "Y")
								{
									$value = $arVariant["ID"];
									break;
								}
							}

							if ($arParams["USE_AJAX_LOCATIONS"] == "Y"):
								$GLOBALS["APPLICATION"]->IncludeComponent(
									"bitrix:sale.ajax.locations",
									".default",
									array(
										"AJAX_CALL" => "N",
										"COUNTRY_INPUT_NAME" => "COUNTRY_".$arProperties["FIELD_NAME"],
										"REGION_INPUT_NAME" => "REGION_".$arProperties["FIELD_NAME"],
										"CITY_INPUT_NAME" => $arProperties["FIELD_NAME"],
										"CITY_OUT_LOCATION" => "Y",
										"LOCATION_VALUE" => $value,
										"ORDER_PROPS_ID" => $arProperties["ID"],
										"ONCITYCHANGE" => "",
									),
									null,
									array('HIDE_ICONS' => 'Y')
								);
							else:
							?>
							<select name="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
							<?
							foreach($arProperties["VARIANTS"] as $arVariants)
							{
								?>
								<option value="<?=$arVariants["ID"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
								<?
							}
							?>
							</select>
							<?
							endif;
						}
						elseif ($arProperties["TYPE"] == "RADIO")
						{
							foreach($arProperties["VARIANTS"] as $arVariants)
							{
								?>
								<input type="radio" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["ID"]?>" value="<?=$arVariants["VALUE"]?>"<?if($arVariants["CHECKED"] == "Y") echo " checked";?>> <label for="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["ID"]?>"><?=$arVariants["NAME"]?></label><br />
								<?
							}
						}

						if (strlen($arProperties["DESCRIPTION"]) > 0)
						{
							?><br /><small><?echo $arProperties["DESCRIPTION"] ?></small><?
						}
						?>

			</div>
				<?
			}
			?>
		
			<?
			return true;
		}
		return false;
	}
}
?>

<div class="order_block">
<p>Вы можете не заполнять информацию о доставке, если Вы уже делали заказ с такими параметрами. Просто выберите необходимый профиль доставки:</p>


<?
$bPropsPrinted = PrintPropsForm($arResult["PRINT_PROPS_FORM"]["USER_PROPS_N"], GetMessage("SALE_INFO2ORDER"), $arParams);

if(!empty($arResult["USER_PROFILES"]))
{

	?>
	<div class="order_form">
		<script language="JavaScript">
		function SetContact(enabled)
		{
			$(".profile-block").hide();
			console.log("#"+enabled);
			
			$("#block-"+enabled).show();

		}
		</script>

		<?
		foreach($arResult["USER_PROFILES"] as $arUserProfiles)
		{
			?>
			
				<div id="profile_new" class="switch_control">
				<label>
					<input type="radio" name="PROFILE_ID" id="ID_PROFILE_ID_<?= $arUserProfiles["ID"] ?>" value="<?= $arUserProfiles["ID"];?>"<?if ($arUserProfiles["CHECKED"]=="Y") echo " checked";?> onClick="SetContact('ID_PROFILE_ID_<?= $arUserProfiles["ID"] ?>')">
					<?=$arUserProfiles["NAME"]?>
				</label>
				</div>
			<?
		}
		?>
		<div id="profile_new" class="switch_control">
		<label>
			<input type="radio" name="PROFILE_ID" id="ID_PROFILE_ID_0" value="0"<?if ($arResult["PROFILE_ID"]=="0") echo " checked";?> onClick="SetContact('ID_PROFILE_ID_0')">
			<?echo GetMessage("SALE_NEW_PROFILE")?>
		</label>
		</div>		

</div>
	<?
}
else
{
	?><input type="hidden" name="PROFILE_ID" value="0"><?
}
?>





<div  class="switch_content deliver_form profile_new active">
<div class="form_row">
<div class="dual_col">
<div class="profile-block" id="block-ID_PROFILE_ID_0">
<?
PrintPropsForm($arResult["PRINT_PROPS_FORM"]["USER_PROPS_Y"], GetMessage("SALE_NEW_PROFILE_TITLE"), $arParams);
?>
</div>
<?
if(!empty($arResult["USER_PROFILES"]))
{
foreach($arResult["USER_PROFILES"] as $arUserProfiles)
{
?>
<div class="profile-block" id="block-ID_PROFILE_ID_<?=$arUserProfiles['ID']?>" style="display:none">
<div class="form_section_title">Адрес доставки:</div>
<div class="presets">
<?
foreach($arUserProfiles["USER_PROPS_VALUES"] as $arUserPropsValues)
{
	
	if (strlen($arUserPropsValues["VALUE_FORMATED"]) > 0)
	{
		?>
		<div class="preset_addres">
			<div class="preset_addres_title"><?=$arResult["PRINT_PROPS_FORM"]["USER_PROPS_Y"][$arUserPropsValues["ORDER_PROPS_ID"]]["NAME"]?>:</div>
			<div class="preset_addres_value"><?=$arUserPropsValues["VALUE_FORMATED"]?></div>
		</div>
		<?
	}
}
?>
</div>
</div>

<?
}
}
?>



</div>
<div class="dual_col deliver_types">
	<div class="form_section_title">Выберите способ доставки:</div>
	<?foreach($arResult['DELIVERY'] as $key=>$delivery) { ?>
		<div class="input_group">
			<input type="radio" id="d<?=$delivery['ID']?>" value="<?=$delivery['ID']?>" name="DELIVERY_ID" <?if($key==0 || $arResult['DELIVERY_ID'] == $delivery['ID']){?>CHECKED<?}?>>
			<label for="d<?=$delivery['ID']?>"><?=$delivery['NAME']?></label>
			<?if($delivery['PRICE'] > 0) { ?>
			<p>Стоимость: <?=number_format($delivery['PRICE'], 0, '.', ' ')?> руб.</p>
			<? } ?>
			<p><?=$delivery['DESCRIPTION']?></p>
		</div>
	<? } ?>
</div>
<div class="clr"></div>
</div>
</div>




<script>
	$(function(){
		$("input[name=PROFILE_ID]:checked").click();
	});
</script>	

</div>
<div class="order_complete">
	<input type="submit" class="button" name="contButton" value="подтвердить заказ">
</div>
<input type="hidden" name="SKIP_THIRD_STEP" value="Y">
<?
//echo '<pre>';
//var_dump($arResult);
//echo '</pre>';
?>