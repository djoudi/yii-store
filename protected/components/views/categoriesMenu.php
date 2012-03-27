<?php if (count($this->categories) > 0): ?>
<div id="catalog_menu">
	<?php $this->widget('zii.widgets.CMenu', array(
		'activeCssClass'=>'selected',
		'items' => $this->categories,
	)); ?>
</div>
<?php endif; ?>