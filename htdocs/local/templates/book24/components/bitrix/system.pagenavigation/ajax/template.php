<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
            return;
}
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<div class="bx-pagination bx-green">
	<div class="bx-pagination-container row">
		<ul>
                    

<!--если страница не первая, выводятся активные ссылки на Назад и 1-->
<?if ($arResult["NavPageNomer"] > 1):?>
    <?if($arResult["bSavePage"]):?>
        <li class="bx-pag-prev"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><span><?echo GetMessage("round_nav_back")?></span></a></li>
        <li class=""><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><span>1</span></a></li>
    <?else:?>
        <?if ($arResult["NavPageNomer"] > 2):?>
            <li class="bx-pag-prev"><a class="infinity-next-page" data-href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><span><?echo GetMessage("round_nav_back")?></span></a></li>
        <?else:?>
            <li class="bx-pag-prev"><a class="infinity-next-page" data-href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><span><?echo GetMessage("round_nav_back")?></span></a></li>
        <?endif?>
        <li class=""><a class="infinity-next-page" data-href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><span>1</span></a></li>
    <?endif?>
<!--если первая страница, выводится Назад и 1 без ссылок-->
<?else:?>
    <li class="bx-pag-prev"><span><?echo GetMessage("round_nav_back")?></span></li>
    <li class="bx-active"><span>1</span></li>
<?endif?>

<!--выводятся все остальные страницы-->
<?
$arResult["nStartPage"]++;
while($arResult["nStartPage"] <= $arResult["nEndPage"]-1):
?>
    <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
        <li class="bx-active"><span><?=$arResult["nStartPage"]?></span></li>
    <?else:?>
        <li class=""><a class="infinity-next-page" data-href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><span><?=$arResult["nStartPage"]?></span></a></li>
    <?endif?>
    <?$arResult["nStartPage"]++?>
<?endwhile?>

<!--если страница не последняя, выводятся активные ссылки на номер страницы и Вперёд-->
<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
    <?if($arResult["NavPageCount"] > 1):?>
        <li class=""><a class="infinity-next-page" data-href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><span><?=$arResult["NavPageCount"]?></span></a></li>
    <?endif?>
        <li class="bx-pag-next"><a class="infinity-next-page" data-href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><span><?echo GetMessage("round_nav_forward")?></span></a></li>
<!--если последняя страница, выводится номер страницы и Вперёд без ссылок-->
<?else:?>
    <?if($arResult["NavPageCount"] > 1):?>
        <li class="bx-active"><span><?=$arResult["NavPageCount"]?></span></li>
    <?endif?>
        <li class="bx-pag-next"><span><?echo GetMessage("round_nav_forward")?></span></li>
<?endif?>
        
        
        
            </ul>
            <span> Показывать по: </span>
            <a class="infinity-next-page" data-href="<?=$arResult["sUrlPath"]?>?count=3">3 </a>
            <a class="infinity-next-page" data-href="<?=$arResult["sUrlPath"]?>?count=4">4 </a>
            <a class="infinity-next-page" data-href="<?=$arResult["sUrlPath"]?>?count=5">5</a>
        <div style="clear:both"></div>
    </div>
</div>
