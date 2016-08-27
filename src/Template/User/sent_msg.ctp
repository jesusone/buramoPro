<?php $countInbox = isset($countInbox) ? $countInbox : '-' ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Composer'), ['action' => 'composerMsg']) ?></li>
        <li><?= $this->Html->link(__('Inbox ('.$countInbox.')'),['action' => 'message']) ?></li>
        <li><?= $this->Html->link(__('Sent'), ['action' => 'sentMsg']) ?></li>
        <li><?= $this->Html->link(__('Lists Users'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h2>Sent messages</h2>
	 <form class="form-horizontal" role="form">
	    <div class="form-group">
	      <label class="control-label col-sm-2">Tới:</label>
	      <div class="col-sm-10">
	        <input type="text" class="form-control">
	      </div>
	    </div>
	    <div class="form-group">
	      <label class="control-label col-sm-2">Chủ đề:</label>
	      <div class="col-sm-10">
	         <input type="password" class="form-control">
	      </div>
	    </div>
	    <div class="form-group">
	      <label class="control-label col-sm-2"></label>
	      <div class="col-sm-10">
	        <!-- <input type="text" class="form-control"> -->
			<textarea name="" class="form-control" cols="30" rows="10"></textarea>
	      </div>
	    </div>
	    <div class="form-group">
	      <div class="col-sm-offset-2 col-sm-10">
	        <button type="submit" class="btn btn-default">Submit</button>
	      </div>
	    </div>
	 </form>
</div>
