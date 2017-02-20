<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?><!DOCTYPE html>
<html>  
  <head>
	<title><?$APPLICATION->ShowTitle()?></title>
   	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="/css/jquery.fancybox.css" rel="stylesheet">
	<link href="/css/jquery.bxslider.css" rel="stylesheet">
	<link href="/css/style.css" rel="stylesheet" media="screen">
    <link href="/css/iThing.css" rel="stylesheet" media="screen">
    <link href="/js/jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet" media="screen">
	<link href="/js/jquery-ui-1.11.4.custom/jquery-ui.structure.min.css" rel="stylesheet" media="screen">
	<?/*<link href="/js/jquery-ui-1.11.4.custom/jquery-ui.theme.min.min.css" rel="stylesheet" media="screen">*/?>
	<?/*<link rel='canonical' href='' />
    <link rel='shortlink' href='' />*/?>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="/js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <?/*<script src="/js/custom.js"></script>*/?>
    <?$APPLICATION->AddHeadScript("/js/custom.js");?>
	<?$APPLICATION->AddHeadScript("/js/my.js");?>
	<script src="/js/jquery.validate.min.js"></script>
	<script src="/js/localization/messages_ru.js"></script>
 	<script src="/js/jquery.prettyPhoto.js"></script>
 	<script src="/js/jquery.fancybox.js"></script>
 	<script src="/js/jquery.bxslider.min.js"></script>
	<link rel="stylesheet" href="/css/prettyPhoto.css">	
	<script src="/js/jquery.maskedinput.min.js"></script>
    <script src="/js/jQEditRangeSlider-min.js"></script>
    <?/*$APPLICATION->AddHeadScript("/local/templates/main/js/snow-fall.js");*/?>
     <?$APPLICATION->AddHeadScript("/local/templates/main/js/script.js");?>
	<?$APPLICATION->ShowHead();?>
	<?/*<link rel="icon" href="/favicon.ico" type="image/x-icon">*/?>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">	
	<!--[if lt IE 9]>
	<script type="text/javascript" src="/js/html5.js"></script>
	<![endif]-->
	<!--[if lt IE 9]>
	<script src="/js/IE9.js"></script>
	<![endif]-->

  </head>
 <body>
	<?$APPLICATION->ShowPanel()?>
    <?//if(!$USER->IsAdmin() && $APPLICATION->GetCurUri() != '/engineering works.php'):?>
        <?//LocalRedirect('/engineering works.php');?>
    <?//endif;?>
    <div class="all_ok all_ok2">Ваше обращение успешно отправлено. В ближайшее время с Вами свяжется менеджер</div>
 	<div class="container" style="position:relative">
        <div class="price_category-request_popup">
            <div class="price_category-popup-title">Изменена итоговая сумма</div>
            <div class="price_category-popup-img"><img src="/img/galka.png"></div>
            <div class="price_category-popup-text"></div>
            <div class="price_category-popup-text2"><a href="<?=$APPLICATION->GetCurUri()?>">Обновить</a></div>
            <div class="clr"></div>
        </div>
		<div class="template" rel="header">
        <?
            $id_user = $USER->GetID();
            $arGroups = $USER->GetUserGroupArray($id_user);
        ?>
        <input type="hidden" class="current_price_category" value="<?=(count(array_uintersect(array(8, 9), $arGroups, "strcasecmp")) > 0) ? 1 : 0;?>">
		<div class='row'>
			<div class='span3 header__auth'>
				<div class="user_panel" id='line-text'>
					<?global $USER; if (!$USER->IsAuthorized()):?>
					<a href="#win1">Войти</a>  | <a href="/personal/registration/">Зарегистрироваться</a>
					<?else:?>
					<?=$USER->GetLogin()?> <a href="/personal/">личный кабинет</a> | <a href="?logout=yes">Выйти</a>
					<?endif;?>
				</div>
  			</div>
			<div class='span4 offset5 header__cart'>
				<div class="top_basket" id="top_basket">
					<?$APPLICATION->IncludeFile('/include/add2basket.php', array(), array("MODE"=>"php"));?>

				</div>
			</div>
 		</div>
 		<div id='logo'>
			<?if($APPLICATION->GetCurPage() != '/') { ?>
			<a href="/">
			<? } ?>
				<?$APPLICATION->IncludeFile('/include/template/logo.php');?>
			<?if($APPLICATION->GetCurPage() != '/') { ?>
			</a>
			<? } ?>
		</div>
		<header>
	 		<div class='row '>
				<div class='span4'>
	 				<a href="#x" class="overlay" id="win1"></a>
					<div class="popup-3">
						<?$APPLICATION->IncludeComponent(
							"bitrix:system.auth.form", 
							"popup", 
							array(
								"REGISTER_URL" => "/personal/registration/",
								"FORGOT_PASSWORD_URL" => "/auth/",
								"PROFILE_URL" => "profile.php",
								"SHOW_ERRORS" => "Y"
							),
							false
						);?>
					</div>
					<div class='head-text'><?$APPLICATION->IncludeFile('/include/template/title.php');?></div>
				</div>
				
				<div class='span4 offset4'>
					<div class='head-text-right'><p><?$APPLICATION->IncludeFile('/include/template/phone.php');?></span></p></div>
					<div id='zvonok'>
						<a class="callback_link" href='#win2'>Обратный звонок</a>
						<a href="#x" class="overlay" id="win2"></a>
						<div class="popup-3">
						                                                
					<?if($_REQUEST['formresult'] == 'addok') { ?>	
						<div class="all_ok">Ваше обращение успешно отправлено. В ближайшее время с Вами свяжется менеджер</div>
						<script>
							$(function(){
								location.href='#win2';
							});
						</script>
					<? } elseif(0) {?>
<?$APPLICATION->IncludeComponent("bitrix:form.result.new","callme",Array(
        "SEF_MODE" => "Y", 
        "WEB_FORM_ID" => 1, 
        "LIST_URL" => "", 
        "EDIT_URL" => "", 
        "SUCCESS_URL" => "", 
        "CHAIN_ITEM_TEXT" => "", 
        "CHAIN_ITEM_LINK" => "", 
        "IGNORE_CUSTOM_TEMPLATE" => "Y", 
        "USE_EXTENDED_ERRORS" => "Y", 
        "CACHE_TYPE" => "A", 
        "CACHE_TIME" => "3600", 
        "SEF_FOLDER" => "/", 
        "VARIABLE_ALIASES" => Array(
        )
    )
);?> <? } else {?>

    <p style="color:#3a3a3a;font-size:18px;margin-bottom:-10px;padding:0 0 -10px 0;">ПЕРЕЗВОНИТЬ ВАМ?</p>
	<p style="color:#757575;font-size:13px;	line-height: 1.2;margin-top:20px;">Оставьте свой контактный номер телефона и наши операторы свяжутся с Вами</p>
	<div style="padding:30px;" class="cart-off-10">	
		<div class="callme" style="margin:0 0 0 0;">
            <form enctype="multipart/form-data" method="POST" action="/" name="SIMPLE_FORM_1" class="feedback_header">
                <span style="">Ваше имя</span><br>
                <input type="text" size="0" value="" name="form_text_1" class="inputtext feedback_header-name"><br>
                <span>Телефон</span><br>
                <input type="text" size="0" value="" name="form_text_2" class="inputtext feedback_header-phone"><br>
                <span>Email</span><br>
                <input type="text" size="0" value="" name="form_text_3" class="inputtext feedback_header-email">
                <div style="margin-bottom:0; padding:10px 0 0 0;" class="cart-off-6">
                    <input type="submit" value=" ОТПРАВИТЬ " name="web_form_submit" style="margin: 0 auto; width:140px;" class="btn-off-6">
                </div>
            </form>
        </div>				
		<a href="#close" title="Закрыть" class="close-1"></a>
	</div>
<?}?>
						</div>
					</div>
					<div id='vremya-raboti'><?$APPLICATION->IncludeFile('/include/template/time.php');?></div>
				</div>				

			</div>
 			<div class='row'>
				<div class='navi'>
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu", 
						"top", 
						array(
							"ROOT_MENU_TYPE" => "top",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "36000",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(
							),
							"MAX_LEVEL" => "1",
							"CHILD_MENU_TYPE" => "top",
							"USE_EXT" => "N",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N"
						),
						false
					);?>
					 <div id="search">
                        <form action="/search/">
                            <input name="q" value="" placeholder="Поиск по сайту" size="120" type="text" style='padding-left:5px;'><input type="submit" value="">		 	
                        </form>
					 </div>
				</div>
 			</div>
 		</header>

        <section class="fixpanel-top">
            <div class="fixpanel-container">
                <div class="inner-block">
                    <a href="/"><img width="50" height="50" src="/img/logo.png"></a>
                </div>
                <div class="inner-block catalog-top">
                    <a href="/catalog/">Каталог товаров</a>
                </div>
                <div class="search-top inner-block"> 
                    <form action="/search/">
                        <input name="q" value="" placeholder="Поиск по сайту" size="120" type="text" style='padding-left:5px;'><input type="submit" value="">		 	
                    </form>
                </div>
                <div class="top_basket">
                    <?$APPLICATION->IncludeFile('/include/add2basket.php', array(), array("MODE"=>"php"));?>
                </div>
                <div class="clr"></div>
            </div>            
        </section>        
	</div>	
	<?if($APPLICATION->GetCurPage() == '/') {?>
	<div class='row'>
		<div class='span12'>
			<?$APPLICATION->IncludeComponent("bitrix:news.list", "slider", Array(
	"IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
		"IBLOCK_ID" => "3",	// Код информационного блока
		"NEWS_COUNT" => "20",	// Количество новостей на странице
		"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
		"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
		"SORT_BY2" => "ID",	// Поле для второй сортировки новостей
		"SORT_ORDER2" => "DESC",	// Направление для второй сортировки новостей
		"FILTER_NAME" => "",	// Фильтр
		"FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(	// Свойства
			0 => "link_name",
			1 => "link",
			2 => "text2",
			3 => "",
		),
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "N",	// Учитывать права доступа
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"PAGER_TITLE" => "Новости",	// Название категорий
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"DISPLAY_DATE" => "N",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false
);?>
		</div>
	</div>
	<? } ?>
	<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", Array(

		),
		false
	);?>

			


	<?if(!defined("NOT_LEFT_BLOCK")) { ?>	
	<div class='row'>
			<div class='span3 left_part'>

		<?
	if(CSite::InDir('/actions/') && $APPLICATION->GetCurDir() != '/actions/') { 
	?>
	<div class="section_nav">
		<a class="back_link" href="/actions/"><span class="ico"></span>назад к списку акций</a>			
	</div>
	<? } ?>
			<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
			        "AREA_FILE_SHOW" => "sect", 
			        "AREA_FILE_SUFFIX" => "inc", 
			        "AREA_FILE_RECURSIVE" => "Y", 
			        "EDIT_TEMPLATE" => "" 
			    )
			);?>

			<?$APPLICATION->IncludeFile('/include/sonet-block.php');?>
				
			</div>
	
 			<div class='span9 right_part'>
			 	<div class='content'>
					<?if($APPLICATION->GetCurPage() != '/' && !defined("NOT_SHOW_TITLE")) { ?>
						<h1 class="page_title"><?=$APPLICATION->ShowTitle(false)?></h1>
						<?if(strpos($APPLICATION->GetCurPage(), 'catalog')):?>
							<div style="color:red; margin-bottom:10px; font-weight: bold;">Внимание! В связи с колебанием курса валют, итоговая цена может измениться.</div>
						<?endif;?>
					<? } ?>
	<? } ?>
	
