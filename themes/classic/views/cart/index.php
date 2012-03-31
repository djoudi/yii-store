<h1>
	<?php if (count(Yii::app()->cart->purchases)): ?>
	В корзине <?php echo Yii::app()->cart->totalProducts; ?> товаров
	<?php else: ?>
	Корзина пуста
	<?php endif; ?>
</h1>

<?php if (count(Yii::app()->cart->purchases)): ?>
<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'order-form',
	'enableAjaxValidation' => true,
)); ?>

	<table id="purchases">

		<?php foreach (Yii::app()->cart->purchases as $purchase): ?>
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
				<?php echo CHtml::encode($purchase['variant']->name); ?>
			</td>

			<td class="price">
				<?php echo Yii::app()->money->convert($purchase['variant']->price); ?>
				<?php echo Yii::app()->money->current->sign; ?>
			</td>

			<td class="amount">
				<select name="amounts[<?php echo $purchase['variant']->id; ?>]" onchange="document.order-form.submit();">
					<?php for ($i=0; $i<$purchase['variant']->stock; $i++): ?>
					<?php if ($i==0): continue; endif; ?>
					<option value="<?php echo $i; ?>" <?php if ($purchase['amount']==$i): ?>selected<?php endif; ?>><?php echo $i; ?> шт</option>
					<?php endfor; ?>
				</select>
			</td>

			<td class="price">
				<?php echo Yii::app()->money->convert($purchase['variant']->price * $purchase['amount']); ?>
				<?php echo Yii::app()->money->current->sign; ?>
			</td>

			<td class="remove">
				<a href="/cart/delete/<?php echo $purchase['variant']->id; ?>">
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
				<?php echo Yii::app()->money->convert(Yii::app()->cart->totalPrice); ?>
				<?php echo Yii::app()->money->current->sign; ?>
			</th>
		</tr>
	</table>


	<?php if ($deliveries): ?>
	<h2>Выберите способ доставки:</h2>
	<ul id="deliveries">
		<?php foreach ($deliveries as $key => $delivery): ?>
		<li>
			<div class="checkbox">
				<?php echo $form->radioButton($order, 'delivery_id', array(
					'value' => $delivery->id,
					'checked' => ($key==0)?'checked':'',
					'id' => 'deliveries_'.$delivery->id,
				)); ?>
			</div>

			<h3>
				<label for="deliveries_<?php echo $delivery->id?>">
					<?php echo $delivery->name; ?>
					<?php if ($delivery->price>0): ?>
					(<?php echo $delivery->price; ?> руб)
					<?php endif; ?>
				</label>
			</h3>
			<div class="description">
				<?php echo $delivery->description; ?>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>

	<h2>Адрес получателя</h2>

	<div class="form cart_form">
		<?php echo $form->errorSummary($order); ?>

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
			'name' => 'checkout',
			'class' => 'button',
		)); ?>
	</div>
<?php $this->endWidget(); ?>

<?php else: ?>
В корзине нет товаров
<?php endif; ?>