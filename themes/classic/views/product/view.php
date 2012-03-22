<!-- Хлебные крошки /-->
<div id="path">
	<a href="./">Главная</a>
	{foreach from=$category->path item=cat}
	→ <a href="catalog/{$cat->url}">{$cat->name|escape}</a>
	{/foreach}
	{if $brand}
	→ <a href="catalog/{$cat->url}/{$brand->url}">{$brand->name|escape}</a>
	{/if}
	→  <?php echo CHtml::encode($model->name); ?>
</div>
<!-- Хлебные крошки #End /-->

<h1 data-product="<?php echo $model->id; ?>"><?php echo CHtml::encode($model->name); ?></h1>

<div class="product">

	<!-- Большое фото -->
	<?php if ($model->images): ?>
	<div class="image">
		<a href="<?php echo $model->images[0]->filename; ?>" class="zoom" data-rel="group">
			<img src="<?php echo $model->images[0]->filename; ?>" alt="<?php echo CHtml::encode($model->name); ?>" />
		</a>
	</div>
	<?php endif; ?>
	<!-- Большое фото (The End)-->

	<!-- Описание товара -->
	<div class="description">

		<?php $this->beginWidget('CHtmlPurifier'); ?>
		<?php echo $model->body; ?>
		<?php $this->endWidget(); ?>

		<?php if (count($model->specifications) > 0): ?>
		<!-- Выбор варианта товара -->
		<form class="specifications" action="/cart">
			<table>
				<?php foreach ($model->specifications as $key => $specification): ?>
				<tr class="specification">
					<td>
						<?php echo CHtml::radioButton('specification', ($key == 0), array(
							'id' => 'product_' . $specification->id,
							'value' => $specification->id,
							'class' => 'specification_radiobutton',
							'style' => (count($model->specifications) < 2) ? 'display:none;' : '',
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
	<!-- Описание товара (The End)-->

	<!-- Дополнительные фото продукта -->
	<?php if (count($model->images) >1 ): ?>
	<div class="images">
		<?php foreach ($model->images as $image): ?>
		<a href="<?php echo $image->filename; ?>" class="zoom" data-rel="group">
			<img src="<?php echo $image->filename; ?>" alt="<?php CHtml::encode($model->name); ?>" />
		</a>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	<!-- Дополнительные фото продукта (The End)-->


	{if $model->features}
	<?php if ($model->features): ?>
	<!-- Характеристики товара -->
	<h2>Характеристики</h2>
	<ul class="features">
		<?php foreach ($model->features as $feature): ?>
		<li>
			<label><?php echo $feature->name; ?></label>
			<span><?php echo $feature->value; ?></span>
		</li>
		<?php endforeach; ?>
	</ul>
	<!-- Характеристики товара (The End)-->
	<?php endif; ?>

	<!-- Соседние товары /-->
	<div id="back_forward">
		{if $prev_product}
		←&nbsp;<a class="prev_page_link" href="products/{$prev_product->url}">{$prev_product->name|escape}</a>
		{/if}
		{if $next_product}
		<a class="next_page_link" href="products/{$next_product->url}">{$next_product->name|escape}</a>&nbsp;→
		{/if}
	</div>

</div>
<!-- Описание товара (The End)-->

{* Связанные товары *}
{if $related_products}
<h2>Так же советуем посмотреть</h2>
<!-- Список каталога товаров-->
<ul class="tiny_products">
	{foreach $related_products as $model}
	<!-- Товар-->
	<li class="product">

		<!-- Фото товара -->
		{if $model->image}
		<div class="image">
			<a href="products/{$model->url}"><img src="{$model->image->filename|resize:200:200}" alt="{$model->name|escape}"/></a>
		</div>
		{/if}
		<!-- Фото товара (The End) -->

		<!-- Название товара -->
		<h3><a data-product="{$model->id}" href="products/{$model->url}">{$model->name|escape}</a></h3>
		<!-- Название товара (The End) -->

		{if $model->specifications|count > 0}
		<!-- Выбор варианта товара -->
		<form class="specifications" action="/cart">
			<table>
				{foreach $model->specifications as $v}
				<tr class="specification">
					<td>
						<input id="related_{$v->id}" name="specification" value="{$v->id}" type="radio" class="specification_radiobutton"  {if $v@first}checked{/if} {if $model->specifications|count<2} style="display:none;"{/if}/>
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

	{if $comments}
	<!-- Список с комментариями -->
	<ul class="comment_list">
		{foreach $comments as $comment}
		<a name="comment_{$comment->id}"></a>
		<li>
			<!-- Имя и дата комментария-->
			<div class="comment_header">
				{$comment->name|escape} <i>{$comment->date|date}, {$comment->date|time}</i>
				{if !$comment->approved}ожидает модерации</b>{/if}
			</div>
			<!-- Имя и дата комментария (The End)-->

			<!-- Комментарий -->
			{$comment->text|escape|nl2br}
			<!-- Комментарий (The End)-->
		</li>
		{/foreach}
	</ul>
	<!-- Список с комментариями (The End)-->
	{else}
	<p>
		Пока нет комментариев
	</p>
	{/if}

	<!--Форма отправления комментария-->
	<form class="comment_form" method="post">
		<h2>Написать комментарий</h2>
		{if $error}
		<div class="message_error">
			{if $error=='captcha'}
			Неверно введена капча
			{elseif $error=='empty_name'}
			Введите имя
			{elseif $error=='empty_comment'}
			Введите комментарий
			{/if}
		</div>
		{/if}
		<textarea class="comment_textarea" id="comment_text" name="text" data-format=".+" data-notice="Введите комментарий">{$comment_text}</textarea><br />
		<div>
			<label for="comment_name">Имя</label>
			<input class="input_name" type="text" id="comment_name" name="name" value="{$comment_name}" data-format=".+" data-notice="Введите имя"/><br />

			<input class="button" type="submit" name="comment" value="Отправить" />

			<label for="comment_captcha">Число</label>
			<div class="captcha"><img src="captcha/image.php?{math equation='rand(10,10000)'}" alt='captcha'/></div>
			<input class="input_captcha" id="comment_captcha" type="text" name="captcha_code" value="" data-format="\d\d\d\d" data-notice="Введите капчу"/>

		</div>
	</form>
	<!--Форма отправления комментария (The End)-->

</div>
<!-- Комментарии (The End) -->

{literal}
<script>
	$(function() {
		// Раскраска строк характеристик
		$(".features li:even").addClass('even');

		// Зум картинок
		$("a.zoom").fancybox({ 'hideOnContentClick' : true });
	});
</script>
{/literal}
