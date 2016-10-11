<?
AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserRegisterHandler");
AddEventHandler("sale", "OnSalePayOrder", "OnSalePayOrderSendOrgName");
AddEventHandler("main", "OnAfterUserRegister", Array("Integration", "OnAfterUserRegisterHandler"));
AddEventHandler("main", "OnBeforeUserUpdate", Array("UserUpdate", "OnBeforeUserUpdateHandler"));
AddEventHandler("sale", "OnBeforeBasketAdd", Array("Cart", "OnBeforeBasketAddCustom"));

class Cart {
    function OnBeforeBasketAddCustom(&$arFields) {
    
        CModule::includeModule('iblock');
        
        $arFilter = Array(
            "IBLOCK_ID" => 1,
            "ID" => $arFields['PRODUCT_ID']
        );

        $arSelect = Array(
            "ID",
            "IBLOCK_ID",
            "NAME",
            "PROPERTY_CML2_ARTICLE",
        );

        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        if ($ob = $res->Fetch()) {
            $arGoods = $ob;
        }

        if($arGoods['PROPERTY_CML2_ARTICLE_VALUE']) {
            $arFields["PROPS"][] = array(
                "NAME" => 'Артикул',
                "CODE" => 'CML2_ARTICLE',
                "VALUE" => $arGoods['PROPERTY_CML2_ARTICLE_VALUE'],
            );
        }
    }
}

class UserUpdate
{
    function OnBeforeUserUpdateHandler(&$arFields)
    {
        $rsUser = CUser::GetByID($arFields['ID']);
        $arUser = $rsUser->Fetch();

        foreach($arFields['UF_DOCS'] as $key => $value) {

            if(strlen($value['name']) > 0 && intval($value['size']) > 0 && $value['error'] == 0) {
                $file = CFile::GetFileArray($arUser['UF_DOCS'][$key]);
                if(!$file['SRC']) continue;
                //$docs[] = ($file['SRC']) ? '<a href="'.'http://baccara-decor.ru'.$file['SRC'].'">файл</a>' : "";
                $docs[] = $file['SRC'];
            }
        }

        if(count($docs)>0) {
             $arMailFields = array(
                'USERNAME' => $arUser['LAST_NAME'].' '.$arUser['NAME'],
                'ID' => $arFields['ID'],
                'EMAIL' => $arFields['EMAIL'],
                'PHONE' => $arUser['PERSONAL_PHONE'],
                'ADRESS' => $arFields['UF_ADDRESS_FACT']
            );
/*
            CEvent::Send('DOCS_ADDED', 's1', $arMailFields); */
        
            if(file_exists($_SERVER['DOCUMENT_ROOT']."/bitrix/php_interface/include/functions.php")) {
                require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/php_interface/include/functions.php");                
                SendAttache('DOCS_ADDED', 's1', $arMailFields, $docs);
                $event = 'null'; $lid = 'null';
            }
        
        }
    }
}

class Integration
{
    function OnAfterUserRegisterHandler(&$arFields) {
        $user = new CUser;

        $fields = Array(
            "UF_1C_ID" => htmlspecialcharsbx(substr($arFields['USER_ID']."#".$arFields['LOGIN']."#".$arFields["LAST_NAME"]." ".$arFields["NAME"]." ".$arFields["SECOND_NAME"], 0, 80)),
        );

        $user->Update($arFields['USER_ID'], $fields);
    }
}

function OnSalePayOrderSendOrgName($ID, $val)  {

    if($val == 'Y') {
        
        if(CModule::IncludeModule('sale')) {
            
            $arOrder = CSaleOrder::GetByID($ID);
            
            $org_name = (in_array($arOrder['PAY_SYSTEM_ID'], array(6, 7, 8))) ? 'ИП Серов С.И.' : 'ООО Блэк Баккара';
            
            $message = 'Заказ № '. $ID . ' на сумму ' . $arOrder['PRICE'] . ' руб. оплачен на ' . $org_name;
            
            //$delivery_payment = ($arOrder['ADDITIONAL_INFO'] == 'dpy') ? 'В платеж включена оплата логистики.' : 'Платеж без доставки.';
            switch($arOrder['ADDITIONAL_INFO']) {
                case 'dpn':
                    $delivery_payment = 'В сумму не включена оплата доставки';
                    break;
                case 'dpym':
                    $delivery_payment = 'В сумму включена доставка по Москве и МО';
                    break;
                case 'dpyr':
                    $delivery_payment = 'В сумму включена доставка по России';
                    break;        
            }
            
            $arMailFields = array(
                'MESSAGE'     => $message,
                'ORDER_ID'    => $ID,
                'ORGNAME'     => $org_name,
                'ORDER_PRICE' => $arOrder['PRICE'],
                'DELIVERY' => $delivery_payment
            );
        
            CEvent::Send('SEND_PAY_ORGNAME', 's1', $arMailFields);
        }
    }
}  

function OnBeforeUserRegisterHandler(&$arFields) {
	if($_POST['type'] == 'phizik') {
		$arFields["GROUP_ID"][] = 5;
	}
	elseif($_POST['type'] == 'jurooo'){
		$arFields["GROUP_ID"][] = 6;
	}
	elseif($_POST['type'] == 'jurip'){
		$arFields["GROUP_ID"][] = 7;
	}
}

    function declOfNum($number, $titles){
        $cases = array (2, 0, 1, 1, 1, 2);
        return $number . ' ' . $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)] ] . ' ';
    }