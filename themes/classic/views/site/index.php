<?php if ($this->page): ?>
<h1><?php echo CHtml::encode($page->header); ?></h1>
<?php $this->beginWidget('CHtmlPurifier'); ?>
<?php echo $page->body; ?>
<?php $this->endWidget(); ?>
<?php endif; ?>

<!-- Рекомендуемые товары -->
<?php $this->widget('FeaturedProducts', array(
	'limit' => Yii::app()->params['featuredProductsLimit'],
)); ?>
<!-- Рекомендуемые товары (The End)-->

<!-- Новинки -->
<?php $this->widget('CreatedProducts', array(
	'limit' => Yii::app()->params['newProductsLimit'],
)); ?>
<!-- Новинки (The End)-->

<!-- Акционные товары -->
<?php $this->widget('DiscountedProducts', array(
	'limit' => Yii::app()->params['discountedProductsLimit'],
)); ?>
<!-- Акционные товары (The End)-->