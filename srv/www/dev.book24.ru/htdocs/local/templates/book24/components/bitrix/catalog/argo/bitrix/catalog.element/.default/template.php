<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$templateLibrary = array('popup');
$currencyList = '';
if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList
);
unset($currencyList, $templateLibrary);

$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
	'ID' => $strMainID,
	'PICT' => $strMainID.'_pict',
	'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
	'STICKER_ID' => $strMainID.'_sticker',
	'BIG_SLIDER_ID' => $strMainID.'_big_slider',
	'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
	'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
	'SLIDER_LIST' => $strMainID.'_slider_list',
	'SLIDER_LEFT' => $strMainID.'_slider_left',
	'SLIDER_RIGHT' => $strMainID.'_slider_right',
	'OLD_PRICE' => $strMainID.'_old_price',
	'PRICE' => $strMainID.'_price',
	'DISCOUNT_PRICE' => $strMainID.'_price_discount',
	'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
	'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
	'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
	'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
	'QUANTITY' => $strMainID.'_quantity',
	'QUANTITY_DOWN' => $strMainID.'_quant_down',
	'QUANTITY_UP' => $strMainID.'_quant_up',
	'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
	'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
	'BASIS_PRICE' => $strMainID.'_basis_price',
	'BUY_LINK' => $strMainID.'_buy_link',
	'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
	'BASKET_ACTIONS' => $strMainID.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
	'COMPARE_LINK' => $strMainID.'_compare_link',
	'PROP' => $strMainID.'_prop_',
	'PROP_DIV' => $strMainID.'_skudiv',
	'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
	'OFFER_GROUP' => $strMainID.'_set_group_',
	'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	: $arResult['NAME']
);
$strAlt = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	: $arResult['NAME']
);
$useVoteRating = ('Y' == $arParams['USE_VOTE_RATING']);
global $arRegionData;
global $deliveryDays;

$userId = $USER->GetId();
$arGroups = CUser::GetUserGroup($userId);

/*CModule::IncludeModule('highloadblock');

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
global $APPLICATION;

$hlblock = HL\HighloadBlockTable::getById(3)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();
*/
/* @var $entity_data_class Bitrix\Main\Entity\DataManager */
/*$bonus_res = $entity_data_class::getList(array(
    'filter' => array(),
    'select' => array('ID','UF_BONUS','UF_XML_ID'),
    'order' => array()
));
$group_bonus =array();

while($bonus_ob = $bonus_res->Fetch()) 
{
    $group_bonus[$bonus_ob['UF_XML_ID']]=$bonus_ob['UF_BONUS'];
}
    
foreach ($arGroups as $value) 
{
    if ($group_bonus[$value])
        $bonus = $group_bonus[$value];
    else
        $bonus = 2;
}*/


$rsLocationsList = CSaleLocation::GetList(
        array(),
        array("CITY_NAME" => $arRegionData['NAME']),
        false,
        false,
        array("ID", "CITY_ID",'CITY_NAME')
);
$arCity = $rsLocationsList->GetNext();

$services = \Bitrix\Sale\Delivery\Services\Manager::getActive();
foreach ($services as $i => $dlService)
{
    $checkResult = \Bitrix\Sale\Delivery\Services\Manager::checkServiceRestriction(
       $dlService['ID'], 
       $arCity['ID'], 
       '\Bitrix\Sale\Delivery\Restrictions\ByLocation'
    );
    if(!$checkResult) unset($services[$i]);
}
?>
<script>
        user_id = "<?=($userId) ? $userId : ''?>";
        trade_name = "<?=$arResult['NAME']?>";
        trade_id = "<?=$arResult['ID']?>";
        trade_link = "<?=$arResult['DETAIL_PAGE_URL']?>";
        formRequestMsg = "<?=GetMessage('TRADE_REQUEST_MSG')?>";
        formRequestMsg = formRequestMsg.replace("#TRADE_NAME#",'<?=$arResult['NAME']?>');
        productPrice = "<?=$arResult['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE']?>";
        
        preorder = "<?echo ($arResult['PROPERTIES']['PREDZAKAZ']['VALUE']=='Y') ? 'PO' : false;?>";
</script>

<div class="productInfo" id="<?=$arItemIDs['ID']?>">
        <div class="contentPart">
            <div class="bookDetal">
                <div class="bookDetalInc">
                    <div class="leftSide">
                        <div class="bookImage">
                            <div class="specialLabel ">
                                <div class="red"></div>
                                <div class="purple"></div>
                            </div>
                            <div class="image" onclick="bookPreview('show',0)">
                                <img id="<? echo $arItemIDs['PICT']; ?>" src="<? echo $arResult['DETAIL_PICTURE']['SRC']; ?>" alt="<? echo $strAlt; ?>" title="<? echo $strTitle; ?>">
                            </div>
                        </div>
                        <div class="lightBorderBtn lg" onclick="bookPreview('show',1)">Читать отрывок</div>
                        <div class="lightBorderBtn lg" onclick="bookPreview('show',2)">Смотреть содержание</div>
                    </div>
                    <div class="centerSide">
                        <h1><?=$arResult["NAME"]?> </h1>
                        <div class="bookStatLine">
                            <div class="rateStarCover">
                                <div class="rateStarInc">
                                    <?if ($useVoteRating):?>
                                        <?$APPLICATION->IncludeComponent(
                                                "bitrix:iblock.vote",
                                                "argo",
                                                array(
                                                        "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
                                                        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                                                        "ELEMENT_ID" => $arResult['ID'],
                                                        "ELEMENT_CODE" => "",
                                                        "MAX_VOTE" => "5",
                                                        "VOTE_NAMES" => array(),
                                                        "SET_STATUS_404" => "N",
                                                        "DISPLAY_AS_RATING" => $arParams['VOTE_DISPLAY_AS_RATING'],
                                                        "CACHE_TYPE" => $arParams['CACHE_TYPE'],
                                                        "CACHE_TIME" => $arParams['CACHE_TIME']
                                                ),
                                                $component,
                                                array("HIDE_ICONS" => "Y")
                                        );?>
                                    <?endif;?>
                                </div>
                            </div>
                            <a href="#" class="linkWIcon comment"><span class="dottedLink"><?=count($arResult['PROPERTIES']['COMMENTS']['VALUE'])?> отзывов</span></a>
                            <a href="#" class="linkWIcon articles"><span class="dottedLink"><?=count($arResult['PROPERTIES']['REVIEWS']['VALUE'])?> статьи</span></a>
                            <div class="linkWIcon cart">50 раз купили</div>
                        </div>
                        <div class="smallBookDescr">
                            <div class="text"><?=$arResult['PROPERTIES']['PROD_TEXT']['VALUE']['TEXT']?></div>
                            <a href="javascript:;" class="readMore dottedLink">Подробнее</a>
                        </div>

                        <?if (!empty($arResult['DISPLAY_PROPERTIES'])):?>
                            <div class="bookDescrTable">
                                <?foreach ($arResult['DISPLAY_PROPERTIES'] as &$arOneProp) {?>
                                    <?
                                        $newLink = '';
                                        if (is_array($arOneProp['DISPLAY_VALUE']))
                                        {
                                            foreach ($arOneProp['DISPLAY_VALUE'] as $value) 
                                            {
                                                $arValue = explode('>',$value);
                                                $newLinkBegin = $arValue[0].' class="rightTd"';
                                                $arValue[0] = $newLinkBegin;
                                                $newLinkProp[] = implode('>',$arValue);
                                            }
                                            $newLink = implode(' / ', $newLinkProp);
                                        }
                                        else
                                        {
                                            if ($arOneProp['CODE']=="AUTHOR")
                                            {
                                                $arValue = explode('>',$arOneProp['DISPLAY_VALUE']);
                                                $newLinkBegin = $arValue[0].' class="rightTd"';
                                                $arValue[0] = $newLinkBegin;
                                                $newLink = $newLinkBegin.'>'.$arResult['PROPERTIES']['AUTHOR_NAME']['VALUE'].'</a>';
                                            }
                                            else
                                            {
                                                if (substr_count($arOneProp['DISPLAY_VALUE'], '</a>') > 0)
                                                {
                                                    $arValue = explode('>',$arOneProp['DISPLAY_VALUE']);
                                                    $newLinkBegin = $arValue[0].' class="rightTd"';
                                                    $arValue[0] = $newLinkBegin;
                                                    $newLink = implode('>',$arValue);
                                                }
                                                else
                                                {
                                                    $newLink = '<div class="rightTd">'.$arOneProp['DISPLAY_VALUE'].'</div>';
                                                }
                                            }
                                        }
                                    ?>
                                    <div class="rowCover">
                                        <div class="leftTD">
                                            <div class="text"><? echo $arOneProp['NAME']; ?></div>
                                            <div class="bottedLine"></div>
                                        </div>
                                        <?=$newLink?>
                                    </div>
                                <?}?>
                            </div>
                        <?endif;?>

                        <a href="#" class="dottedLink sm" onclick="showPopUp('bookOrder')">Оформление книги</a>

                        <h3>Ищите похожие книги</h3>
                        <?$APPLICATION->IncludeComponent("bitrix:search.tags.cloud", "argo", Array(
                                        "CACHE_TIME" => "3600",	// Время кеширования (сек.)
                                        "CACHE_TYPE" => "A",	// Тип кеширования
                                        "CHECK_DATES" => "Y",	// Искать только в активных по дате документах
                                        "COLOR_NEW" => "495c91",	// Цвет более позднего тега (пример: "C0C0C0")
                                        "COLOR_OLD" => "495c91",	// Цвет более раннего тега (пример: "FEFEFE")
                                        "COLOR_TYPE" => "Y",	// Плавное изменение цвета
                                        "COMPONENT_TEMPLATE" => ".default",
                                        "FILTER_NAME" => "",	// Дополнительный фильтр
                                        "FONT_MAX" => "13",	// Максимальный размер шрифта (px)
                                        "FONT_MIN" => "25",	// Минимальный  размер шрифта (px)
                                        "PAGE_ELEMENTS" => "20",	// Количество тегов
                                        "PERIOD" => "30",	// Период выборки тегов (дней)
                                        "PERIOD_NEW_TAGS" => "",	// Период,  в течение которого считать тег новым (дней)
                                        "SHOW_CHAIN" => "Y",	// Показывать цепочку навигации
                                        "SORT" => "CNT",	// Сортировка тегов
                                        "TAGS_INHERIT" => "Y",	// Сужать область поиска
                                        "URL_SEARCH" => "/search/index.php",	// Путь к странице поиска (от корня сайта)
                                        "WIDTH" => "100%",	// Ширина облака тегов (пример: "100%" или "100px", "100pt", "100in")
                                        "arrFILTER" => array(	// Ограничение области поиска
                                                0 => "iblock_catalog",
                                        ),
                                        "arrFILTER_iblock_catalog" => array(	// Искать в информационных блоках типа "iblock_catalog"
                                                0 => "all",
                                        )
                                ),
                                false
                        );?>

                        <h3>Фотографии страниц от издательства и пользователей </h3>

                        <div class="similarBooksList">
                            <?foreach ($arResult["PROPERTIES"]['MORE_PHOTO']['VALUE'] as $key => $value):?>
                                <?if ($key<5):?>
                                    <?$PIC_URL = \CFile::ResizeImageGet($value, array('width'=>110, 'height'=>110), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);?>
                                    <div class="item" onclick="bookPreview('show',0)">
                                        <img src="<?=$PIC_URL['src']?>">
                                    </div>
                                <?endif;?>
                            <?endforeach;?>
                            <?if (count($arResult["PROPERTIES"]['MORE_PHOTO']['VALUE'])>5):?>
                                <a href="#" class="showMore" onclick="bookPreview('show',0)">
                                    <span>Еще <?=(count($arResult["PROPERTIES"]['MORE_PHOTO']['VALUE'])-5)?><br>  фотографий</span>
                                </a>
                            <?endif;?>
                        </div>

                    </div>
                    <div class="rightSide">
                        <div class="orderBlock">
                            <div class="bookTypeIcon hard"></div>
                            <div class="bookTypeSelect">
                                <span class="selectedItem dottedLink"><?=$arResult['PROPERTIES']['COVER']['VALUE']?></span>
                                <div class="BArrow"></div>
                                <div class="bookTypeDropDown">
                                    <div class="topTitle">Эта книга доступна в разных версиях</div>
                                    <div class="bookTypeItem">
                                        <div class="bookTypeIcon hard"></div>
                                        <div class="descr">
                                            <a href="#" class="title">В мягком переплете</a>
                                            <div class="aviability">
                                                <span class="label">В наличии</span>
                                                <span class="amount">200 р.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bookTypeItem">
                                        <div class="bookTypeIcon ebook"></div>
                                        <div class="descr">
                                            <a href="#" class="title">В мягком переплете</a>
                                            <div class="aviability">
                                                <span class="label">В наличии</span>
                                                <span class="amount">200 р.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bookTypeItem">
                                        <div class="bookTypeIcon audio"></div>
                                        <div class="descr">
                                            <a href="#" class="title">В мягком переплете</a>
                                            <div class="aviability">
                                                <span class="label">В наличии</span>
                                                <span class="amount">200 р.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bookTypeItem">
                                        <div class="bookTypeIcon gift"></div>
                                        <div class="descr">
                                            <a href="#" class="title">Подарочный вариант</a>
                                            <div class="aviability">
                                                <span class="label">В наличии</span>
                                                <span class="amount">200 р.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bookTypeItem">
                                        <div class="bookTypeIcon simple"></div>
                                        <div class="descr">
                                            <a href="#" class="title">Подарочный вариант</a>
                                            <div class="aviability">
                                                <span class="label">В наличии</span>
                                                <span class="amount">200 р.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="activeSearchCover" onclick="closeAccActions()"></div>
                            </div>
                            <div class="booksLost redSpan">
                                Осталось: <?=$arResult['CATALOG_QUANTITY']?> книг
                            </div>
                            <div class="sepLine"></div>
                            <?if ($arResult['PRICES']['BASE']['DISCOUNT_DIFF_PERCENT']){?>
                                <div class="discount redSpan">
                                    Скидка 20%
                                </div>
                            <?}?>
                            <div class="BPrice">
                                <?if ($arResult['PRICES']['BASE']['DISCOUNT_DIFF_PERCENT']){?>
                                    <span class="oldPrice"><?=$arResult['PRICES']['BASE']['VALUE']?> р.</span>
                                    <span class="newPrice"><?=$arResult['PRICES']['BASE']['PRINT_DISCOUNT_VALUE']?></span>
                                <?}else{?>
                                    <span class="newPrice"><?=$arResult['PRICES']['BASE']['PRINT_DISCOUNT_VALUE']?></span>                                    
                                <?}?>
                            </div>

                            <a href="#" class="howToGetCheeper dottedLink" onclick="showPopUp('buyCheeper')">
                                Как купить эту книгу еще дешевле?
                            </a>
                         
                            <form class="bxr-basket-action bxr-basket-group bxr-currnet-torg" action="">
                                <input type="hidden" name="quantity" value="1" class="bxr-quantity-text" data-item="<?=$arResult["ID"]?>">
                                <button class="greenBtn buyBtn bxr-basket-add" style="margin: 22px 0 9px;">
                                        Купить
                                </button>
                                <input class="bxr-basket-item-id" type="hidden" name="item" value="<?=$arResult["ID"]?>">
                                <input type="hidden" name="action" value="add">
                            </form>

                            <div class="addToLibraryCover">
                                <a href="javascript:;" class="linkWIcon plus addToLibrary"><span class="dottedLink">Добавить в библиотеку</span></a>
                                <div class="addToLibDropDown">
                                    <div class="topTitle">Добавить в мою библиотеку</div>
                                    <div class="smalDescr">Выберите полку:</div>
                                    <div class="bookShelvesList">
                                        <div class="shelveItem" onclick="showPopUp('thankYouSM')">
                                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/userImage.jpg"> </div>
                                            <div class="descr">
                                                <a href="javascript:;" class="title">Про путешествия</a>
                                                <div class="textGrey">1 книга</div>
                                            </div>
                                        </div>
                                        <div class="shelveItem" onclick="showPopUp('thankYouSM')">
                                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/userImage.jpg"> </div>
                                            <div class="descr">
                                                <a href="javascript:;" class="title">Города в книгах. Выбор архитекторов</a>
                                                <div class="textGrey">25 книг</div>
                                            </div>
                                        </div>
                                        <div class="shelveItem" onclick="showPopUp('thankYouSM')">
                                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/userImage.jpg"> </div>
                                            <div class="descr">
                                                <a href="javascript:;" class="title">Романтика</a>
                                                <div class="textGrey">1 книга</div>
                                            </div>
                                        </div>
                                        <div class="shelveItem" onclick="showPopUp('thankYouSM')">
                                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/userImage.jpg"> </div>
                                            <div class="descr">
                                                <a href="javascript:;" class="title">Про путешествия</a>
                                                <div class="textGrey">1 книга</div>
                                            </div>
                                        </div>
                                        <div class="shelveItem" onclick="showPopUp('thankYouSM')">
                                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/userImage.jpg"> </div>
                                            <div class="descr">
                                                <a href="javascript:;" class="title">Про путешествия</a>
                                                <div class="textGrey">1 книга</div>
                                            </div>
                                        </div>
                                        <div class="shelveItem" onclick="showPopUp('thankYouSM')">
                                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/userImage.jpg"> </div>
                                            <div class="descr">
                                                <a href="javascript:;" class="title">Про путешествия</a>
                                                <div class="textGrey">1 книга</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="createNewShelve">
                                        <div class="linkWIcon plus">
                                            <span class="dottedLink" onclick="showPopUp('shelfCreation')">Создать новую полку</span>
                                        </div>
                                    </div>


                                </div>
                                <div class="activeSearchCover" onclick="closeAccActions()"></div>
                            </div>
                            <div class="sepLine"></div>

                            <div class="promoText">
                                Дарим <a href="#" class="dottedLink">10 баллов</a> и <a href="#" class="dottedLink" onclick="showPopUp('getGift')">подарок</a><br>
                                <span class="deliveryInfo">Бесплатная доставка (с 23 февраля)</span>
                            </div>

                        </div>
                        <div class="centerBlock"><a href="javascript:;" class="dottedLink allPaymentsLink" onclick="showPopUp('allPayments')">Все виды оплаты</a></div>
                        <div class="allPaymentsBlock">
                            <div class="item"></div>
                            <div class="item"></div>
                            <div class="item"></div>
                            <div class="item"></div>
                            <div class="item"></div>
                            <div class="item"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="yellowSection">
            <div class="contentPart">
                <div class="togetherPromo">
                    <h3>Вместе дешевле</h3>
                    <div class="togetherPromoInc">
                        <div class="bookItem active">
                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/2.png"> </div>
                            <div class="checkBoxCover checked">
                                <div class="checkBoxInc">
                                    <input type="checkbox" checked>
                                </div>
                            </div>
                        </div>
                        <div class="mathAction">+</div>
                        <div class="bookItem active">
                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/2.png"> </div>
                            <div class="checkBoxCover checked">
                                <div class="checkBoxInc ">
                                    <input type="checkbox" checked>
                                </div>
                            </div>
                        </div>
                        <div class="mathAction">+</div>
                        <div class="bookItem active">
                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/2.png"> </div>
                            <div class="checkBoxCover checked">
                                <div class="checkBoxInc">
                                    <input type="checkbox" checked>
                                </div>
                            </div>
                        </div>
                        <div class="mathAction">+</div>
                        <div class="bookItem active">
                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/2.png"> </div>
                            <div class="checkBoxCover checked" >
                                <div class="checkBoxInc">
                                    <input type="checkbox" checked>
                                </div>
                            </div>
                        </div>
                        <div class="mathAction">+</div>
                        <div class="bookItem active">
                            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/2.png"> </div>
                            <div class="checkBoxCover checked">
                                <div class="checkBoxInc">
                                    <input type="checkbox" checked>
                                </div>
                            </div>
                        </div>
                        <div class="mathAction"><strong>=</strong></div>
                        <div class="totalBlock active">
                            <div class="discount redSpan">Скидка 20%</div>
                            <div class="BPrice">
                                <span class="oldPrice">3 200 р.</span>
                                <span class="newPrice">3 100 р.</span>
                            </div>
                            <div class="greenBtn">Купить</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="contentPart">
            <div class="BTabs">
                <div class="BTabLine">
                    <div class="tabItem active">Описание</div>
                    <div class="tabItem">Отзывы: <?=count($arResult['PROPERTIES']['COMMENTS']['VALUE'])?></div>
                    <div class="tabItem">Статьи о книге: <?=count($arResult['PROPERTIES']['REVIEWS']['VALUE'])?></div>
                    <div class="tabItem">Доставка</div>
                </div>
                <div class="BTabsCont">
                    <div class="BTabsContItem" style="display: block">
                        <div class="simpleTitle black">Описание</div>
                        <div class="bookDescrBlock">
                            <div class="bookDescrImportant">
                                <?
                                $microAr = array();
                                $arSelectMicro = Array("ID", "NAME",'XML_ID','DETAIL_TEXT','PROPERTY_FROM','PROPERTY_LINK');
                                $arFilterMicro = Array("IBLOCK_ID"=>4, "XML_ID"=>$arResult['PROPERTIES']['MICROREVIEWS']['VALUE']);
                                $resMicro = CIBlockElement::GetList(Array(), $arFilterMicro, false, Array(), $arSelectMicro);
                                while($obMicro = $resMicro->GetNextElement())
                                {
                                    $arFieldsMicro = $obMicro->GetFields();
                                ?>
                                <div class="descrBlock">
                                    <div class="text"><?=$arFieldsMicro['DETAIL_TEXT']?></div>
                                    <div class="links"><a href="<?=$arFieldsMicro['PROPERTY_LINK_VALUE']?>">
                                            <?=$arFieldsMicro['PROPERTY_FROM_VALUE']?>
                                    </a></div>
                                </div>
                                <?}?>
                            </div>
                            <div class="generalDescr">
                                <div class="GDTextBlock">
                                    <h3>Аннотация</h3>
                                    <div class="text">
                                        <?=$arResult['PREVIEW_TEXT']?>
                                    </div>
                                </div>
                                <div class="GDTextBlock">
                                    <h3>Сюжет</h3>
                                    <div class="text">
                                        <?=$arResult['DETAIL_TEXT']?>
                                    </div>
                                    <a href="#" class="readMore dottedLink">Подробнее</a>
                                </div>
                            </div>
                            <div class="simpleTitle black">Награды</div>
                            <div class="awardsList">
                                <div class="awardItem">
                                    <div class="year">1976</div>
                                    <div class="descr">
                                        <a href="#" class="title">Всемирная премия фэнтези</a>
                                        <div class="text">Лучший роман</div>
                                    </div>
                                </div>

                                <div class="awardItem">
                                    <div class="year">1976</div>
                                    <div class="descr">
                                        <a href="#" class="title">Балрог</a>
                                        <div class="text">Лучший роман</div>
                                    </div>
                                </div>
                                <div class="simpleTitle black">Об авторе</div>
                                <?        
                                $arFilterAuth = Array("IBLOCK_ID"=>13, "XML_ID"=>$arResult['PROPERTIES']['AUTHOR']['VALUE']);
                                $resAuth = CIBlockElement::GetList(Array(), $arFilterAuth, false, Array(), array());
                                while($obAuth = $resAuth->GetNextElement())
                                {
                                    $arFieldsAuth = $obAuth->GetFields();
                                    $authPic = $arFieldsAuth['DETAIL_PICTURE'];
                                    $authPicUrl = CFile::GetPath($authPic);
                                ?>
                                    <div class="aboutAuthor">
                                        <div class="authorInfo">
                                            <div class="image"><img src="<?=$authPicUrl?>"> </div>
                                            <div class="name"><?=$arFieldsAuth['NAME']?></div>
                                        </div>
                                        <div class="authorText">
                                            <?=$arFieldsAuth['PREVIEW_TEXT']?>
                                        </div>
                                        <a href="<?=$arFieldsAuth['DETAIL_PAGE_URL']?>" class="readMore dottedLink">Подробнее об авторе</a>
                                    </div>
                                <?}?>
                            </div>
                        </div>
                    </div>
                    <div class="BTabsContItem">
                        <div class="simpleTitle black">Отзывы (<?=count($arResult['PROPERTIES']['COMMENTS']['VALUE'])?>)</div>
                        <div class="reviewsBlock">
                            <div class="leaveReviewPromo">
                                <div class="btnLine">
                                    <div class="greenBtn">
                                        <a href="javascript:void(0);" class="open-comment-form">
                                            Напишите отзыв и заработайте 10 баллов
                                        </a>
                                    </div>
                                    <div class="lightBorderBtn lg">Оцените книгу</div>
                                </div>
                                <a href="#" class="payWith">Оплачивайте баллами свои покупки</a>
                            </div>
                            <div class="sortByLine">
                                <div class="sortItem active"><span class="dottedLink">По новизне</span></div>
                                <div class="sortItem"><span class="dottedLink">По популярности</span></div>
                            </div>
                            
                            <?$APPLICATION->IncludeComponent("bitrix:news.list", "elementReviews", Array(
	"ACTIVE_DATE_FORMAT" => "",	// Формат показа даты
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
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DISPLAY_DATE" => "Y",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
			0 => "NAME",
			1 => "",
		),
		"FILTER_NAME" => "",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "21",	// Код информационного блока
		"IBLOCK_TYPE" => "forms",	// Тип информационного блока (используется только для проверки)
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
		"PAGER_TITLE" => "Отзывы",	// Название категорий
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"PROPERTY_CODE" => array(	// Свойства
			0 => "OPINION",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
	),
	false
);?>

                            <div class="reviewsSubscribe">
                                <div class="label">Подпишитесь на отзывы об этой книге, чтобы узнать мнение других читателей</div>
                                <div class="lightBorderBtn md">Подписаться на отзывы</div>
                            </div>

                            <div class="yandexReviews">
                                <div class="yandexLogo"><img src="<?=SITE_TEMPLATE_PATH;?>/images/yandex market.svg"> </div>
                                <h3>Отзывы о нашем магазине в Яндекс. Маркете</h3>

                                <div class="reviewItem">
                                    <div class="RIHead">
                                        <div class="userBlock">
                                            <div class="name">Вадим Мерещяков</div>
                                        </div>
                                        <div class="date">24 февраля</div>
                                    </div>
                                    <div class="RIContent">
                                        <div class="rateStarCover">
                                            <div class="rateStarInc">
                                                <div class="rateStar dark"></div>
                                                <div class="rateStar dark"></div>
                                                <div class="rateStar dark"></div>
                                                <div class="rateStar dark"></div>
                                                <div class="rateStar"></div>
                                            </div>
                                        </div>
                                        <div class="textBlock">
                                            <p>Эксмо заботится о покупателях - я почти купила раскраску Гарри Поттер на амазон, как случайно увидела ее от этого издательства.<br>
                                                Сделала заказ 167565 и стала читать отзывы - расстроилась. Но мне впрочем повезло. Время от оформления заказа до передачи в доставку - 5 дней. Бывает и побыстрее, но да ладно. Почта не подвела, доставила быстро.<br>
                                                Ставлю пять звёзд за интеграцию популярных иностранных изданий в оборот РФ</p>
                                        </div>

                                    </div>
                                </div>


                                <div class="reviewItem">
                                    <div class="RIHead">
                                        <div class="userBlock">
                                            <div class="name">Вадим Мерещяков</div>
                                        </div>
                                        <div class="date">24 февраля</div>
                                    </div>
                                    <div class="RIContent">
                                        <div class="rateStarCover">
                                            <div class="rateStarInc">
                                                <div class="rateStar dark"></div>
                                                <div class="rateStar dark"></div>
                                                <div class="rateStar dark"></div>
                                                <div class="rateStar dark"></div>
                                                <div class="rateStar"></div>
                                            </div>
                                        </div>
                                        <div class="textBlock">
                                            <p>Эксмо заботится о покупателях - я почти купила раскраску Гарри Поттер на амазон, как случайно увидела ее от этого издательства.<br>
                                                Сделала заказ 167565 и стала читать отзывы - расстроилась. Но мне впрочем повезло. Время от оформления заказа до передачи в доставку - 5 дней. Бывает и побыстрее, но да ладно. Почта не подвела, доставила быстро.<br>
                                                Ставлю пять звёзд за интеграцию популярных иностранных изданий в оборот РФ</p>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="BTabsContItem">
                        <div class="simpleTitle black">Статьи и публикации (<?=count($arResult['PROPERTIES']['REVIEWS']['VALUE'])?>)</div>
                        <div class="articlesAbout">
                            <div class="articleItem">
                                <div class="articleItemHead">
                                    <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/userImage.jpg"> </div>
                                    <div class="descr">
                                        <div class="title">Meduza.io</div>
                                        <a href="#" class="author">Галина Юзефович, литературный критик</a>
                                    </div>
                                </div>
                                <div class="articleItemContent">
                                    <div class="text">
                                        Нынешний роман — второй у Игоря Савельева, и по сравнению с первым («Терешкова летит на Марс») он представляет собой заметный шаг вперед: к умению хорошо складывать слова добавились навыки прорисовки характеров и создания прекрасного, живого и наполненного разнообразными смыслами мира.
                                    </div>
                                    <a href="#" class=" readMore sm">Смотреть обзор</a>
                                </div>
                            </div>

                            <div class="articleItem">
                                <div class="articleItemHead">
                                    <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/userImage.jpg"> </div>
                                    <div class="descr">
                                        <div class="title">Theory&Practice.com</div>
                                        <a href="#" class="author">Dina Baty</a>
                                    </div>
                                </div>
                                <div class="articleItemContent">
                                    <div class="text">
                                        Самое интересное в книге — это мысли на полях, которые могут быть гораздо полезнее всех перечисленных приемов, смахивающих на игры тимбилдинга. Эдвард де Боно заявляет, что вскоре творчество будет таким же важным ресурсом, как финансы или сырье.
                                    </div>
                                    <div class="videoPreview">
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/FZ0Box7-BRQ?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                    <a href="#" class=" readMore sm">Смотреть обзор</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="BTabsContItem">
                        <div class="simpleTitle black">Доставка</div>
                        <div class="deliveryBlock">
                            <div class="DBTitle">
                                <?
                                    $APPLICATION->IncludeComponent(
                                            "argo:region.select",
                                            "",
                                            array(),
                                            false
                                    );
                                ?>
                            </div>
                            <div class="DBGeneralText">
                                <?if ($arResult['PRICES']['BASE']['DISCOUNT_VALUE']>999){?>
                                    Вам доступна бесплатная доставка при заказе этой книги!
                                <?}else{?>
                                    Пока доступна только платная доставка. 
                                    Бесплатная доставка при заказе от 999 руб. 
                                    Дополните ваш заказ товарами на сумму больше <?=(999-$arResult['PRICES']['BASE']['DISCOUNT_VALUE'])?> руб и получите бесплатную доставку
                                <?}?>
                            </div>
                            
                            <?
                                foreach ($services as $value) {
                                    echo '<br>'.$value['NAME'].'<br>';
                                    if ($value['DESCRIPTION'])
                                        echo $value['DESCRIPTION'].'<br>';
                                    if ($value['CONFIG']['MAIN']['PRICE']>0)
                                        echo $value['CONFIG']['MAIN']['PRICE'].'<br>';
                                    if ($value['CONFIG']['MAIN']['PERIOD']['FROM']>0)
                                        echo 'от '.$value['CONFIG']['MAIN']['PERIOD']['FROM'].' до '.$value['CONFIG']['MAIN']['PERIOD']['FROM'].' дней'.'<br>';
                                }
                            ?><br><br>
                            <div class="BDOption bestOption">
                                <div class="image courier"></div>
                                <div class="descr">
                                    <div class="smallText">Оптимальный вариант</div>
                                    <div class="title">Курьерской службой </div>
                                    <div class="mediumText">Ближайшая дата доставки: 23 февраля, среда</div>
                                    <div class="mediumText">от 100 руб. </div>
                                </div>
                            </div>

                            <div class="doubleOption">
                                <div class="BDOption">
                                    <div class="image bySelf"></div>
                                    <div class="descr">
                                        <div class="smallText">Выйдет дороже</div>
                                        <div class="title">Самовывоз</div>
                                        <div class="mediumText">с 24 февраля, четверг</div>
                                        <div class="mediumText">от 100 руб. </div>
                                    </div>
                                </div>
                                <div class="BDOption">
                                    <div class="image mailExpress"></div>
                                    <div class="descr">
                                        <div class="smallText">Вариант для терпеливых</div>
                                        <div class="title">Почтой России</div>
                                        <div class="mediumText">со 2 марта, среда</div>
                                        <div class="mediumText">от 100 руб. </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
</div>

<div class="simpleDialog cartRemoveDialog removePart">
    <div class="clickbleArea" onclick="closeForms()"></div>
    <div class="popUpForm">
        <div class="closeBtn" onclick="closeForms()"></div>
        <div class="imageBlock">
            <img src="<?=SITE_TEMPLATE_PATH;?>/images/hello.svg">
        </div>
        <div class="popUpTitle">Удалить 7 товаров из корзины?</div>
        <div class="smallText">Если вы пока не готовы купить эти товары,
            вы можете отложить их в библиотеку.</div>
        <div class="greenBtn">Отложить в библиотеку</div>
        <div class="lightBorderBtn lg">Удалить товары</div>
        <div class="lightBorderBtn lg">Оставить всё как есть</div>

    </div>
</div>
<div class="simpleDialog cartRemoveDialog removeAll">
    <div class="clickbleArea" onclick="closeForms()"></div>
    <div class="popUpForm">
        <div class="closeBtn" onclick="closeForms()"></div>
        <div class="imageBlock">
            <img src="<?=SITE_TEMPLATE_PATH;?>/images/hello.svg">
        </div>
        <div class="popUpTitle">Удалить все товары из корзины?</div>
        <div class="smallText">Если вы пока не готовы сделать заказ, вы можете отложить товары в библиотеку.</div>
        <div class="greenBtn">Отложить в библиотеку</div>
        <div class="lightBorderBtn lg">Удалить все товары</div>
        <div class="lightBorderBtn lg">Оставить всё как есть</div>

    </div>
</div>
<div class="simpleDialog thankYouSM">
    <div class="clickbleArea" onclick="closeForms()"></div>
    <div class="popUpForm">
        <div class="closeBtn" onclick="closeForms()"></div>
        <div class="largeImage">
            <img src="<?=SITE_TEMPLATE_PATH;?>/images/success_icons/kniga_na_polke.svg">
        </div>
        <div class="text">Книга добавлена на полку!</div>
    </div>
</div>
<div class="simpleDialog getGift">
    <div class="clickbleArea" onclick="closeForms()"></div>
    <div class="popUpForm">
        <div class="closeBtn" onclick="closeForms()"></div>
        <div class="popUpTitle lg">Получите один из этих товаро в подарок за покупку книги</div>
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
                                    <div class="discount">20% скидка</div>
                                    <div class="price"><span class="oldPrice">12 804 р.</span> 1 179 р.</div>
                                    <a href="#" class="lightBorderBtn">Купить</a>
                                </div>
                            </div>
                        </li>


                        <li class="sliderCoverSmall">
                            <div class="whiteSectionItem">

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
                                    <div class="discount">20% скидка</div>
                                    <div class="price"><span class="oldPrice">12 804 р.</span> 1 179 р.</div>
                                    <a href="#" class="lightBorderBtn">Купить</a>
                                </div>
                            </div>
                        </li>


                        <li class="sliderCoverSmall">
                            <div class="whiteSectionItem">
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
    </div>
</div>
<div class="simpleDialog allPayments">
    <div class="clickbleArea" onclick="closeForms()"></div>
    <div class="popUpForm">
        <div class="closeBtn" onclick="closeForms()"></div>
        <div class="popUpTitle lg">Все виды оплаты</div>
        <div class="allPaymentMethods">
            <div class="PMItem">
                <div class="text">Наличными при получении</div>
            </div>
            <div class="PMItem">
                <div class="text">Банковской картой</div>
                <div class="images">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_visa.svg">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_mastercard.svg">
                </div>
            </div>
            <div class="PMItem">
                <div class="text">Электронными деньгами</div>
                <div class="images">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_qiwi.svg">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_yandex.svg">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_webmoney.svg">
                </div>
            </div>
            <div class="PMItem">
                <div class="text">Со счёта мобильного</div>
                <div class="images">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_beeline.svg">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_megafon.svg">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_mts.svg">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_roselecom.svg">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/images/footerIcons/pay_tele2.svg">
                </div>
            </div>
            <div class="PMItem">
                <div class="text">Через терминал оплаты</div>
            </div>
            <div class="PMItem">
                <div class="text">Банковской квитанцией</div>
            </div>
            <a href="#" class="readMore">Подробнее</a>
        </div>
    </div>
</div>
<div class="simpleDialog bookOrder">
    <div class="clickbleArea" onclick="closeForms()"></div>
    <div class="popUpForm">
        <div class="closeBtn" onclick="closeForms()"></div>
        <div class="popUpTitle">Оформление книги</div>
        <div class="bookOrderCover">
            <div class="image"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/userImage.jpg"> </div>
            <div class="descr">
                Тип переплета: Твердый<br>
                Мелованная бумага с тиснением<br>
                Страницы: 340, 16 иллюстраций<br>
                Формат книги: 265x72x10 мм<br>
                Вес книги: 0,5 кг
            </div>
        </div>
    </div>
</div>
<div class="simpleDialog buyCheeper">
    <div class="clickbleArea" onclick="closeForms()"></div>
    <div class="popUpForm">
        <div class="closeBtn" onclick="closeForms()"></div>
        <div class="popUpTitle lg">Как купить эту книгу еще дешевле?</div>
        <div class="howToBuyCheeper">
            <div class="title">Для незарегистрированных пользователей</div>
            <p>Зарегистрируйтесь и мы подарим вам накопительную скидку 4% и вы сможете купить эту и другие книги дешевле.</p>
            <div class="title">Для незарегистрированных пользователей</div>
            <p>Оплачивайте свои покупки баллами. 100 баллов = 1 рублю. Есть несколько простых способов заработать больше баллов. Вот некоторые из них:</p>

            <div class="rectangleCover">
                <div class="columnBlock">
                    <div class="recItem">
                        <div class="text">500 баллов</div>
                        <a>Приведите друга</a>
                    </div>
                    <div class="recItem">
                        <div class="text">500 баллов</div>
                        <a>Заполните дату рождения</a>
                    </div>

                    <div class="recItem">
                        <div class="text">2000 баллов</div>
                        <a>Подпишитесь на наши новости</a>
                    </div>

                </div>
                <div class="columnBlock">
                    <div class="recItem">
                        <div class="text">500 баллов</div>
                        <a>Напишите полезный отзыв о товаре</a>
                    </div>
                    <div class="recItem">
                        <div class="text">500 баллов</div>
                        <a>Напишите отзыв о работе нашего магазина на Яндекс.Маркете</a>
                    </div>
                </div>



            </div>
            <div class="centerBlock">
                <a href="#" class="sm">Узнайте подробнее в личном кабинете или на нашей специальной страничке</a>
            </div>
        </div>
    </div>
</div>
<div class="simpleDialog shelfCreation">
    <div class="clickbleArea" onclick="closeForms()"></div>
    <div class="popUpForm">
        <div class="closeBtn" onclick="closeForms()"></div>
        <div class="popUpTitle">Добавить книгу в мою библиотеку</div>
        <div class="shelfCreationForm">
            <div class="introText">В библиотеке вы сможете откладывать  и хранить понравившиеся на сайте книги.  Для удобного поиска создавайте полки
                и распределяйте книги по жанрам, интересам и настроению.</div>
        </div>
        <div class="popUpTitle">Чтобы добавить книгу в библиотеку, создайте полку</div>
        <div class="formDiv">
            <div class="rowBlock">
                <input type="text" placeholder="Название полки">
            </div>
            <div class="rowBlock">
                <textarea placeholder="Описание полки"></textarea>
            </div>
            <div class="greenBtn md" onclick="showPopUp('shelfCreation_step2')">Создать полку</div>
        </div>
    </div>
</div>
<div class="simpleDialog shelfCreation_step2">
    <div class="clickbleArea" onclick="closeForms()"></div>
    <div class="popUpForm">
        <div class="closeBtn" onclick="closeForms()"></div>
        <div class="popUpTitle">Вы создали отличную полку!</div>
        <div class="shelfPreview">
            <div class="image">
                <img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/userImage.jpg">
            </div>
            <div class="name">Невероятные приключения и философия</div>
        </div>
        <div class="formDiv">
            <div class="rowBlock">
                <textarea placeholder="Напишите, почему вам нужно прочитать эту книгу"></textarea>
            </div>
            <div class="greenBtn md">Добавить книгу на полку</div>
        </div>
    </div>
</div>
<div class="simpleDialog deliveryInformation curierDelivery">
    <div class="clickbleArea" onclick="closeForms()"></div>
    <div class="popUpForm">
        <div class="closeBtn" onclick="closeForms()"></div>
        <div class="popUpTitle">Курьерская доставка Book24</div>
        <div class="smallText">
            <p>Доставка заказов весом свыше 15 кг осуществляется курьером только до подъезда, подъём на этаж в стоимость доставки не входит и оговаривается отдельно.</p>
            <p>Если въезд на территорию дома/предприятия ограничен, предупредите об этом нашего оператора — он заранее сообщит вам номер машины для заказа пропуска.</p>
            <p>Обратите внимание, что время ожидания курьера с момента прибытия составляет не более 15 минут. Если вы по каким-либо причинам не успеваете забрать заказ, просим предупредить об этого оператора.</p>
        </div>
    </div>
</div>
<div class="simpleDialog deliveryInformation postDelivery">
    <div class="clickbleArea" onclick="closeForms()"></div>
    <div class="popUpForm">
        <div class="closeBtn" onclick="closeForms()"></div>
        <div class="popUpTitle">Доставка Почтой России</div>
        <div class="smallText">
            <p>Стоимость и сроки доставки зависят от веса посылки и удалённости региона. Обращаем внимание, что информация о местонахождении посылки обновляется с небольший опозданием.</p>
        </div>
        <div class="actionsLinks">
            <a href="#">Сроки доставки</a>
            <a href="#">Стоимость</a>
            <a href="#">Отслеживание заказа</a>
        </div>
    </div>
</div>

<div class="simpleDialog subscribeNewBooks">
    <div class="clickbleArea" onclick="closeForms()"></div>
    <div class="popUpForm">
        <div class="closeBtn" onclick="closeForms()"></div>
        <div class="popUpTitle">Подписаться на новинки</div>
        <div class="smallText">Узнавайте о выходе новых книг в жанре «Фантастика»!</div>

        <div class="formDiv">
            <div class="rowBlock">
                <input type="text" placeholder="Ваш e-mail">
            </div>
            <div class="greenBtn" onclick="showPopUp('thankYouSubscribeNewBooks')">Подписаться на новинки</div>
        </div>

    </div>
</div>
<div class="simpleDialog thankYouSubscribeNewBooks">
    <div class="clickbleArea" onclick="closeForms()"></div>
    <div class="popUpForm">
        <div class="closeBtn" onclick="closeForms()"></div>
        <div class="largeImage">
        </div>
        <div class="text">Спасибо за подписку!  </div>
    </div>
</div>
<div class="simpleDialog subscribeFilter">
    <div class="clickbleArea" onclick="closeForms()"></div>
    <div class="popUpForm">
        <div class="closeBtn" onclick="closeForms()"></div>
        <div class="popUpTitle">Подписаться на подборку</div>
        <div class="smallText">Подпишитесь на вашу подборку книг с выбранными тегами и вы сможете получать уведомления о появлении новых книг. Следите за новостями подборки в личном кабинете в разделе <a href="#">«Моя библиотека».</a></div>

        <div class="filterList">
            <div class="FItem">
                <span class="text">В наличии</span>
                <div class="closeBtn"></div>
            </div>
            <div class="FItem">
                <span class="text">В подарок</span>
                <div class="closeBtn"></div>
            </div>
            <div class="FItem">
                <span class="text">Взрослому</span>
                <div class="closeBtn"></div>
            </div>
            <div class="FItem">
                <span class="text">В твердом переплете</span>
                <div class="closeBtn"></div>
            </div>

        </div>

        <div class="formDiv">
            <div class="rowBlock"><input type="text" placeholder="Название подборки"> </div>
            <div class="greenBtn">Подписаться на подборку</div>
        </div>
    </div>
</div>

<div class="bookPreviewDialog">
    <div class="BPDHeader">
        <div class="contentPart">
            <div class="bookTitle">Герман Мелвилл. Моби Дик, или Белый кит. В 2-х томах </div>
            <div class="rightHeaderSide">
                <div class="greenBtn md">Купить</div>
                <div class="closeBtn" onclick="bookPreview('hide')"></div>
            </div>
        </div>
    </div>
    <div class="BPDCotent">
        <div class="BTabs">
            <div class="BTabLine">
                <div class="tabItem active">Фотографии</div>
                <div class="tabItem">Отрывок</div>
                <div class="tabItem">Содержание</div>
                <div class="tabItem">Цитаты</div>
            </div>

            <div class="BTabsCont">
                <div class="BTabsContItem" >
                    <div class="bookImagesSlider">
                        <button type="button" value="" class="rightBtn"></button>
                        <button type="button" value="" class="leftBtn"></button>
                        <div class="bookImagesSliderInc">
                            <div class="largeImage"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/bookLarge.jpg"> </div>
                            <h3>Фотографии страниц от издательства и пользователей (18)</h3>
                            <div class="BImagesLine">
                                <ul>
                                    <li class="active">
                                        <div class="imageItem ">
                                            <div class="imageItemInc"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/bigSlider/big-photo1.jpg"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="imageItem">
                                            <div class="imageItemInc"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/bigSlider/big-photo2.jpg"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="imageItem">
                                            <div class="imageItemInc"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/bigSlider/big-photo3.jpg"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="imageItem">
                                            <div class="imageItemInc"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/bigSlider/big-photo4.jpg"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="imageItem">
                                            <div class="imageItemInc"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/bigSlider/big-photo5.jpg"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="imageItem">
                                            <div class="imageItemInc"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/bigSlider/big-photo6.jpg"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="imageItem">
                                            <div class="imageItemInc"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/bigSlider/big-photo7.jpg"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="imageItem">
                                            <div class="imageItemInc"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/bigSlider/big-photo8.jpg"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="imageItem">
                                            <div class="imageItemInc"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/bigSlider/big-photo9.jpg"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="imageItem">
                                            <div class="imageItemInc"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/bigSlider/big-photo10.jpg"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="imageItem">
                                            <div class="imageItemInc"><img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/bigSlider/big-photo11.jpg"></div>
                                        </div>
                                    </li>


                                </ul>
                            </div>
                            <div class="generalInfo">
                                Тип переплета: Твердый<br>
                                Мелованная бумага с тиснением<br>
                                Страницы: 340, 16 иллюстраций<br>
                                Формат книги: 265x72x10 мм<br>
                                Вес книги: 0,5 кг<br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="BTabsContItem" >
                    <div class="bookPart">
                        <div class="bookAuthor">Герман Мелвилл</div>
                        <div class="bookName">Моби Дик, или Белый кит</div>
                        <div class="bookSectionsDetails">
                            <div class="partNav">
                                <div class="introductoryText">5 глав из книги Германа Мелвилла «Моби Дик или Белый кит»:</div>
                                <div class="navItemsList">
                                    <div class="navItem active">Моби Дик, или Белый Кит</div>
                                    <div class="navItem">Этимология</div>
                                    <div class="navItem">Этимология</div>
                                    <div class="navItem">Извлечения</div>
                                    <div class="navItem">Извлечения</div>
                                </div>
                                <a href="#" class="lightBorderBtn md">Скачать отрывок</a>
                            </div>
                            <div class="paragraph">
                                <div class="textTitle">Этимология</div>
                                <div class="smallDescr">(Сведения, собранные Помощником учителя классической гимназии, впоследствии скончавшимся от чахотки)</div>
                                <div class="text">
                                    Я вижу его как сейчас – такого бледного, в поношенном сюртуке и с такими же поношенными мозгами, душой и телом. Он целыми днями стирал пыль со старых словарей и грамматик своим необыкновенным носовым платком, украшенным, словно в насмешку, пёстрыми флагами всех наций мира. Ему нравилось стирать пыль со старых грамматик; это мирное занятие наводило его на мысль о смерти.</div>
                            </div>
                            <div class="paragraph">
                                <div class="textTitle">Этимология</div>
                                <div class="smallDescr">(Сведения, собранные Помощником учителя классической гимназии, впоследствии скончавшимся от чахотки)</div>
                                <div class="text">
                                    Я вижу его как сейчас – такого бледного, в поношенном сюртуке и с такими же поношенными мозгами, душой и телом. Он целыми днями стирал пыль со старых словарей и грамматик своим необыкновенным носовым платком, украшенным, словно в насмешку, пёстрыми флагами всех наций мира. Ему нравилось стирать пыль со старых грамматик; это мирное занятие наводило его на мысль о смерти.</div>
                            </div>
                        </div>
                        <div class="BPageNav">
                            <a href="javascript:;" class="itemNav active">1</a>
                            <a href="javascript:;" class="itemNav">2</a>
                            <a href="javascript:;" class="itemNav">3</a>
                            <a href="javascript:;" class="itemNav">4</a>
                            <a href="javascript:;" class="itemNav">Следующая страница</a>
                        </div>

                    </div>
                </div>
                <div class="BTabsContItem" >
                    <div class="bookContent">
                        <div class="itemCont active">
                            <div class="text">Моби Дик, или Белый Кит</div>
                            <div class="icon"></div>
                        </div>
                        <div class="itemCont active">
                            <div class="text">Этимология</div>
                            <div class="icon"></div>
                        </div>
                        <div class="itemCont active">
                            <div class="text">Этимология</div>
                            <div class="icon"></div>
                        </div>
                        <div class="itemCont active">
                            <div class="text"> Извлечения</div>
                            <div class="icon"></div>
                        </div>
                        <div class="itemCont active">
                            <div class="text"> Извлечения</div>
                            <div class="icon"></div>
                        </div>
                        <div class="itemCont">
                            <div class="text">Глава I. Очертания проступают</div>
                            <div class="icon"></div>
                        </div>
                        <div class="itemCont">
                            <div class="text">Глава II. Ковровый саквояж</div>
                            <div class="icon"></div>
                        </div>
                        <div class="itemCont">
                            <div class="text">Глава III. Гостиница «Китовый фонтан»</div>
                            <div class="icon"></div>
                        </div>
                        <div class="itemCont">
                            <div class="text">Глава IV. Лоскутное одеяло</div>
                            <div class="icon"></div>
                        </div>
                        <div class="itemCont">
                            <div class="text">Глава V. Завтрак</div>
                            <div class="icon"></div>
                        </div>
                    </div>
                    <div class="BPageNav">
                        <a href="javascript:;" class="itemNav active">1</a>
                        <a href="javascript:;" class="itemNav">2</a>
                        <a href="javascript:;" class="itemNav">3</a>
                        <a href="javascript:;" class="itemNav">4</a>
                        <a href="javascript:;" class="itemNav">Следующая страница</a>
                    </div>
                </div>
                <div class="BTabsContItem" style="display: block" >
                    <div class="quotationsBlock">
                        <div class="quotItem">
                            <div class="QIContent">
                                <div class="text">Хотя он и был дикарём и хоть лицо его, по крайней мере на мой вкус, так жутко уродовала татуировка, всё-таки в его внешности было что-то приятное. </div>
                            </div>
                            <div class="QIFooter">
                                <div class="likeBtn">709 366</div>
                                <div class="socBlock sm">
                                    <div class="label">Поделиться</div>
                                    <a href="#" class="item fb"> </a>
                                    <a href="#" class="item vk"></a>
                                    <a href="#" class="item tw"> </a>
                                </div>
                            </div>
                        </div>
                        <div class="quotItem">
                            <div class="QIContent">
                                <div class="text">Превосходная это вещь – смех от души, превосходная и довольно-таки редкая, и это, между прочим, жаль. И потому, если какой-нибудь человек своей собственной персоной поставляет людям материал для хорошей шутки, пусть он не скаредничает и не стесняется.</div>
                            </div>
                            <div class="QIFooter">
                                <div class="likeBtn">709 366</div>
                                <div class="socBlock sm">
                                    <div class="label">Поделиться</div>
                                    <a href="#" class="item fb"> </a>
                                    <a href="#" class="item vk"></a>
                                    <a href="#" class="item tw"> </a>
                                </div>
                            </div>
                        </div>
                        <div class="quotItem">
                            <div class="QIContent">
                                <div class="text">Хотя он и был дикарём и хоть лицо его, по крайней мере на мой вкус, так жутко уродовала татуировка, всё-таки в его внешности было что-то приятное. </div>
                            </div>
                            <div class="QIFooter">
                                <div class="likeBtn">709 366</div>
                                <div class="socBlock sm">
                                    <div class="label">Поделиться</div>
                                    <a href="#" class="item fb"> </a>
                                    <a href="#" class="item vk"></a>
                                    <a href="#" class="item tw"> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="BPageNav">
                        <a href="javascript:;" class="itemNav active">1</a>
                        <a href="javascript:;" class="itemNav">2</a>
                        <a href="javascript:;" class="itemNav">3</a>
                        <a href="javascript:;" class="itemNav">4</a>
                        <a href="javascript:;" class="itemNav">Следующая страница</a>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
