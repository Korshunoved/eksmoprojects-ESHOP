<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
//echo '<pre>';print_r($arParams);echo '</pre>';
//echo '<pre>';print_r($arResult);echo '</pre>';
?>
<?if (count($arResult)<=0) return;?>
<div class="v-slick-conteiner v-big_button <? if($arParams['SLIDER_NAVIGATION_BUTTONS']=="Y") {echo "hover_button";} ?>" style="position: relative">
<?
$dataNumber = 0;
$dataCalendar = 'Y';
foreach ($arResult["ITEMS"] as $key => $item):?>
                <?
                    $target = "target='_blank'";
                ?>
                
                <div class="container full-width " style="background: url('<?=$item["DETAIL_PICTURE"]["SRC"]?>');"
                    alt="<?=$item["NAME"]?>" title="<?=$item["NAME"]?>"><div class="row">
                    <?
                        $link = "/";
                        if($item["PROPERTIES"]["LINK"]["VALUE"])
                        {
                            $link = $item["PROPERTIES"]["LINK"]["VALUE"];
                    ?> 
                        <a <?=$target;?> href="<?=$link;?>">
                    <?}?>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 hidden-xs hidden-sm sl_<?=$dataNumber?>" data-calendar="<?=$dataCalendar?>" style="height: 358px;width: 940px;margin-left: 10px;">
                                        <?if(isset($item["PREVIEW_PICTURE"]["SRC"])):?>
                                            <img src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>"  alt="<?=$item["NAME"]?>"  data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                                        <?endif;?>
                                    </div>
                                </div>
                            </div>
                    <?if($item["PROPERTIES"]["LINK"]["VALUE"]):?>
                        </a>
                    <?endif;?>
                </div></div>
<?$dataNumber++;$dataCalendar = "Y";?>
<?endforeach;?>
</div>