<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>form comment</title>
</head>
<body>

	<div class="fortune">
		<ul>
			<?php $name_fortune = isset($fortune['name']) ? $fortune['name'] : '-' ; ?>
			<li>Name Fortune: <?php echo $name_fortune ; ?></li>
		</ul>
	</div>

	<div class="menu-fortune">
		<!-- <ul>
			<li><a href="">Comment</a></li>
		</ul> -->
	</div>

	<div class="body-review">
		<ul class="review">
		<?php if (isset($listComment)): ?>
			<?php foreach( $listComment as $key => $comment ): ?>
				<li>
					<p><?php echo json_decode(str_replace('\n', '<br>', json_encode($comment->comment_content)))?> </p>
					<div class="spec">
						<span style="color: red" class="f-weight"><?php echo isset($comment->user->username) ? $comment->user->username : '-' ; ?></span>
						<span style="color: red" class="created-comment">2016.07.26</span>
					</div>
				</li>
			<?php endforeach; ?>
		<?php endif; ?>
		</ul>
	</div>
	
	<?php if(isset($fortune['id'])): ?>
		<?= $this->Form->create() ?>
	        <?= $this->Form->textarea('comment_content'); ?>
			<?= $this->Form->button(__('Comment')); ?>
		<?= $this->Form->end() ?>
		User: Tên User
	<?php endif; ?>

</body>
</html>