<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language; ?>">
<head>
	<meta charset="<?php echo Yii::app()->charset; ?>">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reset.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/js/baloon/css/baloon.css" rel="stylesheet">

	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/ctrlnavigate.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/baloon/js/baloon.js"></script>
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
			<?php if (Yii::app()->cart->totalProducts > 0): ?>
			В <a href="/cart/index">корзине</a>
			<?php echo Yii::app()->cart->totalProducts; ?> товаров
			на <?php echo Yii::app()->cart->totalPrice; ?> руб
			<?php else: ?>
			Корзина пуста
			<?php endif; ?>
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
		<a href="<?php echo Yii::app()->homeUrl; ?>">
			<?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/logo.png', Yii::app()->name); ?>
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

	<!-- Левая часть -->
	<div id="left">

		<!-- Поиск-->
		<?php $this->widget('ProductSearch'); ?>
		<!-- Поиск (The End)-->

		<!-- Меню каталога -->
		<?php $this->widget('CategoriesMenu'); ?>
		<!-- Меню каталога (The End)-->

		<!-- Все бренды -->
		<?php $this->widget('BrandsMenu'); ?>
		<!-- Все бренды (The End)-->

		<!-- Выбор валюты -->
		<?php if (count(Yii::app()->money->list)): ?>
		<div id="currencies">
			<h2>Валюта</h2>
			<ul>
				<?php foreach (Yii::app()->money->list as $currency): ?>
				<li <?php if (Yii::app()->money->current->id == $currency->id): ?>class="selected"<?php endif; ?>>
					<?php echo CHtml::link(CHtml::encode($currency->name), $currency->url); ?>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
		<!-- Выбор валюты (The End) -->

		<!-- Просмотренные товары -->
		<?php $this->widget('BrowsedProducts'); ?>
		<!-- Просмотренные товары (The End)-->

		<!-- Меню блога -->
		<?php $this->widget('RecentPosts'); ?>
		<!-- Меню блога (The End) -->

	</div>
	<!-- Левая часть (The End) -->

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