<div class="menuColumns">
    <?
        $APPLICATION->IncludeComponent(
                "bitrix:menu", 
                "headerCatalog", 
                array(
                        "ROOT_MENU_TYPE" => "headerCatalog",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "MAX_LEVEL" => "2",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "headerCatalog",
                        "MENU_THEME" => "site",
                        "COMPONENT_TEMPLATE" => "headerCatalog"
                ),
                false
        );
    ?>
    <?
        $APPLICATION->IncludeComponent(
                "bitrix:menu", 
                "headerSpecials", 
                array(
                        "ROOT_MENU_TYPE" => "headerSpecials",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "MAX_LEVEL" => "2",
                        "USE_EXT" => "N",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "headerSpecials",
                        "MENU_THEME" => "site",
                        "COMPONENT_TEMPLATE" => "headerSpecials"
                ),
                false
        );
    ?>
    <div class="rightColumn">
        <div class="colItem">
            <div class="image"></div>
            <div class="descr">
                <a href="#" class="title">Родительский портал</a>
                <div class="text">Навигатор по детской литературе</div>
            </div>
        </div>
        <div class="colItem">
            <div class="image"></div>
            <div class="descr">
                <a href="#" class="title">Родительский портал</a>
                <div class="text">Навигатор по детской литературе</div>
            </div>
        </div>
        <div class="colItem">
            <div class="image"></div>
            <div class="descr">
                <a href="#" class="title">Родительский портал</a>
                <div class="text">Навигатор по детской литературе</div>
            </div>
        </div>
    </div>
</div>