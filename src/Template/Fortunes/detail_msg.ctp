
<h2><?= __('Detail messages') ?></h2>
<div class="detail-messages">
    <div class="other-message">
        <p>
            <?= $this->Form->create('',['id' => 'reply-mail']) ?>
                <?= $this->Form->textarea('msg_body', ['rows' => '4', 'cols' => '100%']) ?>
                <?= $this->Form->button(__('Reply')) ?>
            <?= $this->Form->end() ?>
        </p>
    </div>
</div>
