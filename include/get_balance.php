<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';

    function GetInfoAboutUser($userId) {
        GLOBAL $USER;
        $rsUser = $USER->GetList(($by="ID"), ($order="desc"), array("ID"=>$userId), array('FIELDS'=>array('ID', 'LAST_NAME', 'NAME', 'SECOND_NAME')));

        $arUser = $rsUser->GetNext(true, false);
        
        return $arUser;
    }
    
    global $USER;
    
    $rsUser = $USER->GetList(($by="ID"), ($order="desc"), array("ID"=>$USER->GetID()), array("FIELDS"=>array("ID"), "SELECT"=>array("UF_BALANCE", "UF_DATE_BALANCE")));

    $arResult['USER'] = $rsUser->GetNext(true, false);
    
    //$delta = 0.00001;
    //$result = (abs($_POST['cur_balance'] - $arResult['USER']['UF_BALANCE']) < $delta) ? false : json_encode($arResult['USER']);
    $result = (($_POST['cur_date'] == $arResult['USER']['UF_DATE_BALANCE']) || $arResult['USER']['UF_DATE_BALANCE'] == '') ? false : json_encode($arResult['USER']);
            
    $id_user = $USER->GetID();
    
    $arUser = GetInfoAboutUser($id_user);
    
    $id_user_1c = $USER->GetID().'#'.$USER->GetEmail().'#'.$arUser['LAST_NAME'].' '.$arUser['NAME'].' '.$arUser['SECOND_NAME'];
                    
    if(file_exists($_SERVER['DOCUMENT_ROOT']. '/upload/get_balance/ids.txt')) {
        $file_content = file_get_contents($_SERVER['DOCUMENT_ROOT']. '/upload/get_balance/ids.txt');
        $ids = explode('---', $file_content);
    }
    
    $write_user = (count($ids)>0) ? !in_array($id_user_1c, $ids) : true;
    
    $path = $_SERVER['DOCUMENT_ROOT'].'/upload/get_balance/test.xml';        
    $arUser = simplexml_load_file($path); 
    
    foreach($arUser as $user) {
        $user_ids[] = $user->ID;
    }
    
    if(count($user_ids) > 0) {

        if($write_user) {
            $f = fopen($_SERVER['DOCUMENT_ROOT']. '/upload/get_balance/ids.txt', 'a+');
            fputs($f, $id_user_1c.'---');
            fclose($f);
        }
    }
    else {

        if(count($ids)>0) {
            $ids = array_diff($ids, array(''));
            if($write_user) {
                $ids[] = $id_user_1c;
            }
        }
        else {
            $ids[] = $id_user_1c;
        }
        
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->startDocument('1.0', 'windows-1251');
            $xml->startElement("КоммерческаяИнформация");                
                $xml->writeAttribute("ВерсияСхемы", "2.05");
                $xml->writeAttribute("ДатаФормирования", date("Y-m-d")."T".date("G:i:s"));
                $xml->writeAttribute("ФорматДаты", "ДФ=yyyy-MM-dd; ДЛФ=DT");
                $xml->writeAttribute("ФорматВремени", "ДФ=ЧЧ:мм:сс; ДЛФ=T");
                $xml->writeAttribute("РазделительДатаВремя", "T");
                $xml->writeAttribute("ФорматСуммы", "ЧЦ=18; ЧДЦ=2; ЧРД=.");
                $xml->writeAttribute("ФорматКоличества", "ЧЦ=18; ЧДЦ=2; ЧРД=.");
   
                foreach($ids as $user_id) {
                    $xml->startElement("ИнформацияПользователя");
                        $xml->writeElement("ID", $user_id);
                    $xml->endElement();                
                }
            $xml->endElement();

        $f = fopen($_SERVER['DOCUMENT_ROOT']. '/upload/get_balance/test.xml', 'w');
        if(fputs($f, $xml->outputMemory())) {
            unlink($_SERVER['DOCUMENT_ROOT']. '/upload/get_balance/ids.txt');
        }
        fclose($f);
    }
    
    print_r($result);