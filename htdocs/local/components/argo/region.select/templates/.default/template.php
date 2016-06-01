<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<div class="locationWidget">
    
    <div class="label"><span>Мой город:</span></div>
    <div class="currentCity dottedLink" data-id="<?=$arResult["ID"]?>"><?=$arResult["NAME"]?></div>
    
    <div class="cityDropDown">
        <div class="topTitle">Выберите ваш город</div>
        <div class="rowBlock">
            <?$APPLICATION->IncludeComponent(
                    "bitrix:search.title",
                    "book24-visual",
                    Array(
                            "CATEGORY_0" => array("iblock_directory"),
                            "CATEGORY_0_TITLE" => "Регионы",
                            "CATEGORY_0_iblock_directory" => array("14"),
                            "CHECK_DATES" => "N",
                            "CONTAINER_ID" => "title-search",
                            "CONVERT_CURRENCY" => "N",
                            "INPUT_ID" => "title-search-input",
                            "NUM_CATEGORIES" => "1",
                            "ORDER" => "rank",
                            "PAGE" => "#SITE_DIR#search/index.php",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PRICE_CODE" => array(),
                            "PRICE_VAT_INCLUDE" => "Y",
                            "SHOW_INPUT" => "Y",
                            "SHOW_OTHERS" => "N",
                            "SHOW_PREVIEW" => "N",
                            "TOP_COUNT" => "5",
                            "USE_LANGUAGE_GUESS" => "Y"
                    )
            );?>
        </div>
    </div>
    <div class="activeSearchCover" onclick="closeAccActions()"></div>
    
</div>

<script>
$(document).on("click", ".bxr-change-region", function(e) {
    e.preventDefault();
    $('.bxr-region-confirm').hide();
});
</script>