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
?>
<div class="itemsSliderSection largeItems">
    <button type="button" value="" class="rightBtn"></button>
    <button type="button" value="" class="leftBtn"></button>
    <div class="contentPart">
        <div class="itemSlider">
            <ul class="itemSliderInc">

<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    
    $sourcePicUrl = CFile::GetPath($arItem['PROPERTIES']['SOURCE_IMAGE']['VALUE']);
    $correctDate = getRusDate($arItem["DISPLAY_ACTIVE_FROM"],'.');
    ?>
        <li class="whiteSectionItem lgItem" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="image">
                <div class="EORecomends">
                    <div class="icon">
                        <img src="<?=$sourcePicUrl?>">
                    </div>
                    Подборка <?=$arItem['PROPERTIES']['SOURCE']['VALUE']?>
                </div>
                <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                     alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                     title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
            </div>
            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="title"><?echo $arItem["NAME"]?></a>
            <div class="sectionFooter">
                <div class="date"><?=$correctDate?></div>
                <div class="views">
                    <?if ($arItem['PROPERTIES']['SHOW_COUNT']['VALUE']):?>
                        <?echo number_format($arItem['PROPERTIES']['SHOW_COUNT']['VALUE'], 0, ',', ' ');?>
                    <?else:?>
                        <?echo '0';?>
                    <?endif;?>
                </div>
                <div class="comments">
                    <?if ($arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']):?>
                        <?echo number_format($arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'], 0, ',', ' ');?>
                    <?else:?>
                        <?echo '0';?>
                    <?endif;?>
                </div>
            </div>
        </li>
        
<?endforeach;?>

            </ul>
        </div>
    </div>
</div>
