<?php if ($this->page): ?>
<h1><?php echo CHtml::encode($page->header); ?></h1>
<?php echo $page->body; ?>
<?php endif; ?>


<?php if ($this->beginCache('featuredProducts', array('duration' => 3600))): ?>
<!-- Рекомендуемые товары -->
<?php $this->widget('FeaturedProducts', array(
		'limit' => Yii::app()->params['featuredProductsLimit'],
	)); ?>
<!-- Рекомендуемые товары (The End)-->
<?php $this->endCache(); endif; ?>


<?php if ($this->beginCache('newProducts', array('duration' => 3600))): ?>
<!-- Новинки -->
<?php $this->widget('NewProducts', array(
		'limit' => Yii::app()->params['newProductsLimit'],
	)); ?>
<!-- Новинки (The End)-->
<?php $this->endCache(); endif; ?>


<?php if ($this->beginCache('discountedProducts', array('duration' => 3600))): ?>
<!-- Акционные товары -->
<?php $this->widget('DiscountedProducts', array(
		'limit' => Yii::app()->params['discountedProductsLimit'],
	)); ?>
<!-- Акционные товары (The End)-->
<?php $this->endCache(); endif; ?>