<?php if (count($this->products) > 0): ?>
<!-- Список товаров-->
<h1>Рекомендуемые товары</h1>
<ul class="tiny_products">

	<?php foreach ($this->products as $product): ?>
	<!-- Товар-->
	<li class="product">

		<!-- Фото товара -->
		<?php if (count($product->images) > 0): ?>
		<div class="image">
			<a href="<?php echo $product->url; ?>">
				<?php echo $product->images[0]->getImage(200,200,$product->name); ?>
			</a>
		</div>
		<?php endif; ?>
		<!-- Фото товара (The End) -->

		<!-- Название товара -->
		<h3>
			<?php echo CHtml::link(CHtml::encode($product->name), $product->url, array(
				'data-product' => $product->id,
			)); ?>
		</h3>
		<!-- Название товара (The End) -->

		<?php if (count($product->variants) > 0): ?>
		<!-- Выбор варианта товара -->
		<form class="variants" action="/cart/create">
			<table>
				<?php foreach ($product->variants as $key => $variant): ?>
				<tr class="variant">
					<td>
						<?php echo CHtml::radioButton('variant', ($key == 0), array(
						'id' => 'variant_' . $variant->id,
						'value' => $variant->id,
						'class' => 'variant_radiobutton',
						'style' => (count($product->variants) < 2) ? 'display:none;' : '',
					)); ?>
					</td>
					<td>
						<?php if ($variant->name): ?>
						<?php echo CHtml::label($variant->name, 'featured_' . $variant->id, array(
							'class' => 'variant_name',
						)); ?>
						<?php endif; ?>
					</td>
					<td>
						<?php if ($variant->compare_price > 0): ?>
						<span class="compare_price"><?php echo Yii::app()->money->convert($variant->compare_price); ?></span>
						<?php endif; ?>
						<span class="price">
							<?php echo Yii::app()->money->convert($variant->price); ?>
							<span class="currency"><?php echo Yii::app()->money->current->sign; ?></span>
						</span>
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