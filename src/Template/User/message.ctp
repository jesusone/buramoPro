<?php $countInbox = isset($countInbox) ? $countInbox : '-' ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Composer'), ['action' => 'composerMsg']) ?></li>
        <li><?= $this->Html->link(__('Inbox ('.$countInbox.')'),['action' => 'message']) ?></li>
        <li><?= $this->Html->link(__('Sent'), ['action' => 'sentMsg']) ?></li></ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <div class="other-message">
    	<?php if(!empty($allMsgs)): ?>
    	<?php foreach($allMsgs as $index => $message): ?>
    		<?php $username = $message->user->username; ?>
    		<?php $title = $message->msg_header; ?>
	    	<ul>
	    		<li><input type="checkbox" name=""></li>
	    		<li><?= $this->Html->link("Username:".$username. ".......".$title.'.................Reply(0)', ['controller' => 'users', 'action' => 'detailMsg', $message->id]) ?></li>
	    	</ul>
	    <?php endforeach; ?>
	    <?php endif; ?>
    </div>
</div>
