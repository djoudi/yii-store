<?php if ($this->page): ?>
<h1><?php echo CHtml::encode($page->header); ?></h1>
<?php $this->beginWidget('CHtmlPurifier'); ?>
<?php echo $page->body; ?>
<?php $this->endWidget(); ?>
<?php endif; ?>

<!-- Рекомендуемые товары -->
<?php $this->widget('FeaturedProducts'); ?>
<!-- Рекомендуемые товары (The End)-->

<!-- Новинки -->
<?php $this->widget('CreatedProducts'); ?>
<!-- Новинки (The End)-->

<!-- Акционные товары -->
<?php $this->widget('DiscountedProducts'); ?>
<!-- Акционные товары (The End)-->