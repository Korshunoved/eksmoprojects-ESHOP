<?php

function pr($value,$die = false,$prefix = "")
{
	global $USER;
	if(in_array($USER->GetID(), array(3,2)))
	{
		echo "<pre>$prefix"; print_r($value); echo "</pre>";
		if($die) die();
	}
	return false;
}

function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',' ');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', '-');
    return str_replace($rus, $lat, $str);
}

function getRusMonth($month)
{
    switch($month)
    {
        case '01': return 'января';break;
        case '02': return 'февраля';break;
        case '03': return 'марта';break;
        case '04': return 'апреля';break;
        case '05': return 'мая';break;
        case '06': return 'июня';break;
        case '07': return 'июля';break;
        case '08': return 'августа';break;
        case '09': return 'сентября';break;
        case '10': return 'октября';break;
        case '11': return 'ноября';break;
        case '12': return 'декабря';break;
    }
}

function getRusDate($date,$divider,$showYear=true)
{
    $arDate = explode($divider, $date);
    $dayDate = ($arDate[0]{0}==0) ? $arDate[0]{1} : $arDate[0];
    $monthName = getRusMonth($arDate[1]);
    $yearDate = $arDate[2];
    
    $newDate = $dayDate.' '.$monthName;
    $newDate.= ($showYear) ? ' '.$yearDate : '';
    return $newDate;
}

function getHtml($image, $width = 200, $height = 200, $addClass = "", $title = "", $alt= "") {
		$returnHTML = "";
		$arImage = array();
		if (is_array($image) && !empty($image)) {
			$arImage = $image;
		} elseif ($imageID = intval($image)) {
			$arImage = \CFile::GetFileArray($imageID);
			$imagePath = $arImage["SRC"];
		} elseif (strlen($image) > 0) {
			$arImageSize = getimagesize($_SERVER["DOCUMENT_ROOT"] . $image);
			$arImage = array(
				"WIDTH" => $arImageSize[0],
				"HEIGHT" => $arImageSize[1],
				"SRC" => $image
			);
		}
		if (strlen($addClass) > 0)
			$addClass = "class='$addClass'";

		if ($arImage["HEIGHT"] > $height || $arImage["WIDTH"] > $width) {
			if ($arImage["WIDTH"] > $arImage["HEIGHT"]) {
				$koef = $height / $arImage["HEIGHT"];
				$new_w = ceil($arImage["WIDTH"] * $koef);
				if ($new_w > $width) {
					$imgSize = "height:100%;width:{$new_w}px;";
					$left = ceil(($new_w - $width) / 2);
					$position = "position:absolute;left: -{$left}px;top:0;";
				} else {
					$koef = $width / $arImage["WIDTH"];
					$new_h = ceil($arImage["HEIGHT"] * $koef);
					$imgSize = "width:100%;height:{$new_h}px;";
					$top = ceil(($new_h - $height) / 2);
					$position = "position:absolute;top: -{$top}px;left:0;";
				}
			} else {

				$koef = $width / $arImage["WIDTH"];
				$new_h = ceil($arImage["HEIGHT"] * $koef);
				if ($new_h > $height) {
					$imgSize = "width:100%;height:{$new_h}px;";
					$top = ceil(($new_h - $height) / 2);
					$position = "position:absolute;top: -{$top}px;left:0;";
				} else {
					$koef = $height / $arImage["HEIGHT"];
					$new_w = ceil($arImage["WIDTH"] * $koef);
					$imgSize = "height:100%;width:{$new_w}px;";
					$left = ceil(($new_w - $width) / 2);
					$position = "position:absolute;left: -{$left}px;top:0;";
				}
			}
		}


		$blockStyle = "
		position:relative;
		overflow:hidden;
		zoom:1;/*for IE*/
		width:{$width}px;
		height:{$height}px;
                margin: 0 auto;
	";


		/**/
		if ($arImage["WIDTH"] < $width && $arImage["HEIGHT"] < $height) {
			$returnImgOnly = true;
		}
		/**/

		if ($returnImgOnly) {
			$position = '';
		}

		$imgStyle = "
		$position
		$imgSize
	";

		if (strlen($arImage["SRC"]) > 0) {
			$img = "<img class='elements-img' src='{$arImage["SRC"]}' style='$imgStyle'";
			if ($title)
				$img .= ' title="' . $title . '" alt="' .$alt. '"';
			$img .= "/>";
			if ($returnImgOnly) {
				$returnHTML = $img;
			} else {
				$returnHTML = "
				<div $addClass style='$blockStyle'>
					$img
				</div>
			";
			}
		}
		return $returnHTML;
	}