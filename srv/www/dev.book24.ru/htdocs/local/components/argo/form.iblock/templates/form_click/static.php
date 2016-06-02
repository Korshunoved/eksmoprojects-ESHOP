<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->IncludeComponent(
	"argo:argo.element.add",
	"request_trade",
	$arParams,
	$component,
	array("HIDE_ICONS"=>"Y")
);?>