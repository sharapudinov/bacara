<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>



<div class="bx-auth-profile">
<?ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
	ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>


<form class="wide_form" method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
<input type="hidden" name="LOGIN" value="<? echo $arResult["arUser"]["LOGIN"]?>">

	<div class="form_section">
	    <div class="form_section_title">ДАННЫЕ КОНТАКТНОГО ЛИЦА</div>
	    <div class="form_row">
	        <div class="triple_col">
	            <div class="input_group">
	                <label><span class="star">*</span>Фамилия</label>
	                <input type="text"  name="LAST_NAME" value="<?=$arResult["arUser"]["LAST_NAME"]?>" class="req">
	            </div>
	        </div>
	        <div class="triple_col">
	            <div class="input_group">
	                <label><span class="star">*</span>Имя</label>
	                <input type="text" name="NAME" value="<?=$arResult["arUser"]["NAME"]?>" class="req">
	            </div>
	        </div>
	        <div class="triple_col">
	            <div class="input_group">
	                <label><span class="star">*</span>Отчество</label>
	                <input type="text" name="SECOND_NAME" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" class="req">
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
                    <input type="text" name="WORK_COMPANY" value="<?=$arResult["USER_PROPERTIES"]["DATA"]["UF_COMPANY_FULL"]["VALUE"]?>"  class="req">
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
                        <input type="text"  name="UF_INN" value="<?=$arResult["USER_PROPERTIES"]["DATA"]["UF_INN"]["VALUE"]?>"  class="req">
                    </div>
            </div>
            <div class="triple_col">
                <div class="input_group">
                    <label><span class="star">*</span>КПП</label>
                    <input type="text"  name="UF_KPP" value="<?=$arResult["USER_PROPERTIES"]["DATA"]["UF_KPP"]["VALUE"]?>"  class="req">

                </div>
            </div>
            <div class="triple_col">
                <div class="input_group">
                    <label><span class="star">*</span>ОГРН</label>
                    <input type="text"  name="UF_OGRN" value="<?=$arResult["USER_PROPERTIES"]["DATA"]["UF_OGRN"]["VALUE"]?>"  class="req">

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
                    <label><span class="star">*</span>Почтовый адрес</label>
                    <textarea name="UF_ADDRESS_POST" rows="3"><?=$arResult["USER_PROPERTIES"]["DATA"]["UF_ADDRESS_POST"]["VALUE"]?></textarea>
                </div>
            </div>
            <div class="clr"></div>
        </div>
    </div>


	<div class="form_section">
		<div class="form_row">
			<div class="dual_col">
				<div class="form_section_title">персональные данные</div>
				<div class="input_group">
					<label><span class="star">&nbsp;</span>E-mail</label>
					<input size="30" type="text" class="req" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>">
					<div class="note">Используется в качестве логина</div>
				</div>
				<div class="input_group">
					<label><span class="star">*</span>Телефон (Х-ХХХ-ХХХ-ХХ-ХХ)</label>
					<input type="text"  class="req" name="PERSONAL_PHONE" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>">
					<div class="note">Будет использован только для связи с Вами</div>
				</div>
			</div>

			<div class="dual_col">
				<?if($arResult["arUser"]["EXTERNAL_AUTH_ID"] == ''):?>
				<div class="change_pass">
					<div class="form_section_title">Сменить пароль</div>
					<div class="input_group">
						<label>Новый пароль</label>
						<input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="bx-auth-input"  class="req">
					</div>
					<div class="input_group">
						<label>Новый пароль еще раз</label>
						<input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" class="req">
					</div>
				</div>
				<?endif?>
			</div>
		</div>
	</div>	
	<div class="form_section">
		<div class="button_holder"><input type="submit" class="button" name="save" value="сохранить"></div>
	</div>























</form>
<?
if($arResult["SOCSERV_ENABLED"])
{
	$APPLICATION->IncludeComponent("bitrix:socserv.auth.split", ".default", array(
			"SHOW_PROFILES" => "Y",
			"ALLOW_DELETE" => "Y"
		),
		false
	);
}
?>
</div>