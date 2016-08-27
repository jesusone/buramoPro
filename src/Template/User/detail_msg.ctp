<?php $countInbox = isset($countInbox) ? $countInbox : '-' ?>
<div class="users index large-9 medium-8 columns content">
    <div class="other-message">
    	<h4>Detail messages</h4>
        <?php foreach($detailMsg as $index => $item): ?>
            <p><?= $item->msg_body ?></p>
        <?php endforeach; ?>
        <p></p>
        <p>
            <?= $this->Form->create('',['id' => 'reply-mail']) ?>
                <?= $this->Form->textarea('msg_body', ['rows' => '4', 'cols' => '30']) ?></br>
                <?= $this->Form->button(__('Reply')) ?>
            <?= $this->Form->end() ?>
        </p>
    </div>
</div>
