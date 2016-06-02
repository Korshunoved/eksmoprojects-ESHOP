<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (empty($arResult["CATEGORIES"]))
	return;
?>
<div class="bx_searche citySearchDropDown">
    <div class="cityList">
        <?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
                <?foreach($arCategory["ITEMS"] as $i => $arItem):?>
                        <?if($category_id === "all" || $arItem['NAME'] == 'остальные'):?>
                        <?elseif(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):?>
                                <?$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];?>
                                <a href="<?=$APPLICATION->GetCurPageParam("sr=".$arItem["ITEM_ID"])?>" class="cityItem">г. <?echo $arItem["NAME"]?></a>
                        <?else:?>
                                <a href="<?=$APPLICATION->GetCurPageParam("sr=".$arItem["ITEM_ID"])?>" class="cityItem">г. <?echo $arItem["NAME"]?></a>
                        <?endif;?>
                <?endforeach;?>
        <?endforeach;?>
    </div>
</div>