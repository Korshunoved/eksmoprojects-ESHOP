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
<div class="BBannerSlider">
    <div class="MPSlideCover">
        <ul>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
            <li class="slideItem" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" class="linkBanner">
                    <div class="topSmallTitle"><?=$arItem['NAME']?></div>
                    <div class="largeText"><?=$arItem['PREVIEW_TEXT']?></div>
                    <div class="image">
                        <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" 
                         alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" 
                         title="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>">
                    </div>
                </a>
            </li>
<?endforeach;?>
        </ul>
    </div>

    <div class="leftArrow "></div>
    <div class="rightArrow "></div>
    <div class="navLine ">

    </div>
</div>
