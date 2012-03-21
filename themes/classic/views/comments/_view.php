<!-- Список с комментариями -->
	<ul class="comment_list">
		<?php foreach ($comments as $comment): ?>
		<a name="comment_<?php echo $comment->id; ?>"></a>
		<li>
			<!-- Имя и дата комментария-->
			<div class="comment_header">
				<?php echo CHtml::encode($comment->name); ?>
				<i><?php echo date('Y.m.d', $comment->create_time); ?></i>
				<?php if ($comment->status == 0): ?>
				<b>ожидает модерации</b>
				<?php endif; ?>
			</div>
			<!-- Имя и дата комментария (The End)-->

			<!-- Комментарий -->
			<?php echo CHtml::encode($comment->text); ?>
			<!-- Комментарий (The End)-->
		</li>
		<?php endforeach; ?>
	</ul>
<!-- Список с комментариями (The End)-->