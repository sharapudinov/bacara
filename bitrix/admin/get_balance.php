<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if($_REQUEST['type'] == 'balance') {
    if($_GET["mode"] == "checkauth" && $USER->IsAuthorized()) {    
        echo "success\n";
        echo session_name()."\n";
        echo session_id() ."\n";
        echo bitrix_sessid_get()."\n";
    }    
    else if($_REQUEST['mode'] == 'create_file') {
        //Read http data
        if (function_exists("file_get_contents"))
            $DATA = file_get_contents("php://input");        
        else
            $DATA = false;

        $DATA_LEN = defined("BX_UTF")? mb_strlen($DATA, 'latin1'): strlen($DATA);
        //And save it the file
        if (isset($DATA) && $DATA !== false)
        {
            $PATH = $_SERVER["DOCUMENT_ROOT"].'/upload/get_balance/balance_result.xml';
            CheckDirPath($PATH);
            if($fp = fopen($PATH, "w"))
            {
                $result = fwrite($fp, $DATA);
                if ($result === $DATA_LEN)
                {
                    echo "success\n";                    
                    $_SESSION["BX_CML2_IMPORT"]["zip"] = $ABS_FILE_NAME;
                }
                else
                {
                    echo "failure1";
                }
            }
            else
            {
                echo "failure2";
            }
        }
        else
        {
            echo "failure3";
        }
    }
    else if($_REQUEST['mode'] == 'set_balance') {

        if(CModule::IncludeModule('sale')) {

            global $DB, $USER;

            $path = $_SERVER['DOCUMENT_ROOT'].'/upload/get_balance/balance_result.xml';        
            $balances = simplexml_load_file($path);    

            foreach($balances as $balance) {
                $user_id = IntVal($balance->id_user);
                $balance_value = $balance->value;

                $user = new CUser;

                $fields = Array(
                    "UF_BALANCE" => $balance_value,
                    "UF_DATE_BALANCE" => date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), time()),
                );

                $user->Update($user_id, $fields);
                $strError .= $user->LAST_ERROR;

                //echo '</pre>'; print_r($strError); echo '</pre>';
            }

            if(strlen($strError) == 0) {
            //    unlink($_SERVER['DOCUMENT_ROOT']. '/upload/get_balance/test.xml');
            //    unlink($_SERVER['DOCUMENT_ROOT']. '/upload/get_balance/balance_result.xml');
            
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

                        if(file_exists($_SERVER['DOCUMENT_ROOT']. '/upload/get_balance/ids.txt')) {
                            $file_content = file_get_contents($_SERVER['DOCUMENT_ROOT']. '/upload/get_balance/ids.txt');
                            $ids = explode('---', $file_content);
                        }
                        
                        if(count($ids)>0) {
                            $ids = array_diff($ids, array(''));
                            foreach($ids as $user_id) {
                                $xml->startElement("ИнформацияПользователя");
                                    $xml->writeElement("ID", $user_id);
                                $xml->endElement();                
                            }
                        }
                        
                    $xml->endElement();

                $f = fopen($_SERVER['DOCUMENT_ROOT']. '/upload/get_balance/test.xml', 'w');
                if(fputs($f, $xml->outputMemory()))
                    unlink($_SERVER['DOCUMENT_ROOT']. '/upload/get_balance/ids.txt');
                fclose($f);
            }
        }
    }
}
else {
    echo "failure\Ошибка1";
}