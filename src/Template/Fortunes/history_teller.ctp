<?= $this->Form->create() ?>
	<div class="container">
    	<?= __('From') ?>: <input name = "from_time" type="date">
    	<?= __('To') ?>:   <input name = "end_time" type="date">
	</div>
	<div>
		<input type="submit" value="Submit">
	</div>
<?= $this->Form->end() ?>

<div>
	<table class="table table-bordered">
	    <thead>
	      <tr>
	        <th><?= __('STT') ?></th>
	        <th><?= __('UserName') ?></th>
	        <th><?= __('Date') ?></th>
	        <th><?= __('Time') ?></th>
	        <th><?= __('Status') ?></th>
	        <th><?= __('Date_Created') ?></th>
	      </tr>
	    </thead>
	    <tbody>
	    <?php if(!empty($history_schedules)): ?>
	    <?php foreach($history_schedules as $i => $item): ?>
	      <tr>
	        <td><?= $i+1 ?></td>
	        <td><?= $item->user->username ?></td>
	        <td><?= date("Y-m-d", strtotime($item->date)) ?></td>
	        <th><?= $item->time ?></th>
	        <th><?= $item->status ?></th>
	        <th><?= date("Y-m-d", strtotime($item->date_created)) ?></th>
	      </tr>
	    <?php endforeach; ?>
		<?php elseif(empty($history_schedules)): ?>
		<?php endif; ?>
	    </tbody>
    </table>
</div>