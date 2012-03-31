<!-- Хлебные крошки /-->
<div id="path">
	<?php echo CHtml::link('Главная', Yii::app()->homeUrl); ?>
	<!--{foreach from=$category->path item=cat}
	→ <a href="catalog/{$cat->url}">{$cat->name|escape}</a>
	{/foreach}-->
	→ <?php echo CHtml::link(CHtml::encode($product->brand->name), $product->brand->url); ?>
	→ <?php echo CHtml::encode($product->name); ?>
</div>
<!-- Хлебные крошки #End /-->

<h1 data-product="<?php echo $product->id; ?>"><?php echo CHtml::encode($product->name); ?></h1>

<div class="product">

	<!-- Большое фото -->
	<?php if (count($product->images)): ?>
	<div class="image">
		<a href="<?php echo $product->images[0]->getSrc(800,600); ?>" class="zoom" data-rel="group">
			<?php echo $product->images[0]->getImage(300,300,$product->name); ?>
		</a>
	</div>
	<?php endif; ?>
	<!-- Большое фото (The End)-->

	<!-- Описание товара -->
	<div class="description">

		<?php $this->beginWidget('CHtmlPurifier'); ?>
		<?php echo $product->body; ?>
		<?php $this->endWidget(); ?>

		<?php if (count($product->variants) > 0): ?>
		<!-- Выбор варианта товара -->
		<form class="variants" action="/cart">
			<table>
				<?php foreach ($product->variants as $key => $variant): ?>
				<tr class="variant">
					<td>
						<?php echo CHtml::radioButton('variant', ($key == 0), array(
						'id' => 'product_' . $variant->id,
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

	</div>
	<!-- Описание товара (The End)-->

	<!-- Дополнительные фото продукта -->
	<?php if (count($product->images) > 1): ?>
	<div class="images">
		<?php foreach ($product->images as $key => $image): ?>
		<?php if ($key == 0): continue; endif; ?>
		<a href="<?php echo $image->getSrc(800,600); ?>" class="zoom" data-rel="group">
			<?php echo $image->getImage(95,95,$product->name); ?>
		</a>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	<!-- Дополнительные фото продукта (The End)-->


	<?php if (count($product->features)): ?>
	<!-- Характеристики товара -->
	<h2>Характеристики</h2>
	<ul class="features">
		<?php foreach ($product->features as $feature): ?>
		<li>
			<label><?php echo $feature->features->name; ?></label>
			<span><?php echo $feature->value; ?></span>
		</li>
		<?php endforeach; ?>
	</ul>
	<!-- Характеристики товара (The End)-->
	<?php endif; ?>

	<!-- Соседние товары /-->
	<div id="back_forward">
		<?php if ($prevProduct): ?>
		←
		<?php echo CHtml::link(CHtml::encode($prevProduct->name), $prevProduct->url); ?>
		<?php endif; ?>

		<?php if ($nextProduct): ?>
		<?php echo CHtml::link(CHtml::encode($nextProduct->name), $nextProduct->url); ?>
		→
		<?php endif; ?>
	</div>

</div>
<!-- Описание товара (The End)-->

<?php if (count($product->related)): ?>
<h2>Так же советуем посмотреть</h2>
<!-- Список каталога товаров-->
<ul class="tiny_products">
	<?php foreach ($product->related as $related): ?>
	<!-- Товар-->
	<li class="product">

		<!-- Фото товара -->
		<?php if (count($related->relateds->images)): ?>
		<div class="image">
			<a href="<?php echo $related->relateds->url; ?>">
				<?php echo $related->relateds->images[0]->getImage(200,200,$related->relateds->name); ?>
			</a>
		</div>
		<?php endif; ?>
		<!-- Фото товара (The End) -->

		<!-- Название товара -->
		<h3>
			<?php echo CHtml::link(CHtml::encode($product->name), $product->url, array(
				'data-product' => $related->relateds->id,
			)); ?>
		</h3>
		<!-- Название товара (The End) -->

		<?php if (count($related->relateds->variants)): ?>
		<!-- Выбор варианта товара -->
		<form class="variants" action="/cart">
			<table>
				<?php foreach ($related->relateds->variants as $variant): ?>
				<tr class="variant">
					<td>
						<?php echo CHtml::radioButton('variant', ($key == 0), array(
						'id' => 'product_' . $variant->id,
						'value' => $variant->id,
						'class' => 'variant_radiobutton',
						'style' => (count($related->relateds->variants) < 2) ? 'display:none;' : '',
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

<!-- Комментарии -->
<div id="comments">

	<h2>Комментарии</h2>
	<?php if (count($product->comments)): ?>
	<?php $this->renderPartial('/comments/_view', array(
		'model' => $product,
		'comments' => $product->comments,
	)); ?>
	<?php else: ?>
	<p>Пока нет комментариев</p>
	<?php endif; ?>

	<?php if(Yii::app()->user->hasFlash('commentSubmitted')): ?>
	<div class="success">
		Комментарий добавлен
	</div>
	<?php else: ?>
	<?php $this->renderPartial('/comments/_form',array(
		'model'=>$comment,
	)); ?>
	<?php endif; ?>

</div>
<!-- Комментарии (The End) -->

<script>
	$(function() {
		// Раскраска строк характеристик
		$(".features li:even").addClass('even');

		// Зум картинок
		$("a.zoom").fancybox({ 'hideOnContentClick' : true });
	});
</script>