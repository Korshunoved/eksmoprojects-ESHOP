<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

$addCatalogIntoChain = false;
foreach (explode('/',$arResult[0]['LINK']) as $key => $value) {
    if ($value=='catalog')
        $addCatalogIntoChain = true;
}

$strReturn .= '<div class="breadCrumps"><div class="contentPart">';
$strReturn .= '<a href="/" title="Главная страница" itemprop="url" class="item">Главная</a>';
$strReturn .= '<span class="BArrow"></span>';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	$nextRef = ($index < $itemSize-2 && $arResult[$index+1]["LINK"] <> ""? ' itemref="bx_breadcrumb_'.($index+1).'"' : '');
	$child = ($index > 0? ' itemprop="child"' : '');
	$arrow = ($index > 0? '<span class="BArrow"></span>' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
            $strReturn .= $arrow;
            $strReturn .= '<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="url" class="item">'.$title.'</a>';
	}
	else
	{
                $strReturn .= $arrow;
                $strReturn .= '<span class="item">'.$title.' </span>';
	}
}

$strReturn .= '</div></div>';

return $strReturn;
            
