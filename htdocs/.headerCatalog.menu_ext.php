<? 
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); 
global $APPLICATION;
         
$aMenuLinksExt = $APPLICATION->IncludeComponent( 
    "bitrix:menu.sections", 
    "", 
    Array( 
        "IS_SEF" => "Y", 
        "ID" => $_REQUEST["ID"], 
        "IBLOCK_TYPE" => "catalog", 
        "IBLOCK_ID" => "2", 
        "SECTION_URL" => "", 
        "DEPTH_LEVEL" => "2", 
        "CACHE_TYPE" => "Y", 
        "CACHE_TIME" => "36000000", 
        "SEF_BASE_URL" => "/catalog/", 
        "SECTION_PAGE_URL" => "#SECTION_CODE#/", 
        "DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#/",
    ) 
); 

foreach ($aMenuLinksExt as &$val){ 
    $val["DEPTH_LEVEL"]++; 
} 

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt); 
?>
