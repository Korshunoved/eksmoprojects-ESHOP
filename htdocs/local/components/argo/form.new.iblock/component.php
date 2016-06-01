<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var $this \Alexkova\Corporate\FormNewIblockComponent */

if($arParams["MODE"] == 'link')
{
	CJSCore::Init(array("popup"));
	$_SESSION["ALEXKOVA.MARKET"]["FORMS_PARAM"][$arParams["IBLOCK_ID"]] = serialize($arParams);
}

$this->includeComponentTemplate();