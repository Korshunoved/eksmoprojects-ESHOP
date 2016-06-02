<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var ArgoRegionController $this */

global $arRegionData;

if(!isset($arParams["CACHE_TIME"]))
    $arParams["CACHE_TIME"] = 36000000;

if (intval($_REQUEST["sr"]) > 0) {
    $this->setSessionRegionId($_REQUEST["sr"]);
    $this->setCoockieRegionId($_REQUEST["sr"]);
    LocalRedirect($APPLICATION->GetCurPageParam("", array("sr", "save")));
}

CModule::IncludeModule('iblock');
$autoDetect = false;
$this->init($arParams["IBLOCK_ID"]);
$currentRegionId = $this->getSessionRegionId();
if (intval($currentRegionId) <= 0) {
    $cookieRegionId = $this->getCoockieRegionId();
    $currentRegionId = $cookieRegionId;
}
if (intval($currentRegionId) <= 0) {
    $regionInfo = $this->getGeoIpRegion();
    $currentRegionId = $this->getRegionIdByInfo($regionInfo, $arParams["IBLOCK_ID"], $arParams["LOCATE_ACCURACY"]);
    $gpR = $currentRegionId;
    $autoDetect = true;
}
if (intval($currentRegionId) <= 0) {
    $currentRegionId = $this->getDefaultRegionId();
    $autoDetect = true;
}

$this->setSessionRegionId($currentRegionId);

$cacheParams = array($currentRegionId);

if($this->StartResultCache(false,$cacheParams))
{
    $regionsInfo = $this->getRegionInfo($currentRegionId, $arParams["IBLOCK_ID"], $arParams["PRODUCT_PROPERTIES"]);

    $arRegionData = $regionsInfo;
    $arRegionData["AUTO_DETECT"] = $autoDetect;
}
?>