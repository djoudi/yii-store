<li>
	<h3><?php echo CHtml::link(CHtml::encode($data->name), $data->url); ?></h3>
	<p><?php echo date(Yii::app()->params['dateFormat'], $data->create_time); ?></p>
	<p><?php echo CHtml::encode($data->annotation); ?></p>
</li>