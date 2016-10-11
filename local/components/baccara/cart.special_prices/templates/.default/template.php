<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?if(isset($arResult['TOTAL_SUMM']['SP']) && floatval($arResult['TOTAL_SUMM']['SP']) > 0):?>

    <table id="total_specials_summ">
        <tr>
            <td>Итоговая сумма в цене Специального Предложения:</td>
            <td><?=floatval($arResult['TOTAL_SUMM']['SP']).' руб.'?></td>
        </tr>
        <?if(isset($arResult['TOTAL_SUMM']['KO']) && floatval($arResult['TOTAL_SUMM']['KO']) > 0):?>
            <tr>
                <td>Итоговая сумма в цене Крупного Опта:</td>
                <td><?=floatval($arResult['TOTAL_SUMM']['KO']).' руб.'?></td>
            </tr>
        <?endif;?>
    </table>
    
<?endif;?>