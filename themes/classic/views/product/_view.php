<!-- Товар-->
<li class="product">

	<!-- Фото товара -->
	<?php if ($data->images): ?>
	<div class="image">
		<a href="<?php echo $data->url; ?>">
			<?php echo $data->images[0]->getImage(200,200,$data->name); ?>
		</a>
	</div>
	<?php endif; ?>
	<!-- Фото товара (The End) -->

	<div class="product_info">
		<!-- Название товара -->
		<h3>
			<?php echo CHtml::link(CHtml::encode($data->name), $data->url, array(
				'data-product' => $data->id,
			)); ?>
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
		<form class="variants" action="/cart">
			<table>
				<?php foreach ($data->specifications as $key => $specification): ?>
				<tr class="variant">
					<td>
						<?php echo CHtml::radioButton('variant', ($key == 0), array(
						'id' => 'variant_' . $specification->id,
						'value' => $specification->id,
						'class' => 'variant_radiobutton',
						'style' => (count($data->specifications) < 2) ? 'display:none;' : '',
					)); ?>
					</td>
					<td>
						<?php if ($specification->name): ?>
						<?php echo CHtml::label($specification->name, 'variant_' . $specification->id, array(
							'class' => 'variant_name',
						)); ?>
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