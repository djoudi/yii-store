<!-- Товар-->
<li class="product">

	<!-- Фото товара -->
	<?php if ($data->images): ?>
	<div class="image">
		<a href="<?php echo $data->url; ?>">
			<?php echo CHtml::image($data->images[0]->file, $data->name); ?>
		</a>
	</div>
	<?php endif; ?>
	<!-- Фото товара (The End) -->

	<div class="product_info">
		<!-- Название товара -->
		<h3 class="<?php if ($data->featured): ?>featured<?php endif; ?>">
			<a data-product="<?php echo $data->id; ?>" href="<?php echo $data->url; ?>"><?php echo CHtml::encode($data->name); ?></a>
		</h3>
		<!-- Название товара (The End) -->

		<!-- Описание товара -->
		<div class="annotation">
			<?php $this->beginWidget('CHtmlPurifier'); ?>
			<?php echo $data->annotation; ?>
			<?php $this->endWidget(); ?>
		</div>
		<!-- Описание товара (The End) -->

		<?php if (count($data->variants) > 0): ?>
		<!-- Выбор варианта товара -->
		<form class="variants" action="/cart">
			<table>
				<?php foreach ($data->variants as $key => $variant): ?>
				<tr class="variant">
					<td>
						<?php echo CHtml::radioButton('variant', ($key == 0), array(
						'id' => 'product_' . $variant->id,
						'value' => $variant->id,
						'class' => 'variant_radiobutton',
						'style' => (count($data->variants) < 2) ? 'display:none;' : '',
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

	</div>

</li>
<!-- Товар (The End)-->