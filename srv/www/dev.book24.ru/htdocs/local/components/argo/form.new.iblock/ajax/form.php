<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$formId = intval($_REQUEST["FORM_ID"]);
$params = unserialize($_SESSION["ALEXKOVA.MARKET"]["FORMS_PARAM"][$formId]);
if(!$_REQUEST["strIMessage"] && (!$formId || !is_array($params) || empty($params)))
	die("Error form id");
$params["AJAX"] = 'Y';
$params["FIRST"] = htmlspecialcharsbx($_REQUEST["first"]);
if ($_REQUEST["TARGET_URL"])
	$params["TARGET_URL"] = htmlspecialcharsbx($_REQUEST["TARGET_URL"]);
    echo '<pre>';
print_r($params);
echo '</pre>';
?>
<?$APPLICATION->IncludeComponent(
	"argo:iblock.element.add.form",
	"",
	$params,
	false
);?>