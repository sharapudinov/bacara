<?php
/**
 * Created by PhpStorm.
 * User: shara
 * Date: 16.10.2016
 * Time: 0:03
 */


$confirmed_oferts = $USER->GetByID($USER->GetID())->GetNext()['UF_CONFIRMED_OFERTS'];

$requered_ofert = requered_ofert_for_user($USER->GetID());

if (in_array($requered_ofert, $confirmed_oferts)) {
    $arResult['CONFIRMED'] = true;
} else {
    $arResult['CONFIRMED'] = false;
    $arFilter = [
        "ID" => $requered_ofert,
        "IBLOCK_ID" => 10];
    $arResult['OFERTA'] = CIBlockElement::GetList([], $arFilter)->GetNext()['DETAIL_TEXT'];
    $arResult['REQUIRED_OFERT']=$requered_ofert;
    $arResult['CONFIRMED_OFERTS']=$confirmed_oferts;
}


