<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<script>
	window.SlickSliderTop = {
            init: function(){

                $('.v-slick-conteiner').slick({
                    slidesToShow: 1,
                    dots: true,
                    prevArrow: '<button type="button" class="slick-prev"></button>',
                    nextArrow: '<button type="button" class="slick-next"></button>',
                    <?
                        $fade = "false";
                        if($arParams['SLIDER_FADE']=="Y")
                            $fade = "true";
                    ?>
                    fade: <?=$fade;?>,
                    <? 
                        $speed = 1500;
                        if(isset($arParams['SLIDER_SPEED']) && is_numeric($arParams['SLIDER_SPEED']))
                            $speed = $arParams['SLIDER_SPEED'];
                    ?>
                    speed: <?=$speed;?>,
                    <? 
                        $autoplaySpeed = 3000;
                        if(isset($arParams['SLIDER_AUTOPLAY_SPEED']) && is_numeric($arParams['SLIDER_AUTOPLAY_SPEED']))
                            $autoplaySpeed = $arParams['SLIDER_AUTOPLAY_SPEED'];
                    ?>
                    autoplaySpeed: <?=$autoplaySpeed;?>,
                    <?
                       $autoplay = "false";
                       if($arParams['SLIDER_AUTOPLAY']=="Y")
                            $autoplay = "true";
                    ?>
                    autoplay: <?=$autoplay?>,

                });

                $('.v-slick-conteiner').css("visibility", "visible");
            }
	}

	$(document).ready(function(){
            SlickSliderTop.init();
	});
</script>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/slick/slick.js');?>
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/js/slick/slick.css');?>

