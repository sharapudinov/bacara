<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>
<?
function human_filesize($bytes, $decimals = 2) {  
  $sz = 'BKMGTP';  
  $factor = floor((strlen($bytes) - 1) / 3);  
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];  
} 
?>


<div class="bx-auth-profile">
<?ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
	ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>

<?//print_r($arResult["USER_PROPERTIES"])?>

<form class="wide_form" method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
	<?=$arResult["BX_SESSION_CHECK"]?>
	<input type="hidden" name="lang" value="<?=LANG?>" />
	<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
	<input type="hidden" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>">
	<input type="hidden" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>">

    <input type="hidden" name="method_type" class="method_type" value="<?=$_SERVER['REQUEST_METHOD']?>">
    
	<div class="form_section_title">здесь вы можете приложить необходимые документы</div>

	<?foreach ($arResult["USER_PROPERTIES"]["DATA"]["UF_DOCS"]['VALUE'] as $key => $value):
		$file = CFile::GetFileArray($value);?>
		<div class="document_list">
			<div class="document_item">
				<input type="hidden" name="UF_DOCS_old_id[]" value="<?=$value?>">
				<input name="UF_DOCS[]" size="0" type="file" >
				<div class="document_number"><?=$key+1?>.</div>
				<div class="document_title">
					<?=$file['ORIGINAL_NAME']?>
				<label><input value="<?=$value?>" type="checkbox" name="UF_DOCS_del[]" id="UF_DOCS_del[]">
					Удалить файл</label> 
				</div>
				<div class="document_name"><?=human_filesize($file['FILE_SIZE'])?></div>

			</div>
		</div>

	<?endforeach;?>
	


	<div class="documents_new">
		<div class="new_document">
			<input type="hidden" name="UF_DOCS_old_id[]" value="">
        	<input name="UF_DOCS[]" type="file">
			<div class="document_number"></div>
			<div class="document_title">Добавить документ</div>
		</div>
		<div class="new_document">
			<input type="hidden" name="UF_DOCS_old_id[]" value="">
        	<input name="UF_DOCS[]" type="file">
			<div class="document_number"></div>
			<div class="document_title">Добавить документ</div>
		</div>
		<div class="new_document">
			<input type="hidden" name="UF_DOCS_old_id[]" value="">
        	<input name="UF_DOCS[]" type="file">
			<div class="document_number"></div>
			<div class="document_title">Добавить документ</div>
		</div>
		
		<div class="new_document">
			<input type="hidden" name="UF_DOCS_old_id[]" value="">
        	<input name="UF_DOCS[]" type="file">
			<div class="document_number"></div>
			<div class="document_title">Добавить документ</div>
		</div>
		<div class="new_document">
			<input type="hidden" name="UF_DOCS_old_id[]" value="">
        	<input name="UF_DOCS[]" type="file">
			<div class="document_number"></div>
			<div class="document_title">Добавить документ</div>
		</div>
		<div class="new_document">
			<input type="hidden" name="UF_DOCS_old_id[]" value="">
        	<input name="UF_DOCS[]" type="file">
			<div class="document_number"></div>
			<div class="document_title">Добавить документ</div>
		</div>
		
		<div class="new_document">
			<input type="hidden" name="UF_DOCS_old_id[]" value="">
        	<input name="UF_DOCS[]" type="file">
			<div class="document_number"></div>
			<div class="document_title">Добавить документ</div>
		</div>
		<div class="new_document">
			<input type="hidden" name="UF_DOCS_old_id[]" value="">
        	<input name="UF_DOCS[]" type="file">
			<div class="document_number"></div>
			<div class="document_title">Добавить документ</div>
		</div>
		<div class="new_document">
			<input type="hidden" name="UF_DOCS_old_id[]" value="">
        	<input name="UF_DOCS[]" type="file">
			<div class="document_number"></div>
			<div class="document_title">Добавить документ</div>
		</div>
		
		<div class="new_document">
			<input type="hidden" name="UF_DOCS_old_id[]" value="">
        	<input name="UF_DOCS[]" type="file">
			<div class="document_number"></div>
			<div class="document_title">Добавить документ</div>
		</div>
	</div>
    
    <div class="input_group">
        <p style="color:red;">Перед тем как прикрепить документы, необходимо заполнить поле "Фактический адрес":</p>
        <label><span class="star">*</span>Фактический адрес</label>
        <textarea name="UF_ADDRESS_FACT" rows="3"><?=$arResult["USER_PROPERTIES"]["DATA"]["UF_ADDRESS_REG"]["VALUE"]?></textarea>
    </div>
    
    
	<div class="button_holder"><input type="submit" class="button" name="save" value="сохранить"></div>
</form>

</div>