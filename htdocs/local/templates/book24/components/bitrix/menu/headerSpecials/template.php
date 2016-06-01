<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<div class="middleColumn">

    <?
    foreach($arResult as $arItem):
            if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;
    ?>
            <?if($arItem["SELECTED"]):?>
                    <div class="colItem selected"><?=$arItem["TEXT"]?></div>
            <?else:?>
                    <div class="colItem"><?=$arItem["TEXT"]?></div>
            <?endif?>
    <?endforeach?>

</div>
<?endif?>