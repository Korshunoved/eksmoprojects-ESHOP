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
global $deliveryDays;
$userId = $USER->GetId();
$arGroups = CUser::GetUserGroup($userId);
CModule::IncludeModule('highloadblock');

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
global $APPLICATION;

$hlblock = HL\HighloadBlockTable::getById(3)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

/* @var $entity_data_class Bitrix\Main\Entity\DataManager */
$bonus_res = $entity_data_class::getList(array(
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
}

global $arRegionData;

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

   if(!$checkResult)
      unset($services[$i]);
   
}
echo '<pre>';
print_r($services);
echo '</pre>';


?>
<div style="display: none;">
    <?
 echo '<pre>';
print_r($arResult);
echo '</pre>';?>
</div>
<script>
        trade_name = "<?=$arResult['NAME']?>";
        trade_id = "<?=$arResult['ID']?>";
        trade_link = "<?=$arResult['DETAIL_PAGE_URL']?>";
        formRequestMsg = "<?=GetMessage('TRADE_REQUEST_MSG')?>";
        formRequestMsg = formRequestMsg.replace("#TRADE_NAME#",'<?=$arResult['NAME']?>');
        productPrice = "<?=$arResult['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE']?>";
        
        preorder = "<?echo ($arResult['PROPERTIES']['PREDZAKAZ']['VALUE']=='Y') ? 'PO' : false;?>";
</script>
<div class="productInfo" id="<?=$arItemIDs['ID']?>">
                <div class="productInfo__cont">
                    <div class="productInfo__row">
                        <div class="productCover">
                            <div class="productCover__img">
                                <img id="<? echo $arItemIDs['PICT']; ?>" src="<? echo $arResult['DETAIL_PICTURE']['SRC']; ?>" alt="<? echo $strAlt; ?>" title="<? echo $strTitle; ?>">
                            </div>
                            <div class="button button_color_transparent button_type_catalog -js-openProductPart">Читать отрывок</div>
                            <div class="button button_color_transparent button_type_catalog -js-productOpenContent">Смотреть содержание</div>
                        </div>
                        <div class="productMain">
                            <h1 class="productMain__header"><?=$arResult["NAME"]?></h1>
                            <div class="productMain__summary">
                                <div class="productMain__summaryItem productMain__summaryItem_rating">
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
                                <div class="productMain__summaryItem productMain__summaryItem_cursor productMain__summaryItem_text -js-productGoToReviews"><i class="icon icon_size_s icon_img_minicomment" title="Комментарий"></i><?=count($arResult['PROPERTIES']['COMMENTS']['VALUE'])?>&nbsp;отзывов</div>
                                <div class="productMain__summaryItem productMain__summaryItem_cursor productMain__summaryItem_text -js-productGoToArticles"><i class="icon icon_size_s icon_img_minibook" title="Книга"></i><?=count($arResult['PROPERTIES']['REVIEWS']['VALUE'])?>&nbsp;статьи</div>
                                <div class="productMain__summaryItem productMain__summaryItem_text"><i class="icon icon_size_s icon_img_minicart" title="Корзина"></i>50&nbsp;раз&nbsp;купили</div>
                            </div>
                            <div class="productMain__info"><?=$arResult['PROPERTIES']['PROD_TEXT']['VALUE']['TEXT']?></div>
                            <a href="#" class="productMain__moreInfo -js-productGoToInfo">Подробнее</a>
                            
                        <?if (!empty($arResult['DISPLAY_PROPERTIES'])):?>
                            <dl class="productMain__properties">
                                <?foreach ($arResult['DISPLAY_PROPERTIES'] as &$arOneProp) {?>
                                <dt class="productMain__propertiesName"><? echo $arOneProp['NAME']; ?></dt>
                                <dd class="productMain__propertiesValue">
                                    <?
                                        echo (
                                                is_array($arOneProp['DISPLAY_VALUE'])
                                                ? implode(' / ', $arOneProp['DISPLAY_VALUE'])
                                                : $arOneProp['DISPLAY_VALUE']
                                        ); ?>
                                </dd>
                                <?}?>
                                <?unset($arOneProp);?>
                            </dl>
                        <?endif?>
                            
                            <a href="#" class="productMain__form -js-productBookType">Оформление книги</a>

                            <div class="productMain__subheader">Ищите похожие книги</div>
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

                            <div class="productMain__subheader">Фотографии страниц от&nbsp;издательства и&nbsp;пользователей</div>
                            <ul class="productMain__photo">
                                <?foreach ($arResult["PROPERTIES"]['MORE_PHOTO']['VALUE'] as $key => $value):?> 
                                    <?$PIC_URL = CFile::GetPath($value);?>
                                    <li class="productMain__photoItem">
                                        <img src="<?=$PIC_URL?>" />
                                    </li>
                                <?endforeach;?>
                                <li class="productMain__photoMore"><a href="#" class="productMain__photoMoreLink -js-productMorePhotos">Еще 8 фотографий</a>
                                </li>
                            </ul>
                        </div>
                        <div class="productOrder">
                            <div class="productOrder__inner">
                                <div class="productOrder__type">
                                    <i class="icon icon_size_ms icon_color_red icon_img_hardcover" title="Твёрдный переплёт"></i> 
                                    <div class="productOrder__typeSelector">
                                        <a href="#" class="productOrder__typeSelectorLink notifyParent">
                                            <?=$arResult['PROPERTIES']['COVER']['VALUE']?>
                                            <div class="notify"></div>
                                        </a>
                                    </div>
                                </div>
                                <div class="productOrder__availability productOrder__availability_small">Осталось <?=$arResult['CATALOG_QUANTITY']?> книг</div>
                                <?if ($arResult['PRICES']['BASE']['DISCOUNT_DIFF_PERCENT']){?>
                                    <div class="productOrder__discount">Скидка <?=$arResult['PRICES']['BASE']['DISCOUNT_DIFF_PERCENT']?>%</div>
                                    <div class="productOrder__price"><span><?=$arResult['PRICES']['BASE']['VALUE']?> р.</span> <?=$arResult['PRICES']['BASE']['PRINT_DISCOUNT_VALUE']?></div>
                                    <a href="#" class="productOrder__cheaper">Как купить эту книгу еще дешевле?</a>
                                <?}else{?>
                                    <div class="productOrder__price"><?=$arResult['PRICES']['BASE']['VALUE']?> р.</div>
                                <?}?>
                                <form class="bxr-basket-action bxr-basket-group bxr-currnet-torg" action="">
                                    <input type="hidden" name="quantity" value="1" class="bxr-quantity-text" data-item="<?=$arResult["ID"]?>">
                                    <button class="button button_color_green button_type_catalog bxr-basket-add" style="margin: 22px 0 9px;">
                                            <span>Купить</span>
                                    </button>
                                    <input class="bxr-basket-item-id" type="hidden" name="item" value="<?=$arResult["ID"]?>">
                                    <input type="hidden" name="action" value="add">
                                </form>
                                <div class="productOrder__toLibrary"><i class="icon icon_size_s icon_img_miniplus" title="Добавить"></i>Добавить в библиотеку</div>
                                <div class="productOrder__present">Дарим <a href="#" class="productOrder__presentLink"><?=($arResult['PRICES']['BASE']['VALUE']*($bonus/100))?> баллов</a> и <a href="#" class="productOrder__presentLink">подарок</a>
                                </div>
                                <div class="productOrder__shipping">
                                    <?if ($arResult['PRICE_MATRIX']['MATRIX'][1][0]['PRICE']>1000){?>
                                        Бесплатная доставка (в течении <?=$deliveryDays?> дней)
                                    <?}else{?>
                                        Доставка в течении <?=$deliveryDays?> дней
                                    <?}?>
                                </div>
                                <div>
                                    <a href="javascript:void (0);" class="bxr-one-click-buy">Купить в 1 клик</a>
                                </div>
                                <?if ($arResult['PROPERTIES']['PREDZAKAZ']['VALUE']=='Y'){?>
                                    <a href="javascript:void (0);" class="bxr-preorder-buy">Предзаказ</a>
                                <?}?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="productCombo">
                <div class="productCombo__cont">
                    <div class="productCombo__header">Вместе дешевле</div>
                    <ul class="productCombo__info">
                        <li class="productCombo__infoItem">
                            <img src="<?=SITE_TEMPLATE_PATH;?>/images/content/products/combocover_1.png" />
                        </li>
                        <li class="productCombo__infoItem productCombo__infoItem_plus">
                            <img src="<?=SITE_TEMPLATE_PATH;?>/images/content/products/combocover_2.png" />
                        </li>
                        <li class="productCombo__infoItem productCombo__infoItem_plus">
                            <img src="<?=SITE_TEMPLATE_PATH;?>/images/content/products/combocover_3.png" />
                        </li>
                        <li class="productCombo__infoItem productCombo__infoItem_plus">
                            <img src="<?=SITE_TEMPLATE_PATH;?>/images/content/products/combocover_4.png" />
                        </li>
                        <li class="productCombo__infoItem productCombo__infoItem_total">
                            <div class="productCombo__price"><span>3 600 р.</span> 3 100 р.</div>
                            <div class="button button_color_green button_type_catalog -js-productBuyCombo">Купить</div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="productTabs">
                <div class="productTabs__cont">
                    <ul class="tabControls">
                        <li class="tabControls__item tabControls__item_active -js-tabControl" data-tab="0">Описание</li>
                        <li class="tabControls__item -js-tabControl" data-tab="1">Отзывы: <?=count($arResult['PROPERTIES']['COMMENTS']['VALUE'])?></li>
                        <li class="tabControls__item -js-tabControl" data-tab="2">Статьи о книге: <?=count($arResult['PROPERTIES']['REVIEWS']['VALUE'])?></li>
                        <li class="tabControls__item -js-tabControl" data-tab="3">Доставка</li></ul>
                    <ul class="tabContents">
                        <li class="tabContents__item tabContents__item_active" data-tab="0">
                            <div class="productTab">
                                <div class="productTab__header">Описание</div>
                                <div class="productTab__links">
                                    <?
        $microAr = array();
        $arSelectMicro = Array("ID", "NAME",'XML_ID','DETAIL_TEXT','PROPERTY_FROM','PROPERTY_LINK');
        $arFilterMicro = Array("IBLOCK_ID"=>4, "XML_ID"=>$arResult['PROPERTIES']['MICROREVIEWS']['VALUE']);
        $resMicro = CIBlockElement::GetList(Array(), $arFilterMicro, false, Array(), $arSelectMicro);
        while($obMicro = $resMicro->GetNextElement())
        {
            $arFieldsMicro = $obMicro->GetFields();
            ?>
                                    <div class="productTab__linksItem">
                                        <div class="productTab__text"><?=$arFieldsMicro['DETAIL_TEXT']?></div>
                                        <a class="productTab__link" target="_blank" href="<?=$arFieldsMicro['PROPERTY_LINK_VALUE']?>"><?=$arFieldsMicro['PROPERTY_FROM_VALUE']?></a>
                                    </div>
            <?}?>
                                </div>
                                <div class="productTab__subheader">Аннотация</div>
                                <div class="productTab__textBlock">
                                    <p class="productTab__paragraph"><?=$arResult['PREVIEW_TEXT']?></p>
                                </div>
                                <div class="productTab__subheader">Сюжет</div>
                                <div class="productTab__textBlock">
                                    <p class="productTab__paragraph"><?=$arResult['DETAIL_TEXT']?></p>
                                    <a href="#" class="productTab__more productTab__more_pseudo -js-openProductMore">Подробнее</a>
                                </div>
                                <div class="productTab__header">Награды</div>
                                <dl class="productTab__awards">
                                    <dt class="productTab__awardsYear">1976</dt>
                                    <dd class="productTab__awardsInfo">
                                        <div class="productTab__awardsName"><a href="#">Всемирная премия фэнтези</a>
                                        </div>
                                        <div class="productTab__awardsCategory">Лучший роман</div>
                                    </dd>
                                    <dt class="productTab__awardsYear">1976</dt>
                                    <dd class="productTab__awardsInfo">
                                        <div class="productTab__awardsName"><a href="#">Балрог</a>
                                        </div>
                                        <div class="productTab__awardsCategory">Лучший роман</div>
                                    </dd>
                                </dl>
                                <div class="productTab__header">Об авторе</div>
                                <?        
        $arFilterAuth = Array("IBLOCK_ID"=>13, "XML_ID"=>$arResult['PROPERTIES']['AUTHOR']['VALUE']);
        $resAuth = CIBlockElement::GetList(Array(), $arFilterAuth, false, Array(), array());
        while($obAuth = $resAuth->GetNextElement())
        {
            $arFieldsAuth = $obAuth->GetFields();
            $authPic = $arFieldsAuth['DETAIL_PICTURE'];
            $authPicUrl = CFile::GetPath($authPic);
            ?>
                                <div class="productTab__author">
                                    <img src="<?=$authPicUrl?>" class="productTab__authorImg" width="50" height="50"/>
                                    <div class="productTab__authorName"><?=$arFieldsAuth['NAME']?></div>
                                </div>
                                <div class="productTab__textBlock">
                                    <p class="productTab__paragraph"><?=$arFieldsAuth['PREVIEW_TEXT']?></p>
                                    <a href="<?=$arFieldsAuth['DETAIL_PAGE_URL']?>" class="productTab__more">Подробнее об авторе</a>
                                </div>
                                <?
        }
         ?>
                            </div>
                        </li>
                        <li class="tabContents__item" data-tab="1">
                            <div class="productTab">
                                <div class="productTab__header">Отзывы <span>(3)</span>
                                </div>


                                <div class="productReviews">
                                    <div class="reviewItem">
                                        <div class="reviewItem__user">
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/images/content/reviews/ava.png" class="reviewItem__userPhoto" />
                                            <a href="#" class="reviewItem__userName">Вадим Мерещяков</a>
                                            <div class="reviewItem__date">24 февраля</div>
                                        </div>
                                        <div class="reviewItem__rating">
                                            <ul class="rating">
                                                <li class="rating__item rating__item_active"></li>
                                                <li class="rating__item rating__item_active"></li>
                                                <li class="rating__item rating__item_active"></li>
                                                <li class="rating__item rating__item_active"></li>
                                                <li class="rating__item"></li>
                                                <li class="rating__vote">4</li>
                                            </ul>
                                        </div>
                                        <div class="reviewItem__text">
                                            <div class="reviewItem__textHeader">Достоинства</div>
                                            <p class="reviewItem__textPar">Мне очень нравиться книга &quot;Моби Дик&quot;. Великолепная книга и она (книга) для того, что бы ее читать. То есть книга для тех кто любит читать и любит книги потолще.</p>
                                        </div>
                                        <div class="reviewItem__text">
                                            <div class="reviewItem__textHeader">Недостатки</div>
                                            <p class="reviewItem__textPar">Нет таких, качество отличное</p>
                                        </div>
                                        <div class="reviewItem__text">
                                            <div class="reviewItem__textHeader">Общее впечатление от книги</div>
                                            <p class="reviewItem__textPar">Сначала две цитаты из читательских рецензий на &quot;Моби Дика&quot;.</p>
                                            <p class="reviewItem__textPar">&quot;....расположить иллюстрации, которые должны были бы быть, скажем, на разворот (это мне так кажется), а вместо этого напечатаны вертикально - это плохая идея, хотя и далеко не новая. Надеюсь, эта &quot;Новая
                                                Академия&quot; в дальнейшем выдаст что-нибудь поновее, а то при чтении очень неудобно переворачивать немаленький томик туда-сюда, чтобы все хорошенько рассмотреть. Впрочем, я и не...</p>
                                        </div>
                                    </div>
                                    <div class="reviewItem">
                                        <div class="reviewItem__user">
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/images/content/reviews/ava.png" class="reviewItem__userPhoto" />
                                            <a href="#" class="reviewItem__userName">Natalia</a>
                                            <div class="reviewItem__date">2 февраля</div>
                                        </div>
                                        <div class="reviewItem__rating">
                                            <ul class="rating">
                                                <li class="rating__item rating__item_active"></li>
                                                <li class="rating__item rating__item_active"></li>
                                                <li class="rating__item rating__item_active"></li>
                                                <li class="rating__item"></li>
                                                <li class="rating__item"></li>
                                                <li class="rating__vote">3</li>
                                            </ul>
                                        </div>
                                        <div class="reviewItem__text">
                                            <div class="reviewItem__textHeader">Достоинства</div>
                                            <p class="reviewItem__textPar">Мне очень нравиться книга &quot;Моби Дик&quot;. Великолепная книга и она (книга) для того, что бы ее читать. То есть книга для тех кто любит читать и любит книги потолще.</p>
                                        </div>
                                        <div class="reviewItem__text">
                                            <div class="reviewItem__textHeader">Недостатки</div>
                                            <p class="reviewItem__textPar">Нет таких, качество отличное</p>
                                        </div>
                                        <div class="reviewItem__text">
                                            <div class="reviewItem__textHeader">Общее впечатление от книги</div>
                                            <p class="reviewItem__textPar">Сначала две цитаты из читательских рецензий на &quot;Моби Дика&quot;.</p>
                                            <p class="reviewItem__textPar">&quot;....расположить иллюстрации, которые должны были бы быть, скажем, на разворот (это мне так кажется), а вместо этого напечатаны вертикально - это плохая идея, хотя и далеко не новая. Надеюсь, эта &quot;Новая
                                                Академия&quot; в дальнейшем выдаст что-нибудь поновее, а то при чтении очень неудобно переворачивать немаленький томик туда-сюда, чтобы все хорошенько рассмотреть. Впрочем, я и не...</p>
                                        </div>
                                        <div class="reviewItem__share">
                                            <div class="reviewItem__likes"><i class="icon icon_size_s icon_img_minilike" title="Лойс"></i>1</div>
                                            <div class="reviewItem__social">
                                                <div>Поделиться</div>
                                                <ul class="social social_small">
                                                    <li class="social__item social__item_fb social__item_small"></li>
                                                    <li class="social__item social__item_tw social__item_small"></li>
                                                    <li class="social__item social__item_vk social__item_small"></li>
                                                    <li class="social__item social__item_ social__item_small"></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="reviewItem">
                                        <div class="reviewItem__user">
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/images/content/reviews/ava.png" class="reviewItem__userPhoto" />
                                            <a href="#" class="reviewItem__userName">≈∫W∆G_ћ∑®ø≈</a>
                                            <div class="reviewItem__date">1 февраля</div>
                                        </div>
                                        <div class="reviewItem__rating">
                                            <ul class="rating">
                                                <li class="rating__item rating__item_active"></li>
                                                <li class="rating__item rating__item_active"></li>
                                                <li class="rating__item rating__item_active"></li>
                                                <li class="rating__item rating__item_active"></li>
                                                <li class="rating__item rating__item_active"></li>
                                                <li class="rating__vote">5</li>
                                            </ul>
                                        </div>
                                        <div class="reviewItem__text">
                                            <div class="reviewItem__textHeader">Достоинства</div>
                                            <p class="reviewItem__textPar">Мне очень нравиться книга &quot;Моби Дик&quot;. Великолепная книга и она (книга) для того, что бы ее читать. То есть книга для тех кто любит читать и любит книги потолще.</p>
                                        </div>
                                        <div class="reviewItem__text">
                                            <div class="reviewItem__textHeader">Недостатки</div>
                                            <p class="reviewItem__textPar">Нет таких, качество отличное</p>
                                        </div>
                                        <div class="reviewItem__text">
                                            <div class="reviewItem__textHeader">Общее впечатление от книги</div>
                                            <p class="reviewItem__textPar">Сначала две цитаты из читательских рецензий на &quot;Моби Дика&quot;.</p>
                                            <p class="reviewItem__textPar">&quot;....расположить иллюстрации, которые должны были бы быть, скажем, на разворот (это мне так кажется), а вместо этого напечатаны вертикально - это плохая идея, хотя и далеко не новая. Надеюсь, эта &quot;Новая
                                                Академия&quot; в дальнейшем выдаст что-нибудь поновее, а то при чтении очень неудобно переворачивать немаленький томик туда-сюда, чтобы все хорошенько рассмотреть. Впрочем, я и не...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="tabContents__item" data-tab="2">
                            <div class="productTab">
                                <div class="productTab__header">Статьи и публикации</div>

                                <div class="productTab__articles">
                                    <?
        $arSelectReviews = array('ID','NAME','DETAIL_TEXT','PROPERTY_VIDEO','PROPERTY_RATING','PROPERTY_USER_ID','PROPERTY_FULL_TEXT','PROPERTY_AUTHOR','PROPERTY_FROM','PROPERTY_PIC');
        $arFilterReviews = Array("IBLOCK_ID"=>5, "XML_ID"=>$arResult['PROPERTIES']['REVIEWS']['VALUE'],'PROPERTY_STATUS_HIDDEN'=>68);
        $resReviews = CIBlockElement::GetList(Array(), $arFilterReviews, false, Array(), $arSelectReviews);
        while($obReviews = $resReviews->GetNextElement())
        {
            $arFieldsReviews = $obReviews->GetFields();
            //echo '<div><a href="'.$arFieldsReviews['PROPERTY_FROM'].'"></a></div><br><br>';
        ?>
                                    <div class="articleItem">
                                        <div class="articleItem__info">
                                            <img src="<?=CFile::GetPath($arFieldsReviews['PROPERTY_PIC_VALUE'])?>" class="articleItem__logo" />
                                            <div class="articleItem__origin"><?=$arFieldsReviews['PROPERTY_FROM_VALUE']?></div>
                                            <a href="#" class="articleItem__author"><?=$arFieldsReviews['PROPERTY_AUTHOR_VALUE']?></a>
                                        </div>
                                        <div class="articleItem__text">
                                            <p class="articleItem__textPar"><?=$arFieldsReviews['DETAIL_TEXT']?></p>
                                        </div>
                                        <?if ($arFieldsReviews['PROPERTY_VIDEO_VALUE']):?>
                                            <div class="articleItem__video">
                                                <iframe width="505" height="284" src="<?=$arFieldsReviews['PROPERTY_VIDEO_VALUE']?>" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                        <?endif;?>
                                        <a href="#" class="articleItem__more">Смотреть обзор</a>
                                    </div>
                            <?}?>
                                </div>
                            </div>
                        </li>
                        <li class="tabContents__item" data-tab="3">
                            <div class="productTab">
                                <div class="productTab__header">Доставка</div>
                                <div class="productDelivery__city">
                                    В город 
                                    <a href="#" class="productDelivery__citySelect notifyParent"><?=$arRegionData['NAME']?>
                                        <div class="notify">
                                        <div class="notify__title">Ваш город</div>
                                            <ul class="social">
                                                <li class="social__item social__item_"></li><li class="social__item social__item_"></li>
                                            </ul>
                                        </div>
                                    </a>
                                </div>
                                <div class="productDelivery__info">
                                    <?if ($arResult['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE']>999){?>
                                    Вам доступна бесплатная доставка.
                                    <?}else{?>
                                    Пока доступна только платная доставка. 
                                    Бесплатная доставка при заказе от 999 руб. 
                                    Дополните ваш заказ товарами на сумму больше 
                                    <?=(999-$arResult['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE'])?>
                                    руб и 
                                    получите бесплатную доставку
                                    <?}?>
                                </div>
                                <div class="productDeliveryFeatures">
                                    <div class="productDeliveryFeature productDeliveryFeature_optimal">
                                        <div class="productDeliveryFeature__cont">
                                            <div class="productDeliveryFeature__icon"><i class="icon icon_size_l icon_color_green icon_img_courier" title="Доставка курьером"></i>
                                            </div>
                                            <div class="productDeliveryFeature__info">
                                                <div class="productDeliveryFeature__comment">Оптимальный вариант</div>
                                                <div class="productDeliveryFeature__name">Курьерской службой</div>
                                                <div class="productDeliveryFeature__date">Ближайшая дата доставки: <span>23 февраля, среда</span>
                                                </div>
                                                <?if ($arResult['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE']<999){?>
                                                <div class="productDeliveryFeature__price">от 100 руб.</div>
                                                <?}?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="productDeliveryFeature">
                                        <div class="productDeliveryFeature__cont">
                                            <div class="productDeliveryFeature__icon"><i class="icon icon_size_l icon_color_yellow icon_img_self" title="Самовывоз"></i>
                                            </div>
                                            <div class="productDeliveryFeature__info">
                                                <div class="productDeliveryFeature__comment">Выйдет дороже</div>
                                                <div class="productDeliveryFeature__name">Самовывоз</div>
                                                <div class="productDeliveryFeature__date">с 24 февраля, четверг</div>
                                                <?if ($arResult['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE']<999){?>
                                                <div class="productDeliveryFeature__price">от 100 руб.</div>
                                                <?}?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="productDeliveryFeature">
                                        <div class="productDeliveryFeature__cont">
                                            <div class="productDeliveryFeature__icon"><i class="icon icon_size_l icon_color_yellow icon_img_post" title="Доставка почтой"></i>
                                            </div>
                                            <div class="productDeliveryFeature__info">
                                                <div class="productDeliveryFeature__comment">Вариант для терпеливых</div>
                                                <div class="productDeliveryFeature__name">Почтой России</div>
                                                <div class="productDeliveryFeature__date">со 2 марта, среда</div>
                                                <?if ($arResult['PRICE_MATRIX']['MATRIX'][1][0]['DISCOUNT_PRICE']<999){?>
                                                <div class="productDeliveryFeature__price">от 1 000 руб.</div>
                                                <?}?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="page__buffer"></div>
<script type="text/javascript">
var <? echo $strObName; ?> = new JCCatalogElement(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
BX.message({
	ECONOMY_INFO_MESSAGE: '<? echo GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO'); ?>',
	BASIS_PRICE_MESSAGE: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_BASIS_PRICE') ?>',
	TITLE_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
	TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
	BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
	BTN_SEND_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS'); ?>',
	BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
	BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE'); ?>',
	BTN_MESSAGE_CLOSE_POPUP: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
	TITLE_SUCCESSFUL: '<? echo GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK'); ?>',
	COMPARE_MESSAGE_OK: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK') ?>',
	COMPARE_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
	COMPARE_TITLE: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE') ?>',
	BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
	PRODUCT_GIFT_LABEL: '<? echo GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL') ?>',
	SITE_ID: '<? echo SITE_ID; ?>'
});
</script>