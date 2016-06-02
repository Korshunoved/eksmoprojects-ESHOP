<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<div class="leftTypeMenu">
    <div class="step_1">
    <?
    $previousLevel = 0;
    $i = 2;
    foreach($arResult as $arItem):?>
        
            <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                    <?=str_repeat("</div>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
            <?endif?>
        
            <?if ($arItem["IS_PARENT"]):?>

                    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                        <div class="menuItem" onclick="changeCatalogStep(<?=$i?>)">
                            <?=$arItem["TEXT"]?> <span class="BArrow"></span>
                        </div>
                        <div class="step_2 item_<?=$i?>">
                            <div class="backBtn" onclick="changeCatalogStep(1,<?=$i?>)"><?=$arItem["TEXT"]?></div>
                    <?else:?>
                        <div class="menuItem" onclick="changeCatalogStep(<?=$i?>)">
                            <?=$arItem["TEXT"]?> <span class="BArrow"></span>
                        </div>
                        <div class="step_2 item_<?=$i?>">
                            <div class="backBtn" onclick="changeCatalogStep(1,<?=$i?>)"><?=$arItem["TEXT"]?></div>
                    <?endif?>

            <?else:?>

                    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                        <div class="menuItem"><?=$arItem["TEXT"]?></div>
                    <?else:?>
                        <div class="menuItem"><?=$arItem["TEXT"]?></div>
                    <?endif?>

            <?endif?>
        <?$i++;?>
                            
        <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
    <?endforeach?>
                            
    <?if ($previousLevel > 1)://close last item tags?>
            <?=str_repeat("</div>", ($previousLevel-1) );?>
    <?endif?>
                            
    </div>
</div>
<?endif?>