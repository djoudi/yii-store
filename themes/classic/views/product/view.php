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
	<?php if ($product->images): ?>
	<div class="image">
		<a href="<?php echo $product->images[0]->filen; ?>" class="zoom" data-rel="group">
			<img src="<?php echo $product->images[0]->file; ?>" alt="<?php echo CHtml::encode($product->name); ?>" />
		</a>
	</div>
	<?php endif; ?>
	<!-- Большое фото (The End)-->

	<!-- Описание товара -->
	<div class="description">

		<?php $this->beginWidget('CHtmlPurifier'); ?>
		<?php echo $product->body; ?>
		<?php $this->endWidget(); ?>

		<?php if (count($product->specifications) > 0): ?>
		<!-- Выбор варианта товара -->
		<form class="variants" action="/cart">
			<table>
				<?php foreach ($product->specifications as $key => $specification): ?>
				<tr class="variant">
					<td>
						<?php echo CHtml::radioButton('variant', ($key == 0), array(
						'id' => 'product_' . $specification->id,
						'value' => $specification->id,
						'class' => 'variant_radiobutton',
						'style' => (count($data->specifications) < 2) ? 'display:none;' : '',
					)); ?>
					</td>
					<td>
						<?php if ($specification->name): ?>
						<?php echo CHtml::label($specification->name, 'featured_' . $specification->id, array(
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
	<!-- Описание товара (The End)-->

	<!-- Дополнительные фото продукта -->
	<?php if (count($product->images) >1 ): ?>
	<div class="images">
		<?php foreach ($product->images as $image): ?>
		<a href="<?php echo $image->file; ?>" class="zoom" data-rel="group">
			<img src="<?php echo $image->file; ?>" alt="<?php CHtml::encode($product->name); ?>" />
		</a>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	<!-- Дополнительные фото продукта (The End)-->


	<?php if (count($product->options) > 0): ?>
	<!-- Характеристики товара -->
	<h2>Характеристики</h2>
	<ul class="features">
		<?php foreach ($product->options as $option): ?>
		<li>
			<label><?php echo $option->name; ?></label>
			<span><?php echo $option->value; ?></span>
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

{* Связанные товары *}
{if $related_products}
<h2>Так же советуем посмотреть</h2>
<!-- Список каталога товаров-->
<ul class="tiny_products">
	{foreach $related_products as $product}
	<!-- Товар-->
	<li class="product">

		<!-- Фото товара -->
		<?php if (count($product->images) > 0): ?>
		<div class="image">
			<a href="<?php echo $product->url; ?>">
				<?php echo CHtml::image($product->images[0]->file, CHtml::encode($product->name)); ?>
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

		{if $product->specifications|count > 0}
		<!-- Выбор варианта товара -->
		<form class="specifications" action="/cart">
			<table>
				{foreach $product->specifications as $v}
				<tr class="specification">
					<td>
						<input id="related_{$v->id}" name="specification" value="{$v->id}" type="radio" class="specification_radiobutton"  {if $v@first}checked{/if} {if $product->specifications|count<2} style="display:none;"{/if}/>
					</td>
					<td>
						{if $v->name}<label class="specification_name" for="related_{$v->id}">{$v->name}</label>{/if}
					</td>
					<td>
						{if $v->compare_price > 0}<span class="compare_price">{$v->compare_price|convert}</span>{/if}
						<span class="price">{$v->price|convert} <span class="currency">{$currency->sign|escape}</span></span>
					</td>
				</tr>
				{/foreach}
			</table>
			<input type="submit" class="button" value="в корзину" data-result-text="добавлено"/>
		</form>
		<!-- Выбор варианта товара (The End) -->
		{else}
		Нет в наличии
		{/if}


	</li>
	<!-- Товар (The End)-->
	{/foreach}
</ul>
{/if}

<!-- Комментарии -->
<div id="comments">

	<h2>Комментарии</h2>
	<?php if (count($product->comments) >= 1): ?>
	<?php $this->renderPartial('/comments/_view', array(
		'post' => $model,
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