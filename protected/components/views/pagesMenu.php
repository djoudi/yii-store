<?php if (count($this->pages) > 0): ?>
<?php $this->widget('zii.widgets.CMenu', array(
	'id' => 'menu',
	'activeCssClass' => 'selected',
	'items' => $this->pages,
)); ?>
<?php endif; ?>