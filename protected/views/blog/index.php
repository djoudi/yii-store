<h1>Блог</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
	'template' => "<ul id=\"blog\">{items}</ul>\n{pager}",
)); ?>