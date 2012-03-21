<!--Форма отправления комментария-->

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'comment-form',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array(
		'class' => 'comment_form',
	),
)); ?>
	<h2>Написать комментарий</h2>

	<?php echo $form->errorSummary($model); ?>

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
		<label for="comment_captcha">Число</label>
		<div class="captcha">
			<?php $this->widget('CCaptcha', array(
				'showRefreshButton' => false,
				'imageOptions' => array(
					'width' => 91,
					'height' => 43,
				),
			)); ?>
		</div>
		<?php echo $form->textField($model, 'verifyCode', array(
			'id' => 'comment_captcha',
			'class'=> 'input_captcha',
		)); ?>
		<?php endif; ?>
	</div>

<?php $this->endWidget(); ?>