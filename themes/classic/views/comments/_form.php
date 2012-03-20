<!--Форма отправления комментария-->

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'comment-form',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array(
		'class' => 'comment_form',
	),
)); ?>
	<h2>Написать комментарий</h2>

	<div class="message_error">
	<?php echo $form->errorSummary($model); ?>
	</div>

	<?php echo $form->textArea($model, 'text', array(
		'id' => 'comment_text',
		'class' => 'comment_textarea',
	)); ?>
	<br>

	<div>
		<?php echo $form->labelEx($model, 'name'); ?>
		<?php echo $form->textField($model, 'name', array(
			'id' => 'comment_name',
			'class'=> 'input_name',
		)); ?>

		<?php echo CHtml::submitButton('Отправить', array(
			'class' => 'button',
		)); ?>

		<?php if(CCaptcha::checkRequirements()): ?>
		<?php echo $form->labelEx($model, 'verifyCode'); ?>
		<label for="comment_captcha">Число</label>
		<div class="captcha">
			<?php $this->widget('CCaptcha'); ?>
		</div>
		<?php echo $form->textField($model, 'verifyCode', array(
			'id' => 'comment_captcha',
			'class'=> 'input_captcha',
		)); ?>
		<?php endif; ?>
	</div>

<?php $this->endWidget(); ?>