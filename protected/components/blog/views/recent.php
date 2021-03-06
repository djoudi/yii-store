<?php if (count($this->posts) > 0): ?>
<div id="blog_menu">
	<h2>Новые записи в <?php echo CHtml::link('блоге', array('/blog')); ?></h2>
	<ul>
		<?php foreach ($this->posts as $post): ?>
		<li data-post="<?php echo $post->id; ?>">
			<?php echo date(Yii::app()->params['dateFormat'], $post->create_time); ?>
			<?php echo CHtml::link(CHtml::encode($post->name), $post->url); ?>
		</li>
		<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>