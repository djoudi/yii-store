<?php $this->pageTitle = Yii::app()->name . ' — ' . CHtml::encode($model->name); ?>

<h1><?php echo CHtml::encode($model->name); ?></h1>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'user-form',
	'enableClientValidation' => true,
	'clientOptions' => array(
		'validateOnSubmit' => true,
	),
	'htmlOptions' => array(
		'class' => 'form register_form',
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->labelEx($model, 'name'); ?>
	<?php echo $form->textField($model, 'name'); ?>

	<?php echo $form->labelEx($model, 'email'); ?>
	<?php echo $form->textField($model, 'email'); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Зарегистрироваться', array('class' => 'button')); ?>
	</div>

<?php $this->endWidget(); ?>