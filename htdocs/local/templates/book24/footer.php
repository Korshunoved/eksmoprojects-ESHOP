<?
if (array_key_exists('is_ajax', $_REQUEST) && $_REQUEST['is_ajax']=='y') {
    return;
}
?>
</main>
</div>

<footer>
    <div class="contentPart">
        
        <?
            $APPLICATION->IncludeComponent(
                    "bitrix:menu", 
                    "bottom", 
                    Array(
                        "ROOT_MENU_TYPE" => "bottom",	// Тип меню для первого уровня
                        "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                        "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                        "MAX_LEVEL" => "1",	// Уровень вложенности меню
                        "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => "bottom",	// Тип меню для остальных уровней
                        "MENU_THEME" => "site"
                    ),
                    false
            );
        ?>
        
        <div class="footerSocActivity">
            <div class="yaMarket">
                <a href="#" class="label">Рейтинг магазина на Яндекс.Маркете</a>
                <div class="starLine">
                    <div class="starDark"></div>
                    <div class="starDark"></div>
                    <div class="starDark"></div>
                    <div class="starDark"></div>
                    <div class="star"></div>
                </div>
            </div>
            <div class="socBlock">
                <div class="label">Присоединяйтесь к нам</div>
                <a href="#" class="item fb"> </a>
                <a href="#" class="item vk"></a>
                <a href="#" class="item tw"> </a>
            </div>
        </div>
        <div class="payMentMethods">
            <div class="label">Все виды оплаты</div>
            <div class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_visa.svg"> </div>
            <div class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_mastercard.svg"> </div><br>
            <div class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_beeline.svg"> </div>
            <div class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_megafon.svg"> </div>
            <div class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_mts.svg"> </div>
            <div class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_tele2.svg"> </div><br>
            <div class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_roselecom.svg"> </div>
            <div class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_qiwi.svg" style="max-height: 35px"> </div>
            <div class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_yandex.svg" style="max-height: 35px"> </div>
            <div class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_webmoney.svg"> </div>
        </div>
    </div>
</footer>

<!--Callback form-->
<div class="simpleDialog callOrder">
    <?$APPLICATION->IncludeComponent(
            "argo:iblock.element.add.form",
            "callback",
            Array(
                    "DEFAULT_INPUT_SIZE" => "30",
                    "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
                    "ELEMENT_ASSOC" => "CREATED_BY",
                    "GROUPS" => array("2"),
                    "IBLOCK_ID" => "20",
                    "IBLOCK_TYPE" => "forms",
                    "LEVEL_LAST" => "Y",
                    "LIST_URL" => "",
                    "MAX_FILE_SIZE" => "0",
                    "MAX_LEVELS" => "500",
                    "MAX_USER_ENTRIES" => "500",
                    "NAME_FROM_PROPERTY" => "142",
                    "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
                    "PROPERTY_CODES" => array("142"),
                    "PROPERTY_CODES_REQUIRED" => array("142"),
                    "RESIZE_IMAGES" => "N",
                    "SEF_MODE" => "N",
                    "STATUS" => "INACTIVE",
                    "STATUS_NEW" => "ANY",
                    "USER_MESSAGE_ADD" => "",
                    "USER_MESSAGE_EDIT" => "",
                    "USE_CAPTCHA" => "N"
            )
    );?>
</div>
<div class="simpleDialog thankYou">
    <div class="clickbleArea" onclick="closeForms()"></div>
    <div class="popUpForm">
        <div class="closeBtn" onclick="closeForms()"></div>
        <div class="largeImage">
            <img src="<?=SITE_TEMPLATE_PATH;?>/images/hello.svg">
        </div>
        <div class="text">Спасибо! Ожидайте звонка</div>
    </div>
</div>
<!--end callback form-->

    <?$APPLICATION->IncludeComponent(
	"argo:form.iblock", 
	"request_trade", 
	array(
		"BUTTON_TEXT" => "",
		"EVENT_CLASS" => "open-comment-form",
		"GROUPS" => array(
			0 => "2",
		),
		"IBLOCK_ID" => "21",
		"IBLOCK_TYPE" => "forms",
		"MAX_FILE_SIZE" => "0",
		"MODE" => "link",
		"NAME_FROM_PROPERTY" => "155",
		"POPUP_TITLE" => "Оставить отзыв",
		"PROPERTY_CODES" => array(
			0 => "145",
			1 => "146",
			2 => "147",
			3 => "148",
			4 => "149",
			5 => "150",
			6 => "151",
			7 => "152",
			8 => "153",
			9 => "154",
			10 => "155",
		),
		"RESIZE_IMAGES" => "Y",
		"SEND_EVENT" => "KZNC_NEW_FORM_RESULT",
		"STATUS_NEW" => "NEW",
		"USER_MESSAGE_ADD" => "Ваш отзыв принят и отправлен на проверку модератором!",
		"USE_CAPTCHA" => "N",
		"COMPONENT_TEMPLATE" => "request_trade"
	),
	false
);?>
    <?$APPLICATION->IncludeComponent(
	"argo:form.iblock", 
	"request_trade", 
	array(
		"BUTTON_TEXT" => "",
		"EVENT_CLASS" => "open-review-form",
		"GROUPS" => array(
			0 => "2",
		),
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "directory",
		"MAX_FILE_SIZE" => "0",
		"MODE" => "link",
		"NAME_FROM_PROPERTY" => "101",
		"POPUP_TITLE" => "Написать рецензию",
		"PROPERTY_CODES" => array(
			0 => "91",
			1 => "92",
			2 => "97",
			3 => "98",
			4 => "99",
			5 => "100",
			6 => "101",
			7 => "102",
		),
		"RESIZE_IMAGES" => "Y",
		"SEND_EVENT" => "KZNC_NEW_FORM_RESULT",
		"STATUS_NEW" => "NEW",
		"USER_MESSAGE_ADD" => "Ваша рецензия добавлена и отправлена на проверку модератором!",
		"USE_CAPTCHA" => "N",
		"COMPONENT_TEMPLATE" => "request_trade"
	),
	false
);?>
    <?$APPLICATION->IncludeComponent(
	"argo:form.new.iblock", 
	"form_click", 
	array(
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => "19",
		"STATUS_NEW" => "NEW",
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_ADD" => "Заказ оформлен!",
		"RESIZE_IMAGES" => "N",
		"MODE" => "link",
		"PROPERTY_CODES" => array(
			0 => "131",
			1 => "132",
			2 => "133",
			3 => "134",
			4 => "135",
			5 => "136",
			6 => "137",
			7 => "138",
			8 => "139",
			9 => "140",
			10 => "204",
		),
		"NAME_FROM_PROPERTY" => "136",
		"GROUPS" => array(
			0 => "2",
		),
		"MAX_FILE_SIZE" => "0",
		"EVENT_CLASS" => "bxr-one-click-buy",
		"BUTTON_TEXT" => "",
		"POPUP_TITLE" => "Заказ в 1 клик",
		"SEND_EVENT" => "KZNC_NEW_FORM_CLICK_RESULT",
		"COMPONENT_TEMPLATE" => "form_click"
	),
	false
);?>
    <?/*$APPLICATION->IncludeComponent(
	"argo:form.iblock", 
	"form_click", 
	array(
		"IBLOCK_TYPE" => "forms",
		"IBLOCK_ID" => "32",
		"STATUS_NEW" => "NEW",
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_ADD" => "Предзаказ оформлен!",
		"RESIZE_IMAGES" => "N",
		"MODE" => "link",
		"PROPERTY_CODES" => array(
			0 => "204",
			1 => "205",
			2 => "206",
			3 => "207",
			4 => "208",
			5 => "209",
			6 => "210",
			7 => "211",
			8 => "212",
			9 => "221",
		),
		"NAME_FROM_PROPERTY" => "209",
		"GROUPS" => array(
			0 => "2",
		),
		"MAX_FILE_SIZE" => "0",
		"EVENT_CLASS" => "bxr-preorder-buy",
		"BUTTON_TEXT" => "",
		"POPUP_TITLE" => "Предзаказ товара",
		"SEND_EVENT" => "KZNC_NEW_FORM_CLICK_RESULT",
		"COMPONENT_TEMPLATE" => "form_click"
	),
	false
);*/?>
<!--add scripts-->
<script src="<?=SITE_TEMPLATE_PATH?>/js/application.min.js"></script>
<script>

</script>

</body>
</html>
