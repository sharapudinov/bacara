<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';

$res = 0;

if(isset($_REQUEST['del_position']) && count($_REQUEST['del_position']) > 0) {
    
    if(CModule::IncludeModule('sale')) {
        
        foreach($_REQUEST['del_position'] as $key => $position) {
            if(CSaleBasket::Delete($position)) {
                unset($_REQUEST['del_position'][$key]);
            }
        }
        
        if(count($_REQUEST['del_position']) == 0)
            $res = 1;
            
    }
}

print_r($res);