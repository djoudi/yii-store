<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language; ?>">
<head>
	<meta charset="utf-8">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link href="/css/reset.css" rel="stylesheet">
	<link href="/css/style.css" rel="stylesheet">

	<script src="/js/jquery/jquery.js"></script>

	<script src="/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link href="/js/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet">

	<script src="/js/ctrlnavigate.js"></script>

	<script src="/js/jquery-ui.min.js"></script>
	<script src="/js/ajax_cart.js"></script>

	<script src="/js/baloon/js/baloon.js"></script>
	<link   href="/js/baloon/css/baloon.css" rel="stylesheet" type="text/css" />

	<script src="/js/autocomplete/jquery.autocomplete-min.js"></script>
	<style>
		.autocomplete-w1 { position:absolute; top:0px; left:0px; margin:6px 0 0 6px; /* IE6 fix: */ _background:none; _margin:1px 0 0 0; }
		.autocomplete { border:1px solid #999; background:#FFF; cursor:default; text-align:left; overflow-x:auto;  overflow-y: auto; margin:-6px 6px 6px -6px; /* IE6 specific: */ _height:350px;  _margin:0; _overflow-x:hidden; }
		.autocomplete .selected { background:#F0F0F0; }
		.autocomplete div { padding:2px 5px; white-space:nowrap; }
		.autocomplete strong { font-weight:normal; color:#3399FF; }
	</style>
	<script>
		$(function() {
			//  Автозаполнитель поиска
			$(".input_search").autocomplete({
				serviceUrl:'ajax/search_products.php',
				minChars:1,
				noCache: false,
				onSelect:
					function(value, data){
						$(".input_search").closest('form').submit();
					},
				fnFormatResult:
					function(value, data, currentValue){
						var reEscape = new RegExp('(\\' + ['/', '.', '*', '+', '?', '|', '(', ')', '[', ']', '{', '}', '\\'].join('|\\') + ')', 'g');
						var pattern = '(' + currentValue.replace(reEscape, '\\$1') + ')';
						return (data.image?"<img align=absmiddle src='"+data.image+"'> ":'') + value.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>');
					}
			});
		});
	</script>
</head>
<body>

<!-- Верхняя строка -->
<div id="top_background">
	<div id="top">

		<!-- Меню -->
		<?php $this->widget('PagesMenu'); ?>
		<!-- Меню (The End) -->

		<!-- Корзина -->
		<div id="cart_informer">
			<!--{* Обновляемая аяксом корзина должна быть в отдельном файле *}
			{include file='cart_informer.tpl'}-->
		</div>
		<!-- Корзина (The End)-->

		<!-- Вход пользователя -->
		<div id="account">
			<?php if (!Yii::app()->user->isGuest): ?>
				<span id="username">
					<?php echo CHtml::link(CHtml::encode(Yii::app()->user->name), 'user'); ?>
					<?php if (Yii::app()->user->discount > 0): ?>
						,ваша скидка – <?php echo Yii::app()->user->discount; ?>%
					<?php endif; ?>
				</span>
			<a id="logout" href="/user/logout">выйти</a>
			<?php else: ?>
			<a id="register" href="/user/register">Регистрация</a>
			<a id="login" href="/user/login">Вход</a>
			<?php endif; ?>
		</div>
		<!-- Вход пользователя (The End)-->

	</div>
</div>
<!-- Верхняя строка (The End)-->

<!-- Шапка -->
<div id="header">
	<div id="logo">
		<a href="/">
			<img src="/images/logo.png" title="<?php echo Yii::app()->name; ?>" alt="<?php echo Yii::app()->name; ?>">
		</a>
	</div>
	<div id="contact">
		(095) <span id="phone">545-54-54</span>
		<div id="address">Москва, шоссе Энтузиастов 45/31, офис 453</div>
	</div>
</div>
<!-- Шапка (The End)-->

<!-- Вся страница -->
<div id="main">

	<!-- Основная часть -->
	<div id="content">
		<?php echo $content; ?>
	</div>
	<!-- Основная часть (The End) -->

	<div id="left">

		<!-- Поиск-->
		<div id="search">
			<form action="products">
				<input class="input_search" type="text" name="keyword" value="" placeholder="Поиск товара">
				<input class="button_search" value="" type="submit">
			</form>
		</div>
		<!-- Поиск (The End)-->

		<!-- Меню каталога -->
		<?php $this->widget('CategoriesMenu'); ?>
		<!-- Меню каталога (The End)-->

		<!-- Все бренды -->
		<?php $this->widget('BrandsMenu'); ?>
		<!-- Все бренды (The End)-->

		<!-- Выбор валюты -->
		<?php $this->widget('CurrenciesMenu'); ?>
		<!-- Выбор валюты (The End) -->

		<!-- Просмотренные товары -->
		<?php $this->widget('BrowsedProducts', array(
			'limit' => Yii::app()->params['browsedProductsLimit'],
		)); ?>
		<!-- Просмотренные товары (The End)-->

		<!-- Меню блога -->
		<?php $this->widget('RecentPosts', array(
			'limit' => Yii::app()->params['recentPostsLimit'],
		)); ?>
		<!-- Меню блога (The End) -->
	</div>

</div>
<!-- Вся страница (The End)-->

<!-- Футер -->
<div id="footer">
	&copy; <?php echo date('Y'); ?> <?php echo Yii::app()->name; ?>.
</div>
<!-- Футер (The End)-->

</body>
</html>