<?
global $arRegionData;

$APPLICATION->IncludeComponent(
    "argo:region.controller", 
    "", 
    array(
            "IBLOCK_TYPE" => "references",
            "IBLOCK_ID" => "10",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "7200",
            "LOCATE_ACCURACY" => "city",
            "PRODUCT_PROPERTIES" => array(
                    0 => "GEOIP_NAME",
                    1 => "DEFAULT_REGION",
                    2 => "STORE",
                    3 => "DOMAIN"
            )
    ),
    false
);
?>
<?
$myCurl = curl_init();
curl_setopt_array($myCurl, array(
    CURLOPT_URL => 'http://tk-kit.ru/API.1/?f=is_city&city='.$arRegionData['NAME'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
));
$response = curl_exec($myCurl);
curl_close($myCurl);
$new_response = json_decode($response);
$new_response_ar = explode(':', $new_response[0]);
$tcountryid = $new_response_ar[0];
$tregionid = $new_response_ar[1];
$tzoneid = $new_response_ar[2];
$tcityid = $new_response_ar[3];

$myCurl1 = curl_init();
curl_setopt_array($myCurl1, array(
    CURLOPT_URL => 'http://tk-kit.ru/API.1/?f=price_order&I_DELIVER=0&I_PICK_UP=0&WEIGHT=0.5&VOLUME=0.6&SLAND=RU&SZONE=0000007700&SCODE=770000000000&SREGIO=77&RLAND='.$tcountryid.'&RZONE='.$tzoneid.'&RCODE='.$tcityid.'&RREGIO='.$tregionid.'&KWMENG=&LENGTH=0.34&WIDTH=0.34&HEIGHT=0.34&GR_TYPE=&LIFNR=&PRICE=&WAERS=RUB',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
));

$response1 = curl_exec($myCurl1);
curl_close($myCurl1);
$new_response1 = array(json_decode($response1));
$new_response2 =(array)$new_response1[0];
global $deliveryDays;
$deliveryDays = $new_response2['DAYS'];

$regionFilter['PROPERTY_REGION'] = $arRegionData['ID'];
?>
<!DOCTYPE html>
<html>
<head>
    <title><?$APPLICATION->ShowTitle();?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/style.min.css');?>
    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/application.min.js');?>
    
    <?$APPLICATION->ShowHead();?>
</head>
<body>
<?$APPLICATION->ShowPanel();?>
<div id="content">
    <header>
        <div class="headerHead">
            <div class="partnerLine">
                <div class="contentPart">
                    <a href="#" class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/publishHouses/wFilter/1.svg"> </a>
                    <a href="#" class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/publishHouses/wFilter/2.svg"></a>
                    <a href="#" class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/publishHouses/wFilter/3.svg"></a>
                    <a href="#" class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/publishHouses/wFilter/4.svg"></a>
                    <a href="#" class="item"><img src="<?=SITE_TEMPLATE_PATH;?>/images/publishHouses/wFilter/5.svg"></a>
                </div>
            </div>
            <div class="headerNav">
                <div class="contentPart">
                    <div class="leftSide">
                        <a href="tel:8 (800) 333-65-23" class="freePhone">8 (800) 333-65-23 (бесплатно)</a>
                        <a href="javascript:;" class="dottedLink callOrderLink" onclick="showPopUp('callOrder')">Заказать звонок</a>
                        <?
                            $APPLICATION->IncludeComponent(
                                    "bitrix:menu", 
                                    "headerMenu", 
                                    Array(
                                        "ROOT_MENU_TYPE" => "headerMenu",	// Тип меню для первого уровня
                                        "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                                        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                                        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                                        "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                                        "MAX_LEVEL" => "1",	// Уровень вложенности меню
                                        "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                                        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                                        "CHILD_MENU_TYPE" => "headerMenu",	// Тип меню для остальных уровней
                                        "MENU_THEME" => "site"
                                    ),
                                    false
                            );
                        ?>
                    </div>
                    <div class="rightSide">
                        <?
                            $APPLICATION->IncludeComponent(
                                    "argo:region.select",
                                    "",
                                    array(),
                                    false
                            );
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="headerContent">
            <div class="headerContentInc">
                <div class="smallResCloseBtn">
                <div class="contentPart">
                        <div class="closeBtn" onclick="closeAccActions()"></div>
                        Каталог
                    </div>
                </div>
                <div class="contentPart">
                    <div class="mainLogo"><img src="<?=SITE_TEMPLATE_PATH;?>/images/logo.svg"> </div>

                    <div class="searchType">
                        <div class="currentOption">
                            <span class="curText">Каталог</span>
                            <div class="BArrow"></div>
                    </div>
                        <div class="activeSearchCover" onclick="closeAccActions()"></div>
                        <div class="searchTypeDropDown">
                            <?$APPLICATION->IncludeComponent( 
                                "bitrix:main.include", 
                                "", 
                                Array( 
                                    "AREA_FILE_SHOW" => "file", 
                                    "AREA_FILE_SUFFIX" => "inc", 
                                    "EDIT_TEMPLATE" => "", 
                                    "PATH" => SITE_DIR."include/header_catalog_menu.php",
                                ), 
                                false 
                            );?>
                        </div>
                    </div>
                    <div class="searchHeader">
                        <div class="rowBlock">
                            <input type="text" placeholder="Поиск книг, авторов, цитат">
                            <input type="submit" value="">
                            <div class="closeBtn"  onclick="closeAccActions()"></div>
                        </div>
                        <div class="searchDropDown">
                            <div class="leftSearchSide">
                                <div class="searchResBlock">
                                    <div class="title">Лучшее совпадение</div>
                                    <a href="#" class="linkItem"><span class="found">Стив</span>ен кинг<span class="count">(15)</span></a>
                                    <a href="#" class="linkItem"><span class="found">Стив</span>ен кинг<span class="count">(22)</span></a>
                                    <a href="#" class="linkItem">Темная башня <span class="found">Стив</span>ен кинг серия книг <span class="count">(652)</span></a>
                                    <a href="#" class="linkItem"><span class="found">Стив</span>ен кинг<span class="count">(17)</span></a>
                                    <a href="#" class="linkItem"><span class="found">Стив</span>ен кинг<span class="count">(652)</span></a>
                                </div>
                                <div class="searchResBlock">
                                    <div class="title">Авторы</div>
                                    <a href="#" class="linkItem"><span class="found">Стив</span>ен кинг<span class="count">(56)</span></a>
                                    <a href="#" class="linkItem"><span class="found">Стив</span>ен кинг<span class="count">(23)</span></a>
                                    <a href="#" class="linkItem">Темная башня <span class="found">Стив</span>ен кинг серия книг <span class="count">(652)</span></a>
                                    <a href="#" class="linkItem"><span class="found">Стив</span>ен кинг<span class="count">(12)</span></a>
                                    <a href="#" class="linkItem"><span class="found">Стив</span>ен кинг<span class="count">(11)</span></a>
                                </div>
                            </div>
                            <div class="rightSearchSide">
                                <div class="searchResBlock">
                                    <div class="title">Книги </div>
                                    <div class="bookItemsList">
                                        <div class="bookItem">
                                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/4.png"> </div>
                                            <div class="descr">
                                                <a href="#" class="link">Как открывать мир</a>
                                                <div class="smallDescrText">Ирина <span class="found">Сти</span>лева</div>
                                                <div class="price">800 р.</div>
                                            </div>
                                        </div>
                                        <div class="bookItem">
                                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/4.png"> </div>
                                            <div class="descr">
                                                <a href="#" class="link">Как открывать мир</a>
                                                <div class="smallDescrText">Ирина <span class="found">Сти</span>лева</div>
                                                <div class="price">800 р.</div>
                                            </div>
                                        </div>
                                        <div class="bookItem">
                                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/4.png"> </div>
                                            <div class="descr">
                                                <a href="#" class="link">Как открывать мир</a>
                                                <div class="smallDescrText">Ирина <span class="found">Сти</span>лева</div>
                                                <div class="price">800 р.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="searchResBlock">
                                    <div class="title">Серии </div>
                                    <div class="bookItemsList ">
                                        <div class="bookItem serial">
                                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/4.png"> </div>
                                            <div class="descr">
                                                <div class="smallDarkText">Серия</div>
                                                <a href="#" class="link">Невероятная вселенная <span class="found">Стив</span>ена Хокинга</a>
                                            </div>
                                        </div>
                                        <div class="bookItem serial">
                                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/4.png"> </div>
                                            <div class="descr">
                                                <div class="smallDarkText">Серия</div>
                                                <a href="#" class="link">Невероятная вселенная <span class="found">Стив</span>ена Хокинга</a>
                                            </div>
                                        </div>
                                        <div class="bookItem serial">
                                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/4.png"> </div>
                                            <div class="descr">
                                                <div class="smallDarkText">Серия</div>
                                                <a href="#" class="link">Невероятная вселенная <span class="found">Стив</span>ена Хокинга</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="centerBlock">
                                <a href="#" class="lightBorderBtn lg">Показать все результаты</a>
                            </div>
                        </div>
                        <div class="activeSearchCover" onclick="closeAccActions()"></div>
                    </div>

                    <div class="headerAccountInfo">
                        <div class="userInfoBlock">
                            <div class="userImage">

                            </div>
                            <div class="userInfo">
                                <div class="name ">
                                    <div class="dottedLink">
                                        <span class="text">Александра</span>
                                        <span class="BArrow"></span>
                                    </div>
                                </div>
                                <div class="bonusInfo">10 000 баллов, 4% скидка</div>
                            </div>
                            <div class="userInfoDropDown">
                                <div class="userInfoMenu">
                                    <a href="#" class="item">Мои заказы</a>
                                    <a href="#" class="item">Мои Баллы</a>
                                    <a href="#" class="item">Моя библиотека</a>
                                    <a href="#" class="item">Мои подписки</a>
                                    <a href="#" class="item">Рекомендации</a>
                                    <a href="#" class="item">Рекомендации</a>
                                    <a href="#" class="item">Рекомендации</a>
                                    <a href="#" class="item">Рекомендации</a>
                                    <a href="#" class="item">Рекомендации</a>
                                    <a href="#" class="item">Рекомендации</a>
                        </div>
                            </div>
                            <div class="activeSearchCover" onclick="closeAccActions()"></div>
                        </div>
                        <div class="accountLinksCover">

                            <div class="itemLink">
                                <div class="image">
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/images/bell.svg"  height="30">
                                </div>
                                <div class="accountLinksShortInfo">
                                    <div class="topTitle">Мои уведомления</div>
                                    <div class="itemsList">
                                        <div class="item">
                                            <div class="statusIcon active"></div>
                                            <div class="itemImage">
                                                <img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/4.png">
                                            </div>
                                            <div class="descr">
                                                <a href="#" class="title">Книга из вашей библиотеки появилась на складе</a>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="statusIcon"></div>
                                            <div class="itemImage">
                                                <img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/4.png">
                                            </div>
                                            <div class="descr">
                                                <a href="#" class="title">Книга из вашей библиотеки появилась на складе</a>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="statusIcon"></div>
                                            <div class="itemImage">
                                                <img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/4.png">
                                            </div>
                                            <div class="descr">
                                                <a href="#" class="title">Книга из вашей библиотеки появилась на складе</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="activeSearchCover" onclick="closeAccActions()"></div>
                            </div>
                            <div class="itemLink">
                                <div class="image">
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/images/book_icon.svg"  height="30">
                                </div>
                                <div class="accountLinksShortInfo library">
                                    <div class="topTitle">В библиотеке 2 полки</div>
                                    <div class="itemsList">
                                        <div class="item">
                                            <div class="itemImage">
                                                <img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/1.png">
                                            </div>
                                            <div class="descr">
                                                <a href="#" class="title">Про путешествия</a>
                                                <div class="smallDescr">1 книга</div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="itemImage">
                                                <img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/1.png">
                                            </div>
                                            <div class="descr">
                                                <a href="#" class="title">Города в книгах. Выбор архитекторов</a>
                                                <div class="smallDescr">1 книга</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="activeSearchCover" onclick="closeAccActions()"></div>
                            </div>
                            <?
                            $APPLICATION->IncludeComponent(
					"alexkova.market:basket.small",
					".default",
					array(
						"COMPONENT_TEMPLATE" => ".default",
						"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
						"PATH_TO_ORDER" => SITE_DIR."personal/order/",
						"USE_COMPARE" => "Y",
						"IBLOCK_TYPE" => "catalog",
						"IBLOCK_ID" => "2",
						"USE_DELAY" => "Y"
					),
					false
				);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="headerFooter">
            <div class="contentPart">
                <?
                    $APPLICATION->IncludeComponent(
                            "bitrix:menu", 
                            "top", 
                            Array(
                                "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                                "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                                "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                                "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                                "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                                "MAX_LEVEL" => "1",	// Уровень вложенности меню
                                "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                                "DELAY" => "N",	// Откладывать выполнение шаблона меню
                                "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                                "CHILD_MENU_TYPE" => "top",	// Тип меню для остальных уровней
                                "MENU_THEME" => "site"
                            ),
                            false
                    );
                ?>
            </div>
        </div>
    </header>

    <main>
        <?if ($APPLICATION->GetCurPage(true) != SITE_DIR.'index.php'):?>
                            <?
                            $APPLICATION->IncludeComponent("bitrix:breadcrumb", "book24", Array(
	"COMPONENT_TEMPLATE" => ".default",
		"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
		"SITE_ID" => "-",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
		"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
	),
	false
);
                            ?>
        <?endif;?>
