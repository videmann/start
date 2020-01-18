<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => "Импорт ПВЗ boxberry",
	"DESCRIPTION" => "Компонент для импорта ПВЗ boxberry из json в инфоблок",
	"SORT" => 100,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "w.serxio",
		"SORT" => 200,
		"NAME" => "Компоненты w.serxio",
		"CHILD" => array(
			"ID" => "ws_custom",
			"NAME" => "Настраиваемые",
			"SORT" => 10,
		)
	),
);

?>