<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language; ?>">
<head>
	<meta charset="utf-8">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reset.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet">

	<!--<script src="<?php /*echo Yii::app()->theme->baseUrl; */?>/js/jquery/jquery.js"></script>-->

	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet">

	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/ctrlnavigate.js"></script>

	<!--<script src="<?php /*echo Yii::app()->theme->baseUrl; */?>/js/jquery-ui.min.js"></script>-->
	<!--<script src="<?php /*echo Yii::app()->theme->baseUrl; */?>/js/ajax_cart.js"></script>-->

	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/baloon/js/baloon.js"></script>
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/js/baloon/css/baloon.css" rel="stylesheet">
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
			Корзина пуста
		</div>
		<!-- Корзина (The End)-->

		<!-- Вход пользователя -->
		<div id="account">
			<?php if (!Yii::app()->user->isGuest): ?>
			<span id="username">
				<?php echo CHtml::link(CHtml::encode(Yii::app()->user->name), 'user/profile'); ?>
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
			<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png" title="<?php echo Yii::app()->name; ?>" alt="<?php echo Yii::app()->name; ?>">
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
		<?php $this->widget('ProductSearch'); ?>
		<!-- Поиск (The End)-->

		<!-- Поиск-->
		<?php $this->widget('TaobaoSearch'); ?>
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
	&copy; <?php echo date('Y'); ?> <?php echo Yii::app()->name; ?>.<br>
	<?php echo Yii::powered(); ?>
</div>
<!-- Футер (The End)-->

</body>
</html>