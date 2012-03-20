<li>
	<h3><?php echo CHtml::link(CHtml::encode($data->name), $data->getUrl()); ?></h3>
	<p><?php echo $data->date; ?></p>
	<p><?php echo CHtml::encode($data->annotation); ?></p>
</li>