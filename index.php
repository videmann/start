<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Главная");
?><div class="row">
	<div class="col-xs-12">
		 <?$APPLICATION->IncludeComponent(
	"bberry:boxberry.widget",
	"info_widget",
	Array(
		"COMPONENT_TEMPLATE" => "info_widget"
	)
);?>
	</div>
</div><?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>