<?php if (count($this->currencies) > 0): ?>
<div id="currencies">
	<h2>Валюта</h2>
	<?php $this->widget('zii.widgets.CMenu', array(
		'items' => $this->currencies,
	)); ?>
</div>
<?php endif; ?>