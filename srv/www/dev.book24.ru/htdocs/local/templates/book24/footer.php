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
                    "NAME_FROM_PROPERTY" => "152",
                    "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
                    "PROPERTY_CODES" => array("152"),
                    "PROPERTY_CODES_REQUIRED" => array("152"),
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
		"NAME_FROM_PROPERTY" => "164",
		"POPUP_TITLE" => "Оставить отзыв",
		"PROPERTY_CODES" => array(
			0 => "154",
			1 => "155",
			2 => "156",
			3 => "157",
			4 => "158",
			5 => "159",
			6 => "160",
			7 => "161",
			8 => "162",
			9 => "163",
			10 => "164",
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
<!--add scripts-->
<script src="<?=SITE_TEMPLATE_PATH?>/js/application.min.js"></script>
<script>

</script>

</body>
</html>
