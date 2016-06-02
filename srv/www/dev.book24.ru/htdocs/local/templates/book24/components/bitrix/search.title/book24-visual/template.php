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

$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
<div id="<?echo $CONTAINER_ID?>" class="bx-searchtitle">
	<form action="<?echo $arResult["FORM_ACTION"]?>">
		<div class="bx-input-group">
			<input id="<?echo $INPUT_ID?>" type="text" name="q" value="<?=htmlspecialcharsbx($_REQUEST["q"])?>" autocomplete="off" class="bx-form-control"/>
		</div>
	</form>
    
        <div class="cityHintExamples">
            <a href="<?=$APPLICATION->GetCurPageParam("sr=364")?>" class="itemHint">Москва</a>
            <a href="<?=$APPLICATION->GetCurPageParam("sr=602")?>" class="itemHint">Санкт-Петербург</a>
            <a href="<?=$APPLICATION->GetCurPageParam("sr=365")?>" class="itemHint">Уфа</a>
            <a href="<?=$APPLICATION->GetCurPageParam("sr=376")?>" class="itemHint">Нижний Новгород</a>
            <a href="<?=$APPLICATION->GetCurPageParam("sr=359")?>" class="itemHint">Челябинск</a>
            <a href="<?=$APPLICATION->GetCurPageParam("sr=591")?>" class="itemHint">Тюмень</a>
        </div>
</div>
<?endif?>
<script>
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>

