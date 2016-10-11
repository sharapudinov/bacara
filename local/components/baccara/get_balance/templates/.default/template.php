<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?/* echo '<pre>'; print_r($arResult); echo '</pre>'; */?>

<div class="balance_block">
	<div class="balance_title">Баланс моего счета</div>
	<p>Здесь вы можете узнать, какая сумма числится на Вашем счету.</p>
    <?//if(!empty($arResult['USER']) && intval($arResult['USER']['UF_BALANCE']) > 0):?>
    <?
        if($arResult['USER']['UF_BALANCE'] == 999999.99 && $arResult['USER']['UF_DATE_BALANCE'] != '') {
            $balance = 'Вы не зарегистрированы как партнер.';
        }
        elseif($arResult['USER']['UF_BALANCE'] == '' && $arResult['USER']['UF_DATE_BALANCE'] == '') {
            $balance = 'Ожидается обновление.';
        }
        else {
            $balance = $arResult['USER']['UF_BALANCE'].' руб.';
        }
    ?>
        <p class="current_balance">Ваш текущий баланс: <span><?=$balance?></span></p>
        <p class="date_balance">Актуально на <span><?=($arResult['USER']['UF_DATE_BALANCE']) ? $arResult['USER']['UF_DATE_BALANCE'] : date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time());?></span></p>
        
    <?//endif;?>
	<a href="javascript:void(0);" class="button check_balance balance_phase active">проверить баланс</a>		 				
	<div class="balance_request balance_phase">
		<img src="images/ajax-loader.gif" width="220" alt="">
		<span class="note">запрос Вашего баланса ...</span>
	</div>
	<div class="balance_status balance_phase">
		<div class="balance_value">0</div>
		<a class="check_balance" href="javascript:void(0);">Обновить</a>
	</div>
</div>