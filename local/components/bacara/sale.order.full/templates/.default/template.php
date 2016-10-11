<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="steps_block">
	<div class="steps">
		<div class="step active" id="step1">
			<div class="step_number">1</div>
			<div class="step_content">
				<a href="/cart/">Корзина</a>
			</div>
		</div>
		<div class="step active" id="step2">
			<div class="step_number">2</div>
			<div class="step_content"><a href="/order/">Данные покупателя</a></div>
		</div>
		<?if($arResult["CurrentStep"] > 3) { ?>
		<div class="step active" id="step3">
			<div class="step_number">3</div>
			<div class="step_content"><a href="/order/step2/">Оплата и доставка</a>
			</div>
		</div>
		<div class="step current" id="step4">
			<div class="step_number">4</div>
			<div class="step_content"><span>Подтверждение</span>
			</div>
		</div>
		<? } else { ?>
		<div class="step current" id="step3">
			<div class="step_number">3</div>
			<div class="step_content"><span>Оплата и доставка</span>
			</div>
		</div>
		<div class="step" id="step4">
			<div class="step_number">4</div>
			<div class="step_content"><span>Подтверждение</span>
			</div>
		</div>		
		<?  }?>
	</div>
</div>


<div class="row">
<?
if (!$USER->IsAuthorized())
{
	echo ShowError($arResult["ERROR_MESSAGE"]);	
	include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/auth.php");
}
else
{
	if ($arResult["CurrentStep"] < 6):?>
		<form method="post" action="<?= htmlspecialcharsbx($arParams["PATH_TO_ORDER"]) ?>" name="order_form">
			<?=bitrix_sessid_post()?>
	<?endif;?>

	<?if ($arResult["CurrentStep"] == 2) { ?>
	<div class='span3 left_part'> 
		<div class="section_nav">
			<div class="pay_type">
				<div class="pay_type_title">Выберите способ оплаты:</div>

				<?foreach($arResult['PAYSYSTEM'] as $key=>$pay) { ?>
					<div class="switch_control" id="pay_<?=$pay['ID']?>">
						<label><input type="radio" <?if($key==0){?>CHECKED<?}?> name="PAY_SYSTEM_ID" value="<?=$pay['ID']?>"><?=$pay['NAME']?></label>
					</div>				
				<? } ?>
			 			
				<?/*<div class="switch_control active" id="pay_service">
					<label><input type="radio" name="order_type" checked="checked">Электронный платеж</label>
				</div>*/?>
			</div>
		</div>	
		<?foreach($arResult['PAYSYSTEM'] as $key=>$pay) { ?>		
		<div class="switch_content pay_<?=$pay['ID']?>">
			<?=htmlspecialcharsback($pay['DESCRIPTION'])?>
		</div>
		<? } ?>
	</div>	
	<? } ?>
	
	<?if ($arResult["CurrentStep"] < 5) { ?>
	<div class='span9 right_part'>
		<div class='content'>
	<? }  else { ?>
		<div class='span12 '>
			<div class='content'>		
	<? } ?>
		
		
			<? echo ShowError($arResult["ERROR_MESSAGE"]); 
			if ($arResult["CurrentStep"] == 1)
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/step1.php");
			elseif ($arResult["CurrentStep"] == 2)
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/step2.php");
			elseif ($arResult["CurrentStep"] == 3)
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/step3.php");
			elseif ($arResult["CurrentStep"] == 4)
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/step4.php");
			elseif ($arResult["CurrentStep"] == 5)
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/step5.php");
			elseif ($arResult["CurrentStep"] >= 6)
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/step6.php");
			?>
	<?if ($arResult["CurrentStep"] < 5) { ?>
		</div>
	</span>
	<? } else { ?>
		</div>
	</div>
	<? } ?>


	<?if ($arResult["CurrentStep"] > 0 && $arResult["CurrentStep"] <= 7):?>
		<input type="hidden" name="ORDER_PRICE" value="<?= $arResult["ORDER_PRICE"] ?>">
		<input type="hidden" name="ORDER_WEIGHT" value="<?= $arResult["ORDER_WEIGHT"] ?>">
		<input type="hidden" name="SKIP_FIRST_STEP" value="<?= $arResult["SKIP_FIRST_STEP"] ?>">
		<input type="hidden" name="SKIP_SECOND_STEP" value="<?= $arResult["SKIP_SECOND_STEP"] ?>">
		<input type="hidden" name="SKIP_THIRD_STEP" value="<?= $arResult["SKIP_THIRD_STEP"] ?>">
		<input type="hidden" name="SKIP_FORTH_STEP" value="<?= $arResult["SKIP_FORTH_STEP"] ?>">
	<?endif?>

	<?if ($arResult["CurrentStep"] > 1 && $arResult["CurrentStep"] <= 6):?>
		<input type="hidden" name="PERSON_TYPE" value="<?= $arResult["PERSON_TYPE"] ?>">
		<input type="hidden" name="BACK" value="">
	<?endif?>

	<?if ($arResult["CurrentStep"] > 2 && $arResult["CurrentStep"] <= 6):?>
		<input type="hidden" name="PROFILE_ID" value="<?= $arResult["PROFILE_ID"] ?>">
		<input type="hidden" name="DELIVERY_LOCATION" value="<?= $arResult["DELIVERY_LOCATION"] ?>">
		<?
		$dbOrderProps = CSaleOrderProps::GetList(
				array("SORT" => "ASC"),
				array("PERSON_TYPE_ID" => $arResult["PERSON_TYPE"], "ACTIVE" => "Y", "UTIL" => "N"),
				false,
				false,
				array("ID", "TYPE", "SORT")
			);
		while ($arOrderProps = $dbOrderProps->Fetch())
		{
			if ($arOrderProps["TYPE"] == "MULTISELECT")
			{
				if (count($arResult["POST"]["ORDER_PROP_".$arOrderProps["ID"]]) > 0)
				{
					for ($i = 0; $i < count($arResult["POST"]["ORDER_PROP_".$arOrderProps["ID"]]); $i++)
					{
						?><input type="hidden" name="ORDER_PROP_<?= $arOrderProps["ID"] ?>[]" value="<?= $arResult["POST"]["ORDER_PROP_".$arOrderProps["ID"]][$i] ?>"><?
					}
				}
				else
				{
					?><input type="hidden" name="ORDER_PROP_<?= $arOrderProps["ID"] ?>[]" value=""><?
				}
			}
			else
			{
				?><input type="hidden" name="ORDER_PROP_<?= $arOrderProps["ID"] ?>" value="<?= $arResult["POST"]["ORDER_PROP_".$arOrderProps["ID"]] ?>"><?
			}
		}
		?>
	<?endif?>

	<?if ($arResult["CurrentStep"] > 3 && $arResult["CurrentStep"] < 6):?>
		<input type="hidden" name="DELIVERY_ID" value="<?= is_array($arResult["DELIVERY_ID"]) ? implode(":", $arResult["DELIVERY_ID"]) : IntVal($arResult["DELIVERY_ID"]) ?>">
	<?endif?>

	<?if ($arResult["CurrentStep"] > 4 && $arResult["CurrentStep"] < 6):?>
		<input type="hidden" name="TAX_EXEMPT" value="<?= $arResult["TAX_EXEMPT"] ?>">
		<input type="hidden" name="PAY_SYSTEM_ID" value="<?= $arResult["PAY_SYSTEM_ID"] ?>">
		<input type="hidden" name="PAY_CURRENT_ACCOUNT" value="<?= $arResult["PAY_CURRENT_ACCOUNT"] ?>">
	<?endif?>

	<?if ($arResult["CurrentStep"] < 6):?>
		<input type="hidden" name="CurrentStep" value="<?= ($arResult["CurrentStep"] + 1) ?>">
	<?endif?>

	<?if ($arResult["CurrentStep"] < 6):?>
		</form>
	<?endif;?>
<?
}
?>
</div>
