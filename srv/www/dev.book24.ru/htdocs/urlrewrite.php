<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
	),
	array(
		"CONDITION" => "#^/personal/order/#",
		"RULE" => "",
		"ID" => "bitrix:sale.personal.order",
		"PATH" => "/personal/order/index.php",
	),
	array(
		"CONDITION" => "#^/translator/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/translator/index.php",
	),
	array(
		"CONDITION" => "#^/publisher/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/publisher/index.php",
	),
	array(
		"CONDITION" => "#^/product/#",
		"RULE" => "&\$1",
		"ID" => "bitrix:catalog.element",
		"PATH" => "/product/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/catalog.php",
	),
	array(
		"CONDITION" => "#^/genres/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/genres/index.php",
	),
	array(
		"CONDITION" => "#^/author/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/author/index.php",
	),
	array(
		"CONDITION" => "#^/artist/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/artist/index.php",
	),
	array(
		"CONDITION" => "#^/store/#",
		"RULE" => "",
		"ID" => "bitrix:catalog.store",
		"PATH" => "/store/index.php",
	),
	array(
		"CONDITION" => "#^/serie/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/serie/index.php",
	),
	array(
		"CONDITION" => "#^/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/news/index.php",
	),
);

?>