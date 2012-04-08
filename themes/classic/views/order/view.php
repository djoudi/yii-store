<?php $this->pageTitle = Yii::app()->name . ' – Ваш заказ №' . $order->id; ?>

<h1>
	Ваш заказ №<?php echo $order->id ?>
	<?php if ($order->status == 0): ?>принят<?php endif; ?>
	<?php if ($order->status == 1): ?>в обработке<?php elseif ($order->status == 2): ?>выполнен<?php endif; ?>
	<?php if ($order->paid == 1): ?>, оплачен<?php else: ?><?php endif; ?>
</h1>

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
		<?php echo Yii::app()->money->convert($purchase->price*$purchase->amount); ?>
		<?php echo Yii::app()->money->current->sign; ?>
	</td>
</tr>
<?php endforeach; ?>





 