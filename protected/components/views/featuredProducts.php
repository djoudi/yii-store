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

		<?php if ($specifications = $product->specifications): ?>
		<!-- Выбор варианта товара -->
		<form class="specifications" action="/cart">
			<table>
				<?php foreach ($specifications as $key => $specification): ?>
				<tr class="specification">
					<td>
						<?php echo CHtml::radioButton('specification', ($key == 0), array(
							'id' => 'featured_' . $specification->id,
							'value' => $specification->id,
							'class' => 'specification_radiobutton',
							'style' => (count($specifications) < 2) ? 'display:none;' : '',
						)); ?>
					</td>
					<td>
						<?php if ($specification->name): ?>
						<?php echo CHtml::label($specification->name, 'featured_' . $specification->id); ?>
						<?php endif; ?>
					</td>
					<td>
						<?php if ($specification->compare_price > 0): ?>
						<span class="compare_price"><?php echo $specification->compare_price; ?></span>
						<?php endif; ?>
						<span class="price"><?php echo $specification->price; ?> <span class="currency">руб</span></span>
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