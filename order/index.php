<?
define("NOT_LEFT_BLOCK", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
if($USER->IsAuthorized()) LocalRedirect('/order/new/');

CModule::IncludeModule('sale');
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
	
if($dbBasketItems->SelectedRowsCount() == 0) ShowError('Ваша корзина пуста');
else { 
?>

<div class="steps_block">
	<div class="steps">
		<div class="step active" id="step1">
			<div class="step_number">1</div>
			<div class="step_content">
				<a href="/cart/">Корзина</a>
			</div>
		</div>
		<div class="step current" id="step2">
			<div class="step_number">2</div>
			<div class="step_content"><span>Данные покупателя</span></div>
		</div>
		<div class="step" id="step3">
			<div class="step_number">3</div>
			<div class="step_content"><span>Оплата и доставка</span>
			</div>
		</div>
		<div class="step" id="step4">
			<div class="step_number">4</div>
			<div class="step_content"><span>Подтверждение</span>
			</div>
		</div>
	</div>
</div>


<div class='row'>
	<div class='span3 left_part'> 
		<div class="section_nav">
			<div class="order_side switch_control active" id="order_login">
				<label><input type="radio" name="order_type"  checked="checked" >Войти</label>
				<p>Авторизуйтесь, пожалуйста, и вы сможете продолжить оформление заказа.</p>
			</div>
			<div class="order_side switch_control" id="order_reg">
				<label><input type="radio" name="order_type">Зарегистрироваться</label>
				<p>Если у Вас нет аккаунта на нашем сайте, пожалуйста, зарегистрируйтесь и вы сможете продолжить оформление заказа.</p>
			</div>
			<?/*<div class="order_side switch_control" id="order_quick">
				<label><input type="radio" name="order_type">Купить в один клик</label>
				<p>Не хотите регистрироваться? Вы можете оформить быстрый заказ, выбрав покупку в один клик.</p>
			</div>*/?>
		</div>
		
		<div class='left-block'>
			<h1>ОПЛАТА И ДОСТАВКА</h1>
			<p>Обязательным условием для отправки живых цветов является соблюдение температурного режима.</p><p>Автомобили компании соответствуют всем требованиям транспортировки срезанных цветов и горшечных растений.</p>
			<a href='#'>ПОДРОБНЕЕ</a>
		</div>
	</div>
	<div class='span9 right_part'>
		<div class='content'>
			<div class="order_block">
				<div class="order_type switch_content order_login active">		
					<?$APPLICATION->IncludeComponent(
						"bitrix:system.auth.form", 
						"order", 
						array(
							"REGISTER_URL" => "/personal/registration/",
							"FORGOT_PASSWORD_URL" => "/auth/",
							"PROFILE_URL" => "profile.php",
							"SHOW_ERRORS" => "Y"
						),
						false
					);?>					
				</div>
				<div class="order_type switch_content order_reg">
					<?
					$APPLICATION->IncludeComponent(
						"bitrix:main.register", 
						"bbaccara2014", 
						array(
							"USER_PROPERTY_NAME" => "",
							"SEF_MODE" => "Y",
							"SHOW_FIELDS" => array(
								0 => "EMAIL",
								1 => "NAME",
								2 => "SECOND_NAME",
								3 => "LAST_NAME",
								4 => "PERSONAL_BIRTHDAY",
								5 => "PERSONAL_PHONE",
							),
							"REQUIRED_FIELDS" => array(
							),
							"AUTH" => "Y",
							"USE_BACKURL" => "Y",
							"SUCCESS_PAGE" => "/personal/registration/success.php",
							"SET_TITLE" => "N",
							"USER_PROPERTY" => array(
								0 => "UF_COMPANY_SHORT",
								1 => "UF_INN",
								2 => "UF_KPP",
								3 => "UF_OGRN",
								4 => "UF_ADDRESS_UR",
								5 => "UF_ADDRESS_FACT",
								6 => "UF_ADDRESS_POST",
								7 => "UF_PASSPORT_SERIAL",
								8 => "UF_PASSPORT_NUMBER",
								9 => "UF_PASSPORT_GIVE",
								10 => "UF_PASSPORT_FROM",
								11 => "UF_PASSPORT_FCODE",
								12 => "UF_ADDRESS_REG",
							),
							"SEF_FOLDER" => "/"
						),
						false
					); 
					?>
				</div>
				<?/*<div class="order_type switch_content order_quick">
					<h3>Всего 3 поля для оформления заказа</h3>
					<form class="order_form fast_order" name="fast_order" action="" method="POST">
						<div class="form_row">
							<div class="single_col">
								<div class="input_group">
									<label><span class="star">*</span>Ваше имя</label>
									<input type="text" name="NAME"  class="req">
									<div class="note">Как к Вам обращаться?</div>
								</div>
							</div>			 						
						</div>
						<div class="form_row">
							<div class="single_col">
								<div class="input_group">
									<label><span class="star">*</span>E-mail</label>
									<input type="email" name="email"  class="req">
									<div class="note">Будет Вашим логином</div>
								</div>
							</div>			 						
						</div>
						<div class="form_row">
							<div class="single_col">
								<div class="input_group">
									<label><span class="star">*</span>Телефон (Х-ХХХ-ХХХ-ХХ-ХХ)</label>
									<input type="text" name="phone" class="req phone">
									<div class="note">Будет использован только для связи с Вами</div>
								</div>
							</div>			 						
						</div>
						<div class="button_holder">
							<input type="submit" value="продолжить оформление заказа" class="button">			 						
						</div>
					</form>
				</div>*/?>
			</div>
		</div>
		<!-- end of .content -->
	</div>
</div>

<? } ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>