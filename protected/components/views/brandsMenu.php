<?php if (count($this->brands) > 0): ?>
<div id="all_brands">
	<h2>Все бренды:</h2>
	<?php foreach ($this->brands as $brand): ?>
	<a href="<?php echo $brand->link; ?>"><?php echo CHtml::encode($brand->name); ?></a>
	<?php endforeach; ?>
</div>
<?php endif; ?>