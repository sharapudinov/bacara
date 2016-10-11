<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$strTitle = "";

$arrClass = array(
	/*"one",*/
	"two",
	"three", 
	"four",
	"five",
	"six",
	"seven"
);


?>
<div class='span3 contact footer-left-menu'>
	<div class="bottom_menu"><a href='/catalog/'>КАТАЛОГ ТОВАРОВ</a></div>
<ul id='footer-menu'>

	
	<?
	$TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
	$CURRENT_DEPTH = 2;
	$i = 0;
	
	
	foreach($arResult["SECTIONS"] as $arSection)
	{
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
		$id = $this->GetEditAreaId($arSection['ID']);
		
		
		
		if($arSection['DEPTH_LEVEL'] == 1) { 
			$id = $arrClass[$i];
			if($arSection['UF_MAIN_LEVEL'] != 1)
			 $up_level = 1;
			else $up_level = 0;
		}
		
		
		
		$arSection['DEPTH_LEVEL'] += $up_level;
		
		$active = false;
		if(CSite::InDir($arSection['SECTION_PAGE_URL'])) { 
			$active = true;
		}
		
		
		
		if($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"])
		{
			$active_ul = '';
		
			if(CSite::InDir($last_link))
			 $active_ul = 'style="display:block"';
			 
			echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH),"<ul class=\"sub-menu\" ".$active_ul.">";
		}
		elseif($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"])
		{
			echo "</li>";
		}
		else
		{
			while($CURRENT_DEPTH > $arSection["DEPTH_LEVEL"])
			{
				echo "</li>";
				echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
				$CURRENT_DEPTH--;
			}
			echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</li>";
		}

		$count = $arParams["COUNT_ELEMENTS"] && $arSection["ELEMENT_CNT"] ? "&nbsp;(".$arSection["ELEMENT_CNT"].")" : "";

		if ($_REQUEST['SECTION_ID']==$arSection['ID'])
		{
			$link = '<b>'.$arSection["NAME"].$count.'</b>';
			$strTitle = $arSection["NAME"];
		}
		else
		{
			//<span class="arrow"></span>
			$arrow = '';
			$class = 'class="link"';
			if(($arSection['RIGHT_MARGIN'] - $arSection['LEFT_MARGIN']) > 1) { 
				$arrow = ' <span class="arrow"></span>';
				$class = '';
			}
		
			if($arSection['DEPTH_LEVEL'] == 1) 
				$link = '<a href="'.$arSection["SECTION_PAGE_URL"].'" '.$class.'><span class="ico"></span>'.$arSection["NAME"].$arrow.'</a>';
			else
				$link = '<a href="'.$arSection["SECTION_PAGE_URL"].'" '.$class.'>'.$arSection["NAME"].$count.'</a>';
		}

		echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH);
		
		if($id == 'two' && $arSection['DEPTH_LEVEL'] == 1) { 
			?></div><div class='span3 contact footer-left-menu'><?
		}
		?>
		
		<li id="<?=$id;?>" <?if($active){?>class="active"<?}?>><?=$link?><?

		$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
		
		if($arSection['DEPTH_LEVEL'] == 1)
		 $i++;
		 
		 $last_link = $arSection['SECTION_PAGE_URL'];
	}

	while($CURRENT_DEPTH > $TOP_DEPTH)
	{
		echo "</li>";
		echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
		$CURRENT_DEPTH--;
	}
	?>
</ul>
</div>
