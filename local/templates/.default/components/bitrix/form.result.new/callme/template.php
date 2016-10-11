<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
 $this->createFrame()->begin("Загрузка"); 
?>
<p style='color:#3a3a3a;font-size:18px;margin-bottom:-10px;padding:0 0 -10px 0;'>ПЕРЕЗВОНИТЬ ВАМ?</p>
	<p style='color:#757575;font-size:13px;	line-height: 1.2;margin-top:20px;'>Оставьте свой контактный номер телефона и наши операторы свяжутся с Вами</p>
	<div class='cart-off-10' style='padding:30px;'>	
		<div style="margin:0 0 0 0;" class="callme">
			<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>
			<?=$arResult["FORM_HEADER"]?>	
			<span style='' >Ваше имя</span><br>
			<?=$arResult['QUESTIONS']['SIMPLE_QUESTION_196']['HTML_CODE']?>
			<br>
			<span>Телефон</span><br>
			<?=$arResult['QUESTIONS']['SIMPLE_QUESTION_700']['HTML_CODE']?>
			<span style='color:#757575;font-size:11px' >В формате Х-ХХХ-ХХХ-ХХ-ХХ</span>
		</div>		
		<div class='cart-off-6'style='margin-bottom:0; padding:10px 0 0 0;'>
			<input type="submit" class='btn-off-6' style="margin-top:0px;width:140px;"  name="web_form_submit" value=" ОТПРАВИТЬ " />
		</div>
		<?=$arResult["FORM_FOOTER"]?>
		<a class="close-1"title="Закрыть" href="#close"></a>
	</div>