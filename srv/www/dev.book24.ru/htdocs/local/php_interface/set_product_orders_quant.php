<?
function set_product_orders_quant() 
{    
    global $DB;
    \CModule::IncludeModule('iblock');
    \CModule::IncludeModule('sale');
    \CModule::IncludeModule('catalog');

    $today = date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")), time()-86400);

    $arOrderIDs = Array();
    $orders = \CSaleOrder::GetList (Array(), Array ("!CANCELED" => "Y"), false, false, Array ("ID"));
    while ($arOrder = $orders->Fetch())
    {
       $arOrderIDs[] = $arOrder["ID"];
    }
    $arItemIDs = Array();
    $baskets = \CSaleBasket::GetList (Array(), Array ("ORDER_ID" => $arOrderIDs), false, false, Array ("PRODUCT_ID", "QUANTITY"));
    while ($arBasket = $baskets->Fetch())
    {
        if ($arItemIDs[$arBasket["PRODUCT_ID"]])
        {
           $arItemIDs[$arBasket["PRODUCT_ID"]] += $arBasket["QUANTITY"];
        }
        else
        {
           $arItemIDs[$arBasket["PRODUCT_ID"]] = $arBasket["QUANTITY"];
        }
    }
    
    foreach ($arItemIDs as $key => $value) 
    {           
        $productId = $key;
        $prodOrderQ = $value;
        
        CIBlockElement::SetPropertyValueCode($productId, 'ORDERS_QUANT', $prodOrderQ);
    }
    
    return 'set_product_orders_quant();';
}