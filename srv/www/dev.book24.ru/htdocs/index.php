<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Book 24");
?>
    <section class="mainPageSliderSection">
        <div class="contentPart">
            <?$APPLICATION->IncludeComponent("bitrix:news.list", "main_slider", Array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
                            "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
                            "AJAX_MODE" => "N",	// Включить режим AJAX
                            "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                            "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                            "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                            "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
                            "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
                            "CACHE_GROUPS" => "Y",	// Учитывать права доступа
                            "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                            "CACHE_TYPE" => "A",	// Тип кеширования
                            "CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
                            "DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                            "DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
                            "DISPLAY_DATE" => "N",	// Выводить дату элемента
                            "DISPLAY_NAME" => "N",	// Выводить название элемента
                            "DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
                            "DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
                            "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
                            "FIELD_CODE" => array(	// Поля
                                    0 => "NAME",
                                    1 => "PREVIEW_TEXT",
                                    2 => "PREVIEW_PICTURE",
                                    3 => "",
                            ),
                            "FILTER_NAME" => "",	// Фильтр
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
                            "IBLOCK_ID" => "15",	// Код информационного блока
                            "IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
                            "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
                            "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
                            "NEWS_COUNT" => "20",	// Количество новостей на странице
                            "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
                            "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
                            "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
                            "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
                            "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
                            "PAGER_TITLE" => "Новости",	// Название категорий
                            "PARENT_SECTION" => "",	// ID раздела
                            "PARENT_SECTION_CODE" => "",	// Код раздела
                            "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
                            "PROPERTY_CODE" => array(	// Свойства
                                    0 => "LINK",
                                    1 => "",
                            ),
                            "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
                            "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
                            "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
                            "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
                            "SET_STATUS_404" => "N",	// Устанавливать статус 404
                            "SET_TITLE" => "N",	// Устанавливать заголовок страницы
                            "SHOW_404" => "N",	// Показ специальной страницы
                            "SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
                            "SORT_BY2" => "ID",	// Поле для второй сортировки новостей
                            "SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
                            "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
                    ),
                    false
            );?>
            <div class="rightPromo">
                <div class="whiteSectionItem mdBlock">
                    <div class="image">
                        <div class="promoLabel"></div>
                        <img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/promo/1.png">
                    </div>
                    <a href="#" class="title">Фестиваль «Книжный сдвиг</a>
                    <div class="text">Самое важное событие весны</div>

                </div>
                <div class="whiteSectionItem mdBlock">
                    <div class="image">
                        <div class="promoLabel"></div>
                        <img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/6.jpg">
                    </div>
                    <a href="#" class="title">Школа 2016</a>
                    <div class="text">Лучшие сборники для подготовки к ЕГЭ</div>
                </div>
                <div class="whiteSectionItem mdBlock">
                    <div class="image">
                        <div class="promoLabel viewsLabel"></div>
                        <img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/promo/2.png">
                    </div>
                    <a href="#" class="title">Новый год со скидкой</a>
                    <div class="text">Самые волшебные рождественские книги для детей и взрослых</div>
                </div>
            </div>
        </div>
    </section>

    <div class="contentPart">
        <a href="#" class="simpleTitle">Бестселлеры</a>
    </div>
    <?
        global $arrBest;
        $arrBest['PROPERTY_SALELEADER'] = 5;
    ?>
    <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"main_page", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/cart/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "arrBest",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_CART_PROPERTIES" => "",
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_LIMIT" => "5",
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "desc",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "10",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_DISPLAY_MODE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(
			0 => "STATUS",
			1 => "NEWPRODUCT",
			2 => "SALELEADER",
			3 => "SPECIALOFFER",
			4 => "POPULAR",
			5 => "AUTOGRAPH",
			6 => "",
		),
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "Y",
		"SEF_RULE" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => "main_page"
	),
	false
);?>

    <div class="contentPart">
        <a href="#" class="simpleTitle">Подборки редакции</a>
    </div>

    <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"main_page_selection", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "N",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "14",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "10",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "SOURCE",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"COMPONENT_TEMPLATE" => "main_page_selection",
                "LIST_FIELD_CODE" => array(0=>"SHOW_COUNTER",1=>"",),
                "DETAIL_FIELD_CODE" => array(0=>"SHOW_COUNTER",1=>"",)
	),
	false
    );?>

    <div class="contentPart">
        <a  href="#" class="simpleTitle">Новинки</a>
        <div class="subTitle">Купите книгу по предзаказу и получите свой<br> экземляр в день начала продаж</div>
    </div>

    <?
        global $arrNew;
        $arrNew['PROPERTY_NEWPRODUCT'] = 4;
    ?>
    <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"main_page", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/cart/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "arrNew",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_CART_PROPERTIES" => "",
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_LIMIT" => "5",
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "desc",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "10",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_DISPLAY_MODE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(
			0 => "STATUS",
			1 => "NEWPRODUCT",
			2 => "SALELEADER",
			3 => "SPECIALOFFER",
			4 => "POPULAR",
			5 => "AUTOGRAPH",
			6 => "",
		),
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "Y",
		"SEF_RULE" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => "main_page"
	),
	false
    );?>

    <section class="subscribeSection">
        <div class="contentPart">
            <div class="simpleTitle">Делимся хорошими новостями,<br> присоединяйтесь!</div>
            <div class="subTitle">Акции, новости, специальные предложения и подарки </div>
            <?
                $APPLICATION->IncludeComponent("bitrix:sender.subscribe", "book24", Array(
                            "AJAX_MODE" => "Y",	// Включить режим AJAX
                            "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                            "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                            "AJAX_OPTION_JUMP" => "Y",	// Включить прокрутку к началу компонента
                            "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
                            "CACHE_TIME" => "3600",	// Время кеширования (сек.)
                            "CACHE_TYPE" => "A",	// Тип кеширования
                            "COMPONENT_TEMPLATE" => ".default",
                            "CONFIRMATION" => "Y",	// Запрашивать подтверждение подписки по email
                            "SET_TITLE" => "N",	// Устанавливать заголовок страницы
                            "SHOW_HIDDEN" => "N",	// Показать скрытые рассылки для подписки
                            "USE_PERSONALIZATION" => "Y",	// Определять подписку текущего пользователя
                    ),
                    false
                );
            ?>
            <div class="footerBookSide">
                <div class="iconLeft_1 book24_icons"></div>
                <div class="iconLeft_2 book24_icons"></div>
                <div class="iconLeft_3 book24_icons"></div>
                <div class="iconLeft_4 book24_icons"></div>
                <div class="iconRight_1 book24_icons"></div>
                <div class="iconRight_2 book24_icons"></div>
                <div class="iconRight_3 book24_icons"></div>
                <div class="iconRight_4 book24_icons"></div>
                <div class="iconRight_5 book24_icons"></div>
                <div class="bookList">
                    <div class="book_1"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/subscribe/1.png"> </div>
                    <div class="book_2"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/subscribe/2.png"></div>
                    <div class="book_3"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/subscribe/3.png"></div>
                    <div class="book_4"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/subscribe/4.png"></div>
                    <div class="book_5"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/subscribe/5.png"></div>
                    <div class="book_6"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/subscribe/6.png"></div>
                    <div class="book_7"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/subscribe/7.png"></div>
                    <div class="book_8"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/subscribe/8.png"></div>
                    <div class="book_9"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/subscribe/9.png"></div>
                    <div class="book_10"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/subscribe/10.png"></div>
                    <div class="book_11"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/subscribe/11.png"></div>
                    <div class="book_12"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/subscribe/12.png"></div>
                    <div class="book_13"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/subscribe/13.png"></div>
                    <div class="book_14"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/subscribe/14.png"></div>
                    <div class="book_15"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/subscribe/15.png"></div>
                    <div class="book_16"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/subscribe/16.png"></div>
                </div>
            </div>

        </div>
    </section>

    <div class="contentPart">
        <a href="#" class="simpleTitle">Книги со скидкой от издательства</a>
        <div class="subTitle">У нас книги по самым низким ценам,<br>  без наценки перекупщиков</div>
    </div>

    <?
        global $arrSale;
        $arrSale['PROPERTY_SPECIALOFFER'] = 6;
    ?>
    <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"main_page", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/cart/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "arrSale",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_CART_PROPERTIES" => "",
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_LIMIT" => "5",
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "desc",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "10",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_DISPLAY_MODE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(
			0 => "STATUS",
			1 => "NEWPRODUCT",
			2 => "SALELEADER",
			3 => "SPECIALOFFER",
			4 => "POPULAR",
			5 => "AUTOGRAPH",
			6 => "",
		),
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "Y",
		"SEF_RULE" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => "main_page"
	),
	false
    );?>

    <section class="yellowSection">
        <a  href="#" class="simpleTitle">Персональная скидка</a>
        <div class="subTitle">Успейте воспользоваться скидкой на книги  из вашей библиотеки</div>
        <div class="itemsSliderSection">
            <button type="button" value="" class="rightBtn"></button>
            <button type="button" value="" class="leftBtn"></button>
            <div class="contentPart">
                <div class="itemSlider">
                    <ul class="itemSliderInc">
                        <li class="sliderCoverSmall">
                            <div class="whiteSectionItem">
                                <div class="specialLabel">
                                    <div class="red"></div>
                                </div>
                                <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/5.png"> </div>
                                <div class="bookDescr">
                                    <div class="title">Зимние идеи от авторов «Находилок»</div>
                                    <div class="sectionFooter">
                                        <div class="discount">20% скидка</div>
                                        <div class="price"><span class="oldPrice">12 804 р.</span> 1 179 р.</div>
                                        <a href="#" class="lightBorderBtn">Купить</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="sliderCoverSmall">
                            <div class="whiteSectionItem">
                                <div class="specialLabel">
                                    <div class="red"></div>
                                </div>
                                <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/6.png"></div>
                                <div class="title">Зимние идеи от авторов «Находилок»</div>
                                <div class="sectionFooter">
                                    <div class="discount">20% скидка</div>
                                    <div class="price"><span class="oldPrice">12 804 р.</span> 1 179 р.</div>
                                    <a href="#" class="lightBorderBtn">Купить</a>
                                </div>
                            </div>
                        </li>


                        <li class="sliderCoverSmall">
                            <div class="whiteSectionItem">
                                <div class="specialLabel">
                                    <div class="red"></div>
                                </div>
                                <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/7.png"></div>
                                <div class="title">Зимние идеи от авторов «Находилок»</div>
                                <div class="sectionFooter">
                                    <div class="discount">20% скидка</div>
                                    <div class="price"><span class="oldPrice">12 804 р.</span> 1 179 р.</div>
                                    <a href="#" class="lightBorderBtn">Купить</a>
                                </div>
                            </div>
                        </li>


                        <li class="sliderCoverSmall">
                            <div class="whiteSectionItem">
                                <div class="specialLabel">
                                    <div class="red"></div>
                                </div>
                                <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/3.png"></div>
                                <div class="title">Как получать удовольствие от общения?</div>
                                <div class="sectionFooter">
                                    <div class="discount">20% скидка</div>
                                    <div class="price"><span class="oldPrice">12 804 р.</span> 1 179 р.</div>
                                    <a href="#" class="lightBorderBtn">Купить</a>
                                </div>
                            </div>
                        </li>


                        <li class="sliderCoverSmall">
                            <div class="whiteSectionItem">
                                <div class="specialLabel">
                                    <div class="red"></div>
                                </div>
                                <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/2.png"></div>
                                <div class="title">Как получать удовольствие от общения?</div>
                                <div class="sectionFooter">
                                    <div class="discount">20% скидка</div>
                                    <div class="price"><span class="oldPrice">12 804 р.</span> 1 179 р.</div>
                                    <a href="#" class="lightBorderBtn">Купить</a>
                                </div>
                            </div>
                        </li>



                        <li class="sliderCoverSmall">
                            <div class="whiteSectionItem">
                                <div class="specialLabel">
                                    <div class="red"></div>
                                </div>
                                <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/6.png"></div>
                                <div class="title">Зимние идеи от авторов «Находилок»</div>
                                <div class="sectionFooter">
                                    <div class="discount">20% скидка</div>
                                    <div class="price"><span class="oldPrice">12 804 р.</span> 1 179 р.</div>
                                    <a href="#" class="lightBorderBtn">Купить</a>
                                </div>
                            </div>
                        </li>


                        <li class="sliderCoverSmall">
                            <div class="whiteSectionItem">
                                <div class="specialLabel">
                                    <div class="red"></div>
                                </div>
                                <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/7.png"></div>
                                <div class="title">Зимние идеи от авторов «Находилок»</div>
                                <div class="sectionFooter">
                                    <div class="discount">20% скидка</div>
                                    <div class="price"><span class="oldPrice">12 804 р.</span> 1 179 р.</div>
                                    <a href="#" class="lightBorderBtn">Купить</a>
                                </div>
                            </div>
                        </li>


                        <li class="sliderCoverSmall">
                            <div class="whiteSectionItem">
                                <div class="specialLabel">
                                    <div class="red"></div>
                                </div>
                                <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/3.png"></div>
                                <div class="title">Как получать удовольствие от общения?</div>
                                <div class="sectionFooter">
                                    <div class="discount">20% скидка</div>
                                    <div class="price"><span class="oldPrice">12 804 р.</span> 1 179 р.</div>
                                    <a href="#" class="lightBorderBtn">Купить</a>
                                </div>
                            </div>
                        </li>


                        <li class="sliderCoverSmall">
                            <div class="whiteSectionItem">
                                <div class="specialLabel">
                                    <div class="red"></div>
                                </div>
                                <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/2.png"></div>
                                <div class="title">Как получать удовольствие от общения?</div>
                                <div class="sectionFooter">
                                    <div class="discount">20% скидка</div>
                                    <div class="price"><span class="oldPrice">12 804 р.</span> 1 179 р.</div>
                                    <a href="#" class="lightBorderBtn">Купить</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="articlesList">
        <div class="contentPart">
            <div class="articleItem">
                <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/promo/2.png"></div>
                <div class="descr">
                    <a href="#" class="title">Фестиваль «Книжный сдвиг</a>
                    <div class="text">Самое важное событие весны</div>
                </div>
            </div>
            <div class="articleItem">
                <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/promo/1.png"></div>
                <div class="descr">
                    <a href="#" class="title">Фестиваль «Книжный сдвиг</a>
                    <div class="text">Самое важное событие весны</div>
                </div>
            </div>
            <div class="articleItem">
                <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/4.jpg"></div>
                <div class="descr">
                    <a href="#" class="title">Фестиваль «Книжный сдвиг</a>
                    <div class="text">Самое важное событие весны</div>
                </div>
            </div>
            <div class="articleItem">
                <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/4.jpg"></div>
                <div class="descr">
                    <a href="#" class="title">Фестиваль «Книжный сдвиг</a>
                    <div class="text">Самое важное событие весны</div>
                </div>
            </div>
        </div>
    </section>

    <div class="contentPart">
        <a  href="#" class="simpleTitle">Серии книг</a>
        <div class="subTitle">Узнавайте о самых интересных сериях книг<br>  на наших особых страничках</div>
    </div>

    <div class="itemsSliderSection">
        <button type="button" value="" class="rightBtn"></button>
        <button type="button" value="" class="leftBtn"></button>
        <div class="contentPart">
            <div class="itemSlider">
                <ul class="itemSliderInc">
                    <li class="sliderCoverSmall">
                        <div class="whiteSectionItem">
                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/5.png"> </div>
                            <div class="bookDescr">
                                <div class="title">Зимние идеи от авторов «Находилок»</div>
                                <div class="sectionFooter">
                                    <div class="discount">20% скидка</div>
                                    <div class="price"><span class="oldPrice">12 804 р.</span> 1 179 р.</div>
                                    <a href="#" class="lightBorderBtn">Купить</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="sliderCoverSmall">
                        <div class="whiteSectionItem">
                            <div class="specialLabel">
                                <div class="yellow"></div>
                                <div class="red"></div>
                            </div>
                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/6.png"></div>
                            <div class="title">Зимние идеи от авторов «Находилок»</div>
                            <div class="sectionFooter">
                                <div class="discount">20% скидка</div>
                                <div class="price"><span class="oldPrice">12 804 р.</span> 1 179 р.</div>
                                <a href="#" class="lightBorderBtn">Купить</a>
                            </div>
                        </div>
                    </li>


                    <li class="sliderCoverSmall">
                        <div class="whiteSectionItem">
                            <div class="specialLabel">
                                <div class="purple"></div>
                            </div>
                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/7.png"></div>
                            <div class="title">Зимние идеи от авторов «Находилок»</div>
                            <div class="sectionFooter">
                                <div class="discount">20% скидка</div>
                                <div class="price"><span class="oldPrice">12 804 р.</span> 1 179 р.</div>
                                <a href="#" class="lightBorderBtn">Купить</a>
                            </div>
                        </div>
                    </li>


                    <li class="sliderCoverSmall">
                        <div class="whiteSectionItem">
                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/3.png"></div>
                            <div class="title">Как получать удовольствие от общения?</div>
                            <div class="sectionFooter">
                                <div class="price">234 р.</div>
                                <a href="#" class="lightBorderBtn">Купить</a>
                            </div>
                        </div>
                    </li>


                    <li class="sliderCoverSmall">
                        <div class="whiteSectionItem">
                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/2.png"></div>
                            <div class="title">Как получать удовольствие от общения?</div>
                            <div class="sectionFooter">
                                <div class="price">234 р.</div>
                                <a href="#" class="lightBorderBtn">Купить</a>
                            </div>
                        </div>
                    </li>



                    <li class="sliderCoverSmall">
                        <div class="whiteSectionItem">
                            <div class="specialLabel">
                                <div class="yellow"></div>
                                <div class="purple"></div>
                            </div>
                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/6.png"></div>
                            <div class="title">Зимние идеи от авторов «Находилок»</div>
                            <div class="sectionFooter">
                                <div class="discount">20% скидка</div>
                                <div class="price"><span class="oldPrice">12 804 р.</span> 1 179 р.</div>
                                <a href="#" class="lightBorderBtn">Купить</a>
                            </div>
                        </div>
                    </li>


                    <li class="sliderCoverSmall">
                        <div class="whiteSectionItem">
                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/7.png"></div>
                            <div class="title">Зимние идеи от авторов «Находилок»</div>
                            <div class="sectionFooter">
                                <div class="discount">20% скидка</div>
                                <div class="price"><span class="oldPrice">12 804 р.</span> 1 179 р.</div>
                                <a href="#" class="lightBorderBtn">Купить</a>
                            </div>
                        </div>
                    </li>


                    <li class="sliderCoverSmall">
                        <div class="whiteSectionItem">
                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/3.png"></div>
                            <div class="title">Как получать удовольствие от общения?</div>
                            <div class="sectionFooter">
                                <div class="price">234 р.</div>
                                <a href="#" class="lightBorderBtn">Купить</a>
                            </div>
                        </div>
                    </li>


                    <li class="sliderCoverSmall">
                        <div class="whiteSectionItem">
                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/2.png"></div>
                            <div class="title">Как получать удовольствие от общения?</div>
                            <div class="sectionFooter">
                                <div class="price">234 р.</div>
                                <a href="#" class="lightBorderBtn">Купить</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <section class="yellowSection">
        <a  href="#" class="simpleTitle">Книги с автографом</a>
        <div class="subTitle">Закажите книгу с отметкой «книга с автографом» и автор<br> книги собственноручно подпишет ее для вас</div>
    
    <?
        global $arrAutograph;
        $arrAutograph['PROPERTY_AUTOGRAPH'] = 8;
    ?>
    <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"main_page", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/cart/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "arrAutograph",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_CART_PROPERTIES" => "",
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_LIMIT" => "5",
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "desc",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "10",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_DISPLAY_MODE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(
			0 => "STATUS",
			1 => "NEWPRODUCT",
			2 => "SALELEADER",
			3 => "SPECIALOFFER",
			4 => "POPULAR",
			5 => "AUTOGRAPH",
			6 => "",
		),
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "Y",
		"SEF_RULE" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => "main_page"
	),
	false
    );?>
    </section>

<section class="aboutSection">
    <div class="contentPart">
        <div class="simpleTitle">О магазине Book24</div>
        <div class="subTitle">Официальный интернет-магазин издательств<br>  ЭКСМО, МИФ, Вентана Граф, Дрофа и АСТ </div>

        <div class="aboutText">
            Открывать людям возможности для проведения досуга, развития и вдохновения, создавая многообразие книг и обеспечивая их доступность. Мы не ставим себе жанровых и тематических рамок и считаем, что каждая книга способна найти своего читателя. Издательство «Эксмо», которое сегодня является крупнейшим в России и одним из крупнейших в Европе, было основано в 1991 году как дистрибутор книжной продукции. Самостоятельной издательской деятельностью компания занялась в начале 1993 года.
        </div>
        <div class="publishingHousesLogo">
            <a href="#" class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/publishHouses/1.png"> </a>
            <a href="#" class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/publishHouses/2.png"></a>
            <a href="#" class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/publishHouses/3.png"></a>
            <a href="#" class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/publishHouses/4.png"></a>
            <a href="#" class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/publishHouses/5.png"></a>
        </div>
        <div class="aboutText">
            <p>В числе первых авторов, начавших сотрудничать с издательством, были Валентин Пикуль, Владимир Федоров и Дмитрий Черкасов, а первым бестселлером «Эксмо» стал роман «Антикиллер» Даниила Корецкого.</p>
            <p>К середине 90-х издательство вошло в число лидеров книжного рынка, начало публиковать романы Александры Марининой, Дарьи Донцовой, Татьяны Устиновой, с которыми сотрудничает и по сей день.</p>
            <p>В 2005 году «Эксмо» было удостоено почетного звания «Лидер российской экономики».</p>
            <p>В 2007 году издательством «Эксмо» было выпущено 11 683 наименований книг общим тиражом 93,4 миллиона экземпляров. В этом же году «Эксмо» получило премию Eurocon (ESFS Awards) как «Лучший издатель».</p>
            <p>В 2014 году «Эксмо» стало бесспорным лидером на рынке художественной литературы.</p>
            <p>Партнерами «Эксмо» являются издательства «Дрофа», «Манн, Иванов и Фербер», а также интернет-магазин электронных книг Litres.ru.</p>

        </div>
    </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
