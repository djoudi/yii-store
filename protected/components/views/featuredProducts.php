<?php if (count($this->products) > 0): ?>
<!-- Список товаров-->
<h1>Рекомендуемые товары</h1>
<ul class="tiny_products">

	<?php foreach ($this->products as $product): ?>
	<!-- Товар-->
	<li class="product">

		<!-- Фото товара -->
		<?php if ($images = $product->images): ?>
		<div class="image">
			<a href="/products/<?php echo $product->url; ?>">
				<?php echo CHtml::image($images[0]->file, $product->name); ?>
			</a>
		</div>
		<?php endif; ?>
		<!-- Фото товара (The End) -->

		<!-- Название товара -->
		<h3>
			<?php echo CHtml::link(CHtml::encode($product->name), $product->getUrl(), array(
				'data-product' => $product->id,
			)); ?>
		</h3>
		<!-- Название товара (The End) -->

		<?php if ($variants = $product->variants): ?>
		<!-- Выбор варианта товара -->
		<form class="variants" action="/cart">
			<table>
				<?php foreach ($variants as $key => $variant): ?>
				<tr class="variant">
					<td>
						<?php echo CHtml::radioButton('variant', ($key == 0), array(
							'id' => 'featured_' . $variant->id,
							'value' => $variant->id,
							'class' => 'variant_radiobutton',
							'style' => (count($variants) < 2) ? 'display:none;' : '',
						)); ?>
					</td>
					<td>
						<?php if ($variant->name): ?>
						<?php echo CHtml::label($variant->name, 'featured_' . $variant->id); ?>
						<?php endif; ?>
					</td>
					<td>
						<?php if ($variant->compare_price > 0): ?>
						<span class="compare_price"><?php echo $variant->compare_price; ?></span>
						<?php endif; ?>
						<span class="price"><?php echo $variant->price; ?> <span class="currency">руб</span></span>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			<input type="submit" class="button" value="в корзину" data-result-text="добавлено"/>
		</form>
		<!-- Выбор варианта товара (The End) -->
		<?php else: ?>
		Нет в наличии
		<?php endif; ?>

	</li>
	<!-- Товар (The End)-->
	<?php endforeach; ?>

</ul>
<?php endif; ?>