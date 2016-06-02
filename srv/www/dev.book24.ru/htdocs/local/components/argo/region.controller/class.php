<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

class ArgoRegionController extends CBitrixComponent
{
    private $defaultRegionId;
    
    public function init($iblock) 
    {
        if (intval($this->defaultRegionId) <= 0) {
            $elem = \CIBlockElement::GetList(Array(),
                    Array("IBLOCK_ID" => $iblock, "PROPERTY_DEFAULT_REGION_VALUE" => 'Y'), false, Array("nTopCount" => 1),
                    Array("ID"));
            if ($result = $elem->Fetch())
            {
                $this->defaultRegionId = $result["ID"];
            }
        }
    }
    
    public function getDefaultRegionId() {
        return $this->defaultRegionId;
    }


    public function getGeoIpRegion()
    {
        $ip = $_SERVER["REMOTE_ADDR"];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://ipgeobase.ru:7020/geo?ip=' .$ip);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP Bot');
        $data = curl_exec($ch);
        curl_close($ch);
        $xml = simplexml_load_string($data);
        $arXml = get_object_vars($xml->ip);
        $regionInfo = array(
            'city' => $arXml['city'],
            'region' => $arXml['region'],
            'district' => $arXml['district']
        );
        return $regionInfo;
    }
    
    public function getRegionIdByInfo($regionInfo, $iblock, $accuracy_type) 
    {        
        $filter = array("IBLOCK_ID" => $iblock, "ACTIVE" => 'Y', "PROPERTY_GEOIP_NAME" => $regionInfo);
        $select = array("IBLOCK_ID", "ID", "NAME", "IBLOCK_SECTION_ID", "PROPERTY_GEOIP_NAME");
        $elements = \CIBlockElement::GetList(array(), $filter, false, false, $select);
        while ($elem = $elements->Fetch())
        {
                $arRegionIdByName[$elem["PROPERTY_GEOIP_NAME_VALUE"]] = $elem["ID"];
        }
        
        $elemId = false;
        if ($accuracy_type == 'district')
            $elemId = $arRegionIdByName[$regionInfo['district']];
        if ($accuracy_type == 'region' || ($accuracy_type == 'district' && !$elemId))
            $elemId = $arRegionIdByName[$regionInfo['region']];
        if ($accuracy_type == 'city' || !$elemId)
            $elemId = $arRegionIdByName[$regionInfo['city']];
        
        return $elemId;
    }
    
    public function getRegionInfo($regionId, $iblock, $props)
    {
        if (intval($regionId) <= 0 || intval($iblock) <= 0)
            return array();
        
        $filter = array("IBLOCK_ID" => $iblock, "ID" => $regionId, "ACTIVE" => "Y");
        $select = array("IBLOCK_ID", "ID", "NAME", "IBLOCK_SECTION_ID");
        foreach ($props as $propName) {
            $select[] = 'PROPERTY_'.$propName;
        }
        $elements = \CIBlockElement::GetList(array(), $filter, false, false, $select);
        if ($elem = $elements->Fetch())
        {
            $arRegion = $elem;
            $arRegion["CURRENT_REGION"] = $elem["IBLOCK_SECTION_ID"];
            $nav = \CIBlockSection::GetNavChain(false,$elem['IBLOCK_SECTION_ID']);
            if ($arSectionPath = $nav->GetNext())
               $arRegion["CURRENT_COUNTRY"] = $arSectionPath["ID"];
        }
        
        return $arRegion;
    }

    public static function getRegionByDomain($domain, $iblock) 
    {
        if (strlen($domain) <= 0 || intval($iblock) <= 0)
            return array();
        
        $filter = array("IBLOCK_ID" => $iblock, "PROPERTY_DOMAIN" => $domain);
        $select = array("IBLOCK_ID", "ID", "NAME", "IBLOCK_SECTION_ID");
        $elements = \CIBlockElement::GetList(array(), $filter, false, false, $select);
        if ($elem = $elements->Fetch())
            $regionId = $elem["ID"];
        
        return $regionId;
    }

    public function setCoockieRegionId($regionId)
    {
        global $APPLICATION;
        $APPLICATION->set_cookie("REGION", $regionId, time()+60*60*24*2);
    }
    
    public function getCoockieRegionId()
    {
        global $APPLICATION;
        $regionId = $APPLICATION->get_cookie("REGION");

        return $regionId;
    }
    
    public static function setSessionRegionId($regionId)
    {        
        $_SESSION["REGION"] = $regionId;
    }
    
    public static function getSessionRegionId()
    {        
        $regionId = $_SESSION["REGION"];
        
        return $regionId;
    }
}