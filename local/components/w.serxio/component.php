<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arResult = array();
 
if ($this->StartResultCache(false))
{
    if(!CModule::IncludeModule("iblock"))
        return;


    $arSort = array("ID"=>"ASC");
    $arFilter = array(
        "ACTIVE" => "Y",
        "IBLOCK_ID" => $arParams["IBLOCK_ID"]
    );
    $arNav = false;
    $arSelect = Array(
        "ID",
        "NAME",
        "DETAIL_PICTURE",
        "PROPERTY_ANIMAL_GROUP"
    );

    $arRes = CIBlockElement::GetList($arSort, $arFilter, false, $arNav, $arSelect);

    while($arBuff = $arRes->Fetch())
    {
        //$arBuff["DETAIL_PICTURE"] = CFile::GetFileArray($arBuff["DETAIL_PICTURE"]);
        
        $arResult["ITEMS"][] = $arBuff;
    }

    //$arResult["NAV_STRING"] = $arRes->GetPageNavStringEx($navComponentObject, "", "pagination", true);

    $this->IncludeComponentTemplate();
}?>