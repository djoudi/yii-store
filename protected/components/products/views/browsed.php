<?php if (count($this->products) > 0): ?>
<h2>Вы просматривали:</h2>
<ul id="browsed_products">
	<?php foreach ($this->products as $product): ?>
	<li>
		<a href="<?php echo $product->url; ?>">
			<?php echo CHtml::image('/assets/products/'.$product->images[0]->file, $product->name); ?>
		</a>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>