<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


    
global $USER;

$rsUser = $USER->GetList(($by="ID"), ($order="desc"), array("ID"=>$USER->GetID()), array("FIELDS"=>array("ID"), "SELECT"=>array("UF_BALANCE", "UF_DATE_BALANCE")));

$arResult['USER'] = $rsUser->GetNext(true, false);


$this->IncludeComponentTemplate();