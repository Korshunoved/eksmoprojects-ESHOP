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
global $deliveryDays;
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
    'filter' => array('UF_XML_ID' => $arGroups),
    'select' => array('ID','UF_BONUS'),
    'order' => array()
));
if($bonus_ob = $bonus_res->Fetch()) $bonus = $bonus_ob['UF_BONUS'];
else $bonus = 2;

$useVoteRating = ('Y' == $arParams['USE_VOTE_RATING']);

global $wishList;
$inWishList = false;
foreach ($wishList as $value) {
    if ($arResult['ID']==$value)
        $inWishList = true;
}
?>
<div style="display: none;">
    <?
    echo '<pre>';
    print_r($arResult);
    echo '</pre>';
    ?>
</div>
<div class="bx_item_detail <? echo $templateData['TEMPLATE_CLASS']; ?>" id="<? echo $arItemIDs['ID']; ?>">
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="detail-image">
            <img id="<? echo $arItemIDs['PICT']; ?>" src="<? echo $arResult['DETAIL_PICTURE']['SRC']; ?>" alt="<? echo $strAlt; ?>" title="<? echo $strTitle; ?>">
        </div>
        <div class="detail-pic-link">
            <div><a target="blank" href="http://cdn.eksmo.ru/v2/<?=$arResult['PROPERTIES']['BARCODE']['VALUE']?>/read">Читать отрывок</a></div>
            <div><a class="open-contain" href='/ajax/form-open-contain.php?el_id=<?=$arResult['ID']?>'>Смотреть содержание</a></div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="bx_item_title">
            <h1>
                <span>
                    <?
                        echo (
                            isset($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != ''
                            ? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
                            : $arResult["NAME"]
                        ); 
                    ?>
                </span>
            </h1>
        </div>
        <div class="detail-rating">
            <?if ($useVoteRating)
            {
                    ?><?$APPLICATION->IncludeComponent(
                            "bitrix:iblock.vote",
                            "stars",
                            array(
                                    "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
                                    "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                                    "ELEMENT_ID" => $arResult['ID'],
                                    "ELEMENT_CODE" => "",
                                    "MAX_VOTE" => "5",
                                    "VOTE_NAMES" => array("1", "2", "3", "4", "5"),
                                    "SET_STATUS_404" => "N",
                                    "DISPLAY_AS_RATING" => $arParams['VOTE_DISPLAY_AS_RATING'],
                                    "CACHE_TYPE" => $arParams['CACHE_TYPE'],
                                    "CACHE_TIME" => $arParams['CACHE_TIME']
                            ),
                            $component,
                            array("HIDE_ICONS" => "Y")
                    );?><?
            }?>
        </div>
        <div>
            <a href="#comments-block"><?=count($arResult['PROPERTIES']['COMMENTS']['VALUE'])?> отзыва</a>
            <a href="#reviews-block"><?=count($arResult['PROPERTIES']['REVIEWS']['VALUE'])?> статьи</a>
            <?
                $i=0;
                $rsSales = CSaleOrder::GetList(array('ID' => 'DESC'), array('BASKET_PRODUCT_ID' => $arResult['ID']));
                while ($arSales = $rsSales->Fetch())
                {
                   $i++;
                }
            ?>
            <span><?=$i?> раз купили</span><br><br>
        </div>
        <div>
            <?=$arResult['PROPERTIES']['PROD_TEXT']['VALUE']['TEXT']?>
            <div><a href="#more_info">Подробнее</a></div><br>
        </div>
        <div class="item_info_section">
        <?
                if (!empty($arResult['DISPLAY_PROPERTIES']))
                {
        ?>
                <dl>
        <?
                        foreach ($arResult['DISPLAY_PROPERTIES'] as &$arOneProp)
                        {
        ?>
                        <dt><? echo $arOneProp['NAME']; ?></dt><dd><?
                                echo (
                                        is_array($arOneProp['DISPLAY_VALUE'])
                                        ? implode(' / ', $arOneProp['DISPLAY_VALUE'])
                                        : $arOneProp['DISPLAY_VALUE']
                                ); ?></dd><?
                        }
                        unset($arOneProp);
        ?>
                </dl>
        <?
                }
        ?>
        </div>
        <div>
            <div><b>Ищите похожие книги</b></div>
             <?$APPLICATION->IncludeComponent(
	"bitrix:search.tags.cloud", 
	".default", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COLOR_NEW" => "7b89b0",
		"COLOR_OLD" => "7b89b0",
		"COLOR_TYPE" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"FILTER_NAME" => "",
		"FONT_MAX" => "16",
		"FONT_MIN" => "16",
		"PAGE_ELEMENTS" => "20",
		"PERIOD" => "30",
		"PERIOD_NEW_TAGS" => "",
		"SHOW_CHAIN" => "Y",
		"SORT" => "CNT",
		"TAGS_INHERIT" => "Y",
		"URL_SEARCH" => "/search/index.php",
		"WIDTH" => "100%",
		"arrFILTER" => array(
			0 => "iblock_catalog",
		),
		"arrFILTER_iblock_catalog" => array(
			0 => "all",
		)
	),
	false
);?>
        </div>
        <br>
        <div>
            <div><b>Фотографии страниц от издательства и пользователей</b></div>
            <div class="photo-index-container">
            <?foreach ($arResult["PROPERTIES"]['MORE_PHOTO']['VALUE'] as $key => $value):?> 
                <?
                        $PIC_URL = CFile::GetPath($value);
                ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="photo-card">
                        <div class="photo-card-image" >
                            <a href="<?=$PIC_URL?>" class="photo-card-image-link" rel='fancy-morephoto'>
                                <?
                                    /*$strTitle = $arItem["PREVIEW_PICTURE"]["TITLE"];
                                    $strAlt = $arItem["PREVIEW_PICTURE"]["ALT"];
                                    $image=\Museum\Image::getHtml($arItem["PREVIEW_PICTURE"]['SRC'], 220, 220,'',$strTitle,$strAlt);
                                    echo $image;*/
                                ?>
                                <img src="<?=$PIC_URL?>" width="200" height="200">
                            </a>
                        </div>
                    </div>
                </div>
            <?endforeach;?>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div>Осталось: <?=$arResult['CATALOG_QUANTITY']?> книг</div>
        <div><b><?=$arResult['PRICE_MATRIX']['MATRIX'][1][0]['PRICE']?> р.</b></div>
        <?if ($arResult['PRICE_MATRIX']['MATRIX'][1][0]['PRICE']>1000){?>
            <div>Доставим за <?=$deliveryDays?> дней бесплатно</div>
        <?} else {?>
            <div>Доставим за <?=$deliveryDays?> дней</div>
        <?}?>
            <div>+ <?=($arResult['PRICE_MATRIX']['MATRIX'][1][0]['PRICE']*($bonus/100))?> баллов на счет</div>
        <?$qtyMax = $arResult["CATALOG_QUANTITY"];?>
        <form class="bxr-basket-action bxr-basket-group bxr-currnet-torg" action="">
                <input type="button" class="bxr-quantity-button-minus" value="-" data-item="<?=$arResult["ID"]?>">
                <input type="text" name="quantity" value="1" class="bxr-quantity-text" data-item="<?=$arResult["ID"]?>">
                <input type="button" class="bxr-quantity-button-plus" value="+" data-item="<?=$arResult["ID"]?>" data-max="<?=$qtyMax?>">
                <button class="bxr-color-button bxr-color-button-small-only-icon bxr-basket-add">
                        <span class="fa fa-shopping-cart"></span>
                </button>
                <input class="bxr-basket-item-id" type="hidden" name="item" value="<?=$arResult["ID"]?>">
                <input type="hidden" name="action" value="add">
        </form>
        <?if (!$USER->GetID()){?>
        <?} elseif ($inWishList){?>
            <a href="javascript:void (0);" class="delete-from-wishes-list" data-element="<?=$arResult['ID']?>">Удалить из списка желаний</a>
        <?} else {?>
            <a href="javascript:void (0);" class="add-to-wishes-list" data-element="<?=$arResult['ID']?>" data-user="<?=$USER->GetID()?>">Добавить в список желаний</a>
        <?}?>
            <div>
                <a href="javascript:void (0);" class="bxr-one-click-buy">Купить в 1 клик</a>
            </div>
        <div>
            <?if ($arResult['PROPERTIES']['PREDZAKAZ']['VALUE']=='Y'){?>
                <a href="javascript:void (0);" class="bxr-preorder-buy">Предзаказ</a>
            <?}?>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?
        $microAr = array();
        $arSelectMicro = Array("ID", "NAME",'XML_ID','DETAIL_TEXT','PROPERTY_FROM','PROPERTY_LINK');
        $arFilterMicro = Array("IBLOCK_ID"=>27, "ID"=>$arResult['PROPERTIES']['MICROREVIEWS']['VALUE']);
        $resMicro = CIBlockElement::GetList(Array(), $arFilterMicro, false, Array(), $arSelectMicro);
        while($obMicro = $resMicro->GetNextElement())
        {
            $arFieldsMicro = $obMicro->GetFields();
            echo '<div>'.$arFieldsMicro['DETAIL_TEXT'].'</div>';
            echo '<div><a href="'.$arFieldsMicro['PROPERTY_LINK_VALUE'].' target="_blank">'.$arFieldsMicro['PROPERTY_FROM_VALUE'].'</a></div><br>';
        }
        ?>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="more_info">
        <?if ($arResult['PREVIEW_TEXT']){?>
        <div><b>Аннотация</b></div><br>
        <div><?=$arResult['PREVIEW_TEXT']?></div><br>
        <?}?>
        <?if ($arResult['DETAIL_TEXT']){?>
        <div><b>Сюжет</b></div><br>
        <div><?=$arResult['DETAIL_TEXT']?></div><br>
        <?}?>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div style="text-align: center;"><b>Об авторе</b></div><br>
        <?
        $arFilterAuth = Array("IBLOCK_ID"=>4, "ID"=>$arResult['PROPERTIES']['AUTHOR']['VALUE']);
        $resAuth = CIBlockElement::GetList(Array(), $arFilterAuth, false, Array(), array());
        while($obAuth = $resAuth->GetNextElement())
        {
            $arFieldsAuth = $obAuth->GetFields();
            $authPic = $arFieldsAuth['DETAIL_PICTURE'];
            $authPicUrl = CFile::GetPath($authPic);
         ?>
        <div>
            <img src="<?=$authPicUrl?>" width="50" height="50">
            <span><?=$arFieldsAuth['NAME']?></span>
        </div>
        <div>
            <?=$arFieldsAuth['PREVIEW_TEXT']?>
        </div>
        <div>
            <a target="_blank" href="<?=$arFieldsAuth['DETAIL_PAGE_URL']?>">Подробнее об авторе</a>
        </div>
        <?}?>
    </div><br><br>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div style="text-align: center;"><b>Вместе дешевле</b></div>
        <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.set.constructor",
                "construct",
                Array(
                        "BASKET_URL" => "/personal/cart/",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "COMPONENT_TEMPLATE" => ".default",
                        "CONVERT_CURRENCY" => "N",
                        "ELEMENT_ID" => $arResult["ID"],
                        "IBLOCK_ID" => "1",
                        "IBLOCK_TYPE_ID" => "catalog",
                        "PRICE_CODE" => array("BASE"),
                        "PRICE_VAT_INCLUDE" => "Y",
                        "TEMPLATE_THEME" => "blue"
                )
        );?>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div style="text-align: center;"><b>Цитаты</b></div><br>
        <?
        $arFilterQuotes = Array("IBLOCK_ID"=>13, "ID"=>$arResult['PROPERTIES']['QUOTES']['VALUE']);
        $resQuotes = CIBlockElement::GetList(Array(), $arFilterQuotes, false, Array(), array());
        while($obQuotes = $resQuotes->GetNextElement())
        {
            $arFieldsQuotes = $obQuotes->GetFields();
            echo '<div>'.$arFieldsQuotes['DETAIL_TEXT'].'</div><br><br>';
        }
        ?>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <script>
            user_id = "<?=$USER->GetId()?>";
            trade_id = "<?=$arResult['ID']?>";
            trade_name = "<?=$arResult['NAME']?>";
            trade_link = "<?=$arResult['DETAIL_PAGE_URL']?>";
        </script>
        <div style="text-align: center;" id="comments-block"><b>Отзывы</b></div><br>
        <div><b>Оставить отзыв</b></div><br>
        <a href="javascript:void (0);" class="open-comment-form">Оставить отзыв</a>
        <?
        $arSelectComments = array('ID','NAME','PROPERTY_PICTURES','PROPERTY_ADVANTAGE','PROPERTY_DISADVANTAGE','PROPERTY_OPINION','PROPERTY_RATING','PROPERTY_USER_ID');
        $arFilterComments = Array("IBLOCK_ID"=>15, "ID"=>$arResult['PROPERTIES']['COMMENTS']['VALUE']);
        $resComments = CIBlockElement::GetList(Array(), $arFilterComments, false, Array(), $arSelectComments);
        while($obComments = $resComments->GetNextElement())
        {
            $arFieldsComments = $obComments->GetFields();
            $commentsRating = intval(($arFieldsComments['PROPERTY_RATING_VALUE']/5)*100);
            $commentsRating.= '%';
        ?>
            <div class="bxr-element-rating">
                <div class="bxr-stars-container">
                    <div class="bxr-stars-bg"></div>
                    <div class="bxr-stars-progres" style="width: <?=$commentsRating?>;"></div>
                </div>
            </div><br><br>
            <div>Достоинства</div>
            <div><?=$arFieldsComments['PROPERTY_ADVANTAGE_VALUE']?></div><br><br>
            <div>Недостатки</div>
            <div><?=$arFieldsComments['PROPERTY_DISADVANTAGE_VALUE']?></div><br><br>
            <div>Общее впечатление от книги</div>
            <div><?=$arFieldsComments['PROPERTY_OPINION_VALUE']?></div><br><br>
        <?
        }
        ?>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div style="text-align: center;" id="reviews-block"><b>Рецензии</b></div><br>
        <a href="javascript:void (0);" class="open-review-form">Написать рецензию</a>
        <?
        $arSelectReviews = array('ID','NAME','DETAIL_TEXT','PROPERTY_RATING','PROPERTY_USER_ID','PROPERTY_FULL_TEXT','PROPERTY_AUTHOR','PROPERTY_FROM','PROPERTY_PIC');
        $arFilterReviews = Array("IBLOCK_ID"=>26, "ID"=>$arResult['PROPERTIES']['REVIEWS']['VALUE']);
        $resReviews = CIBlockElement::GetList(Array(), $arFilterReviews, false, Array(), $arSelectReviews);
        while($obReviews = $resReviews->GetNextElement())
        {
            $arFieldsReviews = $obReviews->GetFields();
            echo '<div><img src="'.CFile::GetPath($arFieldsReviews['PROPERTY_PIC_VALUE']).'"></div><br>';
            echo '<div>'.$arFieldsReviews['PROPERTY_FROM_VALUE'].'</div><br>';
            echo '<div>'.$arFieldsReviews['PROPERTY_AUTHOR_VALUE'].'</div><br>';
            echo '<div>'.$arFieldsReviews['DETAIL_TEXT'].'</div><br>';
            echo '<div><a href="'.$arFieldsReviews['PROPERTY_FROM'].'"></a></div><br><br>';
        }
        ?>
    </div>
</div>
<div class='clear'></div>
<script>

	$(document).ready(function(){
            $('.photo-card-image-link').fancybox ({
                'transitionIn'      :    'elastic',
                'transitionOut'     :    'elastic',
                'speedIn'           :    600,
                'speedOut'          :    200,
                'overlayShow'       :    false
            });
            $(".open-contain").fancybox({   
                type        : 'ajax',
                autoSize    : true
            });
            $('.photo-index-container').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    prevArrow: '<button type="button" class="slick-prev"></button>',
                    nextArrow: '<button type="button" class="slick-next"></button>',
                    autoplay: true,
                    autoplaySpeed: 6000,
                    speed: 1500,
                    responsive: [
                            {
                                    breakpoint: 1199,
                                    settings: {
                                            slidesToShow: 4,
                                            slidesToScroll: 1
                                    }
                            },
                            {
                                    breakpoint: 991,
                                    settings: {
                                            slidesToShow: 3,
                                            slidesToScroll: 1
                                    }
                            },
                            {
                                    breakpoint: 767,
                                    settings: {
                                            slidesToShow: 2,
                                            slidesToScroll: 1
                                    }
                            },
                            {
                                    breakpoint: 500,
                                    settings: {
                                            slidesToShow: 1,
                                            slidesToScroll: 1
                                    }
                            },
                    ]
                });
	});
</script>