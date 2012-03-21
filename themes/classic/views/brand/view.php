<?php $this->pageTitle = Yii::app()->name . ' – ' . $model->meta_title; ?>

<!-- Хлебные крошки /-->
<div id="path">
	<a href="/">Главная</a>
	→ <?php echo CHtml::link(CHtml::encode($model->name), $model->url); ?>
</div>
<!-- Хлебные крошки #End /-->

<h1><?php echo CHtml::encode($model->name); ?></h1>

<?php $this->beginWidget('CHtmlPurifier'); ?>
<?php echo $model->description; ?>
<?php $this->endWidget(); ?>

<!-- Список товаров-->
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $products,
	'itemView' => '/product/_view',
	'template' => "<ul class=\"products\">{items}</ul>\n{pager}",
)); ?>
<!-- Список товаров (The End)-->