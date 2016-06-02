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

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
<?
//echo '<pre>';
//print_r($arItem);
//echo '</pre>';
?>
    <div class="reviewItem" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="RIHead">
            <div class="userBlock">
                <div class="image"><img src='<?=SITE_TEMPLATE_PATH;?>/images/fish/userImage.jpg'> </div>
                <a href="#" class="name"><?=$arItem['PROPERTIES']['NAME']['VALUE']?></a>
            </div>
            <div class="date"><?=getRusDate($arItem['TIMESTAMP_X'],'.',false)?></div>
        </div>
        <div class="RIContent">
            <div class="rateStarCover">
                <div class="rateStarInc">
                    <?for ($i=0;$i<$arItem['PROPERTIES']['RATING']['VALUE'];$i++){?>
                        <div class="rateStar dark"></div>
                    <?}?>
                    <?for ($i=0;$i<(5-$arItem['PROPERTIES']['RATING']['VALUE']);$i++){?>
                        <div class="rateStar"></div>
                    <?}?>
                    <div class="rateChars"><?=$arItem['PROPERTIES']['RATING']['VALUE']?></div>
                </div>
            </div>
            <div class="textBlock">
                <p><strong>Достоинства</strong></p>
                <p><?=$arItem['PROPERTIES']['ADVANTAGE']['VALUE']?></p>
            </div>
            <div class="textBlock">
                <p><strong>Недостатки</strong></p>
                <p><?=$arItem['PROPERTIES']['DISADVANTAGE']['VALUE']?></p>
            </div>
            <div class="textBlock">
                <p><strong>Общее впечатление от книги</strong></p>
                <p><?=$arItem['PROPERTIES']['OPINION']['VALUE']?>
                    <br>
                    <a href="#" class="dottedLink readMore">Подробнее</a>
                </p>
                <?if (!empty($arItem['PROPERTIES']['PICTURES']['VALUE'])) {?>
                <div class="BImagesLine">
                    <?foreach ($arItem['PROPERTIES']['PICTURES']['VALUE'] as $key => $value) {?>
                        <div class="imageItem" onclick="bookPreview('show',0)">
                            <div class="imageItemInc"><img src="<?=CFile::GetPath($value)?>"></div>
                        </div>
                    <?}?>
                    <div style="clear:both;"></div>
                </div>
                <?}?>
            </div>
        </div>
        <div class="RIFooter">
            <div class="likeBtn">709 366</div>
            <div class="socBlock sm">
                <div class="label">Поделиться</div>
                <a href="#" class="item fb"> </a>
                <a href="#" class="item vk"></a>
                <a href="#" class="item tw"> </a>
            </div>
        </div>
    </div>
    <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.socnets.buttons",
            "",
            Array(
                    "DESCRIPTION" => "Интересный отзыв о книге ".$arItem['NAME'],
                    "FB_USE" => "Y",
                    "GP_USE" => "Y",
                    "IMAGE" => $arItem['PROPERTIES']['PICTURES'][0],
                    "TITLE" => $arItem['NAME'],
                    "TW_HASHTAGS" => "",
                    "TW_RELATED" => "",
                    "TW_USE" => "Y",
                    "TW_VIA" => "",
                    "URL_TO_LIKE" => $APPLICATION->GetCurPage(true),
                    "VK_USE" => "Y"
            )
    );?>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

<div class="loadMoreBtn">Показать еще 15 отзывов</div>
