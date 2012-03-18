<?php if (count($this->categories) > 0): ?>
<div id="catalog_menu">
	<?php $this->widget('zii.widgets.CMenu', array(
		'items' => $this->categories,
	)); ?>
</div>
<?php endif; ?>