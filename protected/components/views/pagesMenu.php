<?php if (count($this->pages) > 0): ?>
<!-- Меню -->
<?php $this->widget('zii.widgets.CMenu', array(
	'id' => 'menu',
	'activeCssClass' => 'selected',
	'items' => $this->pages,
)); ?>
<!-- Меню (The End) -->
<?php endif; ?>