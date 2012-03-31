<?php $this->pageTitle = Yii::app()->name . ' – ' . $model->meta_title; ?>

<!-- Заголовок /-->
<h1 data-post="<?php echo $model->id; ?>"><?php echo CHtml::encode($model->name); ?></h1>
<p><?php echo date(Yii::app()->params['dateFormat'], $model->create_time); ?></p>

<!-- Тело поста /-->
<?php $this->beginWidget('CHtmlPurifier'); ?>
<?php echo $model->text; ?>
<?php $this->endWidget(); ?>

<!-- Соседние записи /-->
<div id="back_forward">
	<?php if ($prevPost): ?>
	←
	<?php echo CHtml::link(CHtml::encode($prevPost->name), $prevPost->getUrl(), array(
		'class' => 'back',
		'id' => 'PrevLink',
	)); ?>
	<?php endif; ?>

	<?php if ($nextPost): ?>
	<?php echo CHtml::link(CHtml::encode($nextPost->name), $nextPost->getUrl(), array(
		'class' => 'forward',
		'id' => 'NextLink',
	)); ?>
	→
	<?php endif; ?>
</div>

<!-- Комментарии -->
<div id="comments">

	<h2>Комментарии</h2>
	<?php if (count($model->comments) >= 1): ?>
	<?php $this->renderPartial('/comments/_view', array(
		'post' => $model,
		'comments' => $model->comments,
	)); ?>
	<?php else: ?>
	<p>Пока нет комментариев</p>
	<?php endif; ?>

	<?php if (Yii::app()->user->hasFlash('commentSubmitted')): ?>
	<div class="success">
		Комментарий добавлен
	</div>
	<?php else: ?>
	<?php $this->renderPartial('/comments/_form', array(
		'model' => $comment,
	)); ?>
	<?php endif; ?>

</div>
<!-- Комментарии (The End) -->