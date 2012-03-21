<?php $this->pageTitle = Yii::app()->name . ' - Вход'; ?>

<h1>Вход</h1>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'user-form',
	'enableClientValidation' => true,
	'clientOptions' => array(
		'validateOnSubmit' => true,
	),
	'htmlOptions' => array(
		'class' => 'form login_form',
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->labelEx($model, 'email'); ?>
	<?php echo $form->textField($model, 'email'); ?>

	<?php echo $form->labelEx($model, 'password'); ?>
	<?php echo $form->passwordField($model, 'password'); ?>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model, 'rememberMe'); ?>
		<?php echo $form->label($model, 'rememberMe'); ?>
		<?php echo $form->error($model, 'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Войти'); ?>
	</div>

<?php $this->endWidget(); ?>

