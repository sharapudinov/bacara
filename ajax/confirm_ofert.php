<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
/**
 * Created by PhpStorm.
 * User: shara
 * Date: 16.10.2016
 * Time: 23:24
 */
global $USER;
$ofert_id=$_REQUEST['ofert_id'];

$confirmed_oferts = $USER->GetByID($USER->GetID())->GetNext()['UF_CONFIRMED_OFERTS'];
$confirmed_oferts[]=$ofert_id;
$user=new CUser();

$arFields=[
  "UF_CONFIRMED_OFERTS"=> $confirmed_oferts
];
$user->Update($USER->GetID(),$arFields);


