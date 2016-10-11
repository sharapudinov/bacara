<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 - Страница не найдена");
$APPLICATION->SetPageProperty('TITLE', "404 - Страница не найдена");
?>

<h1 class="title-l">К сожалению, такой страницы нет!</h1> 
<p>Вы можете перетий на <a href="/">Главную страницу</a> или перейти в следующий раздел сайта:</p>
<div class="footer-nav">
	<div class="col">
		<?$APPLICATION->IncludeComponent("bitrix:main.map", ".default", Array(
	"LEVEL"	=>	"3",
	"COL_NUM"	=>	"1",
	"SHOW_DESCRIPTION"	=>	"Y",
	"SET_TITLE"	=>	"Y",
	"CACHE_TIME"	=>	"36000000"
	)
);?>
	</div>
</div>



<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>