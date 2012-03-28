<h1>
	<?php if (count($purchases)): ?>
	В корзине <?php echo $totalProducts; ?> товаров
	<?php else: ?>
	Корзина пуста
	<?php endif; ?>
</h1>

<?php if (count($purchases)): ?>
<form method="post" name="cart">

	<table id="purchases">

		<?php foreach ($purchases as $purchase): ?>
		<tr>
			<td class="image">
				<?php if (count($purchase['product']->images)): ?>
				<a href="<?php echo $purchase['product']->url; ?>">
					<?php echo $purchase['product']->images[0]->getImage(50,50,$purchase['product']->name); ?>
				</a>
				<?php endif; ?>
			</td>

			<td class="name">
				<a href="<?php echo $purchase['product']->url; ?>"><?php echo CHtml::encode($purchase['product']->name); ?></a>
				<?php echo CHtml::encode($purchase['specification']->name); ?>
			</td>

			<td class="price">
				<?php echo $purchase['specification']->price; ?> руб
			</td>

			<td class="amount">
				<select name="amounts[<?php echo $purchase['specification']->id; ?>]" onchange="document.cart.submit();">
					<?php for ($i=0; $i<$purchase['specification']->stock; $i++): ?>
					<option value="<?php echo $i; ?>" <?php if ($purchase['amount']==$i): ?>selected<?php endif; ?>><?php echo $i; ?> шт</option>
					<?php endfor; ?>
				</select>
			</td>

			<td class="price">
				<?php echo $purchase['specification']->price * $purchase['amount']; ?> руб
			</td>

			<td class="remove">
				<a href="/cart/delete/<?php echo $purchase['specification']->id; ?>">
					<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/delete.png" title="Удалить из корзины" alt="Удалить из корзины">
				</a>
			</td>

		</tr>
		<?php endforeach; ?>
		<?php if (!Yii::app()->user->isGuest && Yii::app()->user->discount > 0): ?>
		<tr>
			<th class="image"></th>
			<th class="name">скидка</th>
			<th class="price"></th>
			<th class="amount"></th>
			<th class="price">
				<?php echo Yii::app()->user->discount; ?>
				%
			</th>
			<th class="remove"></th>
		</tr>
		<?php endif; ?>
		<tr>
			<th class="image"></th>
			<th class="name"></th>
			<th class="price" colspan="4">
				Итого
				<?php echo $totalPrice; ?>
				руб
			</th>
		</tr>
	</table>
</form>
	<?php if (count($deliveries)): ?>
	<h2>Выберите способ доставки:</h2>
	<ul id="deliveries">
		<?php foreach ($deliveries as $key => $delivery): ?>
		<li>
			<div class="checkbox">
				<input type="radio" name="delivery_id" value="{$delivery->id}" {if $delivery@first}checked{/if} id="deliveries_{$delivery->id}">
			</div>

			<h3>
				<label for="deliveries_{$delivery->id}">
					{$delivery->name}
					{if $cart->total_price < $delivery->free_from && $delivery->price>0}
					({$delivery->price|convert}&nbsp;{$currency->sign})
					{elseif $cart->total_price >= $delivery->free_from}
					(бесплатно)
					{/if}
				</label>
			</h3>
			<div class="description">
				{$delivery->description}
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>

	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'order-form',
		'enableAjaxValidation' => true,
	)); ?>
	<h2>Адрес получателя</h2>

	<?php echo $form->errorSummary($order); ?>

	<div class="form cart_form">
		<?php echo $form->labelEx($order, 'user_name'); ?>
		<?php echo $form->textField($order, 'user_name'); ?>

		<?php echo $form->labelEx($order, 'user_email'); ?>
		<?php echo $form->textField($order, 'user_email'); ?>

		<?php echo $form->labelEx($order, 'user_phone'); ?>
		<?php echo $form->textField($order, 'user_phone'); ?>

		<?php echo $form->labelEx($order, 'user_address'); ?>
		<?php echo $form->textField($order, 'user_address'); ?>

		<?php echo $form->labelEx($order, 'comment'); ?>
		<?php echo $form->textArea($order, 'comment'); ?>

		<?php echo CHtml::submitButton('Оформить заказ', array(
			'class' => 'button',
		)); ?>
	</div>

	<?php $this->endWidget(); ?>
<?php else: ?>
В корзине нет товаров
<?php endif; ?>