<?php
/**
 * @global $APPLICATION CMain
 */
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

if (!empty($_REQUEST['term'])) {
	$_REQUEST['q'] = $_REQUEST['term'];

	$APPLICATION->IncludeComponent(
		'quetzal:search.page.new',
		'ac',
		array(
			'PRICE_CODE'            => array(
				0 => 'BASE',
			),
			'PAGE_RESULT_COUNT'     => 10,
			'RESTART'               => 'N',
			'NO_WORD_LOGIC'         => 'Y',
			'CHECK_DATES'           => 'N',
			'USE_TITLE_RANK'        => 'N',
			'DEFAULT_SORT'          => 'rank',
			'FILTER_NAME'           => '',
			'arrFILTER'             => array('iblock_catalog'),
			'arrFILTER_iblock_catalog' => array(
				CatalogHelper::IBLOCK_ID
			),
			'CACHE_TYPE'            => 'A',
			'CACHE_TIME'            => '3600',
			'DISPLAY_TOP_PAGER'     => 'N',
			'DISPLAY_BOTTOM_PAGER'  => 'Y',
			'PAGER_TITLE'           => 'Результаты поиска',
			'PAGER_SHOW_ALWAYS'     => 'N',
			'PAGER_TEMPLATE'        => '',
			'USE_LANGUAGE_GUESS'    => 'Y',
			'PAGE_TITLE'            => 'Результаты поиска',
			'LIST_PROPERTY_CODE'    => array(
				0 => '',
				1 => '',
			),
			'USE_SUGGEST'           => 'N',
			'SHOW_RATING'           => '',
			'RATING_TYPE'           => '',
			'SEARCH_STATISTICS'     => false
		),
		false
	);
}
