<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';

if(CModule::IncludeModule("iblock")) {

    $data['PHONE'] = mysql_escape_string(htmlspecialchars($_POST['phone']));
    $data['NAME'] = mysql_escape_string(htmlspecialchars($_POST['name']));
    $data['EMAIL'] = mysql_escape_string(htmlspecialchars($_POST['email']));

    $arParametrs = array(
        'IBLOCK_ID' => 9,        
        'NAME' => $_POST['phone'].'_'.$_POST['name'],            
        'ACTIVE' => 'Y',
        'PROPERTY_VALUES' => $data
    );

    $elem = new CIBlockElement;

    if($elem->Add($arParametrs)) {

        $arMailFields = array(
            'PHONE'   => $data['PHONE'],
            'NAME'    => $data['NAME'],
            'EMAIL'    => $data['EMAIL'],
        );
        
        CEvent::Send('FEEDBACK_CALL', 's1', $arMailFields);
    }
}   
    print_r(1);