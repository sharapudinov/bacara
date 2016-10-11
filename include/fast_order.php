<?
require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';
CModule::IncludeModule('iblock');
CModule::IncludeModule('catalog');
CModule::IncludeModule('sale');

function parseFIOString($fio_string) {
	$fio_string = trim($fio_string);
	if (!strpos($fio_string, ' ')) return array($fio_string);
	$fio_parts = explode(' ', $fio_string);
	return array($fio_parts[0], $fio_parts[1]);
}

$arBasketItems = array();

$dbBasketItems = CSaleBasket::GetList(
        array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
        array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL"
            ),
        false,
        false,
        array("ID", "CALLBACK_FUNC", "MODULE", 
              "PRODUCT_ID", "QUANTITY", "DELAY", 
              "CAN_BUY", "PRICE", "WEIGHT", "NAME")
    );
$q = 0;
$price = 0;
$orderList = '';
while ($arItems = $dbBasketItems->Fetch())
{
    $arBasketItems[] = $arItems;
	$q += $arItems['QUANTITY'];
	$price += $arItems['QUANTITY'] * $arItems['PRICE'];
	$orderList .= '<p>'.$arItems['NAME'].' '.$arItems['QUANTITY'].' шт. ('.$arItems['PRICE'].' руб/шт)</p>';
}

$email = $_POST['email'];

if($q > 0) { 
	
	$dbUser = CUser::GetList(($by = 'ID'), ($order = 'ASC'), array('=EMAIL' => $_POST['email']));
	if ($dbUser->SelectedRowsCount() == 0) {
		$login = 'user_' . (microtime(true) * 100);
		$newUserRegister = true;
	} elseif ($dbUser->SelectedRowsCount() >= 1) {
		$ar_user = $dbUser->Fetch();
		$registeredUserID = $ar_user['ID'];
	} 

	$sendLetterToUser = true;	


	if ($newUserRegister) {
		$use_captcha = COption::GetOptionString("main", "captcha_registration", "N");
		if ($use_captcha == 'Y')
			COption::SetOptionString("main", "captcha_registration", "N");
		$userPassword = randString(10);
		$userFIO = parseFIOString($_POST['NAME']);
		$newUser = $USER->Register(
			$login,
			$userFIO[0],
			$userFIO[1],
			$userPassword,
			$userPassword,
			$_POST['email']
		);
		if ($use_captcha == 'Y')
			COption::SetOptionString("main", "captcha_registration", "Y");
		if ($newUser['TYPE'] == 'ERROR')
			die(getResultJsonArray(GetMessage('1CB_USER_REGISTER_FAIL'), 'N', $newUser['MESSAGE']));
		$registeredUserID = $USER->GetID();
		if (!empty($_POST['phone']))
			$userUpd = $USER->Update($registeredUserID, array('PERSONAL_PHONE' => $_POST['phone']));
		
	}
	
	
	
	
	$newOrder = array(
		'LID' => SITE_ID,
		'PERSON_TYPE_ID' => intval($_POST['personTypeId'])>0? $_POST['personTypeId']: 1,
		'PAYED' => 'N',
		'CURRENCY' => 'RUB',
		'USER_ID' => $registeredUserID,
		"DELIVERY_ID" => 1,
		"PAY_SYSTEM_ID" => 1,
		"PRICE" => $price
	);
	$newOrderID = CSaleOrder::Add($newOrder);
	
	
	$arFields = array(
	   "ORDER_ID" => $newOrderID,
	   "ORDER_PROPS_ID" => 1,
	   "NAME" => "Email",
	   "VALUE" => $_POST['email']
	);
	CSaleOrderPropsValue::Add($arFields);	
	
	$arFields = array(
	   "ORDER_ID" => $newOrderID,
	   "ORDER_PROPS_ID" => 4,
	   "NAME" => "Телефон",
	   "VALUE" => $_POST['phone']
	);
	CSaleOrderPropsValue::Add($arFields);	
	

	$arFields = array(
	   "ORDER_ID" => $newOrderID,
	   "ORDER_PROPS_ID" => 5,
	   "NAME" => "ФИО",
	   "VALUE" => $_POST['NAME']
	);
	CSaleOrderPropsValue::Add($arFields);	
	
	
	CSaleBasket::OrderBasket($newOrderID);
	
	if ($newUserRegister) {
		$USER->Logout();
	}
	
		$letterFields = array(
			'ORDER_ID' => $newOrderID, 
			'ORDER_DATE' => date('d.m.Y'),
			'ORDER_USER' => $_POST['NAME'],
			'PRICE' => $price,
			'EMAIL' => $email,
			'BCC' => !empty($bcc)? implode(',', $bcc) : '',
			'ORDER_LIST' => $orderList,
			'SALE_EMAIL' => COption::GetOptionString('sale', 'order_email', 'sales@'.SITE_SERVER_NAME),
			"DELIVERY_PRICE" => 'сообщит менеджер',
		);
		CEvent::SendImmediate("SALE_NEW_ORDER", SITE_ID, $letterFields, $duplicate);	 
		
		
		?>
		&nbsp;&nbsp;&nbsp;Ваш заказ успешно оформлен. В ближайшее время с Вами свяжется менеджер
		<script>
			$(function(){
				$("h3").hide();
			});
		</script>
		<?
}
?>