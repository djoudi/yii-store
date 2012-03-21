<div id="search">
	<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
		'name' => 'product',
		'model' => $this->model,
		'source' => Yii::app()->createUrl('/product/search'),
		'options' => array(
			'minLength' => 3,
			'showAnim' => 'fold',
		),
		'htmlOptions' => array(
			'class' => 'input_search',
			'placeholder' => 'Поиск товара',
		),
	)); ?>
	<?php echo CHtml::submitButton('', array(
		'class' => 'button_search',
	)); ?>
</div>

<?php Yii::app()->clientScript->registerScript('autocomplete', "
jQuery('#product').data('autocomplete')._renderItem = function( ul, item ) {
	return $('<li></li>')
	.data('item.autocomplete', item)
	.append('<a href=\"'+item.url+'\">' + item.label + '</a>')
	.appendTo(ul);
};", CClientScript::POS_READY); ?>