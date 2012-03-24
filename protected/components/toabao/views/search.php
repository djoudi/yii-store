<div id="search">
	<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
		'name' => 'taobao',
		'source' => Yii::app()->createUrl('/taobao/search'),
		'options' => array(
			'minLength' => 3,
			'showAnim' => 'fold',
		),
		'htmlOptions' => array(
			'class' => 'input_search',
			'placeholder' => 'Поиск товара по taobao',
		),
	)); ?>
	<?php echo CHtml::submitButton('', array(
		'class' => 'button_search',
	)); ?>
</div>

<style>
	.ui-autocomplete { border:1px solid #999; background:#FFF; cursor:default; text-align:left; overflow-x:auto;  overflow-y: auto; margin:-6px 6px 6px -6px; /* IE6 specific: */ _height:350px;  _margin:0; _overflow-x:hidden; }
	.ui-autocomplete .selected { background:#F0F0F0; }
	.ui-autocomplete li { padding:2px 5px; white-space:nowrap; }
	.ui-autocomplete .H { font-weight:normal; color:#3399FF; }
</style>

<?php Yii::app()->clientScript->registerScript('taobaoAutocomplete', "
jQuery('#taobao').data('autocomplete')._renderItem = function( ul, item ) {
	return $('<li></li>')
	.data('item.autocomplete', item)
	.append('<a><img style=\"width:14px;height:35px;\" align=\"absmiddle\" src=\"'+item.pic_url+'\">' + item.title + '</a>')
	.appendTo(ul);
};", CClientScript::POS_READY); ?>