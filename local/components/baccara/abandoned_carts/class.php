<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * Class QsoftEvaluationEmployeesComponent
 *
 * @description Компонент "Оценка сотрудников"
 */
class AbandonedCarts extends CBitrixComponent {
     public function onPrepareComponentParams($params) {
        if (!\Bitrix\Main\Loader::includeModule('iblock') || !\Bitrix\Main\Loader::includeModule('sale')) {
			ShowError("Не установлен модуль информационных блоков");		
            return false;
        }					
		
        return $params;
    }

    public function executeComponent() {
    
        $this->arResult['SEND_LETTER_SUCCESS'] = false;
        
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_letter-submit'])) {
            //echo '<pre>'; print_r($_POST); echo '</pre>';
            
            $arMailFields = array(        
                'EMAIL'         => $_POST['letter_receiver'],
                'MESSAGE'       => $_POST['letter_text'],
                'THEME'       => $_POST['letter_theme'],
            );
           
            if(CEvent::Send('CART_CLIENT_LETTER', 's1', $arMailFields)) {
                $this->arResult['SEND_LETTER_SUCCESS'] = true;;
            }
            
        }
        else {
            $arBasketItems = array();

            $dbBasketItems = CSaleBasket::GetList(
                    array(
                            "ID" => "DESC"
                        ),
                    array(
                            "ORDER_ID" => "NULL",
                            "!USER_ID" => false,
                        ),
                    false,
                    false,
                    array("ID", "DATE_UPDATE", "MODULE", 
                          "PRODUCT_ID", "QUANTITY", "DELAY", 
                          "CAN_BUY", "PRICE", "WEIGHT", "FUSER_ID", "USER_ID")
                );
                        
            while ($arItems = $dbBasketItems->Fetch()) {
                $this->arResult["CARTS"][$arItems['USER_ID']][] = $arItems;
                $this->arResult["CARTS"][$arItems['USER_ID']]['AMOUNT_SUMM'] += $arItems['PRICE']*$arItems['QUANTITY'];
                if(!$this->arResult["CARTS"][$arItems['USER_ID']]['DATE_UPDATE'])
                    $this->arResult["CARTS"][$arItems['USER_ID']]['DATE_UPDATE'] = $arItems['DATE_UPDATE'];
                if(count($this->arResult["CARTS"]) >= $this->arParams['CART_COUNT']) {
                    break;
                }
            }
            
            foreach($this->arResult["CARTS"] as $user_id => $value) {
                $user_ids[] = $user_id;
            }
            
            $str_users = implode("|", $user_ids);
            
            //echo '<pre>'; print_r($str_users); echo '</pre>';
            
            $filter = array("ID" => $str_users);
            
            $rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter);
            while($arUsers = $rsUsers->Fetch()) {
                 $this->arResult['USERS'][$arUsers['ID']] = $arUsers;
            }
            
        }
            $this->IncludeComponentTemplate();
    }
}