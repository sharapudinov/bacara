<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>

<?

/* 	$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter, array("FIELDS"=>array(">DATE_REGISTER"=>"31.05.2016"))); // выбираем пользователей
	$is_filtered = $rsUsers->is_filtered; // отфильтрована ли выборка ?
	$rsUsers->NavStart(50); // разбиваем постранично по 50 записей
	echo $rsUsers->NavPrint(GetMessage("PAGES")); // печатаем постраничную навигацию
	echo '<br>-----------------<br>';
	while($rsUsers->NavNext(true, "f_")) :
		echo $f_EMAIL.'<br>';	
	endwhile;	 */  
    
    
    $cUser = new CUser; 
    $sort_by = "ID";
    $sort_ord = "ASC";
    $arFilter = array(
       "DATE_REGISTER_1" => "05.05.2016 16:28:00",
       "DATE_REGISTER_2" => "31.05.2016 17:59:59",
       "ACTIVE" => 'Y',
    );
    $dbUsers = $cUser->GetList($sort_by, $sort_ord, $arFilter);
    ?>
    <table>
    <?
    $i = 0;
    while ($arUser = $dbUsers->Fetch()) 
    {
        $users[] = $arUser;
        $i++;
        ?>
        
            <tr>
                <td><?=$i.')'?></td>
                <td style="padding:0 10px;"><?=$arUser["EMAIL"]?></td>
                <td><?=$arUser["DATE_REGISTER"]?></td>
            </tr>
    <?}?>
    </table><br><br><br>
    <?
/*     foreach($users as $user) {
        echo $user["EMAIL"].', ';
    } */
    
    ?>
        


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>