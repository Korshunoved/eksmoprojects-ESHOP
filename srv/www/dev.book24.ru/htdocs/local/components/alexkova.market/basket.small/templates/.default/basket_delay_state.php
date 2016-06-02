<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!--<span class="fa fa-shopping-cart"></span>-->
<!--	<i class="fa fa-shopping-cart"></i>-->
        <?$basket_delay_cnt = count($arResult["BASKET_ITEMS"]["CAN_BUY"]) + count($arResult["BASKET_ITEMS"]["DELAY"]);?>
<!--<br /><span class="bxr-format-price"><?=$arResult["FORMAT_SUMM"]?></span>-->
<div  class="itemLink">
    <div class="image">
        <?if ($basket_delay_cnt>0):?>
        <div class="noty"><?=$basket_delay_cnt?></div>
        <?endif?>
        <img src="<?=SITE_TEMPLATE_PATH;?>/images/korzina_icon.svg"  height="30">
    </div>
<!--    <div class="accountLinksShortInfo cart">
        <div class="topTitle">В вашей корзине 2 товара</div>
        <div class="itemsList">
            <div class="item">
                <div class="itemImage">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/4.png">
                </div>
                <div class="descr">
                    <a href="#" class="title">Как открывать мир</a>
                    <div class="smallDescr">Марта Гумилевская</div>
                    <div class="price">800 р.</div>
                </div>
            </div>
            <div class="item">
                <div class="itemImage">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/images/fish/5.png">
                </div>
                <div class="descr">
                    <a href="#" class="title">Моби Дик или Белый кит. В 2-х томах</a>
                    <div class="smallDescr">Марта Гумилевская</div>
                    <div class="price">3 500 р.</div>
                </div>
            </div>
        </div>
        <div class="cartTotal">
            <div class="label">Сумма заказа</div>
            <div class="total">4 300 р.</div>
        </div>
        <div class="cartFooter">
            <div class="freeDeliveryInfo">
                Мы дарим вам бесплатную доставку!
            </div>
            <a href="#" class="greenBtn lg" onclick="closeAccActions()">Перейти в корзину</a>
            <a href="#" class="lightBorderBtn lg" onclick="closeAccActions()">Продолжить покупки</a>
        </div>
    </div>-->
    <div class="activeSearchCover" onclick="closeAccActions()"></div>
</div>
