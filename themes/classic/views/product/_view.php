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

		<?php if (count($data->specifications) > 0): ?>
		<!-- Выбор варианта товара -->
		<form class="specifications" action="/cart">
			<table>
				<?php foreach ($data->specifications as $key => $specification): ?>
				<tr class="specification">
					<td>
						<?php echo CHtml::radioButton('specification', ($key == 0), array(
						'id' => 'product_' . $specification->id,
						'value' => $specification->id,
						'class' => 'specification_radiobutton',
						'style' => (count($data->specifications) < 2) ? 'display:none;' : '',
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

	</div>

</li>
<!-- Товар (The End)-->