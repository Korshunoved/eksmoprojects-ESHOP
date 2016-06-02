<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<li class="sliderCoverSmall">
        <div class="whiteSectionItem" id="<? echo $strMainID; ?>">

            <div class="specialLabel">
<!--                <div class="yellow"></div>-->

                <?if (('Y' == $arParams['SHOW_DISCOUNT_PERCENT']) && (0 < $minPrice['DISCOUNT_DIFF_PERCENT'])):?>
                    <div class="red"></div>
                <?endif;?>
                    
                <?if ($arItem['PROPERTIES']['AUTOGRAPH']['VALUE_XML_ID']=='Y'):?>
                    <div class="purple"></div>
                <?endif;?>
            </div>

            <div class="image">
                <img id="<? echo $arItemIDs['PICT']; ?>"
                     src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" 
                     title="<? echo $imgTitle; ?>"
                     alt="<? echo $imgTitle; ?>">
            </div>

            <div class="title bx_catalog_item_title" title="<? echo $productTitle; ?>">
                <? echo $productTitle; ?>
            </div>

            <div class="sectionFooter">
                <?if (('Y' == $arParams['SHOW_DISCOUNT_PERCENT']) && (0 < $minPrice['DISCOUNT_DIFF_PERCENT'])):?>
                    <div id="<? echo $arItemIDs['DSC_PERC']; ?>" class="discount"><? echo $minPrice['DISCOUNT_DIFF_PERCENT']; ?>% скидка</div>
                <?endif;?>

                <?if (!empty($minPrice)){?>
                    <div class="bx_catalog_item_price">
                        <div id="<? echo $arItemIDs['PRICE']; ?>" class="price bx_price">
                            <?if ('Y' == $arParams['SHOW_OLD_PRICE'] && $minPrice['DISCOUNT_VALUE'] < $minPrice['VALUE']):?>
                                <span class="oldPrice"><? echo $minPrice['PRINT_VALUE']; ?></span>
                            <?endif;?>

                            <?echo $minPrice['PRINT_DISCOUNT_VALUE'];?>
                            <?unset($minPrice);?>
                        </div>
                    </div>
                <?}?>

                <div class="bx_catalog_item_controls">
                    <?if ($arItem['CAN_BUY']){?>
                        <div id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>" class="bx_catalog_item_controls_blocktwo">
                            <a id="<? echo $arItemIDs['BUY_LINK']; ?>" class="bx_bt_button bx_medium lightBorderBtn" href="javascript:void(0)" rel="nofollow">
                                Купить
                            </a>
                        </div>
                    <?}elseif($arItem['PROPERTIES']['PREDZAKAZ']['VALUE_XML_ID']=='Y'){?>
                        <a href="#" class="lightBorderBtn yellow">Предзаказ</a>
                    <?}?>
                </div>
            </div>
<?
$emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
$arJSParams = array(
        'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
        'SHOW_QUANTITY' => ($arParams['USE_PRODUCT_QUANTITY'] == 'Y'),
        'SHOW_ADD_BASKET_BTN' => false,
        'SHOW_BUY_BTN' => true,
        'SHOW_ABSENT' => true,
        'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
        'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
        'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
        'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
        'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
        'PRODUCT' => array(
                'ID' => $arItem['ID'],
                'NAME' => $productTitle,
                'PICT' => ('Y' == $arItem['SECOND_PICT'] ? $arItem['PREVIEW_PICTURE_SECOND'] : $arItem['PREVIEW_PICTURE']),
                'CAN_BUY' => $arItem["CAN_BUY"],
                'SUBSCRIPTION' => ('Y' == $arItem['CATALOG_SUBSCRIPTION']),
                'CHECK_QUANTITY' => $arItem['CHECK_QUANTITY'],
                'MAX_QUANTITY' => $arItem['CATALOG_QUANTITY'],
                'STEP_QUANTITY' => $arItem['CATALOG_MEASURE_RATIO'],
                'QUANTITY_FLOAT' => is_double($arItem['CATALOG_MEASURE_RATIO']),
                'SUBSCRIBE_URL' => $arItem['~SUBSCRIBE_URL'],
                'BASIS_PRICE' => $arItem['MIN_BASIS_PRICE']
        ),
        'BASKET' => array(
                'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
                'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
                'EMPTY_PROPS' => $emptyProductProperties,
                'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
                'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
        ),
        'VISUAL' => array(
                'ID' => $arItemIDs['ID'],
                'PICT_ID' => $arItemIDs['PICT'],
                'QUANTITY_ID' => $arItemIDs['QUANTITY'],
                'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
                'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
                'PRICE_ID' => $arItemIDs['PRICE'],
                'BUY_ID' => $arItemIDs['BUY_LINK'],
                'BASKET_PROP_DIV' => $arItemIDs['BASKET_PROP_DIV'],
                'BASKET_ACTIONS_ID' => $arItemIDs['BASKET_ACTIONS'],
                'NOT_AVAILABLE_MESS' => $arItemIDs['NOT_AVAILABLE_MESS'],
                'COMPARE_LINK_ID' => $arItemIDs['COMPARE_LINK']
        ),
        'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
);
unset($emptyProductProperties);
?>
<script type="text/javascript">
    var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
</script>

        </div>
</li>
