	<script type="text/javascript">
		$(document).ready(function() {	 

			$('input[name="REGISTER[EMAIL]"]').on('change',function(e){
				$('input[name="REGISTER[LOGIN]"]').val($(this).val());
			});
/*
			$('.button_holder input[type=submit]').on('click',function(e){
				e.preventDefault();
				$('.switch_content').removeClass('active');
				$('.reg_types').hide();
				$('.reg_success').show();
			});
*/
			var accordion_head = $('.accordion > li > a'),
				accordion_body = $('.accordion li > .sub-menu');

			accordion_head.on('click', function(event) {
				event.preventDefault();	 

				// Отображение и скрытие вкладок при клике	 
				if ($(this).attr('class') != 'active'){
					accordion_body.slideUp('normal');
					$(this).next().stop(true,true).slideToggle('normal');
					accordion_head.removeClass('active');
					$(this).addClass('active');
				}	 
			});	 
		});	 
	</script>

<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
?>
<?if($USER->IsAuthorized()):?>

<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>



<?else:?>

	<?
	if (count($arResult["ERRORS"]) > 0):
		foreach ($arResult["ERRORS"] as $key => $error)
			if (intval($key) == 0 && $key !== 0) 
				$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

		ShowError(implode("<br />", $arResult["ERRORS"]));

	elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
	?>
	<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
	<?endif?>

    <div class="reg_types">
        <div id="phizik" class="switch_control <?if($_REQUEST['type'] != 'jurip' && $_REQUEST['type'] != 'jurooo') {?>active<?}?>">
            <label class="reg_type"><input type="radio" class="reg_type" <?if($_REQUEST['type'] != 'jurip' && $_REQUEST['type'] != 'jurooo') {?>CHECKED<?}?> value="1" name="reg_type" checked="checked"> <span>физическое лицо</span></label> 
        </div>
        <div id="jur" class="switch_control <?if($_REQUEST['type'] == 'jurip' || $_REQUEST['type'] == 'jurooo') {?>active<?}?>">
            <label class="reg_type"><input type="radio" class="reg_type" value="2" <?if($_REQUEST['type'] == 'jurip' || $_REQUEST['type'] == 'jurooo') {?>CHECKED<?}?> name="reg_type"> <span>юридическое лицо</span></label>
        </div>
    </div>
    <div class="switch_content phizik <?if($_REQUEST['type'] != 'jurip' && $_REQUEST['type'] != 'jurooo') {?>active<?}?>">
   
        <form class="order_form phizik oferta-form" method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
            <input type="hidden" name="type" value="phizik">
            <input type="hidden" name="REGISTER[LOGIN]" value="<?=$arResult["VALUES"]["EMAIL"]?>">
        <?
        if($arResult["BACKURL"] <> ''):
        ?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?
        endif;
        ?>
            <div class="form_row">
                <div class="dual_col">
                    <div class="input_group">
                        <label><span class="star">*</span>Ваше имя</label>
                        <input type="text"  name="REGISTER[NAME]" value="<?=$arResult["VALUES"]["NAME"]?>" class="req">
                        <div class="note">Как к Вам обращаться?</div>
                    </div>
                </div>
                <div class="dual_col">
                    <div class="input_group">
                        <label><span class="star">*</span>Ваш личный пароль</label>
                        <input type="password" name="REGISTER[PASSWORD]" value="<?=$arResult["VALUES"]["PASSWORD"]?>" class="req">
                        <div class="note">Не менее 6ти символов</div>
                    </div>
                </div>
            </div>
            <div class="form_row">
                <div class="dual_col">
                    <div class="input_group">
                        <label><span class="star">*</span>E-mail</label>
                        <input size="30" type="text" class="req" name="REGISTER[EMAIL]" value="<?=$arResult["VALUES"]["EMAIL"]?>">
                        <div class="note">Будет Вашим логином</div>
                    </div>
                </div>
                <div class="dual_col">
                    <div class="input_group">
                        <label><span class="star">*</span>Пароль еще раз</label>
                        <input type="password" name="REGISTER[CONFIRM_PASSWORD]" value="<?=$arResult["VALUES"]["CONFIRM_PASSWORD"]?>" class="req">
                        <div class="note">&nbsp;</div>
                    </div>
                </div>
            </div>
            <div class="form_row">
                <div class="dual_col">
                    <div class="input_group">
                        <label><span class="star">*</span>Телефон (Х-ХХХ-ХХХ-ХХ-ХХ)</label>
                        <input type="text"  class="req" name="REGISTER[PERSONAL_PHONE]" value="<?=$arResult["VALUES"]["PERSONAL_PHONE"]?>">
                        <div class="note">Будет использован только для связи с Вами</div>
                    </div>
                </div>
                <div class="dual_col">
                </div>
            </div>
            <div class="clr"></div>
            <div class="oferta-wrap">
                <img width="50" src="<?=SITE_TEMPLATE_PATH?>/images/i35003.png"> <span style="color:red;">Обратите внимание!</span> Регистрируясь на нашем сайте, Вы принимаете <a href="#oferta" class="oferta-href">оферту.</a>

                <!-- Ссылки на вызов модальных окон-->

                <a class="overlay" id="oferta"></a>
                <div class="popup oferta-popup">
                    <?/*<a href="#close" title="Закрыть" class="close-1"></a>*/?>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "AREA_FILE_RECURSIVE" => "Y",
                            "PATH" => "/include/oferta.php"
                        )
                    );?>
                    <a class="close"title="Закрыть" href="#close"></a>
                </div>
            </div>
            <div class="button_holder">
                <input type="submit"  name="register_submit_button" class="button" value="зарегистрироваться">
                <p class="note">После регистрации Вы получите подтверждение на указанный e-mail,<br>подтвердив его, Вы можете продолжить оформление заказа, выбрав пункт «Войти»</p>
            </div>

        </form>
    </div>



    <div class="switch_content jur <?if($_REQUEST['type'] == 'jurip' || $_REQUEST['type'] == 'jurooo') {?>active<?}?>">
        <form class="order_form" action="">
            <div class="jur_types">
                <div id="ooo" class="switch_control active"><label><input type="radio" name="jur_type" <?if($_REQUEST['type']!='jurip'){?>checked="checked"<?}?>>ООО, ЗАО и др.</label></div>
                <div id="ip" class="switch_control"><label><input type="radio" <?if($_REQUEST['type']=='jurip'){?>checked="checked"<?}?> name="jur_type">ИП</label></div>
            </div>
        </form>
        <div class="switch_content ooo <?if($_REQUEST['type']!='jurip'){?>active<?}?>">
            <form class="wide_form jur ooo oferta-form" method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
                <input type="hidden" name="REGISTER[LOGIN]" value="<?=$arResult["VALUES"]["EMAIL"]?>">
                <input type="hidden" name="type" value="jurooo">
                <?
                if($arResult["BACKURL"] <> ''):
                ?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <?
                endif;
                ?>

                <div class="form_section">
                    <div class="form_section_title">Данные контактного лица</div>
                    <div class="form_row">
                        <div class="triple_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Фамилия</label>
                                <input type="text"  name="REGISTER[LAST_NAME]" value="<?=$arResult["VALUES"]["LAST_NAME"]?>" class="req">
                            </div>
                        </div>
                        <div class="triple_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Имя</label>
                                <input type="text" name="REGISTER[NAME]" value="<?=$arResult["VALUES"]["NAME"]?>" class="req">
                            </div>
                        </div>
                        <div class="triple_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Отчество</label>
                                <input type="text" name="REGISTER[SECOND_NAME]" value="<?=$arResult["VALUES"]["SECOND_NAME"]?>" class="req">
                            </div>
                        </div>
                        <div class="clr"></div>
                    </div>
                </div>
                <div class="form_section">
                    <div class="form_section_title">Данные организации</div>
                    <div class="form_row">
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Название компании (полное)</label>
                                <input type="text" name="UF_COMPANY_FULL" value="<?=$arResult["USER_PROPERTIES"]["DATA"]["UF_COMPANY_FULL"]["VALUE"]?>"  class="req">
                            </div>
                        </div>
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Название компании (краткое)</label>
                                <input type="text"  name="UF_COMPANY_SHORT" value="<?=$arResult["USER_PROPERTIES"]["DATA"]["UF_COMPANY_SHORT"]["VALUE"]?>"  class="req">
                            </div>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <div class="form_row">
                        <div class="triple_col">
                            <div class="input_group">
                                <label><span class="star">*</span>ИНН</label>
           							<input type="text"  name="UF_INN" value="<?=$arResult["USER_PROPERTIES"]["DATA"]["UF_INN"]["VALUE"]?>"  class="req inn-ooo">
	                            </div>
                        </div>
                        <div class="triple_col">
                            <div class="input_group">
                                <label><span class="star">*</span>КПП</label>
                                <input type="text"  name="UF_KPP" value="<?=$arResult["USER_PROPERTIES"]["DATA"]["UF_KPP"]["VALUE"]?>"  class="req kpp-ooo">

                            </div>
                        </div>
                        <div class="triple_col">
                            <div class="input_group">
                                <label><span class="star">*</span>ОГРН</label>
                                <input type="text"  name="UF_OGRN" value="<?=$arResult["USER_PROPERTIES"]["DATA"]["UF_OGRN"]["VALUE"]?>"  class="req ogrn-ooo">

                            </div>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <div class="form_row">
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Юридический адрес</label>
                                <textarea name="UF_ADDRESS_UR" rows="3"><?=$arResult["USER_PROPERTIES"]["DATA"]["UF_ADDRESS_UR"]["VALUE"]?></textarea>
                            </div>
                        </div>
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Фактический адрес</label>
                                <textarea name="UF_ADDRESS_POST" rows="3"><?=$arResult["USER_PROPERTIES"]["DATA"]["UF_ADDRESS_POST "]["VALUE"]?></textarea>
                            </div>
                        </div>
                        <div class="clr"></div>
                    </div>
                </div>
                <div class="form_section">
                    <div class="form_section_title">персональные данные</div>
                    <div class="form_row">
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>E-mail</label>
                                <input size="30" type="text" class="req" name="REGISTER[EMAIL]" value="<?=$arResult["VALUES"]["EMAIL"]?>">
                                <div class="note">Будет Вашим логином</div>
                            </div>
                        </div>
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Ваш личный пароль</label>
                                <input size="30" type="password" class="req" name="REGISTER[PASSWORD]" value="<?=$arResult["VALUES"]["PASSWORD"]?>">
                                <div class="note">Не менее 6ти символов</div>
                            </div>
                        </div>
                    </div>
                    <div class="form_row">
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Телефон (Х-ХХХ-ХХХ-ХХ-ХХ)</label>
                                <input type="text"  class="req" name="REGISTER[PERSONAL_PHONE]" value="<?=$arResult["VALUES"]["PERSONAL_PHONE"]?>">
                                <div class="note">Будет использован только для связи с Вами</div>
                            </div>
                        </div>
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Пароль еще раз</label>
                                <input type="password" name="REGISTER[CONFIRM_PASSWORD]" value="<?=$arResult["VALUES"]["CONFIRM_PASSWORD"]?>" class="req">
                                <div class="note">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="oferta-wrap">
                    <img width="50" src="<?=SITE_TEMPLATE_PATH?>/images/i35003.png"> <span style="color:red;">Обратите внимание!</span> Регистрируясь на нашем сайте, Вы принимаете <a href="#oferta2" class="oferta-href">оферту.</a>

                    <!-- Ссылки на вызов модальных окон-->

                    <a class="overlay" id="oferta2"></a>
                    <div class="popup oferta-popup">
                        <?/*<a href="#close" title="Закрыть" class="close-1"></a>*/?>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "PATH" => "/include/oferta.php"
                            )
                        );?>
                        <a class="close"title="Закрыть" href="#close"></a>
                    </div>
                </div>
                <div class="button_holder">
                    <input type="submit" class="button"  name="register_submit_button" value="зарегистрироваться">
                    <p class="note">Для завершения регистрации юридического лица Вам необходимо <br>приложить отсканированные документы, необходимые для заключения договора. <br>После их подтверждения вы сможете совершать покупки по оптовым ценам.</p>
                    <p class="note">Вы можете сделать это позже в Вашем личном кабинете.</p>
                </div>
            </form>
        </div>
        <div class="switch_content ip <?if($_REQUEST['type']=='jurip'){?>active<?}?>">
        <form class="wide_form jur ip oferta-form" method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
                <input type="hidden" name="type" value="jurip" />
                <input type="hidden" name="REGISTER[LOGIN]" value="<?=$arResult["VALUES"]["EMAIL"]?>" />
                <?
                if($arResult["BACKURL"] <> ''):
                ?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <?
                endif;
                ?>

                <div class="form_section">
                    <div class="form_section_title">Пасспортные данные</div>
                    <div class="form_row">
                        <div class="triple_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Фамилия</label>
                                <input type="text"  name="REGISTER[LAST_NAME]" value="<?=$arResult["VALUES"]["LAST_NAME"]?>" class="req">
                            </div>
                        </div>
                        <div class="triple_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Имя</label>
                                <input type="text" name="REGISTER[NAME]" value="<?=$arResult["VALUES"]["NAME"]?>" class="req">
                            </div>
                        </div>
                        <div class="triple_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Отчество</label>
                                <input type="text" name="REGISTER[SECOND_NAME]" value="<?=$arResult["VALUES"]["SECOND_NAME"]?>" class="req">
                            </div>
                        </div>
                        <div class="clr"></div>
                    </div>

                    <div class="form_row">
                        <div class="triple_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Серия паспорта</label>
                                    <input type="text"  name="UF_PASSPORT_SERIAL" value="<?=htmlspecialcharsex($_REQUEST['UF_PASSPORT_SERIAL'])?>"  class="req">
                                </div>
                        </div>
                        <div class="triple_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Номер паспорта</label>
                                <input type="text"  name="UF_PASSPORT_NUMBER" value="<?=htmlspecialcharsex($_REQUEST['UF_PASSPORT_NUMBER'])?>"  class="req">

                            </div>
                        </div>
                        <div class="triple_col">

                        </div>
                        <div class="clr"></div>
                    </div>


                    <div class="form_row">
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Кем выдан</label>
                                <textarea name="UF_PASSPORT_FROM" rows="3"><?=htmlspecialcharsex($_REQUEST['UF_PASSPORT_FROM'])?></textarea>
                            </div>
                        </div>

                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Код подразделения</label>
                                <input type="text"  name="UF_PASSPORT_FCODE" value="<?=htmlspecialcharsex($_REQUEST['UF_PASSPORT_FCODE'])?>"  class="req">
                            </div>
                            <div class="input_group">
                                <label><span class="star">*</span>Когда выдан</label>
                                <input type="text"  name="UF_PASSPORT_GIVE" value="<?=htmlspecialcharsex($_REQUEST['UF_PASSPORT_GIVE'])?>"  class="req">
                            </div>
                        </div>

                        <div class="clr"></div>
                    </div>


                    <div class="form_row">
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Дата рождения</label>
                                <input type="text" name="REGISTER[PERSONAL_BIRTHDAY]" value="<?=htmlspecialcharsex($_REQUEST['REGISTER']['PERSONAL_BIRTHDAY'])?>"   class="req">
                            </div>

                        </div>

                        <div class="dual_col">
   
                            <div class="input_group">
                                <label><span class="star">*</span>Адрес регистрации</label>
                                <textarea name="UF_ADDRESS_REG" rows="3"><?=htmlspecialcharsex($_REQUEST['UF_ADDRESS_REG'])?></textarea>
                            </div>
                        </div>

                        <div class="clr"></div>
                    </div>


                </div>    
                <div class="form_section">
                    <div class="form_section_title">Данные организации</div>
                    <div class="form_row">
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Название компании (полное)</label>
                                <input type="text" name="UF_COMPANY_FULL" value="<?=htmlspecialcharsex($_REQUEST['UF_COMPANY_FULL'])?>"  class="req">
                            </div>
                        </div>
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Название компании (краткое)</label>
                                <input type="text"  name="UF_COMPANY_SHORT" value="<?=htmlspecialcharsex($_REQUEST['UF_COMPANY_SHORT'])?>"  class="req">
                            </div>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <div class="form_row">
                        <div class="triple_col">
                            <div class="input_group">
                                <label><span class="star">*</span>ИНН</label>
                                    <input type="text"  name="UF_INN" value="<?=htmlspecialcharsex($_REQUEST['UF_INN'])?>"  class="req inn-ip">
                                </div>
                        </div>
                        <?/*<div class="triple_col">
                            <div class="input_group">
                                <label><span class="star">*</span>КПП</label>
                                <input type="text"  name="UF_KPP" value="<?=$arResult["USER_PROPERTIES"]["DATA"]["UF_KPP"]["VALUE"]?>"  class="req">

                            </div>
                        </div>
                        */?>
                        <div class="triple_col ogrn_custom">
                            <div class="input_group">
                                <label><span class="star">*</span>ОГРН</label>
                                <input type="text"  name="UF_OGRN" value="<?=htmlspecialcharsex($_REQUEST['UF_OGRN'])?>"  class="req ogrn-ip">

                            </div>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <div class="form_row">
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Юридический адрес</label>
                                <textarea name="UF_ADDRESS_UR" rows="3"><?=htmlspecialcharsex($_REQUEST['UF_ADDRESS_UR'])?></textarea>
                            </div>
                        </div>
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Почтовый адрес</label>
                                <textarea name="UF_ADDRESS_POST" rows="3"><?=htmlspecialcharsex($_REQUEST['UF_ADDRESS_POST'])?></textarea>
                            </div>
                        </div>
                        <div class="clr"></div>
                    </div>
                </div>
                <div class="form_section">
                    <div class="form_section_title">персональные данные</div>
                    <div class="form_row">
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>E-mail</label>
                                <input size="30" type="text" class="req" name="REGISTER[EMAIL]" value="<?=$arResult["VALUES"]["EMAIL"]?>">
                                <div class="note">Будет Вашим логином</div>
                            </div>
                        </div>
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Ваш личный пароль</label>
                                <input size="30" type="password" class="req" name="REGISTER[PASSWORD]" value="<?=$arResult["VALUES"]["PASSWORD"]?>">
                                <div class="note">Не менее 6ти символов</div>
                            </div>
                        </div>
                    </div>
                    <div class="form_row">
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Телефон (Х-ХХХ-ХХХ-ХХ-ХХ)</label>
                                <input type="text"  class="req" name="REGISTER[PERSONAL_PHONE]" value="<?=$arResult["VALUES"]["PERSONAL_PHONE"]?>">
                                <div class="note">Будет использован только для связи с Вами</div>
                            </div>
                        </div>
                        <div class="dual_col">
                            <div class="input_group">
                                <label><span class="star">*</span>Пароль еще раз</label>
                                <input type="password" name="REGISTER[CONFIRM_PASSWORD]" value="<?=$arResult["VALUES"]["CONFIRM_PASSWORD"]?>" class="req">
                                <div class="note">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="oferta-wrap">
                    <img width="50" src="<?=SITE_TEMPLATE_PATH?>/images/i35003.png"> <span style="color:red;">Обратите внимание!</span> Регистрируясь на нашем сайте, Вы принимаете <a href="#oferta3" class="oferta-href">оферту.</a>

                    <!-- Ссылки на вызов модальных окон-->

                <a class="overlay" id="oferta3"></a></a>
                    <div class="popup oferta-popup">
                        <?/*<a href="#close" title="Закрыть" class="close-1"></a>*/?>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "PATH" => "/include/oferta.php"
                            )
                        );?>
                        <a class="close"title="Закрыть" href="#close"></a>
                    </div>
                </div>
                <div class="button_holder">
                    <input type="submit" class="button"  name="register_submit_button" value="зарегистрироваться">
                    <p class="note">Для завершения регистрации юридического лица Вам необходимо <br>приложить отсканированные документы, необходимые для заключения договора. <br>После их подтверждения вы сможете совершать покупки по оптовым ценам.</p>
                    <p class="note">Вы можете сделать это позже в Вашем личном кабинете.</p>
                </div>
            </form>                                
        </div>
    </div>




<?/*



<div class="bx-auth-reg">




<table>
	<thead>
		<tr>
			<td colspan="2"><b><?=GetMessage("AUTH_REGISTER")?></b></td>
		</tr>
	</thead>
	<tbody>
<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
	<?if($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"] == true):?>
		<tr>
			<td><?echo GetMessage("main_profile_time_zones_auto")?><?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span class="starrequired">*</span><?endif?></td>
			<td>
				<select name="REGISTER[AUTO_TIME_ZONE]" onchange="this.form.elements['REGISTER[TIME_ZONE]'].disabled=(this.value != 'N')">
					<option value=""><?echo GetMessage("main_profile_time_zones_auto_def")?></option>
					<option value="Y"<?=$arResult["VALUES"][$FIELD] == "Y" ? " selected=\"selected\"" : ""?>><?echo GetMessage("main_profile_time_zones_auto_yes")?></option>
					<option value="N"<?=$arResult["VALUES"][$FIELD] == "N" ? " selected=\"selected\"" : ""?>><?echo GetMessage("main_profile_time_zones_auto_no")?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?echo GetMessage("main_profile_time_zones_zones")?></td>
			<td>
				<select name="REGISTER[TIME_ZONE]"<?if(!isset($_REQUEST["REGISTER"]["TIME_ZONE"])) echo 'disabled="disabled"'?>>
		<?foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name):?>
					<option value="<?=htmlspecialcharsbx($tz)?>"<?=$arResult["VALUES"]["TIME_ZONE"] == $tz ? " selected=\"selected\"" : ""?>><?=htmlspecialcharsbx($tz_name)?></option>
		<?endforeach?>
				</select>
			</td>
		</tr>
	<?else:?>
		<tr>
			<td><?=GetMessage("REGISTER_FIELD_".$FIELD)?>:<?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span class="starrequired">*</span><?endif?></td>
			<td><?
	switch ($FIELD)
	{
		case "PASSWORD":
			?><input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="bx-auth-input" />
<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure').style.display = 'inline-block';
</script>
<?endif?>
<?
			break;
		case "CONFIRM_PASSWORD":
			?><input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" /><?
			break;

		case "PERSONAL_GENDER":
			?><select name="REGISTER[<?=$FIELD?>]">
				<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
				<option value="M"<?=$arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_MALE")?></option>
				<option value="F"<?=$arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
			</select><?
			break;

		case "PERSONAL_COUNTRY":
		case "WORK_COUNTRY":
			?><select name="REGISTER[<?=$FIELD?>]"><?
			foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value)
			{
				?><option value="<?=$value?>"<?if ($value == $arResult["VALUES"][$FIELD]):?> selected="selected"<?endif?>><?=$arResult["COUNTRIES"]["reference"][$key]?></option>
			<?
			}
			?></select><?
			break;

		case "PERSONAL_PHOTO":
		case "WORK_LOGO":
			?><input size="30" type="file" name="REGISTER_FILES_<?=$FIELD?>" /><?
			break;

		case "PERSONAL_NOTES":
		case "WORK_NOTES":
			?><textarea cols="30" rows="5" name="REGISTER[<?=$FIELD?>]"><?=$arResult["VALUES"][$FIELD]?></textarea><?
			break;
		default:
			if ($FIELD == "PERSONAL_BIRTHDAY"):?><small><?=$arResult["DATE_FORMAT"]?></small><br /><?endif;
			?><input size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" /><?
				if ($FIELD == "PERSONAL_BIRTHDAY")
					$APPLICATION->IncludeComponent(
						'bitrix:main.calendar',
						'',
						array(
							'SHOW_INPUT' => 'N',
							'FORM_NAME' => 'regform',
							'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
							'SHOW_TIME' => 'N'
						),
						null,
						array("HIDE_ICONS"=>"Y")
					);
				?><?
	}?></td>
		</tr>
	<?endif?>
<?endforeach?>
<?// ********************* User properties ***************************************************?>
<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<tr><td colspan="2"><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></td></tr>
	<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
	<tr><td><?=$arUserField["EDIT_FORM_LABEL"]?>:<?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;?></td><td>
			<?$APPLICATION->IncludeComponent(
				"bitrix:system.field.edit",
				$arUserField["USER_TYPE"]["USER_TYPE_ID"],
				array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
	<?endforeach;?>
<?endif;?>
<?// ******************** /User properties ***************************************************?>

if ($arResult["USE_CAPTCHA"] == "Y")
{
	?>
		<tr>
			<td colspan="2"><b><?=GetMessage("REGISTER_CAPTCHA_TITLE")?></b></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
			</td>
		</tr>
		<tr>
			<td><?=GetMessage("REGISTER_CAPTCHA_PROMT")?>:<span class="starrequired">*</span></td>
			<td><input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>
	<?
}

?>
	</tbody>
	<tfoot>
		<tr>
			<td></td>
			<td><input type="submit" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>" /></td>
		</tr>
	</tfoot>
</table>
<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
<p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>
*/?>

<?endif?>
