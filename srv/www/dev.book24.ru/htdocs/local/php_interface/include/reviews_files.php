<?php
/****/
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "OnAfterIBlockElementUpdateHandler");

function OnAfterIBlockElementUpdateHandler(&$arFields) 
{
    CModule::IncludeModule('iblock');
    
    $reviewsIblockId = 21;
    $prodIblockId= 2;
    $publicStatus = 85;
    $reviewStatusPropId = 154;
    $reviewProdPropCode = "TRADE_ID_HIDDEN";
    $rewiewPicPropCode = "PICTURES";
    $prodPicPropCode = "MORE_PHOTO";
    
    if (($arFields['IBLOCK_ID']==$reviewsIblockId) && ($arFields['PROPERTY_VALUES'][$reviewStatusPropId][0]['VALUE']==$publicStatus))
    {        
        $product_id = 0;
        $arPhotosId = array();
        $more_photo = array();
        
        $arSelectReview = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_".$reviewProdPropCode, "PROPERTY_".$rewiewPicPropCode);
        $arFilterReview = Array("IBLOCK_ID" => $reviewsIblockId, "ID" => $arFields['ID']);
        $resReview = CIBlockElement::GetList(Array(), $arFilterReview, false, false, $arSelectReview);
        if($obReview = $resReview->GetNextElement()) 
        {
            $arPropsReview = $obReview->GetProperties();
            $productId = $arPropsReview[$reviewProdPropCode]['VALUE'];
            $arPhotosIds = $arPropsReview[$rewiewPicPropCode]['VALUE'];
                
            /*create array with product added pics for compare with new*/
            $photosOriginalNames = array();
            
            $productRes = CIBlockElement::GetProperty($prodIblockId, $productId, "sort", "asc", array("CODE" => $prodPicPropCode));
            while ($productOb = $productRes->GetNext())
            {
                $arProductFile = CFile::GetFileArray($productOb['VALUE']);
                $photosOriginalNames[] = $arProductFile['ORIGINAL_NAME'];
            }
            /****/
            $commentsToAdd = array();
            $addNew = true;
            $productComRes = CIBlockElement::GetProperty($prodIblockId, $productId, "sort", "asc", array("CODE" => "COMMENTS"));
            while ($productComOb = $productComRes->GetNext())
            {
                if ($arFields['ID']==$productComOb['VALUE'])
                    $addNew = false;
                $commentsToAdd[]=$productComOb['VALUE'];
            }
            if ($addNew)
            {
                $commentsToAdd[] = $arFields['ID'];
                CIBlockElement::SetPropertyValuesEx($productId, $prodIblockId, array("COMMENTS" => $commentsToAdd));
            }
            /****/
                
            /*compare pic name for add with old pic original name; if didn't add before - add now*/
            foreach ($arPhotosIds as $value) 
            {
                $arFile = CFile::GetFileArray($value);
                $isAdded = false;
                
                foreach ($photosOriginalNames as $name) {
                    if ($arFile['FILE_NAME']==$name) 
                            $isAdded = true;
                }
                
                if (!$isAdded)
                {
                    $arNewPhoto = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].$arFile['SRC']);
                    CIBlockElement::SetPropertyValueCode($productId, $prodPicPropCode, Array("VALUE"=>$arNewPhoto));
                }
            }
            /****/
        }        
    }
}