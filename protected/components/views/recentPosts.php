<?php if (count($this->posts) > 0): ?>
<div id="blog_menu">
	<h2>Новые записи в <a href="blog">блоге</a></h2>
	<ul>
		<?php foreach ($this->posts as $post): ?>
		<li data-post="<?php echo $post->id; ?>">
			<?php echo $post->date; ?>
			<?php echo CHtml::link(CHtml::encode($post->name), $post->getUrl()); ?>
		</li>
		<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>