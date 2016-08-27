<h2><?= __('Danh sách các messages') ?></h2>
<div class="container">
	<?php if(!empty($messages)): ?>
	<?php foreach($messages as $index => $message): ?>
	    <div class="row">
	         <p><?= __('Ten User:') ?> <?= $message->user->full_name ?></p>
	         <p><?= __('Ngay gui:') ?> <?= $message->date_created->format('Y-m-d') ?> </p>
	         <p><?= __('Tieu de:') ?>  <?= $message->msg_header ?> </p>
	         <?= $this->Html->link("$message->msg_body", ['controller' => 'fortunes', 'action' => 'detailMsg', $message->id]) ?>
	         <hr>
	     </div>
	<?php endforeach; ?>
    <?php endif; ?>
</div>

