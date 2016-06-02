<?php

namespace Alexkova\Market;

class Basket {

    static public function addToBasket($pid, $quantity = 1, $delayed = false, $props = array()) {
        $arProductProps = array();
        $quantity = $quantity > 0 ? $quantity : 1;
        $addData = array();
        if ($delayed) {
            $addData["DELAY"] = "Y";
        }
        
        $decodeProps = urldecode($props);
        $propsArray = explode('||', $decodeProps);
        $arPropsPair = array(); 
        foreach ($propsArray as $pair)
        {
            $arPair = explode('|',$pair);
            $arPropsPair[$arPair[0]] = $arPair[1];
        }
        foreach ($arPropsPair as $key => $value) 
        {
            if (substr_count($key, 'PROP_NAME_') == 0)
                $arProductProps[] = array('NAME' => $arPropsPair['PROP_NAME_'.$key],'CODE' => $key,'VALUE' => $value);
        }
        
        if (
                \CModule::IncludeModule('iblock') && \CModule::IncludeModule('sale') && \CModule::IncludeModule('catalog')
        )
            return Add2BasketByProductID($pid, $quantity, $addData, $arProductProps);
        else
            return false;
    }

    static function getPorductInfoByProductId($pid) {
        if (!\CModule::IncludeModule('iblock') || !\CModule::IncludeModule('sale') || !\CModule::IncludeModule('catalog') || intval($pid) <= 0)
            return false;
        
        $result = array();
        
        $isSKU = \CCatalogSKU::GetProductInfo($pid);

        $res = \CIBlockElement::GetByID($pid);
        if($ar_res = $res->GetNext())
            $result = $ar_res;

        if (is_array($isSKU)) {
            $result["PARENT_ID"] = $isSKU["ID"];
            $res = \CIBlockElement::GetByID($isSKU["ID"]);
            if($ar_res = $res->GetNext())
                $result["DETAIL_PARENT"] = $ar_res;
        }
        
        return $result;
    }

    static function getModalWindow($title, $content, $buttons) {
        // Параметры кнопки
        $arDialogParams = array(
            'title' => $title,
            'content' => $content,
            'width' => 500,
            'height' => 200,
            'buttons' => $buttons,
        );

        // преобразоваqние в объект и замена кавычек
        $strParams = \CUtil::PhpToJsObject($arDialogParams);
        $strParams = str_replace('\'[code]', '', $strParams);
        $strParams = str_replace('[code]\'', '', $strParams);

        // ссылка для открытия окна
        $url = '(new BX.CDialog('.$strParams.')).Show()';
//        $url = str_replace("'", "\'", $url);
        
        return $url;
    }
    
    static public function delayItem($pid) {
        $arNewFields['DELAY'] = "Y";
        \CSaleBasket::Update($pid, $arNewFields);
    }

    static public function toCart($pid) {
        $arNewFields['DELAY'] = "N";
        \CSaleBasket::Update($pid, $arNewFields);
    }

    static public function newQty($pid, $qty) {
        if ($qty > 0) {
            $arNewFields['QUANTITY'] = $qty;
            \CSaleBasket::Update($pid, $arNewFields);
        }
    }
    
    static public function favorItem($pid = false) {
        global $USER, $APPLICATION, $USER_FIELD_MANAGER;
        
        // get current user favor
        if ($USER->IsAuthorized()) {
            $arUserFields = $USER_FIELD_MANAGER->GetUserFields("USER");
            $ufId = $arUserFields["UF_USER_FAVORITES"]["ID"];
            if (!array_key_exists("UF_USER_FAVORITES", $arUserFields)) {
                $ufId = self::createUserFieldFavor();
            }
            if (intval($ufId) > 0) {
                $arFilter = array("ID" => $USER->GetID());
                $arParams["SELECT"] = array("UF_USER_FAVORITES");
                $arRes = \CUser::GetList($by,$desc,$arFilter,$arParams);
                if ($res = $arRes->Fetch()) {
                    $currentFavor = $res["UF_USER_FAVORITES"];
                }
            }
        } else {
            $currentFavor = $_SESSION["USER_FAVORITES"];
            if (!$currentFavor)
                $currentFavor = $APPLICATION->get_cookie("USER_FAVORITES");   
        }
        
        //construct new user favor
        if (intval($pid) > 0) {
            if (substr_count($currentFavor, '#'.$pid.'#') > 0) {
                $currentFavor = str_replace('#'.$pid.'#', '#', $currentFavor);
            } else {
                $currentFavor = rtrim($currentFavor, "#").'#'.$pid.'#';
            };
            $USER_FIELD_MANAGER->Update('USER', $USER->GetId(), array(
                'UF_USER_FAVORITES'  => $currentFavor
            ));
        }
        
        //set new user favor
        if (intval($pid) > 0) {
            if ($USER->IsAuthorized()) {
                $USER_FIELD_MANAGER->Update('USER', $USER->GetId(), array(
                    'UF_USER_FAVORITES'  => $currentFavor
                ));
            }
            $_SESSION["USER_FAVORITES"] = $currentFavor;
            $APPLICATION->set_cookie("USER_FAVORITES", $currentFavor, time()+3600*24);
        }
        
        return $currentFavor;
    }


    static private function createUserFieldFavor() {
        $oUserTypeEntity    = new \CUserTypeEntity();
        $aUserFields    = array(
            'ENTITY_ID'         => 'USER',
            'FIELD_NAME'        => 'UF_USER_FAVORITES',
            'USER_TYPE_ID'      => 'string',
            'XML_ID'            => 'FAVORITES_FIELD',
            'SORT'              => 500,
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'N',
            'SHOW_IN_LIST'      => '',
            'EDIT_IN_LIST'      => '',
            'IS_SEARCHABLE'     => 'N',
            'SETTINGS'          => array(
                'DEFAULT_VALUE' => '',
                'SIZE'          => '20',
                'ROWS'          => '1',
                'MIN_LENGTH'    => '0',
                'MAX_LENGTH'    => '0',
                'REGEXP'        => '',
            ),
            'EDIT_FORM_LABEL'   => array(
                'ru'    => 'Избранное пользователя',
                'en'    => 'User favorites',
            ),
            'LIST_COLUMN_LABEL' => array(
                'ru'    => 'Избранное пользователя',
                'en'    => 'User favorites',
            ),
            'LIST_FILTER_LABEL' => array(
                'ru'    => 'Избранное пользователя',
                'en'    => 'User favorites',
            ),
            'HELP_MESSAGE'      => array(
                'ru'    => '',
                'en'    => '',
            ),
        );
        $iUserFieldId   = $oUserTypeEntity->Add( $aUserFields );
        
        return $iUserFieldId;
    }

}
