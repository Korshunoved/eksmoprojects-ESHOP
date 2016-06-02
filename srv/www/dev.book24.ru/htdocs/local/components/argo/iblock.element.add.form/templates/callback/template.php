<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
$this->setFrameMode(false);
echo 'boo';
?>
<?if (strlen($arResult["MESSAGE"]) > 0){?>
<?} else {?>
    <div class="clickbleArea" onclick="closeForms()"></div>
    <div class="popUpForm">
        <div class="closeBtn" onclick="closeForms()"></div>
        <div class="popUpTitle" onclick="showPopUp('callOrder')">Заказать звонок</div>
        <div class="smallText">Напишите ваш номер и мы вам перезвоним в течение 5 минут</div>
        
        <div class="makeOrderForm">
            <div class="rowBlock">
                
                <form id="iblockForm<?=$arParams["IBLOCK_ID"]?>" class='bxr-form-body' name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
                    <br><input type="hidden" name="FORM_ID" value="<?=$arParams["IBLOCK_ID"]?>"/>
                    <?if($arParams["TARGET_URL"]):?>
                            <input type="hidden" name="TARGET_URL" value="<?=$arParams["TARGET_URL"]?>"/>
                    <?endif;?>
                    <?=bitrix_sessid_post()?>
                    <?if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"])):?>
                            <?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
                                <?
                                    if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
                                    {
                                        $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                    }
                                    elseif ($i == 0)
                                    {
                                        $value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
                                    }
                                    else
                                    {
                                        $value = "";
                                    }
                                ?>
                                <input class="phoneField" type="text" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" size="25" value="<?=$value?>" />
                            <?endforeach;?>
                    <?endif?>
                                
                    <input onclick="BX.ajax.submit(BX('iblockForm' + <?=$arParams["IBLOCK_ID"]?>));showPopUp('thankYou');return false;" 
                           class="greenBtn" id="submitForm_<?=$arParams["IBLOCK_ID"]?>" 
                           type="submit" 
                           name="iblock_submit" 
                           value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>" />
                </form>
                
            </div>
        </div>
    </div>
<?}?>