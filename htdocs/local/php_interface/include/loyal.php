<?php
/****/
AddEventHandler("sale", "OnSaleBeforeStatusOrder", "OnStatusUpdateHandler");

function OnStatusUpdateHandler($ID,$val) 
{
    CModule::IncludeModule('main');
    CModule::IncludeModule('sale');
    
    if ($val && ('F'==$val))
    {
        $arOrder = CSaleOrder::GetByID($ID);
        
        $price = $arOrder['PRICE'];
        $user_id = $arOrder['USER_ID'];
        $strError = '';
        
        $arGroups = CUser::GetUserGroup($user_id);
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/logS.txt', var_export($arGroups, true));
        $loyalUserGroup = 15;
        $loyalKey = 100;
        foreach($arGroups as $key => $value)
        {
            if (($value == 11) || ($value == 12) || ($value == 13) || ($value == 15))
            {
                $loyalUserGroup = $value;
                $loyalKey = $key;
            }
        }
        
        $rsUsers = CUser::GetList(($by="id"), ($order="desc"), array('ID'=>$user_id),array("SELECT"=>array("UF_SUM_ORDERS", "UF_YEAR_START_ORDER", "UF_SUM_TO_NEXT")));
        if($arUser = $rsUsers->Fetch()) 
        {
            $sumOrders = ($arUser['UF_SUM_ORDERS']) ? $arUser['UF_SUM_ORDERS'] : 0;
            //$dataChangeStatus = $arUser['UF_YEAR_START_ORDER'] ? $arUser['UF_YEAR_START_ORDER'] : 0;
            $lastPoints = $arUser['UF_SUM_TO_NEXT'] ? $arUser['UF_SUM_TO_NEXT'] : 0;
            
            $newSumOrders = $price + $sumOrders;
            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/logS.txt', var_export($arUser, true),FILE_APPEND);
            
            $rightUserGroup = 15;
            if ($newSumOrders >= 30000)
            {
                $rightUserGroup = 13;
                $newLastPoints = 0;
            }
            elseif ($newSumOrders >= 15000 && $newSumOrders < 30000)
            {
                $rightUserGroup = 12;
                $newLastPoints = 30000 - $newSumOrders;
            }
            elseif ($newSumOrders >= 5000 && $newSumOrders < 15000)
            {
                $rightUserGroup = 11;
                $newLastPoints = 15000 - $newSumOrders;
            }
            else
            {
                $rightUserGroup = 15;
                $newLastPoints = 5000 - $newSumOrders;
            }
            
            if ($loyalUserGroup!=$rightUserGroup)
            {
                unset($arGroups[$loyalKey]);
                $arGroups[] = $rightUserGroup;
            }           
                        
            $user = new CUser;
            $updateFields = Array(
                "UF_SUM_ORDERS"     => $newSumOrders,
                "UF_SUM_TO_NEXT"    => $newLastPoints,
                "GROUP_ID"          => $arGroups
            );
            $user->Update($user_id, $updateFields);
            $strError .= $user->LAST_ERROR;
            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/logLoyalError.txt', var_export($strError, true),FILE_APPEND);
        }
    }
}
/**/

