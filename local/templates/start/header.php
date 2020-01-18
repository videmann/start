<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

	use \Bitrix\Main\Page\Asset;
	CJSCore::Init(array("jquery"));
	Asset::getInstance()->addCss('/bitrix/css/main/bootstrap.min.css');
	\Bitrix\Main\UI\Extension::load("ui.vue");
?>
<!DOCTYPE html>
<html>
	<head>
		<?$APPLICATION->ShowHead();?>
		<title><?$APPLICATION->ShowTitle();?></title>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" /> 	
	</head>
	<body>
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>
		<header>
			<nav class="navbar navbar-default">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<ul class="nav navbar-nav navbar-left">
								<li>
									<a class="navbar-brand" href="/">Старт</a>
								</li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li>
									<a href="/import/">Импорт точек доставки</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</nav>
		</header>
		<div class="container">