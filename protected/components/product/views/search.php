<div id="search">
	<form action="/product/search">
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'name' => 'term',
			'model' => $this->model,
			'source' => Yii::app()->createUrl('/product/search'),
			'options' => array(
				'minLength' => 3,
				'showAnim' => 'fold',
			),
			'htmlOptions' => array(
				'class' => 'input_search',
				'placeholder' => 'Поиск товара…',
			),
		)); ?>
		<?php echo CHtml::submitButton('', array(
			'class' => 'button_search',
		)); ?>
	</form>
</div>

<style>
	.ui-menu-item {
		padding: 2px 5px;
		white-space: nowrap;
	}
	.ui-menu-item a {
		padding-left: 25px !important;
		line-height: 29px !important;
		margin-bottom: 2px !important;
	}
	.ui-menu-item img {
		float: left;
	}
</style>

<?php Yii::app()->clientScript->registerScript('autocomplete', "
	jQuery('#term').data('autocomplete')._renderItem = function( ul, item ) {
		return $('<li></li>')
		.data('item.autocomplete', item)
		.append(item.image + '<a href=\"'+item.url+'\" title=\"' + item.label + '\">' + item.label + '</a>')
		.appendTo(ul);
};", CClientScript::POS_READY); ?>