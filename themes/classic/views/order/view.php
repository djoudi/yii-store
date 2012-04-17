<?php $this->pageTitle = Yii::app()->name . ' – Ваш заказ №' . $order->id; ?>

<h1>
	Ваш заказ №<?php echo $order->id ?>
	<?php if ($order->status == 0): ?>принят<?php endif; ?>
	<?php if ($order->status == 1): ?>в обработке<?php elseif ($order->status == 2): ?>выполнен<?php endif; ?>
	<?php if ($order->paid == 1): ?>, оплачен<?php else: ?><?php endif; ?>
</h1>

<table id="purchases">
	<?php foreach ($order->purchases as $purchase): ?>
	<tr>
		<td class="image">
			<?php if (count($purchase->product->images)): ?>
			<a href="<?php echo $purchase->product->url; ?>">
				<?php echo $purchase->product->images[0]->getImage(50, 50, $purchase->product->name); ?>
			</a>
			<?php endif; ?>
		</td>

		<td class="name">
			<a href="<?php echo $purchase->product->url; ?>"><?php CHtml::encode($purchase->product->name); ?></a>
			<?php echo CHtml::encode($purchase->variant_name); ?>
		</td>

		<td class="price">
			<?php echo Yii::app()->money->convert($purchase->price); ?>
			<?php echo Yii::app()->money->current->sign; ?>
		</td>

		<td class="amount">
			&times; <?php echo $purchase->amount ?>
			<?php echo Yii::app()->params['units']; ?>
		</td>

		<td class="price">
			<?php echo Yii::app()->money->convert($purchase->price * $purchase->amount); ?>
			<?php echo Yii::app()->money->current->sign; ?>
		</td>
	</tr>
	<?php endforeach; ?>

	<?php if ($order->discount > 0): ?>
	<tr>
		<th class="image"></th>
		<th class="name">скидка</th>
		<th class="price"></th>
		<th class="amount"></th>
		<th class="price">
			<?php $order->discount ?>
			%
		</th>
	</tr>
	<?php endif; ?>

	<?php if (!$order->separate_delivery && $order->delivery_price > 0): ?>
	<tr>
		<td class="image"></td>
		<td class="name">
			<?php echo CHtml::encode($delivery->name); ?>
		</td>
		<td class="price"></td>
		<td class="amount"></td>
		<td class="price">
			<?php echo Yii::app()->money->convert($order->delivery_price); ?>
			<?php echo Yii::app()->money->current->sign; ?>
		</td>
	</tr>
	<?php endif; ?>

	<tr>
		<th class="image"></th>
		<th class="name">итого</th>
		<th class="price"></th>
		<th class="amount"></th>
		<th class="price">
			<?php echo Yii::app()->money->convert($order->total_price); ?>
			<?php echo Yii::app()->money->current->sign; ?>
		</th>
	</tr>

	<?php if ($order->separate_delivery): ?>
	<tr>
		<td class="image"></td>
		<td class="name">
			<?php echo CHtml::encode($order->delivery->name); ?>
		</td>
		<td class="price"></td>
		<td class="amount"></td>
		<td class="price">
			<?php echo Yii::app()->money->convert($order->delivery_price); ?>
			<?php echo Yii::app()->money->current->sign; ?>
		</td>
	</tr>
	<?php endif; ?>
</table>