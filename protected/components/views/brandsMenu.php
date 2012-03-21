<?php if (count($this->brands) > 0): ?>
<div id="all_brands">
	<h2>Все бренды:</h2>
	<?php foreach ($this->brands as $brand): ?>
	<?php echo CHtml::link(CHtml::encode($brand->name), $brand->url); ?>
	<?php endforeach; ?>
</div>
<?php endif; ?>