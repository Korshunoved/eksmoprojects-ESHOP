<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="bxr-region-change-wrap-mobile">
    <div class="bxr-your-region">
        <?=GetMessage("YOUR_REGION")?> <a class="bxr-change-region-mobile" data-id="<?=$arResult["ID"]?>"><?=$arResult["NAME"]?></a>
        <span class="fa fa-angle-down bxr-change-region-mobile"></span>
    </div>
    <div class="clearfix"></div>
    <?if ($arResult["AUTO_DETECT"]) {?>
    <div class="bxr-confirm-region-wrap">
        <a id="correct-region" class="bxr-color" href="<?=$APPLICATION->GetCurPageParam("sr=".$arResult["ID"])?>"><?=GetMessage("CORRECT_REGION")?></a>
        <a id="not-correct-region" class="bxr-change-region-mobile" href="/ajax/region_list.php" data-id="<?=$arResult["ID"]?>"><?=GetMessage("WRONG_REGION")?></a>
        <div class="clearfix"></div>
    </div>
    <?}?>
    <div id="bxr-region-list"></div>
</div>

<script>
$(document).on("click", ".bxr-change-region-mobile", function(e) {
    e.preventDefault();
    $('.bxr-confirm-region-wrap').hide();
    if ($('#bxr-region-list').html().length == 0) {
        var params = { 
            TEMPLATE: 'mobile',
            CURRENT_CITY: '<?=  intval($arResult["ID"])?>',
            CURRENT_REGION: '<?=intval($arResult["CURRENT_REGION"])?>',
            CURRENT_COUNTRY: '<?=intval($arResult["CURRENT_COUNTRY"])?>',
            IBLOCK_ID: '<?=intval($arResult["IBLOCK_ID"])?>',
            BACK_URL: '<?=  htmlspecialchars($APPLICATION->GetCurPage())?>',
        };
        $.ajax({
            url: '/ajax/region_list.php',
            type: "POST",
            data: params,
            success: function(data) {
                $('#bxr-region-list').html(data);
                $('#bxr-region-select-country').find('.bxr-region-select-item.active').trigger('click');
                $('#bxr-region-select-region').find('.bxr-region-select-item.active').trigger('click');
                $('#bxr-region-select-city').find('.bxr-region-select-item.active').trigger('click');
            },
        });   
    } else {
        $('#bxr-region-list').toggle();
    };
    
    if ($('.bxr-region-change-wrap-mobile').find('span.fa').hasClass('fa-angle-down')) {
        $('.bxr-region-change-wrap-mobile').find('span.fa').removeClass('fa-angle-down');
        $('.bxr-region-change-wrap-mobile').find('span.fa').addClass('fa-angle-up');
    } else {
        $('.bxr-region-change-wrap-mobile').find('span.fa').addClass('fa-angle-down');
        $('.bxr-region-change-wrap-mobile').find('span.fa').removeClass('fa-angle-up');
    }
});
</script>