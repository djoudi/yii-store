<?php if (count($this->products) > 0): ?>
<h2>Вы просматривали:</h2>
<ul id="browsed_products">
	<?php foreach ($this->products as $product): ?>
	<li>
		<a href="<?php echo $product->url; ?>">
			<?php echo $product->images[0]->getImage(50,50,$product->name); ?>
		</a>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>