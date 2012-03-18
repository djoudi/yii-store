<?php if (count($this->brands) > 0): ?>
<div id="all_brands">
	<h2>Все бренды:</h2>
	<?php foreach ($this->brands as $brand): ?>
	<a href="/brands/<?php $brand->url; ?>"><?php echo CHtml::encode($brand->name); ?></a>
	<?php endforeach; ?>
</div>
<?php endif; ?>