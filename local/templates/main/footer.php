		<?if(!defined("NOT_LEFT_BLOCK")) { ?>	
			 	</div>
			 	<!-- end of .content -->
 			</div>
 		</div>
		<? } ?>		
 	</div></div>
 	<footer>
  		<div id='footer'>
   			<a href="#" title="Вернуться к началу" class="topbutton"><img style='padding:2px 0 0 0;margin-bottom:-5px;'src="/img/naverh.png"  /></a>
  			<div id="footer-inner" class='container'>
				<div class="row relative-div">
					<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"foot", 
	array(
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_ID" => "1",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "N",
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "UF_MAIN_LEVEL",
			1 => "",
		),
		"VIEW_MODE" => "TILE",
		"SHOW_PARENT_NAME" => "Y",
		"SECTION_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_SECTION_NAME" => "N",
		"CACHE_INFO" => $APPLICATION->GetCurPage()
	),
	false
);?>				
					<?/*<div class='span3 contact'>
					  	<div class="bottom_menu"><a href='#'>КАТАЛОГ ТОВАРОВ</a></div>
						<ul id='footer-menu'>
						    <li><a href="#">Аксессуары и предметы декора</a></li>
							<li><a href="#">Букеты из мягких игрушек</a></li>
							<li><a href="#">Вазы</a></li>
							<li><a href="#">Корзины и кашпо</a></li>
							<li><a href="#">Лента</a></li>
							<li><a href="#">Продукция OASIS</a></li>
							<li><a href="#">Расходные материалы для садовников и флористов</a></li>
							<li><a href="#">Упаковачные материалы</a></li>
						</ul>
					</div>
					<div class='span3 contact'>
					 	<a href='#'>СЕЗОННЫЕ ТОВАРЫ</a>
						 <ul id='footer-menu'>
						    <li><a href="#">Пасха</a></li>
							<li><a href="#">Весенние подарки</a></li>
							<li><a href="#">Майские истории</a></li>
						</ul>
						<div class="bottom_menu">
							<a href='#'> ТОВАРЫ ДЛЯ ДОМА И САДА</a>
							<a href='#'> ПРОДУКЦИЯ OASIS</a>
							<a href='#'> НОВИНКИ</a>
							<a href='#'> СВАДЕБНЫЕ АКССЕСУАРЫ</a>
							<a href='#'> АКЦИИ</a>	
						</div>
					</div>*/?>
					<div class='contact span3 offset3'style='color:#757575;' >
					<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", Array(
	"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
		"MENU_CACHE_TIME" => "36000",	// Время кеширования (сек.)
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
		"MAX_LEVEL" => "1",	// Уровень вложенности меню
		"CHILD_MENU_TYPE" => "top",	// Тип меню для остальных уровней
		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
	),
	false
);?>					
						<p><?$APPLICATION->IncludeFile('/include/template/footer-phone.php');?></p>
 					</div>
                    
                        <div class="diff_statistics">
                            
                            <!-- TeamViewer Logo (generated at http://www.teamviewer.com) -->
                            <div style="position:relative; width:120px; height:60px; margin-bottom:25px;">
                              <a href="http://www.teamviewer.com/link/?url=505374&id=396575950" style="text-decoration:none;">
                                <img src="http://www.teamviewer.com/link/?url=979936&id=396575950" alt="TeamViewer для удалённой поддержки" title="TeamViewer для удалённой поддержки" border="0" width="120" height="60" />
                                <span style="position:absolute; top:25.5px; left:50px; display:block; cursor:pointer; color:White; font-family:Arial; font-size:10px; line-height:1.2em; font-weight:bold; text-align:center; width:65px;">
                                  Удалённая поддержка
                                </span>
                              </a>
                            </div>
                        
                            <!-- Yandex.Metrika informer -->
                            <a href="https://metrika.yandex.ru/stat/?id=30996256&amp;from=informer"
                            target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/30996256/3_1_FFFFFFFF_FFFFFFFF_0_pageviews"
                            style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" /></a>
                            <!-- /Yandex.Metrika informer -->

                            <!-- Yandex.Metrika counter -->
                            <script type="text/javascript">
                            (function (d, w, c) {
                                (w[c] = w[c] || []).push(function() {
                                    try {
                                        w.yaCounter30996256 = new Ya.Metrika({id:30996256,
                                                clickmap:true,
                                                trackLinks:true,
                                                accurateTrackBounce:true});
                                    } catch(e) { }
                                });

                                var n = d.getElementsByTagName("script")[0],
                                    s = d.createElement("script"),
                                    f = function () { n.parentNode.insertBefore(s, n); };
                                s.type = "text/javascript";
                                s.async = true;
                                s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                                if (w.opera == "[object Opera]") {
                                    d.addEventListener("DOMContentLoaded", f, false);
                                } else { f(); }
                            })(document, window, "yandex_metrika_callbacks");
                            </script>
                            <noscript><div><img src="//mc.yandex.ru/watch/30996256" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
                            <!-- /Yandex.Metrika counter -->
                        </div>
                    
 				</div>
 			</div>
 		</div>
 		<div id='razrabotka'>
 			<div class='container'>
 				<p style='float:left;color:#757575'><?$APPLICATION->IncludeFile('/include/template/footer-copy.php');?></p>
  				<p style='float:right; margin:0 60px 60px 0;color:#757575'><?$APPLICATION->IncludeFile('/include/template/maker.php')?></a></p>
 			</div>
 		</div>
 	</footer>
    <!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'JeVseVNYgj';
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
<!-- {/literal} END JIVOSITE CODE -->
  </body>
</html>