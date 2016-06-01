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
?>
<?
//echo "<pre>";print_r($arResult);echo "</pre>";
?>
<?
/*$rsLocationsList = CSaleLocation::GetList(
        array(),
        array("CITY_NAME" => $arRegionData['NAME']),
        false,
        false,
        array("ID", "CITY_ID",'CITY_NAME')
);
$arCity = $rsLocationsList->GetNext();
echo '<pre>';
print_r($arCity);
echo '</pre>';*/
//$DELIVERY_LOCATION = $arCity['ID'];
$allowDeliveryList = array();
$db_dtype = CSaleDelivery::GetList(array(),array("ACTIVE" => "Y"),false,false,array());
while ($ar_dtype = $db_dtype->Fetch())
{
    $allowDeliveryList[]=array(
                    "ID" => $ar_dtype['ID'],
                    "NAME" => $ar_dtype['NAME'],
                    "PRICE" => $ar_dtype['PRICE'],
    );
}

$db_ptype = CSalePaySystem::GetList(
                    $arOrder = Array("SORT"=>"ASC", "PSA_NAME"=>"ASC"), 
                    Array("ACTIVE"=>"Y")
        );
while ($ptype = $db_ptype->Fetch())
{
    $allowDeliveryList[]=array(
                    "ID" => $ptype['ID'],
                    "NAME" => $ptype['NAME'],
                    "PRICE" => $ptype['PRICE'],
    );
}

$deliveryIds = \Bitrix\Sale\Internals\DeliveryPaySystemTable::getLinks(
    4,\Bitrix\Sale\Internals\DeliveryPaySystemTable::ENTITY_TYPE_PAYSYSTEM
);
echo '<pre>';
print_r($deliveryIds);
echo '</pre>';
?>
<?if (!empty($arResult["ERRORS"])):?>
    <?ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif;?>

<?if (strlen($arResult["MESSAGE"]) > 0):?>
    <div class="success-message"><?ShowNote($arResult["MESSAGE"])?></div>
    <?return false;?>
<?endif?>
    
<form id="iblockForm<?=$arParams["IBLOCK_ID"]?>" 
      name="iblock_add" 
      action="<?=POST_FORM_ACTION_URI?>" 
      method="post" 
      enctype="multipart/form-data"
    >
    <br>
    
    <input type="hidden" name="FORM_ID" value="<?=$arParams["IBLOCK_ID"]?>"/>
    
    <?if($arParams["TARGET_URL"]):?>
            <input type="hidden" name="TARGET_URL" value="<?=$arParams["TARGET_URL"]?>"/>
    <?endif;?>
            
    <?=bitrix_sessid_post()?>
            
    <?if ($arParams["MAX_FILE_SIZE"] > 0):?>
        <input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" />
    <?endif?>
		
    <?if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"])):?>
        
        <?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
        
            <?if (substr_count($arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"], 'HIDDEN') > 0) {
                $inputType = 'hidden';
            } elseif (substr_count($arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"], 'AREA') > 0) {
                $inputType = 'textarea';
            } else {
                $inputType = 'text';
            }?>
            
            <?if ($inputType != 'hidden') {?>
                <?if (intval($propertyID) > 0):?>
                    <?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?>
                <?else:?>
                    <?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?>
                <?endif?>
                    
                <?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?>
                    <span class="starrequired">*</span>
                <?endif?>
            <?}?>
                    
            <?
                $value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
            ?>

            <?if ($inputType != 'textarea'
                    && $arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]!="PAYMENT_TYPE"
                    && $arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]!="DELIVERY_TYPE") {?>
                <input type="<?=$inputType?>" 
                       name="PROPERTY[<?=$propertyID?>][<?=$i?>]" 
                       size="25" 
                       value="<?=$value?>" 
                       data-code="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]?>"/>
                <?if ($inputType != 'hidden') {?>
                    <br><br>
                <?}?>
            <?} elseif ($arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]=="PAYMENT_TYPE"
                    || $arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]=="DELIVERY_TYPE") {?>
                    <select name="PROPERTY[<?=$propertyID?>]">
                        <option value=""><?echo GetMessage("CT_BIEAF_PROPERTY_VALUE_NA")?></option>
                        <?
                        if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
                        else $sKey = "ELEMENT";

                        foreach ($allowDeliveryList as $arEnum)
                        {
                            $checked = false;
                            if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
                            {
                                foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum)
                                {
                                    if ($arEnum['ID'] == $arElEnum["VALUE"])
                                    {
                                        $checked = true;
                                        break;
                                    }
                                }
                            }
                        ?>
                            <option value="<?=$arEnum['ID']?>" <?=$checked ? " selected=\"selected\"" : ""?>>
                                <?=$arEnum["NAME"]?>
                            </option>
                        <?
                        }
                        ?>
                    </select><br><br>
            <?} else {?>
                <textarea name="PROPERTY[<?=$propertyID?>][<?=$i?>]" 
                          rows="5" 
                          data-code="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["CODE"]?>" 
                          style="resize: none">
                    <?=$value?>
                </textarea>
                <br><br>
            <?}?>
        <?endforeach;?>
    <?endif?>

    <input onclick="Book24.formRefresh(<?=$arParams["IBLOCK_ID"]?>);return false;" 
        <?if($arParams["HIDE_SUBMIT"] == 'Y') echo 'style="display: none;"'?> 
        id="submitForm_<?=$arParams["IBLOCK_ID"]?>" 
        type="submit" 
        name="iblock_submit" 
        value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>" 
        />
    
    <?if (strlen($arParams["LIST_URL"]) > 0):?>
        <input type="submit" name="iblock_apply" value="<?=GetMessage("IBLOCK_FORM_APPLY")?>" />
        <input
                type="button"
                name="iblock_cancel"
                value="<? echo GetMessage('IBLOCK_FORM_CANCEL'); ?>"
                onclick="location.href='<? echo CUtil::JSEscape($arParams["LIST_URL"])?>';"
        >
    <?endif?>
    <br><br>
</form>
        
<script>
    $(function() {
        if (preorder) $('input[data-code="PREORDER_HIDDEN"]').val(preorder);
        $('input[data-code="TRADE_ID_HIDDEN"]').val(trade_id); 
        $('input[data-code="TRADE_NAME_HIDDEN"]').val(trade_name); 
        $('input[data-code="TRADE_LINK_HIDDEN"]').val(trade_link);
        $('input[data-code="PRICE_HIDDEN"]').val(productPrice);
    });
</script>