<table id="purchases">

	<?php foreach ($order->purchases as $purchase): ?>
	<tr>
		<td class="image">
			<?php if (count($purchase->product->images)): ?>
			<a href="<?php echo $purchase->product->url; ?>">
				<?php echo $purchase->product->images[0]->getImage(50,50,$purchase->product->name); ?>
			</a>
			<?php endif; ?>
		</td>

		<td class="name">
			<a href="<?php echo $purchase->product->url; ?>"><?php CHtml::encode($purchase->product->name); ?></a>
			<?php $purchase->variant_name|escape ?>
			<?php if ($order->paid && $purchase->variant->attachment ?>
			<a class="download_attachment" href="order/<?php $order->url ?>/<?php $purchase->variant->attachment ?>">скачать файл</a>
			<?php endif; ?>
		</td>

		<?php * Цена за единицу * ?>
		<td class="price">
			<?php ($purchase->price)|convert ?>&nbsp;<?php $currency->sign ?>
		</td>

		<?php * Количество * ?>
		<td class="amount">
			&times; <?php $purchase->amount ?>&nbsp;<?php $settings->units ?>
		</td>

		<?php * Цена * ?>
		<td class="price">
			<?php ($purchase->price*$purchase->amount)|convert ?>&nbsp;<?php $currency->sign ?>
		</td>
	</tr>
	<?php endforeach; ?>

<?php * Скидка, если есть * ?>
	<?php if ($order->discount > 0 ?>
	<tr>
		<th class="image"></th>
		<th class="name">скидка</th>
		<th class="price"></th>
		<th class="amount"></th>
		<th class="price">
			<?php $order->discount ?>&nbsp;%
		</th>
	</tr>
	<?php endif; ?>
	<?php * Если стоимость доставки входит в сумму заказа * ?>
	<?php if (!$order->separate_delivery && $order->delivery_price>0 ?>
	<tr>
		<td class="image>"</td>
		<td class="name"><?php $delivery->name|escape ?></td>
		<td class="price"></td>
		<td class="amount"></td>
		<td class="price">
			<?php $order->delivery_price|convert ?>&nbsp;<?php $currency->sign ?>
		</td>
	</tr>
	<?php endif; ?>
	<?php * Итого * ?>
	<tr>
		<th class="image"></th>
		<th class="name">итого</th>
		<th class="price"></th>
		<th class="amount"></th>
		<th class="price">
			<?php $order->total_price|convert ?>&nbsp;<?php $currency->sign ?>
		</th>
	</tr>
	<?php * Если стоимость доставки не входит в сумму заказа * ?>
	<?php if ($order->separate_delivery ?>
	<tr>
		<td class="image>"</td>
		<td class="name"><?php $delivery->name|escape ?></td>
		<td class="price"></td>
		<td class="amount"></td>
		<td class="price">
			<?php $order->delivery_price|convert ?>&nbsp;<?php $currency->sign ?>
		</td>
	</tr>
	<?php endif; ?>

</table>

<?php * Детали заказа * ?>
<h2>Детали заказа</h2>
<table class="order_info">
	<tr>
		<td>
			Дата заказа
		</td>
		<td>
			<?php $order->date|date ?> в
			<?php $order->date|time ?>
		</td>
	</tr>
	<?php if ($order->name ?>
	<tr>
		<td>
			Имя
		</td>
		<td>
			<?php $order->name|escape ?>
		</td>
	</tr>
	<?php endif; ?>
	<?php if ($order->email ?>
	<tr>
		<td>
			Email
		</td>
		<td>
			<?php $order->email|escape ?>
		</td>
	</tr>
	<?php endif; ?>
	<?php if ($order->phone ?>
	<tr>
		<td>
			Телефон
		</td>
		<td>
			<?php $order->phone|escape ?>
		</td>
	</tr>
	<?php endif; ?>
	<?php if ($order->address ?>
	<tr>
		<td>
			Адрес доставки
		</td>
		<td>
			<?php $order->address|escape ?>
		</td>
	</tr>
	<?php endif; ?>
	<?php if ($order->comment ?>
	<tr>
		<td>
			Комментарий
		</td>
		<td>
			<?php $order->comment|escape|nl2br ?>
		</td>
	</tr>
	<?php endif; ?>
</table>


<?php if (!$order->paid ?>
<?php * Выбор способа оплаты * ?>
<?php if ($payment_methods && !$payment_method ?>
<form method="post">
	<h2>Выберите способ оплаты</h2>
	<ul id="deliveries">
		<?php foreach ($payment_methods as $payment_method ?>
		<li>
			<div class="checkbox">
				<input type=radio name=payment_method_id value='<?php $payment_method->id ?>' <?php if ($payment_method@first ?>checked<?php endif; ?> id=payment_<?php $payment_method->id ?>>
			</div>
			<h3><label for=payment_<?php $payment_method->id ?>>	<?php $payment_method->name ?>, к оплате <?php $order->total_price|convert:$payment_method->currency_id ?>&nbsp;<?php $all_currencies[$payment_method->currency_id]->sign ?></label></h3>
			<div class="description">
				<?php $payment_method->description ?>
			</div>
		</li>
		<?php /foreach ?>
	</ul>
	<input type='submit' class="button" value='Закончить заказ'>
</form>

<?php * Выбраный способ оплаты * ?>
<?php elseif $payment_method ?>
<h2>Способ оплаты &mdash; <?php $payment_method->name ?>
	<form method=post><input type=submit name='reset_payment_method' value='Выбрать другой способ оплаты'></form>
</h2>
<p>
	<?php $payment_method->description ?>
</p>
<h2>
	К оплате <?php $order->total_price|convert:$payment_method->currency_id ?>&nbsp;<?php $all_currencies[$payment_method->currency_id]->sign ?>
</h2>

<?php * Форма оплаты, генерируется модулем оплаты * ?>
<?php checkout_form order_id=$order->id module=$payment_method->module ?>
<?php endif; ?>

<?php endif; ?>